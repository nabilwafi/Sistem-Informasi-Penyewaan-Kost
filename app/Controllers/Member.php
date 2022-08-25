<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\OrderModel;
use App\Models\PembayaranModel;

class Member extends BaseController
{
    protected $orderModel;
    protected $kamarModel;
    protected $pembayaranModel;
    protected $validation;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->orderModel = new OrderModel();
        $this->kamarModel = new KamarModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $user = session()->get('id');
        
        $data = [
            'deadlines' => $this->orderModel->where(['id_user' => $user, 'terakhir_pembayaran >=' => date('Y-m-d H:i:s'), 'status_pembayaran' => 'belum bayar'])->findAll(),
            'cicilan' => $this->orderModel->cicilan()->where('id_user', $user)->groupBy('order.id')->first()
        ];

        return view('users/index', $data);
    }

    public function dataOrder($user)
    {
        $data = [
            'orders' => $this->orderModel->joinOrderTable()->where('id_user',$user)->orderBy('order.id', 'DESC')->groupBy('id')->paginate(5, 'orders'),
            'pager' => $this->orderModel->pager,
            'currentPage' => $this->request->getVar('page_orders') ? $this->request->getVar('page_orders') : 1,
            'deadlines' => $this->orderModel->where(['id_user' => $user, 'terakhir_pembayaran >=' => date('Y-m-d H:i:s'), 'status_pembayaran' => 'belum bayar'])->findAll(),
            'cicilan' => $this->orderModel->cicilan()->where('id_user', $user)->orderBy('order.id', 'desc')->groupBy('order.id')->first(),
            'order' => $this->orderModel->where('id_user', $user)->orderBy('id', 'desc')->first()
        ];

        return view('/users/order/index', $data);
    }

    public function dataPembayaran($user)
    {
        $data = [
            'pembayarans' => $this->pembayaranModel->joinPembayaranTable()->where('order.id_user', $user)->orderBy('id', 'DESC')->paginate(5, 'pembayarans'),
            'pager' => $this->pembayaranModel->pager,
            'validation' => $this->validation,
            'currentPage' => $this->request->getVar('page_pembayarans') ? $this->request->getVar('page_pembayarans') : 1,
            'deadlines' => $this->orderModel->where(['id_user' => $user, 'terakhir_pembayaran >=' => date('Y-m-d H:i:s'), 'status_pembayaran' => 'belum bayar'])->findAll(),
            'cicilan' => $this->orderModel->cicilan()->where('id_user', $user)->groupBy('order.id')->first()
        ];

        return view('/users/pembayaran/index', $data);   
    }

    public function paymentOrder($order)
    {
        $user = session()->get('id');
        $order = $this->orderModel->joinOrderTable()->find($order);

        // dd($order['nominal_pembayaran']-$order['total_pembayaran_lunas']);
        
        $data = [
            'validation' => $this->validation,
            'order' => $order,
            'deadlines' => $this->orderModel->where(['id_user' => $user, 'terakhir_pembayaran >=' => date('Y-m-d')])->findAll(),
        ];

        return view('form/checkout/payment', $data);
    }

    public function transactionOrder($order)
    {
        $validation = [
            'nominal_pembayaran' => 'required|numeric',
            'pembayaran' => 'required|numeric',
            'nama_pengirim' => 'required',
            'nomor_rekening' => 'required|numeric',
            'nama_bank' => 'required',
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|is_image[bukti_pembayaran]'
        ];

        if($this->validate($validation)) {
            $id_user = session()->get('id');
            $gambar = $this->request->getFile('bukti_pembayaran');
            $buktiPembayaran = $gambar->getRandomName();
            $gambar->move('images/bukti_pembayaran', $buktiPembayaran);

            $dataOrder = $this->orderModel->find($order);

            $input = [
                'id_order' => $order,
                'pembayaran' => $this->request->getVar('pembayaran'),
                'nama_pengirim' => $this->request->getVar('nama_pengirim'),
                'nomor_rekening' => $this->request->getVar('nomor_rekening'),
                'nama_bank' => $this->request->getVar('nama_bank'),
                'bukti_pembayaran' => $buktiPembayaran
            ];

            if(
                (
                    $this->pembayaranModel->save($input) && 
                    $this->orderModel->update($order, ['status_pembayaran' => 'menunggu verifikasi'])
                ) && 
                $this->kamarModel->update($dataOrder['id_kamar'], ['status_kamar' => 'terisi'])
            ) {
                return redirect()->to('member/pembayaran/'.$id_user)->with('success', 'Transaction Successfully');
            }else {
                return redirect()->to('member/pembayaran/'.$id_user)->with('error', 'Transaction Failed!');
            }

        }else {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }

    public function perpanjanganOrder($id_user, $id_kamar)
    {   
        $data = [
            'id_user' => $id_user,
            'id_kamar' => $id_kamar,
            'validation' => $this->validation
        ];

        return view('users/order/perpanjangan', $data);
    }

    public function perpanjangan()
    {
        $date = date('Y-m-d', strtotime(date('Y-m-d').'+ '.$this->request->getVar('durasi_sewa').' months'));
        $harga_kamar = $this->kamarModel->find($this->request->getVar('id_kamar'));

        $input = [
            'id_kamar' => $this->request->getVar('id_kamar'),
            'id_user' => $this->request->getVar('id_user'),
            'tanggal_masuk' => date('Y-m-d'),
            'tanggal_keluar' => $date,
            'durasi_sewa' => $this->request->getVar('durasi_sewa'),
            'nominal_pembayaran' => (int)$harga_kamar['harga_kamar']*(int)$this->request->getVar('durasi_sewa'),
            'terakhir_pembayaran' => date('Y:m:d H:i:s', strtotime(date('Y:m:d H:i:s'). '+6 hours'))
        ];

        if($this->orderModel->save($input)) {
            return redirect()->to('member/order/'.$this->request->getVar('id_user'))->with('success', 'Perpanjangan Berhasil');
        }else {
            return redirect()->to('member/order/'.$this->request->getVar('id_user'))->with('error', 'Perpanjangan Tidak Berhasil');
        }
    }

    public function deletedOrderWithTime()
    {
        $data = $this->orderModel->where(['terakhir_pembayaran <=' => date('Y:m:d H:i:s'), 'status_pembayaran' => 'belum bayar'])->delete();
    }
}
