<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\OrderModel;

class Pesan extends BaseController
{
    protected $kamarsModel;
    protected $orderModel;
    protected $validation;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->kamarsModel = new KamarModel();
        $this->orderModel = new OrderModel();
    }

    public function index($kamar)
    {   
        $data = [
            'kamar' => $this->kamarsModel->find($kamar),
            'validation' => $this->validation
        ];
        
        return view('form/checkout/index', $data);
    }

    public function pesanKamar()
    {
        $validation = [
            'tanggal_masuk' => 'required',
            'durasi_sewa' => 'required|in_list[3,6,12]'
        ];

        if($this->validate($validation)) {
            $date = date('Y-m-d', strtotime($this->request->getVar('tanggal_masuk').'+ '.$this->request->getVar('durasi_sewa').' months'));

            $input = [
                'id_kamar' => $this->request->getVar('id_kamar'),
                'id_user' => $this->request->getVar('id_user'),
                'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
                'tanggal_keluar' => $date,
                'durasi_sewa' => $this->request->getVar('durasi_sewa'),
                'nominal_pembayaran' => (int)$this->request->getVar('harga_kamar')*(int)$this->request->getVar('durasi_sewa'),
                'terakhir_pembayaran' => date('Y:m:d H:i:s', strtotime(date('Y:m:d H:i:s'). '+1 day'))
            ];

            if($this->orderModel->save($input)) {
                session()->set('haveOrder', true);
                return redirect()->to('member/order/'.$input['id_user'])->with('success', 'Ordered Room Successfully');
            }else {
                return redirect()->to('member/order/'.$input['id_user'])->with('error', 'Failed Ordered Room!');
            }

        }else {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }
}
