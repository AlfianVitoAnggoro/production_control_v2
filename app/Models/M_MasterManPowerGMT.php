<?php

namespace App\Models;

use CodeIgniter\Model;



class M_MasterManPowerGMT extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_man_power_gmt()
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power_gmt');

    return $query->getResultArray();
  }

  public function get_data_man_power_gmt()
  {
    $query = $this->db->query('SELECT id_man_power FROM master_data_man_power_gmt');

    return $query->getResultArray();
  }

  public function get_data_master_man_power_gmt_by_id($id_man_power)
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power_gmt WHERE id_man_power = \'' . $id_man_power . '\'');

    return $query->getResultArray();
  }

  public function get_detail_data_master_man_power_gmt_by_id_and_line($id_man_power, $line)
  {
    if ($line !== '') {
      $query = $this->db->query('SELECT * FROM detail_master_data_man_power WHERE id_man_power = \'' . $id_man_power . '\' AND line = \'' . $line . '\'');
    } else {
      $query = $this->db->query('SELECT * FROM detail_master_data_man_power WHERE id_man_power = \'' . $id_man_power . '\'');
    }

    return $query->getResultArray();
  }

  public function save_data_man_power($data)
  {
    $query = $this->db->table('master_data_man_power_gmt')->insert($data);

    return $this->db->insertID();
  }

  public function update_data_man_power($id_man_power, $data)
  {
    $query = $this->db->table('master_data_man_power_gmt');
    $query->where('id_man_power', $id_man_power);
    $query->update($data);

    return $id_man_power;
  }

  public function update_detail_data_man_power($id_detail_man_power, $data)
  {
    $query = $this->db->table('detail_master_data_man_power');
    if ($id_detail_man_power != '') {
      $query->where('id_detail_man_power', $id_detail_man_power);
      $query->update($data);
      return $id_detail_man_power;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function delete_data_master_man_power_gmt($id_man_power)
  {
    $query = $this->db->query('DELETE FROM master_data_man_power_gmt WHERE id_man_power =\'' . $id_man_power . '\'');
  }
}
