<?php

namespace App\Controllers;

use App\Models\M_SupplyCharging;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SupplyCharging extends BaseController
{
  public function __construct()
  {
    $this->M_SupplyCharging = new M_SupplyCharging();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function list_supply($date = null, $sesi = null)
  {
    date_default_timezone_set("Asia/Jakarta");
    
    if ($date == null) {
      $date = date('Y-m-d');
    }

    if ($sesi == null) {
      $time_now = date('H:i:s');
      if ($time_now > '06:00:00' && $time_now <= '09:00:00') {
        $sesi = 1;
      } elseif ($time_now > '09:00:00' && $time_now <= '11:00:00') {
        $sesi = 2;  
      } elseif ($time_now > '11:00:00' && $time_now <= '14:00:00') {
        $sesi = 3;
      } elseif ($time_now > '14:00:00' && $time_now <= '16:00:00') {
        $sesi = 4;
      } elseif ($time_now > '16:00:00' && $time_now <= '18:00:00') {
        $sesi = 5;
      } elseif ($time_now > '18:00:00' && $time_now <= '21:00:00') {
        $sesi = 6;
      } elseif ($time_now > '21:00:00' && $time_now <= '23:00:00') {
        $sesi = 7;
      } elseif ($time_now > '23:00:00' && $time_now <= '23:59:59') {
        $sesi = 8;
      } elseif ($time_now > '00:00:00' && $time_now <= '02:00:00') {
        $sesi = 8;
      } elseif ($time_now > '02:00:00' && $time_now <= '05:00:00') {
        $sesi = 9;
      } elseif ($time_now > '05:00:00' && $time_now <= '06:00:00') {
        $sesi = 10;
      }
    }

    $data['tanggal'] = $date;
    $data['sesi'] = $sesi;
    $data['data_loading'] = $this->M_SupplyCharging->get_data_loading($date, $sesi);
    return view('pages/supply_charging/list_supply_charging',$data);
  }

  public function get_component_by_wo()
  {
    $no_wo = $this->request->getPost('no_wo');
    $data = $this->M_SupplyCharging->get_component_by_wo($no_wo);
    echo json_encode($data);
  }

  public function add_detail_supply_charging()
  {
    $no_wo = $this->request->getPost('no_wo');
    $part_component = $this->request->getPost('part_component');
    $qty = $this->request->getPost('qty');
    $prepare = $this->request->getPost('status');

    for ($i=0; $i < count($part_component); $i++) { 
      $data = [
        'no_wo' => $no_wo[$i],
        'part_component' => $part_component[$i],
        'qty' => $qty[$i],
        'status' => (!empty($prepare[$i])) ? $prepare[$i] : 0,
      ];

      $this->M_SupplyCharging->add_detail_supply_charging($no_wo[$i],$part_component[$i],$data);
    }
  }
}
