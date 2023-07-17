<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\M_WideStrip;

class WideStrip extends BaseController
{

    public function __construct()
    {
        $this->M_WideStrip = new M_WideStrip();
    }

    public function index()
    {
        $data['data_lhp_wide_strip'] = $this->M_WideStrip->get_data_lhp_wide_strip();
        $data['data_grup_wide_strip'] = $this->M_WideStrip->get_data_grup_wide_strip();
        // $data['data_type_grid'] = $this->M_WideStrip->get_data_type_grid();
        return view('pages/wide_strip/home', $data);
    }

    public function add_lhp()
    {
        $tanggal_produksi = $this->request->getPost('tanggal_produksi');
        $shift = $this->request->getPost('shift');
        $kasubsie = $this->request->getPost('kasubsie');
        $grup = $this->request->getPost('grup');
        $type_grid = $this->request->getPost('type_grid');
        $mp = $this->request->getPost('mp');
        $absen = $this->request->getPost('absen');
        $cuti = $this->request->getPost('cuti');

        $data = [
            'tanggal_produksi' => $tanggal_produksi,
            'shift' => $shift,
            'kasubsie' => $kasubsie,
            'grup' => $grup,
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti,
        ];

        $data_save = [
            'tanggal_produksi' => $tanggal_produksi,
            'shift' => $shift,
            'kasubsie' => $kasubsie,
            'grup' => $grup,
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti,
            // 'status' => 'waiting'
        ];
        
        $model = new M_WideStrip();
        $cek = $model->cek_lhp($tanggal_produksi, $shift, $kasubsie, $grup);
        if (count($cek) > 0) {
            $id = $cek[0]['id_lhp_ws'];
            return redirect()->to(base_url('wide_strip/detail_lhp/' . $id));
        } else {
            $save_data = $this->M_WideStrip->add_lhp($data_save);
            return redirect()->to(base_url('wide_strip/detail_lhp/' . $save_data));
        }
    }

    public function detail_lhp($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_WideStrip->get_data_lhp_wide_strip_by_id($id_lhp);
        $data['data_detail_lhp'] = $this->M_WideStrip->get_detail_wide_strip_by_id($id_lhp);
        $data['data_material_in'] = $this->M_WideStrip->get_data_material_in_by_id($id_lhp);
        $data['data_material_in_mlr'] = $this->M_WideStrip->get_data_material_in_mlr_by_id($id_lhp);
        $data['data_level_melting_pot'] = $this->M_WideStrip->get_data_level_melting_pot_by_id($id_lhp);
        $data['data_mesin'] = $this->M_WideStrip->get_data_mesin_grid();
        $data['data_operator'] = $this->M_WideStrip->get_data_operator_grid();
        $data['data_coil_code'] = $this->M_WideStrip->get_data_coil_code();
        // $data['data_type_grid'] = $this->M_WideStrip->get_data_type_grid();
        $data['data_breakdown'] = $this->M_WideStrip->get_data_breakdown($id_lhp);
        $data['data_line_stop_ws'] = $this->M_WideStrip->getListKategoriLineStopWS($id_lhp);
        $data['output_product'] = $this->M_WideStrip->get_output_product($id_lhp);
        // $data['data_andon'] = $this->M_WideStrip->get_data_andon_by_id($id_lhp);
        $data['data_record_rak'] = $this->M_WideStrip->get_id_data_detail_record_rak_by_id($id_lhp, 'K-PUN', 'K-PUN');
        // $data['data_all_rak'] = $this->M_WideStrip->get_data_rak_by_id($id_lhp);
        $session = \Config\Services::session();
        $data['session'] = $session->get('level');
        return view('pages/wide_strip/detail_wide_strip', $data);
    }

