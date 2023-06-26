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
    if (count($temp_data_group_man_power) > 0) {
      foreach ($temp_data_group_man_power as $tdgmp) {
        $data['data_group_man_power'][$tdgmp['line']][$tdgmp['group_mp']][$tdgmp['mesin']] = $tdgmp;
      }
    } else
      $data['data_group_man_power'] = [];
    $temp_data_group_man_power_indirect = $this->M_DashboardManPower->get_data_group_man_power_indirect($sub_bagian);
    if (count($temp_data_group_man_power_indirect) > 0) {
      foreach ($temp_data_group_man_power_indirect as $tdgmpi) {
        $data['data_group_man_power_indirect'][$tdgmpi['group_mp']][$tdgmpi['mesin']] = $tdgmpi;
      }
    } else
      $data['data_group_man_power_indirect'] = [];
    $temp_data_group_man_power_kasubsie = $this->M_DashboardManPower->get_data_group_man_power_kasubsie($sub_bagian);
    if (count($temp_data_group_man_power_kasubsie) > 0) {
      foreach ($temp_data_group_man_power_kasubsie as $tdgmpk) {
        $data['data_group_man_power_kasubsie'][$tdgmpk['group_mp']][$tdgmpk['mesin']] = $tdgmpk;
      }
    } else
      $data['data_group_man_power_kasubsie'] = [];
    $temp_detail_record_man_power = $this->M_DashboardManPower->get_data_daily_record_man_power($sub_bagian, date('Y-m-d'), 1);
    if (count($temp_detail_record_man_power) > 0) {
      foreach ($temp_detail_record_man_power as $tdrmp) {
        $data['detail_record_man_power'][$tdrmp['line']][$tdrmp['group_mp']][$tdrmp['mesin']] = $tdrmp;
      }
    } else
      $data['detail_record_man_power'] = [];
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
    if ($line !== 'indirect') {
      $temp_data_group_man_power = $this->M_DashboardManPower->get_data_group_mp($sub_bagian, $line, $group_mp);
      if (count($temp_data_group_man_power) > 0) {
        foreach ($temp_data_group_man_power as $tdgmp) {
          $data['data_group_man_power'][$tdgmp['line']][$tdgmp['group_mp']][$tdgmp['mesin']] = $tdgmp;
        }
      } else
        $data['data_group_man_power'] = [];
      $data['data_mesin'] = $this->M_DashboardManPower->get_data_mesin($line);
    } else {
      $temp_data_group_man_power_indirect = $this->M_DashboardManPower->get_data_group_mp_indirect($sub_bagian, $group_mp);
      if (count($temp_data_group_man_power_indirect) > 0) {
        foreach ($temp_data_group_man_power_indirect as $tdgmpi) {
          $data['data_group_man_power_indirect'][$tdgmpi['group_mp']][$tdgmpi['mesin']] = $tdgmpi;
        }
      } else
        $data['data_group_man_power_indirect'] = [];
      $temp_data_group_man_power_kasubsie = $this->M_DashboardManPower->get_data_group_mp_kasubsie($sub_bagian, $group_mp);
      if (count($temp_data_group_man_power_kasubsie) > 0) {
        foreach ($temp_data_group_man_power_kasubsie as $tdgmpk) {
          $data['data_group_man_power_kasubsie'][$tdgmpk['group_mp']][$tdgmpk['mesin']] = $tdgmpk;
        }
      } else
        $data['data_group_man_power_kasubsie'] = [];
      $data['data_indirect'] = $this->M_DashboardManPower->get_data_indirect(str_replace('-', '_', $sub_bagian));
    }


    return json_encode($data);
  }

  public function get_detail_man_power()
  {
    $edit_man_power = $this->request->getPost('edit_man_power');
    $requirement = $this->request->getPost('requirement');
    $detail_man_power = $this->M_DashboardManPower->get_detail_man_power($edit_man_power, $requirement);
    return json_encode($detail_man_power);
  }

  public function get_data_detail_man_power()
  {
    $nama_man_power = $this->request->getPost('nama_man_power');
    $detail_man_power = $this->M_DashboardManPower->get_data_detail_man_power($nama_man_power);
    return json_encode($detail_man_power);
  }

  public function save_record_man_power()
  {
    $date = $this->request->getPost('date');
    $shift = $this->request->getPost('shift');
    $sub_bagian = $this->request->getPost('sub_bagian');
    $group_mp = $this->request->getPost('group_mp');
    $nama_mesin = $this->request->getPost('nama_mesin');
    $npk = $this->request->getPost('npk');
    $line = $this->request->getPost('line');
    $id_mp = [];
    $index_line = 0;
    foreach ($line as $ln) {
      for ($i = 0; $i < count($nama_mesin[$ln]); $i++) {
        $cek_record = $this->M_DashboardManPower->get_daily_record_man_power($sub_bagian, $date, $ln, $shift, $nama_mesin[$ln][$i]);
        if ($npk[$ln][$i] !== NULL)
          $id_mp = $this->M_DashboardManPower->get_data_mp($npk[$ln][$i]);
        if (count($id_mp) > 0) {
          $data_record_man_power = [
            'sub_bagian' => $sub_bagian,
            'tanggal' => $date,
            'line' => $ln,
            'shift' => $shift,
            'group_mp' => $group_mp[$index_line],
            'mesin' => $nama_mesin[$ln][$i],
            'nama' => $id_mp[0]['id_man_power']
          ];
        } else {
          $data_record_man_power = [
            'sub_bagian' => $sub_bagian,
            'tanggal' => $date,
            'line' => $ln,
            'shift' => $shift,
            'group_mp' => $group_mp[$index_line],
            'mesin' => $nama_mesin[$ln][$i],
          ];
        }
        $this->M_DashboardManPower->save_record_man_power($cek_record, $data_record_man_power);
      }
      $index_line++;
    }

    return json_encode('SUCCESS');
    // return redirect()->to('dashboard_man_power/' . $sub_bagian);
  }
}
