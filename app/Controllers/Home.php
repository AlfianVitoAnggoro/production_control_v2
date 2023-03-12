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

    public function fetch()
    {
        $model_data = model(M_Data::class);
        $result = $model_data->findAll();
        echo json_encode($result);
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
