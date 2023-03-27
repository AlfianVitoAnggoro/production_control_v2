<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailLhpGrid extends Model
{
    protected $table            = 'detail_lhp_grid';
    protected $allowedFields    = ['id_lhp_grid', 'no_machine', 'operator_name', 'type_grid', 'type_mesin', 'jks', 'plan_wo', 'actual', 'section', 'kode_rack'];
}
