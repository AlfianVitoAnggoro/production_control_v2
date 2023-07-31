<?php

namespace App\Models;

use CodeIgniter\Model;



class M_MasterManPower extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->db2 = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_man_power()
  {
    $query = $this->db2->query('SELECT * FROM master_data_man_power WHERE status != \'gmt\'');

    return $query->getResultArray();
  }

  public function get_data_man_power($npk)
  {
    $query = $this->db2->query('SELECT id_man_power FROM master_data_man_power WHERE npk = \'' . $npk . '\' AND status != \'gmt\'');

    return $query->getResultArray();
  }

  public function get_data_skill_man_power($npk)
  {
    $query = $this->db2->query('SELECT id_man_power FROM detail_master_data_man_power WHERE npk = \'' . $npk . '\'');

    return $query->getResultArray();
  }

  // public function get_data_man_power()
  // {
  //   $query = $this->db2->query('SELECT id_man_power FROM master_data_man_power');

  //   return $query->getResultArray();
  // }

  public function get_data_master_man_power_by_id($id_man_power)
  {
    $query = $this->db2->query('SELECT * FROM master_data_man_power WHERE id_man_power = \'' . $id_man_power . '\' AND status != \'gmt\'');

    return $query->getResultArray();
  }

  public function get_data_skill_by_line($line)
  {
    $nama_line = ['line_1', 'line_2', 'line_3', 'line_4', 'line_5', 'line_6', 'line_7', 'wet_a', 'wet_f', 'mcb', 'non_line'];
    $data = [];
    // if ($line !== '') {
    $query = $this->db2->query('SELECT mesin FROM data_master_skill WHERE ' . $nama_line[$line - 1] . ' > 0 ORDER BY ' . $nama_line[$line - 1] . '');
    foreach ($query->getResultArray() as $q) {
      array_push($data, $q['mesin']);
    }
    // }
    // else {
    //   $index = 1;
    //   foreach ($nama_line as $nl) {
    //     $query = $this->db2->query('SELECT mesin FROM data_master_skill WHERE ' . $nl . ' > 0 ORDER BY ' . $nl . '');
    //     $data[$index] = $query->getResultArray();
    //     $index++;
    //   }
    // }
    return $data;
  }

  public function get_detail_data_master_man_power_by_id_and_line($id_man_power, $line)
  {
    if ($line !== '') {
      $query = $this->db2->query('SELECT * FROM detail_master_data_man_power WHERE id_man_power = \'' . $id_man_power . '\' AND line = \'' . $line . '\'');
    } else {
      $query = $this->db2->query('SELECT * FROM detail_master_data_man_power WHERE id_man_power = \'' . $id_man_power . '\'');
    }

    return $query->getResultArray();
  }

  public function save_data_man_power($data)
  {
    $query = $this->db2->table('master_data_man_power')->insert($data);

    return $this->db2->insertID();
  }

  public function update_data_man_power($id_man_power, $data)
  {
    $query = $this->db2->table('master_data_man_power');
    $query->where('id_man_power', $id_man_power);
    $query->update($data);

    return $id_man_power;
  }

  public function update_detail_data_man_power($id_detail_man_power, $data)
  {
    $query = $this->db2->table('detail_master_data_man_power');
    if ($id_detail_man_power != '') {
      $query->where('id_detail_man_power', $id_detail_man_power);
      $query->update($data);
      return $id_detail_man_power;
    } else {
      $query->insert($data);
      return $this->db2->insertID();
    }
  }

  public function delete_data_master_man_power($id_man_power)
  {
    $query = $this->db2->query('DELETE FROM master_data_man_power WHERE id_man_power =\'' . $id_man_power . '\' AND status != \'gmt\'');
    $query = $this->db2->query('DELETE FROM detail_master_data_man_power WHERE id_man_power =\'' . $id_man_power . '\' AND status != \'gmt\'');
  }
}
