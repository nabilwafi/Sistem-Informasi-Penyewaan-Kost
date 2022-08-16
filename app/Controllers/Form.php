<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MemberModel;

class Form extends BaseController
{
    protected $validation;
    protected $adminModel;
    protected $memberModel;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->memberModel = new MemberModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'validation' => $this->validation
        ];

        return view('form/users/login', $data);
    }

    public function validationMember()
    {
        $validation = [
            'email' => 'required',
            'password' => 'required|min_length[5]'
        ];

        if(!$this->validate($validation)) {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $input = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $member = $this->memberModel->joinMemberTable()->where(['email' => $input['email'], 'password' => $input['password']])->first();
        
        if($member != NULL) {
            $selectionOrder = ($member['terakhir_pembayaran'] >= date('Y-m-d H:i:s') && $member['status_pembayaran'] == 'belum bayar' ) || ($member['tanggal_keluar'] >= date('Y-m-d')) ? true : false;
            
            $sessionData = [
                'id' => $member['id'],
                'nama' => $member['nama'],
                'email' => $member['email'],
                'handphone' => $member['handphone'],
                'alamat' => $member['alamat'],
                'isLoginedIn' => true,
                'role' => $member['role'],
                'haveOrder' => $selectionOrder
            ];

            session()->set($sessionData);

            return redirect()->to('/');
        }else {
            return redirect()->back()->with('error', 'There\'s no account in database, please register first');
        }
    }

    public function register()
    {
        $data = [
            'validation' => $this->validation
        ];

        return view('form/users/register', $data);
    }

    public function createMember()
    {
        $validation = [
            'nama' => 'required|min_length[5]',
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

        $this->memberModel->save([
            'nama' => $input['nama'],
            'email' => $input['email'],
            'password' => $input['password'],
            'handphone' => $input['handphone'],
            'alamat' => $input['alamat'],
            'role' => $input['role']
        ]);

        return redirect()->to('/login')->with('success', 'You have create account, please login first');
    }

    public function indexAdmin()
    {
        $data = [
            'validation' => $this->validation,
        ];

        return view('form/admin/login', $data);
    }

    public function validationAdmin()
    {
        $validation = [
            'email' => 'required',
            'password' => 'required|min_length[5]'
        ];

        if(!$this->validate($validation)) {
            $validation = $this->validation;
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $input = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $admin = $this->adminModel->where(['email' => $input['email'], 'password' => $input['password']])->first();

        if($admin) {
            $sessionData = [
                'id' => $admin['id'],
                'email' => $admin['email'],
                'isLoginedIn' => true,
                'role' => $admin['role']
            ];
    
            session()->set($sessionData);

            return redirect()->to('/admin');
        }else {
            return redirect()->back()->with('error', 'You are not Admin');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
