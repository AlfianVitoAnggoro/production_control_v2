<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\M_Punching;

class Punching extends BaseController
{

    public function __construct()
    {
        $this->M_Punching = new M_Punching();
    }

    public function index()
    {
        $data['data_lhp_punching'] = $this->M_Punching->get_data_lhp_punching();
        $data['data_grup_punching'] = $this->M_Punching->get_data_grup_punching();
        return view('pages/grid_punching/home', $data);
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

        $data = [
            'date_production' => $tanggal_produksi,
            'line' => $line,
            'shift' => $shift,
            'grup' => $grup,
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti,
            'kasubsie' => $kasubsie
        ];

        $data_save = [
            'date_production' => $tanggal_produksi,
            'line' => $line,
            'shift' => $shift,
            'grup' => $grup,
            'mp' => $mp,
            'absen' => $absen,
            'cuti' => $cuti,
            'kasubsie' => $kasubsie,
            // 'status' => 'waiting'
        ];
        $model = new M_Punching();
        $cek = $model->cek_lhp($tanggal_produksi, $line, $shift, $kasubsie, $grup);
        if (count($cek) > 0) {
            $id = $cek[0]['id'];
            return redirect()->to(base_url('punching/detail_lhp/' . $id));
        } else {
            $save_data = $this->M_Punching->add_lhp($data_save);
            return redirect()->to(base_url('punching/detail_lhp/' . $save_data));
        }
    }

    public function detail_lhp($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_Punching->get_data_lhp_punching_by_id($id_lhp);
        // $data['type_grid'] = $this->M_Punching->get_type_grid($id_lhp);
        // $data['actual_type_grid'] = [];
        // foreach ($data['type_grid'] as $tg) {
        //     array_push($data['actual_type_grid'], $this->M_Punching->get_actual_type_grid($id_lhp, $tg['type_grid'])[0]);
        // }
        $data['data_detail_lhp'] = $this->M_Punching->get_detail_lhp_by_id($id_lhp);
        $data['data_input_wide_strip'] = $this->M_Punching->get_data_input_wide_strip_punching($id_lhp);
        $data['data_mesin'] = $this->M_Punching->get_data_mesin_punching();
        $data['data_operator'] = $this->M_Punching->get_data_operator_punching();
        $data['data_type_grid'] = $this->M_Punching->get_data_type_grid();
        $data['data_breakdown'] = $this->M_Punching->get_data_breakdown($id_lhp);
        $data['data_line_stop_punching'] = $this->M_Punching->getListKategoriLineStopPunching();
        $data['data_output_product'] = $this->M_Punching->get_data_output_product($id_lhp);
        $data['summary_output_product'] = $this->M_Punching->get_summary_output_product($id_lhp);
        $data['data_wide_strip_sisa'] = $this->M_Punching->get_data_wide_strip_sisa ($id_lhp);
        // $data['data_andon'] = $this->M_Punching->get_data_andon_by_id($id_lhp);
        $data['data_record_rak_in'] = $this->M_Punching->get_id_data_detail_record_rak_by_id_in($id_lhp, 'K-PUN');
        $data['data_record_rak_out'] = $this->M_Punching->get_id_data_detail_record_rak_by_id_out($id_lhp, 'K-PUN', 'K-PAS');
        // $data['data_all_rak'] = $this->M_Punching->get_data_rak_by_id($id_lhp);
        $session = \Config\Services::session();
        $data['session'] = $session->get('level');
        return view('pages/grid_punching/detail_lhp_punching', $data);
    }

    public function get_jks()
    {
        $id_type_grid = $this->request->getPost('type_grid');
        $shift = $this->request->getPost('shift');

        $query = $this->M_Punching->get_jks($id_type_grid, $shift);
        echo json_encode($query);
    }

