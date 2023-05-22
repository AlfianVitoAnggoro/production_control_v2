<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\M_RakManagement;

class RakManagement extends BaseController
{

    public function __construct()
    {
        $this->M_RakManagement = new M_RakManagement();
    }

    public function rak_dashboard()
    {
        $data['data_rak_management'] = $this->M_RakManagement->get_data_rak_management();
        return view('pages/rak_management/rak_dashboard', $data);
    }

    public function index()
    {
        for ($i = 65; $i <= 71; $i++) {
            $char = chr($i);
            $data['data_rak_management_gedung'][$char] = $this->M_RakManagement->get_data_rak_management_gedung($char);
        }

        $data['data_rak_management_status'] = $this->M_RakManagement->get_data_rak_management_status(1);
        $data['data_record_rak'] = $this->M_RakManagement->get_data_record_rak();
        $data['data_rak_management'] = $this->M_RakManagement->get_data_rak_management();
        return view('pages/rak_management/summary_rak_management', $data);
    }

    public function detail_rak_management($id_rak)
    {
        $data['id_rak'] = $id_rak;
        $data['data_record_rak'] = $this->M_RakManagement->get_data_record_rak();
        return view('pages/rak_management/detail_summary_rak_management', $data);
    }
}
