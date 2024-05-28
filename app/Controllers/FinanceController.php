<?php

namespace App\Controllers;

use App\Models\FinanceModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class FinanceController extends Controller
{
    public function index()
    {
        $model = new FinanceModel();

        // Fetch total uang masuk
        $totalUangMasuk = $model->where('jenis', 'cr')->selectSum('nominal')->first();
        $data['totalUangMasuk'] = $totalUangMasuk['nominal'];

        // Fetch total uang keluar
        $totalUangKeluar = $model->where('jenis', 'db')->selectSum('nominal')->first();
        $data['totalUangKeluar'] = $totalUangKeluar['nominal'];

        // Calculate saldo
        $data['saldo'] = $data['totalUangMasuk'] - $data['totalUangKeluar'];

        // Fetch all cash data
        $data['cashs'] = $model->findAll();

        return view('admin/finance/index', $data);
    }

    public function saveCredit()
    {
        $model = new FinanceModel();

        $userData = session()->get('username');

        $userModel = new UserModel();
        $user = $userModel->where('username', $userData)->first();
        $frontOffice = $user['id'];

        $data = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan'   => $this->request->getPost('keterangan'),
            'jenis'   => 'cr',
            'kategori' => 'manual',
            'nominal' => str_replace(array('.', ','), '', $this->request->getPost('nominal')),
            'front_office' => $frontOffice
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('admin/finance'));
        } else {
            // Jika penyimpanan gagal, tampilkan pesan kesalahan
            $data['errors'] = $model->errors();
            return redirect()->to(base_url('admin/add-credit'), $data);
        }
    }
    public function saveDebet()
    {
        $model = new FinanceModel();

        $userData = session()->get('username');

        $userModel = new UserModel();
        $user = $userModel->where('username', $userData)->first();
        $frontOffice = $user['id'];

        $data = [
            'tanggal' => date("Y-m-d H:i:s"),
            'keterangan'   => $this->request->getPost('keterangan'),
            'jenis'   => 'db',
            'kategori' => 'manual',
            'nominal' => str_replace(array('.', ','), '', $this->request->getPost('nominal')),
            'front_office' => $frontOffice
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('admin/finance'));
        } else {
            // Jika penyimpanan gagal, tampilkan pesan kesalahan
            $data['errors'] = $model->errors();
            return redirect()->to(base_url('admin/add-debet'), $data);
        }
    }

    public function addCredit()
    {
        return view('admin/finance/add_credit');
    }
    public function addDebet()
    {
        return view('admin/finance/add_debet');
    }


    // Metode lainnya seperti edit, update, delete, dll dapat ditambahkan sesuai kebutuhan
}