    public function update_lhp()
    {
        // var_dump($this->request->getPost()); die;
        $id_lhp = $this->request->getPost('id_lhp');

        $approved = $this->request->getPost('approved');
        $completed = $this->request->getPost('completed');

        $total_data = $this->request->getPost('no');
        for ($i = 0; $i < count($total_data); $i++) {
            $id_level_melting_pot = $this->request->getPost('id_level_melting_pot')[$i];
            $data = [
                'id_lhp_ws' => $id_lhp,
                'no' => $this->request->getPost('no')[$i],
                'melting_pot' => $this->request->getPost('melting_pot')[$i],
                'awal_shift' => $this->request->getPost('awal_shift')[$i],
                'akhir_shift' => $this->request->getPost('akhir_shift')[$i],
            ];

            $save_data_level_melting_pot = $this->M_WideStrip->update_level_melting_pot($id_level_melting_pot, $data);
        }

        $total_plan = 0;
        $total_actual = 0;
        $total_total_stop = 0;
        $total_data = $this->request->getPost('batch');
        for ($i = 0; $i < count($total_data); $i++) {
            $id_detail_lhp_wide_strip = $this->request->getPost('id_detail_lhp_wide_strip')[$i];
            $data = [
                'id_lhp_ws' => $id_lhp,
                'batch' => $this->request->getPost('batch')[$i],
                'jam_start' => $this->request->getPost('start')[$i],
                'jam_end' => $this->request->getPost('stop')[$i],
                'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
                'coil_code' => $this->request->getPost('coil_code')[$i],
                'type_wist' => $this->request->getPost('type_wist')[$i],
                'ct' => $this->request->getPost('ct')[$i],
                'plan_ws' => $this->request->getPost('plan')[$i],
                'actual' => $this->request->getPost('actual')[$i],
                'total_stop' => $this->request->getPost('total_stop')[$i],
            ];
            
            if ($this->request->getPost('actual')[$i] != null) {
                $total_plan += (int) $this->request->getPost('plan')[$i];
                $total_actual += (int) $this->request->getPost('actual')[$i];
                $total_total_stop += (int) $this->request->getPost('total_stop')[$i];
            }

            $save_data = $this->M_WideStrip->update_lhp($id_detail_lhp_wide_strip, $data);
        }

        $total_data_line_stop = $this->request->getPost('coil_code_line_stop');
        $model = new M_WideStrip();
        $data_detail_line_stop = $model->get_data_breakdown($id_lhp);
        $id_breakdown_exist = [];
        $total_breakdown = 0;
        if (!empty($total_data_line_stop)) {
            for ($i = 0; $i < count($total_data_line_stop); $i++) {
                if ($this->request->getPost('jenis_line_stop') !== NULL && array_key_exists($i, $this->request->getPost('jenis_line_stop'))) {
                    $id_breakdown = $this->request->getPost('id_breakdown')[$i];
                    if($id_breakdown !== "") {
                        $id_breakdown_exist[$id_breakdown] = $id_breakdown;
                    }
                    $id_detail_lhp_breakdown = $this->request->getPost('id_detail_lhp_breakdown')[$i];
                    $data_breakdown = [
                        'id_lhp_ws' => $id_lhp,
                        'id_detail_lhp_ws' => $id_detail_lhp_breakdown,
                        'jam_start' => $this->request->getPost('start_breakdown')[$i],
                        'jam_end' => $this->request->getPost('stop_breakdown')[$i],
                        'coil_code' => $this->request->getPost('coil_code_line_stop')[$i],
                        'kategori_line_stop' => $this->request->getPost('kategori_line_stop')[$i],
                        'jenis_line_stop' => $this->request->getPost('jenis_line_stop')[$i],
                        'uraian_line_stop' => $this->request->getPost('uraian_line_stop')[$i],
                        'menit_breakdown' => $this->request->getPost('menit_breakdown')[$i],
                    ];

                    $total_breakdown += $this->request->getPost('menit_breakdown')[$i];

                    $save_data_breakdown = $this->M_WideStrip->save_detail_breakdown($id_breakdown, $data_breakdown);
                }
            }
            foreach ($data_detail_line_stop as $ddb) {
                if (!array_key_exists($ddb['id_breakdown_ws'], $id_breakdown_exist)) {
                    $this->M_WideStrip->delete_detail_breakdown_by_id_breakdown_ws($ddb['id_breakdown_ws']);
                }
            }
        } else {
            $this->M_WideStrip->delete_detail_breakdown_by_id_lhp($id_lhp);
        }

        // $total_data_andon = $this->request->getPost('no_machine_andon');
        // if (!empty($total_data_andon)) {
        //     $this->M_WideStrip->delete_detail_andon($id_lhp);
        //     for ($i = 0; $i < count($total_data_andon); $i++) {

        //         $data_andon = [
        //             'id_lhp_grid' => $id_lhp,
        //             'no_machine' => $this->request->getPost('no_machine_andon')[$i],
        //             'tiket_andon' => $this->request->getPost('tiket_andon')[$i],
        //             'permasalahan' => $this->request->getPost('permasalahan_andon')[$i],
        //             'tujuan' => $this->request->getPost('tujuan_andon')[$i],
        //             'total_menit' => $this->request->getPost('total_menit_andon')[$i],
        //         ];

        //         $save_data_andon = $this->M_WideStrip->save_detail_andon($data_andon);

        //         $total_andon += $this->request->getPost('total_menit_andon')[$i];
        //     }
        // }

        $total_output_product = $this->request->getPost('coil_code_output_product');
        if(!empty($total_output_product)) {
            for ($i = 0; $i < count($total_output_product); $i++) {
                $id_output_product = $this->request->getPost('id_output_product')[$i];
                $data_output_product = [
                    'id_lhp_wh_start' => $id_lhp,
                    'coil_code' => $this->request->getPost('coil_code_output_product')[$i],
                    'type' => $this->request->getPost('type_wist_output_product')[$i],
                    'winder' => $this->request->getPost('winder_output_product')[$i],
                    'panjang' => $this->request->getPost('panjang_output_product')[$i],
                    'tebal_r' => $this->request->getPost('tebal_r_output_product')[$i],
                    'tebal_l' => $this->request->getPost('tebal_l_output_product')[$i],
                    'bending' => $this->request->getPost('bending_output_product')[$i],
                    'lebar' => $this->request->getPost('lebar_output_product')[$i],
                    'hasil_timbangan' => $this->request->getPost('hasil_timbangan_output_product')[$i],
                    'prod_time' => $this->request->getPost('tanggal_produksi'),
                    'berat' => $this->request->getPost('berat_output_product')[$i],
                    'wh_from' => 'K-WS',
                    'wh_to' => 'K-PUN',
                    'status' => 'open',
                ];
    
                $save_data_output_product = $this->M_WideStrip->update_output_product($id_output_product, $data_output_product);
            }
        }

        // if ($completed === NULL && $approved === NULL) {
        //     $status = 'waiting';
        // } else if ($completed !== NULL) {
        //     $status = 'completed';
        // } else if ($approved !== NULL) {
        //     $status = 'approved';
        // }
        $data_summary_lhp = [
            'total_plan' => $total_plan,
            'total_aktual' => $total_actual,
            'total_breakdown' => $total_breakdown,
            'total_stop' => $total_total_stop,
        ];

        $this->M_WideStrip->update_lhp_wide_strip($id_lhp, $data_summary_lhp);

        // $this->M_WideStrip->delete_data_rak_by_id($id_lhp);

        // $barcode = $this->request->getPost('barcode_rak');
        // $qty = $this->request->getPost('qty_rak');
        // $id_rak = $this->request->getPost('id_rak');
        // $id_rak_barcode = $this->request->getPost('id_rak_barcode');

        // if (!empty($barcode)) {
        //     for ($i = 0; $i < count($barcode); $i++) {
        //         $data_rak = [
        //             'id_lhp' => $id_lhp,
        //             'barcode' => $barcode[$i],
        //             'qty' => $qty[$i],
        //             'id_rak' => $id_rak[$i]
        //         ];

        //         $this->M_WideStrip->add_rak($id_rak_barcode[$i], $data_rak);
        //     }
        // }

        return redirect()->to(base_url('wide_strip/detail_lhp/' . $id_lhp));
    }

