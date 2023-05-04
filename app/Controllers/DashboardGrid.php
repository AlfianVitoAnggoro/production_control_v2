<?php

namespace App\Controllers;

use App\Models\M_DashboardGrid;

class DashboardGrid extends BaseController
{
  public function __construct()
  {
    $this->M_DashboardGrid = new M_DashboardGrid();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    return view('dashboardGrid/home');
  }

  public function dashboard_lhp_grid()
  {
    date_default_timezone_set('Asia/Jakarta');
    $start = date('Y-m-01');
    $now = date('Y-m-d');
    $current_month = date('Y-m');
    $jenis_dashboard = $this->request->getPost('jenis_dashboard');
    $bulan = $this->request->getPost('bulan');
    if ($bulan == null) {
      $bulan = date('Y-m');
    }

    if ($bulan != null or $bulan != $current_month) {
      $start = date('Y-m-01', strtotime($bulan));
      $now = date('Y-m-t', strtotime($bulan));
    }
    $data['bulan'] = $bulan;
    $data_year = $this->M_DashboardGrid->get_data_all_by_year($bulan);
    $data['data_all_year'] = (!empty($data_year[0]['total_jks']) && !empty($data_year[0]['total_aktual'])) ? (float) number_format(($data_year[0]['total_aktual'] / $data_year[0]['total_jks']) * 100, 2, '.', '') : 0;
    $data['data_all_month'] = [];
    for ($i = 1; $i <= 12; $i++) {
      $data_all_month = $this->M_DashboardGrid->get_data_all_by_month($i, $bulan);
      if (!empty($data_all_month)) {
        foreach ($data_all_month as $d_all_month) {
          $total_jks = $d_all_month['total_jks'];
          $total_aktual = $d_all_month['total_aktual'];
          $eff = (!empty($total_jks) && !empty($total_aktual)) ? ($total_aktual / $total_jks) * 100 : 0;
          array_push($data['data_all_month'], (float) number_format($eff, 2, '.', ''));
        }
      } else {
        array_push($data['data_all_month'], 0);
      }
    }
    $data['data_all_date'] = [];
    while (strtotime($start) <= strtotime($now)) {
      $data_all = $this->M_DashboardGrid->get_data_all_by_date($start, $bulan);
      if (!empty($data_all)) {
        foreach ($data_all as $da) {
          $total_jks = $da['total_jks'];
          $total_aktual = $da['total_aktual'];
          $eff = (!empty($total_jks) && !empty($total_aktual)) ? ($total_aktual / $total_jks) * 100 : 0;
          array_push($data['data_all_date'], (float) number_format($eff, 2, '.', ''));
        }
      } else {
        array_push($data['data_all_date'], 0);
      }

      $start = date("Y-m-d", strtotime("+1 days", strtotime($start)));
    }

    $data['data_all_mp_by_current_month'] = [];
    $data_all_mp = $this->M_DashboardGrid->get_data_all_mp_by_current_month($bulan);
    if (!empty($data_all_mp)) {
      foreach ($data_all_mp as $damp) {
        if ($damp['operator_name'] !== NULL && $damp['operator_name'] !== 0) {
          if (array_key_exists($damp['operator_name'], $data['data_all_mp_by_current_month'])) {
            $data['data_all_mp_by_current_month'][$damp['operator_name']]['jks'] += $damp['jks'];
            $data['data_all_mp_by_current_month'][$damp['operator_name']]['actual'] += $damp['actual'];
            if ($damp['jks'] !== 0)
              $data['data_all_mp_by_current_month'][$damp['operator_name']]['persentase'] = number_format(($data['data_all_mp_by_current_month'][$damp['operator_name']]['actual'] / $data['data_all_mp_by_current_month'][$damp['operator_name']]['jks'] * 100), 2);
          } else {
            $data['data_all_mp_by_current_month'][$damp['operator_name']]['jks'] = $damp['jks'];
            $data['data_all_mp_by_current_month'][$damp['operator_name']]['actual'] = $damp['actual'];
            if ($damp['jks'] !== 0)
              $data['data_all_mp_by_current_month'][$damp['operator_name']]['persentase'] = number_format(($data['data_all_mp_by_current_month'][$damp['operator_name']]['actual'] / $data['data_all_mp_by_current_month'][$damp['operator_name']]['jks'] * 100), 2);
          }
        }
        // $jks = $damp['jks'];
        // $actual = $damp['actual'];
        // $eff = (!empty($jks) && !empty($actual)) ? ($actual / $jks) * 100 : 0;
        // array_push($data['data_all_mp_by_current_month'], (float) number_format($eff, 2, '.', ''));
      }
    }

    $data['data_all_mp_by_previous_month'] = [];
    $data_all_mp = $this->M_DashboardGrid->get_data_all_mp_by_previous_month($bulan);
    if (!empty($data_all_mp)) {
      foreach ($data_all_mp as $damp) {
        if ($damp['operator_name'] !== NULL && $damp['operator_name'] !== 0) {
          if (array_key_exists($damp['operator_name'], $data['data_all_mp_by_previous_month'])) {
            $data['data_all_mp_by_previous_month'][$damp['operator_name']]['jks'] += $damp['jks'];
            $data['data_all_mp_by_previous_month'][$damp['operator_name']]['actual'] += $damp['actual'];
            if ($damp['jks'] !== 0)
              $data['data_all_mp_by_previous_month'][$damp['operator_name']]['persentase'] = number_format(($data['data_all_mp_by_previous_month'][$damp['operator_name']]['actual'] / $data['data_all_mp_by_previous_month'][$damp['operator_name']]['jks'] * 100), 2);
          } else {
            $data['data_all_mp_by_previous_month'][$damp['operator_name']]['jks'] = $damp['jks'];
            $data['data_all_mp_by_previous_month'][$damp['operator_name']]['actual'] = $damp['actual'];
            if ($damp['jks'] !== 0)
              $data['data_all_mp_by_previous_month'][$damp['operator_name']]['persentase'] = number_format(($data['data_all_mp_by_previous_month'][$damp['operator_name']]['actual'] / $data['data_all_mp_by_previous_month'][$damp['operator_name']]['jks'] * 100), 2);
          }
        }
        // $jks = $damp['jks'];
        // $actual = $damp['actual'];
        // $eff = (!empty($jks) && !empty($actual)) ? ($actual / $jks) * 100 : 0;
        // array_push($data['data_all_mp_by_previous_month'], (float) number_format($eff, 2, '.', ''));
      }
    }

    $start = date('Y-m-01');
    $now = date('Y-m-d');
    if ($bulan != null or $bulan != $current_month) {
      $start = date('Y-m-01', strtotime($bulan));
      $now = date('Y-m-t', strtotime($bulan));
    }
    $data_by_grup = $this->M_DashboardGrid->get_data_grup($start);

    if (!empty($data_by_grup)) {
      while (strtotime($start) <= strtotime($now)) {
        foreach ($data_by_grup as $d_grup_grup) {
          $grup = $d_grup_grup['grup'];
          $data_all_grup = $this->M_DashboardGrid->get_data_by_grup($start, $grup);
          if (!empty($data_all_grup)) {
            foreach ($data_all_grup as $d_all_grup) {
              $total_jks_grup = $d_all_grup['total_jks'];
              $total_aktual_grup = $d_all_grup['total_aktual'];
              $eff = (!empty($total_jks_grup) && !empty($total_aktual_grup)) ? ($total_aktual_grup / $total_jks_grup) * 100 : 0;

              $data_grup = [
                'grup' => $grup,
                'data' => (float) number_format($eff, 2, '.', '')
              ];
              $data['data_all_date_group'][] = $data_grup;
            }
          } else {
            $data_grup = [
              'grup' => $grup,
              'data' => 0
            ];
            $data['data_all_date_group'][] = $data_grup;
          }
        }
        $start = date("Y-m-d", strtotime("+1 days", strtotime($start)));
      }
    } else {
      $data['data_all_date_group'] = 0;
    }

    // $data['data_current_month_group'] = [];
    // foreach ($data_by_grup as $d_by_grup) {
    //   $counter = 0;
    //   foreach ($data['data_all_date_group'] as $d_all_date_group) {
    //     if ($d_all_date_group['grup'] === $d_by_grup['grup']) {
    //       if (array_key_exists($d_by_grup['grup'], $data['data_current_month_group']))
    //         $data['data_current_month_group'][$d_by_grup['grup']] += $d_all_date_group['data'];
    //       else
    //         $data['data_current_month_group'][$d_by_grup['grup']] = $d_all_date_group['data'];
    //       if ($d_all_date_group['data'] !== 0)
    //         $counter += 1;
    //     }
    //   }
    //   $data['data_current_month_group'][$d_by_grup['grup']] = $data['data_current_month_group'][$d_by_grup['grup']] / $counter;
    // }

    $data['data_current_month_group'] = [];
    if (count($data_by_grup) > 0) {
      foreach ($data_by_grup as $d_by_grup) {
        $data_all_grup_current_month = $this->M_DashboardGrid->get_data_all_grup_by_current_month($bulan, $d_by_grup['grup']);
        if (count($data_all_grup_current_month) > 0) {
          foreach ($data_all_grup_current_month as $d_all_grup_current_month) {
            if ($d_all_grup_current_month['grup'] === $d_by_grup['grup']) {
              if (array_key_exists($d_by_grup['grup'], $data['data_current_month_group'])) {
                if ($d_all_grup_current_month['total_jks'] !== 0 && $d_all_grup_current_month['total_jks'] !== null && $d_all_grup_current_month['total_aktual'] !== 0 && $d_all_grup_current_month['total_aktual'] !== null) {
                  $data['data_current_month_group'][$d_by_grup['grup']]['total_jks'] += $d_all_grup_current_month['total_jks'];
                  $data['data_current_month_group'][$d_by_grup['grup']]['total_aktual'] += $d_all_grup_current_month['total_aktual'];
                  $data['data_current_month_group'][$d_by_grup['grup']]['persentase'] = $data['data_current_month_group'][$d_by_grup['grup']]['total_aktual'] / $data['data_current_month_group'][$d_by_grup['grup']]['total_jks'] * 100;
                }
              } else {
                if ($d_all_grup_current_month['total_jks'] !== 0 && $d_all_grup_current_month['total_jks'] !== null && $d_all_grup_current_month['total_aktual'] !== 0 && $d_all_grup_current_month['total_aktual'] !== null) {
                  $data['data_current_month_group'][$d_by_grup['grup']]['total_jks'] = $d_all_grup_current_month['total_jks'];
                  $data['data_current_month_group'][$d_by_grup['grup']]['total_aktual'] = $d_all_grup_current_month['total_aktual'];
                  $data['data_current_month_group'][$d_by_grup['grup']]['persentase'] = $data['data_current_month_group'][$d_by_grup['grup']]['total_aktual'] / $data['data_current_month_group'][$d_by_grup['grup']]['total_jks'] * 100;
                }
              }
            }
          }
        } else {
          $data['data_current_month_group'][$d_by_grup['grup']]['persentase'] = 0;
        }
      }
    } else {
      $data['data_current_month_group'] = 0;
    }
    $data_by_grup_previous_month = $this->M_DashboardGrid->get_data_grup(date('d-m-Y', strtotime($start . '- 1 month')));

    $data['data_previous_month_group'] = [];
    if (count($data_by_grup_previous_month) > 0) {
      foreach ($data_by_grup_previous_month as $d_by_grup) {

    $data['data_previous_month_group'] = [];
    if (count($data_by_grup) > 0) {
      foreach ($data_by_grup as $d_by_grup) {
        $data_all_grup_previous_month = $this->M_DashboardGrid->get_data_all_grup_by_previous_month($bulan, $d_by_grup['grup']);
        if (count($data_all_grup_previous_month) > 0) {
          foreach ($data_all_grup_previous_month as $d_all_grup_previous_month) {
            if ($d_all_grup_previous_month['grup'] === $d_by_grup['grup']) {
              if (array_key_exists($d_by_grup['grup'], $data['data_previous_month_group'])) {
                if ($d_all_grup_previous_month['total_jks'] !== 0 && $d_all_grup_previous_month['total_jks'] !== null && $d_all_grup_previous_month['total_aktual'] !== 0 && $d_all_grup_previous_month['total_aktual'] !== null) {
                  $data['data_previous_month_group'][$d_by_grup['grup']]['total_jks'] += $d_all_grup_previous_month['total_jks'];
                  $data['data_previous_month_group'][$d_by_grup['grup']]['total_aktual'] += $d_all_grup_previous_month['total_aktual'];
                  $data['data_previous_month_group'][$d_by_grup['grup']]['persentase'] = $data['data_previous_month_group'][$d_by_grup['grup']]['total_aktual'] / $data['data_previous_month_group'][$d_by_grup['grup']]['total_jks'] * 100;
                }
              } else {
                if ($d_all_grup_previous_month['total_jks'] !== 0 && $d_all_grup_previous_month['total_jks'] !== null && $d_all_grup_previous_month['total_aktual'] !== 0 && $d_all_grup_previous_month['total_aktual'] !== null) {
                  $data['data_previous_month_group'][$d_by_grup['grup']]['total_jks'] = $d_all_grup_previous_month['total_jks'];
                  $data['data_previous_month_group'][$d_by_grup['grup']]['total_aktual'] = $d_all_grup_previous_month['total_aktual'];
                  $data['data_previous_month_group'][$d_by_grup['grup']]['persentase'] = $data['data_previous_month_group'][$d_by_grup['grup']]['total_aktual'] / $data['data_previous_month_group'][$d_by_grup['grup']]['total_jks'] * 100;
                } else {
                  $data['data_previous_month_group'][$d_by_grup['grup']]['persentase'] = 0;
                }
              }
            }
          }
        } else {
          $data['data_previous_month_group'][$d_by_grup['grup']]['persentase'] = 0;
        }
      }
    } else {
      $data['data_previous_month_group'] = 0;
    }
  }
}


    return view('dashboardGrid/dashboard_lhp_grid', $data);
  }

  public function get_data_line_stop()
  {
    $tanggal = $this->request->getPost('date');

    $data = $this->M_DashboardGrid->get_data_line_stop($tanggal);
    echo json_encode($data);
  }
}
