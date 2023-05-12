<?php namespace App\Models;
use CodeIgniter\Model;



class M_Saw extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    public function get_all_lhp_saw()
    {
        $query = $this->db->query('SELECT * FROM lhp_saw ORDER BY tanggal_produksi DESC');

        return $query->getResultArray();
    }

    public function get_all_lhp_saw_by_month($bulan)
    {
        $month = idate('m', strtotime($bulan));
        $year = idate('Y', strtotime($bulan));
        $query = $this->db->query('SELECT * FROM lhp_saw WHERE MONTH(tanggal_produksi) = \'' . $month . '\' AND YEAR(tanggal_produksi) = \'' . $year . '\'');
        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_all_lhp_saw_by_date($start_date, $end_date)
    {
        $query = $this->db->query('SELECT * FROM lhp_saw WHERE tanggal_produksi >= \'' . $start_date . '\' AND tanggal_produksi <= \'' . $end_date . '\'');
        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_all_detail_lhp_saw_by_id_lhp_saw($id_lhp_saw)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_saw WHERE id_lhp_saw = \'' . $id_lhp_saw . '\'');
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

    public function cek_lhp($tanggal_produksi, $saw, $shift, $team) 
    {
        $query = $this->db->query('SELECT * FROM lhp_saw WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND saw = \''.$saw.'\' AND shift = \''.$shift.'\' AND team = \''.$team.'\'');

        return $query->getResultArray();
    }

    public function save_saw($data)
    {
        $this->db->table('lhp_saw')->insert($data);

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
        $builder = $this->db->table('detail_lhp_saw');
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function get_lhp_saw_by_id($id_lhp_saw)
    {
        $query = $this->db->query('SELECT * FROM lhp_saw WHERE id_lhp_saw = '.$id_lhp_saw);

        return $query->getResultArray();
    }

    public function get_detail_lhp_saw_by_id($id_lhp_saw)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_saw WHERE id_lhp_saw = '.$id_lhp_saw);

        return $query->getResultArray();
    }

    // public function get_all_lhp()
    // {
    //     // $query = $this->db->query('SELECT * FROM lhp_saw JOIN master_pic_line ON master_pic_line.id_pic = lhp_saw.grup ORDER BY tanggal_produksi DESC');
    //     $builder = $this->db->table('lhp_saw');
    //     $builder->select('lhp_saw.*, master_pic_line.nama_pic');
    //     $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_saw.grup');

    //     if ($this->session->get('line') != NULL) {
    //         $builder->where('line', $this->session->get('line'));
    //     }
        
    //     $builder->orderBy('tanggal_produksi', 'DESC');

    //     $query = $builder->get();

    //     return $query->getResultArray();
    // }

    public function update_lhp_saw($id_lhp_saw, $data)
    {
        $builder = $this->db->table('lhp_saw');
        $builder->where('id_lhp_saw', $id_lhp_saw);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function update_detail_lhp_saw($id_detail_lhp_saw, $data)
    {
        $builder = $this->db->table('detail_lhp_saw');
        if ($id_detail_lhp_saw != '') {
            $builder->where('id_detail_lhp_saw', $id_detail_lhp_saw);
            $builder->update($data);
            return $id_detail_lhp_saw;
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

    public function get_id_detail_lhp_saw_by_id_lhp_saw($id) {
        $query = $this->db->query('SELECT id_detail_lhp_saw FROM detail_lhp_saw WHERE id_lhp_saw=\''. $id .'\'');

        return $query->getResultArray();
    }

    public function delete_saw($id) {
        $this->db->query('DELETE FROM lhp_saw WHERE id_lhp_saw = '.$id);
        $this->db->query('DELETE FROM detail_lhp_saw WHERE id_lhp_saw = '. $id);
    }

    public function delete_detail_lhp_saw($id) {
        $this->db->query('DELETE FROM detail_lhp_saw WHERE id_detail_lhp_saw = \''. $id . '\'');
    }
}
