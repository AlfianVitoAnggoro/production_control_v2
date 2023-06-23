<?php namespace App\Models;
use CodeIgniter\Model;



class M_MonitoringCuringQC extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_all_monitoring_curing_qc()
    {
        $query = $this->db->query('SELECT * FROM monitoring_curing ORDER BY id_curing DESC');

        return $query->getResultArray();
    }

    public function update_curing($id, $data) {
        $builder = $this->db->table('monitoring_curing');
        $builder->where('id_curing', $id);
        $builder->update($data);
        return $this->db->affectedRows();
    }
}
