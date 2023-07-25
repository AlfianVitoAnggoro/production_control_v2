<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Imp extends Model
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

  // public function get_data_mp_imp()
  // {
  //   $query = $this->db->query('SELECT drc.*, mdmp.nama AS nama_mp FROM detail_record_all_imp drc
  //                           JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
  //                           ');

  //   return $query->getResultArray();
  // }

  public function get_detail_mp_imp($id_imp)
  {
    $query = $this->db->query('SELECT * FROM data_record_all_imp drc
                            JOIN detail_record_all_imp drac ON drac.id_cuti = drc.id_cuti
                            JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
                            WHERE drc.id_cuti = \'' . $id_imp . '\'
                            ');

    return $query->getResultArray();
  }

  public function save_form_imp($id_imp, $data)
  {
    $builder = $this->db->table('data_record_all_imp');
    if ($id_imp !== null) {
      $builder->where('id_cuti', $id_imp);
      $builder->update($data);
      return '';
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }

  public function save_detail_form_cuti($id_imp, $data)
  {
    $builder = $this->db->table('detail_record_all_imp');
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
