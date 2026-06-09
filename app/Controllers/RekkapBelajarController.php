<?php

namespace App\Controllers;

use App\Models\HasilBelajarModel;

class RekkapBelajarController extends BaseController
{
    public function index()
    {
        $siswaId         = session()->get('user_id');
        $hasilBelajarModel = new HasilBelajarModel();
        
        // Get filter parameters from request
        $programId = $this->request->getGet('program_id');
        $pengajarId = $this->request->getGet('pengajar_id');
        
        // Build filter array
        $filters = [];
        if (!empty($programId)) {
            $filters['program_id'] = $programId;
        }
        if (!empty($pengajarId)) {
            $filters['pengajar_id'] = $pengajarId;
        }
        
        // Get data with filters
        $hasil = !empty($filters) 
            ? $hasilBelajarModel->getBySiswaWithFilter($siswaId, $filters)
            : $hasilBelajarModel->getBySiswa($siswaId);

        // Get filter options
        $programs = $hasilBelajarModel->getProgramBySiswa($siswaId);
        $pengajars = $hasilBelajarModel->getPengajarBySiswa($siswaId);

        return view('pembayaran/rekap_belajar', [
            'hasil' => $hasil,
            'programs' => $programs,
            'pengajars' => $pengajars,
            'selectedProgram' => $programId,
            'selectedPengajar' => $pengajarId,
        ]);
    }
}
