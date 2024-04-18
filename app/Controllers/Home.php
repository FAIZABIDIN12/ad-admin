<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Models\KamarModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        $kamarModel = new \App\Models\KamarModel();
        $data['kamars'] = $kamarModel->semuaKamar();

        return view('index', $data);
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

        // Debug statement untuk memeriksa nilai id_kamar
        var_dump($idKamar);

        // Menyiapkan data untuk disimpan
        $data = [
            'nama' => $nama,
            'jumlah_orang' => $jumlahOrang,
            'jumlah_kamar' => $jumlahKamar,
            'harga' => $harga,
            'checkin' => $tglCheckin,
            'checkout' => $tglCheckout,
            'id_kamar' => $idKamar // Sertakan id_kamar ke dalam data
        ];

        // Memanggil model untuk menyimpan data reservasi
        $reservasiModel = new ReservasiModel();
        $reservasiModel->tambahReservasi($data);

        // Set pesan sukses
        session()->setFlashdata('success', 'Reservasi berhasil disimpan.');

        // Redirect ke halaman utama
        return redirect()->to('../');
    }
}
