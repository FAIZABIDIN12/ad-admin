<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tgl',
        'nama',
        'no_hp',
        'tgl_checkin',
        'tgl_checkout',
        'jml_orang',
        'jml_kamar',
        'rate',
        'bayar',
        'kurang_bayar',
        'metode_bayar',
        'keterangan',
        'status_bayar',
        'status_order',
        'front_office'
    ];
}
