<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class AccountController extends ResourceController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function profile()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        // Tampilkan view profile dengan data user
        return view('account/profile', ['user' => $user]);
    }

    // Metode untuk menampilkan form edit profile (GET)
    public function editProfile()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        // Tampilkan form edit profile
        return view('account/editprofile', ['user' => $user]);
    }

    // Metode untuk memproses update profile (POST)
    public function updateProfile()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        // Mengambil data dari form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nomor_hp' => $this->request->getPost('nomor_hp')
        ];

        // Cek email - hanya masukkan jika berubah
        $newEmail = $this->request->getPost('email');
        if ($newEmail !== $user['email']) {
            // Email berubah, perlu validasi dan dimasukkan ke data update
            $data['email'] = $newEmail;
        }

        // Cek apakah password diubah
        $password = $this->request->getPost('password');
        if ($password && $password !== '********') {
            $data['password'] = $password;
        }

        // Penanganan upload foto
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Buat direktori jika belum ada
            if (!is_dir('uploads/profile')) {
                mkdir('uploads/profile', 0777, true);
            }

            // Generate nama file baru
            $newName = $userId . '_' . time() . '.' . $file->getExtension();

            // Pindahkan file
            $file->move('uploads/profile', $newName);

            // Simpan nama file ke database
            $data['photo'] = $newName;
        }

        // Validasi khusus untuk edit profile
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[255]',
            'nomor_hp' => 'required'
        ];

        // Validasi email hanya jika berubah
        if (isset($data['email'])) {
            $rules['email'] = 'required|valid_email|is_unique[user.email]';
        }

        // Tambahkan validasi password jika diubah
        if (isset($data['password'])) {
            $rules['password'] = 'required|min_length[8]';
        }

        if (!$this->validate($rules)) {
            return view('account/editprofile', [
                'user' => $user,
                'validation' => $this->validator
            ]);
        }

        // Update data user
        $this->userModel->skipValidation(true); // Skip validasi model untuk menghindari konflik

        if ($this->userModel->update($userId, $data)) {
            // Update data session jika berhasil
            $updatedUser = $this->userModel->find($userId);
            $sessionData = [
                'nama' => $updatedUser['nama'],
                'nomor_hp' => $updatedUser['nomor_hp'],
                'photo' => $updatedUser['photo'] ?? null
            ];

            // Update email di session hanya jika berubah
            if (isset($data['email'])) {
                $sessionData['email'] = $updatedUser['email'];
            }

            session()->set($sessionData);

            return redirect()->to('/account/profile')
                ->with('success', 'Profil berhasil diperbarui');
        } else {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil')
                ->withInput();
        }
    }
}
