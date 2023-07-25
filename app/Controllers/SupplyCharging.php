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

  public function list_supply($date = null, $sesi = null, $line = null)
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

    if ($line == null) {
      $line = 'all';
    }

    $data['tanggal'] = $date;
    $data['sesi'] = $sesi;
    $data['line'] = $line;
    $data['data_loading'] = $this->M_SupplyCharging->get_data_loading($date, $sesi, $line);
    
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

  public function add_data_supply_charging()
  {
    $id_lhp = $this->request->getPost('id_lhp');
    $no_wo = $this->request->getPost('no_wo');
    $part_number = $this->request->getPost('part_number');
    $estimasi_finish = $this->request->getPost('estimasi_finish');
    $tujuan = $this->request->getPost('tujuan');
    $qty = $this->request->getPost('qty');

    $waktu_estimasi_finish = date('H:i:s', strtotime($estimasi_finish));

    if ($waktu_estimasi_finish > '06:00:00' && $waktu_estimasi_finish <= '09:00:00') {
    $sesi = 1;
    } elseif ($waktu_estimasi_finish > '09:00:00' && $waktu_estimasi_finish <= '11:00:00') {
    $sesi = 2;
    } elseif ($waktu_estimasi_finish > '11:00:00' && $waktu_estimasi_finish <= '14:00:00') {
    $sesi = 3;
    } elseif ($waktu_estimasi_finish > '14:00:00' && $waktu_estimasi_finish <= '16:00:00') {
    $sesi = 4;
    } elseif ($waktu_estimasi_finish > '16:00:00' && $waktu_estimasi_finish <= '18:00:00') {
    $sesi = 5;
    } elseif ($waktu_estimasi_finish > '18:00:00' && $waktu_estimasi_finish <= '21:00:00') {
    $sesi = 6;
    } elseif ($waktu_estimasi_finish > '21:00:00' && $waktu_estimasi_finish <= '23:00:00') {
    $sesi = 7;
    } elseif ($waktu_estimasi_finish > '23:00:00' && $waktu_estimasi_finish <= '23:59:59') {
    $sesi = 8;
    } elseif ($waktu_estimasi_finish > '00:00:00' && $waktu_estimasi_finish <= '02:00:00') {
    $sesi = 8;
    } elseif ($waktu_estimasi_finish > '02:00:00' && $waktu_estimasi_finish <= '05:00:00') {
    $sesi = 9;
    } elseif ($waktu_estimasi_finish > '05:00:00' && $waktu_estimasi_finish <= '06:00:00') {
    $sesi = 10;
    }

    $data_supply_charging = [
    'id_lhp ' => $id_lhp,
    'no_wo' => $no_wo,
    'part_number' => $part_number,
    'start_charging' => date('Y-m-d H:i:s'),
    'estimasi_finish' => date('Y-m-d H:i:s', strtotime($estimasi_finish)),
    'sesi' => $sesi,
    'tujuan' => $tujuan,
    'qty' => $qty,
    'status' => 'open',
    ];

    $add_data_supply_charging = $this->M_SupplyCharging->add_data_supply_charging($no_wo, $data_supply_charging);

    echo json_encode($add_data_supply_charging);
  }

  public function uncheck_prepare_item()
  {
    $no_wo = $this->request->getPost('no_wo');
    $part_component = $this->request->getPost('item');

    $data = [
      'prepare_at' => NULL,
    ];

    $uncheck_prepare_item = $this->M_SupplyCharging->update_prepare_item($no_wo,$part_component,$data);

    echo json_encode($uncheck_prepare_item);
  }

  public function check_prepare_item()
  {
    date_default_timezone_set("Asia/Jakarta");

    $no_wo = $this->request->getPost('no_wo');
    $part_component = $this->request->getPost('item');
    $qty = $this->request->getPost('qty');

    $data = [
      'no_wo' => $no_wo,
      'PART_COMPONENT' => $part_component,
      'QTY' => $qty,
      'prepare_at' => date('Y-m-d H:i:s'),
    ];

    $check_prepare_item = $this->M_SupplyCharging->add_detail_supply_charging($no_wo,$part_component,$data);

    echo json_encode($check_prepare_item);
  }

  public function check_supply_item()
  {
    date_default_timezone_set("Asia/Jakarta");

    $no_wo = $this->request->getPost('no_wo');
    $part_component = $this->request->getPost('item');
    $qty = $this->request->getPost('qty');

    $data = [
      'no_wo' => $no_wo,
      'PART_COMPONENT' => $part_component,
      'QTY' => $qty,
      'supply_at' => date('Y-m-d H:i:s'),
    ];

    $check_supply_item = $this->M_SupplyCharging->add_detail_supply_charging($no_wo,$part_component,$data);

    echo json_encode($check_supply_item);
  }

  public function uncheck_supply_item()
  {
    $no_wo = $this->request->getPost('no_wo');
    $part_component = $this->request->getPost('item');

    $data = [
      'supply_at' => NULL,
    ];

    $uncheck_supply_item = $this->M_SupplyCharging->update_prepare_item($no_wo,$part_component,$data);

    echo json_encode($uncheck_supply_item);
  }

  public function update_status_supply()
  {
    date_default_timezone_set("Asia/Jakarta");

    $no_wo = $this->request->getPost('no_wo');
    $status = $this->request->getPost('status');

    if ($status == 'close') {
      $data = [
        'status' => $status,
        'closed_order' => date('Y-m-d H:i:s')
      ];
    } else {
      $data = [
        'status' => $status,
        'closed_order' => NULL
      ];
    }

    

    $update_status_supply = $this->M_SupplyCharging->update_status_supply($no_wo,$data);

    echo json_encode($update_status_supply);
  }

  // public function activity_supply($date = null, $sesi = null, $page = null)
  // {
  //   date_default_timezone_set("Asia/Jakarta");
    
  //   if ($date == null) {
  //     $date = date('Y-m-d');
  //   }

  //   if ($sesi == null) {
  //     $time_now = date('H:i:s');
  //     if ($time_now > '06:00:00' && $time_now <= '09:00:00') {
  //       $sesi = 1;
  //     } elseif ($time_now > '09:00:00' && $time_now <= '11:00:00') {
  //       $sesi = 2;  
  //     } elseif ($time_now > '11:00:00' && $time_now <= '14:00:00') {
  //       $sesi = 3;
  //     } elseif ($time_now > '14:00:00' && $time_now <= '16:00:00') {
  //       $sesi = 4;
  //     } elseif ($time_now > '16:00:00' && $time_now <= '18:00:00') {
  //       $sesi = 5;
  //     } elseif ($time_now > '18:00:00' && $time_now <= '21:00:00') {
  //       $sesi = 6;
  //     } elseif ($time_now > '21:00:00' && $time_now <= '23:00:00') {
  //       $sesi = 7;
  //     } elseif ($time_now > '23:00:00' && $time_now <= '23:59:59') {
  //       $sesi = 8;
  //     } elseif ($time_now > '00:00:00' && $time_now <= '02:00:00') {
  //       $sesi = 8;
  //     } elseif ($time_now > '02:00:00' && $time_now <= '05:00:00') {
  //       $sesi = 9;
  //     } elseif ($time_now > '05:00:00' && $time_now <= '06:00:00') {
  //       $sesi = 10;
  //     }
  //   }

  //   $data_loading = $this->M_SupplyCharging->get_data_loading($date, $sesi);

  //   $open = array_filter($data_loading, function ($var) {                                    
  //     return ($var['status'] == 'open');
  //   });
  //   $num = array_keys($open);

  //   if ($page == null) {
  //       if (!empty($num[0])) {
  //           $count = $num[0];
  //       } else {
  //           $count = 0;
  //       }            
  //   } else {
  //       $count = $page - 1;
  //   }

  //   $data['tanggal'] = $date;
  //   $data['sesi'] = $sesi;
    
  //   $list_supply = $this->M_SupplyCharging->get_data_loading();
  // }
}
