<?php

namespace App\Controllers;

use App\Models\SiswaDiterimaPtnModel;
use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{

    public function transaksi()
    {
        return view('admin/transaksi');
    }
}
