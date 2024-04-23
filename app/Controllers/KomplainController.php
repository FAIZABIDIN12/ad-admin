<?php

namespace App\Controllers;

use App\Models\KomplainModel;
use CodeIgniter\Controller;

class KomplainController extends Controller
{
    public function index()
    {
        // Mengambil semua komplain dari database
        $komplainModel = new KomplainModel();
        $data['komplain'] = $komplainModel->findAll();

        // Menampilkan data komplain ke view
        return view('admin/komplain/index', $data);
    }

    public function tambah()
    {
        // Menampilkan form untuk menambahkan komplain
        return view('admin/komplain/tambah');
    }

    public function simpan()
    {
        // Mengambil data dari form
        $nama = $this->request->getPost('nama');
        $komplain = $this->request->getPost('komplain');
        $status = 'no-action'; // Set status default

        // Menyimpan data ke database
        $komplainModel = new KomplainModel();
        $success = $komplainModel->insert(['nama' => $nama, 'komplain' => $komplain, 'status' => $status]);

        if ($success) {
            // Set flashdata untuk notifikasi berhasil
            session()->setFlashdata('success', 'Komplain berhasil disimpan.');
        } else {
            // Set flashdata untuk notifikasi gagal
            session()->setFlashdata('error', 'Gagal menyimpan komplain.');
        }

        // Redirect ke halaman index
        return redirect()->to(base_url('admin/komplain'));
    }

    public function editStatus($id)
    {
        // Menampilkan form untuk mengubah status komplain
        $data['komplain'] = (new KomplainModel())->find($id);
        return view('admin/komplain/edit_status', $data);
    }

    public function updateStatus($id)
    {
        // Memperbarui status komplain berdasarkan ID
        $model = new KomplainModel();
        $data = [
            'status' => $this->request->getPost('status')
        ];
        $model->update($id, $data);

        // Redirect ke halaman komplain setelah pembaruan berhasil
        return redirect()->to(base_url('admin/komplain'));
    }
}
