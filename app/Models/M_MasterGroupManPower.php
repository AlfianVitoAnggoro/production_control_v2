<?php

namespace App\Models;

use CodeIgniter\Model;



class M_MasterGroupManPower extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');
    // $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_group_man_power()
  {
    $query = $this->db->query('SELECT * FROM master_data_group_man_power');

    return $query->getResultArray();
  }

  public function get_data_group_man_power($sub_bagian)
  {
    $query = $this->db->query('SELECT id_group FROM master_data_group_man_power WHERE sub_bagian = \'' . $sub_bagian . '\'');

    return $query->getResultArray();
  }

  public function get_data_master_man_power()
  {
    $query = $this->db->query('SELECT nama, id_man_power FROM master_data_man_power ORDER BY nama ASC');
    // $query = $this->db->query('SELECT * FROM master_data_man_power JOIN detail_master_data_man_power on detail_master_data_man_power.id_man_power = master_data_man_power.id_man_power WHERE detail_master_data_man_power.line = \'' . $line . '\' AND detail_master_data_man_power.mesin = \'' . $mesin . '\'');

    return $query->getResultArray();
  }

  // public function get_data_master_man_power_non_line($mesin)
  // {
  //   $query = $this->db->query('SELECT * FROM master_data_man_power JOIN detail_master_data_man_power on detail_master_data_man_power.id_man_power = master_data_man_power.id_man_power WHERE detail_master_data_man_power.line = 11 AND detail_master_data_man_power.mesin = \'' . $mesin . '\'');

  //   return $query->getResultArray();
  // }

  // public function get_data_master_man_power_kasubsie()
  // {
  //   $query = $this->db->query('SELECT * FROM master_data_man_power_kasubsie');

  //   return $query->getResultArray();
  // }

  public function get_data_master_man_power_kasubsie()
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power WHERE status= \'kasubsie\'');

    return $query->getResultArray();
  }

  public function get_data_master_group_man_power_by_id($id_group)
  {
    $query = $this->db->query('SELECT * FROM master_data_group_man_power WHERE id_group = \'' . $id_group . '\'');

    return $query->getResultArray();
  }

  public function get_detail_data_master_group_man_power_by_id($id_group)
  {
    $query = $this->db->query('SELECT * FROM detail_master_data_group_man_power WHERE id_group = \'' . $id_group . '\'');

    return $query->getResultArray();
  }

  public function get_detail_data_master_group_man_power_indirect_by_id($sub_bagian)
  {
    $query = $this->db->query('SELECT * FROM detail_master_data_group_man_power_indirect WHERE sub_bagian = \'' . $sub_bagian . '\'');

    return $query->getResultArray();
  }

  public function save_data_group_man_power($data)
  {
    $query = $this->db->table('master_data_group_man_power')->insert($data);

    return $this->db->insertID();
  }

  public function update_data_group_man_power($id_group, $data)
  {
    $query = $this->db->table('master_data_group_man_power');
    $query->where('id_group', $id_group);
    $query->update($data);

    return $id_group;
  }

  public function update_detail_data_group_man_power($id_detail_group, $data)
  {
    $query = $this->db->table('detail_master_data_group_man_power');
    if ($id_detail_group !== '') {
      $query->where('id_detail_group', $id_detail_group);
      $query->update($data);
      return $id_detail_group;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function update_detail_data_group_man_power_indirect($id_detail_group, $data)
  {
    $query = $this->db->table('detail_master_data_group_man_power_indirect');
    if ($id_detail_group !== '') {
      $query->where('id_detail_group', $id_detail_group);
      $query->update($data);
      return $id_detail_group;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function delete_data_master_group_man_power($id_group)
  {
    $query = $this->db->query('DELETE FROM master_data_group_man_power WHERE id_group =\'' . $id_group . '\'');
    $query = $this->db->query('DELETE FROM detail_master_data_group_man_power WHERE id_group =\'' . $id_group . '\'');
  }

  public function get_data_master_mesin($line)
  {
    if ($line <= 7)
      $query = $this->db->query('SELECT mesin, requirement FROM data_master_mesin WHERE line_' . $line . ' > 0 ORDER BY line_' . $line . ' ASC');
    else if ($line === 8)
      $query = $this->db->query('SELECT mesin, requirement FROM data_master_mesin WHERE wet_a > 0 ORDER BY wet_a ASC');
    else if ($line === 9)
      $query = $this->db->query('SELECT mesin, requirement FROM data_master_mesin WHERE wet_f > 0 ORDER BY wet_f ASC');
    else if ($line === 10)
      $query = $this->db->query('SELECT mesin, requirement FROM data_master_mesin WHERE mcb > 0 ORDER BY mcb ASC');
    return $query->getResultArray();
  }

  public function get_data_master_mesin_indirect_sub_bagian($sub_bagian)
  {
    if (strpos($sub_bagian, 'wet') === 0)
      $query = $this->db->query('SELECT mesin, requirement FROM data_master_mesin WHERE bag_wet > 0 ORDER BY bag_wet ASC');
    else
      $query = $this->db->query('SELECT mesin, requirement FROM data_master_mesin WHERE bag_' . $sub_bagian . ' > 0 ORDER BY bag_' . $sub_bagian . ' ASC');

    return $query->getResultArray();
  }
}
