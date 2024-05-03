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
            'rate' => str_replace('.', '', $this->request->getPost('rate')),
            'bayar' => str_replace('.', '', $this->request->getPost('bayar')),
            'kurang_bayar' => 0,
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status_bayar' => $this->request->getPost('status_bayar'),
            'status_order' => $status_order, // Menggunakan nilai yang sudah diverifikasi
            'front_office' => $frontOffice, // Menggunakan nilai yang sudah diverifikasi
        ];

        $dataFinance = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan' => 'Reservasi ' . $orderId . ' ' . $this->request->getPost('nama_pemesan'),
            'jenis'   => 'cr',
            'kategori'   => 'reservasi',
            'nominal' => str_replace('.', '', $this->request->getPost('bayar')),
            'front_office' => $frontOffice
        ];


        $financeModel = new FinanceModel();
        $reservationModel = new ReservationModel();
        if ($reservationModel->insert($data) && $financeModel->save($dataFinance)) {
            // Jika data berhasil ditambahkan, set notifikasi berhasil
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
        } else {
            // Jika data gagal ditambahkan, set notifikasi gagal
            session()->setFlashdata('error', 'Gagal menambahkan data');
        }

        // Redirect ke halaman utama
        return redirect()->to(base_url('admin/pemesanan'));
    }


    public function edit($id)
    {
        // Membuat instance model pemesanan
        $reservationmodel = new \App\Models\ReservationModel();

        // Mengambil data pemesanan berdasarkan ID
        $data['reservation'] = $reservationmodel->find($id);

        // Menampilkan view untuk mengedit data
        return view('admin/pemesanan/edit', $data);
    }

    public function updateData($id)
    {
        // Membuat instance model reservationmodel
        $model = new ReservationModel();

        // Mengambil data dari form yang dikirimkan
        $data = [
            'nama' => $this->request->getPost('nama'),
            'tgl_checkin' => $this->request->getPost('tgl_checkin'),
            'tgl_checkout' => $this->request->getPost('tgl_checkout'),
            'jml_kamar' => $this->request->getPost('jml_kamar'),
            'jml_orang' => $this->request->getPost('jml_orang'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_pembayaran' => $this->request->getPost('status_bayar'),
            'status_pemesanan' => $this->request->getPost('status_pemesanan'),
        ];

        // Memanggil metode update dari model untuk memperbarui data pemesanan
        if ($model->update($id, $data)) {
            // Jika pembaruan berhasil, set notifikasi berhasil
            session()->setFlashdata('success', 'Data berhasil diperbarui');
        } else {
            // Jika pembaruan gagal, set notifikasi gagal
            session()->setFlashdata('error', 'Gagal memperbarui data');
        }

        // Redirect ke halaman pemesanan setelah pembaruan berhasil
        return redirect()->to(base_url('admin/pemesanan'));
    }

    public function updateStatusPembayaran($id)
    {
        $model = new ReservationModel();

        $data = [
            'status_pembayaran' => $this->request->getPost('status_bayar'),
        ];

        // Memanggil metode update dari model untuk memperbarui status pembayaran pemesanan
        if ($model->update($id, $data)) {
            // Jika pembaruan berhasil, set notifikasi berhasil
            session()->setFlashdata('success', 'Status pembayaran berhasil diperbarui');
        } else {
            // Jika pembaruan gagal, set notifikasi gagal
            session()->setFlashdata('error', 'Gagal memperbarui status pembayaran');
        }

        return redirect()->to(base_url('admin/pemesanan'));
    }
}
