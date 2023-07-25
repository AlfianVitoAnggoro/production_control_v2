<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Punching extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');
        $this->db5 = \Config\Database::connect('manajemen_rak');
        $this->db6 = \Config\Database::connect('timah');
    }

    public function get_data_lhp_punching()
    {
        $query = $this->db->query('SELECT * FROM lhp_punching ORDER BY shift DESC');

        return $query->getResultArray();
    }

    public function get_data_grup_punching()
    {
        $query = $this->db->query('SELECT DISTINCT nama_grup, kasubsie FROM data_grup_grid');

        return $query->getResultArray();
    }

    public function add_lhp($data)
    {
        $query = $this->db->table('lhp_punching')->insert($data);

        return $this->db->insertID();
    }

    public function get_data_lhp_punching_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM lhp_punching WHERE id = \'' . $id_lhp . '\'');

        return $query->getResultArray();
    }

    public function update_lhp_punching($id_lhp, $data)
    {
        $builder = $this->db->table('lhp_punching');

        $builder->where('id', $id_lhp);
        $builder->update($data);
        return $id_lhp;
    }

    public function get_data_mesin_punching()
    {
        $query = $this->db->query('SELECT * FROM data_mesin_grid');

        return $query->getResultArray();
    }

    public function get_data_operator_punching()
    {
        $query = $this->db->query('SELECT * FROM detail_data_grup_grid');

        return $query->getResultArray();
    }

    public function get_data_type_grid()
    {
        $query = $this->db->query('SELECT * FROM data_grid WHERE type_mesin = \'punching\'');

        return $query->getResultArray();
    }

    public function get_jks($id_grid, $shift)
    {
        $query = $this->db->query('SELECT * FROM jks WHERE id_grid = \'' . $id_grid . '\' AND shift = \'' . $shift . '\'');

        return $query->getResultArray();
    }

    public function update_lhp($id_detail_lhp_punching, $data)
    {
        $builder = $this->db->table('detail_lhp_punching');

        if ($id_detail_lhp_punching != '') {
            $builder->where('id_detail_lhp_punching', $id_detail_lhp_punching);
            $builder->update($data);
            return $id_detail_lhp_punching;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_type_grid($id_lhp)
    {
        $query = $this->db->query('SELECT DISTINCT type_grid, plan_punching FROM detail_lhp_punching WHERE id_lhp_punching = \'' . $id_lhp . '\'');

        return $query->getResultArray();
    }

    public function get_actual_type_grid($id_lhp, $type_grid)
    {
        $query = $this->db->query('SELECT SUM(qty) AS qty FROM detail_lhp_punching WHERE id_lhp_punching = \'' . $id_lhp . '\' AND type_grid= \'' . $type_grid . '\'');

        return $query->getResultArray();
    }

    public function get_detail_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_punching WHERE id_lhp_punching = \'' . $id_lhp . '\' ORDER BY batch ASC');

        return $query->getResultArray();
    }

    public function get_data_andon($shift, $tanggal_produksi)
    {
        $query = $this->db4->query('SELECT * FROM ticket_produksi1 WHERE tanggal_produksi = \'' . $tanggal_produksi . '\' AND shift = \'' . $shift . '\' AND seksi_pelapor = \'grid_casting\' AND kategori_perbaikan = \'DT\' AND nama_mesin LIKE \'MC%\' ORDER BY nama_mesin ASC');

        return $query->getResultArray();
    }

    public function save_detail_breakdown($id_detail_lhp_punching_breakdown, $data)
    {
        $builder = $this->db->table('detail_breakdown_punching');

        if ($id_detail_lhp_punching_breakdown != '') {
            $builder->where('id_breakdown_punching', $id_detail_lhp_punching_breakdown);
            $builder->update($data);
            return $id_detail_lhp_punching_breakdown;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function delete_detail_breakdown_by_id_lhp($id_lhp_punching)
    {
        $builder = $this->db->table('detail_breakdown_punching');

        $builder->delete(['id_lhp_punching' => $id_lhp_punching]);
    }

    public function delete_detail_breakdown_by_id_breakdown_punching($id_breakdown_punching)
    {
        $builder = $this->db->table('detail_breakdown_punching');

        $builder->delete(['id_breakdown_punching' => $id_breakdown_punching]);
    }

    public function get_data_breakdown($id_lhp_punching)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown_punching WHERE id_lhp_punching = \'' . $id_lhp_punching . '\'');

        return $query->getResultArray();
    }

    function delete_detail_andon($id_lhp_punching)
    {
        $builder = $this->db->table('detail_breakdown_andon_punching');

        $builder->delete(['id_lhp_punching' => $id_lhp_punching]);
    }

    function save_detail_andon($data)
    {
        $builder = $this->db->table('detail_breakdown_andon_punching');

        $builder->insert($data);
    }

    function get_data_andon_by_id($id_lhp_punching)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown_andon_punching WHERE id_lhp_punching = \'' . $id_lhp_punching . '\'');

        return $query->getResultArray();
    }

    function hapus_lhp($id_lhp)
    {
        $this->db->query('DELETE FROM lhp_punching WHERE id = ' . $id_lhp);
        $this->db->query('DELETE FROM detail_lhp_punching WHERE id_lhp_punching = ' . $id_lhp);
        $this->db->query('DELETE FROM detail_breakdown_andon_punching WHERE id_lhp_punching = ' . $id_lhp);
        $this->db->query('DELETE FROM detail_breakdown_punching WHERE id_lhp_punching = ' . $id_lhp);
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

    function get_data_coil($coil_code, $status) {
        $query = $this->db5->query('SELECT TOP 1 * FROM detail_record_coil WHERE coil_code = \'' . $coil_code . '\' AND status = \'' . $status . '\' ORDER BY created_at DESC');
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

    function get_id_data_detail_record_rak_by_id_in($id_lhp_punching, $wh_to)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE id_lhp_wh_end = \'' . $id_lhp_punching . '\' AND wh_to = \'' . $wh_to . '\'');

        return $query->getResultArray();
    }

    function get_id_data_detail_record_rak_by_id_out($id_lhp_punching, $wh_from, $wh_to)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE id_lhp_wh_start = \'' . $id_lhp_punching . '\' AND wh_from = \'' . $wh_from . '\' AND wh_to = \'' . $wh_to . '\'');

        return $query->getResultArray();
    }

    function add_detail_barcode_coil($data)
    {
        $builder = $this->db5->table('detail_barcode_coil');
        $builder->insert($data);
        return $this->db5->insertID();
    }

    function add_detail_record_rak($data)
    {
        $builder = $this->db5->table('detail_record_rak');
        $builder->insert($data);
        return $this->db5->insertID();
    }

    function update_detail_record_rak_by_id($id_log, $data)
    {
        $builder = $this->db5->table('detail_record_rak');
        $builder->where('id_log', $id_log);
        $builder->update($data);
        // return $builder->getResultArray();
        return $id_log;
    }

    function cek_detail_record_coil($coil_code)
    {
        $query = $this->db5->query('SELECT TOP 1 id_log FROM detail_record_coil WHERE coil_code = \'' . $coil_code . '\' AND status =\'open\' ORDER BY created_at DESC');
        $id_log_detail_record_coil = $query->getResultArray();
        return $id_log_detail_record_coil;
    }

    function cek_detail_record_coil_sisa($coil_code)
    {
        $query = $this->db5->query('SELECT TOP 1 id_log FROM detail_record_coil_sisa WHERE coil_code = \'' . $coil_code . '\' AND status =\'open\' ORDER BY created_at DESC');
        $id_log_detail_record_coil = $query->getResultArray();
        return $id_log_detail_record_coil;
    }
    
    function cek_previous_detail_record_coil($coil_code)
    {
        $query = $this->db5->query('SELECT TOP 1 id_log, id_lhp_wh_start FROM detail_record_coil WHERE coil_code = \'' . $coil_code . '\' AND status =\'close\' ORDER BY created_at DESC');
        $id_log_detail_record_coil = $query->getResultArray();
        return $id_log_detail_record_coil;
    }

    function update_detail_record_rak($pn_qr, $data)
    {
        $builder = $this->db5->table('detail_record_rak');
        $builder->where('pn_qr', $pn_qr);
        $builder->update($data);
        // return $builder->getResultArray();
        return $pn_qr;
    }

    function add_detail_record_coil($data)
    {
        $builder = $this->db5->table('detail_record_coil');
        $builder->insert($data);
        // $id = $builder->insertID();
        // return $builder->getResultArray();
        return $this->db5->insertID();
    }

    function add_detail_record_coil_sisa($data)
    {
        $builder = $this->db5->table('detail_record_coil_sisa');
        $builder->insert($data);
        // $id = $builder->insertID();
        // return $builder->getResultArray();
        return $this->db5->insertID();
    }

    function update_detail_record_coil($id_log, $data)
    {
        $builder = $this->db5->table('detail_record_coil');
        // $builder->insert($data);
        // $id = $builder->insertID();
        // return $builder->getResultArray();
        $builder->where('id_log', $id_log);
        $builder->update($data);
        return $id_log;
        // return $data;
    }

    function update_detail_record_coil_sisa($id_log, $data)
    {
        $builder = $this->db5->table('detail_record_coil_sisa');
        // $builder->insert($data);
        // $id = $builder->insertID();
        // return $builder->getResultArray();
        $builder->where('id_log', $id_log);
        $builder->update($data);
        return $id_log;
        // return $data;
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
        $query = $this->db->query('SELECT * FROM lhp_punching WHERE date_production= \'' . $date_production . '\' AND line = \'' . $line . '\' AND shift = \'' . $shift . '\' AND kasubsie = \'' . $kasubsie . '\' AND grup = \'' . $grup . '\'');

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

    // public function get_data_conveyor_by_id($id_lhp, $conveyor)
    // {
    //     $query = $this->db->query('SELECT * FROM data_material_in_casting WHERE id_lhp_punching=\'' . $id_lhp . '\' AND keterangan=\'' . $conveyor . '\'');

    //     return $query->getResultArray();
    // }

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

    public function getListKategoriLineStopPunching()
    {
        $query = $this->db->query('SELECT DISTINCT kategori_line_stop FROM master_line_stop_punching');

        return $query->getResultArray();
    }

    public function getListJenisLineStopPunching($kategori_line_stop)
    {
        $query = $this->db->query('SELECT * FROM master_line_stop_punching WHERE kategori_line_stop = \'' . $kategori_line_stop . '\'');

        return $query->getResultArray();
    }

    public function get_data_input_wide_strip_punching($id_lhp_punching)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_coil WHERE id_lhp_wh_end = \'' . $id_lhp_punching . '\' AND wh_to =\'K-PUN\' AND status = \'close\'');

        return $query->getResultArray();
    }

    function delete_rows($id_detail_lhp_punching) {
        $builder = $this->db->table('detail_lhp_punching');

        $builder->delete(['id_detail_lhp_punching' => $id_detail_lhp_punching]);
    }

    function get_data_output_product($id_lhp_punching)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_coil WHERE id_lhp_wh_start = \'' . $id_lhp_punching . '\' AND wh_from =\'K-PUN\'');

        return $query->getResultArray();
    }

    function get_summary_output_product($id_lhp_punching)
    {
        $query = $this->db->query('SELECT type_grid, SUM(actual) AS actual
                                FROM detail_lhp_punching
                                WHERE id_lhp_punching = \'' . $id_lhp_punching . '\'
                                AND type_grid != \'\'
                                GROUP BY type_grid');

        return $query->getResultArray();
    }

    function get_summary_note($id_lhp_punching, $type_grid)
    {
        $query = $this->db->query('SELECT id_detail_lhp_punching_note, note FROM detail_lhp_punching_note WHERE id_lhp_punching = \'' . $id_lhp_punching . '\' AND type_grid = \'' . $type_grid . '\'');

        return $query->getResultArray();
    }

    public function get_data_wide_strip_sisa($id_lhp_punching)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_coil_sisa WHERE id_lhp_wh_start = \'' . $id_lhp_punching . '\' AND wh_to =\'K-PUN\'');

        return $query->getResultArray();
    }

    function add_note_punching($id, $data) {
        $builder = $this->db->table('detail_lhp_punching_note');

        if ($id != '') {
        $builder->where('id_detail_lhp_punching_note', $id);
        $builder->update($data);
        return $this->db->affectedRows();
        } else {
        $builder->insert($data);
        return $this->db->insertID();
        }
    }
}
