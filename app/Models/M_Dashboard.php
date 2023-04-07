<?php 
namespace App\Models;
use CodeIgniter\Model;



class M_Dashboard extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_data_all_line($tanggal, $line)
    {
        // $tanggal = date('Y-m-01');
        // $now = date('Y-m-d');

        $query = $this->db->query('SELECT tanggal_produksi, line, SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\' AND line = '.$line.'
                                    GROUP BY	tanggal_produksi, line');

        return $query->getResultArray();
    }

    public function get_data_line($tanggal, $line, $shift)
    {
        $query = $this->db->query('SELECT tanggal_produksi, line, shift, SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\' AND line = '.$line.' AND shift = '.$shift.'
                                    GROUP BY	shift, tanggal_produksi, line');

        return $query->getResultArray();
    }

    public function get_data_all_line_by_date($tanggal)
    {
        $query = $this->db->query('SELECT tanggal_produksi, SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\'
                                    GROUP BY	tanggal_produksi');

        return $query->getResultArray();
    }

    public function get_data_all_line_by_month($bulan, $line) 
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.'
                                        GROUP BY MONTH(tanggal_produksi)
                                        ORDER BY MONTH(tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE MONTH(tanggal_produksi) = '.$bulan.' AND line = '.$line.'
                                        GROUP BY MONTH(tanggal_produksi)
                                        ORDER BY MONTH(tanggal_produksi)
                                    ');
        }

        

        return $query->getResultArray();
    }

    public function get_data_all_line_by_year($line) 
    {
        $tahun = date('Y');

        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT YEAR(tanggal_produksi) AS month,SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE YEAR(tanggal_produksi) = '.$tahun.'
                                        GROUP BY YEAR(tanggal_produksi)
                                        ORDER BY YEAR(tanggal_produksi)
                                    ');
        } else {
            $query = $this->db->query('SELECT YEAR(tanggal_produksi) AS month,SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                        FROM lhp_produksi2 
                                        WHERE YEAR(tanggal_produksi) = '.$tahun.' AND line = '.$line.'
                                        GROUP BY YEAR(tanggal_produksi)
                                        ORDER BY YEAR(tanggal_produksi)
                                    ');
        }

        

        return $query->getResultArray();
    }

    public function get_data_line_stop($tanggal, $line)
    {
        if (!empty($line)) {
            $sql = 'AND lhp_produksi2.line = '.$line;
        } else {
            $sql = '';
        }
        
        $query = $this->db->query('SELECT * FROM lhp_produksi2
                                    JOIN detail_breakdown ON detail_breakdown.id_lhp = lhp_produksi2.id_lhp_2
                                    WHERE lhp_produksi2.tanggal_produksi = \''.$tanggal.'\''.$sql);

        return $query->getResultArray();
    }

    public function get_data_line_stop_by_shift($tanggal, $line, $shift)
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2
                                    JOIN detail_breakdown ON detail_breakdown.id_lhp = lhp_produksi2.id_lhp_2
                                    WHERE lhp_produksi2.tanggal_produksi = \''.$tanggal.'\' AND lhp_produksi2.line = '.$line.' AND lhp_produksi2.shift = '.$shift);

        return $query->getResultArray();
    }

    public function get_data_grup_by_line($month, $line) 
    {
        $bulan = idate('m', strtotime($month));
        $query = $this->db->query('SELECT DISTINCT(master_pic_line.nama_pic)
                                    FROM		lhp_produksi2
                                    JOIN        master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup
                                    WHERE		MONTH(lhp_produksi2.tanggal_produksi) = '.$bulan.' AND lhp_produksi2.line = '.$line.'
                                    GROUP BY	master_pic_line.nama_pic');

        return $query->getResultArray();
    }

    public function get_data_line_by_grup($tanggal, $line, $grup)
    {
        $query = $this->db->query('SELECT lhp_produksi2.tanggal_produksi, lhp_produksi2.line, master_pic_line.nama_pic ,SUM(lhp_produksi2.total_plan) AS total_plan, SUM(lhp_produksi2.total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    JOIN        master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup
                                    WHERE		lhp_produksi2.tanggal_produksi = \''.$tanggal.'\' AND lhp_produksi2.line = '.$line.' AND master_pic_line.nama_pic = \''.$grup.'\'
                                    GROUP BY	lhp_produksi2.tanggal_produksi, lhp_produksi2.line, master_pic_line.nama_pic');

        return $query->getResultArray();
    }

    public function get_data_line_stop_by_grup($tanggal, $line, $grup)
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2
                                    JOIN detail_breakdown ON detail_breakdown.id_lhp = lhp_produksi2.id_lhp_2
                                    JOIN master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup
                                    WHERE lhp_produksi2.tanggal_produksi = \''.$tanggal.'\' AND lhp_produksi2.line = '.$line.' AND master_pic_line.nama_pic = \''.$grup.'\'');

        return $query->getResultArray();
    }

    public function get_data_kss_by_line($month, $line) 
    {
        $bulan = idate('m', strtotime($month));
        $query = $this->db->query('SELECT DISTINCT(kasubsie)
                                    FROM		lhp_produksi2
                                    WHERE		MONTH(tanggal_produksi) = '.$bulan.' AND line = '.$line);

        return $query->getResultArray();
    }

    public function get_data_line_by_kss($tanggal, $line, $kss)
    {
        $query = $this->db->query('SELECT tanggal_produksi, line, kasubsie ,SUM(total_plan) AS total_plan, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_produksi2
                                    WHERE		tanggal_produksi = \''.$tanggal.'\' AND line = '.$line.' AND kasubsie = \''.$kss.'\'
                                    GROUP BY	tanggal_produksi, line, kasubsie');

        return $query->getResultArray();
    }

    public function get_data_line_stop_by_kss($tanggal, $line, $kss)
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2
                                    JOIN detail_breakdown ON detail_breakdown.id_lhp = lhp_produksi2.id_lhp_2
                                    WHERE lhp_produksi2.tanggal_produksi = \''.$tanggal.'\' AND lhp_produksi2.line = '.$line.' AND lhp_produksi2.kasubsie = \''.$kss.'\'');

        return $query->getResultArray();
    }
}