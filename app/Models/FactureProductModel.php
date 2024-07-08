<?php

namespace App\Models;

use CodeIgniter\Model;

class FactureProductModel extends Model
{
    protected $table = 'facture_products';

    protected $primaryKey = 'id';

    protected $allowedFields = ['facture_id', 'product_id', 'jumlah_produk'];

    public function getProductsByFactureId($facture_id)
    {
        return $this->join('products', 'products.id = facture_products.product_id')
            ->where('facture_id', $facture_id)
            ->findAll();
    }

    public function getFactureProductById($id)
    {
        return $this->find($id);
    }
}
