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
            'kasubsie' => $kasubsie
        ];

        $save_data = $this->M_Grid->add_lhp($data_save);

        return redirect()->to(base_url('grid/detail_lhp/'.$save_data));
    }

    public function detail_lhp($id_lhp)
    {
        $data['id_lhp'] = $id_lhp;
        $data['data_lhp'] = $this->M_Grid->get_data_lhp_grid_by_id($id_lhp);
        $data['data_mesin'] = $this->M_Grid->get_data_mesin_grid();
        $data['data_operator'] = $this->M_Grid->get_data_operator_grid();
        $data['data_type_grid'] = $this->M_Grid->get_data_type_grid();
        $data['data_breakdown'] = $this->M_Grid->get_data_breakdown($id_lhp);
        $data['data_andon'] = $this->M_Grid->get_data_andon_by_id($id_lhp);
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
        $total_andon = 0;
        $total_breakdown = 0;

        $total_data = $this->request->getPost('aktual');
        for ($i=0; $i < count($total_data); $i++) { 
            $id_detail_lhp_grid = $this->request->getPost('id_detail_lhp_grid')[$i];

            if ($this->request->getPost('nama_operator')[$i] != null) {
                $data = [
                    'id_lhp_grid' => $id_lhp,
                    'no_machine' => $this->request->getPost('no_machine')[$i],
                    'operator_name' => $this->request->getPost('nama_operator')[$i],
                    'type_grid' => $this->request->getPost('type_grid')[$i],
                    'jks' => $this->request->getPost('jks')[$i],
                    'actual' => $this->request->getPost('aktual')[$i],
                    'persentase' => $this->request->getPost('persentase')[$i],
                ];
                $save_data = $this->M_Grid->update_lhp($id_detail_lhp_grid, $data);
                
                if (!empty($this->request->getPost('jks')[$i])) {
                    $total_jks += $this->request->getPost('jks')[$i];
                }
                
                if (!empty($this->request->getPost('aktual')[$i])) {
                    $total_actual += $this->request->getPost('aktual')[$i];
                }
            }
        }

        $total_data_breakdown = $this->request->getPost('nama_mesin_breakdown');
        if (!empty($total_data_breakdown)) {
            for ($i=0; $i < count($total_data_breakdown); $i++) { 
                $id_detail_lhp_grid_breakdown = $this->request->getPost('id_detail_lhp_grid_breakdown')[$i];
    
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
        }

        $total_data_andon = $this->request->getPost('no_machine_andon');
        if (!empty($total_data_andon)) {
            $this->M_Grid->delete_detail_andon($id_lhp);
            for ($i=0; $i < count($total_data_andon); $i++) {
    
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

        $data_summary_lhp = [
            'total_jks' => $total_jks,
            'total_aktual' => $total_actual,
            'total_breakdown' => $total_breakdown,
            'total_andon' => $total_andon
        ];

        $this->M_Grid->update_lhp_grid($id_lhp, $data_summary_lhp);

        return redirect()->to(base_url('grid/detail_lhp/'.$id_lhp));
    }

    public function get_data_andon() {
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
}
