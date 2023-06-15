<?php

namespace App\Models;

use CodeIgniter\Model;



class M_MasterGroupManPower extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->db2 = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_group_man_power()
  {
    $query = $this->db2->query('SELECT * FROM master_data_group_man_power');

    return $query->getResultArray();
  }

  public function get_data_master_man_power($line, $mesin)
  {
    $query = $this->db2->query('SELECT * FROM master_data_man_power JOIN detail_master_data_man_power on detail_master_data_man_power.id_man_power = master_data_man_power.id_man_power WHERE detail_master_data_man_power.line = \'' . $line . '\' AND detail_master_data_man_power.mesin = \'' . $mesin . '\'');

    return $query->getResultArray();
  }

  public function get_data_master_man_power_kasubsie()
  {
    $query = $this->db2->query('SELECT * FROM master_data_man_power_kasubsie');

    return $query->getResultArray();
  }

  public function get_data_master_group_man_power_by_id($id_group)
  {
    $query = $this->db2->query('SELECT * FROM master_data_group_man_power WHERE id_group = \'' . $id_group . '\'');

    return $query->getResultArray();
  }

  public function get_detail_data_master_group_man_power_by_id($id_group)
  {
    $query = $this->db2->query('SELECT * FROM detail_master_data_group_man_power WHERE id_group = \'' . $id_group . '\'');

    return $query->getResultArray();
  }

  public function save_data_group_man_power($data)
  {
    $query = $this->db2->table('master_data_group_man_power')->insert($data);

    return $this->db2->insertID();
  }

  public function update_data_group_man_power($id_group, $data)
  {
    $query = $this->db2->table('master_data_group_man_power');
    $query->where('id_group', $id_group);
    $query->update($data);

    return $id_group;
  }

  public function update_detail_data_group_man_power($id_detail_group, $data)
  {
    $query = $this->db2->table('detail_master_data_group_man_power');
    if($id_detail_group !== '') {
      $query->where('id_detail_group', $id_detail_group);
      $query->update($data);
      return $id_detail_group;
    } else {
      $query->insert($data);
      return $this->db2->insertID();
    }
  }

  public function delete_data_master_group_man_power($id_group)
  {
    $query = $this->db2->query('DELETE FROM master_data_group_man_power WHERE id_group =\'' . $id_group . '\'');
    $query = $this->db2->query('DELETE FROM detail_master_data_group_man_power WHERE id_group =\'' . $id_group . '\'');
  }

  public function get_data_master_mesin($line)
  {
    if($line <= 7)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE line_' . $line . ' > 0 ORDER BY line_' . $line . ' ASC');
    else if($line === 8)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE wet_a > 0 ORDER BY wet_a ASC');
    else if($line === 9)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE wet_f > 0 ORDER BY wet_f ASC');
    else if($line === 10)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE mcb > 0 ORDER BY mcb ASC');
    return $query->getResultArray();
  }

  public function get_data_master_mesin_indirect_line($line)
  {
    if($line <= 7)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE indirect_line_' . $line . ' > 0 ORDER BY indirect_line_' . $line . ' ASC');
    else if($line === 8)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE indirect_wet_a > 0 ORDER BY indirect_wet_a ASC');
    else if($line === 9)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE indirect_wet_f > 0 ORDER BY indirect_wet_f ASC');
    else if($line === 10)
      $query = $this->db2->query('SELECT mesin FROM data_master_mesin WHERE indirect_mcb > 0 ORDER BY indirect_mcb ASC');
    return $query->getResultArray();
  }
}
