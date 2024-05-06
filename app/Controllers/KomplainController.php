<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomplainModel;
use CodeIgniter\Controller;

class KomplainController extends BaseController
{
    public function index()
    {
        $komplainModel = new KomplainModel();
        $data['komplains'] = $komplainModel->findAll();

        return view('admin/komplain/index', $data);
    }

    public function tambah()
    {
        return view('admin/komplain/tambah');
    }

    public function simpan()
    {
        // Load CodeIgniter's form validation library
        $validation = \Config\Services::validation();

        // Define validation rules
        $validation->setRules([
            'nama' => 'required',
            'keterangan' => 'required',
            'status' => 'required|in_list[0,1]', // Ensure status is either 0 or 1
        ]);

        // Run validation
        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, redirect back to the form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // If validation passes, proceed to insert data into the database
        $komplainModel = new KomplainModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => $this->request->getPost('status'),
        ];

        $komplainModel->insert($data);

        return redirect()->to('/admin/komplain')->with('success', 'Komplain berhasil ditambahkan');
    }


    public function edit($id)
    {
        $komplainModel = new KomplainModel();
        $data['komplain'] = $komplainModel->find($id);

        return view('admin/komplain/edit', $data);
    }

    public function update($id)
    {
        $komplainModel = new KomplainModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => $this->request->getPost('status'),
        ];

        $komplainModel->update($id, $data);

        return redirect()->to('/admin/komplain')->with('success', 'Komplain berhasil diperbarui');
    }

    public function delete($id)
    {
        $komplainModel = new KomplainModel();
        $komplainModel->delete($id);

        return redirect()->to('/admin/komplain')->with('success', 'Komplain berhasil dihapus');
    }
}
