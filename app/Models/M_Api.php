<?php namespace App\Models;
use CodeIgniter\Model;



class M_Api extends Model
{
    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        // $this->db2 = \Config\Database::connect('sqlsrv');
        // $this->db3 = \Config\Database::connect('baan');
        // $this->db4 = \Config\Database::connect('prod_control');
        $this->db5 = \Config\Database::connect('manajemen_rak');

        $this->session = \Config\Services::session();
    }

    public function get_detail_rak($pn_qr)
    {
        if ($pn_qr == NULL) {
            $query = $this->db5->query('SELECT data_master_rak.pn_qr, detail_record_rak.barcode, detail_barcode_rak.item, SUM(detail_record_rak.qty) AS qty, detail_barcode_rak.entry_date
                                        FROM data_master_rak
                                        JOIN detail_record_rak ON detail_record_rak.pn_qr = data_master_rak.pn_qr
                                        JOIN detail_barcode_rak ON detail_record_rak.barcode = detail_barcode_rak.barcode
                                        WHERE data_master_rak.status = 1 AND detail_record_rak.status = \'open\'
                                        GROUP BY data_master_rak.pn_qr, detail_record_rak.barcode, detail_barcode_rak.item, detail_barcode_rak.entry_date');
        } else {
            $query = $this->db5->query('SELECT data_master_rak.pn_qr, detail_record_rak.barcode, detail_barcode_rak.item, SUM(detail_record_rak.qty) AS qty, detail_barcode_rak.entry_date
                                        FROM data_master_rak
                                        JOIN detail_record_rak ON detail_record_rak.pn_qr = data_master_rak.pn_qr
                                        JOIN detail_barcode_rak ON detail_record_rak.barcode = detail_barcode_rak.barcode
                                        WHERE data_master_rak.status = 1 AND detail_record_rak.status = \'open\' AND data_master_rak.pn_qr = \'' . $pn_qr . '\'
                                        GROUP BY data_master_rak.pn_qr, detail_record_rak.barcode, detail_barcode_rak.item, detail_barcode_rak.entry_date');
        }

        return $query->getResultArray();
    }
}
