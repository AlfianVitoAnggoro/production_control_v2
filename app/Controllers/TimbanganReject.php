<?php

namespace App\Controllers;

use App\Models\M_TimbanganReject;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TimbanganReject extends BaseController
{
  public function __construct()
  {
    $this->M_TimbanganReject = new M_TimbanganReject();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function timbangan_reject_view()
  {
    $model = new M_TimbanganReject();
    $data['data_timbangan_reject'] = $model->get_all_lhp_timbangan_reject();
    return view('pages/timbangan_reject/timbangan_reject_view', $data);
  }

  // public function cos_add_view()
  // {
  //   return view('pages/cos/add_cos');
  // }

  public function save()
  {
    // $id = $this->request->getPost('id');
    $date = $this->request->getPost('date');
    $model = new M_TimbanganReject();
    $cek = $model->cek_lhp($date);
    if(count($cek) > 0) {
      $id_lhp_timbangan_reject = $cek[0]['id_lhp_timbangan_reject'];
      return redirect()->to(base_url('timbangan_reject/detail_timbangan_reject/' . $id_lhp_timbangan_reject));
    } else {
      $data_lhp_timbangan_reject = array(
        'tanggal' => $date,
      );
      $save_data = $model->save_timbangan_reject($data_lhp_timbangan_reject);
      return redirect()->to(base_url('timbangan_reject/detail_timbangan_reject/' . $save_data));
    }
  }

  function edit() {
    $id = $this->request->getPost('id');
    $id_detail_lhp_timbangan_reject = $this->request->getPost('id_detail_lhp_timbangan_reject');
    $date = $this->request->getPost('date');
    $total_plate = $this->request->getPost('total_plate');
    $total_battery = $this->request->getPost('total_battery');
    $shift_plate = $this->request->getPost('shift_plate');
    $berat_can_plate = $this->request->getPost('berat_can_plate');
    $berat_limbah_plate = $this->request->getPost('berat_limbah_plate');
    $original_plate = $this->request->getPost('original_plate');
    $shift_battery = $this->request->getPost('shift_battery');
    $berat_can_battery = $this->request->getPost('berat_can_battery');
    $berat_limbah_battery = $this->request->getPost('berat_limbah_battery');
    $original_battery = $this->request->getPost('original_battery');
    $id_detail_lhp_timbangan_reject_Exist = [];
    $model = new M_TimbanganReject();
    $all_id_detail_lhp_timbangan_reject = $model->get_id_detail_lhp_timbangan_reject_by_id_lhp_timbangan_reject($id);
    $data_lhp_timbangan_reject = array(
      'tanggal' => $date,
      'total_plate' => $total_plate == 'NaN' ? 0 : $total_plate,
      'total_battery' => $total_battery == 'NaN' ? 0 : $total_battery,
    );
    // for ($i=1; $i <= 3; $i++) { 
    //   $data[] = $this->request->getPost('status_plate_' . $i);
    // }
    $update_data = $model->update_lhp_timbangan_reject($id, $data_lhp_timbangan_reject);
    for($i = 0; $i < ($id_detail_lhp_timbangan_reject !== NULL ? count($id_detail_lhp_timbangan_reject) : 0); $i++) {
        if($id_detail_lhp_timbangan_reject[$i] !== "") {
          $id_detail_lhp_timbangan_reject_Exist[$id_detail_lhp_timbangan_reject[$i]] = $id_detail_lhp_timbangan_reject[$i];
        }
        $data_detail_lhp_timbangan_reject = array(
          'id_lhp_timbangan_reject' => $id,
          'shift_plate' => $shift_plate[$i] !== NULL ? $shift_plate[$i] : 0,
          'status_plate' => $this->request->getPost('status_plate_' . ($i + 1)),
          'berat_can_plate' => $berat_can_plate[$i] !== NULL ? $berat_can_plate[$i] : 0,
          'berat_limbah_plate' => $berat_limbah_plate[$i] !== NULL ? $berat_limbah_plate[$i] : 0,
          'original_plate' => $original_plate[$i] !== NULL ? $original_plate[$i] : 0,
          'shift_battery' => $shift_battery[$i] !== NULL ? $shift_battery[$i] : 0,
          'status_battery' => $this->request->getPost('status_battery_' . ($i + 1)),
          'berat_can_battery' => $berat_can_battery[$i] !== NULL ? $berat_can_battery[$i] : 0,
          'berat_limbah_battery' => $berat_limbah_battery[$i] !== NULL ? $berat_limbah_battery[$i] : 0,
          'original_battery' => $original_battery[$i] !== NULL ? $original_battery[$i] : 0,
        );
        $update_data = $model->update_detail_lhp_timbangan_reject($id_detail_lhp_timbangan_reject[$i], $data_detail_lhp_timbangan_reject);
    }
    // if(count($all_id_detail_lhp_timbangan_reject) > 0) {
    //   foreach ($all_id_detail_lhp_timbangan_reject as $idc) {
    //     if(!array_key_exists($idc['id_detail_lhp_timbangan_reject'], $id_detail_lhp_timbangan_reject_Exist)) {
    //       $model->delete_detail_lhp_timbangan_reject($idc['id_detail_lhp_timbangan_reject']);
    //     }
    //   }
    // }
    return redirect()->to(base_url('timbangan_reject/detail_timbangan_reject/' . $id));
  }

  // public function delete_timbangan_reject($id)
  // {
  //   $id = $this->request->getPost('id_lhp_timbangan_reject');

  //   $model = new M_TimbanganReject();

  //   $delete = $model->delete_lhp($id);

  //   if ($delete > 0) {
  //     $this->timbangan_reject_view();
  //   }
  // }

  public function detail_timbangan_reject($id)
  {
    $model = new M_TimbanganReject();
    $data['data_lhp_timbangan_reject'] = $model->get_lhp_timbangan_reject_by_id($id);
    $data['data_detail_lhp_timbangan_reject'] = $model->get_detail_lhp_timbangan_reject_by_id($id);
    return view('pages/timbangan_reject/detail_timbangan_reject', $data);
  }

  // public function update_cos()
  // {
  //   return redirect()->to(base_url('timbangan_reject/detail_timbangan_reject/' . $id_lhp_timbangan_reject));
  // }

  public function delete_timbangan_reject()
  {
    $id_lhp_timbangan_reject = $this->request->getPost('id');
    $model = new M_TimbanganReject();
    $model->delete_timbangan_reject($id_lhp_timbangan_reject);

    return redirect()->to(base_url('timbangan_reject'));
  }

  public function download()
  {
    // $date = $this->request->getPost('date');
    $start_date = $this->request->getPost('start_date');
    $end_date = $this->request->getPost('end_date');
    $model = new M_TimbanganReject();
    $data_timbangan_reject = $model->get_all_lhp_timbangan_reject_by_date($start_date, $end_date);
    if($data_timbangan_reject !== NULL) {
        foreach ($data_timbangan_reject as $dtr) {
          $data_detail_lhp_timbangan_reject[] = $model->get_all_detail_lhp_timbangan_reject_by_id_lhp_timbangan_reject($dtr['id_lhp_timbangan_reject']);
        }
        $dates = array_column($data_timbangan_reject, "tanggal");
        array_multisort($dates, SORT_ASC,  $data_timbangan_reject);
    }
    // Membuat objek Spreadsheet baru
    $spreadsheet = new Spreadsheet();

    // Menambahkan data ke worksheet
    $sheet = $spreadsheet->getActiveSheet();
    $data = array(
        array('', 'Reject Plate', '', '', '', 'Reject Battery', '', '', ''),
        array('Date', 'Shift', 'Berat Can', 'Berat Limbah', 'Original', 'Shift', 'Berat Can', 'Berat Limbah', 'Original'),
    );
    $isExist = [];
    if($data_timbangan_reject !== NULL) {
        // foreach ($data_timbangan_reject as $dtr) {
            foreach ($data_detail_lhp_timbangan_reject as $ddltr) {
                if($ddltr !== NULL) {
                  foreach ($ddltr as $dltr) {
                    // if ($dtr['id_lhp_timbangan_reject'] === $dltr['id_lhp_timbangan_reject']) {
                        $data[] = array($dltr['tanggal'], $dltr['shift_plate'], $dltr['berat_can_plate'], $dltr['berat_limbah_plate'], $dltr['original_plate'], $dltr['shift_battery'], $dltr['berat_can_battery'], $dltr['berat_limbah_battery'], $dltr['original_battery']);
                    // };
                  }
                }
            }
        // }
    }

    // Memasukkan data array ke dalam worksheet
    $sheet->fromArray($data);


    // Mengatur header respons HTTP
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data Laporan Timbangan Reject.xlsx"');
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // Membuat objek Writer untuk menulis spreadsheet ke output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
  }
}
