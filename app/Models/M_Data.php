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
                                    WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' and (t$osta = 5 or t$osta = 7) order by t$pdno asc
                                ');
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
        $query = $this->db->query('SELECT * FROM data_breakdown');

        return $query->getResultArray();
    }
}
?>