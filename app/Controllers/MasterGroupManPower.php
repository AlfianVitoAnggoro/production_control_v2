<?php

namespace App\Controllers;

use App\Models\M_MasterGroupManPower;

class MasterGroupManPower extends BaseController
{
  public function __construct()
  {
    $this->M_MasterGroupManPower = new M_MasterGroupManPower();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_group_man_power'] = $this->M_MasterGroupManPower->get_data_master_group_man_power();
    return view('pages/master_data_group_man_power/home', $data);
  }

  public function add_group_man_power()
  {
    // $bulan = $this->request->getPost('bulan');
    $line = $this->request->getPost('line');
    // $group_mp = $this->request->getPost('group_mp');

    $data_group_man_power = [
      // 'bulan' => date('Y-m-d', strtotime($bulan)),
      'line' => $line,
      // 'group_mp' => $group_mp,
    ];
    $save_data = $this->M_MasterGroupManPower->save_data_group_man_power($data_group_man_power);
    return redirect()->to(base_url('master_group_man_power/detail_group_man_power/' . $save_data));
  }

  public function detail_group_man_power($id_group_man_power)
  {
    $data['data_group_man_power'] = $this->M_MasterGroupManPower->get_data_master_group_man_power_by_id($id_group_man_power);
    $temp_data_detail_group_man_power = $this->M_MasterGroupManPower->get_detail_data_master_group_man_power_by_id($id_group_man_power);
    $data['data_detail_group_man_power'] = [];
    foreach ($temp_data_detail_group_man_power as $t_ddgmp) {
        $data['data_detail_group_man_power'][$t_ddgmp['group_mp']][$t_ddgmp['mesin']] = $t_ddgmp;
    }
    // $data['data_detail_group_man_power'] = array_column($temp_data_detail_group_man_power, null, 'mesin');

    return view('pages/master_data_group_man_power/detail_master_data_group_man_power', $data);
  }

  public function update_data_group_man_power()
  {
    $id_group = $this->request->getPost('id_group');
    $line = $this->request->getPost('line');
    // $group_mp = strval($this->request->getPost('group_mp'));
    // $bulan = $this->request->getPost('bulan');
    $model = new M_MasterGroupManPower();
    // $data_group_man_power = [
    //   'line' => $line,
    //   'group_mp' => $group_mp,
    //   'bulan' => $bulan,
    // ];
    // $model->update_data_group_man_power($id_group, $data_group_man_power);
    for ($i=1; $i <= 3; $i++) { 
      $mesin = $this->request->getPost('mesin');
      for ($j=0; $j < count($mesin); $j++) {
        $id_detail_group_man_power = $this->request->getPost('id_detail_group_man_power_' . $i)[$j] ?? '';
        $data_detail_group_man_power = [
          'id_group' => $id_group,
          'group_mp' => $this->request->getPost('group_mp_' . $i)[$j],
          'mesin' => $this->request->getPost('mesin')[$j] ?? '',
          'nama' => $this->request->getPost('nama_' . $i)[$j] ?? '',
        ];
        $model->update_detail_data_group_man_power($id_detail_group_man_power, $data_detail_group_man_power);
      }
    }

    return redirect()->to(base_url('master_group_man_power/detail_group_man_power/' . $id_group));
  }

  public function delete_data_group_man_power()
  {
    $id_group_man_power = $this->request->getPost('id_group_man_power');

    $model = new M_MasterGroupManPower();
    $model->delete_data_master_group_man_power($id_group_man_power);

    return redirect()->to(base_url('master_group_man_power'));
  }
}
