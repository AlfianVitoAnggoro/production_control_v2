<?php

namespace App\Controllers;

use App\Models\M_DashboardManPower;

class DashboardManPower extends BaseController
{
  public function __construct()
  {
    $this->M_DashboardManPower = new M_DashboardManPower();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    // $tanggal = $this->request->getPost('tanggal');
    // $shift = $this->request->getPost('shift');
    // $line = $this->request->getPost('line');

    // $data['data_group_man_power'] = $this->M_DashboardManPower->get_data_group_man_power($tanggal, $shift, $line);
    return view('pages/dashboard_man_power/home');
  }

  public function dashboard($sub_bagian)
  {
    $data['sub_bagian'] = $sub_bagian;
    $temp_data_group_man_power = $this->M_DashboardManPower->get_data_group_man_power($sub_bagian);
    if(count($temp_data_group_man_power) > 0) {
      foreach ($temp_data_group_man_power as $tdgmp) {
        $data['data_group_man_power'][$tdgmp['line']][$tdgmp['group_mp']][$tdgmp['mesin']] = $tdgmp;
      }
    } else
      $data['data_group_man_power'] = [];
    $temp_data_group_man_power_indirect = $this->M_DashboardManPower->get_data_group_man_power_indirect($sub_bagian);
    if(count($temp_data_group_man_power_indirect) > 0) {
      foreach ($temp_data_group_man_power_indirect as $tdgmpi) {
        $data['data_group_man_power_indirect'][$tdgmpi['group_mp']][$tdgmpi['mesin']] = $tdgmpi;
      }
    } else
      $data['data_group_man_power_indirect'] = [];
    $temp_data_group_man_power_kasubsie = $this->M_DashboardManPower->get_data_group_man_power_kasubsie($sub_bagian);
    if(count($temp_data_group_man_power_kasubsie) > 0) {
      foreach ($temp_data_group_man_power_kasubsie as $tdgmpk) {
        $data['data_group_man_power_kasubsie'][$tdgmpk['group_mp']][$tdgmpk['mesin']] = $tdgmpk;
      }
    } else
      $data['data_group_man_power_kasubsie'] = [];
    return view('pages/dashboard_man_power/dashboard_man_power', $data);
  }

  public function detail_dashboard_man_power($id_group)
  {
    $data['data_group_man_power'] = $this->M_DashboardManPower->get_data_group_man_power_by_id($id_group);
    $temp_data_detail_group_man_power = $this->M_DashboardManPower->get_detail_data_master_group_man_power_by_id($id_group);
    $data['data_detail_group_man_power'] = [];
    foreach ($temp_data_detail_group_man_power as $t_ddgmp) {
        $data['data_detail_group_man_power'][$t_ddgmp['group_mp']][$t_ddgmp['mesin']] = $t_ddgmp;
    }
    return view('pages/dashboard_man_power/detail_dashboard_master_man_power', $data);
  }

  public function changeGroup()
  {
    $group_mp = $this->request->getPost('group_mp');
    $line = $this->request->getPost('line');
    $sub_bagian = $this->request->getPost('sub_bagian');
    if($line !== 'indirect') {
      $temp_data_group_man_power = $this->M_DashboardManPower->get_data_group_mp($sub_bagian, $line, $group_mp);
      if(count($temp_data_group_man_power) > 0) {
        foreach ($temp_data_group_man_power as $tdgmp) {
          $data['data_group_man_power'][$tdgmp['line']][$tdgmp['group_mp']][$tdgmp['mesin']] = $tdgmp;
        }
      } else
        $data['data_group_man_power'] = [];
      $data['data_mesin'] = $this->M_DashboardManPower->get_data_mesin($line);
    } else {
      $temp_data_group_man_power_indirect = $this->M_DashboardManPower->get_data_group_mp_indirect($sub_bagian, $group_mp);
      if(count($temp_data_group_man_power_indirect) > 0) {
        foreach ($temp_data_group_man_power_indirect as $tdgmpi) {
          $data['data_group_man_power_indirect'][$tdgmpi['group_mp']][$tdgmpi['mesin']] = $tdgmpi;
        }
      } else
        $data['data_group_man_power_indirect'] = [];
      $temp_data_group_man_power_kasubsie = $this->M_DashboardManPower->get_data_group_mp_kasubsie($sub_bagian, $group_mp);
      if(count($temp_data_group_man_power_kasubsie) > 0) {
        foreach ($temp_data_group_man_power_kasubsie as $tdgmpk) {
          $data['data_group_man_power_kasubsie'][$tdgmpk['group_mp']][$tdgmpk['mesin']] = $tdgmpk;
        }
      } else
        $data['data_group_man_power_kasubsie'] = [];
      $data['data_indirect'] = $this->M_DashboardManPower->get_data_indirect(str_replace('-', '_', $sub_bagian));
    }


    return json_encode($data);
  }

  public function get_detail_man_power() {
    $edit_man_power = $this->request->getPost('edit_man_power');
    $requirement = $this->request->getPost('requirement');
    $detail_man_power = $this->M_DashboardManPower->get_detail_man_power($edit_man_power, $requirement);
    return json_encode($detail_man_power);
  }

  public function get_data_detail_man_power() {
    $nama_man_power = $this->request->getPost('nama_man_power');
    $detail_man_power = $this->M_DashboardManPower->get_data_detail_man_power($nama_man_power);
    return json_encode($detail_man_power);
  }

  public function save_record_man_power() {
    $sub_bagian = $this->request->getPost('sub_bagian');
    return redirect()->to('dashboard_man_power/' . $sub_bagian);
  }
}
