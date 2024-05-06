<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CheckinModel;
use App\Models\UserModel;
use App\Models\FinanceModel;
use App\Services\GenerateOrderCode;

class CheckinController extends BaseController
{
    public function index()
    {
        //
    }

    public function simpan_checkin()
    {
        date_default_timezone_set('Asia/Jakarta');

        $idKamar = $this->request->getPost('id_kamar');
        $nama = $this->request->getPost('nama');
        $noHp = $this->request->getPost('no_hp');
        $tglCheckout = $this->request->getPost('checkout_plan');
        $tgl_checkout = \DateTime::createFromFormat('d/m/Y H.i', $tglCheckout)->format('Y-m-d H:i:s');
        $jumlahOrang = $this->request->getPost('jumlah_orang');
        $rate = $this->request->getPost('rate');
        $bayar = $this->request->getPost('bayar');
        $metodeBayar = $this->request->getPost('metode_bayar');
        $keterangan = $this->request->getPost('keterangan');

        $userData = session()->get('username');
        
        $userModel = new UserModel();
        $user = $userModel->where('username', $userData)->first();
        $frontOffice = $user['id'];
        
        $kodeOrder = $this->request->getPost('kode_order');

        if ($kodeOrder === null) {
            $kodeOrder = GenerateOrderCode::generateOrderId();
        }

        $data = [
            'nama' => $nama,
            'kode_order' => $kodeOrder,
            'no_hp' => $noHp,
            'checkin' => date("Y-m-d H:i:s"),
            'checkout_plan' => $tgl_checkout,
            'jml_orang' => $jumlahOrang,
            'id_room' => $idKamar,
            'rate' => str_replace('.', '', $rate),
            'bayar' => str_replace('.', '', $bayar),
            'metode_bayar' => $metodeBayar,
            'keterangan' => $keterangan,
            'status_order' => 'checkin',
            'front_office' => $frontOffice
        ];

        $dataFinance = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan'   => 'Bayar checkin ' . $kodeOrder . ' ' . $nama,
            'jenis'   => 'cr',
            'kategori'   => 'checkin',
            'nominal' => str_replace('.', '', $bayar),
            'front_office' => $frontOffice
        ];

        $financeModel = new FinanceModel();
        $financeModel->save($dataFinance);

        $checkinModel = new CheckinModel();
        $checkinModel->addCheckinData($data);

        session()->setFlashdata('success', 'Data checkin berhasil disimpan.');
        return redirect()->to(base_url('admin'));
    }
    public function checkout($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $checkinModel = new CheckinModel();
        $updated = $checkinModel->update($id, ['status_order' => 'done', 'checkout' => date('Y-m-d')]);

        if ($updated) {
            return redirect()->to(base_url('admin'))->with('success', 'Berhasil Checkout');
        } else {
            return redirect()->to(base_url('admin'))->with('error', 'Gagal checkout');
        }
    }

    public function history()
    {
        // Membuat instance dari model ReservasiModel
        $checkinModel = new CheckinModel();

        // Mengambil data history reservasi dari model
        $historyReservasi = $checkinModel->findAll();

        // Mengirim data history reservasi ke tampilan history.php
        return view('admin/history', ['historyReservasi' => $historyReservasi]);
    }

    public function detailCheckin($id)
    {

        $checkinModel = new CheckinModel();
        $detailCheckin = $checkinModel->getKamarById($id);
        
        if ($detailCheckin) {
            // Jika data ditemukan, kirim respons JSON
            return $this->response->setJSON($detailCheckin);
        } else {
            // Jika data tidak ditemukan, kirim respons JSON dengan pesan error
            return $this->response->setJSON(['error' => 'Data not found'])->setStatusCode(404);
        }
    }
}
