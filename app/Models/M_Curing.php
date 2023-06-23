<?php namespace App\Models;
use CodeIgniter\Model;



class M_Curing extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_all_curing($gedung)
    {
        $query = $this->db->query('SELECT * FROM monitoring_curing WHERE gedung = \'' . $gedung . '\' AND qc is NULL ORDER BY mesin ASC');

        return $query->getResultArray();
    }

    public function update_curing($id, $data) {
        $builder = $this->db->table('monitoring_curing');

        if ($id != '') {
            $builder->where('id_curing', $id);
            $builder->update($data);
            return $this->db->affectedRows();
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }
}
