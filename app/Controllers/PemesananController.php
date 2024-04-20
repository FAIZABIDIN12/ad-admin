<?php

namespace App\Controllers;

use App\Models\PemesananModel;

class PemesananController extends BaseController
{
    // Fungsi untuk menampilkan semua pemesanan
    public function index()
    {
        $model = new PemesananModel();
        $data['pemesanan'] = $model->findAll();

        return view('admin/pemesanan/index', $data);
    }

    // Fungsi untuk menambah pemesanan baru
    // PemesananController.php

    public function tambahData()
    {
        // Menampilkan view form tambah data
        return view('admin/pemesanan/tambah_data');
    }

    public function tambah()
    {
        // Memeriksa apakah input untuk status_pemesanan tidak null
        $status_pemesanan = $this->request->getPost('status_pemesanan');

        if ($status_pemesanan === null) {
            // Jika nilai status_pemesanan null, berikan nilai default (misalnya 'booking')
            $status_pemesanan = 'booking';
        }

        // Menyiapkan data untuk disimpan
        $data = [
            'tanggal_checkin' => $this->request->getPost('tanggal_checkin'),
            'tanggal_checkout' => $this->request->getPost('tanggal_checkout'),
            'jumlah_kamar' => $this->request->getPost('jumlah_kamar'),
            'jumlah_orang' => $this->request->getPost('jumlah_orang'),
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_pembayaran' => $this->request->getPost('status_pembayaran'),
            'status_pemesanan' => $status_pemesanan, // Menggunakan nilai yang sudah diverifikasi
        ];

        // Memanggil model untuk menyimpan data pemesanan
        $pemesananModel = new PemesananModel();
        $pemesananModel->insert($data);

        // Redirect ke halaman utama
        return redirect()->to(base_url('admin/pemesanan'));
    }

    public function edit($id_pemesanan)
    {
        // Membuat instance model pemesanan
        $pemesananModel = new \App\Models\PemesananModel();

        // Mengambil data pemesanan berdasarkan ID
        $data['pemesanan'] = $pemesananModel->find($id_pemesanan);

        // Menampilkan view untuk mengedit data
        return view('admin/pemesanan/edit', $data);
    }

    public function updateData($id_pemesanan)
    {
        // Membuat instance model PemesananModel
        $model = new PemesananModel();

        // Mengambil data dari form yang dikirimkan
        $data = [
            'tanggal_checkin' => $this->request->getPost('tanggal_checkin'),
            'tanggal_checkout' => $this->request->getPost('tanggal_checkout'),
            'jumlah_kamar' => $this->request->getPost('jumlah_kamar'),
            'jumlah_orang' => $this->request->getPost('jumlah_orang'),
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_pembayaran' => $this->request->getPost('status_pembayaran'),
            'status_pemesanan' => $this->request->getPost('status_pemesanan'),
        ];

        // Memanggil metode update dari model untuk memperbarui data pemesanan
        $model->update($id_pemesanan, $data);

        // Redirect ke halaman pemesanan setelah pembaruan berhasil
        return redirect()->to(base_url('admin/pemesanan'));
    }


    // Fungsi untuk mengupdate status pembayaran pemesanan berdasarkan ID
    public function updateStatusPembayaran($id_pemesanan)
    {
        $model = new PemesananModel();

        $data = [
            'status_pembayaran' => $this->request->getPost('status_pembayaran'),
        ];

        $model->update($id_pemesanan, $data);

        return redirect()->to(base_url('admin/pemesanan'));
    }
}
