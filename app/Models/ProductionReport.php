<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionReport extends Model
{
    protected $table            = 'production_report';
    protected $allowedFields    = ['no_machine', 'operator_name', 'type_mesin', 'type_grid', 'jks', 'actual', 'kode_rak'];
}
