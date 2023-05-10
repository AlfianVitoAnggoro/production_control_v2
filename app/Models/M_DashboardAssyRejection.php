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

    public function get_data_reject_by_month($bulan, $line)
    {
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                    FROM detail_reject 
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    GROUP BY detail_reject.jenis_reject
                                    ORDER BY SUM(detail_reject.qty_reject) DESC
                                ');
        } else {
            $query = $this->db->query('SELECT detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                    FROM detail_reject 
                                    JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                    WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
                                    AND lhp_produksi2.line = '.$line.'
                                    GROUP BY detail_reject.jenis_reject
                                    ORDER BY SUM(detail_reject.qty_reject) DESC
                                ');
        }
        
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

    // public function get_total_aktual_by_month($bulan) 
    // {
    //     $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), SUM(lhp_produksi2.total_aktual) as total_aktual
    //                                 FROM detail_reject
    //                                 RIGHT JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
    //                                 WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.'
    //                                 GROUP BY MONTH(lhp_produksi2.tanggal_produksi)
    //                                 ORDER BY MONTH(lhp_produksi2.tanggal_produksi)
    //                             ');
    //     return $query->getResultArray();
    // }

    public function get_total_aktual_by_month($bulan, $line) 
    {
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi), SUM(total_aktual) as total_aktual
                                        FROM lhp_produksi2
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.'
                                        GROUP BY MONTH(tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi), SUM(total_aktual) as total_aktual
                                        FROM lhp_produksi2
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.'
                                        AND line = '.$line.'
                                        GROUP BY MONTH(tanggal_produksi)
                                    ');
        }

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
                                    AND lhp_produksi2.line != 10
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

    public function get_detail_rejection_by_jenis($jenis_reject, $date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        GROUP BY detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_detail_rejection_by_type_battery($jenis_reject, $date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.type_battery, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        GROUP BY detail_reject.type_battery, detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.type_battery, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.type_battery, detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_data_reject_all_line_by_date($tanggal, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT tanggal_produksi, SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\'
                                    GROUP BY	tanggal_produksi');
        } else {
            $query = $this->db->query('SELECT tanggal_produksi, SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\' AND line = '.$line.'
                                    GROUP BY	tanggal_produksi');
        }
        
        return $query->getResultArray();
    }

    public function get_data_average_reject_by_month($bulan, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.'
                                        GROUP BY MONTH(tanggal_produksi)
                                        ORDER BY MONTH(tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.' AND line = '.$line.'
                                        GROUP BY MONTH(tanggal_produksi)
                                        ORDER BY MONTH(tanggal_produksi)
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_data_reject_all_line($tanggal, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT tanggal_produksi, line, SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\'
                                    GROUP BY	tanggal_produksi, line');
        } else {
            $query = $this->db->query('SELECT tanggal_produksi, line, SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\' AND line = '.$line.'
                                    GROUP BY	tanggal_produksi, line');
        }
        

        return $query->getResultArray();
    }

    public function get_data_reject_all_line_by_month($bulan, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.'
                                        GROUP BY MONTH(tanggal_produksi)
                                        ORDER BY MONTH(tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_reject) AS total_reject, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.' AND line = '.$line.'
                                        GROUP BY MONTH(tanggal_produksi)
                                        ORDER BY MONTH(tanggal_produksi)
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_qty_jenis_reject($tanggal, $line) 
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$tanggal.'\'
                                        GROUP BY detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$tanggal.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_detail_rejection_by_jenis_by_month($jenis_reject, $date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        GROUP BY detail_reject.kategori_reject, detail_reject.jenis_reject, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.kategori_reject, detail_reject.jenis_reject, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_detail_rejection_by_type_battery_by_month($jenis_reject, $date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.type_battery, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        GROUP BY detail_reject.type_battery, detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.type_battery, detail_reject.jenis_reject, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.type_battery, detail_reject.kategori_reject, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_all_detail_kategori_rejection_by_date($date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        GROUP BY detail_reject.kategori_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.kategori_reject, detail_reject.jenis_reject, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_all_detail_battery_rejection_by_date($date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.type_battery, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        GROUP BY detail_reject.type_battery, lhp_produksi2.tanggal_produksi
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi), detail_reject.type_battery, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.type_battery, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_all_detail_grup_rejection_by_date($date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, SUM(detail_reject.qty_reject) as total_reject, SUM(lhp_produksi2.total_aktual) as total_aktual
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        JOIN master_pic_line on master_pic_line.id_pic = lhp_produksi2.grup
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        GROUP BY lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, lhp_produksi2.tanggal_produksi
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, SUM(detail_reject.qty_reject) as total_reject, SUM(lhp_produksi2.total_aktual) as total_aktual
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        JOIN master_pic_line on master_pic_line.id_pic = lhp_produksi2.grup
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, lhp_produksi2.tanggal_produksi
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_all_detail_kategori_rejection_by_month($date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        GROUP BY detail_reject.kategori_reject, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, detail_reject.kategori_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE lhp_produksi2.tanggal_produksi = '.$date.'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.kategori_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_all_detail_battery_rejection_by_month($date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.type_battery, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        GROUP BY detail_reject.type_battery, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), detail_reject.type_battery, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY detail_reject.type_battery, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY  SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_all_detail_grup_rejection_by_month($date, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, SUM(detail_reject.qty_reject) as total_reject, SUM(lhp_produksi2.total_aktual) as total_aktual
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        JOIN master_pic_line on master_pic_line.id_pic = lhp_produksi2.grup
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        GROUP BY lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(lhp_produksi2.tanggal_produksi), lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, SUM(detail_reject.qty_reject) as total_reject, SUM(lhp_produksi2.total_aktual) as total_aktual
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        JOIN master_pic_line on master_pic_line.id_pic = lhp_produksi2.grup
                                        WHERE MONTH(lhp_produksi2.tanggal_produksi) = '.$date.'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, MONTH(lhp_produksi2.tanggal_produksi)
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_detail_rejection_by_grup($jenis_reject,$date,$line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        JOIN master_pic_line on master_pic_line.id_pic = lhp_produksi2.grup
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        GROUP BY lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                    ');
        } else {
            $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, detail_reject.jenis_reject, SUM(detail_reject.qty_reject) as qty
                                        FROM detail_reject
                                        JOIN lhp_produksi2 on lhp_produksi2.id_lhp_2 = detail_reject.id_lhp
                                        JOIN master_pic_line on master_pic_line.id_pic = lhp_produksi2.grup
                                        WHERE lhp_produksi2.tanggal_produksi = \''.$date.'\'
                                        AND detail_reject.jenis_reject = \''.$jenis_reject.'\'
                                        AND lhp_produksi2.line = '.$line.'
                                        GROUP BY lhp_produksi2.grup, master_pic_line.nama_pic, lhp_produksi2.shift, detail_reject.jenis_reject, lhp_produksi2.tanggal_produksi
                                        ORDER BY SUM(detail_reject.qty_reject) DESC
                                        
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_total_aktual_by_date($date, $line) 
    {
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT tanggal_produksi, SUM(total_aktual) as total_aktual
                                        FROM lhp_produksi2
                                        WHERE tanggal_produksi = \''.$date.'\'
                                        GROUP BY tanggal_produksi
                                    ');
        } else {
            $query = $this->db->query('SELECT tanggal_produksi, SUM(total_aktual) as total_aktual
                                        FROM lhp_produksi2
                                        WHERE tanggal_produksi = \''.$date.'\'
                                        AND line = '.$line.'
                                        GROUP BY tanggal_produksi
                                    ');
        }
        
        return $query->getResultArray();
    }
}