<?php

namespace App\Controllers;

use App\Models\M_MonitoringCuring;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MonitoringCuring extends BaseController
{
  public function __construct()
  {
    $this->M_MonitoringCuring = new M_MonitoringCuring();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function monitoring_curing_view()
  {
    $model = new M_MonitoringCuring();
    $data['data_curing_B'] = [];
    $data['data_curing_E'] = [];

    $data_curing_B = $model->get_all_monitoring_curing('B');
    foreach ($data_curing_B as $dcb) {
      $data['data_curing_B'][$dcb['mesin']] = [
        'mesin' => $dcb['mesin'],
        'start' => $dcb['start'],
        'plan' => $dcb['plan_curing'],
        'act' => $dcb['act'],
      ];
    }
    $data_curing_E = $model->get_all_monitoring_curing('E');
    foreach ($data_curing_E as $dce) {
      $data['data_curing_E'][$dce['mesin']] = [
        'mesin' => $dce['mesin'],
        'start' => $dce['start'],
        'plan' => $dce['plan_curing'],
        'act' => $dce['act'],
      ];
    }
    // var_dump($data_curing_E); die;
    return view('dashboardCuring/dashboard_curing', $data);
  }
}
