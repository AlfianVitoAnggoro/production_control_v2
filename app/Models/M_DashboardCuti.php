<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DashboardCuti extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_record_cuti_by_month($month, $year)
  {
    $date = date('Y-m-d');
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti dt_rac
                            JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_cuti_besar = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti_besar dt_rac
                            JOIN detail_record_all_cuti_besar d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_izin = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_izin dt_rac
                            JOIN detail_record_all_izin d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_sakit = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_sakit dt_rac
                            JOIN detail_record_all_sakit d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    return (array_merge($query->getResultArray(), $query_cuti_besar->getResultArray(), $query_izin->getResultArray(), $query_sakit->getResultArray()));
  }

  public function get_record_cuti_by_day($day, $month, $year)
  {
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti dt_rac
                            JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE DAY(d_rac.tanggal_cuti) = \'' . $day . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_cuti_besar = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti_besar dt_rac
                            JOIN detail_record_all_cuti_besar d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE DAY(d_rac.tanggal_cuti) = \'' . $day . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_izin = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_izin dt_rac
                            JOIN detail_record_all_izin d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE DAY(d_rac.tanggal_cuti) = \'' . $day . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_sakit = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_sakit dt_rac
                            JOIN detail_record_all_sakit d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE DAY(d_rac.tanggal_cuti) = \'' . $day . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    return (array_merge($query->getResultArray(), $query_cuti_besar->getResultArray(), $query_izin->getResultArray(), $query_sakit->getResultArray()));

    return $query->getResultArray();
  }
}
