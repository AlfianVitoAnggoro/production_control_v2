<?php

namespace App\Models;

use CodeIgniter\Model;

class M_GridRework extends Model
{
    protected $table = 'rework_grid';
    protected $allowedFields = ['id', 'id_machine', 'jumlah'];
}