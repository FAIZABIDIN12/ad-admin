<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckinModel extends Model
{
    protected $table            = 'checkin';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama',
        'kode_order',
        'no_hp',
        'checkin',
        'checkout',
        'checkout_plan',
        'jml_orang',
        'id_room',
        'rate',
        'bayar',
        'metode_bayar',
        'keterangan',
        'status_order',
        'front_office'
    ];

    protected $useTimestamps = false;

    public function addCheckinData($data)
    {
        return $this->insert($data);
    }
    public function getAllCheckin()
    {
        return $this->where('status_order', 'checkin')->findAll();
    }
    public function getKamarById($idKamar)
    {
        // Ambil data kamar berdasarkan id_kamar dari tabel reservasi
        return $this->db->table('checkin')->where('id_room', $idKamar)->where('status_order', 'checkin')->get()->getRowArray();
    }
    public function filterByMonthYear($bulan, $tahun)
    {
        return $this->where('MONTH(checkout)', $bulan)
            ->where('YEAR(checkout)', $tahun)
            ->where('status_order', 'checkin') // Filter status order jika diperlukan
            ->findAll();
    }
}
