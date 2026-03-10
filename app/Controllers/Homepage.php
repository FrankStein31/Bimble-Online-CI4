<?php

namespace App\Controllers;

use App\Models\ProgramBimbelModel;
use App\Models\SiswaDiterimaPtnModel;
use App\Models\JadwalModel;

class Homepage extends BaseController
{

    protected $programModel;
    protected $siswaDiterima;
    protected $jadwalModel;

    public function __construct()
    {
        $this->programModel = new ProgramBimbelModel();
        $this->siswaDiterima = new SiswaDiterimaPtnModel();
        $this->jadwalModel = new JadwalModel();
    }

    public function index(): string
    {
        $data['program'] = $this->programModel->findAll();
        $data['siswa'] = $this->siswaDiterima->findAll();
        return view('home', $data);
    }
    public function jadwal(): string
    {
        $data['jadwal'] = $this->jadwalModel->findAll();
        return view('jadwal', $data);
    }
}
