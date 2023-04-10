<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SawRepairSawInput extends Model
{
  protected $table = 'saw_repair_saw_input';
  protected $allowedFields = ['id', 'id_saw_repair', 'operator_saw', 'type_battery_saw', 'qty_repair_saw'];
}
