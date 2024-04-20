<?php

namespace App\Controllers;

use App\Models\ReservasiModel;

class ReservasiController extends BaseController
{
    public function detailReservasi($id) {
        $reservasiModel = new ReservasiModel();
        $detailReservasi = $reservasiModel->getKamarById($id);

        if ($detailReservasi) {
            // Jika data ditemukan, kirim respons JSON
            return $this->response->setJSON($detailReservasi);
        } else {
            // Jika data tidak ditemukan, kirim respons JSON dengan pesan error
            return $this->response->setJSON(['error' => 'Data not found'])->setStatusCode(404);
        }
    }

    public function simpanReservasi()
    {
        // Mengambil data dari form
        $nama = $this->request->getPost('nama');
        $tglCheckin = $this->request->getPost('tgl_checkin');
        $tglCheckout = $this->request->getPost('tgl_checkout');
        $jumlahOrang = $this->request->getPost('jumlah_orang');
        $jumlahKamar = $this->request->getPost('jumlah_kamar');
        $harga = $this->request->getPost('harga');
        $idKamar = $this->request->getPost('id_kamar'); // Ambil id_kamar dari form

        // Menyiapkan data untuk disimpan
        $data = [
            'nama' => $nama,
            'jumlah_orang' => $jumlahOrang,
            'jumlah_kamar' => $jumlahKamar,
            'harga' => $harga,
            'checkin' => date('Y-m-d'),
            'checkout' => $tglCheckout,
            'id_kamar' => $idKamar,
            'status_order' => 'checkin'
        ];

        // Memanggil model untuk menyimpan data reservasi
        $reservasiModel = new ReservasiModel();
        $reservasiModel->tambahReservasi($data);

        // Set pesan sukses
        session()->setFlashdata('success', 'Reservasi berhasil disimpan.');

        // Redirect ke halaman utama
        return redirect()->to(base_url('admin'));
    }

    public function checkout($id)
    {
        $reservasiModel = new ReservasiModel();
        $updated = $reservasiModel->update($id, ['status_order' => 'done', 'checkout' => date('Y-m-d')]);

        if ($updated) {
            return redirect()->to(base_url('admin'))->with('success', 'Berhasil Checkout');
        } else {
            return redirect()->to(base_url('admin'))->with('error', 'Gagal checkout');
        }
    }
}