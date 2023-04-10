<?php

namespace App\Controllers;

use App\Models\M_Plate;
use App\Models\M_SawRepair;
use App\Models\M_TypeBattery;
use App\Models\M_SawRepairPotonginput;
use App\Models\M_SawRepairSawInput;

class SawRepair extends BaseController
{
  protected $saw_repairModel;
  protected $saw_repair_sawModel;
  protected $saw_repair_potongModel;
  protected $type_batteryModel;
  protected $plateModel;
  public function __construct()
  {
    $this->saw_repairModel = new M_SawRepair();
    $this->saw_repair_sawModel = new M_SawRepairSawInput();
    $this->saw_repair_potongModel = new M_SawRepairPotonginput();
    $this->type_batteryModel = new M_TypeBattery();
    $this->plateModel = new M_Plate();
  }
  public function saw_repair_view()
  {
    $session = \Config\Services::session();
    $saw_repair = $this->saw_repairModel->findAll();
    $saw_repair_saw = $this->saw_repair_sawModel->findAll();
    $saw_repair_potong = $this->saw_repair_potongModel->findAll();
    $type_battery = $this->type_batteryModel->findAll();
    $dates = array_column($saw_repair, "date");
    $shift = array_column($saw_repair, "shift");
    array_multisort($dates, SORT_ASC, $shift, SORT_ASC,  $saw_repair);
    $status = $session->get('level');
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
    $type_battery = $this->type_batteryModel->findAll();
    $plate = $this->plateModel->findAll();
    $data = [
      'plate' => $plate,
      'saw_repair' => $saw_repair,
      'saw_repair_saw' => $saw_repair_saw,
      'saw_repair_potong' => $saw_repair_potong,
      'type_battery' => $type_battery,
    ];
    return view('pages/saw_repair/add_saw_repair', $data);
  }