    public function update_lhp()
    {
        // var_dump($this->request->getPost()); die;
        $id_lhp = $this->request->getPost('id_lhp');
        $total_plan = 0;
        $total_actual = 0;
        $total_total_stop = 0;
        // $total_mh = 0;
        // $total_productivity = 0;
        // $total_andon = 0;
        $total_breakdown = 0;

        $approved = $this->request->getPost('approved');
        $completed = $this->request->getPost('completed');
        $total_data = $this->request->getPost('batch');
        for ($i = 0; $i < count($total_data); $i++) {
            $id_detail_lhp_punching = $this->request->getPost('id_detail_lhp_punching')[$i];
            $data = [
                'id_lhp_punching' => $id_lhp,
                'batch' => $this->request->getPost('batch')[$i],
                'jam_start' => $this->request->getPost('start')[$i],
                'jam_end' => $this->request->getPost('stop')[$i],
                'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
                'type_grid' => $this->request->getPost('type_grid')[$i],
                'ct' => $this->request->getPost('ct')[$i],
                'plan_punching' => $this->request->getPost('plan')[$i],
                'actual' => $this->request->getPost('actual')[$i],
                'total_stop' => $this->request->getPost('total_stop')[$i],
            ];
            
            if (!empty($this->request->getPost('actual')[$i])) {
                $total_plan += (int) $this->request->getPost('plan')[$i];
                $total_actual += (int) $this->request->getPost('actual')[$i];
                $total_total_stop += (int) $this->request->getPost('total_stop')[$i];
            }

            $save_data = $this->M_Punching->update_lhp($id_detail_lhp_punching, $data);
        }

        $total_data_breakdown = $this->request->getPost('kategori_line_stop');
        $model = new M_Punching();
        $data_detail_breakdown = $model->get_data_breakdown($id_lhp);
        $id_breakdown_exist = [];
        if (!empty($total_data_breakdown)) {
            for ($i = 0; $i < count($total_data_breakdown); $i++) {
                $id_breakdown = $this->request->getPost('id_breakdown')[$i];
                $id_breakdown_exist[$id_breakdown] = $id_breakdown;
                $data_breakdown = [
                    'id_lhp_punching' => $id_lhp,
                    'id_detail_lhp_punching' => $this->request->getPost('id_detail_lhp_punching_breakdown')[$i],
                    'jam_start' => $this->request->getPost('start_breakdown')[$i],
                    'jam_end' => $this->request->getPost('stop_breakdown')[$i],
                    'type_grid' => $this->request->getPost('type_grid_line_stop')[$i],
                    'kategori_line_stop' => $this->request->getPost('kategori_line_stop')[$i],
                    'jenis_line_stop' => $this->request->getPost('jenis_line_stop')[$i],
                    'uraian_line_stop' => $this->request->getPost('uraian_line_stop')[$i],
                    'menit_breakdown' => $this->request->getPost('menit_breakdown')[$i]
                ];

                $save_data_breakdown = $this->M_Punching->save_detail_breakdown($id_breakdown, $data_breakdown);

                $total_breakdown += $this->request->getPost('menit_breakdown')[$i] !== '' ? $this->request->getPost('menit_breakdown')[$i] : 0;
            }
            foreach ($data_detail_breakdown as $ddb) {
                if (!array_key_exists($ddb['id_breakdown_punching'], $id_breakdown_exist)) {
                    $this->M_Punching->delete_detail_breakdown_by_id_breakdown_punching($ddb['id_breakdown_punching']);
                }
            }
        } else {
            $this->M_Punching->delete_detail_breakdown_by_id_lhp($id_lhp);
        }

        // $total_data_andon = $this->request->getPost('no_machine_andon');
        // if (!empty($total_data_andon)) {
        //     $this->M_Punching->delete_detail_andon($id_lhp);
        //     for ($i = 0; $i < count($total_data_andon); $i++) {

        //         $data_andon = [
        //             'id_lhp_punching' => $id_lhp,
        //             'no_machine' => $this->request->getPost('no_machine_andon')[$i],
        //             'tiket_andon' => $this->request->getPost('tiket_andon')[$i],
        //             'permasalahan' => $this->request->getPost('permasalahan_andon')[$i],
        //             'tujuan' => $this->request->getPost('tujuan_andon')[$i],
        //             'total_menit' => $this->request->getPost('total_menit_andon')[$i],
        //         ];

        //         $save_data_andon = $this->M_Punching->save_detail_andon($data_andon);

        //         $total_andon += $this->request->getPost('total_menit_andon')[$i];
        //     }
        // }

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
            'total_stop' => $total_total_stop,
            'total_breakdown' => $total_breakdown,
            // 'total_andon' => $total_andon,
            // 'total_mh' => $total_mh,
            // 'total_productivity' => $total_productivity,
            // 'status' => $status
        ];

