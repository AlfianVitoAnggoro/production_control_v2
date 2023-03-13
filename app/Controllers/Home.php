<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\M_Data;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function lhp_view()
    {
        $model = new M_Data();
        $data['data_lhp'] = $model->get_all_lhp();

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

        $data = [
            'tanggal_produksi' => $tanggal_produksi,
            'line' => $line,
            'shift' => $shift,
            'grup' => $grup,
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti
        ];

        $model = new M_Data();
        $data['data_wo'] = $model->getDataWO($tanggal_produksi, $line);
        // $data['data_wo'] = [];
        $data['data_breakdown'] = $model->getListBreakdown();
        // var_dump($data['data_breakdown']); die;
        return view('pages/add_lhp', $data);
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

        $model = new M_Data();
        echo json_encode($model->getCT($part_no));
    }

    public function get_proses_breakdown()
    {
        $jenis_breakdown = $this->request->getPost('jenis_breakdown');

        $model = new M_Data();
        echo json_encode($model->getProsesBreakdown($jenis_breakdown));

    }

    public function save_lhp()
    {
        // var_dump($this->request->getPost('jenis_breakdown')); die;
        $data_lhp = [
            'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
            'line' => $this->request->getPost('line'),
            'shift' => $this->request->getPost('shift'),
            'grup' => $this->request->getPost('grup'),
            'mp' => $this->request->getPost('mp'),
            'absen' => $this->request->getPost('absen'),
            'cuti' => $this->request->getPost('cuti')
        ];

        // var_dump($data_lhp); die;

        $model = new M_Data();

        $save_data = $model->save_lhp($data_lhp);

        if ($save_data != '') {
            $total_data = count($this->request->getPost('part_number'));
            for ($i = 0; $i < $total_data; $i++) {
                if ($this->request->getPost('part_number')[$i] != '') {
                    $data_detail_lhp = [
                        'id_lhp_2' => $save_data,
                        'batch' => $this->request->getPost('batch')[$i],
                        'jam_start' => $this->request->getPost('start')[$i],
                        'jam_end' => $this->request->getPost('stop')[$i],
                        'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
                        'no_wo' => $this->request->getPost('no_wo')[$i],
                        'type_battery' => $this->request->getPost('part_number')[$i],
                        'ct' => $this->request->getPost('ct')[$i],
                        'plan_cap' => $this->request->getPost('plan_cap')[$i],
                        'actual' => $this->request->getPost('actual')[$i],
                        'act_vs_plan' => $this->request->getPost('act_vs_plan')[$i],
                        'efficiency_time' => $this->request->getPost('efficiency_time')[$i],
                        'total_menit_breakdown' => $this->request->getPost('total_menit_breakdown')[$i]
                    ];
                    $save_detail = $model->save_detail_lhp($data_detail_lhp);

                    if ($save_detail != '') {
                        $index_jenis_breakdown = $this->request->getPost('index_jenis_breakdown')[$i];
                        $total_breakdown = count($this->request->getPost('jenis_breakdown')[$index_jenis_breakdown]);
                        for ($j = 0; $j < $total_breakdown; $j++) {
                            if ($this->request->getPost('jenis_breakdown')[$index_jenis_breakdown][$j] != '') {
                                $data_breakdown = [
                                    'id_detail_lhp' => $save_detail,
                                    'no_wo' => $this->request->getPost('no_wo')[$i],
                                    'jenis_breakdown' => $this->request->getPost('jenis_breakdown')[$index_jenis_breakdown][$j],
                                    'proses_breakdown' => $this->request->getPost('proses_breakdown')[$index_jenis_breakdown][$j],
                                    'uraian_breakdown' => $this->request->getPost('uraian_breakdown')[$index_jenis_breakdown][$j],
                                    'menit_breakdown' => $this->request->getPost('menit_breakdown')[$index_jenis_breakdown][$j]
                                ];
                                $model->save_detail_breakdown($data_breakdown);
                            }
                        }
                    }
                }
            };
        }

        return redirect()->to(base_url('lhp'));
    }

    public function detail_lhp($id)
    {
        $model = new M_Data();
        $data['id_lhp'] = $id;
        $data['data_lhp'] = $model->get_lhp_by_id($id);
        $data['data_detail_lhp'] = $model->get_detail_lhp_by_id($id);
        $data['data_wo'] = $model->getDataWO($data['data_lhp'][0]['tanggal_produksi'], $data['data_lhp'][0]['line']);
        // $data['data_wo'] = [];

        $data['data_breakdown'] = $model->getListBreakdown();

        return view('pages/lhp_detail_view', $data);
    }

    public function update_lhp()
    {
        // var_dump($this->request->getPost('jenis_breakdown')); die;
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

        $model = new M_Data();

        $update_data = $model->update_lhp($id_lhp, $data_lhp);

        if ($update_data > 0) {
            $total_data = count($this->request->getPost('part_number'));
            for ($i = 0; $i < $total_data; $i++) {
                if ($this->request->getPost('part_number')[$i] != '') {
                    $id_detail_lhp = $this->request->getPost('id_detail_lhp')[$i];
                    $data_detail_lhp = [
                        'id_lhp_2' => $id_lhp,
                        'batch' => $this->request->getPost('batch')[$i],
                        'jam_start' => $this->request->getPost('start')[$i],
                        'jam_end' => $this->request->getPost('stop')[$i],
                        'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
                        // 'no_wo' => $this->request->getPost('no_wo')[$i],
                        'type_battery' => $this->request->getPost('part_number')[$i],
                        'ct' => $this->request->getPost('ct')[$i],
                        'plan_cap' => $this->request->getPost('plan_cap')[$i],
                        'actual' => $this->request->getPost('actual')[$i],
                        'act_vs_plan' => $this->request->getPost('act_vs_plan')[$i],
                        'efficiency_time' => $this->request->getPost('efficiency_time')[$i],
                        'total_menit_breakdown' => $this->request->getPost('total_menit_breakdown')[$i]
                    ];

                    $update_detail = $model->update_detail_lhp($id_detail_lhp, $data_detail_lhp);

                    if ($update_detail != 1 and $update_detail != 0) {
                        $total_breakdown = count($this->request->getPost('jenis_breakdown')[$i]);
                        print_r($total_breakdown);
                        for ($j = 0; $j < $total_breakdown; $j++) {
                            if ($this->request->getPost('jenis_breakdown')[$i][$j] != '') {
                                $data_breakdown = [
                                    'id_detail_lhp' => $update_detail,
                                    // 'no_wo' => $this->request->getPost('no_wo')[$i],
                                    'jenis_breakdown' => $this->request->getPost('jenis_breakdown')[$i][$j],
                                    'proses_breakdown' => $this->request->getPost('proses_breakdown')[$i][$j],
                                    'uraian_breakdown' => $this->request->getPost('uraian_breakdown')[$i][$j],
                                    'menit_breakdown' => $this->request->getPost('menit_breakdown')[$i][$j]
                                ];
                                $model->save_detail_breakdown($data_breakdown);
                                print_r($data_breakdown);
                            }
                        }
                    } 
                }
            }
        }

        return redirect()->route('detail_lhp', $id_lhp);
    }
                    
}
