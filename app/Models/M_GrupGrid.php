<?php

namespace App\Models;

use CodeIgniter\Model;



class M_GrupGrid extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();

    $this->session = \Config\Services::session();
  }

  public function get_data_grup_grid()
  {
    $query = $this->db->query('SELECT * FROM data_grup_grid');

    return $query->getResultArray();
  }

  public function get_detail_data_grup_grid_by_id($id)
  {
    $query = $this->db->query('SELECT * FROM data_grup_grid WHERE id = ' . $id);

    return $query->getResultArray();
  }

  public function get_data_nama_grup()
  {
    $query = $this->db->query('SELECT DISTINCT nama_grup FROM data_grup_grid');

    return $query->getResultArray();
  }

  public function save_data_grup_grid($data)
  {
    $this->db->table('data_grup_grid')->insert($data);

    return $this->db->insertID();
  }

  public function update_data_grup_grid($id, $data)
  {
    $builder = $this->db->table('data_grup_grid');
    $builder->where('id', $id);
    $builder->update($data);

    return $this->db->affectedRows();
  }

  public function delete_data_grup_grid($id)
  {
    $this->db->query('DELETE FROM data_grup_grid WHERE id = ' . $id);
  }
}
