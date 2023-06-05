<?php namespace App\Models;
use CodeIgniter\Model;



class M_TimbanganReject extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        // $this->db2 = \Config\Database::connect('sqlsrv');
        // $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    public function get_all_lhp_timbangan_reject()
    {
        $query = $this->db->query('SELECT * FROM lhp_timbangan_reject ORDER BY tanggal DESC');

        return $query->getResultArray();
    }

    public function get_all_lhp_timbangan_reject_by_date($start_date, $end_date)
    {
        $query = $this->db->query('SELECT * FROM lhp_timbangan_reject WHERE tanggal >= \'' . $start_date . '\' AND tanggal <= \'' . $end_date . '\'');
        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_all_detail_lhp_timbangan_reject_by_id_lhp_timbangan_reject($id_lhp_timbangan_reject)
    {
        $query = $this->db->query('SELECT lhp_timbangan_reject.tanggal, detail_lhp_timbangan_reject.*
                                    FROM detail_lhp_timbangan_reject
                                    JOIN lhp_timbangan_reject ON lhp_timbangan_reject.id_lhp_timbangan_reject = detail_lhp_timbangan_reject.id_lhp_timbangan_reject 
                                    WHERE detail_lhp_timbangan_reject.id_lhp_timbangan_reject = \'' . $id_lhp_timbangan_reject . '\'');
        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function cek_lhp($tanggal) 
    {
        $query = $this->db->query('SELECT * FROM lhp_timbangan_reject WHERE tanggal = \''.$tanggal.'\'');

        return $query->getResultArray();
    }

    public function save_timbangan_reject($data)
    {
        $this->db->table('lhp_timbangan_reject')->insert($data);

        return $this->db->insertID();
    }

    public function save_detail_lhp($data)
    {
        $builder = $this->db->table('detail_lhp_timbangan_reject');
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function get_lhp_timbangan_reject_by_id($id_lhp_timbangan_reject)
    {
        $query = $this->db->query('SELECT * FROM lhp_timbangan_reject WHERE id_lhp_timbangan_reject = '.$id_lhp_timbangan_reject);

        return $query->getResultArray();
    }

    public function get_detail_lhp_timbangan_reject_by_id($id_lhp_timbangan_reject)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_timbangan_reject WHERE id_lhp_timbangan_reject = '.$id_lhp_timbangan_reject);

        return $query->getResultArray();
    }

    // public function get_all_lhp()
    // {
    //     // $query = $this->db->query('SELECT * FROM lhp_timbangan_reject JOIN master_pic_line ON master_pic_line.id_pic = lhp_timbangan_reject.grup ORDER BY tanggal DESC');
    //     $builder = $this->db->table('lhp_timbangan_reject');
    //     $builder->select('lhp_timbangan_reject.*, master_pic_line.nama_pic');
    //     $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_timbangan_reject.grup');

    //     if ($this->session->get('line') != NULL) {
    //         $builder->where('line', $this->session->get('line'));
    //     }
        
    //     $builder->orderBy('tanggal', 'DESC');

    //     $query = $builder->get();

    //     return $query->getResultArray();
    // }

    public function update_lhp_timbangan_reject($id_lhp_timbangan_reject, $data)
    {
        $builder = $this->db->table('lhp_timbangan_reject');
        $builder->where('id_lhp_timbangan_reject', $id_lhp_timbangan_reject);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function update_detail_lhp_timbangan_reject($id_detail_lhp_timbangan_reject, $data)
    {
        $builder = $this->db->table('detail_lhp_timbangan_reject');
        if ($id_detail_lhp_timbangan_reject != '') {
            $builder->where('id_detail_lhp_timbangan_reject', $id_detail_lhp_timbangan_reject);
            $builder->update($data);
            return $id_detail_lhp_timbangan_reject;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
        
    }

    // public function get_data_grup_pic($id_grup)
    // {
    //     $query = $this->db->query('SELECT * FROM master_pic_line WHERE id_pic = '.$id_grup);

    //     return $query->getResultArray();
    // }

    // public function get_data_line($id_line)
    // {
    //     $query = $this->db->query('SELECT * FROM master_line WHERE id_line = '.$id_line);

    //     return $query->getResultArray();
    // }

    public function get_id_detail_lhp_timbangan_reject_by_id_lhp_timbangan_reject($id) {
        $query = $this->db->query('SELECT id_detail_lhp_timbangan_reject FROM detail_lhp_timbangan_reject WHERE id_lhp_timbangan_reject=\''. $id .'\'');

        return $query->getResultArray();
    }

    public function delete_timbangan_reject($id) {
        $this->db->query('DELETE FROM lhp_timbangan_reject WHERE id_lhp_timbangan_reject = '.$id);
        $this->db->query('DELETE FROM detail_lhp_timbangan_reject WHERE id_lhp_timbangan_reject = '. $id);
    }

    public function delete_detail_lhp_timbangan_reject($id) {
        $this->db->query('DELETE FROM detail_lhp_timbangan_reject WHERE id_detail_lhp_timbangan_reject = '. $id);
    }
}
