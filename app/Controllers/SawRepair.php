<?php

namespace App\Controllers;

use App\Models\M_SawRepair;

class SawRepair extends BaseController
{
  public function __construct()
  {
    $this->M_SawRepair = new M_SawRepair();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data'] = $this->M_SawRepair->getAll();

    return view('pages/saw_repair/home', $data);
  }

  public function save_data()
  {
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $shift = $this->request->getPost('shift');
    $operator = $this->request->getPost('operator');

    $data = [
      'tanggal_produksi' => $tanggal_produksi,
      'shift' => $shift,
      'operator' => $operator
    ];

    $id_saw_repair = $this->M_SawRepair->save_data($data);

    return redirect()->to(base_url('saw_repair/detail_saw_repair/' . $id_saw_repair));
  }

  public function detail_lhp_saw_repair($id)
  {
    $data['data_type_battery'] = $this->M_SawRepair->get_data_type_battery();
    $data['data_saw_repair'] = $this->M_SawRepair->get_data_by_id($id);
    $data['detail_saw_repair'] = $this->M_SawRepair->get_data_detail_by_id($id);

    return view('pages/saw_repair/detail_saw_repair', $data);
  }

  public function update()
  {
    $id_lhp_saw_repair = $this->request->getPost('id_saw_repair');
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $shift = $this->request->getPost('shift');
    $operator = $this->request->getPost('operator');

    $data = [
      'tanggal_produksi' => $tanggal_produksi,
      'shift' => $shift,
      'operator' => $operator
    ];

    $this->M_SawRepair->update_data($id_lhp_saw_repair, $data);

    $type_battery = $this->request->getPost('type_battery');
    for ($i=0; $i < count($type_battery); $i++) {
      $data_detail = [
        'id_lhp_saw_repair' => $id_lhp_saw_repair,
        'type_battery' => $type_battery[$i],
        'qty' => $this->request->getPost('qty')[$i]
      ];
      $this->M_SawRepair->update_data_detail($this->request->getPost('id_detail_lhp_saw_repair')[$i], $data_detail);
    }

    return redirect()->to(base_url('saw_repair/detail_saw_repair/' . $id_lhp_saw_repair));
  }
}
