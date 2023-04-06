<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SawRepair extends Model
{
  protected $table = 'saw_repair';
  protected $allowedFields = ['id', 'date', 'shift'];
}
