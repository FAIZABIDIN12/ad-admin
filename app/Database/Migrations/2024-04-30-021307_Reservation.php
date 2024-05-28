<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode_order' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tgl' => [
                'type' => 'DATETIME',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'tgl_checkin' => [
                'type' => 'DATETIME',
            ],
            'tgl_checkout' => [
                'type' => 'DATETIME',
            ],
            'jml_orang' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jml_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'rate' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'bayar' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'kurang_bayar' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'metode_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_bayar' => [
                'type' => 'ENUM',
                'constraint' => ['lunas', 'belum_lunas'],
                'default' => 'belum_lunas',
            ],
            'status_order' => [
                'type' => 'ENUM',
                'constraint' => ['booking', 'cancel', 'checkin', 'done'],
                'default' => 'booking',
            ],
            'front_office' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kode_order');
        $this->forge->addForeignKey('front_office', 'user', 'id');
        $this->forge->createTable('reservation');
    }

    public function down()
    {
        $this->forge->dropTable('reservation');
    }
}
