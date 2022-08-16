<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_order', 'pembayaran', 'nama_pengirim', 'nomor_rekening', 'nama_bank', 'bukti_pembayaran'];

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

    public function joinPembayaranTable()
    {
        return $this->select('pembayaran.*, order.nominal_pembayaran,order.id_user, order.status_pembayaran, kamar.no_kamar')
                        ->join('order', 'order.id = pembayaran.id_order')
                        ->join('kamar', 'kamar.id = order.id_kamar');
    }

    public function userTransaksi()
    {
        return $this->select('pembayaran.*, member.nama, kamar.no_kamar')
                        ->join('order', 'order.id = pembayaran.id_order')
                        ->join('kamar', 'kamar.id = order.id_kamar')
                        ->join('member', 'member.id = order.id_user');
    }

    public function transactionSum($id_order)
    {
        return $this->select('(SELECT SUM(pembayaran.pembayaran) FROM pembayaran WHERE pembayaran.id_order='.$id_order.') AS total_pembayaran', false)->first();
    }
}
