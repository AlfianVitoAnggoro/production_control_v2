<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Rack extends Model
{
    protected $table = 'TRack';
    protected $allowedFields = ['id', 'pn_qr', 'item', 'qty', 'entry_date'];
    protected $useTimestamps = true;

    public function getData($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}


