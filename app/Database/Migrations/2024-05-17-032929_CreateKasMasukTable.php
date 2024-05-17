<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKasMasukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tgl_transaksi' => [
                'type' => 'DATE',
            ],
            'uraian' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kas_masuk' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2', // Total digit dan digit di belakang koma
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kas_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('kas_masuk');
    }
}
