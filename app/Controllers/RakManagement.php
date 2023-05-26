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

    public function reset_rak_casting_to_pasting()
    {
        $data_detail_rak_barcode = $this->M_RakManagement->get_data_record_rak_open();

        foreach ($data_detail_rak_barcode as $d_detail_rak_barcode) {
            $cek_data_wta = $this->M_RakManagement->get_data_wta($d_detail_rak_barcode['barcode']);
            if (!empty($cek_data_wta)) {
                $data_update_rak = [
                    'close_time' => $cek_data_wta[0]['TANGGAL'],
                    'status' => 'close'
                ];

                $this->M_RakManagement->update_data_detail_rak($data_update_rak, $d_detail_rak_barcode['barcode']);
            }            
        }

        $data_rak = $this->M_RakManagement->get_data_rak_management_status(1);

        foreach ($data_rak as $d_rak) {
            $cek_status = $this->M_RakManagement->get_data_record_rak_by_id($d_rak['pn_qr']);
            if (!empty($cek_status)) {
                $data_update_rak = [
                    'status' => 1,
                    'current_position' => 'K-CAS'
                ];
    
                $this->M_RakManagement->update_data_rak($data_update_rak, $d_rak['pn_qr']);
            } else {
                $data_update_rak = [
                    'status' => 0,
                    'current_position' => 'K-PAS'
                ];
    
                $this->M_RakManagement->update_data_rak($data_update_rak, $d_rak['pn_qr']);
            }       
        }

        return view('pages/rak_management/reset_rak_casting_pasting');
    }

    // public function update_rak()
    // {
    //     $data_rak = $this->M_RakManagement->get_data_rak_management_status(1);

    //     foreach ($data_rak as $d_rak) {
    //         $cek_status = $this->M_RakManagement->get_data_record_rak_by_id($d_rak['pn_qr']);
    //         if (!empty($cek_status)) {
    //             $data_update_rak = [
    //                 'status' => 1,
    //                 'current_position' => 'K-CAS'
    //             ];
    
    //             $this->M_RakManagement->update_data_rak($data_update_rak, $d_rak['pn_qr']);
    //         } else {
    //             $data_update_rak = [
    //                 'status' => 0,
    //                 'current_position' => 'K-PAS'
    //             ];
    
    //             $this->M_RakManagement->update_data_rak($data_update_rak, $d_rak['pn_qr']);
    //         }       
    //     }
    // }
}