    public function get_data_andon()
    {
        $shift = $this->request->getPost('shift');
        $tanggal = $this->request->getPost('tanggal');

        $query = $this->M_WideStrip->get_data_andon($shift, $tanggal);
        echo json_encode($query);
    }

    public function hapus_lhp($id_lhp)
    {
        $this->M_WideStrip->hapus_lhp($id_lhp);
        return redirect()->to(base_url('wide_strip'));
    }

    public function get_qty_rak()
    {
        $barcode = $this->request->getPost('barcode');
        $query = $this->M_WideStrip->get_qty_rak($barcode);
        echo json_encode($query);
    }

    // public function add_rak()
    // {
    //     $id_lhp = $this->request->getPost('id_lhp');
    //     $id_detail_lhp = $this->request->getPost('id_detail_lhp');

    //     $barcode = $this->request->getPost('barcode');
    //     $id = $this->request->getPost('id');
    //     $qty = $this->request->getPost('qty');

    //     for ($i = 0; $i < count($barcode); $i++) {
    //         $data = [
    //             'id_lhp_grid' => $id_lhp,
    //             'barcode' => $barcode[$i],
    //             'qty' => $qty[$i],
    //             'id_rak' => $id[$i]
    //         ];

    //         $this->M_WideStrip->add_rak($id, $data);
    //     }

