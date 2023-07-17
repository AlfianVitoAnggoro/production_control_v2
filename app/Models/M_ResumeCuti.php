<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ResumeCuti extends Model
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

    return $query->getResultArray();
  }

  public function get_data_mp_cuti()
  {
    // $query = $this->db->query('SELECT drc.*, mdmp.nama AS nama_mp FROM detail_record_cuti drc
    //                         JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
    //                         ORDER BY tanggal DESC
    //                         ');
    $query_cuti = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp AS shift, mdmp.nama AS nama_mp, drc.keterangan FROM data_record_all_cuti drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            JOIN detail_record_cuti drc ON drc.id_data_cuti = drac.id_cuti
                            -- WHERE drc.keterangan = \'Cuti\'
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_izin = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp AS shift, mdmp.nama AS nama_mp, drc.keterangan FROM data_record_all_izin drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            JOIN detail_record_cuti drc ON drc.id_data_cuti = drac.id_cuti
                            -- WHERE drc.keterangan = \'Izin\'
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_cuti_besar = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp AS shift, mdmp.nama AS nama_mp, drc.keterangan FROM data_record_all_cuti_besar drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            JOIN detail_record_cuti drc ON drc.id_data_cuti = drac.id_cuti
                            -- WHERE drc.keterangan = \'Cuti Besar\'
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_dispensasi = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp AS shift, mdmp.nama AS nama_mp, drc.keterangan FROM data_record_all_dispensasi drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            JOIN detail_record_cuti drc ON drc.id_data_cuti = drac.id_cuti
                            -- WHERE drc.keterangan = \'Dispensasi\'
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_skd = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp AS shift, mdmp.nama AS nama_mp, drc.keterangan FROM data_record_all_skd drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            JOIN detail_record_cuti drc ON drc.id_data_cuti = drac.id_cuti
                            -- WHERE drc.keterangan = \'SKD\'
                            ORDER BY drac.tanggal_buat DESC
                            ');

    $data = array_merge($query_cuti->getResultArray(), $query_izin->getResultArray(), $query_cuti_besar->getResultArray(), $query_dispensasi->getResultArray(), $query_skd->getResultArray());
    $tanggal = array_column($data, 'tanggal');
    $created_at = array_column($data, 'created_at');
    array_multisort($tanggal, SORT_DESC, $created_at, SORT_ASC, $data);
    return $data;
  }

  // public function get_detail_mp_cuti($id_cuti, $keterangan)
  // {
  //   $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM detail_record_cuti drc
  //                           JOIN data_record_all_cuti dt_rac ON drc.id_data_cuti = dt_rac.id_cuti
  //                           JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE drc.id_cuti = \'' . $id_cuti . '\' AND drc.keterangan = \'' . $keterangan . '\'
  //                           ');
  //   return $query->getResultArray();
  // }
  public function get_detail_mp_cuti($id_cuti)
  {
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti dt_rac
                            JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
                            ');
    return $query->getResultArray();
  }
  // public function get_detail_mp_cuti($id_cuti, $keterangan)
  // {
  //   $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti dt_rac
  //                           JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
  // 						              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
  //                           WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
  //                           ');
  //   return $query->getResultArray();
  // }

  public function save_approval($data)
  {
    $builder = $this->db->table('data_approval_cuti');
    $builder->insert($data);

    return $this->db->insertID();
  }

  public function update_cuti($id, $data)
  {
    $builder = $this->db->table('data_record_all_cuti');
    $builder->where('id_cuti', $id);
    $builder->update($data);

    return $id;
  }

  // public function get_data_cuti_by_id($id)
  // {
  //   $builder = $this->db->query('SELECT id_data_cuti FROM detail_record_cuti WHERE id_cuti = \'' . $id . '\'');

  //   return $builder->getResultArray();
  // }

  // public function get_reject_note($id)
  // {
  //   $builder = $this->db->query('SELECT * FROM data_approval_cuti WHERE id_cuti = \'' . $id . '\'');

  //   return $builder->getResultArray();
  // }
}
