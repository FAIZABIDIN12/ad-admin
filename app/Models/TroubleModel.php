<?php

namespace App\Models;

use CodeIgniter\Model;

class TroubleModel extends Model
{
    protected $table            = 'troubles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tanggal',
        'no_kamar',
        'trouble',
        'progress',
        'is_done'
    ];
}
