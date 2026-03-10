<?php

namespace App\Controllers;

use App\Models\NoRekeningModel;
use CodeIgniter\RESTful\ResourceController;

class RekeningController extends ResourceController
{
    protected $noRekening;
    public function __construct()
    {
        $this->noRekening = new NoRekeningModel();
    }

    public function index()
    {
        $data['rekening'] = $this->noRekening->findAll();
        return view('admin/rekening', $data);
    }
    public function create()
    {
        $data = [
            'bank' => $this->request->getPost('bank'),
            'no_rek' => $this->request->getPost('no_rek'),
            'nama' => $this->request->getPost('nama'),
        ];


        if ($this->noRekening->insert($data)) {
            return redirect()->to('/dashboard/rekening');
        } else {
            return redirect()->to('/dashboard/rekening')
                ->with('error', 'Terjadi kesalahan saat menambahkan rekening.');
        }
        return view('/dashboard/rekening');
    }

    public function edit($id = null)
    {
        $data = [
            'bank' => $this->request->getPost('bank'),
            'no_rek' => $this->request->getPost('no_rek'),
            'nama' => $this->request->getPost('nama'),
        ];
        if ($this->noRekening->update($id, $data)) {
            return redirect()->to('/dashboard/rekening')
                ->with('success', 'Rekening berhasil diperbarui.');
        } else {
            return redirect()->to('/dashboard/rekening')
                ->with('error', 'Terjadi kesalahan saat memperbarui rekening.');
        }
        return view('/dashboard/rekening');
    }

    public function delete($id = null)
    {
        $this->noRekening->delete($id);
        return redirect()->to('/dashboard/rekening')
            ->with('success', 'Rekening berhasil dihapus.');
    }
}
