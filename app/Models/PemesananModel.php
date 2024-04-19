<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $allowedFields = ['tanggal_checkin', 'tanggal_checkout', 'jumlah_kamar', 'jumlah_orang', 'nama_pemesan', 'no_hp', 'status_pembayaran', 'status_pemesanan'];
}
