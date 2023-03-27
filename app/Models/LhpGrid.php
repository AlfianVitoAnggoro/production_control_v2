<?php

namespace App\Models;

use CodeIgniter\Model;

class LhpGrid extends Model
{
    protected $table            = 'lhp_grid';
    protected $allowedFields    = ['date_production', 'line', 'shift', 'grup', 'mp', 'absen', 'cuti'];
}
