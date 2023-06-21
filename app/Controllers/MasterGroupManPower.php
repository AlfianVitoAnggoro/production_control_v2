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
    $sub_bagian = $this->request->getPost('sub_bagian');
    // $sub_bagian = $this->request->getPost('sub_bagian');
    $cek_sub_bagian = $this->M_MasterGroupManPower->get_data_group_man_power($sub_bagian);
    if(count($cek_sub_bagian) > 0)
      return redirect()->to(base_url('master_group_man_power/detail_group_man_power/' . $cek_sub_bagian[0]['id_group']));
    else {
      // $sub_bagian = '';
      // if($line <= 3)
      //   $sub_bagian = 'AMB-1';
      // else if($line <= 7)
      //   $sub_bagian = 'AMB-2';
      // else if($line === 8)
      //   $sub_bagian = 'WET A';
      // else if($line === 9)
      //   $sub_bagian = 'WET F';
      // else
      //   $sub_bagian = 'MCB';
      $data_group_man_power = [
        // 'bulan' => date('Y-m-d', strtotime($bulan)),
        // 'line' => $line,
        'sub_bagian' => $sub_bagian,
      ];
      $save_data = $this->M_MasterGroupManPower->save_data_group_man_power($data_group_man_power);
      return redirect()->to(base_url('master_group_man_power/detail_group_man_power/' . $save_data));
    }

  }

  public function detail_group_man_power($id_group_man_power)
  {
    $data['data_group_man_power'] = $this->M_MasterGroupManPower->get_data_master_group_man_power_by_id($id_group_man_power);
    $temp_data_detail_group_man_power = $this->M_MasterGroupManPower->get_detail_data_master_group_man_power_by_id($id_group_man_power);
    // dd($data['data_group_man_power']);
    $data['data_detail_group_man_power'] = [];
    foreach ($temp_data_detail_group_man_power as $t_ddgmp) {
        $data['data_detail_group_man_power'][$t_ddgmp['line']][$t_ddgmp['group_mp']][$t_ddgmp['mesin']] = $t_ddgmp;
    }
    // $sub_bagian = '';
    // if($data['data_group_man_power'][0]['line'] <= 3)
    //   $sub_bagian = 'AMB-1';
    // else if($data['data_group_man_power'][0]['line'] <= 7)
    //   $sub_bagian = 'AMB-2';
    // else if($data['data_group_man_power'][0]['line'] === 8)
    //   $sub_bagian = 'WET A';
    // else if($data['data_group_man_power'][0]['line'] === 9)
    //   $sub_bagian = 'WET F';
    // else
    //   $sub_bagian = 'MCB';
    $temp_data_detail_group_man_power_indirect = $this->M_MasterGroupManPower->get_detail_data_master_group_man_power_indirect_by_id($data['data_group_man_power'][0]['sub_bagian']);
    $data['data_detail_group_man_power_indirect'] = [];
    foreach ($temp_data_detail_group_man_power_indirect as $t_ddgmpi) {
        $data['data_detail_group_man_power_indirect'][$t_ddgmpi['group_mp']][$t_ddgmpi['mesin']] = $t_ddgmpi;
    }
    // $data['data_detail_group_man_power'] = array_column($temp_data_detail_group_man_power, null, 'mesin');

    return view('pages/master_data_group_man_power/detail_master_data_group_man_power', $data);
  }

  public function update_data_group_man_power()
  {
    $id_group = $this->request->getPost('id_group');
    $sub_bagian = $this->request->getPost('sub_bagian');
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
      $mesin_indirect = $this->request->getPost('mesin_indirect');
      for ($j=0; $j < count($mesin_indirect); $j++) {
        $id_detail_group_man_power_indirect = $this->request->getPost('id_detail_group_man_power_indirect_' . $i)[$j] ?? '';
        $data_detail_group_man_power_indirect = [
          'sub_bagian' => $sub_bagian,
          'group_mp' => $this->request->getPost('group_mp_indirect_' . $i)[$j],
          'mesin' => $this->request->getPost('mesin_indirect')[$j] ?? '',
          'nama' => $this->request->getPost('nama_indirect_' . $i)[$j] ?? '',
        ];
        $model->update_detail_data_group_man_power_indirect($id_detail_group_man_power_indirect, $data_detail_group_man_power_indirect);
      }
      $line = $this->request->getPost('line');
      for ($k=0; $k < count($line); $k++) { 
        $mesin = $this->request->getPost('mesin_' . $k);
        for ($j=0; $j < count($mesin); $j++) {
          $id_detail_group_man_power = $this->request->getPost('id_detail_group_man_power_' . $k . '_' . $i)[$j] ?? '';
          $data_detail_group_man_power = [
            'id_group' => $id_group,
            'group_mp' => $this->request->getPost('group_mp_' . $k . '_' . $i)[$j],
            'mesin' => $this->request->getPost('mesin_' . $k)[$j] ?? '',
            'nama' => $this->request->getPost('nama_' . $k . '_' . $i)[$j] ?? '',
            'line' => $this->request->getPost('line')[$k] ?? '',
          ];
          $model->update_detail_data_group_man_power($id_detail_group_man_power, $data_detail_group_man_power);
        }
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
