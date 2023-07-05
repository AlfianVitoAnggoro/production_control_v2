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
    $temp_detail_record_man_power_kasubsie = $this->M_DashboardManPower->get_data_daily_record_man_power_kasubsie($sub_bagian, date('Y-m-d'), 1);
    if (count($temp_detail_record_man_power_kasubsie) > 0) {
      foreach ($temp_detail_record_man_power_kasubsie as $tdrmpk) {
        $data['detail_record_man_power_kasubsie'][$tdrmpk['mesin']][$tdrmpk['group_mp']] = $tdrmpk;
      }
    } else
      $data['detail_record_man_power_kasubsie'] = [];
    $data['detail_record_man_power_indirect_all'] = $this->M_DashboardManPower->get_data_daily_record_man_power_indirect_all($sub_bagian, date('Y-m-d'), 1);
    $temp_detail_record_man_power_indirect = $this->M_DashboardManPower->get_data_daily_record_man_power_indirect($sub_bagian, date('Y-m-d'), 1);
    if (count($temp_detail_record_man_power_indirect) > 0) {
      foreach ($temp_detail_record_man_power_indirect as $tdrmpi) {
        $data['detail_record_man_power_indirect'][$tdrmpi['mesin']][$tdrmpi['group_mp']] = $tdrmpi;
      }
    } else
      $data['detail_record_man_power_indirect'] = [];
    $temp_data_mp_tidak_hadir = $this->M_DashboardManPower->get_data_mp_tidak_hadir($sub_bagian, date('Y-m-d'), 1);
    if (count($temp_data_mp_tidak_hadir) > 0) {
      foreach ($temp_data_mp_tidak_hadir as $tdmth) {
        $data['data_mp_tidak_hadir'][$tdmth['line']][] = $tdmth;
      }
    } else
      $data['data_mp_tidak_hadir'] = [];
    $temp_data_mp_tidak_hadir_indirect = $this->M_DashboardManPower->get_data_mp_tidak_hadir_indirect($sub_bagian, date('Y-m-d'), 1);
    if (count($temp_data_mp_tidak_hadir_indirect) > 0) {
      foreach ($temp_data_mp_tidak_hadir_indirect as $tdmth) {
        $data['data_mp_tidak_hadir_indirect'][] = $tdmth;
      }
    } else
      $data['data_mp_tidak_hadir_indirect'] = [];
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
    $mesin = $this->request->getPost('mesin');
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
      $temp_data_group_man_power_indirect = $this->M_DashboardManPower->get_data_group_mp_indirect($sub_bagian, $group_mp, $mesin);
      if (count($temp_data_group_man_power_indirect) > 0) {
        foreach ($temp_data_group_man_power_indirect as $tdgmpi) {
          $data['data_group_man_power_indirect'][$tdgmpi['mesin']][$tdgmpi['group_mp']] = $tdgmpi;
        }
      } else
        $data['data_group_man_power_indirect'] = [];
      $temp_data_group_man_power_kasubsie = $this->M_DashboardManPower->get_data_group_mp_kasubsie($sub_bagian, $group_mp, $mesin);
      if (count($temp_data_group_man_power_kasubsie) > 0) {
        foreach ($temp_data_group_man_power_kasubsie as $tdgmpk) {
          $data['data_group_man_power_kasubsie'][$tdgmpk['mesin']][$tdgmpk['group_mp']] = $tdgmpk;
        }
      } else
        $data['data_group_man_power_kasubsie'] = [];
      // $data['data_indirect'] = $this->M_DashboardManPower->get_data_indirect(str_replace('-', '_', $sub_bagian), $mesin);
    }


    return json_encode($data);
  }

  public function changeShift()
  {
    $sub_bagian = $this->request->getPost('sub_bagian');
    $date = $this->request->getPost('date');
    $shift = $this->request->getPost('shift');
    $line = $this->request->getPost('line');
    foreach ($line as $ln) {
      $data['data_mesin'][$ln] = $this->M_DashboardManPower->get_data_mesin($ln);
    }
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
        $data['data_group_man_power_indirect'][$tdgmpi['mesin']][$tdgmpi['group_mp']] = $tdgmpi;
      }
    } else
      $data['data_group_man_power_indirect'] = [];
    $temp_data_group_man_power_kasubsie = $this->M_DashboardManPower->get_data_group_man_power_kasubsie($sub_bagian);
    if (count($temp_data_group_man_power_kasubsie) > 0) {
      foreach ($temp_data_group_man_power_kasubsie as $tdgmpk) {
        $data['data_group_man_power_kasubsie'][$tdgmpk['mesin']][$tdgmpk['group_mp']] = $tdgmpk;
      }
    } else
      $data['data_group_man_power_kasubsie'] = [];
    $temp_detail_record_man_power = $this->M_DashboardManPower->get_data_daily_record_man_power($sub_bagian, $date, $shift);
    if (count($temp_detail_record_man_power) > 0) {
      foreach ($temp_detail_record_man_power as $tdrmp) {
        $data['detail_record_man_power'][$tdrmp['line']][$tdrmp['group_mp']][$tdrmp['mesin']] = $tdrmp;
      }
    } else
      $data['detail_record_man_power'] = [];
    $temp_detail_record_man_power_kasubsie = $this->M_DashboardManPower->get_data_daily_record_man_power_kasubsie($sub_bagian, $date, $shift);
    if (count($temp_detail_record_man_power_kasubsie) > 0) {
      foreach ($temp_detail_record_man_power_kasubsie as $tdrmpk) {
        $data['detail_record_man_power_kasubsie'][$tdrmpk['mesin']][$tdrmpk['group_mp']] = $tdrmpk;
      }
    } else
      $data['detail_record_man_power_kasubsie'] = [];
    $temp_detail_record_man_power_indirect = $this->M_DashboardManPower->get_data_daily_record_man_power_indirect($sub_bagian, $date, $shift);
    if (count($temp_detail_record_man_power_indirect) > 0) {
      foreach ($temp_detail_record_man_power_indirect as $tdrmpi) {
        $data['detail_record_man_power_indirect'][$tdrmpi['mesin']][$tdrmpi['group_mp']] = $tdrmpi;
      }
    } else
      $data['detail_record_man_power_indirect'] = [];
    $temp_data_mp_tidak_hadir = $this->M_DashboardManPower->get_data_mp_tidak_hadir($sub_bagian, $date, $shift);
    if (count($temp_data_mp_tidak_hadir) > 0) {
      foreach ($temp_data_mp_tidak_hadir as $tdmth) {
        $data['data_mp_tidak_hadir'][$tdmth['line']][] = $tdmth;
      }
    } else
      $data['data_mp_tidak_hadir'] = [];
    $temp_data_mp_tidak_hadir_indirect = $this->M_DashboardManPower->get_data_mp_tidak_hadir_indirect($sub_bagian, $date, $shift);
    if (count($temp_data_mp_tidak_hadir_indirect) > 0) {
      foreach ($temp_data_mp_tidak_hadir_indirect as $tdmth) {
        $data['data_mp_tidak_hadir_indirect'][] = $tdmth;
      }
    } else
      $data['data_mp_tidak_hadir_indirect'] = [];
    $data['data_indirect'] = $this->M_DashboardManPower->get_data_indirect(str_replace('-', '_', $sub_bagian));
    return json_encode($data);
    // return view('pages/dashboard_man_power/dashboard_man_power', $data);
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
    $status_mp = $this->request->getPost('status_mp');
    $line = $this->request->getPost('line');
    $group_mp_indirect = $this->request->getPost('group_mp_indirect');
    $nama_mesin_indirect = $this->request->getPost('nama_mesin_indirect');
    $npk_indirect = $this->request->getPost('npk_indirect');
    $status_mp_indirect = $this->request->getPost('status_mp_indirect');
    $nama_mp_tidak_hadir_indirect = $this->request->getPost('nama_mp_tidak_hadir_indirect');
    $id_mp = [];
    $id_mp_exists = [];
    $id_mp_exists_indirect = [];
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
            'nama' => $id_mp[0]['id_man_power'],
            'status' => $status_mp[$ln][$i]
          ];
        } else {
          $data_record_man_power = [
            'sub_bagian' => $sub_bagian,
            'tanggal' => $date,
            'line' => $ln,
            'shift' => $shift,
            'group_mp' => $group_mp[$index_line],
            'mesin' => $nama_mesin[$ln][$i],
            'nama' => NULL,
            'status' => $status_mp[$ln][$i]
          ];
        }
        $this->M_DashboardManPower->save_record_man_power($cek_record, $data_record_man_power);
      }
      for ($j = 0; $j < (array_key_exists($ln, $this->request->getPost('nama_mp_tidak_hadir')) ? count($this->request->getPost('nama_mp_tidak_hadir')[$ln]) : 0); $j++) {
        $id_record_cuti = $this->request->getPost('id_cuti_mp_tidak_hadir')[$ln][$j] ?? '';
        $data_mp_tidak_hadir = [
          'sub_bagian' => $sub_bagian,
          'tanggal' => $date,
          'line' => $ln,
          'shift' => $shift,
          'nama' => $this->request->getPost('nama_mp_tidak_hadir')[$ln][$j],
          'keterangan' => $this->request->getPost('keterangan_mp_tidak_hadir')[$ln][$j],
        ];
        $id_record_cuti_new = $this->M_DashboardManPower->save_record_man_power_tidak_hadir($id_record_cuti, $data_mp_tidak_hadir);
        $id_mp_exists[$id_record_cuti_new] = $id_record_cuti_new;
      }
      $index_line++;
    }
    $all_record_cuti = $this->M_DashboardManPower->get_data_mp_tidak_hadir($sub_bagian, $date, $shift);
    if (count($all_record_cuti) > 0) {
      if (count($id_mp_exists) > 0) {
        foreach ($all_record_cuti as $irc) {
          if (!array_key_exists($irc['id_cuti'], $id_mp_exists)) {
            $this->M_DashboardManPower->delete_mp_tidak_hadir_by_id(intval($irc['id_cuti']));
          }
        }
      } else {
        $this->M_DashboardManPower->delete_mp_tidak_hadir($sub_bagian, $date, $shift);
      }
    }
    for ($k = 0; $k < count($nama_mesin_indirect); $k++) {
      $cek_record_indirect = $this->M_DashboardManPower->get_daily_record_man_power_indirect($sub_bagian, $date, $shift, $nama_mesin_indirect[$k]);
      if ($npk_indirect[$k] !== NULL) {
        if (strpos($nama_mesin_indirect[$k], 'Kasubsie') === 0)
          $id_mp_indirect = $this->M_DashboardManPower->get_data_mp_kasubsie($npk_indirect[$k]);
        else
          $id_mp_indirect = $this->M_DashboardManPower->get_data_mp($npk_indirect[$k]);
      }
      if (count($id_mp_indirect) > 0) {
        $data_record_man_power_indirect = [
          'sub_bagian' => $sub_bagian,
          'tanggal' => $date,
          'shift' => $shift,
          'group_mp' => $group_mp_indirect[$k],
          'mesin' => $nama_mesin_indirect[$k],
          'nama' => $id_mp_indirect[0]['id_man_power'],
          'status' => $status_mp_indirect[$k],
        ];
      } else {
        $data_record_man_power_indirect = [
          'sub_bagian' => $sub_bagian,
          'tanggal' => $date,
          'shift' => $shift,
          'group_mp' => $group_mp_indirect[$k],
          'mesin' => $nama_mesin_indirect[$k],
          'nama' => NULL,
          'status' => $status_mp_indirect[$k],
        ];
      }
      $this->M_DashboardManPower->save_record_man_power_indirect($cek_record_indirect, $data_record_man_power_indirect);
    }

    for ($l = 0; $l < ($nama_mp_tidak_hadir_indirect !== NULL ? count($nama_mp_tidak_hadir_indirect) : 0); $l++) {
      $id_record_cuti_indirect = $this->request->getPost('id_cuti_mp_tidak_hadir_indirect')[$l] ?? '';
      $data_mp_tidak_hadir = [
        'sub_bagian' => $sub_bagian,
        'tanggal' => $date,
        'line' => $ln,
        'shift' => $shift,
        'nama' => $nama_mp_tidak_hadir_indirect[$l],
        'keterangan' => $this->request->getPost('keterangan_mp_tidak_hadir_indirect')[$l],
      ];
      $id_record_cuti_indirect_new = $this->M_DashboardManPower->save_record_man_power_tidak_hadir_indirect($id_record_cuti_indirect, $data_mp_tidak_hadir);
      $id_mp_exists_indirect[$id_record_cuti_indirect_new] = $id_record_cuti_indirect_new;
    }

    $all_record_cuti_indirect = $this->M_DashboardManPower->get_data_mp_tidak_hadir_indirect($sub_bagian, $date, $shift);
    if (count($all_record_cuti_indirect) > 0) {
      if (count($id_mp_exists_indirect) > 0) {
        foreach ($all_record_cuti_indirect as $irci) {
          if (!array_key_exists($irci['id_cuti'], $id_mp_exists_indirect)) {
            $this->M_DashboardManPower->delete_mp_tidak_hadir_indirect_by_id(intval($irci['id_cuti']));
          }
        }
      } else {
        $this->M_DashboardManPower->delete_mp_tidak_hadir_indirect($sub_bagian, $date, $shift);
      }
    }

    return json_encode('SUCCESS');
  }
}