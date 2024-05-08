<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrouble extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'no_kamar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'trouble' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'progress' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'is_done' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('troubles');
    }

    public function down()
    {
        $this->forge->dropTable('troubles');
    }
}
