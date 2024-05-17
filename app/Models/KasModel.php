<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
    protected $table = 'kas_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tgl_transaksi', 'uraian', 'kas_masuk'];
    // Tambahkan properti lain sesuai kebutuhan
}
