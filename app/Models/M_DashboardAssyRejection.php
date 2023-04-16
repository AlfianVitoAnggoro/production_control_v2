<?php 
namespace App\Models;
use CodeIgniter\Model;



class M_DashboardAssyRejection extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_data_reject_by_month($bulan) 
    {
        $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                    FROM detail_reject 
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    GROUP BY detail_reject.jenis_reject, MONTH(lhp_produksi2.tanggal_produksi)
                                    ORDER BY MONTH(lhp_produksi2.tanggal_produksi)
                                ');
        return $query->getResultArray();
    }

    public function get_total_data_reject_by_month($bulan) 
    {
        $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), SUM(detail_reject.qty_reject) as qty
                                    FROM detail_reject
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    GROUP BY MONTH(lhp_produksi2.tanggal_produksi)
                                    ORDER BY MONTH(lhp_produksi2.tanggal_produksi)
                                ');
        return $query->getResultArray();
    }

    public function get_data_reject_by_date($tanggal, $jenis_reject)
    {
        $query = $this->db->query('SELECT		lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                    FROM		detail_reject
                                    JOIN		lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE		lhp_produksi2.tanggal_produksi = \''.$tanggal.'\'
                                    AND         detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                    GROUP BY	detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                ');
        return $query->getResultArray();
    }

    public function get_jenis_reject_by_month($month) 
    {
        $bulan = idate('m', strtotime($month));
        $query = $this->db->query('SELECT	DISTINCT(detail_reject.jenis_reject)
                                    FROM	detail_reject
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                ');

        return $query->getResultArray();
    }
}