        $this->M_Punching->update_lhp_punching($id_lhp, $data_summary_lhp);

        // $this->M_Punching->delete_data_rak_by_id($id_lhp);

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

        //         $this->M_Punching->add_rak($id_rak_barcode[$i], $data_rak);
        //     }
        // }

        return redirect()->to(base_url('punching/detail_lhp/' . $id_lhp));
    }

    public function get_data_andon()
    {
        $shift = $this->request->getPost('shift');
        $tanggal = $this->request->getPost('tanggal');

        $query = $this->M_Punching->get_data_andon($shift, $tanggal);
        echo json_encode($query);
    }

    public function hapus_lhp($id_lhp)
    {
        $this->M_Punching->hapus_lhp($id_lhp);
        return redirect()->to(base_url('punching'));
    }

    public function get_data_coil()
    {
        $barcode = $this->request->getPost('barcode');
        $query = $this->M_Punching->get_data_coil($barcode, 'open');
        echo json_encode($query);
    }

    public function get_data_coil_output_product()
    {
        $barcode = $this->request->getPost('barcode');
        $query = $this->M_Punching->get_data_coil($barcode, 'close');
        echo json_encode($query);
    }

    public function get_qty_rak()
    {
        $barcode = $this->request->getPost('barcode');
        $query = $this->M_Punching->get_qty_rak($barcode);
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

    //         $this->M_Punching->add_rak($id, $data);
    //     }

    //     return redirect()->to(base_url('grid/detail_lhp/' . $id_lhp));
    // }

    public function add_wide_strip()
    {
        $id_lhp_punching = $this->request->getPost('id_lhp_punching');
        $barcode = $this->request->getPost('barcode');
        $type = $this->request->getPost('type');
        $berat = $this->request->getPost('berat');
        $panjang = $this->request->getPost('panjang');
        $prod_time = $this->request->getPost('prod_time');
        $winder = $this->request->getPost('winder');
        $cek_detail_record_coil_sisa = $this->M_Punching->cek_detail_record_coil_sisa($barcode);
        $cek_detail_record_coil = $this->M_Punching->cek_detail_record_coil($barcode);
        if (count($cek_detail_record_coil) > 0) {
            $data_detail_record_coil = [
                'id_lhp_wh_end' => $id_lhp_punching,
                'coil_code' => $barcode,
                'type' => $type,
                'berat' => $berat,
                'panjang' => $panjang,
                'prod_time' => $prod_time,
                'winder' => $winder,
                'status' => 'close'
            ];
            $data_detail_record_coil_sisa = [
                'id_lhp_wh_end' => $id_lhp_punching,
                'coil_code' => $barcode,
                'type' => $type,
                'berat' => $berat,
                'panjang' => $panjang,
                'prod_time' => $prod_time,
                'winder' => $winder,
                'status' => 'close'
            ];
            // $data_detail_record_coil = [
            //     'id_lhp_punching_wh_end' => $id_lhp_punching,
            //     'close_time' => $date,
            //     'status' => 'close'
            // ];
            // $data_master_rak = [
            //     'current_position' => $wh_to,
            //     'status' => 0,
            //     'updated_at' => $date
            // ];
            // $data_detail_barcode_rak = [
            //     'barcode' => $barcode,
            //     'item' => $item,
            //     'descrp' => $descrp,
            //     'satuan' => $satuan,
            //     'qty' => $qty,
            //     'mesin' => $mesin,
            //     'entry_date' => $entry_date,
            //     'no_wo' => $no_wo,
            // ];
            $update_detail_record_coil = "";
            $id_log_detail_record_coil = "";
            $id_log_detail_record_coil_sisa = "";
            $update_data_master_rak = "";
            $id_detail_barcode_rak = "";
            if ($barcode !== "") {
                if(count($cek_detail_record_coil_sisa) > 0) {
                    $id_log_detail_record_coil_sisa = $this->M_Punching->update_detail_record_coil_sisa($cek_detail_record_coil_sisa[0]['id_log'], $data_detail_record_coil_sisa);
                }
                $id_log_detail_record_coil = $this->M_Punching->update_detail_record_coil($cek_detail_record_coil[0]['id_log'], $data_detail_record_coil);
                // $update_data_master_rak = $this->M_Punching->update_data_master_rak($barcode, $data_master_rak);
                // $id_detail_barcode_rak = $this->M_Punching->add_detail_barcode_rak($data_detail_barcode_rak);
            }
            $data_id = [
                // 'data_record_rak' => $cek_detail_record_coil,
                'id_log_detail_record_coil' => $id_log_detail_record_coil,
                'id_log_detail_record_coil_sisa' => $id_log_detail_record_coil_sisa,
                // 'update_data_master_rak' => $update_data_master_rak,
                'id_detail_barcode_rak' => $id_detail_barcode_rak,
            ];
            echo json_encode($data_id);
        } else {
            echo json_encode("Gagal");
        }
    }

    public function add_wide_strip_sisa()
    {
        $id_lhp_punching = $this->request->getPost('id_lhp_punching');
        $barcode = $this->request->getPost('barcode');
        $type = $this->request->getPost('type');
        $winder = intval($this->request->getPost('winder'));
        $panjang = floatval($this->request->getPost('panjang'));
        $prod_time = $this->request->getPost('prod_time');
        $berat = floatval($this->request->getPost('berat'));

        // $type_data_data_wide_strip_sisa = $this->request->getPost('type_data_data_wide_strip_sisa');
        // $winder_data_data_wide_strip_sisa = intval($this->request->getPost('winder_data_data_wide_strip_sisa'));
        $panjang_data_data_wide_strip_sisa = floatval($this->request->getPost('panjang_data_data_wide_strip_sisa'));
        $tebal_r_data_data_wide_strip_sisa = floatval($this->request->getPost('tebal_r_data_data_wide_strip_sisa'));
        $tebal_l_data_data_wide_strip_sisa = floatval($this->request->getPost('tebal_l_data_data_wide_strip_sisa'));
        $bending_data_data_wide_strip_sisa = floatval($this->request->getPost('bending_data_data_wide_strip_sisa'));
        $lebar_data_data_wide_strip_sisa = floatval($this->request->getPost('lebar_data_data_wide_strip_sisa'));
        $hasil_timbangan_data_data_wide_strip_sisa = floatval($this->request->getPost('hasil_timbangan_data_data_wide_strip_sisa'));
        // $prod_time_data_data_wide_strip_sisa = $this->request->getPost('prod_time_data_data_wide_strip_sisa');
        $berat_data_data_wide_strip_sisa = floatval($this->request->getPost('berat_data_data_wide_strip_sisa'));

        $new_previous_data_berat = $berat_data_data_wide_strip_sisa - $berat;
        $new_previous_data_panjang = $panjang_data_data_wide_strip_sisa - $panjang;

        $cek_previous_detail_record_coil = $this->M_Punching->cek_previous_detail_record_coil($barcode);
        if (count($cek_previous_detail_record_coil) > 0) {
            $data_detail_record_coil = [
                'id_lhp_wh_start' => $cek_previous_detail_record_coil[0]['id_lhp_wh_start'],
                'coil_code' => $barcode,
                'type' => $type,
                'winder' => $winder,
                'panjang' => $panjang,
                'tebal_r' => $tebal_r_data_data_wide_strip_sisa,
                'tebal_l' => $tebal_l_data_data_wide_strip_sisa,
                'bending' => $bending_data_data_wide_strip_sisa,
                'lebar' => $lebar_data_data_wide_strip_sisa,
                'hasil_timbangan' => $hasil_timbangan_data_data_wide_strip_sisa,
                'prod_time' => $prod_time,
                'berat' => $berat,
                'wh_from' => 'K-WS',
                'wh_to' => 'K-PUN',
                'status' => 'open',
            ];
            $data_detail_record_coil_sisa = [
                'id_lhp_wh_start' => $id_lhp_punching,
                'coil_code' => $barcode,
                'type' => $type,
                'winder' => $winder,
                'panjang' => $panjang,
                'tebal_r' => $tebal_r_data_data_wide_strip_sisa,
                'tebal_l' => $tebal_l_data_data_wide_strip_sisa,
                'bending' => $bending_data_data_wide_strip_sisa,
                'lebar' => $lebar_data_data_wide_strip_sisa,
                'hasil_timbangan' => $hasil_timbangan_data_data_wide_strip_sisa,
                'prod_time' => $prod_time,
                'berat' => $berat,
                'wh_from' => 'K-WS',
                'wh_to' => 'K-PUN',
                'status' => 'open',
            ];
            $previous_data_detail_record_coil = [
                'panjang' => $new_previous_data_panjang,
                'berat' => $new_previous_data_berat,
            ];
            // $data_detail_record_coil = [
            //     'id_lhp_punching_wh_end' => $id_lhp_punching,
            //     'close_time' => $date,
            //     'status' => 'close'
            // ];
            // $data_master_rak = [
            //     'current_position' => $wh_to,
            //     'status' => 0,
            //     'updated_at' => $date
            // ];
            $data_detail_barcode_coil = [
                'coil_code' => $barcode,
                'berat' => $berat,
            ];
            $update_detail_record_coil = "";
            $id_log_detail_record_coil = "";
            $id_log_detail_record_coil_sisa = "";
            $id_log_previous_detail_record_coil = "";
            $update_data_master_rak = "";
            $id_detail_barcode_coil = "";
            if ($barcode !== "") {
                $id_log_previous_detail_record_coil = $this->M_Punching->update_detail_record_coil($cek_previous_detail_record_coil[0]['id_log'], $previous_data_detail_record_coil);
                $id_log_detail_record_coil = $this->M_Punching->add_detail_record_coil($data_detail_record_coil);
                $id_log_detail_record_coil_sisa = $this->M_Punching->add_detail_record_coil_sisa($data_detail_record_coil_sisa);
                // $update_data_master_rak = $this->M_Punching->update_data_master_rak($barcode, $data_master_rak);
                $id_detail_barcode_coil = $this->M_Punching->add_detail_barcode_coil($data_detail_barcode_coil);
            }
            $data_id = [
                // 'data_record_rak' => $cek_previous_detail_record_coil,
                'id_log_detail_record_coil' => $id_log_detail_record_coil,
                'id_log_detail_record_coil_sisa' => $id_log_detail_record_coil_sisa,
                'id_log_previous_detail_record_coil' => $id_log_previous_detail_record_coil,
                // 'update_data_master_rak' => $update_data_master_rak,
                'id_detail_barcode_coil' => $id_detail_barcode_coil,
            ];
            echo json_encode($data_id);
        } else {
            echo json_encode("Gagal");
        }
    }

    public function add_output_product()
    {
        $id_lhp_punching = $this->request->getPost('id_lhp_punching');
        $barcode = $this->request->getPost('barcode');
        $coil_code = $this->request->getPost('coil_code');
        $type = $this->request->getPost('type');
        $qty = intval($this->request->getPost('qty'));
        $berat = floatval($this->request->getPost('berat'));
        // $prod_time = $this->request->getPost('prod_time');
        $item = $this->request->getPost('item');
        $descrp = $this->request->getPost('descrp');
        $satuan = $this->request->getPost('satuan');
        $mesin = $this->request->getPost('mesin');
        $entry_date = $this->request->getPost('entry_date');
        $no_wo = $this->request->getPost('no_wo');
        
        $type_data_coil_code = $this->request->getPost('type_data_coil_code');
        $winder_data_coil_code = intval($this->request->getPost('winder_data_coil_code'));
        $panjang_data_coil_code = floatval($this->request->getPost('panjang_data_coil_code'));
        $tebal_r_data_coil_code = floatval($this->request->getPost('tebal_r_data_coil_code'));
        $tebal_l_data_coil_code = floatval($this->request->getPost('tebal_l_data_coil_code'));
        $bending_data_coil_code = floatval($this->request->getPost('bending_data_coil_code'));
        $lebar_data_coil_code = floatval($this->request->getPost('lebar_data_coil_code'));
        $hasil_timbangan_data_coil_code = floatval($this->request->getPost('hasil_timbangan_data_coil_code'));
        $prod_time_data_coil_code = $this->request->getPost('prod_time_data_coil_code');
        // $cek_detail_record_coil = $this->M_Punching->cek_detail_record_coil($barcode);
        // if (count($cek_detail_record_coil) > 0) {
            $data_detail_record_coil = [
                'id_lhp_wh_start' => $id_lhp_punching,
                'barcode' => $barcode,
                'coil_code' => $coil_code,
                'type' => $type_data_coil_code,
                'item' => $item,
                'qty' => $qty,
                'winder' => $winder_data_coil_code,
                'panjang' => $panjang_data_coil_code,
                'tebal_r' => $tebal_r_data_coil_code,
                'tebal_l' => $tebal_l_data_coil_code,
                'bending' => $bending_data_coil_code,
                'lebar' => $lebar_data_coil_code,
                'hasil_timbangan' => $hasil_timbangan_data_coil_code,
                'prod_time' => $prod_time_data_coil_code,
                'berat' => $berat,
                'wh_from' => 'K-PUN',
                'wh_to' => 'K-PAS2',
                'status' => 'open'
            ];
            // $data_detail_record_coil = [
            //     'id_lhp_punching_wh_end' => $id_lhp_punching,
            //     'close_time' => $date,
            //     'status' => 'close'
            // ];
            // $data_master_rak = [
            //     'current_position' => $wh_to,
            //     'status' => 0,
            //     'updated_at' => $date
            // ];
            $data_detail_barcode_coil = [
                'barcode' => $barcode,
                'coil_code' => $coil_code,
                'item' => $item,
                'berat' => $berat,
                'descrp' => $descrp,
                'satuan' => $satuan,
                'qty' => $qty,
                'mesin' => $mesin,
                'entry_date' => $entry_date,
                'no_wo' => $no_wo,
            ];
            $update_detail_record_coil = "";
            $id_log_detail_record_coil = "";
            $update_data_master_rak = "";
            $id_detail_barcode_coil = "";
            // if ($barcode !== "") {
                $id_log_detail_record_coil = $this->M_Punching->add_detail_record_coil($data_detail_record_coil);
                // $update_data_master_rak = $this->M_Punching->update_data_master_rak($barcode, $data_master_rak);
                $id_detail_barcode_coil = $this->M_Punching->add_detail_barcode_coil($data_detail_barcode_coil);
            // }
            $data_id = [
                // 'data_record_rak' => $cek_detail_record_coil,
                'id_log_detail_record_coil' => $id_log_detail_record_coil,
                // 'update_data_master_rak' => $update_data_master_rak,
                'id_detail_barcode_coil' => $id_detail_barcode_coil,
            ];
            echo json_encode($data_id);
        // } else {
        //     echo json_encode("Gagal");
        // }
    }

    public function add_rak_out()
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
            $id_log_detail_record_rak = $this->M_Punching->add_detail_record_rak($data_detail_record_rak);
            $update_data_master_rak = $this->M_Punching->update_data_master_rak($rak, $data_master_rak);
            $id_detail_barcode_rak = $this->M_Punching->add_detail_barcode_rak($data_detail_barcode_rak);
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
        $data_detail_record_rak = [
            'id_lhp_wh_end' => NULL,
            'close_time' => NULL,
            'status' => 'open'
        ];
        $data_master_rak = [
            'current_position' => 'K-PUN',
            'status' => 1,
            'updated_at' => $date
        ];
        $update_detail_record_rak = $this->M_Punching->update_detail_record_rak_by_id($id_log_detail_record_rak, $data_detail_record_rak);
        $update_data_master_rak = $this->M_Punching->update_data_master_rak($id_rak, $data_master_rak);
        $delete_detail_barcode_rak = $this->M_Punching->delete_detail_barcode_rak($barcode);
        // $query = $this->M_Punching->delete_rak($id_rak_barcode);
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

    public function delete_rak_out()
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
        $update_detail_record_rak = $this->M_Punching->delete_detail_record_rak_by_id($id_log_detail_record_rak);
        $update_data_master_rak = $this->M_Punching->update_data_master_rak($id_rak, $data_master_rak);
        $delete_detail_barcode_rak = $this->M_Punching->delete_detail_barcode_rak($barcode);
        // $query = $this->M_Punching->delete_rak($id_rak_barcode);
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

    public function download_pdf($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_Punching->get_data_lhp_punching_by_id($id_lhp);
        $data['data_mesin'] = $this->M_Punching->get_data_mesin_punching();
        $data['data_operator'] = $this->M_Punching->get_data_operator_punching();
        $data['data_type_grid'] = $this->M_Punching->get_data_type_grid();
        $data['data_breakdown'] = $this->M_Punching->get_data_breakdown($id_lhp);
        $data['data_andon'] = $this->M_Punching->get_data_andon_by_id($id_lhp);
        $data['data_record_rak_in'] = $this->M_Punching->get_id_data_detail_record_rak_by_id_in($id_lhp, 'K-PUN');
        $data['data_record_rak_out'] = $this->M_Punching->get_id_data_detail_record_rak_by_id_out($id_lhp, 'K-PUN', 'K-PAS');
        // $data['data_all_rak'] = $this->M_Punching->get_data_rak_by_id($id_lhp);
        $session = \Config\Services::session();
        $data['session'] = $session->get('level');
        return view('pages/punching_casting/detail_lhp_punching_print_view', $data);
    }

    public function qty_material_in()
    {
        $material_in = $this->request->getPost('material_in');
        $qty_material_in = $this->M_Punching->qty_material_in($material_in);
        return $qty_material_in;
    }

    public function material_in()
    {
        $id_lhp = $this->request->getPost('id_lhp');
        $material_in = $this->request->getPost('material_in');
        $conveyor = $this->request->getPost('conveyor');
        $data = [
            'id_lhp_punching' => $id_lhp,
            'material_in' => $material_in,
            'keterangan' => $conveyor,
        ];
        $id_material_in = $this->M_Punching->add_material_in($data);
        if($id_material_in !== NULL) return $id_material_in;
        else return;
    }

    public function delete_material_in()
    {
        $id_material_in = $this->request->getPost('id_material_in');
        $delete_material_in = $this->M_Punching->delete_material_in($id_material_in);

        return $id_material_in;
    }

    public function get_jenis_line_stop()
    {
        $kategori_line_stop = $this->request->getPost('kategori_line_stop');
        $jenis_line_stop = $this->M_Punching->getListJenisLineStopPunching($kategori_line_stop);
        echo json_encode($jenis_line_stop);
    }

    public function delete_rows() {
        $id_detail_lhp_punching = $this->request->getPost('id_detail_lhp_punching');
        $query = $this->M_Punching->delete_rows($id_detail_lhp_punching);
        echo json_encode($id_detail_lhp_punching);
    }

    public function add_note_punching() {
        $id_summary_note = $this->request->getPost('id_summary_note');
        $id_lhp_punching_note = $this->request->getPost('id_lhp_punching_note');
        $type_grid_note = $this->request->getPost('type_grid_note');
        $text_note = $this->request->getPost('text_note');

        $data = [
            'id_lhp_punching' => $id_lhp_punching_note,
            'type_grid' => $type_grid_note,
            'note' => $text_note,
        ];

        $query = $this->M_Punching->add_note_punching($id_summary_note, $data);
        echo json_encode($id_summary_note);
    }
}
