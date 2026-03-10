<?php

namespace App\Controllers;

use App\Models\HasilBelajarModel;

class RekkapBelajarController extends BaseController
{
    public function index()
    {
        $siswaId         = session()->get('user_id');
        $hasilBelajarModel = new HasilBelajarModel();
        $hasil           = $hasilBelajarModel->getBySiswa($siswaId);

        return view('pembayaran/rekap_belajar', ['hasil' => $hasil]);
    }
}
