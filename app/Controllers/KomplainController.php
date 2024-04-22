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

        // Menyimpan data ke database
        $komplainModel = new KomplainModel();
        $komplainModel->insert(['nama' => $nama, 'komplain' => $komplain]);

        // Redirect ke halaman index
        return redirect()->to(base_url('admin/komplain'));
    }
}
