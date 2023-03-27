<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Team extends Model
{
    protected $table = 'team';
    protected $allowedFields = ['id', 'team'];
}
