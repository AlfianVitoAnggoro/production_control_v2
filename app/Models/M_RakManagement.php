<?php

namespace App\Models;

use CodeIgniter\Model;

class M_RakManagement extends Model
{
    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        // $this->db3 = \Config\Database::connect('baan');
        // $this->db4 = \Config\Database::connect('prod_control');
        $this->db5 = \Config\Database::connect('manajemen_rak');
    }

    public function get_data_rak_management()
    {
        $query = $this->db5->query('SELECT * FROM data_master_rak ORDER BY pn_qr ASC');

        return $query->getResultArray();
    }

    public function get_data_record_rak()
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak ORDER BY id_log ASC');

        return $query->getResultArray();
    }

    public function get_data_rak_management_status($status)
    {
        $query = $this->db5->query('SELECT * FROM data_master_rak WHERE status = \'' . $status . '\' ORDER BY pn_qr ASC ');

        return $query->getResultArray();
    }

    public function get_data_rak_management_gedung($gedung)
    {
        $query = $this->db5->query('SELECT * FROM data_master_rak WHERE gedung = \'' . $gedung . '\' ORDER BY pn_qr ASC ');

        return $query->getResultArray();
    }
}
