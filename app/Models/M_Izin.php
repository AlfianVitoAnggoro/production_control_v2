<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Izin extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_man_power()
  {
    $query = $this->db->query('SELECT id_man_power, nama FROM master_data_man_power ORDER BY nama ASC');

    return $query->getResultArray();
  }

  public function get_data_mp_absen_by_daily($date, $line, $group_mp, $bagian)
  {
    $query_cuti = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_cuti drac
                              JOIN detail_record_all_cuti drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND drac.line = \'' . $line . '\' AND drac.group_mp = \'' . $group_mp . '\' AND drac.sub_bagian = \'' . $bagian . '\' AND drac.status !=\'rejected\'
                              ');
    $query_izin = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_izin drac
                              JOIN detail_record_all_izin drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND drac.line = \'' . $line . '\' AND drac.group_mp = \'' . $group_mp . '\' AND drac.sub_bagian = \'' . $bagian . '\' AND drac.status !=\'rejected\'
                              ');
    $query_cuti_besar = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_cuti_besar drac
                              JOIN detail_record_all_cuti_besar drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND drac.line = \'' . $line . '\' AND drac.group_mp = \'' . $group_mp . '\' AND drac.sub_bagian = \'' . $bagian . '\' AND drac.status !=\'rejected\'
                              ');
    $query_sakit = $this->db->query('SELECT drc.tanggal_cuti FROM data_record_all_sakit drac
                              JOIN detail_record_all_sakit drc ON drc.id_cuti = drac.id_cuti
                              WHERE drc.tanggal_cuti = \'' . $date . '\' AND drac.line = \'' . $line . '\' AND drac.group_mp = \'' . $group_mp . '\' AND drac.sub_bagian = \'' . $bagian . '\' AND drac.status !=\'rejected\'
                              ');

    $data = array_merge($query_cuti->getResultArray(), $query_izin->getResultArray(), $query_cuti_besar->getResultArray(), $query_sakit->getResultArray());
    return $data;
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
      if (count($results) == 0) {
        $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                            WHERE id_man_power =\'' . $id_man_power . '\'
                          ');
        $results = $query->getResultArray();
      }
    }

    return $results;
  }

  public function save_form_izin($data)
  {
    $builder = $this->db->table('data_record_all_izin');
    $builder->insert($data);

    return $this->db->insertID();
  }

  public function save_detail_form_izin($data)
  {
    $builder = $this->db->table('detail_record_all_izin');
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
