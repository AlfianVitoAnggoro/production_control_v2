<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Izin extends Model
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

  public function save_resume_cuti($data)
  {
    $builder = $this->db->table('detail_record_cuti');
    $builder->insert($data);

    return $this->db->insertID();
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
}
