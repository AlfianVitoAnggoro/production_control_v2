<?php

namespace App\Controllers;

use App\Models\M_CycleTime;

class CycleTime extends BaseController
{
    public function __construct()
    {
        $this->M_CycleTime = new M_CycleTime();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data['data_cycle_time'] = $this->M_CycleTime->get_data_cycle_time();
        return view('data_master/master_cycle_time/home', $data);
    }
}