<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasswordResetModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    // Method untuk menampilkan form login (GET)
    public function login()
    {
        // Jika sudah login, redirect sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole();
        }

        // Tampilkan halaman login
        return view('auth/login');
    }

    // Method untuk memproses login (POST)
    public function processLogin()
    {
        // Jika sudah login, redirect sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole();
        }

        // Proses login
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi input
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', [
                'validation' => $this->validator
            ]);
        }

        // Cek user di database
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            $sessionData = [
                'user_id'  => $user['user_id'],
                'nama'     => $user['nama'],
                'email'    => $user['email'],
                'role'     => $user['role'],
                'nomor_hp' => $user['nomor_hp'],
                'photo'    => $user['photo'] ?? null,
                'tingkat'  => $user['tingkat'] ?? null,
                'jabatan'  => $user['jabatan'] ?? null,
                'logged_in' => true
            ];
            session()->set($sessionData);

            // Load model transaksi
            $transaksiModel = new \App\Models\TransaksiModel();

            // Cek apakah siswa sudah memiliki transaksi
            $hasTransaction = $transaksiModel->where('user_id', $user['user_id'])->countAllResults() > 0;
            // Simpan status ke session
            session()->set('has_transaction', $hasTransaction);

            // Cek jika ada redirect_url di session
            $redirectUrl = session()->get('redirect_url');
            if ($redirectUrl) {
                session()->remove('redirect_url');
                return redirect()->to($redirectUrl);
            }

            // Redirect berdasarkan role
            return $this->redirectBasedOnRole();
        } else {
            session()->setFlashdata('error', 'Email atau password salah');
            return redirect()->to('/login');
        }
    }

    // Method untuk tampilan form register (GET)
    public function register()
    {
        // Jika sudah login, redirect sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole();
        }

        // Tampilkan halaman register
        return view('auth/register');
    }

    // Method untuk proses register (POST)
    public function processRegister()
    {
        // Jika sudah login, redirect sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole();
        }

        // Siapkan data
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'password' => $this->request->getPost('password'),
            'role'     => 'siswa', // Default role siswa
            'tingkat'  => $this->request->getPost('tingkat'),
        ];

        // Validasi
        $rules = [
            'nama'             => 'required|min_length[3]|max_length[255]',
            'email'            => 'required|valid_email|is_unique[user.email]',
            'nomor_hp'         => 'required|min_length[10]|max_length[20]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'tingkat'          => 'required|in_list[SD,SMP,SMA]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        // Simpan ke database (UserModel akan otomatis hash password sesuai beforeInsert)
        $userModel = new UserModel();

        // Hapus confirm_password dari data yang akan disimpan
        unset($data['confirm_password']);

        if ($userModel->insert($data)) {
            session()->setFlashdata('success', 'Pendaftaran berhasil! Silakan login dengan akun yang telah dibuat.');
            return redirect()->to('/login');
        } else {
            // Jika ada error dari model (validasi internal)
            return view('auth/register', [
                'validation' => $userModel->errors()
            ]);
        }
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    /**
     * Redirect user berdasarkan role setelah login
     */
    private function redirectBasedOnRole()
    {
        $role = session()->get('role');

        switch ($role) {
            case 'admin':
                return redirect()->to('/dashboard/jadwal');
            case 'pengajar':
                // Jika nanti ada halaman khusus untuk pengajar
                return redirect()->to('/pengajar/dashboard');
            case 'siswa':
            default:
                return redirect()->to('/');
        }
    }

    public function forgotPassword()
    {
        return view('auth/forgotPassword');
    }

    public function processForgotPassword()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');

        // Cek apakah email terdaftar
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak terdaftar.');
        }

        // Generate token
        $resetModel = new PasswordResetModel();
        $token = $resetModel->generateToken($email);

        // Kirim email reset password
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');

        $resetLink = base_url("reset-password/$token");
        $message = "
            <h1>Reset Password</h1>
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
            <p>Silakan klik link berikut untuk reset password Anda:</p>
            <p><a href='$resetLink'>Reset Password</a></p>
            <p>Link ini akan kedaluwarsa dalam 1 jam.</p>
            <p>Jika Anda tidak meminta reset password, tidak ada tindakan lebih lanjut yang diperlukan.</p>
        ";

        $emailService->setMessage($message);

        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengirim email. Silakan coba lagi nanti.')
                ->with('debug', $emailService->printDebugger(['headers']));
        }
    }

    public function resetPassword($token)
    {
        $resetModel = new PasswordResetModel();
        $reset = $resetModel->validateToken($token);

        if (!$reset) {
            return redirect()->to('/forgot-password')->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa.');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    public function processResetPassword()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'token' => 'required',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // Validasi token
        $resetModel = new PasswordResetModel();
        $reset = $resetModel->validateToken($token);

        if (!$reset) {
            return redirect()->to('/forgot-password')->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa.');
        }

        // Update password user
        $userModel = new UserModel();
        $user = $userModel->where('email', $reset['email'])->first();

        if (!$user) {
            return redirect()->to('/forgot-password')->with('error', 'User tidak ditemukan.');
        }

        $userModel->update($user['user_id'], [
            'password' => $password
        ]);

        // Hapus token yang sudah digunakan
        $resetModel->where('token', $token)->delete();

        return redirect()->to('/login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
    }
}
