<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SawRepairPotonginput extends Model
{
  protected $table = 'saw_repair_potong_input';
  protected $allowedFields = ['id', 'id_saw_repair', 'operator_potong', 'type_battery_potong', 'qty_element_potong', 'type_plate_reject_potong', 'qty_plate_reject_potong_kg', 'qty_plate_reject_potong_panel', 'keterangan'];
}
