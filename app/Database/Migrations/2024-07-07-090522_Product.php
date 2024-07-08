<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
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
            'kode' => [
                'type' => 'VARCHAR',
                'unique' => true,
                'constraint' => 50,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                null => false,
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                null => false,
            ],
            'stok' => [
                'type' => 'INT',
            ],
            'harga' => [
                'type' => 'INT',
                null => false,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
