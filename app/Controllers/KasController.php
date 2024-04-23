<?php

namespace App\Controllers;

use App\Models\KasModel;
use CodeIgniter\Controller;

class KasController extends Controller
{
    public function index()
    {
        $model = new KasModel();
        $data['kas'] = $model->findAll();

        return view('admin/kas/index', $data);
    }

    public function simpan()
    {
        $model = new KasModel();

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jenis'   => $this->request->getPost('jenis'),
            'nominal' => $this->request->getPost('nominal')
        ];

        if ($model->save($data)) {
            return redirect()->to('/admin/kas');
        } else {
            // Jika penyimpanan gagal, tampilkan pesan kesalahan
            $data['errors'] = $model->errors();
            return view('admin/kas', $data);
        }
    }


    // Metode lainnya seperti edit, update, delete, dll dapat ditambahkan sesuai kebutuhan
}
