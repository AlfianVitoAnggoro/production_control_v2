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

class Home extends BaseController
{
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
        // $model = new M_Data();
        // echo json_encode($model->getData());

        return view('pages/lhp_view');
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

        $data['shift'] = $shift;

        $model = new M_Data();
        $data['data_wo'] = $model->getDataWO($tanggal_produksi, $line);
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
}
