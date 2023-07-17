<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DashboardCuti extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');
    // $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  // public function get_record_cuti_by_month($month, $year)
  // {
  //   $query = $this->db->query('SELECT * FROM data_record_all_cuti dt_rac
  //                             JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  //                             WHERE MONTH(tanggal_cuti) = \'' . $month . '\' AND YEAR(tanggal_cuti) = \'' . $year . '\'');

  //   return $query->getResultArray();
  // }
  // public function get_record_cuti_by_month($month, $year)
  // {
  //   $date = date('Y-m-d');
  //   $query = $this->db->query('SELECT drc.keterangan AS kategori, dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
  //                           JOIN data_record_all_cuti dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
  //                           JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\' AND drc.keterangan = \'Cuti\'');
  //   $query_cuti_besar = $this->db->query('SELECT drc.keterangan AS kategori, dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
  //                           JOIN data_record_all_cuti_besar dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
  //                           JOIN detail_record_all_cuti_besar d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\' AND drc.keterangan = \'Cuti Besar\'');
  //   $query_izin = $this->db->query('SELECT drc.keterangan AS kategori, dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
  //                           JOIN data_record_all_izin dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
  //                           JOIN detail_record_all_izin d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\' AND drc.keterangan = \'Izin\'');
  //   $query_skd = $this->db->query('SELECT drc.keterangan AS kategori, dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
  //                           JOIN data_record_all_skd dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
  //                           JOIN detail_record_all_skd d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\' AND drc.keterangan = \'SKD\'');
  //   $query_dispensasi = $this->db->query('SELECT drc.keterangan AS kategori, dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
  //                           JOIN data_record_all_dispensasi dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
  //                           JOIN detail_record_all_dispensasi d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\' AND drc.keterangan = \'Dispensasi\'');
  //   return (array_merge($query->getResultArray(), $query_cuti_besar->getResultArray(), $query_izin->getResultArray(), $query_skd->getResultArray(), $query_dispensasi->getResultArray()));
  // }

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
    $query_skd = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_skd dt_rac
                            JOIN detail_record_all_skd d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    $query_dispensasi = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_dispensasi dt_rac
                            JOIN detail_record_all_dispensasi d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE d_rac.tanggal_cuti >= \'' . $date . '\' AND MONTH(d_rac.tanggal_cuti) = \'' . $month . '\' AND YEAR(d_rac.tanggal_cuti) = \'' . $year . '\'');
    return (array_merge($query->getResultArray(), $query_cuti_besar->getResultArray(), $query_izin->getResultArray(), $query_skd->getResultArray(), $query_dispensasi->getResultArray()));
  }

  public function get_record_cuti_by_day($day, $month, $year)
  {
    $query = $this->db->query('SELECT drc.keterangan AS kategori, dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
                            JOIN data_record_all_cuti dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
                            JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE DAY(tanggal_cuti) = \'' . $day . '\' AND MONTH(tanggal_cuti) = \'' . $month . '\' AND YEAR(tanggal_cuti) = \'' . $year . '\' AND drc.keterangan = \'Cuti\'');

    return $query->getResultArray();
  }
}
