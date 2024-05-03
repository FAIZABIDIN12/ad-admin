<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Finance extends Migration
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
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'keterangan' => [
                'type' => 'TEXT',
            ],
            'jenis' => [
                'type' => 'ENUM',
                'constraint' => ['cr', 'db'],
                'default' => 'cr',
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ]
            ,
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'front_office' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('front_office','user','id');
        $this->forge->createTable('finance');
    }

    public function down()
    {
        $this->forge->dropTable('finance');
    }
}
