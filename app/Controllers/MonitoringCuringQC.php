<?php

namespace App\Controllers;

use App\Models\M_MonitoringCuringQC;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MonitoringCuringQC extends BaseController
{
  public function __construct()
  {
    $this->M_MonitoringCuringQC = new M_MonitoringCuringQC();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function monitoring_curing_qc_view()
  {
    $model = new M_MonitoringCuringQC();
    $data['data_curing'] = $model->get_all_monitoring_curing_qc();
    return view('pages/monitoring_curing_qc/monitoring_curing_qc_view', $data);
  }

  public function update_curing()
  {
    $id_curing = $this->request->getPost('id_curing');
    $qc = $this->request->getPost('qc');
    if($qc === '')
      $qc = date("Y-m-d H:i:s");
    else
      $qc = NULL;
    $data = [
      'qc' => $qc
    ];
    
    $model = new M_MonitoringCuringQC();
    $query = $model->update_curing($id_curing, $data);

    echo json_encode($qc);
  }
}
