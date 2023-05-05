<?php

namespace App\Controllers;

use App\Models\DataGrup;
use App\Models\DetailLhpGrid;
use App\Models\Jks;
use App\Models\LhpGrid;
use CodeIgniter\Controller;
use App\Models\M_Data;
use App\Models\ProductionReport;
use App\Models\TypeGrid;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    public function __construct()
    {
        $this->M_Data = new M_Data();
        $this->session = \Config\Services::session();

        if($this->session->get('is_login')){
            return redirect()->to('login');
        }
    }
    public function test() {
        $model = new M_Data();
        $data = $model->test();
        return var_dump($data);
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function fetch_grid()
    {
        $type_grid = model(TypeGrid::class);
        $result = $type_grid->findAll();

        return $this->response->setJSON($result);
    }

    public function fetch_grup()
    {

        $type_grup = model(DataGrup::class);
        $result = $type_grup->findAll();

        return $this->response->setJSON($result);
    }

    public function fetch_jks()
    {
        $type_mesin = model(Jks::class);
        $result = $type_mesin->findAll();

        return $this->response->setJSON($result);
    }

    public function fetch_detail_grid()
    {
        $detail_lhp_grid = model(DetailLhpGrid::class);
        $result = $detail_lhp_grid->findAll();

        return $this->response->setJSON($result);
    }

    public function fetch_lhp_grid()
    {
        $lhp_grid = model(LhpGrid::class);
        $result = $lhp_grid->findAll();

        return $this->response->setJSON($result);
    }

    public function add_lhp_grid()
    {
        $data_lhp_grid = model(LhpGrid::class);
        $rules = [
            'date_production' => 'required',
            'line' => 'required',
            'shift' => 'required',
            'grup' => 'required',
            'mp' => 'required',
            'absen' => 'required',
            'cuti' => 'required',
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {
            $date_production = $this->request->getPost('date_production');
            $line = $this->request->getPost('line');
            $shift = $this->request->getPost('shift');
            $grup = $this->request->getPost('grup');
            $mp = $this->request->getPost('mp');
            $absen = $this->request->getPost('absen');
            $cuti = $this->request->getPost('cuti');

            // $data_lhp_grid->insert([
            //     'date_production' => $date_production,
            //     'line' => $line,
            //     'shift' => $shift,
            //     'grup' => $grup,
            //     'mp' => $mp,
            //     'absen' => $absen,
            //     'cuti' => $cuti,
            // ]);
            $data_lg = [
                'date_production' => $date_production,
                'line' => $line,
                'shift' => $shift,
                'grup' => $grup,
                'mp' => $mp,
                'absen' => $absen,
                'cuti' => $cuti,
            ];
            $data_lhp_grid->insert($data_lg);

            $id_lhp_grid =  $data_lhp_grid->getInsertID();



            $message = [
                'success' => true,
                'id_lhp_grid' => $id_lhp_grid,
                'notif' => '<div class="alert alert-success" role="alert">
                <strong>Tanggal</strong> telah disimpan.
                <button type="button" class="close mx-20 button-danger" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">❌</span></button>
            </div>'

            ];
        } else {
            $message = [
                'success' => false,
                'notif' => '<div class="alert alert-danger" role="alert">
                <strong>Tanggal</strong> gagal disimpan.
                <button type="button" class="close mx-20 button-danger" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">❌</span></button>
            </div>'
            ];
        }
        return $this->response->setJSON($message);
    }

    public function add_detail_grid()
    {
        $user  = model(DetailLhpGrid::class);
        $rules = [
            'id_lhp_grid' => 'required',
            'no_machine' => 'required',
            'operator_name' => 'required',
            // 'type_mesin' => 'required',
            'type_grid' => 'required',
            'jks' => 'required',
            'actual' => 'required',
            // 'kode_rak' => 'required',
        ];
        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {
            $id_lhp_grid = $this->request->getPost('id_lhp_grid');
            $no_machine = $this->request->getPost('no_machine');
            $operator_name = $this->request->getPost('operator_name');
            // $type_mesin = $this->request->getPost('type_mesin');
            $type_grid = $this->request->getPost('type_grid');
            $jks = $this->request->getPost('jks');
            $actual = $this->request->getPost('actual');
            $kode_rak = $this->request->getPost('kode_rak');
            for ($i = 0; $i < count($operator_name); $i++) {
                if ($operator_name[$i] != '') {
                    $data = [
                        'id_lhp_grid' => $id_lhp_grid[$i],
                        'operator_name' => $operator_name[$i],
                        'no_machine' => $no_machine[$i],
                        // 'type_mesin' => $type_mesin[$i],
                        'type_grid' => $type_grid[$i],
                        'jks' => $jks[$i],
                        'actual' => $actual[$i],
                        'kode_rak' => $kode_rak[$i],
                    ];
                    $user->insert($data);
                }
            }

            $message = [
                'success' => true,
                'notif' => '<div class="alert alert-success" role="alert">
                <strong>Success!</strong> Data has been saved.
                <button type="button" class="close mx-20 button-danger" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">❌</span></button>
            </div>'
            ];
        } else {
            $message = [
                'success' => false,
                'notif' => '<div class="alert alert-danger" role="alert">
                <strong>Failed!</strong> Data failed to save.
                <button type="button" class="close mx-20 button-danger" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">❌</span></button>
            </div>'
            ];
        }
        return $this->response->setJSON($message);
        // echo json_encode($data);
    }

    public function grid()
    {
        return view('pages/grid/grid_view');
    }

    public function lhp_view()
    {
        $model = new M_Data();
        $data['data_lhp'] = $model->get_all_lhp();
        $data['data_line'] = $model->get_line();
        $data['data_grup'] = $model->get_grup();

        return view('pages/lhp_view',$data);
    }

    public function lhp_add_view()
    {
        return view('pages/add_lhp');
    }

    public function add_lhp()
    {
        $tanggal_produksi = $this->request->getPost('tanggal_produksi');
        $line = $this->request->getPost('line');
        $shift = $this->request->getPost('shift');
        $grup = $this->request->getPost('grup');
        $mp = $this->request->getPost('mp');
        $absen = $this->request->getPost('absen');
        $cuti = $this->request->getPost('cuti');
        $kasubsie = $this->request->getPost('kasubsie');

        $model = new M_Data();
        $data_line = $model->get_data_line($line);
        $data_grup = $model->get_data_grup_pic($grup);

        $data = [
            'tanggal_produksi' => $tanggal_produksi,
            'id_line' => $line,
            'line' => $data_line[0]['nama_line'],
            'shift' => $shift,
            'id_pic' => $grup,
            'grup' => $data_grup[0]['nama_pic'],
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti,
            'kasubsie' => $kasubsie
        ];

        $data_lhp = [
            'tanggal_produksi' => $tanggal_produksi,
            'line' => $line,
            'shift' => $shift,
            'grup' => $grup,
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti,
            'kasubsie' => $kasubsie
        ];

        $data['data_wo'] = $model->getDataWO($tanggal_produksi, $line);
        // $data['data_wo'] = [];
        // $data['data_breakdown'] = $model->getListBreakdown();
        // var_dump($data['data_breakdown']); die;

        $cek = $model->cek_lhp($tanggal_produksi, $line, $shift, $grup);
        if (count($cek) > 0) {
            $id_lhp = $cek[0]['id_lhp_2'];
            return redirect()->to(base_url('lhp/detail_lhp/'.$id_lhp));
        } else {

            $save_data = $model->save_lhp($data_lhp);
            // var_dump($data); die;

            return redirect()->to(base_url('lhp/detail_lhp/'.$save_data));
        }
    }

    public function delete_lhp($id) {
        $id = $this->request->getPost('id');

        $model = new M_Data();

        $delete = $model->delete_lhp($id);

        if($delete > 0) {
           $this->lhp_view();
        }
    }

    public function getPartNo()
    {
        $no_wo = $this->request->getPost('no_wo');

        $model = new M_Data();
        echo json_encode($model->getPartNo($no_wo));
    }

    public function getCT()
    {
        $part_no = $this->request->getPost('part_number');
        // Split the string into an array using "-"
        $arr = explode("-", $part_no);

        // Remove the first two elements from the array
        $arr = array_slice($arr, 2);

        // Join the remaining elements back into a string using "-"
        $part_no = implode("-", $arr);

        $model = new M_Data();
        echo json_encode($model->getCT($part_no));
    }

    public function get_proses_breakdown()
    {
        $jenis_breakdown = $this->request->getPost('jenis_breakdown');

        $model = new M_Data();
        echo json_encode($model->getProsesBreakdown($jenis_breakdown));

    }

    public function get_kategori_reject()
    {
        $jenis_reject = $this->request->getPost('jenis_reject');

        $model = new M_Data();
        echo json_encode($model->getKategoriReject($jenis_reject));
    }

    // public function save_lhp()
    // {
    //     // var_dump($this->request->getPost('jenis_breakdown')); die;
    //     $data_lhp = [
    //         'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
    //         'line' => $this->request->getPost('id_line'),
    //         'shift' => $this->request->getPost('shift'),
    //         'grup' => $this->request->getPost('id_pic'),
    //         'mp' => $this->request->getPost('mp'),
    //         'absen' => $this->request->getPost('absen'),
    //         'cuti' => $this->request->getPost('cuti')
    //     ];

    //     // var_dump($data_lhp); die;

    //     $model = new M_Data();

    //     $save_data = $model->save_lhp($data_lhp);

    //     if ($save_data != '') {
    //         $total_data = count($this->request->getPost('part_number'));
    //         for ($i = 0; $i < $total_data; $i++) {
    //             if ($this->request->getPost('part_number')[$i] != '') {
    //                 $data_detail_lhp = [
    //                     'id_lhp_2' => $save_data,
    //                     'batch' => $this->request->getPost('batch')[$i],
    //                     'jam_start' => $this->request->getPost('start')[$i],
    //                     'jam_end' => $this->request->getPost('stop')[$i],
    //                     'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
    //                     'no_wo' => $this->request->getPost('no_wo')[$i],
    //                     'type_battery' => $this->request->getPost('part_number')[$i],
    //                     'ct' => $this->request->getPost('ct')[$i],
    //                     'plan_cap' => $this->request->getPost('plan_cap')[$i],
    //                     'actual' => $this->request->getPost('actual')[$i],
    //                     'act_vs_plan' => $this->request->getPost('act_vs_plan')[$i],
    //                     'efficiency_time' => $this->request->getPost('efficiency_time')[$i],
    //                     'total_menit_breakdown' => $this->request->getPost('total_menit_breakdown')[$i]
    //                 ];
    //                 $save_detail = $model->save_detail_lhp($data_detail_lhp);

    //                 if ($save_detail != '') {
    //                     $index_jenis_breakdown = $this->request->getPost('index_jenis_breakdown')[$i];

    //                     if ($this->request->getPost('jenis_breakdown') != null) {
    //                     $total_breakdown = count($this->request->getPost('jenis_breakdown')[$index_jenis_breakdown]);
    //                         for ($j = 0; $j < $total_breakdown; $j++) {
    //                             if ($this->request->getPost('jenis_breakdown')[$index_jenis_breakdown][$j] != '') {
    
    //                                 if ($this->request->getPost('jenis_breakdown')[$index_jenis_breakdown][$j] == 'ANDON') {
    //                                     $string_ticket = $this->request->getPost('proses_breakdown')[$index_jenis_breakdown][$j];
    //                                     $arr = explode("-", $string_ticket);
    //                                     $ticket = $arr[0];
    //                                     $proses_breakdown = $string_ticket;
    //                                 } else {
    //                                     $ticket = '';
    //                                     $proses_breakdown = $this->request->getPost('proses_breakdown')[$index_jenis_breakdown][$j];
    //                                 }
                                    
    //                                 $data_breakdown = [
    //                                     'id_detail_lhp' => $save_detail,
    //                                     'no_wo' => $this->request->getPost('no_wo')[$i],
    //                                     'jenis_breakdown' => $this->request->getPost('jenis_breakdown')[$index_jenis_breakdown][$j],
    //                                     'tiket_andon' => $ticket,
    //                                     'proses_breakdown' => $proses_breakdown,
    //                                     'uraian_breakdown' => $this->request->getPost('uraian_breakdown')[$index_jenis_breakdown][$j],
    //                                     'menit_breakdown' => $this->request->getPost('menit_breakdown')[$index_jenis_breakdown][$j]
    //                                 ];
    //                                 $model->save_detail_breakdown($data_breakdown);
    //                             }
    //                         }
    //                     }

    //                     if (!empty($this->request->getPost('jenis_reject')[$index_jenis_breakdown])) {

    //                         $total_rejection = count($this->request->getPost('jenis_reject')[$index_jenis_breakdown]);
                        
    //                         for ($j = 0; $j < $total_rejection; $j++) {
    //                             // print_r($this->request->getPost('jenis_breakdown')[$index_jenis_breakdown][$j]);
    //                             if ($this->request->getPost('jenis_reject')[$index_jenis_breakdown][$j] != '') {
        
    //                                 $id_reject = $this->request->getPost('id_reject')[$index_jenis_breakdown][$j];
        
    //                                 $data_reject = [
    //                                     'id_detail_lhp' => $save_detail,
    //                                     'no_wo' => $this->request->getPost('no_wo')[$i],
    //                                     'qty_reject' => $this->request->getPost('reject_qty')[$index_jenis_breakdown][$j],
    //                                     'jenis_reject' => $this->request->getPost('jenis_reject')[$index_jenis_breakdown][$j],
    //                                     'remark_reject' => $this->request->getPost('remark_reject')[$index_jenis_breakdown][$j]
    //                                 ];
    //                                 // var_dump ($data_reject);
    //                                 $model->save_detail_reject($data_reject);                                    
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         };
    //     }

    //     return redirect()->to(base_url('lhp/detail_lhp/'.$save_data));
    // }

    public function detail_lhp($id)
    {
        $model = new M_Data();
        $data['id_lhp'] = $id;
        $data['data_lhp'] = $model->get_lhp_by_id($id);
        $data['data_detail_lhp'] = $model->get_detail_lhp_by_id($id);
        $data['data_detail_breakdown'] = $model->get_detail_breakdown_by_id($id);
        $data['data_detail_reject'] = $model->get_detail_reject_by_id($id);

        $data['data_line'] = $model->get_data_line($data['data_lhp'][0]['line']);
        $data['data_grup'] = $model->get_data_grup_pic($data['data_lhp'][0]['grup']);

        $data['data_all_line'] = $model->get_line();
        $data['data_all_grup'] = $model->get_grup();

        $data['data_wo'] = $model->getDataWO($data['data_lhp'][0]['tanggal_produksi'], $data['data_lhp'][0]['line']);
        // $data['data_wo'] = [];

        $data['data_breakdown'] = $model->getListBreakdown();
        $data['data_reject'] = $model->getListReject();

        return view('pages/lhp_detail_view', $data);
    }

    public function update_lhp()
    {
        // var_dump($this->request->getPost('id_breakdown'));
        // var_dump($this->request->getPost('id_detail_lhp'));

        // die;
        $id_lhp = $this->request->getPost('id_lhp');

        $data_lhp = [
            'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
            'line' => $this->request->getPost('line'),
            'shift' => $this->request->getPost('shift'),
            'grup' => $this->request->getPost('grup'),
            'mp' => $this->request->getPost('mp'),
            'absen' => $this->request->getPost('absen'),
            'cuti' => $this->request->getPost('cuti')
        ];

        // var_dump($data_lhp);
        
        $model = new M_Data();

        $update_data = $model->update_lhp($id_lhp, $data_lhp);
        // var_dump($update_data);

        $total_plan = 0;
        $total_actual = 0;
        $total_line_stop = 0;
        $total_detail_line_stop = 0;
        $total_reject = 0;

        if ($update_data > 0) {
            if (!empty($this->request->getPost('no_wo'))) {
                $total_data = count($this->request->getPost('no_wo'));
                for ($i = 0; $i < $total_data; $i++) {
                    if ($this->request->getPost('no_wo')[$i] != '') {
                        $id_detail_lhp = $this->request->getPost('id_detail_lhp')[$i];
                        $data_detail_lhp = [
                            'id_lhp_2' => $id_lhp,
                            'batch' => $this->request->getPost('batch')[$i],
                            'jam_start' => $this->request->getPost('start')[$i],
                            'jam_end' => $this->request->getPost('stop')[$i],
                            'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
                            'no_wo' => $this->request->getPost('no_wo')[$i],
                            'type_battery' => $this->request->getPost('part_number')[$i],
                            'ct' => $this->request->getPost('ct')[$i],
                            'plan_cap' => $this->request->getPost('plan_cap')[$i],
                            'actual' => $this->request->getPost('actual')[$i],
                            // 'act_vs_plan' => $this->request->getPost('act_vs_plan')[$i],
                            // 'efficiency_time' => $this->request->getPost('efficiency_time')[$i],
                            'total_menit_breakdown' => $this->request->getPost('total_menit_breakdown')[$i]
                        ];

                        if ($this->request->getPost('actual')[$i] != null) {
                            $total_plan += $this->request->getPost('plan_cap')[$i];
                            $total_actual += $this->request->getPost('actual')[$i];
                        }

                        if ($this->request->getPost('total_menit_breakdown')[$i] != null) {
                            $total_line_stop += $this->request->getPost('total_menit_breakdown')[$i];
                        }

                        $update_detail = $model->update_detail_lhp($id_detail_lhp, $data_detail_lhp);
                    }
                }
            }
        }

        // var_dump($this->request->getPost('no_wo_breakdown')); die;

        $total_data_breakdown = $this->request->getPost('no_wo_breakdown');
        if (!empty($total_data_breakdown)) {
            for ($i=0; $i < count($total_data_breakdown); $i++) { 
                if ($this->request->getPost('jenis_breakdown')[$i] == 'ANDON') {
                    $string_ticket = $this->request->getPost('proses_breakdown')[$i];
                    $arr = explode("-", $string_ticket);
                    $ticket = $arr[0];
                    $proses_breakdown = $string_ticket;
                } else {
                    $ticket = '';
                    $proses_breakdown = $this->request->getPost('proses_breakdown')[$i];
                }

                $id_breakdown = $this->request->getPost('id_breakdown')[$i];

                $data_detail_breakdown = [
                    'id_lhp' => $id_lhp,
                    'jam_start' => $this->request->getPost('start_breakdown')[$i],
                    'jam_end' => $this->request->getPost('stop_breakdown')[$i],
                    'no_wo' => $this->request->getPost('no_wo_breakdown')[$i],
                    'type_battery' => $this->request->getPost('part_number_breakdown')[$i],
                    'jenis_breakdown' => $this->request->getPost('jenis_breakdown')[$i],
                    'tiket_andon' => $ticket,
                    'proses_breakdown' => $this->request->getPost('proses_breakdown')[$i],
                    'uraian_breakdown' => $this->request->getPost('uraian_breakdown')[$i],
                    'menit_breakdown' => $this->request->getPost('menit_breakdown')[$i]
                ];

                if ($this->request->getPost('menit_breakdown')[$i] != '') {
                    $total_detail_line_stop += (int) $this->request->getPost('menit_breakdown')[$i];
                }
    
                $model->save_detail_breakdown($id_breakdown, $data_detail_breakdown);
            } 
        }

        $total_data_reject = $this->request->getPost('no_wo_reject');

        if (!empty($total_data_reject)) {
            for ($i=0; $i < count($total_data_reject); $i++) { 
                $id_reject = $this->request->getPost('id_reject')[$i];

                $data_detail_reject = [
                    'id_lhp' => $id_lhp,
                    'no_wo' => $this->request->getPost('no_wo_reject')[$i],
                    'type_battery' => $this->request->getPost('part_number_reject')[$i],
                    'qty_reject' => $this->request->getPost('qty_reject')[$i],
                    'jenis_reject' => $this->request->getPost('jenis_reject')[$i],
                    'kategori_reject' => $this->request->getPost('kategori_reject')[$i],
                    'remark_reject' => $this->request->getPost('remark_reject')[$i]
                ];

                $total_reject += $this->request->getPost('qty_reject')[$i];
    
                $model->save_detail_reject($id_reject, $data_detail_reject);
            }
        }

        $data_detail = [
            'total_plan' => $total_plan,
            'total_aktual' => $total_actual,
            'total_line_stop' => $total_line_stop,
            'total_reject' => $total_reject
        ];

        $model->update_lhp($id_lhp, $data_detail);

        return redirect()->to(base_url('lhp/detail_lhp/'.$id_lhp));
    }

    public function get_data_andon() 
    {
        $tanggal_produksi = $this->request->getPost('tanggal_produksi');
        $line = $this->request->getPost('line');

        $model = new M_Data();
        $data = $model->get_data_andon($tanggal_produksi, $line);
        echo json_encode($data);
    }
    
    public function pilih_andon()
    {
        $id_ticket = $this->request->getPost('id_ticket');

        $model = new M_Data();
        $data = $model->pilih_andon($id_ticket);
        echo json_encode($data);
    }

    public function hapus_lhp($id_lhp)
    {
        $model = new M_Data();
        $model->hapus_lhp($id_lhp);

        return redirect()->to(base_url('lhp'));
    }

    public function delete_line_stop($id_line_stop, $id_lhp)
    {
        $model = new M_Data();
        $model->delete_line_stop($id_line_stop);

        return redirect()->to(base_url('lhp/detail_lhp/'.$id_lhp));
    }

    public function delete_reject($id_reject, $id_lhp)
    {
        $model = new M_Data();
        $model->delete_reject($id_reject);

        return redirect()->to(base_url('lhp/detail_lhp/'.$id_lhp));
    }

    public function download()
    {
        $date = $this->request->getPost('date');
        $month = date('F_Y', strtotime($date));
        $model = new M_Data();

        //data sheet lhp
        $data_lhp = $model->get_all_lhp_by_month($date);
        if($data_lhp !== NULL) {
            $dates = array_column($data_lhp, "tanggal_produksi");
            $lines = array_column($data_lhp, "line");
            $shift = array_column($data_lhp, "shift");
            array_multisort($dates, SORT_ASC, $shift, SORT_ASC, $lines, SORT_ASC,  $data_lhp);
            foreach ($data_lhp as $dl) {
                $data_detail_lhp[] = $model->get_all_detail_lhp_by_id_lhp($dl['id_lhp_2']);
            }
        }
        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Menambahkan data ke worksheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('LHP');
        $data = array(
            array('Date', 'Shift', 'Line', 'PIC', 'Kasubsie', 'Jam Start', 'Jam End', 'Menit Terpakai', 'No WO', 'Type Battery', 'CT', 'Plan Cap', 'Actual', 'Total Menit Line Stop'),
        );
        $isExist = [];
        if($data_lhp !== NULL) {
            foreach ($data_lhp as $dl) {
                foreach ($data_detail_lhp as $ddl) {
                    if($ddl !== NULL) {
                        foreach ($ddl as $dt_ddl) {
                            if ($dl['id_lhp_2'] === $ddl[0]['id_lhp_2']) {
                                $data[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie'], $dt_ddl['jam_start'], $dt_ddl['jam_end'], $dt_ddl['menit_terpakai'], $dt_ddl['no_wo'], $dt_ddl['type_battery'], $dt_ddl['ct'], $dt_ddl['plan_cap'], $dt_ddl['actual'], $dt_ddl['total_menit_breakdown']);
                            };
                        }
                    } else {
                        $data[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie']);
                    }
                }
            }
        }

        // Memasukkan data array ke dalam worksheet
        $sheet->fromArray($data);

        //data sheet line stop
        foreach ($data_lhp as $dl) {
            $data_detail_line_stop[] = $model->get_detail_breakdown_by_id($dl['id_lhp_2']);
        }

        // Menambahkan data ke worksheet
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Line Stop');   

        $data_line_stop = array(
            array('Date', 'Shift', 'Line', 'PIC', 'Kasubsie', 'Jam Start', 'Jam End', 'Menit Terpakai', 'No WO', 'Type Battery', 'Jenis Breakdown', 'Tiket Andon', 'Proses Breakdown', 'Uraian Breakdown', 'Menit Breakdown'),
        );
        $isExist = [];
        if($data_lhp !== NULL) {
            foreach ($data_lhp as $dl) {
                foreach ($data_detail_line_stop as $ddls) {
                    if($ddls !== NULL) {
                        foreach ($ddls as $dt_ddl) {
                            if ($dl['id_lhp_2'] === $dt_ddl['id_lhp']) {
                                $data_line_stop[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie'], $dt_ddl['jam_start'], $dt_ddl['jam_end'], $dt_ddl['menit_terpakai'], $dt_ddl['jam_start'], $dt_ddl['jam_end'], $dt_ddl['menit_terpakai'], $dt_ddl['no_wo'], $dt_ddl['type_battery'], $dt_ddl['jenis_breakdown'], $dt_ddl['tiket_andon'], $dt_ddl['proses_breakdown'], $dt_ddl['uraian_breakdown'], $dt_ddl['menit_breakdown']);
                            };
                        }
                    } else {
                        $data_line_stop[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie']);
                    }
                }
            }
        }

        // Memasukkan data array ke dalam worksheet
        $sheet2->fromArray($data_line_stop);


        // Mengatur header respons HTTP
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_lhp_assy_' . $month . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Membuat objek Writer untuk menulis spreadsheet ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
