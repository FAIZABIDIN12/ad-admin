<?php

namespace App\Controllers;

use App\Models\ReservasiModel;

class ReservasiController extends BaseController
{
    public function detailReservasi($id) {
        $reservasiModel = new ReservasiModel;
        $detailReservasi = $reservasiModel->getKamarById($id);

        if ($detailReservasi) {
            // Jika data ditemukan, kirim respons JSON
            return $this->response->setJSON($detailReservasi);
        } else {
            // Jika data tidak ditemukan, kirim respons JSON dengan pesan error
            return $this->response->setJSON(['error' => 'Data not found'])->setStatusCode(404);
        }
    }
}