    //     return redirect()->to(base_url('wide_strip/detail_lhp/' . $id_lhp));
    // }

    public function add_rak()
    {
        $id_lhp = $this->request->getPost('id_lhp');
        $barcode = $this->request->getPost('barcode');
        $qty = $this->request->getPost('qty');
        $rak = $this->request->getPost('rak');
        $wh_from = $this->request->getPost('wh_from');
        $wh_to = $this->request->getPost('wh_to');
        $item = $this->request->getPost('item');
        $descrp = $this->request->getPost('descrp');
        $satuan = $this->request->getPost('satuan');
        $mesin = $this->request->getPost('mesin');
        $entry_date = $this->request->getPost('entry_date');
        $no_wo = $this->request->getPost('no_wo');
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d  H:i:s');
        $data_detail_record_rak = [
            'id_lhp_wh_start' => $id_lhp,
            'pn_qr' => $rak,
            'barcode' => $barcode,
            'qty' => $qty,
            'wh_from' => $wh_from,
            'wh_to' => $wh_to,
            'supply_time' => $date,
            'status' => 'open'
        ];
        $data_master_rak = [
            'current_position' => $wh_from,
            'status' => 1,
            'updated_at' => $date
        ];
        $data_detail_barcode_rak = [
            'barcode' => $barcode,
            'item' => $item,
            'descrp' => $descrp,
            'satuan' => $satuan,
            'qty' => $qty,
            'mesin' => $mesin,
            'entry_date' => $entry_date,
            'no_wo' => $no_wo,
        ];
        $id_log_detail_record_rak = "";
        $update_data_master_rak = "";
        $id_detail_barcode_rak = "";
        if (/*$barcode !== "" && */$rak !== "") {
            $id_log_detail_record_rak = $this->M_WideStrip->add_detail_record_rak($data_detail_record_rak);
            $update_data_master_rak = $this->M_WideStrip->update_data_master_rak($rak, $data_master_rak);
            $id_detail_barcode_rak = $this->M_WideStrip->add_detail_barcode_rak($data_detail_barcode_rak);
        }
        $data_id = [
            'id_log_detail_record_rak' => $id_log_detail_record_rak,
            'update_data_master_rak' => $update_data_master_rak,
            'id_detail_barcode_rak' => $id_detail_barcode_rak,
        ];
        echo json_encode($data_id);
    }

    public function delete_rak()
    {
        // $id_rak_barcode = $this->request->getPost('id_rak_barcode');
        $id_rak = $this->request->getPost('id_rak');
        $id_log_detail_record_rak = $this->request->getPost('id_log_detail_record_rak');
        $barcode = $this->request->getPost('barcode_rak');
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d  H:i:s');
        $data_master_rak = [
            'current_position' => NULL,
            'status' => NULL,
            'updated_at' => $date
        ];
        $update_detail_record_rak = $this->M_WideStrip->delete_detail_record_rak_by_id($id_log_detail_record_rak);
        $update_data_master_rak = $this->M_WideStrip->update_data_master_rak($id_rak, $data_master_rak);
        $delete_detail_barcode_rak = $this->M_WideStrip->delete_detail_barcode_rak($barcode);
        // $query = $this->M_WideStrip->delete_rak($id_rak_barcode);
        $data = [
            // 'id_rak' => $id_rak,
            // 'id_log_detail_record_rak' => $id_log_detail_record_rak,
            // 'barcode' => $barcode,
            // 'data_master_rak' => $data_master_rak,
            'update_detail_record_rak' => $update_detail_record_rak,
            'update_data_master_rak' => $update_data_master_rak,
            'delete_detail_barcode_rak' => $delete_detail_barcode_rak,
            // 'query' => $query,
        ];
        echo json_encode($data);
    }

