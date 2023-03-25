<?php

namespace App\Models;

use CodeIgniter\Model;

class M_EnvelopeInput extends Model
{
    protected $table = 'envelopeinput';
    protected $allowedFields = ['id', 'id_envelope', 'plate', 'hasil_produksi', 'separator', 'melintir_bending', 'terpotong', 'rontok', 'tersangkut', 'persentase_reject_akumulatif'];
}
