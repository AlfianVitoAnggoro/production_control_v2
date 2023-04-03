<?php

namespace App\Models;

use CodeIgniter\Model;



class M_LineStop extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();

    $this->session = \Config\Services::session();
  }

  public function get_data_breakdown()
  {
    $query = $this->db->query('SELECT * FROM data_breakdown');

    return $query->getResultArray();
  }

  public function get_detail_data_breakdown_by_id($id_breakdown)
  {
    $query = $this->db->query('SELECT * FROM data_breakdown WHERE id_breakdown = ' . $id_breakdown);

    return $query->getResultArray();
  }

  public function save_data_breakdown($data)
  {
    $this->db->table('data_breakdown')->insert($data);

    return $this->db->insertID();
  }

  public function update_data_breakdown($id_breakdown, $data)
  {
    $builder = $this->db->table('data_breakdown');
    $builder->where('id_breakdown', $id_breakdown);
    $builder->update($data);

    return $this->db->affectedRows();
  }

  public function delete_data_breakdown($id_breakdown)
  {
    $this->db->query('DELETE FROM data_breakdown WHERE id_breakdown = ' . $id_breakdown);
  }
}
