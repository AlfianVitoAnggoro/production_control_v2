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

        $total_data_reject_by_month = $this->M_DashboardAssyRejection->get_total_data_reject_by_month(idate('m',strtotime($bulan)));
        $data_reject_by_month = $this->M_DashboardAssyRejection->get_data_reject_by_month(idate('m',strtotime($bulan)));

        // GET DATA REJECT BY MONTH
        $data['data_reject_by_month'] = [];

        foreach ($data_reject_by_month as $d_reject_by_month) {
            $data_reject = [
                'name' => $d_reject_by_month['jenis_reject'],
                'y' => (int) $d_reject_by_month['qty'] / (int) $total_data_reject_by_month[0],
            ];
            
            $data['data_reject_by_month'][] = $data_reject;
        }

        // GET DATA REJECT BY DATE
        $data['data_reject_by_date'] = [];
        $data_jenis_reject = $this->M_DashboardAssyRejection->get_jenis_reject_by_month($start);

        if (!empty($data_jenis_reject)) {
            while (strtotime($start) <= strtotime($now)) {
                foreach ($data_jenis_reject as $d_jenis_reject) {
                    $data_jenis_reject_by_date = $this->M_DashboardAssyRejection->get_data_reject_by_date($start, $d_jenis_reject['jenis_reject']);
                    if (!empty($data_jenis_reject_by_date)) {
                        foreach ($data_jenis_reject_by_date as $d_jenis_reject_by_date) {
                            $data_reject = [
                                'name' => $d_jenis_reject_by_date['jenis_reject'],
                                'data' => (int) $d_jenis_reject_by_date['qty'],
                            ];
                            
                            $data['data_reject_by_date'][] = $data_reject;
                        }
                    } else {
                        $data_reject = [
                            'name' => $d_jenis_reject['jenis_reject'],
                            'data' => 0,
                        ];
                        
                        $data['data_reject_by_date'][] = $data_reject;
                    }
                }    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
            }
        }
        
        return view('dashboard/dashboard_lhp_assy_rejection', $data);

    }
}