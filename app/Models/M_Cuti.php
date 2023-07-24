<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Cuti extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');
    // $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_man_power()
  {
    $query = $this->db->query('SELECT id_man_power, nama FROM master_data_man_power ORDER BY nama ASC');

    return $query->getResultArray();
  }

  public function get_data_mp($id_man_power)
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                            JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                            WHERE id_man_power =\'' . $id_man_power . '\'
                          ');

    $results = $query->getResultArray();
    if (count($results) == 0) {
      $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                            JOIN detail_master_data_group_man_power_indirect dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                            WHERE id_man_power =\'' . $id_man_power . '\'
                          ');
      $results = $query->getResultArray();
    }

    return $results;
  }

  public function get_data_mp_absen_by_daily($date, $line, $group_mp, $bagian)
  {
    // $query = $this->db->query('SELECT drc.*, mdmp.nama AS nama_mp FROM detail_record_cuti drc
    //                         JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
    //                         ORDER BY tanggal DESC
    //                         ');
    if ($line != '') {
      $query_cuti = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_cuti drac
                              JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                              JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                              JOIN detail_record_all_cuti drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                              ');
      $query_izin = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_izin drac
                              JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                              JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                              JOIN detail_record_all_izin drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                              ');
      $query_cuti_besar = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_cuti_besar drac
                              JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                              JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                              JOIN detail_record_all_cuti_besar drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                              ');
      $query_dispensasi = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_dispensasi drac
                              JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                              JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                              JOIN detail_record_all_dispensasi drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                              ');
      $query_skd = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_skd drac
                              JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                              JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                              JOIN detail_record_all_skd drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                              ');

      $data = array_merge($query_cuti->getResultArray(), $query_izin->getResultArray(), $query_cuti_besar->getResultArray(), $query_dispensasi->getResultArray(), $query_skd->getResultArray());
      // $tanggal = array_column($data, 'tanggal');
      // $created_at = array_column($data, 'created_at');
      // array_multisort($tanggal, SORT_DESC, $created_at, SORT_ASC, $data);
      return $data;
    } else {
      $query_cuti = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_cuti drac
                                JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                                JOIN detail_master_data_group_man_power_indirect dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                                JOIN detail_record_all_cuti drc ON drc.id_cuti = drac.id_cuti
                                WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.sub_bagian = \'' . $bagian . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                                ');
      $query_izin = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_izin drac
                                JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                                JOIN detail_master_data_group_man_power_indirect dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                                JOIN detail_record_all_izin drc ON drc.id_cuti = drac.id_cuti
                                WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.sub_bagian = \'' . $bagian . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                                ');
      $query_cuti_besar = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_cuti_besar drac
                                JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                                JOIN detail_master_data_group_man_power_indirect dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                                JOIN detail_record_all_cuti_besar drc ON drc.id_cuti = drac.id_cuti
                                WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.sub_bagian = \'' . $bagian . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                                ');
      $query_dispensasi = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_dispensasi drac
                                JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                                JOIN detail_master_data_group_man_power_indirect dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                                JOIN detail_record_all_dispensasi drc ON drc.id_cuti = drac.id_cuti
                                WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.sub_bagian = \'' . $bagian . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                                ');
      $query_skd = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_skd drac
                                JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                                JOIN detail_master_data_group_man_power_indirect dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                                JOIN detail_record_all_skd drc ON drc.id_cuti = drac.id_cuti
                                WHERE drc.tanggal_cuti = \'' . $date . '\' AND dmdgmp.sub_bagian = \'' . $bagian . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                                ');

      $data = array_merge($query_cuti->getResultArray(), $query_izin->getResultArray(), $query_cuti_besar->getResultArray(), $query_dispensasi->getResultArray(), $query_skd->getResultArray());
      // $tanggal = array_column($data, 'tanggal');
      // $created_at = array_column($data, 'created_at');
      // array_multisort($tanggal, SORT_DESC, $created_at, SORT_ASC, $data);
      return $data;
    }
  }

  // public function get_data_mp_cuti()
  // {
  //   $query = $this->db->query('SELECT drc.*, mdmp.nama AS nama_mp FROM detail_record_cuti drc
  //                           JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
  //                           ');

  //   return $query->getResultArray();
  // }

  // public function save_resume_cuti($data)
  // {
  //   $builder = $this->db->table('detail_record_cuti');
  //   $builder->insert($data);

  //   return $this->db->insertID();
  // }

  public function save_form_cuti($data)
  {
    $builder = $this->db->table('data_record_all_cuti');
    $builder->insert($data);

    return $this->db->insertID();
  }

  public function save_detail_form_cuti($data)
  {
    $builder = $this->db->table('detail_record_all_cuti');
    $builder->insert($data);

    return $this->db->insertID();
  }

  public function save_lampiran($data)
  {
    $builder = $this->db->table('data_all_lampiran_absen');
    $builder->insert($data);

    return $this->db->insertID();
  }
}
