<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [];
        for ($i = 1; $i <= 20; $i++) {
            // Format nomor kamar menjadi 3 digit dengan angka nol di depan jika perlu
            $roomNumber = str_pad($i, 3, '0', STR_PAD_LEFT);
            // Tambahkan nomor kamar ke array
            $rooms[] = [
                'no_kamar' => $roomNumber
            ];
        }

        // Masukkan data ke dalam tabel room menggunakan db seeder
        $this->db->table('room')->insertBatch($rooms);
    }
}
