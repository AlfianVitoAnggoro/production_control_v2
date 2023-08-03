<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SawRepair extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->db3 = \Config\Database::connect('baan');
    $this->db4 = \Config\Database::connect('prod_control');
    $this->db5 = \Config\Database::connect('manajemen_rak');
    $this->db6 = \Config\Database::connect('timah');
  }

  public function getAll()
  {
    $query = $this->db->table('lhp_saw_repair')->get();
    return $query->getResultArray();
  }

  public function save_data($data)
  {
    $this->db->table('lhp_saw_repair')->insert($data);
    return $this->db->insertID();
  }

  public function get_data_by_id($id)
  {
    $query = $this->db->query('SELECT * FROM lhp_saw_repair WHERE id_lhp_saw_repair = ' . $id);
    return $query->getResultArray();
  }

  public function get_data_detail_by_id($id)
  {
    $query = $this->db->query('SELECT * FROM detail_lhp_saw_repair WHERE id_lhp_saw_repair = ' . $id);
    return $query->getResultArray();
  }

  public function get_data_type_battery()
  {
    $query = $this->db->query('SELECT * FROM data_type_battery_saw_repair');
    return $query->getResultArray();
  }

  public function update_data($id, $data)
  {
    $this->db->table('lhp_saw_repair')->where('id_lhp_saw_repair', $id)->update($data);
  }

  public function update_data_detail($id, $data)
  {
    if (!empty($id)) {
      $this->db->table('detail_lhp_saw_repair')->where('id_detail_lhp_saw_repair', $id)->update($data);
    } else {
      $this->db->table('detail_lhp_saw_repair')->insert($data);
    }
  }
}
