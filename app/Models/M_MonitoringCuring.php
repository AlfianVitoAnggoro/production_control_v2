<?php namespace App\Models;
use CodeIgniter\Model;



class M_MonitoringCuring extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->session = \Config\Services::session();
    }

    public function get_all_monitoring_curing($gedung)
    {
        $query = $this->db->query('SELECT DISTINCT t1.mesin, t1.start, t1.plan_curing, t1.act
                                FROM monitoring_curing t1
                                JOIN (
                                    SELECT mesin, MAX(start) AS max_start
                                    FROM monitoring_curing
                                    where gedung = \'' . $gedung . '\'
                                    GROUP BY mesin
                                ) t2 ON t1.mesin = t2.mesin AND t1.start = t2.max_start
                                ORDER BY t1.mesin ASC
                                ');

        return $query->getResultArray();
    }
}
