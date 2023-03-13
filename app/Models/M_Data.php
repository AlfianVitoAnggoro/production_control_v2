<?php namespace App\Models;
use CodeIgniter\Model;



class M_Data extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
    }

    public function getDataWO($tanggal_produksi,$line)
    {
        $tanggal = date('dmY', strtotime($tanggal_produksi));
        $query = $this->db3->query('
                                    SELECT t$prto as rfq,t$prdt as tgl_prod,t$pdno as pdno,t$mitm as mitm,t$cwar as cwar, t$qrdr as qty,t$prcd as line, t$osta as status 
                                    FROM baan.ttisfc001777 
                                    WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' order by t$pdno asc
                                ');
                                // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' and (t$osta = 5 or t$osta = 7) order by t$pdno asc
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

    public function getCT($part_no) {
        $query = $this->db2->query('
                                    SELECT * FROM cycle_time
                                    JOIN part_number on part_number.id_kode = cycle_time.id_kode
                                    WHERE part_number.part_number = \''.$part_no.'\' ORDER BY cycle_time.id_kode DESC
                                ');

        return $query->getResultArray();
    }

    public function getListBreakdown()
    {
        $query = $this->db->query('SELECT DISTINCT jenis_breakdown FROM data_breakdown');

        return $query->getResultArray();
    }

    public function getProsesBreakdown($jenis_breakdown)
    {
        $query = $this->db->query('SELECT * FROM data_breakdown WHERE jenis_breakdown = \''.$jenis_breakdown.'\'');

        return $query->getResultArray();
    }

    public function save_lhp($data)
    {
        $this->db->table('lhp_produksi2')->insert($data);

        return $this->db->insertID();
    }

    public function save_detail_lhp($data)
    {
        $builder = $this->db->table('detail_lhp_produksi2');
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function save_detail_breakdown($data)
    {
        $builder = $this->db->table('detail_breakdown');
        $builder->insert($data);
    }

    public function get_all_lhp()
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2');

        return $query->getResultArray();
    }

    public function get_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2 WHERE id_lhp_2 = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_detail_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_produksi2 WHERE id_lhp_2 = '.$id_lhp);

        return $query->getResultArray();
    }

    public function update_lhp($id_lhp, $data)
    {
        $builder = $this->db->table('lhp_produksi2');
        $builder->where('id_lhp_2', $id_lhp);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function update_detail_lhp($id_detail_lhp, $data)
    {
        $builder = $this->db->table('detail_lhp_produksi2');

        if ($id_detail_lhp != '') {
            $builder->where('id_detail_lhp', $id_detail_lhp);
            $builder->update($data);
            return $this->db->affectedRows();
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
        
    }

    public function get_detail_breakdown_by_id($id_detail_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown WHERE id_detail_lhp = '.$id_detail_lhp);

        return $query->getResultArray();
    }
}
?>