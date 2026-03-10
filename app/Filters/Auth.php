<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    /**
     * Filter untuk mengecek autentikasi dan role
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah user sudah login
        if (!$session->get('logged_in')) {
            // Simpan URL yang ingin dikunjungi
            $session->set('redirect_url', current_url());
            $session->setFlashdata('error', 'Silakan login terlebih dahulu');
            return redirect()->to('/login');
        }

        // Jika ada argumen role, cek apakah user memiliki role tersebut
        if (!empty($arguments)) {
            $role = $arguments[0] ?? null;

            if ($role && $session->get('role') !== $role) {
                $session->setFlashdata('error', 'Anda tidak memiliki akses ke halaman tersebut');

                // Redirect berdasarkan role
                $userRole = $session->get('role');

                switch ($userRole) {
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
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
