<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Grid extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db4 = \Config\Database::connect('prod_control');
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
        $query = $this->db->query('SELECT * FROM lhp_grid WHERE id = \''.$id_lhp.'\'');

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
        $query = $this->db->query('SELECT * FROM data_grid');

        return $query->getResultArray();
    }

    public function get_jks($type_mesin, $id_grid, $shift) {
        $query = $this->db->query('SELECT * FROM jks WHERE type_mesin = \''.$type_mesin.'\' AND id_grid = \''.$id_grid.'\' AND shift = \''.$shift.'\'');

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
        $query = $this->db->query('SELECT * FROM detail_lhp_grid WHERE id_lhp_grid = \''.$id_lhp.'\' AND no_machine = \''.$no_machine.'\'');

        return $query->getResultArray();
    }

    public function get_data_andon($shift, $tanggal_produksi) {
        $query = $this->db4->query('SELECT * FROM ticket_produksi1 WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND shift = \''.$shift.'\' AND seksi_pelapor = \'grid_casting\' AND kategori_perbaikan = \'DT\' AND nama_mesin LIKE \'MC%\' ORDER BY nama_mesin ASC');

        return $query->getResultArray();
    }

    public function save_detail_breakdown ($id_detail_lhp_grid_breakdown, $data) {
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

    public function delete_detail_breakdown ($id_lhp_grid) {
        $builder = $this->db->table('detail_breakdown_grid');

        $builder->delete(['id_lhp_grid' => $id_lhp_grid]);
    }

    public function get_data_breakdown($id_lhp_grid) {
        $query = $this->db->query('SELECT * FROM detail_breakdown_grid WHERE id_lhp_grid = \''.$id_lhp_grid.'\'');

        return $query->getResultArray();
    }

    function delete_detail_andon($id_lhp_grid) {
        $builder = $this->db->table('detail_breakdown_andon_grid');

        $builder->delete(['id_lhp_grid' => $id_lhp_grid]);
    }

    function save_detail_andon($data) {
        $builder = $this->db->table('detail_breakdown_andon_grid');

        $builder->insert($data);
    }

    function get_data_andon_by_id($id_lhp_grid) {
        $query = $this->db->query('SELECT * FROM detail_breakdown_andon_grid WHERE id_lhp_grid = \''.$id_lhp_grid.'\'');

        return $query->getResultArray();
    }

    function hapus_lhp($id_lhp) {
        $this->db->query('DELETE FROM lhp_grid WHERE id = '.$id_lhp);
        $this->db->query('DELETE FROM detail_lhp_grid WHERE id_lhp_grid = '.$id_lhp); 
        $this->db->query('DELETE FROM detail_breakdown_andon_grid WHERE id_lhp_grid = '.$id_lhp);
        $this->db->query('DELETE FROM detail_breakdown_grid WHERE id_lhp_grid = '.$id_lhp);
    }

    function get_pic_grup_mesin($type_mesin, $grup) {
        $query = $this->db->query('SELECT * FROM detail_grup_mesin WHERE nama_mesin = \''.$type_mesin.'\' AND grup = \''.$grup.'\'');

        return $query->getResultArray();
    }
}
