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

    // public function get_data_reject_by_month($bulan) 
    // {
    //     $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
    //                                 FROM detail_reject 
    //                                 RIGHT JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
    //                                 WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
    //                                 GROUP BY detail_reject.jenis_reject, MONTH(lhp_produksi2.tanggal_produksi)
    //                                 ORDER BY MONTH(lhp_produksi2.tanggal_produksi)
    //                             ');
    //     return $query->getResultArray();
    // }

    public function get_data_reject_by_month($bulan) 
    {
        $query = $this->db->query('SELECT detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                    FROM detail_reject 
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    GROUP BY detail_reject.jenis_reject
                                    ORDER BY SUM(detail_reject.qty_reject) DESC
                                ');
        return $query->getResultArray();
    }

    // public function get_total_data_reject_by_month($bulan) 
    // {
    //     $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), SUM(detail_reject.qty_reject) as qty
    //                                 FROM detail_reject
    //                                 JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
    //                                 WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
    //                                 GROUP BY MONTH(lhp_produksi2.tanggal_produksi)
    //                                 ORDER BY MONTH(lhp_produksi2.tanggal_produksi)
    //                             ');
    //     return $query->getResultArray();
    // }

    public function get_total_aktual_by_month($bulan) 
    {
        $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), SUM(lhp_produksi2.total_aktual) as total_aktual
                                    FROM detail_reject
                                    RIGHT JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    GROUP BY MONTH(lhp_produksi2.tanggal_produksi)
                                    ORDER BY MONTH(lhp_produksi2.tanggal_produksi)
                                ');
        return $query->getResultArray();
    }

    public function get_data_reject_by_date($tanggal, $jenis_reject, $line)
    {
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT		lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM		detail_reject
                                        JOIN		lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE		lhp_produksi2.tanggal_produksi = \''.$tanggal.'\'
                                        AND         detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        GROUP BY	detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                    ');
        } else {
            $query = $this->db->query('SELECT		lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM		detail_reject
                                        JOIN		lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE		lhp_produksi2.tanggal_produksi = \''.$tanggal.'\'
                                        AND         detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        AND         lhp_produksi2.line = '.$line.'
                                        GROUP BY	detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                    ');
        }
        
        return $query->getResultArray();
    }

    public function get_data_kategori_reject_by_date($tanggal, $jenis_reject, $kategori_reject)
    {
        $query = $this->db->query('SELECT		lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                    FROM		detail_reject
                                    JOIN		lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE		lhp_produksi2.tanggal_produksi = \''.$tanggal.'\'
                                    AND         detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                    AND         detail_reject.kategori_reject = \''.$kategori_reject.'\'
                                    GROUP BY	detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                ');
        return $query->getResultArray();
    }

    public function get_jenis_reject_by_month($month, $line) 
    {
        $bulan = idate('m', strtotime($month));
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT	DISTINCT(detail_reject.jenis_reject)
                                    FROM	detail_reject
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                ');
        } else {
            $query = $this->db->query('SELECT	DISTINCT(detail_reject.jenis_reject)
                                    FROM	detail_reject
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    AND lhp_produksi2.line = '.$line.'
                                ');
        }

        return $query->getResultArray();
    }

    public function get_kategori_reject_by_month($month, $jenis_reject) 
    {
        $bulan = idate('m', strtotime($month));
        $query = $this->db->query('SELECT	DISTINCT(detail_reject.kategori_reject)
                                    FROM	detail_reject
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                ');

        return $query->getResultArray();
    }

    public function get_data_total_reject_line_by_month($month) 
    {
        $bulan = idate('m', strtotime($month));
        $query = $this->db->query('SELECT	lhp_produksi2.line, SUM(detail_reject.qty_reject) as qty_reject, SUM(lhp_produksi2.total_aktual) as total_aktual, 
                                            ((SUM(detail_reject.qty_reject) / CAST(SUM(lhp_produksi2.total_aktual) as float)) * 100) as persen
                                    FROM	detail_reject
                                    RIGHT JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    GROUP BY lhp_produksi2.line
                                    ORDER BY ((SUM(detail_reject.qty_reject) / CAST(SUM(lhp_produksi2.total_aktual) as float)) * 100) DESC
                                ');

        return $query->getResultArray();
    }

    public function get_data_rejection_by_month($bulan, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT	MONTH(lhp_produksi2.tanggal_produksi), SUM(detail_reject.qty_reject) as total_reject, SUM(lhp_produksi2.total_aktual) as total_aktual
                                        FROM	detail_reject
                                        RIGHT JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                        GROUP BY MONTH(lhp_produksi2.tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT	MONTH(lhp_produksi2.tanggal_produksi), SUM(detail_reject.qty_reject) as total_reject, SUM(lhp_produksi2.total_aktual) as total_aktual
                                        FROM	detail_reject
                                        RIGHT JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY MONTH(lhp_produksi2.tanggal_produksi)
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_year_to_date_rejection($line)
    {
        $tahun = date('Y');

        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT YEAR(tanggal_produksi) AS month,SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE YEAR(tanggal_produksi) = '.$tahun.'
                                        GROUP BY YEAR(tanggal_produksi)
                                        ORDER BY YEAR(tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT YEAR(tanggal_produksi) AS month,SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE YEAR(tanggal_produksi) = '.$tahun.' AND line = '.$line.'
                                        GROUP BY YEAR(tanggal_produksi)
                                        ORDER BY YEAR(tanggal_produksi)
                                    ');
        }

        return $query->getResultArray();
    }
}