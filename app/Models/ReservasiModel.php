<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasiModel extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    protected $allowedFields = ['nama', 'checkin', 'checkout', 'jumlah_orang', 'jumlah_kamar', 'harga', 'id_kamar', 'status_order'];

    public function tambahReservasi($data)
    {
        // Menyertakan ID kamar dalam data yang akan disimpan
        return $this->insert($data);
    }

    public function getKamarById($idKamar)
    {
        // Ambil data kamar berdasarkan id_kamar dari tabel reservasi
        return $this->db->table('reservasi')->where('id_kamar', $idKamar)->where('status_order', 'checkin')->get()->getRowArray();
    }

    public function getAllCheckinReservasi()
    {
        return $this->where('status_order', 'checkin')->findAll();
    }
    public function getCheckedOutReservations()
    {
        // Query untuk mengambil data reservasi yang statusnya sudah checkout
        return $this->where('status_order', 'done')->findAll();
    }
    public function getRataHargaPerTanggal()
    {
        // Ambil rata-rata harga per tanggal checkout
        $this->select('checkout, AVG(harga) as rata_harga');
        $this->where('status_order', 'done');
        $this->groupBy('checkout');
        return $this->findAll();
    }
    public function getJumlahKamarTerpakaiPerTanggal()
    {
        // Ambil data reservasi yang sudah di-checkout dan kelompokkan berdasarkan tanggal checkout
        $this->select('checkout, SUM(jumlah_kamar) as jumlah_kamar');
        $this->where('status_order', 'done');
        $this->groupBy('checkout');
        return $this->findAll();
    }

    public function history()
    {
        // Query untuk mengambil semua data riwayat reservasi
        return $this->findAll();
    }
}
