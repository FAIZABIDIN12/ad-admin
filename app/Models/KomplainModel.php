<?php

namespace App\Models;

use CodeIgniter\Model;

class KomplainModel extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'komplain', 'status']; // Menambahkan field 'status'
    protected $returnType = 'object'; // Mengubah returnType menjadi object

    // Menambahkan validation rules jika diperlukan
    protected $validationRules = [
        'nama' => 'required',
        'komplain' => 'required'
    ];

    // Menambahkan pesan error jika validasi gagal
    protected $validationMessages = [
        'nama' => [
            'required' => 'Nama harus diisi.'
        ],
        'komplain' => [
            'required' => 'Komplain harus diisi.'
        ]
    ];

    // Menambahkan alias untuk field status
    protected $statusLabels = [
        'slesai' => 'Selesai',
        'proses' => 'Proses',
        'no-action' => 'Tidak ada tindakan'
    ];

    public function getStatusLabels()
    {
        return $this->statusLabels;
    }
}
