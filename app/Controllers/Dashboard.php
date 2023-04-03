<?php

namespace App\Controllers;

use App\Models\M_Dashboard;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->M_Dashboard = new M_Dashboard();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('dashboard/home');
    }

    public function dashboard_lhp_assy()
    {
        date_default_timezone_set('Asia/Jakarta');
        $start = date('Y-m-01');
        $now = date('Y-m-d');

        $current_month = date('Y-m');

        $jenis_dashboard = $this->request->getPost('jenis_dashboard');
        $parent_filter = $this->request->getPost('parent_filter');
        $child_filter = $this->request->getPost('child_filter');
        $bulan = $this->request->getPost('bulan');

        if ($jenis_dashboard == null) {
            $jenis_dashboard = 1;
        }

        if ($parent_filter == null) {
            $parent_filter = 'line';
        }

        if ($child_filter == null) {
            $child_filter = 0;
        }

        if ($bulan == null) {
            $bulan = date('Y-m');
        }

        if ($bulan != null OR $bulan != $current_month) {
            $start = date('Y-m-01', strtotime($bulan));
            $now = date('Y-m-t', strtotime($bulan));
        }

        $data['jenis_dashboard'] = $jenis_dashboard;
        $data['parent_filter'] = $parent_filter;
        $data['child_filter'] = $child_filter;
        $data['bulan'] = $bulan;

        $data['data_line_1'] = [];
        $data['data_line_2'] = [];
        $data['data_line_3'] = [];
        $data['data_line_4'] = [];
        $data['data_line_5'] = [];
        $data['data_line_6'] = [];
        $data['data_line_7'] = [];

        $data['data_line_shift_1'] = [];
        $data['data_line_shift_2'] = [];
        $data['data_line_shift_3'] = [];

        if ($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter == null OR $child_filter == 0)) {
            while (strtotime($start) <= strtotime($now)) {
                $data1 = $this->M_Dashboard->get_data_all_line($start, 1);
                if (!empty($data1)) {
                    foreach ($data1 as $d1) {
                        $total_plan = $d1['total_plan'];
                        $total_aktual = $d1['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_1'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_1'], 0);
                }
    
                $data2 = $this->M_Dashboard->get_data_all_line($start, 2);
                if (!empty($data2)) {
                    foreach ($data2 as $d2) {
                        $total_plan = $d2['total_plan'];
                        $total_aktual = $d2['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_2'], (float) number_format($eff, 2, '.', ''));
                    }
                } else {
                    array_push($data['data_line_2'], 0);
                }
    
                $data3 = $this->M_Dashboard->get_data_all_line($start, 3);
                if (!empty($data3)) {
                    foreach ($data3 as $d3) {
                        $total_plan = $d3['total_plan'];
                        $total_aktual = $d3['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_3'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_3'], 0);
                }
    
                $data4 = $this->M_Dashboard->get_data_all_line($start, 4);
                if (!empty($data4)) {
                    foreach ($data4 as $d4) {
                        $total_plan = $d4['total_plan'];
                        $total_aktual = $d4['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_4'], (float) number_format($eff, 2, '.', ''));
                    }
                } else {
                    array_push($data['data_line_4'], 0);
                }
    
                $data5 = $this->M_Dashboard->get_data_all_line($start, 5);
                if (!empty($data5)) {
                    foreach ($data5 as $d5) {
                        $total_plan = $d5['total_plan'];
                        $total_aktual = $d5['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_5'], (float) number_format($eff, 2, '.', ''));
                    } 
                }else {
                    array_push($data['data_line_5'], 0);
                }
    
                $data6 = $this->M_Dashboard->get_data_all_line($start, 6);
                if (!empty($data6)) {
                    foreach ($data6 as $d6) {
                        $total_plan = $d6['total_plan'];
                        $total_aktual = $d6['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_6'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_6'], 0);
                }
    
                $data7 = $this->M_Dashboard->get_data_all_line($start, 7);
                if (!empty($data7)) {
                    foreach ($data7 as $d7) {
                        $total_plan = $d7['total_plan'];
                        $total_aktual = $d7['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_7'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_7'], 0);
                }
    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                
            }
        } else {
            while (strtotime($start) <= strtotime($now)) {
                $data1 = $this->M_Dashboard->get_data_line($start, $child_filter, 1);
                if (!empty($data1)) {
                    foreach ($data1 as $d1) {
                        $total_plan = $d1['total_plan'];
                        $total_aktual = $d1['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_shift_1'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_shift_1'], 0);
                }

                $data2 = $this->M_Dashboard->get_data_line($start, $child_filter, 2);
                if (!empty($data2)) {
                    foreach ($data2 as $d2) {
                        $total_plan = $d2['total_plan'];
                        $total_aktual = $d2['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_shift_2'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_shift_2'], 0);
                }

                $data3 = $this->M_Dashboard->get_data_line($start, $child_filter, 3);
                if (!empty($data3)) {
                    foreach ($data3 as $d3) {
                        $total_plan = $d3['total_plan'];
                        $total_aktual = $d3['total_aktual'];
                        $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                        array_push($data['data_line_shift_3'], (float) number_format($eff, 2, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_shift_3'], 0);
                }
    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                
            }
        }

        $data['data_all_month'] = [];
        for ($i=1; $i < 12; $i++) { 
            $data_all = $this->M_Dashboard->get_data_all_line_by_month($i);
            if (!empty($data_all)) {
                foreach($data_all as $d_all) {
                    $total_plan = $d_all['total_plan'];
                    $total_aktual = $d_all['total_aktual'];
                    $eff = (!empty($total_plan) && !empty($total_aktual)) ? ($total_aktual / $total_plan) * 100 : 0;
                    array_push($data['data_all_month'], (float) number_format($eff, 2, '.', ''));
                }
            } else {
                array_push($data['data_all_month'], 0);
            }
        }
        $data_year = $this->M_Dashboard->get_data_all_line_by_year();
        $data['data_all_year'] = (!empty($data_year[0]['total_plan']) && !empty($data_year[0]['total_aktual'])) ? (float) number_format(($data_year[0]['total_aktual'] / $data_year[0]['total_plan']) * 100, 2, '.', '') : 0;
        
        return view('dashboard/dashboard_lhp_assy', $data);
    }

    public function get_data_line_stop() {
        $tanggal = $this->request->getPost('date');
        $line = $this->request->getPost('line');

        $data = $this->M_Dashboard->get_data_line_stop($tanggal, $line);
        echo json_encode($data);
    }

    public function get_data_line_stop_by_shift() {
        $tanggal = $this->request->getPost('date');
        $line = $this->request->getPost('line');
        $shift = $this->request->getPost('shift');

        $data = $this->M_Dashboard->get_data_line_stop_by_shift($tanggal, $line, $shift);
        echo json_encode($data);
    }
}