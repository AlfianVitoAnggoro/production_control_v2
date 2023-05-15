<?php

namespace App\Models;

use CodeIgniter\Model;



class M_DashboardPasting extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();

    $this->session = \Config\Services::session();
  }

  public function get_data_all_by_year($month)
  {
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT YEAR(tanggal_produksi) AS year,SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual FROM lhp_pasting WHERE YEAR(tanggal_produksi) = ' . $year . ' GROUP BY YEAR(tanggal_produksi) ORDER BY YEAR(tanggal_produksi)');
    return $query->getResultArray();
  }

  public function get_data_all_by_month($bulan, $year)
  {
    $year = idate('Y', strtotime($year));
    $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual
                                      FROM lhp_pasting
                                      WHERE MONTH(tanggal_produksi) = ' . $bulan . ' AND YEAR(tanggal_produksi) = ' . $year . '
                                      GROUP BY MONTH(tanggal_produksi)
                                      ORDER BY MONTH(tanggal_produksi)
                                  ');
    return $query->getResultArray();
  }

  public function get_data_all_by_date($tanggal, $month)
  {
    $bulan = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT tanggal_produksi, SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual
                                    FROM lhp_pasting
                                    WHERE tanggal_produksi = \'' . $tanggal . '\' AND MONTH(tanggal_produksi) = \'' . $bulan . '\' AND YEAR(tanggal_produksi) = \'' . $year . '\'
                                    GROUP BY tanggal_produksi');
    return $query->getResultArray();
  }

  public function get_data_grup($month)
  {
    $bulan = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT DISTINCT(lhp_pasting.grup)
                                    FROM lhp_pasting
                                    WHERE MONTH(lhp_pasting.tanggal_produksi) = ' . $bulan . ' AND YEAR(lhp_pasting.tanggal_produksi) = ' . $year . '
                                    GROUP BY lhp_pasting.grup');

    return $query->getResultArray();
  }

  public function get_data_by_grup($tanggal, $grup)
  {
    $query = $this->db->query('SELECT lhp_pasting.tanggal_produksi, lhp_pasting.grup ,SUM(lhp_pasting.total_jks) AS total_jks, SUM(lhp_pasting.total_aktual) AS total_aktual
                                    FROM lhp_pasting
                                    WHERE lhp_pasting.tanggal_produksi = \'' . $tanggal . '\' AND lhp_pasting.grup = \'' . $grup . '\'
                                    GROUP BY	lhp_pasting.tanggal_produksi, lhp_pasting.grup');

    return $query->getResultArray();
  }

  public function get_data_all_grup_by_previous_month($month)
  {
    $previous_month = idate('m', strtotime($month . '- 1 month'));
    $year = idate('Y', strtotime($month . '- 1 month'));
    $query = $this->db->query('SELECT lhp_pasting.grup, lhp_pasting.tanggal_produksi, SUM(lhp_pasting.total_jks) AS total_jks, SUM(lhp_pasting.total_aktual) AS total_aktual
                                    FROM lhp_pasting
                                    WHERE MONTH(lhp_pasting.tanggal_produksi) = \'' . $previous_month . '\' AND YEAR(lhp_pasting.tanggal_produksi) = \'' . $year . '\'
                                    GROUP BY lhp_pasting.tanggal_produksi, lhp_pasting.grup');

    return $query->getResultArray();
  }

  public function get_data_all_grup_by_current_month($month)
  {
    $current_month = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT lhp_pasting.grup, lhp_pasting.tanggal_produksi, SUM(lhp_pasting.total_jks) AS total_jks, SUM(lhp_pasting.total_aktual) AS total_aktual
                                    FROM lhp_pasting
                                    WHERE MONTH(lhp_pasting.tanggal_produksi) = \'' . $current_month . '\' AND YEAR(lhp_pasting.tanggal_produksi) = \'' . $year . '\'
                                    GROUP BY lhp_pasting.tanggal_produksi, lhp_pasting.grup');

    return $query->getResultArray();
  }

  // public function get_data_all_mesin_by_month($bulan, $mesin_pasting) 
  //   {
  //       $bulan = idate('m', strtotime($bulan));
  //       if ($mesin_pasting == null || $mesin_pasting == 0) {
  //           $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual
  //                                       FROM lhp_pasting 
  //                                       WHERE MONTH(tanggal_produksi) = '.$bulan.'
  //                                       GROUP BY MONTH(tanggal_produksi)
  //                                       ORDER BY MONTH(tanggal_produksi)
  //                                   ');
  //       } else {
  //           $query = $this->db->query('SELECT MONTH(tanggal_produksi) AS month,SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual
  //                                       FROM lhp_pasting 
  //                                       WHERE MONTH(tanggal_produksi) = '.$bulan.' AND mesin_pasting = '.($mesin_pasting - 1).'
  //                                       GROUP BY MONTH(tanggal_produksi)
  //                                       ORDER BY MONTH(tanggal_produksi)
  //                                   ');
  //       }

        

  //       return $query->getResultArray();
  //   }

  // public function get_data_all_mp_by_current_month($month)
  // {
  //   $current_month = idate('m', strtotime($month));
  //   $year = idate('Y', strtotime($month));
  //   $query = $this->db->query(
  //     'SELECT DISTINCT MONTH(lhp_pasting.tanggal_produksi) AS month, detail_lhp_pasting.operator_name, detail_lhp_pasting.jks, detail_lhp_pasting.actual
  //                                   FROM detail_lhp_pasting
  //                                   JOIN lhp_pasting ON lhp_pasting.id_lhp_pasting = detail_lhp_pasting.id_lhp_pasting
  //                                   WHERE MONTH(lhp_pasting.tanggal_produksi) = \'' . $current_month . '\' AND YEAR(lhp_pasting.tanggal_produksi) = \'' . $year . '\''
  //   );

  //   return $query->getResultArray();
  // }

  public function get_data_all_mp_by_previous_month($month)
  {
    $previous_month = idate('m', strtotime($month . '- 1 month'));
    $year = idate('Y', strtotime($month . '- 1 month'));
    $query = $this->db->query(
      'SELECT DISTINCT MONTH(lhp_pasting.tanggal_produksi) AS month, detail_lhp_pasting.operator_name, detail_lhp_pasting.jks, detail_lhp_pasting.actual
                                    FROM detail_lhp_pasting
                                    JOIN lhp_pasting ON lhp_pasting.id_lhp_pasting = detail_lhp_pasting.id_lhp_pasting
                                    WHERE MONTH(lhp_pasting.tanggal_produksi) = \'' . $previous_month . '\' AND YEAR(lhp_pasting.tanggal_produksi) = \'' . $year . '\''
    );

    return $query->getResultArray();
  }

  public function get_data_line_stop($tanggal)
  {
    $query = $this->db->query('SELECT * FROM lhp_pasting
                                    JOIN detail_breakdown_lhp_pasting ON detail_breakdown_lhp_pasting.id_lhp_pasting = lhp_pasting.id_lhp_pasting
                                    JOIN data_mesin_pasting ON data_mesin_pasting.id_mesin_pasting = lhp_pasting.mesin_pasting
                                    WHERE lhp_pasting.tanggal_produksi = \'' . $tanggal . '\'');
    
    return $query->getResultArray();
  }
}
