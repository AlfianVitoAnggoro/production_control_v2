<?php

namespace App\Controllers;

use App\Models\M_Dashboard_npdt;

class Dashboard_npdt extends BaseController
{
    public function __construct()
    {
        $this->M_Dashboard = new M_Dashboard_npdt();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('dashboard/home');
    }

    public function index2()
    {
        return view('dashboard/dashboard_home');
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

        $data['data_all_line'] = [];
        $data['data_all_line_pcs'] = [];

        $data['data_line_1'] = [];
        $data['data_line_2'] = [];
        $data['data_line_3'] = [];
        $data['data_line_4'] = [];
        $data['data_line_5'] = [];
        $data['data_line_6'] = [];
        $data['data_line_7'] = [];

        $data['data_line_1_pcs'] = [];
        $data['data_line_2_pcs'] = [];
        $data['data_line_3_pcs'] = [];
        $data['data_line_4_pcs'] = [];
        $data['data_line_5_pcs'] = [];
        $data['data_line_6_pcs'] = [];
        $data['data_line_7_pcs'] = [];

        $data['data_by_month_line_1'] = [];
        $data['data_by_month_line_2'] = [];
        $data['data_by_month_line_3'] = [];
        $data['data_by_month_line_4'] = [];
        $data['data_by_month_line_5'] = [];
        $data['data_by_month_line_6'] = [];
        $data['data_by_month_line_7'] = [];

        $data['data_line_shift_1'] = [];
        $data['data_line_shift_2'] = [];
        $data['data_line_shift_3'] = [];

        $data['data_line_by_grup'] = [];
        $data['data_line_by_kss'] = [];

        $data['data_line_by_grup_month'] = [];

        if ($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter == null OR $child_filter == 0) AND $baby_filter == 'average') {
            while (strtotime($start) <= strtotime($now)) {
                $data_all = $this->M_Dashboard->get_data_all_line_by_date($start);
                if (!empty($data_all)) {
                    foreach ($data_all as $da) {
                        $total_loading_time = $da['total_loading_time'];
                        $total_line_stop = $da['total_line_stop'];
                        $total_aktual = $da['total_aktual'];
                        $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                        array_push($data['data_all_line'], (float) number_format($eff, 1, '.', ''));
                        array_push($data['data_all_line_pcs'], (int) $total_aktual);
                    } 
                } else {
                    array_push($data['data_all_line'], 0);
                    array_push($data['data_all_line_pcs'], 0);
                }
    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
            }
        } elseif ($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter == null OR $child_filter == 0) AND $baby_filter == 'line') {
            for ($h=1; $h <= 12; $h++) { 
                for ($i=1; $i <= 7; $i++) {
                    $data_all_line_by_month = $this->M_Dashboard->get_data_all_line_by_month($h, $i);
                    if (!empty($data_all_line_by_month)) {
                        foreach ($data_all_line_by_month as $dalm) {
                            $total_loading_time = $dalm['total_loading_time'];
                            $total_line_stop = $dalm['total_line_stop'];
                            $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                            array_push($data['data_by_month_line_'.$i], (float) number_format($eff, 1, '.', ''));
                        }
                    } else {
                        array_push($data['data_by_month_line_'.$i], 0);
                    }
                }
            }

            while (strtotime($start) <= strtotime($now)) {
                for ($i=1; $i <= 7; $i++) { 
                    $data1 = $this->M_Dashboard->get_data_all_line($start, $i);
                    if (!empty($data1)) {
                        foreach ($data1 as $d1) {
                            $total_loading_time = $d1['total_loading_time'];
                            $total_line_stop = $d1['total_line_stop'];
                            $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                            array_push($data['data_line_'.$i], (float) number_format($eff, 1, '.', ''));
                        } 
                    } else {
                        array_push($data['data_line_'.$i], 0);
                    }
                }
    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
            }
        } elseif($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter != null OR $child_filter != 0) AND $baby_filter != null AND $baby_filter == 'average') {
            while (strtotime($start) <= strtotime($now)) {
                $data1 = $this->M_Dashboard->get_data_all_line($start, $child_filter);
                if (!empty($data1)) {
                    foreach ($data1 as $d1) {
                        $total_loading_time = $d1['total_loading_time'];
                        $total_line_stop = $d1['total_line_stop'];
                        $total_aktual = $d1['total_aktual'];
                        $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                        array_push($data['data_line_'.$child_filter], (float) number_format($eff, 1, '.', ''));
                        array_push($data['data_line_'.$child_filter.'_pcs'], (int) $total_aktual);
                    } 
                } else {
                    array_push($data['data_line_'.$child_filter], 0);
                    array_push($data['data_line_'.$child_filter.'_pcs'], 0);

                }
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
            }
        } elseif($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter != null OR $child_filter != 0) AND $baby_filter != null AND $baby_filter == 'shift') {
            while (strtotime($start) <= strtotime($now)) {
                $data1 = $this->M_Dashboard->get_data_line($start, $child_filter, 1);
                if (!empty($data1)) {
                    foreach ($data1 as $d1) {
                        $total_loading_time = $d1['total_loading_time'];
                        $total_line_stop = $d1['total_line_stop'];
                        $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                        array_push($data['data_line_shift_1'], (float) number_format($eff, 1, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_shift_1'], 0);
                }

                $data2 = $this->M_Dashboard->get_data_line($start, $child_filter, 2);
                if (!empty($data2)) {
                    foreach ($data2 as $d2) {
                        $total_loading_time = $d2['total_loading_time'];
                        $total_line_stop = $d2['total_line_stop'];
                        $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                        array_push($data['data_line_shift_2'], (float) number_format($eff, 1, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_shift_2'], 0);
                }

                $data3 = $this->M_Dashboard->get_data_line($start, $child_filter, 3);
                if (!empty($data3)) {
                    foreach ($data3 as $d3) {
                        $total_loading_time = $d3['total_loading_time'];
                        $total_line_stop = $d3['total_line_stop'];
                        $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                        array_push($data['data_line_shift_3'], (float) number_format($eff, 1, '.', ''));
                    } 
                } else {
                    array_push($data['data_line_shift_3'], 0);
                }
    
                $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
            }
        } elseif($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter != null OR $child_filter != 0) AND $baby_filter != null AND $baby_filter == 'grup') {
            $data_grup_line = $this->M_Dashboard->get_data_grup_by_line($start, $child_filter);

            $data_grup_line_year = $this->M_Dashboard->get_data_grup_by_line_year($start, $child_filter);

            if (!empty($data_grup_line_year)) {
                for ($i=1; $i <= 12 ; $i++) { 
                    $total_loading_time_grup_month = 0;
                    $total_line_stop_grup_month = 0;
                    $eff = 0;
                    foreach ($data_grup_line_year as $d_grup_line) {
                        $grup_month = $d_grup_line['nama_pic'];
                        $data_all_grup_month = $this->M_Dashboard->get_data_line_by_grup_month($i, $child_filter, $grup_month);

                        $total_loading_time_grup_month = 0;
                        $total_line_stop_grup_month = 0;
                        $eff = 0;

                        if (!empty($data_all_grup_month)) {
                            foreach ($data_all_grup_month as $d_all_grup) {
                                $total_loading_time_grup_month += $d_all_grup['total_loading_time'];
                                $total_line_stop_grup_month += $d_all_grup['total_line_stop'];
                            } 
                        } else {
                            $total_loading_time_grup_month += 0;
                            $total_line_stop_grup_month += 0;
            
                        }

                        $eff = (!empty($total_loading_time_grup_month) && !empty($total_line_stop_grup_month)) ? (($total_loading_time_grup_month - $total_line_stop_grup_month) / $total_loading_time_grup_month) * 100 : 0;

                        $data_grup_month = [
                            'grup' => $grup_month,
                            'data' => (float) number_format($eff, 1, '.', '')
                        ];

                        $data['data_line_by_grup_month'][] = $data_grup_month;
                    }
                }
            }

            if (!empty($data_grup_line)) {
                    while (strtotime($start) <= strtotime($now)) {
                        foreach ($data_grup_line as $d_grup_line) {
                            $grup = $d_grup_line['nama_pic'];
                            $data_all_grup = $this->M_Dashboard->get_data_line_by_grup($start, $child_filter, $grup);
                            if (!empty($data_all_grup)) {
                                foreach ($data_all_grup as $d_all_grup) {
                                    $total_loading_time_grup = $d_all_grup['total_loading_time'];
                                    $total_line_stop_grup = $d_all_grup['total_line_stop'];
                                    $eff = (!empty($total_loading_time_grup) && !empty($total_line_stop_grup)) ? (($total_loading_time_grup - $total_line_stop_grup) / $total_loading_time_grup) * 100 : 0;
                
                                    $data_grup = [
                                        'grup' => $grup,
                                        'data' => (float) number_format($eff, 1, '.', '')
                                    ];
                                    $data['data_line_by_grup'][] = $data_grup;
                                } 
                            } else {
                                $data_grup = [
                                    'grup' => $grup,
                                    'data' => 0
                                ];
                                $data['data_line_by_grup'][] = $data_grup;
                
                            }
            
                        
                    }
                    $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                }
            }
        } elseif($jenis_dashboard == 1 AND ($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter != null OR $child_filter != 0) AND $baby_filter != null AND $baby_filter == 'kasubsie') {
            $data_kss_line = $this->M_Dashboard->get_data_kss_by_line($start, $child_filter);

            if (!empty($data_kss_line)) {
                    while (strtotime($start) <= strtotime($now)) {
                        foreach ($data_kss_line as $d_kss_line) {
                            $kss = $d_kss_line['kasubsie'];
                            $data_all_kss = $this->M_Dashboard->get_data_line_by_kss($start, $child_filter, $kss);
                            if (!empty($data_all_kss)) {
                                foreach ($data_all_kss as $d_all_kss) {
                                    $total_loading_time_kss = $d_all_kss['total_loading_time'];
                                    $total_line_stop_kss = $d_all_kss['total_line_stop'];
                                    $eff = (!empty($total_loading_time_kss) && !empty($total_line_stop_kss)) ? (($total_loading_time_kss - $total_line_stop_kss) / $total_loading_time_kss) * 100 : 0;
                
                                    $data_kss = [
                                        'kss' => $kss,
                                        'data' => (float) number_format($eff, 1, '.', '')
                                    ];
                                    $data['data_line_by_kss'][] = $data_kss;
                                } 
                            } else {
                                $data_kss = [
                                    'kss' => $kss,
                                    'data' => 0
                                ];
                                $data['data_line_by_kss'][] = $data_kss;
                
                            }
            
                        
                    }
                    $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                }
            }
        }

        $current_date = idate('m', strtotime($bulan));
        if ($current_date != 12) {
            $previous_date = $current_date - 1;
        } else {
            $previous_date = 12;
        }
        // VARIABLE DATA PER LINE UNTUK BULAN BERJALAN
        $data['data_line_1_current_month'] = [];
        $data['data_line_2_current_month'] = [];
        $data['data_line_3_current_month'] = [];
        $data['data_line_4_current_month'] = [];
        $data['data_line_5_current_month'] = [];
        $data['data_line_6_current_month'] = [];
        $data['data_line_7_current_month'] = [];

        //PUSH DATA PER LINE UNTUK BULAN BERJALAN
        for ($i=1; $i <= 7; $i++) { 
            $data_all = $this->M_Dashboard->get_data_all_line_by_month($current_date, $i);
            if (!empty($data_all)) {
                foreach($data_all as $d_all) {
                    $total_loading_time = $d_all['total_loading_time'];
                    $total_line_stop = $d_all['total_line_stop'];
                    $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                    array_push($data['data_line_'.$i.'_current_month'], (float) number_format($eff, 2, '.', ''));
                }
            } else {
                array_push($data['data_line_'.$i.'_current_month'], 0);
            }
        }

        // VARIABLE DATA PER LINE UNTUK BULAN SEBELUMNYA
        $data['data_line_1_previous_month'] = [];
        $data['data_line_2_previous_month'] = [];
        $data['data_line_3_previous_month'] = [];
        $data['data_line_4_previous_month'] = [];
        $data['data_line_5_previous_month'] = [];
        $data['data_line_6_previous_month'] = [];
        $data['data_line_7_previous_month'] = [];

        //PUSH DATA PER LINE UNTUK BULAN SEBELUMNYA
        for ($i=1; $i <= 7; $i++) { 
            $data_all = $this->M_Dashboard->get_data_all_line_by_month($previous_date, $i);
            if (!empty($data_all)) {
                foreach($data_all as $d_all) {
                    $total_loading_time = $d_all['total_loading_time'];
                    $total_line_stop = $d_all['total_line_stop'];
                    $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                    array_push($data['data_line_'.$i.'_previous_month'], (float) number_format($eff, 2, '.', ''));
                }
            } else {
                array_push($data['data_line_'.$i.'_previous_month'], 0);
            }
        }
        

        $data['data_all_month'] = [];
        for ($i=1; $i <= 12; $i++) { 
            $data_all = $this->M_Dashboard->get_data_all_line_by_month($i, $child_filter);
            if (!empty($data_all)) {
                foreach($data_all as $d_all) {
                    $total_loading_time = $d_all['total_loading_time'];
                    $total_line_stop = $d_all['total_line_stop'];
                    $eff = (!empty($total_loading_time) && !empty($total_line_stop)) ? (($total_loading_time - $total_line_stop) / $total_loading_time) * 100 : 0;
                    array_push($data['data_all_month'], (float) number_format($eff, 2, '.', ''));
                }
            } else {
                array_push($data['data_all_month'], 0);
            }
        }
        $data_year = $this->M_Dashboard->get_data_all_line_by_year($child_filter);
        $data['data_all_year'] = (!empty($data_year[0]['total_loading_time']) && !empty($data_year[0]['total_line_stop'])) ? (float) number_format((($data_year[0]['total_loading_time'] - $data_year[0]['total_line_stop']) / $data_year[0]['total_loading_time']) * 100, 2, '.', '') : 0;
        
        $arr_jam = ['08:50:00.0000000'
                    ,'09:50:00.0000000'
                    ,'11:00:00.0000000'
                    ,'12:00:00.0000000'
                    ,'14:00:00.0000000'
                    ,'15:00:00.0000000'
                    ,'16:15:00.0000000'
                    ,'16:30:00.0000000'
                    ,'17:50:00.0000000'
                    ,'19:35:00.0000000'
                    ,'20:35:00.0000000'
                    ,'21:35:00.0000000'
                    ,'22:45:00.0000000'
                    ,'23:45:00.0000000'
                    ,'00:30:00.0000000'
                    ,'01:50:00.0000000'
                    ,'02:50:00.0000000'
                    ,'03:50:00.0000000'
                    ,'05:20:00.0000000'
                    ,'06:20:00.0000000'
                    ,'07:30:00.0000000'
        ];

        $data['data_all_jam'] = [];
        // $tanggal_berjalan = date('Y-m-d', strtotime('2023-05-05'));
        $tanggal_berjalan = date('Y-m-d');
        foreach ($arr_jam as $jam) {
            $data_all = $this->M_Dashboard->get_data_all_line_by_jam($child_filter, $jam, $tanggal_berjalan);
            if (!empty($data_all)) {
                foreach($data_all as $d_all) {
                    $menit_terpakai = $d_all['menit_terpakai'];
                    $total_menit_breakdown = $d_all['total_menit_breakdown'];
                    $eff = (!empty($menit_terpakai) && !empty($total_menit_breakdown)) ? (($menit_terpakai - $total_menit_breakdown) / $total_menit_breakdown) * 100 : 0;
                    array_push($data['data_all_jam'], (float) number_format($eff, 2, '.', ''));
                }
            } else {
                array_push($data['data_all_jam'], 0);
            }
        }
        
        return view('dashboard/dashboard_lhp_assy_npdt', $data);
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

    public function get_data_line_stop_by_grup() {
        $tanggal = $this->request->getPost('date');
        $line = $this->request->getPost('line');
        $grup = $this->request->getPost('grup');

        $data = $this->M_Dashboard->get_data_line_stop_by_grup($tanggal, $line, $grup);
        echo json_encode($data);
    }

    public function get_data_line_stop_by_kss() {
        $tanggal = $this->request->getPost('date');
        $line = $this->request->getPost('line');
        $kss = $this->request->getPost('kss');

        $data = $this->M_Dashboard->get_data_line_stop_by_kss($tanggal, $line, $kss);
        echo json_encode($data);
    }
}