<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Checkin extends Migration
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
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kode_order' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'checkin' => [
                'type' => 'DATETIME',
            ],
            'checkout' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'checkout_plan' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'jml_orang' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_room' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
            'status_order' => [
                'type' => 'ENUM',
                'constraint' => ['checkin', 'done'],
                'default' => 'checkin',
            ],
            'status_bayar' => [
                'type' => 'ENUM',
                'constraint' => ['lunas', 'belum_lunas'],
                'default' => 'belum_lunas',
            ],
            'front_office' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_room', 'room', 'id');
        $this->forge->addForeignKey('front_office', 'user', 'id');
        $this->forge->createTable('checkin');
    }

    public function down()
    {
        $this->forge->dropTable('checkin');
    }
}
