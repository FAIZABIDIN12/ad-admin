<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CheckinModel;

class ReportController extends BaseController
{
    public function index()
    {
        $checkinModel = new CheckinModel();
        $allData = $checkinModel->findAll();

        $dataPerTanggal = [];

        // Iterasi melalui data yang diperoleh dari database
        foreach ($allData as $data) {
            // Ambil tanggal checkout dari setiap entri
            $tanggalCheckout = date("Y-m-d", strtotime($data['checkout']));

            // Jika tanggal tersebut belum ada dalam array $dataPerTanggal, inisialisasi array untuk tanggal tersebut
            if (!isset($dataPerTanggal[$tanggalCheckout])) {
                $dataPerTanggal[$tanggalCheckout] = [
                    'kamar_terpakai' => 0,
                    'harga' => 0,
                    'terbayar' => 0
                ];
            }

            // Increment jumlah kamar terpakai untuk tanggal tersebut
            $dataPerTanggal[$tanggalCheckout]['kamar_terpakai']++;

            // Tambahkan harga dan terbayar untuk tanggal tersebut
            $dataPerTanggal[$tanggalCheckout]['harga'] += $data['rate'];
            $dataPerTanggal[$tanggalCheckout]['terbayar'] += $data['bayar'];
        }

        $data['reports'] = $dataPerTanggal;

        return view('admin/report/index', $data);
    }
}
