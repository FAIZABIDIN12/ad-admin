<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\UserModel;
use App\Models\FinanceModel;
use App\Services\GenerateOrderCode;

class ReservationController extends BaseController
{
    // Fungsi untuk menampilkan semua pemesanan
    public function index()
    {
        $model = new ReservationModel();
        $data['pemesanan'] = $model->findAll();

        return view('admin/pemesanan/index', $data);
    }

    // Fungsi untuk menambah pemesanan baru
    public function tambahData()
    {
        // Menampilkan view form tambah data
        return view('admin/pemesanan/tambah_data');
    }

    public function tambah()
    {
        // Memeriksa apakah input untuk status_pemesanan tidak null
        $status_order = $this->request->getPost('status_order');

        if ($status_order === null) {
            // Jika nilai status_pemesanan null, berikan nilai default (misalnya 'booking')
            $status_order = 'booking';
        }

        $userData = session()->get('username');
        
        $userModel = new UserModel();
        $user = $userModel->where('username', $userData)->first();
        $frontOffice = $user['id'];
        $orderId = GenerateOrderCode::generateOrderId();

        // Menyiapkan data untuk disimpan
        $data = [
            'tgl' => date("Y-m-d H:i:s"),
            'kode_order' => $orderId,
            'nama' => $this->request->getPost('nama_pemesan'),
            'no_hp' => $this->request->getPost('no_hp'),
            'tgl_checkin' => $this->request->getPost('tanggal_checkin'),
            'tgl_checkout' => $this->request->getPost('tanggal_checkout'),
            'jml_kamar' => $this->request->getPost('jumlah_kamar'),
            'jml_orang' => $this->request->getPost('jumlah_orang'),
            'rate' => $this->request->getPost('rate'),
            'bayar' => $this->request->getPost('bayar'),
            'kurang_bayar' => 0,
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status_bayar' => $this->request->getPost('status_bayar'),
            'status_order' => $status_order, // Menggunakan nilai yang sudah diverifikasi
            'front_office' => $frontOffice, // Menggunakan nilai yang sudah diverifikasi
        ];

        $dataFinance = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan'   => 'Reservasi ' . $orderId . ' ' . $this->request->getPost('nama_pemesan') ,
            'jenis'   => 'cr',
            'kategori'   => 'reservasi',
            'nominal' => $this->request->getPost('bayar'),
            'front_office' => $frontOffice
        ];

        $financeModel = new FinanceModel();
        $financeModel->save($dataFinance);
        // Memanggil model untuk menyimpan data pemesanan
        $reservationModel = new ReservationModel();
        if ($reservationModel->insert($data)) {
            // Jika data berhasil ditambahkan, set notifikasi berhasil
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
        } else {
            // Jika data gagal ditambahkan, set notifikasi gagal
            session()->setFlashdata('error', 'Gagal menambahkan data');
        }

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
        if ($model->update($id_pemesanan, $data)) {
            // Jika pembaruan berhasil, set notifikasi berhasil
            session()->setFlashdata('success', 'Data berhasil diperbarui');
        } else {
            // Jika pembaruan gagal, set notifikasi gagal
            session()->setFlashdata('error', 'Gagal memperbarui data');
        }

        // Redirect ke halaman pemesanan setelah pembaruan berhasil
        return redirect()->to(base_url('admin/pemesanan'));
    }

    public function updateStatusPembayaran($id_pemesanan)
    {
        $model = new PemesananModel();

        $data = [
            'status_pembayaran' => $this->request->getPost('status_pembayaran'),
        ];

        // Memanggil metode update dari model untuk memperbarui status pembayaran pemesanan
        if ($model->update($id_pemesanan, $data)) {
            // Jika pembaruan berhasil, set notifikasi berhasil
            session()->setFlashdata('success', 'Status pembayaran berhasil diperbarui');
        } else {
            // Jika pembaruan gagal, set notifikasi gagal
            session()->setFlashdata('error', 'Gagal memperbarui status pembayaran');
        }

        return redirect()->to(base_url('admin/pemesanan'));
    }

    
}
