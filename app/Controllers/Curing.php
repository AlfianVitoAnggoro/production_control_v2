<?php

namespace App\Controllers;

use App\Models\M_Curing;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Curing extends BaseController
{
  public function __construct()
  {
    $this->M_Curing = new M_Curing();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function curing_view()
  {
    $model = new M_Curing();
    $data_curing_B = $model->get_all_curing('B');
    $data['data_curing_B'] = [];
    foreach ($data_curing_B as $dcb) {
      $data['data_curing_B'][$dcb['mesin']] = [
        'id_curing' => $dcb['id_curing'],
        'mesin' => $dcb['mesin'],
        'act' => $dcb['act'],
      ];
    }

    $data_curing_E = $model->get_all_curing('E');
    $data['data_curing_E'] = [];
    foreach ($data_curing_E as $dce) {
      $data['data_curing_E'][$dce['mesin']] = [
        'id_curing' => $dce['id_curing'],
        'mesin' => $dce['mesin'],
        'act' => $dce['act'],
      ];
    }
    return view('pages/curing/curing_view', $data);
  }

  public function update_curing() {
    date_default_timezone_set('Asia/Jakarta');
    $id_curing = $this->request->getPost('id_curing');
    $mesin = $this->request->getPost('mesin');
    $gedung = $this->request->getPost('gedung');
    $start = NULL;
    $plan = NULL;
    $stop = NULL;
    if($this->request->getPost('start') !== NULL) {
      $start = date("Y-m-d H:i:s");
    }
    if($this->request->getPost('stop') !== NULL) {
      $stop = date("Y-m-d H:i:s");
    }
    $data = [];
    if($start !== NULL) {
      $jamTambah = '40 hours';
      $plan = date('Y-m-d H:i:s', strtotime($jamTambah, strtotime($start)));
      $data = [
        'mesin' => $mesin,
        'start' => $start,
        'plan_curing' => $plan,
        'gedung' => $gedung
      ];
    }
    if($stop !== NULL) {
      $data = [
        'act' => $stop,
      ];
    }

    $model = new M_Curing();
    $query = $model->update_curing($id_curing, $data);

    echo json_encode($query);
  }
}
