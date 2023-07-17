<?php

namespace App\Controllers;

use App\Models\M_DashboardCuti;

class DashboardCuti extends BaseController
{
  public function __construct()
  {
    $this->M_DashboardCuti = new M_DashboardCuti();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_mp'] = '';
    return view('dashboardCuti/dashboard_cuti', $data);
  }

  public function get_record_cuti_by_month()
  {
    $month = $this->request->getPost('month');
    $year = $this->request->getPost('year');
    $temp_data_cuti = $this->M_DashboardCuti->get_record_cuti_by_month($month, $year);
    $data['data_cuti'] = $temp_data_cuti;
    if (count($temp_data_cuti) > 0) {
      foreach ($temp_data_cuti as $tdc) {
        if ($tdc['kategori'] === 'Cuti' || $tdc['kategori'] === 'Cuti Besar')
          $data['detail_cuti'][$tdc['tanggal_cuti']]['Cuti'][$tdc['nama']] = $tdc;
        else if ($tdc['kategori'] === 'Dispensasi')
          $data['detail_cuti'][$tdc['tanggal_cuti']]['Disp'][$tdc['nama']] = $tdc;
        else
          $data['detail_cuti'][$tdc['tanggal_cuti']][$tdc['kategori']][$tdc['nama']] = $tdc;
      }
    } else {
      $data['detail_cuti'] = [];
    }
    return json_encode($data);
  }

  public function get_record_cuti_by_day()
  {
    $day = $this->request->getPost('day');
    $month = $this->request->getPost('month');
    $year = $this->request->getPost('year');
    $temp_data_cuti = $this->M_DashboardCuti->get_record_cuti_by_day($day, $month, $year);
    $data['data_cuti'] = $temp_data_cuti;
    return json_encode($data);
  }
}
