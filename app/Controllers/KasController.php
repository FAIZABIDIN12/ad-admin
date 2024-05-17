<?php

namespace App\Controllers;

use App\Models\CheckinModel;
use App\Models\ReservationModel;
use App\Models\KasModel;

class KasController extends BaseController
{
    public function index()
    {
        // Mengambil data kas masuk
        $kasModel = new KasModel();
        $kas_masuk = $kasModel->findAll();

        // Mengambil data dari model Checkin dan Reservation
        $checkinModel = new CheckinModel();
        $reservationModel = new ReservationModel();

        // Mendapatkan data checkin dan reservasi
        $checkinData = $checkinModel->findAll();
        $reservationData = $reservationModel->findAll();

        // Memproses data pendapatan berdasarkan checkin
        $pendapatan = [];
        foreach ($checkinData as $checkin) {
            // Ini akan membuat pendapatan dari setiap data checkin
            $total_hari = (new \DateTime($checkin['checkout_plan']))->diff(new \DateTime($checkin['checkin']))->days;
            $rate_per_hari = $checkin['rate'] / $total_hari; // Asumsi bahwa rate adalah total biaya menginap
            $bayar = $checkin['bayar'];
            $remaining_bayar = $bayar;

            while ($remaining_bayar > 0 && $total_hari > 0) {
                if ($remaining_bayar >= $rate_per_hari) {
                    $pendapatan[] = [
                        'tgl_transaksi' => $checkin['checkin'],
                        'uraian' => 'Check-in ' . $checkin['nama'], // Ubah dari 'Reservasi' menjadi 'Check-in'
                        'lunas' => $rate_per_hari
                    ];
                    $remaining_bayar -= $rate_per_hari;
                } else {
                    $pendapatan[] = [
                        'tgl_transaksi' => $checkin['checkin'],
                        'uraian' => 'Check-in ' . $checkin['nama'], // Ubah dari 'Reservasi' menjadi 'Check-in'
                        'lunas' => $remaining_bayar
                    ];
                    $remaining_bayar = 0;
                }
                $total_hari--;
            }
        }

        // Memproses data pendapatan berdasarkan reservasi
        foreach ($reservationData as $reservation) {
            // Saya asumsikan ini seharusnya berdasarkan data reservasi
            $total_hari = (new \DateTime($reservation['tgl_checkout']))->diff(new \DateTime($reservation['tgl_checkin']))->days;
            $rate_per_hari = $reservation['rate'] / $total_hari;
            $bayar = $reservation['bayar'];
            $remaining_bayar = $bayar;

            while ($remaining_bayar > 0 && $total_hari > 0) {
                if ($remaining_bayar >= $rate_per_hari) {
                    $pendapatan[] = [
                        'tgl_transaksi' => $reservation['tgl'],
                        'uraian' => 'Reservasi ' . $reservation['nama'],
                        'lunas' => $rate_per_hari
                    ];
                    $remaining_bayar -= $rate_per_hari;
                } else {
                    $pendapatan[] = [
                        'tgl_transaksi' => $reservation['tgl'],
                        'uraian' => 'Reservasi ' . $reservation['nama'],
                        'lunas' => $remaining_bayar
                    ];
                    $remaining_bayar = 0;
                }
                $total_hari--;
            }
        }

        // Menampilkan view dengan data kas masuk dan pendapatan
        return view('admin/kas_masuk/index', [
            'kas_masuk' => $kas_masuk,
            'pendapatan' => $pendapatan
        ]);
    }
}
