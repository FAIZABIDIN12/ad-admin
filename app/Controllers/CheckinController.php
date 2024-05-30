<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CheckinModel;
use App\Models\UserModel;
use App\Models\KasModel;
use App\Models\FinanceModel;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Services\GenerateOrderCode;
use Dompdf\Dompdf;
use Dompdf\Options;

class CheckinController extends BaseController
{
    public function index()
    {
        //
    }

    public function simpan_checkin()
    {
        date_default_timezone_set('Asia/Jakarta');
        $reservationModel = new ReservationModel();
        $roomModel = new RoomModel();

        $idKamar = $this->request->getPost('id_kamar');
        $nama = $this->request->getPost('nama');
        $noHp = $this->request->getPost('no_hp');
        $tgl_checkout = $this->formatDate($this->request->getPost('checkout_plan'));
        $jumlahOrang = $this->request->getPost('jumlah_orang');
        $rate = $this->sanitizeCurrency($this->request->getPost('rate'));
        $bayar = $this->sanitizeCurrency($this->request->getPost('bayar'));
        $metodeBayar = $this->request->getPost('metode_bayar');
        $keterangan = $this->request->getPost('keterangan');
        $frontOffice = $this->getFrontOfficeId();
        $kodeOrder = $this->request->getPost('kode_order');
        $stay = $this->calculateDateDifference(date("Y-m-d H:i:s"), $tgl_checkout);
        $kurangBayar = ($rate * $stay) - $bayar;

        if ($kodeOrder === null) {
            $kodeOrder = GenerateOrderCode::generateOrderId();
        } else {
            $order = $reservationModel->where('kode_order', $kodeOrder)->first();
            if ($order) {
                $deposit = $order['bayar'];
                $kurangBayar -= $deposit;
                $bayar += $deposit;
                $reservationModel->set('status_order', 'checkin')->where('kode_order', $kodeOrder)->update();
                if ($kurangBayar === 0) {
                    $reservationModel->set('status_bayar', 'lunas')->where('kode_order', $kodeOrder)->update();
                }
            }
        }

        $kamar = $roomModel->where('id', $idKamar)->first();
        $statusPembayaran = $kurangBayar > 0 ? 'belum_lunas' : 'lunas';

        $data = [
            'nama' => $nama,
            'kode_order' => $kodeOrder,
            'no_hp' => $noHp,
            'checkin' => date("Y-m-d H:i:s"),
            'checkout_plan' => $tgl_checkout,
            'jml_orang' => $jumlahOrang,
            'id_room' => $idKamar,
            'rate' => $rate,
            'bayar' => $bayar,
            'metode_bayar' => $metodeBayar,
            'kurang_bayar' => $kurangBayar,
            'keterangan' => $keterangan,
            'status_order' => 'checkin',
            'status_bayar' => $statusPembayaran,
            'front_office' => $frontOffice
        ];

        $dataFinance = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan'   => 'Kamar No. ' . $kamar['no_kamar'] . ' ' . $nama,
            'jenis'   => 'cr',
            'kategori'   => 'checkin',
            'nominal' => $this->sanitizeCurrency($this->request->getPost('bayar')),
            'front_office' => $frontOffice
        ];

        $financeModel = new FinanceModel();
        $financeModel->save($dataFinance);

        // $kasModel = new KasModel();
        // $kasModel->insert([
        //     'tgl_transaksi' => date('Y-m-d H:i:s'),
        //     'uraian' => 'Rate untuk check-in oleh ' . $nama,
        //     'kas_masuk' => str_replace('.', '', $rate),
        // ]);
        // // Masukkan data pembayaran ke dalam tabel 'kas_masuk'
        // $kasModel->insert([
        //     'tgl_transaksi' => date('Y-m-d H:i:s'),
        //     'uraian' => 'Pembayaran check-in oleh ' . $nama,
        //     'kas_masuk' => str_replace('.', '', $bayar),
        // ]);

        $checkinModel = new CheckinModel();
        $checkinModel->addCheckinData($data);

