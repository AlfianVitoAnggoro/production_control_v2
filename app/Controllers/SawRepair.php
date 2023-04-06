<?php

namespace App\Controllers;

use App\Models\M_Plate;
use App\Models\M_SawRepair;
use App\Models\M_SawRepairPotonginput;
use App\Models\M_SawRepairSawInput;

class SawRepair extends BaseController
{
  protected $saw_repairModel;
  protected $saw_repair_sawModel;
  protected $saw_repair_potongModel;
  protected $plateModel;
  public function __construct()
  {
    $this->saw_repairModel = new M_SawRepair();
    $this->saw_repair_sawModel = new M_SawRepairSawInput();
    $this->saw_repair_potongModel = new M_SawRepairPotonginput();
    $this->plateModel = new M_Plate();
  }
  public function saw_repair_view()
  {
    $session = \Config\Services::session();
    $saw_repair = $this->saw_repairModel->findAll();
    $saw_repair_saw = $this->saw_repair_sawModel->findAll();
    $saw_repair_potong = $this->saw_repair_potongModel->findAll();
    $dates = array_column($saw_repair, "date");
    $shift = array_column($saw_repair, "shift");
    array_multisort($dates, SORT_ASC, $shift, SORT_ASC,  $saw_repair);
    $status = $session->get();
    $data = [
      'saw_repair' => $saw_repair,
      'saw_repair_saw' => $saw_repair_saw,
      'saw_repair_potong' => $saw_repair_potong,
      'session' => $status,
    ];
    return view('pages/saw_repair/saw_repair_view', $data);
  }

  public function add_saw_repair($id)
  {
    $saw_repair = $this->saw_repairModel->find($id);
    $saw_repair_saw = $this->saw_repair_sawModel->where('id_saw_repair', $id)->findAll();
    $saw_repair_potong = $this->saw_repair_potongModel->where('id_saw_repair', $id)->findAll();
    $plate = $this->plateModel->findAll();
    $data = [
      'plate' => $plate,
      'saw_repair' => $saw_repair,
      'saw_repair_saw' => $saw_repair_saw,
      'saw_repair_potong' => $saw_repair_potong,
    ];
    return view('pages/saw_repair/add_saw_repair', $data);
  }

  public function save()
  {
    $id = $this->request->getVar('id_saw_repair');
    $saw_repair_saw = $this->saw_repair_sawModel->where('id_saw_repair', $id)->findAll();
    $id_saw_repair_saw = $this->request->getVar('id_saw_repair_saw');
    $id_saw_repair_potong = $this->request->getVar('id_saw_repair_potong');
    $date = $this->request->getVar('date');
    $shift = $this->request->getVar('shift');
    $plate = $this->request->getVar('plate');
    $saw_repairinputnew = [];
    $data_new_saw_repair_saw = [];
    $data_old_saw_repair_saw = [];
    if ($id === NULL) {
      $data_saw_repair[] = array(
        'date' => $date,
        'shift' => $shift,
        // 'status' => 'pending'
      );
      $this->saw_repairModel->insertBatch($data_saw_repair);
      $newid = $this->saw_repairModel->insertID();
      return redirect()->to(base_url('saw_repair/add_saw_repair/' . $newid));
    } else {
      $data_saw_repair[] = array(
        'id' => $id,
        'date' => $date,
        'shift' => $shift,
        // 'status' => 'pending'
      );
      $this->saw_repairModel->updateBatch($data_saw_repair, 'id');
      for ($i = 0; $i < ($id_saw_repair_saw !== NULL ? count($id_saw_repair_saw) : 0); $i++) {
        if ($id_saw_repair_saw[$i] === "" && $plate[$i] !== "") {
          $data_new_saw_repair_saw[] = array(
            'id_saw_repair' => $id,
            'plate' => $plate[$i],
          );
        } else {
          $saw_repairinputnew[$id_saw_repair_saw[$i]] = $id_saw_repair_saw[$i];
          $data_old_saw_repair_saw[] = array(
            'id' => $id_saw_repair_saw[$i],
            'plate' => $plate[$i],
          );
        }
      }
      if (count($data_new_saw_repair_saw) > 0) {
        $this->saw_repair_sawModel->insertBatch($data_new_saw_repair_saw);
      }
      if (count($data_old_saw_repair_saw) > 0) {
        $this->saw_repair_sawModel->updateBatch($data_old_saw_repair_saw, 'id');
      }
    }
    foreach ($saw_repair_saw as $srs) {
      if ($saw_repairinputnew !== NULL) {
        if (!array_key_exists($srs['id'], $saw_repairinputnew)) {
          $this->saw_repair_sawModel->delete($srs['id']);
        }
      } else {
        $this->saw_repair_sawModel->delete($srs['id']);
      }
    }
    return redirect()->to(base_url('saw_repair/add_saw_repair/' . $id));
  }

  public function detail_saw_repair($id)
  {
    $session = \Config\Services::session();
    $status = $session->get('level');
    if ($status !== 1) {
      return redirect()->to('/saw_repair');
    }
    $plate = $this->plateModel->findAll();
    $saw_repair = $this->saw_repairModel->find($id);
    $saw_repairinput = $this->saw_repair_sawModel->where('id_saw_repair', $id)->findAll();

    $data = [
      'plate' => $plate,
      'saw_repair' => $saw_repair,
      'saw_repairinput' => $saw_repairinput,
    ];

    return view('pages/saw_repair/detail_saw_repair', $data);
  }

  public function edit()
  {
    $id = $this->request->getVar('id');
    $id_saw_repair = $this->request->getVar('id_saw_repair');
    $date = $this->request->getVar('date');
    $shift = $this->request->getVar('shift');
    $plate = $this->request->getVar('plate');
    $data_saw_repair[] = array(
      'id' => $id_saw_repair,
      'date' => $date,
      'shift' => $shift,
      'status' => 'pending'
    );
    $this->saw_repairModel->updateBatch($data_saw_repair, 'id');
    for ($i = 0; $i < ($id !== NULL ? count($id) : 0); $i++) {
      if ($plate[$i] !== NULL) {
        $data_saw_repairinput[] = array(
          'id' => $id[$i],
          'plate' => $plate[$i],
        );
        $this->saw_repair_sawModel->updateBatch($data_saw_repairinput, 'id');
      }
    }
    return redirect()->to(base_url('/saw_repair'));
  }

  public function delete_saw_repair()
  {
    $id_saw_repair = $this->request->getVar('id_saw_repair');
    $this->saw_repairModel->delete(['id' => $id_saw_repair]);
    $this->saw_repair_sawModel->delete(['id_saw_repair' => $id_saw_repair]);

    return redirect()->to(base_url('/saw_repair'));
  }
}
