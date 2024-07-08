<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Facture extends Migration
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
            'no_faktur' => [
                'type' => 'VARCHAR',
                'unique' => true,
                'constraint' => 50,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'tujuan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                null => false,
            ],
            'penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                null => false,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                null => false,
            ],
            'tujuan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                null => false,
            ],
            'tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tanggal' => [
                'type' => 'date',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('factures');
    }

    public function down()
    {
        $this->forge->dropTable('factures');
    }
}
