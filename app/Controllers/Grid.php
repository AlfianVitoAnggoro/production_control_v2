<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\M_Grid;

class Grid extends BaseController
{

    public function __construct()
    {
        $this->M_Grid = new M_Grid();
    }

    public function index()
    {
        $data['data_lhp_grid'] = $this->M_Grid->get_data_lhp_grid();
        $data['data_grup_grid'] = $this->M_Grid->get_data_grup_grid();
        return view('pages/grid_casting/home', $data);
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
            'tanggal_produksi' => $tanggal_produksi,
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
            'status' => 'waiting'
        ];
        $model = new M_Grid();
        $cek = $model->cek_lhp($tanggal_produksi, $line, $shift, $kasubsie, $grup);
        if (count($cek) > 0) {
            $id = $cek[0]['id'];
            return redirect()->to(base_url('grid/detail_lhp/' . $id));
        } else {
            $save_data = $this->M_Grid->add_lhp($data_save);
            return redirect()->to(base_url('grid/detail_lhp/' . $save_data));
        }
    }

    public function detail_lhp($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_Grid->get_data_lhp_grid_by_id($id_lhp);
        $data['data_conveyor_barat'] = $this->M_Grid->get_data_conveyor_by_id($id_lhp, 'barat');
        $data['data_conveyor_timur'] = $this->M_Grid->get_data_conveyor_by_id($id_lhp, 'timur');
        $data['data_mesin'] = $this->M_Grid->get_data_mesin_grid();
        $data['data_operator'] = $this->M_Grid->get_data_operator_grid();
        $data['data_type_grid'] = $this->M_Grid->get_data_type_grid();
        $data['data_breakdown'] = $this->M_Grid->get_data_breakdown($id_lhp);
        $data['data_andon'] = $this->M_Grid->get_data_andon_by_id($id_lhp);
        $data['data_record_rak'] = $this->M_Grid->get_id_data_detail_record_rak_by_id($id_lhp, 'K-CAS');
        // $data['data_all_rak'] = $this->M_Grid->get_data_rak_by_id($id_lhp);
        $session = \Config\Services::session();
        $data['session'] = $session->get('level');
        return view('pages/grid_casting/detail_lhp_grid', $data);
    }

    public function get_jks()
    {
        $type_mesin = $this->request->getPost('type_mesin');
        $id_type_grid = $this->request->getPost('type_grid');
        $shift = $this->request->getPost('shift');

        $query = $this->M_Grid->get_jks($type_mesin, $id_type_grid, $shift);
        echo json_encode($query);
    }

    public function update_lhp()
    {
        // var_dump($this->request->getPost()); die;
        $id_lhp = $this->request->getPost('id_lhp');
        $total_jks = 0;
        $total_actual = 0;
        $total_mh = 0;
        $total_productivity = 0;
        $total_andon = 0;
        $total_breakdown = 0;

        $approved = $this->request->getPost('approved');
        $completed = $this->request->getPost('completed');

        $total_data = $this->request->getPost('aktual');
        for ($i = 0; $i < count($total_data); $i++) {
            $id_detail_lhp_grid = $this->request->getPost('id_detail_lhp_grid')[$i];

            if ($this->request->getPost('nama_operator')[$i] != null) {
                $data = [
                    'id_lhp_grid' => $id_lhp,
                    'no_machine' => $this->request->getPost('no_machine')[$i],
                    'operator_name' => $this->request->getPost('nama_operator')[$i],
                    'type_grid' => $this->request->getPost('type_grid')[$i],
                    'jks' => intval($this->request->getPost('jks')[$i]),
                    'actual' => intval($this->request->getPost('aktual')[$i]),
                    'mh' => floatval($this->request->getPost('mh')[$i]),
                    'productivity' => floatval($this->request->getPost('productivity')[$i]),
                    'persentase' => floatval($this->request->getPost('persentase')[$i]),
                ];
                $save_data = $this->M_Grid->update_lhp($id_detail_lhp_grid, $data);

                if (!empty($this->request->getPost('jks')[$i])) {
                    $total_jks += $this->request->getPost('jks')[$i];
                }

                if (!empty($this->request->getPost('aktual')[$i])) {
                    $total_actual += $this->request->getPost('aktual')[$i];
                    $total_mh += $this->request->getPost('mh')[$i];
                    $total_productivity += floatval($this->request->getPost('productivity')[$i]);
                }
            }
        }

        $total_data_breakdown = $this->request->getPost('nama_mesin_breakdown');
        $model = new M_Grid();
        $data_detail_breakdown = $model->get_data_breakdown($id_lhp);
        $id_detail_lhp_grid_breakdown_input = $this->request->getPost('id_detail_lhp_grid_breakdown');
        $id_detail_lhp_grid_breakdown_exist = [];
        if (!empty($total_data_breakdown)) {
            for ($i = 0; $i < count($total_data_breakdown); $i++) {
                $id_detail_lhp_grid_breakdown = $this->request->getPost('id_detail_lhp_grid_breakdown')[$i];
                $id_detail_lhp_grid_breakdown_exist[$id_detail_lhp_grid_breakdown] = $id_detail_lhp_grid_breakdown;

                if ($this->request->getPost('nama_mesin_breakdown')[$i] != null) {

                    $data_breakdown = [
                        'id_lhp_grid' => $id_lhp,
                        'no_machine' => $this->request->getPost('nama_mesin_breakdown')[$i],
                        'uraian_breakdown' => $this->request->getPost('uraian_breakdown_grid')[$i],
                        'total_menit' => $this->request->getPost('total_menit_breakdown_grid')[$i],
                    ];

                    $save_data_breakdown = $this->M_Grid->save_detail_breakdown($id_detail_lhp_grid_breakdown, $data_breakdown);

                    $total_breakdown += $this->request->getPost('total_menit_breakdown_grid')[$i];
                }
            }
            foreach ($data_detail_breakdown as $ddb) {
                if (!array_key_exists($ddb['id_breakdown_grid'], $id_detail_lhp_grid_breakdown_exist)) {
                    $this->M_Grid->delete_detail_breakdown_by_id_breakdown_grid($ddb['id_breakdown_grid']);
                }
            }
        } else {
            $this->M_Grid->delete_detail_breakdown_by_id_lhp($id_lhp);
        }

        $total_data_andon = $this->request->getPost('no_machine_andon');
        if (!empty($total_data_andon)) {
            $this->M_Grid->delete_detail_andon($id_lhp);
            for ($i = 0; $i < count($total_data_andon); $i++) {

                $data_andon = [
                    'id_lhp_grid' => $id_lhp,
                    'no_machine' => $this->request->getPost('no_machine_andon')[$i],
                    'tiket_andon' => $this->request->getPost('tiket_andon')[$i],
                    'permasalahan' => $this->request->getPost('permasalahan_andon')[$i],
                    'tujuan' => $this->request->getPost('tujuan_andon')[$i],
                    'total_menit' => $this->request->getPost('total_menit_andon')[$i],
                ];

                $save_data_andon = $this->M_Grid->save_detail_andon($data_andon);

                $total_andon += $this->request->getPost('total_menit_andon')[$i];
            }
        }

        if ($completed === NULL && $approved === NULL) {
            $status = 'waiting';
        } else if ($completed !== NULL) {
            $status = 'completed';
        } else if ($approved !== NULL) {
            $status = 'approved';
        }
        $data_summary_lhp = [
            'total_jks' => $total_jks,
            'total_aktual' => $total_actual,
            'total_breakdown' => $total_breakdown,
            'total_andon' => $total_andon,
            'total_mh' => $total_mh,
            'total_productivity' => $total_productivity,
            'status' => $status
        ];

        $this->M_Grid->update_lhp_grid($id_lhp, $data_summary_lhp);

        // $this->M_Grid->delete_data_rak_by_id($id_lhp);

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

        //         $this->M_Grid->add_rak($id_rak_barcode[$i], $data_rak);
        //     }
        // }

        return redirect()->to(base_url('grid/detail_lhp/' . $id_lhp));
    }

    public function get_data_andon()
    {
        $shift = $this->request->getPost('shift');
        $tanggal = $this->request->getPost('tanggal');

        $query = $this->M_Grid->get_data_andon($shift, $tanggal);
        echo json_encode($query);
    }

    public function hapus_lhp($id_lhp)
    {
        $this->M_Grid->hapus_lhp($id_lhp);
        return redirect()->to(base_url('grid'));
    }

    public function get_qty_rak()
    {
        $barcode = $this->request->getPost('barcode');
        $query = $this->M_Grid->get_qty_rak($barcode);
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

    //         $this->M_Grid->add_rak($id, $data);
    //     }

    //     return redirect()->to(base_url('grid/detail_lhp/' . $id_lhp));
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
            $id_log_detail_record_rak = $this->M_Grid->add_detail_record_rak($data_detail_record_rak);
            $update_data_master_rak = $this->M_Grid->update_data_master_rak($rak, $data_master_rak);
            $id_detail_barcode_rak = $this->M_Grid->add_detail_barcode_rak($data_detail_barcode_rak);
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
        $update_detail_record_rak = $this->M_Grid->delete_detail_record_rak_by_id($id_log_detail_record_rak);
        $update_data_master_rak = $this->M_Grid->update_data_master_rak($id_rak, $data_master_rak);
        $delete_detail_barcode_rak = $this->M_Grid->delete_detail_barcode_rak($barcode);
        // $query = $this->M_Grid->delete_rak($id_rak_barcode);
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
        $data['data_rework'] = $this->M_Grid->get_summary_rework();
        return view('pages/grid_casting/summary_grid_rework', $data);
    }

    public function download_pdf($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_Grid->get_data_lhp_grid_by_id($id_lhp);
        $data['data_mesin'] = $this->M_Grid->get_data_mesin_grid();
        $data['data_operator'] = $this->M_Grid->get_data_operator_grid();
        $data['data_type_grid'] = $this->M_Grid->get_data_type_grid();
        $data['data_breakdown'] = $this->M_Grid->get_data_breakdown($id_lhp);
        $data['data_andon'] = $this->M_Grid->get_data_andon_by_id($id_lhp);
        $data['data_record_rak'] = $this->M_Grid->get_id_data_detail_record_rak_by_id($id_lhp, 'K-CAS');
        // $data['data_all_rak'] = $this->M_Grid->get_data_rak_by_id($id_lhp);
        $session = \Config\Services::session();
        $data['session'] = $session->get('level');
        return view('pages/grid_casting/detail_lhp_grid_print_view', $data);
    }

    public function qty_material_in()
    {
        $material_in = $this->request->getPost('material_in');
        $qty_material_in = $this->M_Grid->qty_material_in($material_in);
        return $qty_material_in;
    }

    public function material_in()
    {
        $id_lhp = $this->request->getPost('id_lhp');
        $material_in = $this->request->getPost('material_in');
        $conveyor = $this->request->getPost('conveyor');
        $data = [
            'id_lhp_grid' => $id_lhp,
            'material_in' => $material_in,
            'keterangan' => $conveyor,
        ];
        $id_material_in = $this->M_Grid->add_material_in($data);
        if($id_material_in !== NULL) return $id_material_in;
        else return;
    }

    public function delete_material_in()
    {
        $id_material_in = $this->request->getPost('id_material_in');
        $delete_material_in = $this->M_Grid->delete_material_in($id_material_in);

        return $id_material_in;
    }

    public function cek_rak()
    {
        $barcode = $this->request->getPost('barcode');
        $rak = $this->request->getPost('rak');

        $cek_rak = $this->M_Grid->cek_rak($barcode, $rak);

        echo json_encode($cek_rak);
    }
}
