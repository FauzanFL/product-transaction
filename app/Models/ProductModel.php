<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $allowedFields = ['kode', 'nama', 'satuan', 'stok', 'harga'];

    public function getProducts()
    {
        return $this->findAll();
    }

    public function getReadyProducts()
    {
        return $this->where('stok >', 0)->findAll();
    }

    public function getProductById($id)
    {
        return $this->find($id);
    }
    public function getProductByKode($kode)
    {
        return $this->where('kode = ', $kode)->first();
    }
}
