<?php

namespace App\Models;

use CodeIgniter\Model;

class M_CutiBesar extends Model
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
    $query = $this->db->query('SELECT npk FROM master_data_man_power WHERE id_man_power =\'' . $id_man_power . '\'');

    return $query->getResultArray();
  }

  public function get_data_mp_cuti_besar()
  {
    $query = $this->db->query('SELECT drc.*, mdmp.nama AS nama_mp FROM detail_record_cuti_besar drc
                            JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
                            ');

    return $query->getResultArray();
  }

  public function get_detail_mp_cuti_besar($id_cuti_besar)
  {
    $query = $this->db->query('SELECT * FROM detail_record_cuti_besar drc
                            JOIN master_data_man_power mdmp ON drc.nama = mdmp.id_man_power
                            WHERE drc.id_cuti_besar = \'' . $id_cuti_besar . '\'
                            ');

    return $query->getResultArray();
  }

  public function save_form_cuti_besar($data)
  {
    $builder = $this->db->table('detail_record_cuti_besar');
    $builder->insert($data);

    return $this->db->insertID();
  }
}
