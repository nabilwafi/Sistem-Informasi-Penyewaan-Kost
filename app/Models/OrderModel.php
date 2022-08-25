<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'order';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kamar', 'id_user', 'tanggal_masuk', 'tanggal_keluar', 'durasi_sewa', 'nominal_pembayaran','status_pembayaran', 'terakhir_pembayaran'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function joinOrderTable()
    {
        return $this->select('order.*, member.nama, kamar.no_kamar, kamar.gambar, , SUM(pembayaran.pembayaran) as total_pembayaran_lunas')->join('pembayaran', 'pembayaran.id_order = order.id', 'left')->join('member', 'member.id = order.id_user')->join('kamar', 'kamar.id = order.id_kamar');
    }

    public function cicilan()
    {
        return $this->select('order.nominal_pembayaran, SUM(pembayaran.pembayaran) as total_pembayaran_lunas')->join('pembayaran', 'pembayaran.id_order = order.id', 'left');
    }
}
