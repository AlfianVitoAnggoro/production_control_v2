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

        // $data['data_rak_management_status'] = $this->M_RakManagement->get_data_rak_management_status(1);
        $data['data_rak_management_status'] = $this->M_RakManagement->count_rak_isi();
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

        $this-> reset_rak_pasting();

        return view('pages/rak_management/reset_rak_casting_pasting');
    }

    public function reset_rak_pasting()
    {
        $data_detail_rak_barcode = $this->M_RakManagement->get_data_record_rak_open();

        foreach ($data_detail_rak_barcode as $d_detail_rak_barcode) {
            $cek_data_wta = $this->M_RakManagement->get_data_wta_for_amb($d_detail_rak_barcode['barcode']);
            if (!empty($cek_data_wta)) {
                $data_update_rak = [
                    'wh_to' => $cek_data_wta[0]['T$WHTO'],
                    'close_time' => $cek_data_wta[0]['TANGGAL'],
                    'status' => 'close'
                ];

                $this->M_RakManagement->update_data_detail_rak($data_update_rak, $d_detail_rak_barcode['barcode']);

                $cek_status = $this->M_RakManagement->get_data_record_rak_by_id($d_detail_rak_barcode['pn_qr']);
                if (!empty($cek_status)) {
                    $data_update_rak = [
                        'status' => 1,
                        'current_position' => 'K-PAS'
                    ];
        
                    $this->M_RakManagement->update_data_rak($data_update_rak, $d_detail_rak_barcode['pn_qr']);
                } else {
                    $data_update_rak = [
                        'status' => 0,
                        'current_position' => $cek_data_wta[0]['T$WHTO']
                    ];
        
                    $this->M_RakManagement->update_data_rak($data_update_rak, $d_detail_rak_barcode['pn_qr']);
                }
            }
        }
    }

    public function force_close($rak, $barc) {
        $data_update_rak = [
            'close_time' => date('Y-m-d H:i:s'),
            'status' => 'force close'
        ];

        $this->M_RakManagement->update_data_detail_rak($data_update_rak, $barc);

        return redirect()->to(base_url('rak_management/detail_rak_management/'.$rak));
    }

    public function monitoring_aging_view()
    {
        $data['data_rak_aging'] = $this->M_RakManagement->get_data_rak_aging();
        return view('pages/monitoring_aging/monitoring_aging_view', $data);
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

    public function monitoring_barcode_casting()
    {
        $data1 = $this->M_RakManagement->get_data_record_rak();
        $data2 = $this->M_RakManagement->get_label_produksi_casting();
        $data3 = [];

        foreach ($data2 as $item) {
            $note = $item['T$NOTE'];
            $found = false;

            foreach ($data1 as $a) {
                if ($a['barcode'] === $note) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $data3[] = $item;
            }
        }

        $data['data_casting'] = $data3;

        $data_pasting = $this->M_RakManagement->get_label_produksi_pasting();
        $data_label_pasting = [];

        foreach ($data_pasting as $item2) {
            $note = $item2['T$NOTE'];
            $found2 = false;

            foreach ($data1 as $b) {
                if ($b['barcode'] === $note) {
                    $found2 = true;
                    break;
                }
            }

            if (!$found2) {
                $data_label_pasting[] = $item2;
            }
        }

        $data['data_pasting'] = $data_label_pasting;

        return view('pages/rak_management/monitoring_barcode_casting', $data);
    }

    public function cek_rak()
    {
        $rak = $this->request->getPost('rak');
        $data = $this->M_RakManagement->cek_rak($rak);

        echo json_encode($data);
    }
}
