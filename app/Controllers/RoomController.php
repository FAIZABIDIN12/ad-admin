<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;
use App\Models\CheckinModel;
use App\Models\TroubleModel;

class RoomController extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        $roomModel = new RoomModel();
        $checkinModel = new CheckinModel();
        $reservationModel = new ReservationModel();

        $data['reservations'] = $reservationModel->where('status_order', 'book')->findAll();
        $data['title'] = 'Dashboard';
        $data['rooms'] = $roomModel->semuaKamar();
        $data['checkins'] = $checkinModel->getAllCheckin();

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
        date_default_timezone_set('Asia/Jakarta');
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

        $dataHistory = [
            'tanggal' =>date("Y-m-d H:i:s"),
            'no_kamar' => $noKamar,
            'trouble' => $keterangan,
            'is_done' => false
        ];

        // Memanggil model untuk update data kamar
        $kamarModel = new RoomModel();
        $affectedRows = $kamarModel->where('id', $idKamar)->set($data)->update();

        $troubleModel = new TroubleModel();
        $troubleModel->insert($dataHistory);

        

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

}
