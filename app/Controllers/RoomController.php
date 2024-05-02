<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;
use App\Models\CheckinModel;

class RoomController extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        $roomModel = new RoomModel();
        $checkinModel = new CheckinModel();

        $data['title'] = 'Dashboard';
        $data['rooms'] = $roomModel->semuaKamar();
        $data['checkins'] =$checkinModel->getAllCheckin();

        return view('admin/index', $data);
    }

    public function tambahKamar()
    {
        return view('admin/tambah_kamar', ['title' => 'Tambah Kamar']);
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
        $kamarModel = new RoomModel();
        $kamarModel->tambahKamar($data);

        // Set pesan sukses
        session()->setFlashdata('success', 'Data kamar berhasil ditambahkan.');

        // Redirect ke halaman utama atau halaman lain jika diperlukan
        return redirect()->to(base_url('admin'));
    }

    public function editKamar($id_kamar)
    {
        // Membuat instance dari model KamarModel
        $kamarModel = new RoomModel();

        // Mendapatkan data kamar berdasarkan ID
        $data['kamar'] = $kamarModel->find($id_kamar);
        $data['title'] = 'Edit Kamar No.' . $data['kamar']['no_kamar'];

        // Memeriksa apakah data kamar ditemukan
        if ($data['kamar']) {
            // Jika ditemukan, tampilkan view edit_kamar dengan data kamar
            return view('admin/edit_kamar', $data);
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
        $kamarModel = new RoomModel();
        $affectedRows = $kamarModel->where('id', $idKamar)->set($data)->update();

        if ($affectedRows > 0) {
            // Set pesan sukses jika ada baris yang terpengaruh
            session()->setFlashdata('success', 'Data kamar berhasil diperbarui.');
        } else {
            // Set pesan error jika tidak ada baris yang terpengaruh
            session()->setFlashdata('error', 'Gagal memperbarui data kamar.');
        }

        // Redirect kembali ke halaman utama
        return redirect()->to(base_url('admin'));
    }

    public function edit($id_reservasi)
    {
        $reservasiModel = new \App\Models\ReservasiModel();
        $data['reservasi'] = $reservasiModel->find($id_reservasi);

        return view('admin/edit', $data);
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
        return redirect()->to(base_url('admin'));
    }
}
