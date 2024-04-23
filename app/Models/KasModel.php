<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
    protected $table = 'kas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['keterangan', 'tanggal', 'jenis', 'nominal'];

    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $validationRules    = [
        'tanggal' => 'required|valid_date',
        'jenis'   => 'required|in_list[cr,db]',
        'nominal' => 'required|integer'
    ];

    protected $validationMessages = [
        'tanggal' => [
            'required'    => 'Tanggal transaksi harus diisi.',
            'valid_date'  => 'Format tanggal tidak valid.'
        ],
        'jenis' => [
            'required' => 'Jenis transaksi harus diisi.',
            'in_list'  => 'Jenis transaksi harus "cr" atau "db".'
        ],
        'nominal' => [
            'required' => 'Nominal transaksi harus diisi.',
            'integer'  => 'Nominal transaksi harus berupa bilangan bulat.'
        ]
    ];

    // Jika Anda ingin menambahkan metode tambahan untuk model, Anda bisa menambahkannya di sini.
}
