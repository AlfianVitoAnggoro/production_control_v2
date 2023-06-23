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

    public function get_data_rak_to_aging()
    {
        $query = $this->db5->query('SELECT data_master_rak.pn_qr, detail_barcode_rak.item, SUM(detail_record_rak.qty) AS qty, detail_barcode_rak.entry_date
                                    FROM data_master_rak
                                    JOIN detail_record_rak ON detail_record_rak.pn_qr = data_master_rak.pn_qr
                                    JOIN detail_barcode_rak ON detail_record_rak.barcode = detail_barcode_rak.barcode
                                    WHERE data_master_rak.status = 1 AND detail_record_rak.status = \'open\' AND detail_record_rak.supply_time >= \'2023-06-16 00:00:00.000\'
                                    GROUP BY data_master_rak.pn_qr, detail_barcode_rak.item, detail_barcode_rak.entry_date');

        return $query->getResultArray();
    }

    public function get_data_rak_management_by_id($qr_rak)
    {
        $query = $this->db5->query('SELECT data_master_rak.pn_qr, detail_barcode_rak.item, SUM(detail_record_rak.qty) AS qty
                                    FROM data_master_rak
                                    JOIN detail_record_rak ON detail_record_rak.pn_qr = data_master_rak.pn_qr
                                    JOIN detail_barcode_rak ON detail_record_rak.barcode = detail_barcode_rak.barcode
                                    WHERE data_master_rak.status = 1 AND detail_record_rak.status = \'open\' AND data_master_rak.pn_qr = \'' . $qr_rak . '\'
                                    GROUP BY data_master_rak.pn_qr, detail_barcode_rak.item');

        return $query->getResultArray();
    }

    public function insert_data_rak_to_aging($id, $data)
    {
        if (empty($id)) {
            $query = $this->db5->table('data_rak_aging')->insert($data);
        }        
    }

    public function get_data_rak_at_aging($mesin)
    {
        $nama_mesin = "'"."%".$mesin."'";

        $query = $this->db5->query('SELECT * FROM data_rak_aging WHERE nama_mesin LIKE ' . $nama_mesin . ' AND stop_aging IS NULL');

        return $query->getResultArray();
    }

    public function delete_rak_aging($id)
    {
        $query = $this->db5->table('data_rak_aging')->delete(array('id' => $id));
    }

    public function update_rak_aging()
    {
        $date_now = date('Y-m-d H:i:s');
        $query = $this->db5->query('UPDATE data_rak_aging SET stop_aging = \'' . $date_now . '\' WHERE stop_aging IS NULL');
    }
}