  public function save()
  {
    $id = $this->request->getVar('id_saw_repair');
    $saw_repair_saw = $this->saw_repair_sawModel->where('id_saw_repair', $id)->findAll();
    $saw_repair_potong = $this->saw_repair_potongModel->where('id_saw_repair', $id)->findAll();
    $date = $this->request->getVar('date');
    $shift = $this->request->getVar('shift');
    $plate = $this->request->getVar('plate');
    $id_saw_repair_saw = $this->request->getVar('id_saw_repair_saw');
    $operator_saw = $this->request->getVar('operator_saw');
    $type_battery_saw = $this->request->getVar('type_battery_saw');
    $qty_repair_saw = $this->request->getVar('qty_repair_saw');
    $id_saw_repair_potong = $this->request->getVar('id_saw_repair_potong');
    $operator_potong = $this->request->getVar('operator_potong');
    $type_battery_potong = $this->request->getVar('type_battery_potong');
    $qty_element_potong = $this->request->getVar('qty_element_potong');
    $type_plate_reject_potong = $this->request->getVar('type_plate_reject_potong');
    $qty_plate_reject_potong_kg = $this->request->getVar('qty_plate_reject_potong_kg');
    $qty_plate_reject_potong_panel = $this->request->getVar('qty_plate_reject_potong_panel');
    $keterangan_potong = $this->request->getVar('keterangan_potong');
    $saw_repair_sawinput = [];
    $saw_repair_potonginput = [];
    $data_new_saw_repair_saw = [];
    $data_old_saw_repair_saw = [];
    $data_new_saw_repair_potong = [];
    $data_old_saw_repair_potong = [];
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
        if ($id_saw_repair_saw[$i] === "" && $type_battery_saw[$i] !== "") {
          $data_new_saw_repair_saw[] = array(
            'id_saw_repair' => $id,
            'operator_saw' => $operator_saw,
            'type_battery_saw' => $type_battery_saw[$i],
            'qty_repair_saw' => $qty_repair_saw[$i],
          );
        } else {
          $saw_repair_sawinput[$id_saw_repair_saw[$i]] = $id_saw_repair_saw[$i];
          $data_old_saw_repair_saw[] = array(
            'id' => $id_saw_repair_saw[$i],
            'id_saw_repair' => $id,
            'operator_saw' => $operator_saw,
            'type_battery_saw' => $type_battery_saw[$i],
            'qty_repair_saw' => $qty_repair_saw[$i],
          );
        }
      }
      if (count($data_new_saw_repair_saw) > 0) {
        $this->saw_repair_sawModel->insertBatch($data_new_saw_repair_saw);
      }
      if (count($data_old_saw_repair_saw) > 0) {
        $this->saw_repair_sawModel->updateBatch($data_old_saw_repair_saw, 'id');
      }
      for ($i = 0; $i < ($id_saw_repair_potong !== NULL ? count($id_saw_repair_potong) : 0); $i++) {
        if ($id_saw_repair_potong[$i] === "" && $type_battery_potong[$i] !== "") {
          $data_new_saw_repair_potong[] = array(
            'id_saw_repair' => $id,
            'operator_potong' => $operator_potong,
            'type_battery_potong' => $type_battery_potong[$i],
            'qty_element_potong' => $qty_element_potong[$i],
            'type_plate_reject_potong' => $type_plate_reject_potong[$i],
            'qty_plate_reject_potong_kg' => $qty_plate_reject_potong_kg[$i],
            'qty_plate_reject_potong_panel' => $qty_plate_reject_potong_panel[$i],
            'keterangan_potong' => $keterangan_potong[$i],
          );
        } else {
          $saw_repair_potonginput[$id_saw_repair_potong[$i]] = $id_saw_repair_potong[$i];
          $data_old_saw_repair_potong[] = array(
            'id' => $id_saw_repair_potong[$i],
            'id_saw_repair' => $id,
            'operator_potong' => $operator_potong,
            'type_battery_potong' => $type_battery_potong[$i],
            'qty_element_potong' => $qty_element_potong[$i],
            'type_plate_reject_potong' => $type_plate_reject_potong[$i],
            'qty_plate_reject_potong_kg' => $qty_plate_reject_potong_kg[$i],
            'qty_plate_reject_potong_panel' => $qty_plate_reject_potong_panel[$i],
            'keterangan_potong' => $keterangan_potong[$i],
          );
        }
      }
      if (count($data_new_saw_repair_potong) > 0) {
        $this->saw_repair_potongModel->insertBatch($data_new_saw_repair_potong);
      }
      if (count($data_old_saw_repair_potong) > 0) {
        $this->saw_repair_potongModel->updateBatch($data_old_saw_repair_potong, 'id');
      }
    }
    foreach ($saw_repair_saw as $srs) {
      if ($saw_repair_sawinput !== NULL) {
        if (!array_key_exists($srs['id'], $saw_repair_sawinput)) {
          $this->saw_repair_sawModel->delete($srs['id']);
        }
      } else {
        $this->saw_repair_sawModel->delete($srs['id']);
      }
    }
    foreach ($saw_repair_potong as $srs) {
      if ($saw_repair_potonginput !== NULL) {
        if (!array_key_exists($srs['id'], $saw_repair_potonginput)) {
          $this->saw_repair_potongModel->delete($srs['id']);
        }
      } else {
        $this->saw_repair_potongModel->delete($srs['id']);
      }
    }
    return redirect()->to(base_url('saw_repair/add_saw_repair/' . $id));
  }

  public function detail_saw_repair($id)
  {
    $session = \Config\Services::session();
    $status = $session->get('level');
    if ($status > 1) {
      return redirect()->to('/saw_repair');
    }
    $saw_repair = $this->saw_repairModel->find($id);
    $saw_repair_saw = $this->saw_repair_sawModel->where('id_saw_repair', $id)->findAll();
    $saw_repair_potong = $this->saw_repair_potongModel->where('id_saw_repair', $id)->findAll();
    $type_battery = $this->type_batteryModel->findAll();
    $plate = $this->plateModel->findAll();
    $data = [
      'plate' => $plate,
      'saw_repair' => $saw_repair,
      'saw_repair_saw' => $saw_repair_saw,
      'saw_repair_potong' => $saw_repair_potong,
      'type_battery' => $type_battery,
    ];
    return view('pages/saw_repair/detail_saw_repair', $data);
  }

  public function edit()
  {
    $id = $this->request->getVar('id_saw_repair');
    $saw_repair_saw = $this->saw_repair_sawModel->where('id_saw_repair', $id)->findAll();
    $saw_repair_potong = $this->saw_repair_potongModel->where('id_saw_repair', $id)->findAll();
    $date = $this->request->getVar('date');
    $shift = $this->request->getVar('shift');
    $plate = $this->request->getVar('plate');
    $id_saw_repair_saw = $this->request->getVar('id_saw_repair_saw');
    $operator_saw = $this->request->getVar('operator_saw');
    $type_battery_saw = $this->request->getVar('type_battery_saw');
    $qty_repair_saw = $this->request->getVar('qty_repair_saw');
    $id_saw_repair_potong = $this->request->getVar('id_saw_repair_potong');
    $operator_potong = $this->request->getVar('operator_potong');
    $type_battery_potong = $this->request->getVar('type_battery_potong');
    $qty_element_potong = $this->request->getVar('qty_element_potong');
    $type_plate_reject_potong = $this->request->getVar('type_plate_reject_potong');
    $qty_plate_reject_potong_kg = $this->request->getVar('qty_plate_reject_potong_kg');
    $qty_plate_reject_potong_panel = $this->request->getVar('qty_plate_reject_potong_panel');
    $keterangan_potong = $this->request->getVar('keterangan_potong');
    $saw_repair_sawinput = [];
    $saw_repair_potonginput = [];
    $data_new_saw_repair_saw = [];
    $data_old_saw_repair_saw = [];
    $data_new_saw_repair_potong = [];
    $data_old_saw_repair_potong = [];
    $data_saw_repair[] = array(
      'id' => $id,
      'date' => $date,
      'shift' => $shift,
      // 'status' => 'pending'
    );
    $this->saw_repairModel->updateBatch($data_saw_repair, 'id');
    for ($i = 0; $i < ($id_saw_repair_saw !== NULL ? count($id_saw_repair_saw) : 0); $i++) {
      if ($id_saw_repair_saw[$i] === "" && $type_battery_saw[$i] !== "") {
        $data_new_saw_repair_saw[] = array(
          'id_saw_repair' => $id,
          'operator_saw' => $operator_saw,
          'type_battery_saw' => $type_battery_saw[$i],
          'qty_repair_saw' => $qty_repair_saw[$i],
        );
      } else {
        $saw_repair_sawinput[$id_saw_repair_saw[$i]] = $id_saw_repair_saw[$i];
        $data_old_saw_repair_saw[] = array(
          'id' => $id_saw_repair_saw[$i],
          'id_saw_repair' => $id,
          'operator_saw' => $operator_saw,
          'type_battery_saw' => $type_battery_saw[$i],
          'qty_repair_saw' => $qty_repair_saw[$i],
        );
      }
    }
    if (count($data_new_saw_repair_saw) > 0) {
      $this->saw_repair_sawModel->insertBatch($data_new_saw_repair_saw);
    }
    if (count($data_old_saw_repair_saw) > 0) {
      $this->saw_repair_sawModel->updateBatch($data_old_saw_repair_saw, 'id');
    }
    for ($i = 0; $i < ($id_saw_repair_potong !== NULL ? count($id_saw_repair_potong) : 0); $i++) {
      if ($id_saw_repair_potong[$i] === "" && $type_battery_potong[$i] !== "") {
        $data_new_saw_repair_potong[] = array(
          'id_saw_repair' => $id,
          'operator_potong' => $operator_potong,
          'type_battery_potong' => $type_battery_potong[$i],
          'qty_element_potong' => $qty_element_potong[$i],
          'type_plate_reject_potong' => $type_plate_reject_potong[$i],
          'qty_plate_reject_potong_kg' => $qty_plate_reject_potong_kg[$i],
          'qty_plate_reject_potong_panel' => $qty_plate_reject_potong_panel[$i],
          'keterangan_potong' => $keterangan_potong[$i],
        );
      } else {
        $saw_repair_potonginput[$id_saw_repair_potong[$i]] = $id_saw_repair_potong[$i];
        $data_old_saw_repair_potong[] = array(
          'id' => $id_saw_repair_potong[$i],
          'id_saw_repair' => $id,
          'operator_potong' => $operator_potong,
          'type_battery_potong' => $type_battery_potong[$i],
          'qty_element_potong' => $qty_element_potong[$i],
          'type_plate_reject_potong' => $type_plate_reject_potong[$i],
          'qty_plate_reject_potong_kg' => $qty_plate_reject_potong_kg[$i],
          'qty_plate_reject_potong_panel' => $qty_plate_reject_potong_panel[$i],
          'keterangan_potong' => $keterangan_potong[$i],
        );
      }
    }
    if (count($data_new_saw_repair_potong) > 0) {
      $this->saw_repair_potongModel->insertBatch($data_new_saw_repair_potong);
    }
    if (count($data_old_saw_repair_potong) > 0) {
      $this->saw_repair_potongModel->updateBatch($data_old_saw_repair_potong, 'id');
    }
    return redirect()->to(base_url('/saw_repair/detail_saw_repair/' . $id));
  }

  public function delete_saw_repair()
  {
    $id_saw_repair = $this->request->getVar('id_saw_repair');
    $this->saw_repairModel->delete(['id' => $id_saw_repair]);
    $this->saw_repair_sawModel->delete(['id_saw_repair' => $id_saw_repair]);

    return redirect()->to(base_url('/saw_repair'));
  }
}
