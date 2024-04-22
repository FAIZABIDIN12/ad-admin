<?php

namespace App\Models;

use CodeIgniter\Model;

class KomplainModel extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'komplain'];
}
