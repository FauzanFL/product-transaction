<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Product extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode' => 'P001',
                'nama' => 'Ban Luar',
                'satuan' => 'Pcs',
                'stok' => 40,
                'harga' => 2300000,
            ],
            [
                'kode' => 'P002',
                'nama' => 'Baut Ukuran 18',
                'satuan' => 'Dus',
                'stok' => 35,
                'harga' => 110000,
            ],
            [
                'kode' => 'P003',
                'nama' => 'Oli Mesin',
                'satuan' => 'Liter',
                'stok' => 35,
                'harga' => 125000,
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}