        session()->setFlashdata('success', 'Data checkin berhasil disimpan.');
        return redirect()->to(base_url('admin'));
    }



    public function checkout($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $checkinModel = new CheckinModel();
        $kodeOrder = $checkinModel->select('kode_order')->find($id);
        $updated = $checkinModel->update($id, ['status_order' => 'done', 'checkout' => date("Y-m-d H:i:s")]);

        $reservationModel = new ReservationModel();
        $order = $reservationModel->where('kode_order', $kodeOrder)->first();

        if ($order) {
            $reservationModel->set('status_order', 'done')->where('kode_order', $kodeOrder)->update();
        }

        if ($updated) {
            return redirect()->to(base_url('admin'))->with('success', 'Berhasil Checkout');
        } else {
            return redirect()->to(base_url('admin'))->with('error', 'Gagal checkout');
        }
    }
    public function pelunasan($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $checkinModel = new CheckinModel();
        $dataCheckin = $checkinModel->find($id);

        $kodeOrder = $dataCheckin['kode_order'];
        $kurangBayar = $dataCheckin['kurang_bayar'];
        $sisaBayar = $this->request->getPost('pelunasan');
        $totalKurang = $kurangBayar - $sisaBayar;

        $statusBayar = $totalKurang === 0 ? 'lunas' : 'belum_lunas';

        $frontOffice = $this->getFrontOfficeId();

        $updated = $checkinModel->update($id, ['status_order' => 'done', 'checkout' => date("Y-m-d H:i:s"), 'kurang_bayar' => $totalKurang, 'status_bayar' => $statusBayar]);

        $reservationModel = new ReservationModel();
        $order = $reservationModel->where('kode_order', $kodeOrder)->first();

        if ($order) {
            $reservationModel->set('status_order', 'done')->where('kode_order', $kodeOrder)->update();
        }

        if ($updated) {
            $dataFinance = [
                'tanggal' => date("Y-m-d H:i:s"),
                'keterangan'   => 'Pelunasan Kamar No. ' . $dataCheckin['id_room'] . ' ' . $dataCheckin['nama'],
                'jenis'   => 'cr',
                'kategori'   => 'pelunasan',
                'nominal' => str_replace('.', '', $sisaBayar),
                'front_office' => $frontOffice
            ];

            $financeModel = new FinanceModel();
            $financeModel->save($dataFinance);

            return redirect()->to(base_url('admin'))->with('success', 'Berhasil Checkout');
        } else {
            return redirect()->to(base_url('admin'))->with('error', 'Gagal checkout');
        }
    }

    public function extend($id)
    {
        $checkoutExtend = $this->formatDate($this->request->getPost('extend_checkout'));
        $tagihanExtend = $this->sanitizeCurrency($this->request->getPost('tagihan_extend'));

        $checkinModel = new CheckinModel();
        $dataCheckin = $checkinModel->find($id);

        if (!$dataCheckin) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $statusBayar = $tagihanExtend > 0 ? 'belum_lunas' : 'lunas';

        $updatedData = [
            'checkout_plan' => $checkoutExtend,
            'kurang_bayar' => $tagihanExtend,
            'status_bayar' => $statusBayar
        ];

        $checkinModel->update($id, $updatedData);
        return redirect()->to('/admin')->with('success', 'Berhasil extend');
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

    public function printCheckin($checkinId)
    {
        $checkinModel = new CheckinModel();

        $checkin = $checkinModel->find($checkinId);

        if (!$checkin) {
            return redirect()->to('/admin/checkin')->with('error', 'Data checkin tidak ditemukan.');
        }

        // return view('admin/print_checkin', ['checkin' => $checkin]);

        $html = view('admin/print_checkin', ['checkin' => $checkin]);

        $bootstrapCss = '
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        ';

        $htmlWithCss = "
        $bootstrapCss
        $html
        ";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlWithCss);
        $dompdf->render();
        $dompdf->stream('nota_checkin_' . $checkin['kode_order'] . '_' . $checkin['nama'] . '.pdf');
    }

    private function formatDate($dateString)
    {
        return \DateTime::createFromFormat('d/m/Y H.i', $dateString)->format('Y-m-d H:i:s');
    }

    private function sanitizeCurrency($value)
    {
        return str_replace('.', '', $value);
    }

    private function getFrontOfficeId()
    {
        $userData = session()->get('username');
        $userModel = new UserModel();
        $user = $userModel->where('username', $userData)->first();
        return $user['id'];
    }

    private function calculateDateDifference($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $start->setTime(0, 0, 0);

        $end = new \DateTime($endDate);
        $end->setTime(0, 0, 0);

        $interval = $start->diff($end);
        return $interval->days;
    }
}
