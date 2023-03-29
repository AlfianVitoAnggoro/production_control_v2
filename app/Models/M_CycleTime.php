<?php 
namespace App\Models;
use CodeIgniter\Model;



class M_CycleTime extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_data_cycle_time()
    {
        $query = $this->db->query('SELECT * FROM master_cycle_time');

        return $query->getResultArray();
    }
}