<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Grid extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');
        $this->db5 = \Config\Database::connect('manajemen_rak');
        $this->db6 = \Config\Database::connect('timah');
    }

    public function get_data_lhp_grid()
    {
        $query = $this->db->query('SELECT * FROM lhp_grid ORDER BY date_production DESC, shift DESC');

        return $query->getResultArray();
    }

    public function get_data_grup_grid()
    {
        $query = $this->db->query('SELECT DISTINCT nama_grup, kasubsie FROM data_grup_grid');

        return $query->getResultArray();
    }

    public function add_lhp($data)
    {
        $query = $this->db->table('lhp_grid')->insert($data);

        return $this->db->insertID();
    }

    public function get_data_lhp_grid_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM lhp_grid WHERE id = \'' . $id_lhp . '\'');

        return $query->getResultArray();
    }

    public function update_lhp_grid($id_lhp, $data)
    {
        $builder = $this->db->table('lhp_grid');

        $builder->where('id', $id_lhp);
        $builder->update($data);
        return $id_lhp;
    }

    public function get_data_mesin_grid()
    {
        $query = $this->db->query('SELECT * FROM data_mesin_grid');

        return $query->getResultArray();
    }

    public function get_data_operator_grid()
    {
        $query = $this->db->query('SELECT * FROM detail_data_grup_grid');

        return $query->getResultArray();
    }

    public function get_data_type_grid()
    {
        $query = $this->db->query('SELECT * FROM data_grid WHERE type_mesin = \'casting\'');

        return $query->getResultArray();
    }

    public function get_jks($type_mesin, $id_grid, $shift)
    {
        $query = $this->db->query('SELECT * FROM jks WHERE type_mesin = \'' . $type_mesin . '\' AND id_grid = \'' . $id_grid . '\' AND shift = \'' . $shift . '\'');

        return $query->getResultArray();
    }

    public function update_lhp($id_lhp, $data)
    {
        $builder = $this->db->table('detail_lhp_grid');

        if ($id_lhp != '') {
            $builder->where('id', $id_lhp);
            $builder->update($data);
            return $id_lhp;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_detail_lhp_by_id($id_lhp, $no_machine)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_grid WHERE id_lhp_grid = \'' . $id_lhp . '\' AND no_machine = \'' . $no_machine . '\'');

        return $query->getResultArray();
    }

    public function get_data_andon($shift, $tanggal_produksi)
    {
        $query = $this->db4->query('SELECT * FROM ticket_produksi1 WHERE tanggal_produksi = \'' . $tanggal_produksi . '\' AND shift = \'' . $shift . '\' AND seksi_pelapor = \'grid_casting\' AND kategori_perbaikan = \'DT\' AND nama_mesin LIKE \'MC%\' ORDER BY nama_mesin ASC');

        return $query->getResultArray();
    }

    public function save_detail_breakdown($id_detail_lhp_grid_breakdown, $data)
    {
        $builder = $this->db->table('detail_breakdown_grid');

        if ($id_detail_lhp_grid_breakdown != '') {
            $builder->where('id_breakdown_grid', $id_detail_lhp_grid_breakdown);
            $builder->update($data);
            return $id_detail_lhp_grid_breakdown;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function delete_detail_breakdown_by_id_lhp($id_lhp_grid)
    {
        $builder = $this->db->table('detail_breakdown_grid');

        $builder->delete(['id_lhp_grid' => $id_lhp_grid]);
    }

    public function delete_detail_breakdown_by_id_breakdown_grid($id_breakdown_grid)
    {
        $builder = $this->db->table('detail_breakdown_grid');

        $builder->delete(['id_breakdown_grid' => $id_breakdown_grid]);
    }

    public function get_data_breakdown($id_lhp_grid)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown_grid WHERE id_lhp_grid = \'' . $id_lhp_grid . '\'');

        return $query->getResultArray();
    }

    function delete_detail_andon($id_lhp_grid)
    {
        $builder = $this->db->table('detail_breakdown_andon_grid');

        $builder->delete(['id_lhp_grid' => $id_lhp_grid]);
    }

    function save_detail_andon($data)
    {
        $builder = $this->db->table('detail_breakdown_andon_grid');

        $builder->insert($data);
    }

    function get_data_andon_by_id($id_lhp_grid)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown_andon_grid WHERE id_lhp_grid = \'' . $id_lhp_grid . '\'');

        return $query->getResultArray();
    }

    function hapus_lhp($id_lhp)
    {
        $this->db->query('DELETE FROM lhp_grid WHERE id = ' . $id_lhp);
        $this->db->query('DELETE FROM detail_lhp_grid WHERE id_lhp_grid = ' . $id_lhp);
        $this->db->query('DELETE FROM detail_breakdown_andon_grid WHERE id_lhp_grid = ' . $id_lhp);
        $this->db->query('DELETE FROM detail_breakdown_grid WHERE id_lhp_grid = ' . $id_lhp);
    }

    function get_pic_grup_mesin($type_mesin, $grup)
    {
        $query = $this->db->query('SELECT * FROM detail_grup_mesin WHERE nama_mesin = \'' . $type_mesin . '\' AND grup = \'' . $grup . '\'');

        return $query->getResultArray();
    }

    // function get_qty_rak($barcode)
    // {
    //     $query = $this->db5->query('SELECT * FROM data_barcode WHERE t$note = \'' . $barcode . '\'');

    //     return $query->getResultArray();
    // }

    function get_qty_rak($barcode) {
        $query = $this->db3->query('SELECT * FROM baan.tcbinh985777 WHERE t$note = \''.$barcode.'\'');

        return $query->getResultArray();
    }

    // function add_rak ($id, $data) {

    //     $builder = $this->db->table('data_record_rak');
    //     // $builder->insert($data);

    //     if ($id != '') {
    //         $builder->where('id', $id);
    //         $builder->update($data);
    //         return $id;
    //     } else {
    //         $builder->insert($data);
    //         return $this->db->insertID();
    //     }
    // }

    function get_id_data_detail_record_rak_by_id($id_lhp_grid, $wh_from)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE id_lhp_wh_start = \'' . $id_lhp_grid . '\' AND wh_from = \'' . $wh_from . '\'');

        return $query->getResultArray();
    }

    function add_detail_barcode_rak($data)
    {
        $builder = $this->db5->table('detail_barcode_rak');
        $builder->insert($data);
        return $this->db5->insertID();
    }

    function add_detail_record_rak($data)
    {
        $builder = $this->db5->table('detail_record_rak');
        $builder->insert($data);
        return $this->db5->insertID();
    }

    function delete_detail_record_rak_by_id($id_log)
    {
        $builder = $this->db5->table('detail_record_rak');
        $builder->delete(['id_log' => $id_log]);
    }

    function update_data_master_rak($pn_qr, $data)
    {

        $builder = $this->db5->table('data_master_rak');
        // $builder->insert($data);

        if ($pn_qr != '') {
            $builder->where('pn_qr', $pn_qr);
            $builder->update($data);
            return $pn_qr;
        }
    }

    function delete_detail_barcode_rak($barcode)
    {
        $query = $this->db5->query('SELECT MAX(id) as id FROM detail_barcode_rak WHERE barcode = \'' . $barcode . '\'');
        $id_detail_barcode_rak = $query->getResultArray();

        $builder = $this->db5->table('detail_barcode_rak');
        $builder->delete(['id' => $id_detail_barcode_rak[0]['id']]);

        return $id_detail_barcode_rak[0]['id'];
    }

    function delete_detail_record_rak($id)
    {
        $builder = $this->db5->table('detail_record_rak');
        $builder->delete(['id_log' => $id]);
    }

    // function delete_rak ($id) {
    //     $builder = $this->db->table('data_record_rak');
    //     $builder->delete(['id' => $id]);
    // }

    // function add_rak ($id, $data) {

    //     $builder = $this->db->table('data_record_rak');
    //     // $builder->insert($data);

    //     if ($id != '') {
    //         $builder->where('id', $id);
    //         $builder->update($data);
    //         return $id;
    //     } else {
    //         $builder->insert($data);
    //         return $this->db->insertID();
    //     }
    // }

    // function get_data_rak_by_id($id_lhp)
    // {
    //     $query = $this->db->query('SELECT * FROM data_record_rak WHERE id_lhp = \'' . $id_lhp . '\'');

    //     return $query->getResultArray();
    // }

    function delete_data_rak_by_id($id_lhp)
    {
        $builder = $this->db->table('data_record_rak');

        $builder->delete(['id_lhp' => $id_lhp]);
    }

    public function cek_lhp($date_production, $line, $shift, $kasubsie, $grup)
    {
        $query = $this->db->query('SELECT * FROM lhp_grid WHERE date_production = \'' . $date_production . '\' AND line = \'' . $line . '\' AND shift = \'' . $shift . '\' AND kasubsie = \'' . $kasubsie . '\' AND grup = \'' . $grup . '\'');

        return $query->getResultArray();
    }

    public function get_summary_rework()
    {
        $query = $this->db->query('
                                    select      SUM(jumlah) as total , cast(created_at as date) tanggal, id_machine
                                    from        rework_grid
                                    group by    cast(created_at as date), id_machine
                                    order by    cast(created_at as date) desc
                                ');

        return $query->getResultArray();
    }

    public function get_data_conveyor_by_id($id_lhp, $conveyor)
    {
        $query = $this->db->query('SELECT * FROM data_material_in_casting WHERE id_lhp_grid=\'' . $id_lhp . '\' AND keterangan=\'' . $conveyor . '\'');

        return $query->getResultArray();
    }

    public function qty_material_in($material_in)
    {
        $query = $this->db6->query('SELECT actq as QTY FROM data_whfg_timah WHERE barc=\'' . $material_in . '\'');

        return json_encode($query->getResultArray());
    }

    public function add_material_in($data)
    {
        $builder = $this->db->table('data_material_in_casting');
        $builder->insert($data);
        return json_encode($this->db->insertID());
    }

    public function delete_material_in($id)
    {
        $builder = $this->db->table('data_material_in_casting');
        $builder->delete(['id_material_in' => $id]);
    }

    public function cek_rak($barcode, $rak)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE barcode=\'' . $barcode . '\' AND pn_qr=\'' . $rak . '\' AND status = \'open\'');

        return $query->getResultArray();
    }
}
