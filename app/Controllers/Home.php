<?php

namespace App\Controllers;

use App\Models\KamarModel;

class Home extends BaseController
{
    protected $kamars;
    public function __construct()
    {
        $this->kamars = new KamarModel();
    }

    public function index()
    {
        return view('frontend/index');
    }

    public function seputar_kost()
    {
        $data = [
            'kamars' => $this->kamars->findAll()
        ];

        return view('frontend/seputar_kost', $data);
    }
}
