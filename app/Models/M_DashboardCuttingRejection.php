<?php 
namespace App\Models;
use CodeIgniter\Model;



class M_DashboardCuttingRejection extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_data_reject_internal_by_month($bulan, $line)
    {
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT SUM(terpotong_panel) AS terpotong, SUM(tersangkut_panel) AS tersangkut, SUM(overbrush_panel) AS overbrush
                                    FROM (
                                        SELECT p.date, SUM(pi.terpotong_panel) AS terpotong_panel, SUM(pi.tersangkut_panel) AS tersangkut_panel, SUM(pi.overbrush_panel) AS overbrush_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE MONTH(p.date) = \'' . $bulan . '\'
                                        AND p.line != 10
                                        GROUP BY p.date
                                    ) AS subquery
                                ');
        } else {
            $query = $this->db->query('SELECT SUM(terpotong_panel) AS terpotong, SUM(tersangkut_panel) AS tersangkut, SUM(overbrush_panel) AS overbrush
                                    FROM (
                                        SELECT p.date, SUM(pi.terpotong_panel) AS terpotong_panel, SUM(pi.tersangkut_panel) AS tersangkut_panel, SUM(pi.overbrush_panel) AS overbrush_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE MONTH(p.date) = \'' . $bulan . '\' AND p.line = \'' . $line . '\'
                                        GROUP BY p.date
                                    ) AS subquery
                                ');
        }
        
        return $query->getResultArray();
    }

    public function get_data_reject_eksternal_by_month($bulan, $line)
    {
        if ($line == null OR $line == 0) {
            $query = $this->db->query('SELECT SUM(rontok_panel) AS rontok, SUM(lug_patah_panel) AS lug_patah, SUM(patah_kaki_panel) AS patah_kaki, SUM(patah_frame_panel) AS patah_frame, SUM(bolong_panel) AS bolong, SUM(bending_panel) AS bending, SUM(lengket_terpotong_panel) AS lengket_terpotong
                                    FROM (
                                        SELECT p.date, SUM(pi.rontok_panel) AS rontok_panel, SUM(pi.lug_patah_panel) AS lug_patah_panel, SUM(pi.patah_kaki_panel) AS patah_kaki_panel, SUM(pi.patah_frame_panel) AS patah_frame_panel, SUM(pi.bolong_panel) AS bolong_panel, SUM(pi.bending_panel) AS bending_panel, SUM(pi.lengket_terpotong_panel) AS lengket_terpotong_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE MONTH(p.date) = \'' . $bulan . '\'
                                        AND p.line != 10
                                        GROUP BY p.date
                                    ) AS subquery
                                ');
        } else {
            $query = $this->db->query('SELECT SUM(rontok_panel) AS rontok, SUM(lug_patah_panel) AS lug_patah, SUM(patah_kaki_panel) AS patah_kaki, SUM(patah_frame_panel) AS patah_frame, SUM(bolong_panel) AS bolong, SUM(bending_panel) AS bending, SUM(lengket_terpotong_panel) AS lengket_terpotong
                                    FROM (
                                        SELECT p.date, SUM(pi.rontok_panel) AS rontok_panel, SUM(pi.lug_patah_panel) AS lug_patah_panel, SUM(pi.patah_kaki_panel) AS patah_kaki_panel, SUM(pi.patah_frame_panel) AS patah_frame_panel, SUM(pi.bolong_panel) AS bolong_panel, SUM(pi.bending_panel) AS bending_panel, SUM(pi.lengket_terpotong_panel) AS lengket_terpotong_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE MONTH(p.date) = \'' . $bulan . '\' AND p.line = \'' . $line . '\'
                                        GROUP BY p.date
                                    ) AS subquery
                                ');
        }
        
        return $query->getResultArray();
    }

    public function get_data_total_reject_line_by_month($month) 
    {
        $bulan = idate('m', strtotime($month));
        $query = $this->db->query('SELECT subquery.line, ((SUM(total_reject) / SUM(total_produksi)) * 100) AS persen
                                FROM (
                                    SELECT p.line, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject, SUM(pi.hasil_produksi) AS total_produksi
                                    FROM plateinput pi
                                    JOIN platecutting p ON pi.id_platecutting = p.id
                                    WHERE MONTH(p.date) = \'' . $bulan . '\' AND p.line != 10
                                    GROUP BY p.line
                                ) AS subquery
                                GROUP BY subquery.line
                                ORDER BY ((SUM(total_reject) / SUM(total_produksi)) * 100) DESC
                                ');

        return $query->getResultArray();
    }

    public function get_data_rejection_by_month($bulan, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT subquery.bulan, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                      FROM (
                                          SELECT MONTH(p.date) AS bulan, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                          FROM plateinput pi
                                          JOIN platecutting p ON pi.id_platecutting = p.id
                                          WHERE MONTH(p.date) = \'' . $bulan . '\'
                                          AND p.line != 10
                                          GROUP BY MONTH(p.date)
                                      ) AS subquery
									                    GROUP BY subquery.bulan
                                    ');
        } else {
            $query = $this->db->query('SELECT subquery.bulan, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                      FROM (
                                          SELECT MONTH(p.date) AS bulan, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                          FROM plateinput pi
                                          JOIN platecutting p ON pi.id_platecutting = p.id
                                          WHERE MONTH(p.date) = \'' . $bulan . '\' AND p.line = \'' . $line . '\'
                                          GROUP BY MONTH(p.date)
                                      ) AS subquery
									                    GROUP BY subquery.bulan
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_year_to_date_rejection($line)
    {
        $tahun = date('Y');

        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT subquery.tahun, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                      FROM (
                                          SELECT YEAR(p.date) AS tahun, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                          FROM plateinput pi
                                          JOIN platecutting p ON pi.id_platecutting = p.id
                                          WHERE YEAR(p.date) = \'' . $tahun . '\'
                                          AND p.line != 10
                                          GROUP BY YEAR(p.date)
                                      ) AS subquery
                                      GROUP BY subquery.tahun
                                      ORDER BY subquery.tahun
                                      ');
        } else {
            $query = $this->db->query('SELECT subquery.tahun, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                      FROM (
                                          SELECT YEAR(p.date) AS tahun, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                          FROM plateinput pi
                                          JOIN platecutting p ON pi.id_platecutting = p.id
                                          WHERE YEAR(p.date) = \'' . $tahun . '\' AND p.line = \'' . $line . '\'
                                          GROUP BY YEAR(p.date)
                                      ) AS subquery
                                      GROUP BY subquery.tahun
                                      ORDER BY subquery.tahun
                                      ');
        }

        return $query->getResultArray();
    }

    public function get_data_reject_all_line_by_date($tanggal, $line)
    {
        if ($line == null || $line == 0) {
            // $query = $this->db->query('SELECT subquery.date, SUM(total_reject_internal) / SUM(total_produksi) AS persentase_reject_internal, SUM(total_reject_eksternal) / SUM(total_produksi) AS persentase_reject_eksternal
            //                           FROM (
            //                               SELECT p.date, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) AS total_reject_internal, SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject_eksternal
            //                               FROM plateinput pi
            //                               JOIN platecutting p ON pi.id_platecutting = p.id
            //                               WHERE p.date = \'' . $tanggal . '\'
            //                               AND p.line != 10
            //                               GROUP BY p.date
            //                           ) AS subquery
			// 						  GROUP BY subquery.date');
            $query = $this->db->query('SELECT subquery.date,
                                        COALESCE(SUM(total_reject_internal) / NULLIF(SUM(total_produksi), 0), 0) AS persentase_reject_internal,
                                        COALESCE(SUM(total_reject_eksternal) / NULLIF(SUM(total_produksi), 0), 0) AS persentase_reject_eksternal
                                        FROM (
                                            SELECT
                                                p.date,
                                                SUM(pi.hasil_produksi) AS total_produksi,
                                                SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) AS total_reject_internal,
                                                SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject_eksternal
                                            FROM plateinput pi
                                            JOIN platecutting p ON pi.id_platecutting = p.id
                                            WHERE p.date = \'' . $tanggal . '\'
                                            AND p.line != 10
                                            GROUP BY p.date
                                        ) AS subquery
                                        GROUP BY subquery.date');
                                      
        } else {
            // $query = $this->db->query('SELECT subquery.date, SUM(total_reject_internal) / SUM(total_produksi) AS persentase_reject_internal, SUM(total_reject_eksternal) / SUM(total_produksi) AS persentase_reject_eksternal
            //                           FROM (
            //                               SELECT p.date, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) AS total_reject_internal, SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject_eksternal
            //                               FROM plateinput pi
            //                               JOIN platecutting p ON pi.id_platecutting = p.id
            //                               WHERE p.date = \'' . $tanggal . '\' AND p.line = \'' . $line . '\'
            //                               GROUP BY p.date
            //                           ) AS subquery
			// 						  GROUP BY subquery.date');
            $query = $this->db->query('SELECT subquery.date,
                                        COALESCE(SUM(total_reject_internal) / NULLIF(SUM(total_produksi), 0), 0) AS persentase_reject_internal,
                                        COALESCE(SUM(total_reject_eksternal) / NULLIF(SUM(total_produksi), 0), 0) AS persentase_reject_eksternal
                                        FROM (
                                            SELECT
                                                p.date,
                                                SUM(pi.hasil_produksi) AS total_produksi,
                                                SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) AS total_reject_internal,
                                                SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject_eksternal
                                            FROM plateinput pi
                                            JOIN platecutting p ON pi.id_platecutting = p.id
                                            WHERE p.date = \'' . $tanggal . '\' AND p.line = \'' . $line . '\'
                                            AND p.line != 10
                                            GROUP BY p.date
                                        ) AS subquery
                                        GROUP BY subquery.date');
        }
        
        return $query->getResultArray();
    }

    public function get_data_average_reject_by_month($bulan, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT subquery.bulan, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                      FROM (
                                          SELECT MONTH(p.date) AS bulan, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                          FROM plateinput pi
                                          JOIN platecutting p ON pi.id_platecutting = p.id
                                          WHERE MONTH(p.date) = \'' . $bulan . '\'
                                          AND p.line != 10
                                          GROUP BY MONTH(p.date)
                                      ) AS subquery
									                    GROUP BY subquery.bulan
                                      ORDER BY subquery.bulan
                                      ');
        } else {
            $query = $this->db->query('SELECT subquery.bulan, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                      FROM (
                                          SELECT MONTH(p.date) AS bulan, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                          FROM plateinput pi
                                          JOIN platecutting p ON pi.id_platecutting = p.id
                                          WHERE MONTH(p.date) = \'' . $bulan . '\' AND p.line = \'' . $line . '\'
                                          GROUP BY MONTH(p.date)
                                      ) AS subquery
									                    GROUP BY subquery.bulan
                                      ORDER BY subquery.bulan
                                      ');
        }

        return $query->getResultArray();
    }

    public function get_data_reject_all_line($tanggal, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT subquery.date, subquery.line, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                    FROM (
                                        SELECT p.date, p.line, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE p.date = \''.$tanggal.'\'
                                        AND p.line != 10
                                        GROUP BY p.date, p.line
                                    ) AS subquery
                                    GROUP BY subquery.date, subquery.line');
        } else {
            $query = $this->db->query('SELECT subquery.date, subquery.line, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                    FROM (
                                        SELECT p.date, p.line, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE p.date = \''.$tanggal.'\' AND line = '.$line.'
                                        GROUP BY p.date, p.line
                                    ) AS subquery
                                    GROUP BY subquery.date, subquery.line');
        }
        

        return $query->getResultArray();
    }

    public function get_data_reject_all_line_by_month($bulan, $line)
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT subquery.bulan, subquery.line, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                    FROM (
                                        SELECT MONTH(p.date) AS bulan, p.line, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE MONTH(p.date) = \''.$bulan.'\'
                                        AND p.line != 10
                                        GROUP BY p.date, p.line
                                    ) AS subquery
                                    GROUP BY subquery.bulan, subquery.line
                                    ');
        } else {
            $query = $this->db->query('SELECT subquery.bulan, subquery.line, SUM(total_reject) AS total_reject, SUM(total_produksi) AS total_produksi
                                    FROM (
                                        SELECT MONTH(p.date) AS bulan, p.line, SUM(pi.hasil_produksi) AS total_produksi, SUM(pi.terpotong_panel) + SUM(pi.tersangkut_panel) + SUM(pi.overbrush_panel) + SUM(pi.rontok_panel) + SUM(pi.lug_patah_panel) + SUM(pi.patah_kaki_panel) + SUM(pi.patah_frame_panel) + SUM(pi.bolong_panel) + SUM(pi.bending_panel) + SUM(pi.lengket_terpotong_panel) AS total_reject
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE MONTH(p.date) = \''.$bulan.'\' AND line = '.$line.'
                                        GROUP BY p.date, p.line
                                    ) AS subquery
                                    GROUP BY subquery.bulan, subquery.line
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_qty_jenis_reject_internal($tanggal, $line) 
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT SUM(terpotong_panel) AS terpotong, SUM(tersangkut_panel) AS tersangkut, SUM(overbrush_panel) AS overbrush
                                    FROM (
                                        SELECT p.date, SUM(pi.terpotong_panel) AS terpotong_panel, SUM(pi.tersangkut_panel) AS tersangkut_panel, SUM(pi.overbrush_panel) AS overbrush_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE p.date = \'' . $tanggal . '\'
                                        AND p.line != 10
                                        GROUP BY p.date
                                    ) AS subquery
                                    ');
        } else {
            $query = $this->db->query('SELECT SUM(terpotong_panel) AS terpotong, SUM(tersangkut_panel) AS tersangkut, SUM(overbrush_panel) AS overbrush
                                    FROM (
                                        SELECT p.date, SUM(pi.terpotong_panel) AS terpotong_panel, SUM(pi.tersangkut_panel) AS tersangkut_panel, SUM(pi.overbrush_panel) AS overbrush_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE p.date = \'' . $tanggal . '\' AND p.line = \'' . $line . '\'
                                        GROUP BY p.date
                                    ) AS subquery
                                    ');
        }

        return $query->getResultArray();
    }

    public function get_qty_jenis_reject_eksternal($tanggal, $line) 
    {
        if ($line == null || $line == 0) {
            $query = $this->db->query('SELECT SUM(rontok_panel) AS rontok, SUM(lug_patah_panel) AS lug_patah, SUM(patah_kaki_panel) AS patah_kaki, SUM(patah_frame_panel) AS patah_frame, SUM(bolong_panel) AS bolong, SUM(bending_panel) AS bending, SUM(lengket_terpotong_panel) AS lengket_terpotong
                                    FROM (
                                        SELECT p.date, SUM(pi.rontok_panel) AS rontok_panel, SUM(pi.lug_patah_panel) AS lug_patah_panel, SUM(pi.patah_kaki_panel) AS patah_kaki_panel, SUM(pi.patah_frame_panel) AS patah_frame_panel, SUM(pi.bolong_panel) AS bolong_panel, SUM(pi.bending_panel) AS bending_panel, SUM(pi.lengket_terpotong_panel) AS lengket_terpotong_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE p.date = \'' . $tanggal . '\'
                                        AND p.line != 10
                                        GROUP BY p.date
                                    ) AS subquery
                                    ');
        } else {
            $query = $this->db->query('SELECT SUM(rontok_panel) AS rontok, SUM(lug_patah_panel) AS lug_patah, SUM(patah_kaki_panel) AS patah_kaki, SUM(patah_frame_panel) AS patah_frame, SUM(bolong_panel) AS bolong, SUM(bending_panel) AS bending, SUM(lengket_terpotong_panel) AS lengket_terpotong
                                    FROM (
                                        SELECT p.date, SUM(pi.rontok_panel) AS rontok_panel, SUM(pi.lug_patah_panel) AS lug_patah_panel, SUM(pi.patah_kaki_panel) AS patah_kaki_panel, SUM(pi.patah_frame_panel) AS patah_frame_panel, SUM(pi.bolong_panel) AS bolong_panel, SUM(pi.bending_panel) AS bending_panel, SUM(pi.lengket_terpotong_panel) AS lengket_terpotong_panel
                                        FROM plateinput pi
                                        JOIN platecutting p ON pi.id_platecutting = p.id
                                        WHERE p.date = \'' . $tanggal . '\' AND p.line = \'' . $line . '\'
                                        GROUP BY p.date
                                    ) AS subquery
                                    ');
        }

        return $query->getResultArray();
    }
}