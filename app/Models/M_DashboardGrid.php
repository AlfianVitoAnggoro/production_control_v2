<?php

namespace App\Models;

use CodeIgniter\Model;



class M_DashboardGrid extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();

    $this->session = \Config\Services::session();
  }

  public function get_data_all_by_year($month)
  {
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT YEAR(date_production) AS year,SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual FROM lhp_grid WHERE YEAR(date_production) = ' . $year . ' GROUP BY YEAR(date_production) ORDER BY YEAR(date_production)');
    return $query->getResultArray();
  }

  public function get_data_all_by_month($bulan, $year)
  {
    $year = idate('Y', strtotime($year));
    $query = $this->db->query('SELECT MONTH(date_production) AS month,SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual
                                      FROM lhp_grid 
                                      WHERE MONTH(date_production) = ' . $bulan . ' AND YEAR(date_production) = ' . $year . '
                                      GROUP BY MONTH(date_production)
                                      ORDER BY MONTH(date_production)
                                  ');
    return $query->getResultArray();
  }

  public function get_data_all_by_date($tanggal, $month)
  {
    $month = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT date_production, SUM(total_jks) AS total_jks, SUM(total_aktual) AS total_aktual
                                    FROM		lhp_grid
                                    WHERE		date_production = \'' . $tanggal . '\' AND MONTH(date_production) = \'' . $month . '\' AND YEAR(date_production) = \'' . $year . '\'
                                    GROUP BY	date_production');

    return $query->getResultArray();
  }

  public function get_data_grup($month)
  {
    $bulan = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT DISTINCT(lhp_grid.grup)
                                    FROM lhp_grid
                                    WHERE MONTH(lhp_grid.date_production) = ' . $bulan . ' AND YEAR(lhp_grid.date_production) = ' . $year . '
                                    GROUP BY	lhp_grid.grup');

    return $query->getResultArray();
  }

  public function get_data_by_grup($tanggal, $grup)
  {
    $query = $this->db->query('SELECT lhp_grid.date_production, lhp_grid.grup ,SUM(lhp_grid.total_jks) AS total_jks, SUM(lhp_grid.total_aktual) AS total_aktual
                                    FROM lhp_grid
                                    WHERE lhp_grid.date_production = \'' . $tanggal . '\' AND lhp_grid.grup = \'' . $grup . '\'
                                    GROUP BY	lhp_grid.date_production, lhp_grid.grup');

    return $query->getResultArray();
  }

  public function get_data_all_grup_by_previous_month($month)
  {
    $previous_month = idate('m', strtotime($month . '- 1 month'));
    $year = idate('Y', strtotime($month . '- 1 month'));
    $query = $this->db->query('SELECT lhp_grid.grup, lhp_grid.date_production, SUM(lhp_grid.total_jks) AS total_jks, SUM(lhp_grid.total_aktual) AS total_aktual
                                    FROM lhp_grid
                                    WHERE MONTH(lhp_grid.date_production) = \'' . $previous_month . '\' AND YEAR(lhp_grid.date_production) = \'' . $year . '\'
                                    GROUP BY lhp_grid.date_production, lhp_grid.grup');

    return $query->getResultArray();
  }

  public function get_data_all_grup_by_current_month($month)
  {
    $current_month = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query('SELECT lhp_grid.grup, lhp_grid.date_production, SUM(lhp_grid.total_jks) AS total_jks, SUM(lhp_grid.total_aktual) AS total_aktual
                                    FROM lhp_grid
                                    WHERE MONTH(lhp_grid.date_production) = \'' . $current_month . '\' AND YEAR(lhp_grid.date_production) = \'' . $year . '\'
                                    GROUP BY lhp_grid.date_production, lhp_grid.grup');

    return $query->getResultArray();
  }

  public function get_data_all_mp_by_current_month($month)
  {
    $current_month = idate('m', strtotime($month));
    $year = idate('Y', strtotime($month));
    $query = $this->db->query(
      'SELECT DISTINCT MONTH(lhp_grid.date_production) AS month, detail_lhp_grid.operator_name, detail_lhp_grid.jks, detail_lhp_grid.actual
                                    FROM detail_lhp_grid
                                    JOIN lhp_grid ON lhp_grid.id = detail_lhp_grid.id_lhp_grid
                                    WHERE MONTH(lhp_grid.date_production) = \'' . $current_month . '\' AND YEAR(lhp_grid.date_production) = \'' . $year . '\''
    );

    return $query->getResultArray();
  }

  public function get_data_all_mp_by_previous_month($month)
  {
    $previous_month = idate('m', strtotime($month . '- 1 month'));
    $year = idate('Y', strtotime($month . '- 1 month'));
    $query = $this->db->query(
      'SELECT DISTINCT MONTH(lhp_grid.date_production) AS month, detail_lhp_grid.operator_name, detail_lhp_grid.jks, detail_lhp_grid.actual
                                    FROM detail_lhp_grid
                                    JOIN lhp_grid ON lhp_grid.id = detail_lhp_grid.id_lhp_grid
                                    WHERE MONTH(lhp_grid.date_production) = \'' . $previous_month . '\' AND YEAR(lhp_grid.date_production) = \'' . $year . '\''
    );

    return $query->getResultArray();
  }
}
