<?php

namespace App\Models;

use CodeIgniter\Model;

class M_RakManagement extends Model
{
    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->db3 = \Config\Database::connect('baan');
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
        // $query = $this->db5->query('SELECT * FROM detail_record_rak ORDER BY id_log ASC');
        $query = $this->db5->query('
                                    SELECT pn_qr, barcode, qty, wh_from, wh_to, supply_time, close_time, status 
                                    FROM detail_record_rak
                                    GROUP BY barcode, pn_qr, qty, wh_from, wh_to, supply_time, close_time, status
                                ');

        return $query->getResultArray();
    }

    public function get_data_record_rak_by_id($qr_rak)
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE pn_qr = \'' . $qr_rak . '\' AND status = \'open\'');

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

    public function get_data_wta($barcode)
    {
        $query = $this->db3->query('SELECT (to_char(t$odat + (7/24), \'YYYY-MM-DD HH24:MI\')) as tanggal, t$note as barcode FROM baan.tcbinh008777 WHERE t$note = \'' . $barcode . '\' AND t$whto = \'K-PAS\'');

        return $query->getResultArray();
    }

    public function update_data_detail_rak($data, $barcode) {
        $query = $this->db5->table('detail_record_rak')->update($data, array('barcode' => $barcode));
        return $query;
    }

    public function update_data_rak($data, $qr_rak) {
        $query = $this->db5->table('data_master_rak')->update($data, array('pn_qr' => $qr_rak));
        return $query;
    }

    public function get_data_record_rak_open()
    {
        $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE status = \'open\' ORDER BY id_log ASC');

        return $query->getResultArray();
    }
}
