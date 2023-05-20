<?php namespace App\Models;
use CodeIgniter\Model;



class M_Cos extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    public function get_all_lhp_cos()
    {
        $query = $this->db->query('SELECT * FROM lhp_cos');

        return $query->getResultArray();
    }

    // public function get_all_lhp_cos_by_month($bulan)
    // {
    //     $month = idate('m', strtotime($bulan));
    //     $year = idate('Y', strtotime($bulan));
    //     $query = $this->db->query('SELECT * FROM lhp_cos WHERE MONTH(tanggal_produksi) = \'' . $month . '\' AND YEAR(tanggal_produksi) = \'' . $year . '\'');
    //     if(count($query->getResultArray()) > 0) {
    //         return $query->getResultArray();
    //     } else {
    //         return;
    //     }
    // }

    public function get_all_lhp_cos_by_date($start_date, $end_date)
    {
        $query = $this->db->query('SELECT * FROM lhp_cos WHERE tanggal_produksi >= \'' . $start_date . '\' AND tanggal_produksi <= \'' . $end_date . '\'');
        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_all_detail_lhp_cos_by_id_lhp_cos($id_lhp_cos)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_cos WHERE id_lhp_cos = \'' . $id_lhp_cos . '\'');
        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }
    
    public function get_team()
    {
        $query = $this->db->query('SELECT * FROM team');

        return $query->getResultArray();
    }

    public function cek_lhp($tanggal_produksi, $line, $shift, $team) 
    {
        $query = $this->db->query('SELECT * FROM lhp_cos WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND line = \''.$line.'\' AND shift = \''.$shift.'\' AND team = \''.$team.'\'');

        return $query->getResultArray();
    }

    public function save_cos($data)
    {
        $this->db->table('lhp_cos')->insert($data);

        return $this->db->insertID();
    }

    public function getDataWO($tanggal_produksi,$line)
    {

        $tanggal = date('Ymd', strtotime('-14 days', strtotime($tanggal_produksi)));

        $query = $this->db3->query('
                                    SELECT t$prto as rfq,t$prdt as tgl_prod,t$pdno as pdno,t$mitm as mitm,t$cwar as cwar, t$qrdr as qty,t$prcd as line, t$osta as status 
                                    FROM baan.ttisfc001777 
                                    WHERE (to_number(to_char(t$prdt + (7/24),\'YYYYMMDD\'))) >= '.$tanggal.' order by t$pdno asc
                                ');
                                // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' and (t$osta = 5 or t$osta = 7) order by t$pdno asc
                                // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' order by t$pdno asc
        return $query->getResultArray();
    }

    public function getPartNo($no_wo)
    {
        $query = $this->db3->query('
                                    SELECT t$mitm as mitm, t$qrdr as qty
                                    FROM baan.ttisfc001777 
                                    WHERE t$pdno = \''.$no_wo.'\' order by t$pdno asc
                                ');

        return $query->getResultArray();
    }

    public function save_detail_lhp($data)
    {
        $builder = $this->db->table('detail_lhp_cos');
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function get_lhp_cos_by_id($id_lhp_cos)
    {
        $query = $this->db->query('SELECT * FROM lhp_cos WHERE id_lhp_cos = '.$id_lhp_cos);

        return $query->getResultArray();
    }

    public function get_detail_lhp_cos_by_id($id_lhp_cos)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_cos WHERE id_lhp_cos = '.$id_lhp_cos);

        return $query->getResultArray();
    }

    // public function get_all_lhp()
    // {
    //     // $query = $this->db->query('SELECT * FROM lhp_cos JOIN master_pic_line ON master_pic_line.id_pic = lhp_cos.grup ORDER BY tanggal_produksi DESC');
    //     $builder = $this->db->table('lhp_cos');
    //     $builder->select('lhp_cos.*, master_pic_line.nama_pic');
    //     $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_cos.grup');

    //     if ($this->session->get('line') != NULL) {
    //         $builder->where('line', $this->session->get('line'));
    //     }
        
    //     $builder->orderBy('tanggal_produksi', 'DESC');

    //     $query = $builder->get();

    //     return $query->getResultArray();
    // }

    public function update_lhp_cos($id_lhp_cos, $data)
    {
        $builder = $this->db->table('lhp_cos');
        $builder->where('id_lhp_cos', $id_lhp_cos);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function update_detail_lhp_cos($id_detail_lhp_cos, $data)
    {
        $builder = $this->db->table('detail_lhp_cos');
        if ($id_detail_lhp_cos != '') {
            $builder->where('id_detail_lhp_cos', $id_detail_lhp_cos);
            $builder->update($data);
            return $id_detail_lhp_cos;
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

    public function get_id_detail_lhp_cos_by_id_lhp_cos($id) {
        $query = $this->db->query('SELECT id_detail_lhp_cos FROM detail_lhp_cos WHERE id_lhp_cos=\''. $id .'\'');

        return $query->getResultArray();
    }

    public function delete_cos($id) {
        $this->db->query('DELETE FROM lhp_cos WHERE id_lhp_cos = '.$id);
        $this->db->query('DELETE FROM detail_lhp_cos WHERE id_lhp_cos = '. $id);
    }

    public function delete_detail_lhp_cos($id) {
        $this->db->query('DELETE FROM detail_lhp_cos WHERE id_detail_lhp_cos = '. $id);
    }
}
