<?php namespace App\Models;
use CodeIgniter\Model;



class M_WET extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    public function get_all_lhp_wet()
    {
        // $query = $this->db->query('SELECT * FROM lhp_produksi2 JOIN master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup ORDER BY tanggal_produksi DESC');
        $builder = $this->db->table('lhp_produksi2');
        $builder->select('lhp_produksi2.*, master_pic_line.nama_pic');
        $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_produksi2.grup');

        if ($this->session->get('line') != NULL) {
            $builder->where('line', $this->session->get('line'));
        }
        
        $builder->orderBy('tanggal_produksi', 'DESC');

        $query = $builder->get();

        return $query->getResultArray();
    }

    public function get_all_lhp_by_date($start_date, $end_date)
    {
        // $query = $this->db->query('SELECT * FROM lhp_produksi2 JOIN master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup ORDER BY tanggal_produksi DESC');
        $builder = $this->db->table('lhp_produksi2');
        $builder->select('lhp_produksi2.*, master_pic_line.nama_pic');
        $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_produksi2.grup');
        $builder->where('line', 8);
        $builder->orWhere('line', 9);
        $builder->where('tanggal_produksi >= ', $start_date);
        $builder->where('tanggal_produksi <= ', $end_date);
        // if ($this->session->get('line') != NULL) {
        //     $builder->where('line', $this->session->get('line'));
        // }
        
        // $builder->orderBy('tanggal_produksi', 'DESC');

        $query = $builder->get();

        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }
    
    public function get_grup()
    {
        $query = $this->db->query('SELECT * FROM master_pic_line');

        return $query->getResultArray();
    }

    public function get_line()
    {
        $query = $this->db->query('SELECT * FROM master_line');

        return $query->getResultArray();
    }
    
    public function get_all_detail_lhp_by_id_lhp($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_produksi2 WHERE id_lhp_2 = '.$id_lhp);

        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_detail_breakdown_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown WHERE id_lhp = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_detail_reject_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_reject WHERE id_lhp = '.$id_lhp);

        return $query->getResultArray();
    }
}
