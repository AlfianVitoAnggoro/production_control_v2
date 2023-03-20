<?php

namespace App\Models;

use CodeIgniter\Model;

class DataGrup extends Model
{
    protected $table            = 'data_grup';
    protected $allowedFields    = ['nama_grup', 'anggota'];
}
