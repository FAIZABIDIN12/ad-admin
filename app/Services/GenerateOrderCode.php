<?php

namespace App\Services;

use App\Models\ReservationModel;
use App\Models\CheckinModel;

class GenerateOrderCode
{
    public static function generateOrderId()
    {
        // Ambil tanggal dan waktu saat ini
        $timestamp = date('YmdHis'); // Format: YmdHis (tahun, bulan, hari, jam, menit, detik)
    
        // Format timestamp menjadi bagian angka dengan panjang tertentu
        $uniqueNumber = substr($timestamp, -5); // Misalnya, ambil 5 digit terakhir
    
        // Gabungkan dengan awalan unik
        $idReservasi = 'AG-' . $uniqueNumber;
        
        // Cek apakah kode tersebut sudah ada di database atau belum
        if (self::isDuplicateId($idReservasi)) {
            // Jika kode sudah ada, tambahkan angka unik tambahan
            $idReservasi = self::generateUniqueCode();
        }
    
        // Lanjutkan dengan proses penyimpanan data atau tindakan lainnya
        return $idReservasi;
    }
    
    protected static function isDuplicateId($idReservasi)
    {
        $reservasiModel = new ReservationModel();
        $reservasi= $reservasiModel->where('kode_order', $idReservasi)->first();

        $checkinModel = new CheckinModel();
        $checkin= $checkinModel->where('kode_order', $idReservasi)->first();
    
        if($reservasi || $checkin) {
            return true;
        } else {
            return false;
        }
    }
    
    protected static function generateUniqueCode()
    {
        // Logika untuk menghasilkan kode unik tambahan jika diperlukan
        // Misalnya, tambahkan angka acak ke belakang kode order yang sudah ada
        // Contoh sederhana:
        $randomNumber = mt_rand(1, 999); // Angka acak antara 1 dan 999
        return $idReservasi . '-' . $randomNumber;
    }
}