    public function get_data_rak_by_id()
    {
        $id_lhp = $this->request->getPost('id_lhp');
        $id_detail_lhp = $this->request->getPost('id_detail_lhp');
    }

    public function get_summary_rework()
    {
        $data['data_rework'] = $this->M_WideStrip->get_summary_rework();
        return view('pages/grid_casting/summary_grid_rework', $data);
    }

    public function download_pdf($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_WideStrip->get_data_lhp_wide_strip_by_id($id_lhp);
        $data['data_mesin'] = $this->M_WideStrip->get_data_mesin_grid();
        $data['data_operator'] = $this->M_WideStrip->get_data_operator_grid();
        $data['data_type_grid'] = $this->M_WideStrip->get_data_type_grid();
        $data['data_breakdown'] = $this->M_WideStrip->get_data_breakdown($id_lhp);
        $data['data_andon'] = $this->M_WideStrip->get_data_andon_by_id($id_lhp);
        $data['data_record_rak'] = $this->M_WideStrip->get_id_data_detail_record_rak_by_id($id_lhp, 'K-PUN', 'K-PUN');
        // $data['data_all_rak'] = $this->M_WideStrip->get_data_rak_by_id($id_lhp);
        $session = \Config\Services::session();
        $data['session'] = $session->get('level');
        return view('pages/grid_casting/detail_lhp_grid_print_view', $data);
    }

    public function qty_material_in()
    {
        $material_in = $this->request->getPost('material_in');
        $qty_material_in = $this->M_WideStrip->qty_material_in($material_in);
        return $qty_material_in;
    }

    public function material_in()
    {
        $id_lhp = $this->request->getPost('id_lhp');
        $material_in = $this->request->getPost('material_in');
        $qty_material_in = $this->request->getPost('qty_material_in');
        $item_material_in = $this->request->getPost('item_material_in');
        $data = [
            'id_lhp_ws' => $id_lhp,
            'material_in' => $material_in,
            'qty' => $qty_material_in,
            'item_material_in' => $item_material_in,
        ];
        $id_material_in = $this->M_WideStrip->add_material_in($data);
        if($id_material_in !== NULL) return $id_material_in;
        else return;
    }

    public function material_in_mlr()
    {
        $id_lhp = $this->request->getPost('id_lhp');
        $material_in_mlr = $this->request->getPost('material_in_mlr');
        $qty_material_in_mlr = $this->request->getPost('qty_material_in_mlr');
        $data = [
            'id_lhp_ws' => $id_lhp,
            'type' => $material_in_mlr,
            'qty' => $qty_material_in_mlr,
        ];
        $id_material_in_mlr = $this->M_WideStrip->add_material_in_mlr($data);
        if($id_material_in_mlr !== NULL) return $id_material_in_mlr;
        else return;
    }

    public function delete_material_in()
    {
        $id_material_in = $this->request->getPost('id_material_in');
        $delete_material_in = $this->M_WideStrip->delete_material_in($id_material_in);

        return $id_material_in;
    }

    public function delete_material_in_mlr()
    {
        $id_material_in = $this->request->getPost('id_material_in');
        $delete_material_in_mlr = $this->M_WideStrip->delete_material_in_mlr($id_material_in);

        return $id_material_in;
    }

    public function get_jenis_line_stop()
    {
        $kategori_line_stop = $this->request->getPost('kategori_line_stop');
        $jenis_line_stop = $this->M_WideStrip->getListJenisLineStopWS($kategori_line_stop);
        echo json_encode($jenis_line_stop);
    }
}
