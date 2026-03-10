<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'token', 'created_at', 'expired_at'];
    protected $useTimestamps = false;

    // Generate token untuk reset password
    public function generateToken($email)
    {
        // Hapus token lama untuk email ini jika ada
        $this->where('email', $email)->delete();

        // Buat token baru
        $token = bin2hex(random_bytes(32));

        // Set waktu kadaluarsa 1 jam dari sekarang
        $now = new \DateTime();
        $expired = clone $now;
        $expired->add(new \DateInterval('PT1H')); // PT1H = Period Time 1 Hour

        // Simpan token baru
        $data = [
            'email' => $email,
            'token' => $token,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'expired_at' => $expired->format('Y-m-d H:i:s')
        ];
        $this->insert($data);

        return $token;
    }

    // Validasi token
    public function validateToken($token)
    {
        $reset = $this->where('token', $token)
            ->where('expired_at >', date('Y-m-d H:i:s'))
            ->first();

        return $reset;
    }
}
