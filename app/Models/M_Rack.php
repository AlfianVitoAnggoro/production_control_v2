<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Rack extends Model
{
    protected $table = 'TRack';
    protected $allowedFields = ['id', 'pn_qr', 'item', 'qty', 'barcode', 'entry_date'];
    protected $useTimestamps = true;

    public function getData($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getDataByBarcode($barcode)
    {
        return $this->where('barcode', $barcode)->first();
    }

    public function getAllIds()
    {
        $results = $this->findAll();
        $ids = array_map(function ($row) {
            return $row['id'];
        }, $results);

        return $ids;
    }
}
