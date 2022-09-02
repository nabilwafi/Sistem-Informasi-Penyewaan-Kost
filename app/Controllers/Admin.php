<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KamarModel;
use App\Models\MemberModel;
use App\Models\OrderModel;
use App\Models\PembayaranModel;
use App\Models\PengeluaranModel;
use Dompdf\Dompdf;

class Admin extends BaseController
{
    protected $members;
    protected $kamars;
    protected $orders;
    protected $pembayarans;
    protected $pengeluarans;
    protected $validation;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->members = new MemberModel();
        $this->pembayarans = new PembayaranModel();
        $this->orders = new OrderModel();
        $this->kamars = new KamarModel();
        $this->pengeluarans = new PengeluaranModel();
    }

    public function index()
    {
        return view('admin/index');
    }

    /**
     * 
     * CONTROLLER MODULE DATA USER
     * FROM
     * SHOWING ALL DATA MEMBERS
     * UNTIL
     * DELETED USERS FROM ID
     * 
     */
    public function dataUser()
    {
        $data = [
            'members' => $this->members->orderBy('id', 'DESC')->paginate(5, 'members'),
            'pager' => $this->members->pager,
            'currentPage' => $this->request->getVar('page_members') ? $this->request->getVar('page_members') : 1,
            'validation' => $this->validation
        ];

        return view('admin/users/index', $data);
    }

    public function createUser()
    {
        $validation = [
            'nama' => 'required|min_length[2]',
            'email' => 'required|is_unique[member.email]',
            'password' => 'required|min_length[5]',
            'handphone' => 'required|min_length[8]|numeric',
            'alamat' => 'required|min_length[5]'
        ];

        if(!$this->validate($validation)) {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $input = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'handphone' => $this->request->getVar('handphone'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => 'member',
        ];

        if($this->members->save($input)) {
            
            return redirect()->back()->with('success', 'Created Account Successfully');
        }else {
            return redirect()->back()->with('error', 'Failed Created Account');
        }
    }

    public function editUser($member)
    {
        $data = [
            'validation' => $this->validation,
            'member' => $this->members->find($member),
        ];

        return view('admin/users/update', $data);
    }

    public function updateUser($member)
    {
        $validation = [
            'nama' => 'required|min_length[5]',
            'email' => 'required',
            'handphone' => 'required|min_length[8]|numeric',
            'alamat' => 'required|min_length[5]',
        ];

        if(!$this->validate($validation)) {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $input = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'handphone' => $this->request->getVar('handphone'),
            'alamat' => $this->request->getVar('alamat'),
            'password' => $this->request->getVar('password')
        ];

        if($this->members->update($member, $input)) {
            return redirect()->to('/admin/data-user')->with('success', 'Updated user successfully');
        }else {
            return redirect()->to('/admin/data-user')->with('error', 'Failed Updated user');
        }

    }

    public function deleteUser($member)
    {
        $this->members->delete($member);
        return redirect()->back()->with('success', 'Delete user successfully');
    }

    /**
     * 
     * CONTROLLER MODULE DATA KAMAR
     * FROM
     * SHOWING ALL DATA KAMAR
     * UNTIL
     * DELETED KAMAR FROM ID
     * 
     */
    public function dataKamar()
    {
        $data = [
            'kamars' => $this->kamars->orderBy('id', 'DESC')->paginate(5, 'kamars'),
            'pager' => $this->kamars->pager,
            'currentPage' => $this->request->getVar('page_kamars') ? $this->request->getVar('page_kamars') : 1,
            'validation' => $this->validation
        ];

        return view('admin/kamar/index', $data);
    }

    public function createKamar()
    {
        $validation = [
            'no_kamar' => 'required|numeric',
            'gambar' => 'uploaded[gambar]|is_image[gambar]',
            'deskripsi' => 'required|min_length[5]',
            'harga_kamar' => 'required|numeric',
            'status_kamar' => 'required|in_list[tidak terisi, terisi]'
        ];

        if(!$this->validate($validation)) {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $gambar = $this->request->getFile('gambar');
        $gambarKamar = $gambar->getRandomName();
        $gambar->move('images/kamar', $gambarKamar);

        $input = [
            'no_kamar' => $this->request->getVar('no_kamar'),
            'gambar' => $gambarKamar,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'harga_kamar' => $this->request->getVar('harga_kamar'),
            'status_kamar' => $this->request->getVar('status_kamar'),
        ];
        

        if($this->kamars->save($input)) {
            
            return redirect()->back()->with('success', 'Created Account Successfully');
        }else {
            return redirect()->back()->with('error', 'Failed Created Account');
        }
    }

    public function editKamar($kamar)
    {
        $data = [
            'validation' => $this->validation,
            'kamar' => $this->kamars->find($kamar),
        ];

        return view('admin/kamar/update', $data);
    }

    public function updateKamar($kamar)
    {
        $validation = [
            'no_kamar' => 'required|numeric',
            'deskripsi' => 'required|min_length[5]',
            'harga_kamar' => 'required|numeric',
            'status_kamar' => 'required|in_list[tidak terisi, terisi]'
        ];

        if($this->validate($validation)) {
            $data = $this->kamars->find($kamar);

            if($_FILES['gambar']['name']) {
                $gambar = $this->request->getFile('gambar');
                $gambarKamar = $gambar->getRandomName();
                $gambar->move('images/kamar', $gambarKamar);

                $input = [
                    'no_kamar' => $this->request->getVar('no_kamar'),
                    'gambar' => $gambarKamar,
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'harga_kamar' => $this->request->getVar('harga_kamar'),
                    'status_kamar' => $this->request->getVar('status_kamar')
                ];

                if($this->kamars->update($kamar, $input)) {
                    unlink('./images/kamar/'.$data['gambar']);
                    return redirect()->to('/admin/data-kamar')->with('success', 'Created Kamar Successfully');
                }else {
                    return redirect()->to('/admin/data-kamar')->with('error', 'Failed Created Kamar');
                }
            }else {
                $input = [
                    'no_kamar' => $this->request->getVar('no_kamar'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'harga_kamar' => $this->request->getVar('harga_kamar'),
                    'status_kamar' => $this->request->getVar('status_kamar')
                ];

                if($this->kamars->update($kamar, $input)) {
                    return redirect()->to('/admin/data-kamar')->with('success', 'Created Kamar Successfully');
                }else {
                    return redirect()->to('/admin/data-kamar')->with('error', 'Failed Created Kamar');
                }
            }

        }else {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }

    public function deleteKamar($kamar)
    {
        $data = $this->kamars->find($kamar);

        if($this->kamars->delete($kamar)) {
            unlink('./images/kamar/'.$data['gambar']);
            return redirect()->back()->with('success', 'Deleted Kamar successfully');
        }else {
            return redirect()->back()->with('error', 'Failed Deleted Kamar');
        }
    }

    /**
     * 
     * CONTROLLER MODULE DATA PENGELUARAN
     * FROM
     * SHOWING ALL DATA PENGELUARAN
     * UNTIL
     * DELETED PENGELUARAN FROM ID
     * 
     */
    public function dataPengeluaran()
    {

        $pengeluaran = 
            $this->request->getVar('tanggal_awal') && $this->request->getVar('tanggal_akhir') ? 
                $this->pengeluarans->findByDate($this->request->getVar('tanggal_awal'), $this->request->getVar('tanggal_akhir')) : 
                $this->pengeluarans;

        $data = [
            'pengeluarans' => $pengeluaran->orderBy('id', 'DESC')->paginate(5, 'pengeluarans'),
            'pager' => $this->pengeluarans->pager,
            'currentPage' => $this->request->getVar('page_pengeluarans') ? $this->request->getVar('page_pengeluarans') : 1,
            'validation' => $this->validation,
            'tanggal_awal' => $this->request->getVar('tanggal_awal') ? $this->request->getVar('tanggal_awal') : "",
            'tanggal_akhir' => $this->request->getVar('tanggal_akhir') ? $this->request->getVar('tanggal_akhir') : ""
        ];

        return view('admin/pengeluaran/index', $data);
    }

    public function createPengeluaran()
    {
        $validation = [
            'tanggal' => 'required',
            'jumlah' => 'required|numeric',
            'jenis_pengeluaran' => 'required|in_list[listrik, air, internet, kebersihan, lain-lain]',
            'keterangan' => 'required'
        ];

        if($this->validate($validation)) {
            $input = [
                'tanggal' => $this->request->getVar('tanggal'),
                'jumlah' => $this->request->getVar('jumlah'),
                'jenis_pengeluaran' => $this->request->getVar('jenis_pengeluaran'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];

            if($this->pengeluarans->save($input)) {
                return redirect()->back()->with('success', 'Created Pengeluaran Successfully');
            }else {
                return redirect()->back()->with('error', 'Failed Created Pengeluaran');
            }
        }else {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }

    public function editPengeluaran($pengeluaran)
    {
        $data = [
            'validation' => $this->validation,
            'pengeluaran' => $this->pengeluarans->find($pengeluaran),
        ];

        return view('admin/pengeluaran/update', $data);
    }

    public function updatePengeluaran($pengeluaran)
    {
        $validation = [
            'tanggal' => 'required',
            'jumlah' => 'required|numeric',
            'jenis_pengeluaran' => 'required|in_list[listrik, air, internet, kebersihan, lain-lain]',
            'keterangan' => 'required'
        ];

        if($this->validate($validation)) {
            $input = [
                'tanggal' => $this->request->getVar('tanggal'),
                'jumlah' => $this->request->getVar('jumlah'),
                'jenis_pengeluaran' => $this->request->getVar('jenis_pengeluaran'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];

            if($this->pengeluarans->update($pengeluaran, $input)) {
                return redirect()->to('/admin/data-pengeluaran')->with('success', 'Created Pengeluaran Successfully');
            }else {
                return redirect()->to('/admin/data-pengeluaran')->with('error', 'Failed Created Pengeluaran');
            }
        }else {
            $validation = $this->validation;
            dd($validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }

    public function deletePengeluaran($pengeluaran)
    {

        if($this->pengeluarans->delete($pengeluaran)) {
            return redirect()->back()->with('success', 'Deleted Pengeluaran successfully');
        }else {
            return redirect()->back()->with('error', 'Failed Deleted Pengeluaran');
        }
    }

    public function download()
    {
        
        $dompdf = new DomPdf();

        $input = [
            'tanggal_awal' => $this->request->getVar('tanggal_awal'),
            'tanggal_akhir' => $this->request->getVar('tanggal_akhir')
        ];

        $pengeluarans = $input['tanggal_awal'] && $input['tanggal_akhir'] ? $this->pengeluarans->findByDate($input['tanggal_awal'], $input['tanggal_akhir']) : $this->pengeluarans;

        $data = [
            'pengeluarans' => $pengeluarans->findAll(),
            'tanggal_awal' => $this->request->getVar('tanggal_awal'),
            'tanggal_akhir' => $this->request->getVar('tanggal_akhir')
        ];

        $html = view('/admin/pengeluaran/download', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('data_pengeluaran.pdf', array(
            'Attachment' => true
        ));
    }

    /**
     * 
     * CONTROLLER MODULE DATA ORDER
     * FROM
     * SHOWING ALL DATA ORDER
     * UNTIL
     * DELETED ORDER FROM ID
     * AND
     * DATA TRANSACTIONS
     * 
     */
    public function dataOrder()
    {   
        $data = [
            'orders' => $this->orders->joinOrderTable()->orderBy('id', 'DESC')->groupBy('order.id')->paginate(5, 'orders'),
            'pager' => $this->orders->pager,
            'currentPage' => $this->request->getVar('page_orders') ? $this->request->getVar('page_orders') : 1,
            'validation' => $this->validation
        ];
        
        return view('admin/order/index', $data);
    }

    public function updateOrder($order)
    {   
        $data = [
            'order' => $this->orders->find($order),
            'validation' => $this->validation
        ];

        return view('admin/order/update', $data);
    }
    
    public function editOrder($order)
    {      
        $status_pembayaran = $this->request->getVar('status_pembayaran');
        $keterangan = $this->request->getVar('keterangan');
        $dataOrder = $this->orders->find($order);

        if($status_pembayaran == "menyicil") {
            if($this->orders->update($order, ['status_pembayaran' => $status_pembayaran, 'terakhir_pembayaran' => date('Y:m:d H:i:s', strtotime($dataOrder['terakhir_pembayaran']. '+1 month'))])) {
                return redirect()->to('/admin/data-order/')->with('success', 'Data Order Updated');
            }else {
                return redirect()->to('/admin/data-order/')->with('error', 'Failed Updated Data Order');
            }
        }else if($status_pembayaran == 'lunas') {
            if($this->orders->update($order, ['status_pembayaran' => $status_pembayaran])) {
                return redirect()->to('/admin/data-order/')->with('success', 'Data Order Updated');
            }else {
                return redirect()->to('/admin/data-order/')->with('error', 'Failed Updated Data Order');
            }
        }else {
            if($this->orders->update($order, ['status_pembayaran' => $status_pembayaran, 'keterangan' => $keterangan])) {
                $dataPembayaran = $this->pembayarans->where('id_order', $order)->orderBy('id', 'desc')->first();
                $this->pembayarans->delete($dataPembayaran['id']);
                unlink('./images/bukti_pembayaran/'.$dataPembayaran['bukti_pembayaran']);
                return redirect()->to('/admin/data-order/')->with('success', 'Data Order Updated');
            }else {
                return redirect()->to('/admin/data-order/')->with('error', 'Failed Updated Data Order');
            }
        }

    }

    public function dataTransaksi($user, $order)
    {
        $data = [
            'pembayarans' => $this->pembayarans->userTransaksi()->where(['member.id' => $user, 'order.id' => $order])->orderBy('id', 'DESC')->paginate(5, 'pembayarans'),
            'pager' => $this->pembayarans->pager,
            'currentPage' => $this->request->getVar('page_pembayarans') ? $this->request->getVar('page_pembayarans') : 1,
            'validation' => $this->validation
        ];

        return view('admin/pembayaran/index', $data);
    }

    public function dataSewa()
    {
        $data = [
            'sewas' => $this->orders->where(['status_pembayaran' => 'lunas'])->paginate(5, 'pembayarans'),
            'validation' => $this->validation
        ];
        // dd($data['sewas']);

        return view('admin/penyewaan/index', $data);
    }

    public function downloadPenyewaan()
    {
        
        $dompdf = new DomPdf();


        $pengeluarans = $this->orders->where(['status_pembayaran' => 'lunas']);

        $data = [
            'pengeluarans' => $pengeluarans->findAll()
        ];

        $html = view('/admin/penyewaan/download', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('data_penyewaan.pdf', array(
            'Attachment' => true
        ));
    }
}
