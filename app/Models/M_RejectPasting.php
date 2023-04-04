<?php

namespace App\Models;

use CodeIgniter\Model;



class M_RejectPasting extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();

    $this->session = \Config\Services::session();
  }

  public function get_data_reject_pasting()
  {
    $query = $this->db->query('SELECT * FROM data_reject_pasting');

    return $query->getResultArray();
  }

  public function get_detail_data_reject_pasting_by_id($id_reject_pasting)
  {
    $query = $this->db->query('SELECT * FROM data_reject_pasting WHERE id_reject_pasting = ' . $id_reject_pasting);

    return $query->getResultArray();
  }

  public function get_data_jenis_reject_pasting()
  {
    $query = $this->db->query('SELECT DISTINCT jenis_reject_pasting FROM data_reject_pasting');

    return $query->getResultArray();
  }

  public function save_data_reject_pasting($data)
  {
    $this->db->table('data_reject_pasting')->insert($data);

    return $this->db->insertID();
  }

  public function update_data_reject_pasting($id_reject_pasting, $data)
  {
    $builder = $this->db->table('data_reject_pasting');
    $builder->where('id_reject_pasting', $id_reject_pasting);
    $builder->update($data);

    return $this->db->affectedRows();
  }

  public function delete_data_reject_pasting($id_reject_pasting)
  {
    $this->db->query('DELETE FROM data_reject_pasting WHERE id_reject_pasting = ' . $id_reject_pasting);
  }
}
