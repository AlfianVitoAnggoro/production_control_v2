<?php

namespace App\Controllers;

use App\Models\M_DashboardAssyRejection;

class DashboardAssyRejection extends BaseController
{
    public function __construct()
    {
        $this->M_DashboardAssyRejection = new M_DashboardAssyRejection();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('dashboard/home');
    }

    public function dashboard_reject_assy()
    {
        date_default_timezone_set('Asia/Jakarta');
        $start = date('Y-m-01');
        $now = date('Y-m-d');

        $current_month = date('Y-m');
        
        $jenis_dashboard = $this->request->getPost('jenis_dashboard');
        $parent_filter = $this->request->getPost('parent_filter');
        $child_filter = $this->request->getPost('child_filter');
        $baby_filter = $this->request->getPost('baby_filter');
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

        if ($baby_filter == null) {
            $baby_filter = 'average';
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
        $data['baby_filter'] = $baby_filter;
        $data['bulan'] = $bulan;

        // $total_data_reject_by_month = $this->M_DashboardAssyRejection->get_total_data_reject_by_month(idate('m',strtotime($bulan)));
        // $total_aktual_by_month = $this->M_DashboardAssyRejection->get_total_aktual_by_month(idate('m',strtotime($bulan)));
        $data_reject_by_month = $this->M_DashboardAssyRejection->get_data_reject_by_month(idate('m',strtotime($bulan)));

        // GET DATA REJECT BY MONTH
        $data['data_reject_by_month'] = [];
        $data['data_jenis_reject_by_month'] = [];
        $data['data_total_reject_by_month'] = [];

        // foreach ($data_reject_by_month as $d_reject_by_month) {
        //     $data_reject = [
        //         'name' => $d_reject_by_month['jenis_reject'],
        //         'y' => (float) number_format(((int) $d_reject_by_month['qty'] / (int) $total_aktual_by_month[0]['total_aktual']) * 100, 2, '.', ''),
        //     ];
            
        //     $data['data_reject_by_month'][] = $data_reject;
        // }

        foreach ($data_reject_by_month as $d_reject_by_month) {
            array_push($data['data_jenis_reject_by_month'], $d_reject_by_month['jenis_reject']);
            array_push($data['data_total_reject_by_month'], $d_reject_by_month['qty']);
        }

        // GET DATA REJECT BY DATE
        $data['data_reject_by_date'] = [];

        $data_jenis_reject = $this->M_DashboardAssyRejection->get_jenis_reject_by_month($start, $child_filter);

        if (!empty($data_jenis_reject)) {
            while (strtotime($start) <= strtotime($now)) {
                foreach ($data_jenis_reject as $d_jenis_reject) {
                    $data_jenis_reject_by_date = $this->M_DashboardAssyRejection->get_data_reject_by_date($start, $d_jenis_reject['jenis_reject'], $child_filter);
                    if (!empty($data_jenis_reject_by_date)) {
                        foreach ($data_jenis_reject_by_date as $d_jenis_reject_by_date) {
                            $data_reject = [
                                'name' => $d_jenis_reject_by_date['jenis_reject'],
                                'data' => (int) $d_jenis_reject_by_date['qty']
                            ];
                            
                            $data['data_reject_by_date'][] = $data_reject;
                        }
                    } else {
                        $data_reject = [
                            'name' => $d_jenis_reject['jenis_reject'],
                            'data' => 0
                        ];
                        
                        $data['data_reject_by_date'][] = $data_reject;
                    }
                }    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
            }
        }

        $data['data_reject_all_month'] = [];
        for ($i=1; $i <= 12; $i++) { 
            $data_all = $this->M_DashboardAssyRejection->get_data_rejection_by_month($i, $child_filter);
            if (!empty($data_all)) {
                foreach($data_all as $d_all) {
                    $total_reject = $d_all['total_reject'];
                    $total_aktual = $d_all['total_aktual'];
                    $eff = (!empty($total_reject) && !empty($total_aktual)) ? ($total_reject / $total_aktual) * 100 : 0;
                    array_push($data['data_reject_all_month'], (float) number_format($eff, 2, '.', ''));
                }
            } else {
                array_push($data['data_reject_all_month'], 0);
            }
        }
        

        // GET DATA PARETO REJECT BY LINE
        $data['data_reject_by_line'] = [];
        $data['data_total_reject_by_line'] = [];

        $data_line = $this->M_DashboardAssyRejection->get_data_total_reject_line_by_month($bulan);

        foreach ($data_line as $d_line) {
            array_push($data['data_reject_by_line'], 'Line '.$d_line['line']);
            array_push($data['data_total_reject_by_line'], (float) number_format($d_line['persen'], 2, '.', ''));
        }

        $data_year = $this->M_DashboardAssyRejection->get_year_to_date_rejection($child_filter);
        $data['data_all_year'] = (!empty($data_year[0]['total_reject']) && !empty($data_year[0]['total_aktual'])) ? (float) number_format(($data_year[0]['total_reject'] / $data_year[0]['total_aktual']) * 100, 2, '.', '') : 0;
        
        
        return view('dashboard/dashboard_lhp_assy_rejection', $data);

    }
}