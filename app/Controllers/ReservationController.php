<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\UserModel;
use App\Models\KasModel;
use App\Models\FinanceModel;
use App\Services\GenerateOrderCode;
use Dompdf\Dompdf;

class ReservationController extends BaseController
{

    public function index()
    {
        $model = new ReservationModel();
        $data['reservations'] = $model->findAll();

        return view('admin/reservation/index', $data);
    }

    public function add()
    {
        return view('admin/reservation/form_add');
    }

    public function store()
    {
        date_default_timezone_set('Asia/Jakarta');

        $frontOffice = $this->getFrontOfficeId();
        $orderId = GenerateOrderCode::generateOrderId();

        $kurang_bayar = $this->request->getPost('kurang_bayar');
        $status_bayar = $kurang_bayar > 0 ? 'belum_lunas' : 'lunas';
        $tgl_checkin = $this->formatDate($this->request->getPost('tanggal_checkin'));
        $tgl_checkout = $this->formatDate($this->request->getPost('tanggal_checkout'));

        $data = [
            'tgl' => date("Y-m-d H:i:s"),
            'kode_order' => $orderId,
            'nama' => $this->request->getPost('nama_pemesan'),
            'no_hp' => $this->request->getPost('no_hp'),
            'tgl_checkin' => $tgl_checkin,
            'tgl_checkout' => $tgl_checkout,
            'jml_kamar' => $this->request->getPost('jumlah_kamar'),
            'jml_orang' => $this->request->getPost('jumlah_orang'),
            'rate' => $this->sanitizeCurrency($this->request->getPost('rate')),
            'bayar' => $this->sanitizeCurrency($this->request->getPost('bayar')),
            'kurang_bayar' => $kurang_bayar,
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status_bayar' => $status_bayar,
            'status_order' => 'booking',
            'front_office' => $frontOffice,
        ];

        $dataFinance = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan' => 'RSV ' . $this->request->getPost('nama_pemesan') . " " . $tgl_checkin,
            'jenis'   => 'cr',
            'kategori'   => 'reservasi',
            'nominal' => str_replace('.', '', $this->request->getPost('bayar')),
            'front_office' => $frontOffice
        ];

        $financeModel = new FinanceModel();
        $reservationModel = new ReservationModel();

        if ($reservationModel->insert($data) && $financeModel->save($dataFinance)) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data');
        }

        return redirect()->to(base_url('admin/reservation'));
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

    // Dalam Controller
    public function detail($id)
    {
        // Ambil data reservasi berdasarkan ID
        $reservationModel = new ReservationModel();
        $detail = $reservationModel->find($id);
        if ($detail) {
            // Jika data ditemukan, kirim respons JSON
            return $this->response->setJSON($detail);
        } else {
            // Jika data tidak ditemukan, kirim respons JSON dengan pesan error
            return $this->response->setJSON(['error' => 'Data not found'])->setStatusCode(404);
        }
    }

    public function printReservation($reservationId)
    {
        // Inisialisasi model ReservationModel
        $reservationModel = new ReservationModel();

        // Lakukan proses pengambilan data reservasi berdasarkan ID reservasi
        $reservation = $reservationModel->find($reservationId);

        // Periksa apakah data reservasi ditemukan
        if (!$reservation) {
            // Jika tidak ditemukan, redirect dengan pesan error
            return redirect()->to('/admin/pemesanan')->with('error', 'Data reservasi tidak ditemukan.');
        }

        // Load view untuk mencetak nota reservasi dengan data yang telah diambil
        $html = view('admin/pemesanan/print_reservation', ['reservation' => $reservation]);

        // Inisialisasi objek Dompdf
        $dompdf = new Dompdf();

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Ubah nama file PDF
        $filename = 'nota_reservasi_' . $reservationId . '.pdf';

        // Keluarkan hasil PDF ke browser
        $dompdf->stream($filename);
    }

    private function formatDate($dateString)
    {
        return \DateTime::createFromFormat('d/m/Y H.i', $dateString)->format('Y-m-d H:i:s');
    }

    private function getFrontOfficeId()
    {
        $userData = session()->get('username');
        $userModel = new UserModel();
        $user = $userModel->where('username', $userData)->first();
        return $user['id'];
    }

    private function sanitizeCurrency($value)
    {
        return str_replace('.', '', $value);
    }
}
