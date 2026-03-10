<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['user'] = $this->userModel->findAll();
        return view('admin/user', $data);
    }

    public function add()
    {
        $data = [
            'nama'         => $this->request->getPost('name'),
            'nomor_hp'     => $this->request->getPost('nomor_hp'),
            'email'        => $this->request->getPost('email'),
            'role'         => $this->request->getPost('role'),
            'password'     => $this->request->getPost('password'),
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/dashboard/user')
                ->with('success', 'User berhasil ditambahkan.');
        } else {
            return redirect()->to('/dashboard/user')
                ->with('error', 'Terjadi kesalahan saat menambahkan user.');
        }
        return view('admin/user');
    }

    public function edit($id = null)
    {
        $data = [
            'nama'         => $this->request->getPost('name'),
            'nomor_hp'     => $this->request->getPost('nomor_hp'),
            'email'        => $this->request->getPost('email'),
            'role'         => $this->request->getPost('role'),
        ];
        // Cek apakah password diubah
        $password = $this->request->getPost('password');
        if ($password && $password !== '********') {
            $data['password'] = $password;
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/dashboard/user')
                ->with('success', 'User berhasil diperbarui.');
        } else {
            return redirect()->to('/dashboard/jadwal')
                ->with('error', 'Terjadi kesalahan saat memperbarui user.');
        }
        return redirect()->to('/dashboard/user');
    }

    public function delete($id = null)
    {
        if ($this->userModel->delete($id)) {
            return redirect()->to('/dashboard/user')
                ->with('success', 'User berhasil dihapus.');
        } else {
            return redirect()->to('/dashboard/user')
                ->with('error', 'Terjadi kesalahan saat menghapus user.');
        }
        return redirect()->to('/dashboard/user');
    }
}
