<?php

namespace App\Models;

use CodeIgniter\Model;

class FactureModel extends Model
{
    protected $table = 'factures';

    protected $primaryKey = 'id';

    protected $allowedFields = ['no_faktur', 'user_id', 'tujuan', 'penerima', 'alamat', 'tempat', 'tanggal'];

    public function getFactures()
    {
        return $this->findAll();
    }

    public function getFactureById($id)
    {
        return $this->join('users', 'users.id = factures.user_id',)
            ->where('factures.id', $id)
            ->select('factures.*, users.nama, users.id as user_id')
            ->first();
    }

    public function getFactureByNoFaktur($noFaktur)
    {
        return $this->where('no_faktur', $noFaktur)->first();
    }
}
