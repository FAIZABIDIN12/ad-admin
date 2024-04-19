<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Models\KamarModel;
use CodeIgniter\Controller;

class KamarController extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        $kamarModel = new \App\Models\KamarModel();
        $reservasiModel = new \App\Models\ReservasiModel();

        $data['kamars'] = $kamarModel->semuaKamar();
        $data['pemesanan'] =$reservasiModel->findAll();

        return view('index', $data);
    }

    public function tambahKamar()
    {
        return view('tambah_kamar');
    }

    public function simpanKamar()
    {
        // Mengambil data dari form
        $noKamar = $this->request->getPost('no_kamar');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        // Menyiapkan data untuk disimpan
        $data = [
            'no_kamar' => $noKamar,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        // Memanggil model untuk menyimpan data kamar
        $kamarModel = new KamarModel();
        $kamarModel->tambahKamar($data);

        // Set pesan sukses
        session()->setFlashdata('success', 'Data kamar berhasil ditambahkan.');

        // Redirect ke halaman utama atau halaman lain jika diperlukan
        return redirect()->to('/');
    }

    public function editKamar($id_kamar)
    {
        // Membuat instance dari model KamarModel
        $kamarModel = new KamarModel();

        // Mendapatkan data kamar berdasarkan ID
        $data['kamar'] = $kamarModel->find($id_kamar);

        // Memeriksa apakah data kamar ditemukan
        if ($data['kamar']) {
            // Jika ditemukan, tampilkan view edit_kamar dengan data kamar
            return view('edit_kamar', $data);
        } else {
            // Jika tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->to('/error')->with('error', 'Data kamar tidak ditemukan');
        }
    }

    public function updateKamar()
    {
        // Mengambil data dari form
        $idKamar = $this->request->getPost('id_kamar');
        $noKamar = $this->request->getPost('no_kamar');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        // Menyiapkan data untuk disimpan
        $data = [
            'no_kamar' => $noKamar,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        // Memanggil model untuk update data kamar
        $kamarModel = new KamarModel();
        $affectedRows = $kamarModel->where('id_kamar', $idKamar)->set($data)->update();

        if ($affectedRows > 0) {
            // Set pesan sukses jika ada baris yang terpengaruh
            session()->setFlashdata('success', 'Data kamar berhasil diperbarui.');
        } else {
            // Set pesan error jika tidak ada baris yang terpengaruh
            session()->setFlashdata('error', 'Gagal memperbarui data kamar.');
        }

        // Redirect kembali ke halaman utama
        return redirect()->to(base_url());
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
        return redirect()->to(base_url());
    }
    public function edit($id_reservasi)
    {
        $reservasiModel = new \App\Models\ReservasiModel();
        $data['reservasi'] = $reservasiModel->find($id_reservasi);

        return view('edit', $data);
    }

    public function tambahData()
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
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');

        // Redirect ke halaman utama
        return redirect()->to('../');
    }
}
