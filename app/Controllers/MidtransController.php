<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\ProgramBimbelModel;
use App\Models\KelasBimbelModel;
use App\Models\JadwalModel;
use CodeIgniter\Controller;

/**
 * MidtransController
 *
 * Handles:
 *  - POST /midtrans/token      → Create Snap transaction token (called via AJAX)
 *  - POST /midtrans/notify     → Webhook from Midtrans server (payment notification)
 */
class MidtransController extends Controller
{
    // ── Sandbox credentials ────────────────────────────────────────────
    private const SERVER_KEY = 'SB-Mid-server-MNo3xTYokgclNykKFrjUtVDg';
    private const CLIENT_KEY = 'SB-Mid-client-CGmzPqJNEWcIRSj7';
    private const SNAP_URL   = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    // ───────────────────────────────────────────────────────────────────

    protected TransaksiModel    $transaksiModel;
    protected ProgramBimbelModel $programModel;
    protected KelasBimbelModel  $kelasModel;
    protected JadwalModel       $jadwalModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->programModel   = new ProgramBimbelModel();
        $this->kelasModel     = new KelasBimbelModel();
        $this->jadwalModel    = new JadwalModel();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 1. Create Snap Token (AJAX endpoint, called from registrasipembayaran.php)
    // ─────────────────────────────────────────────────────────────────────────
    public function token()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Forbidden']);
        }

        $userId    = session()->get('user_id');
        $programId = (int) $this->request->getPost('program_id');
        $tagihan   = (int) $this->request->getPost('tagihan');

        if (!$userId || !$programId || !$tagihan) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap.']);
        }

        // Cek sudah terdaftar
        $existing = $this->transaksiModel
            ->where('user_id', $userId)
            ->where('program_id', $programId)
            ->whereIn('status', ['pending', 'lunas'])
            ->first();

        if ($existing) {
            return $this->response->setJSON(['error' => 'Anda sudah terdaftar di program ini.']);
        }

        $program = $this->programModel->find($programId);
        if (!$program) {
            return $this->response->setJSON(['error' => 'Program tidak ditemukan.']);
        }

        // Simpan transaksi sementara dengan status = pending & metode = midtrans
        $orderId = 'BIMBEL-' . $userId . '-' . $programId . '-' . time();

        $transaksiId = $this->transaksiModel->insert([
            'user_id'           => $userId,
            'program_id'        => $programId,
            'jadwal_id'         => null,
            'tagihan'           => $tagihan,
            'photo_bukti'       => null,
            'status'            => 'pending',
            'metode_bayar'      => 'midtrans',
            'midtrans_order_id' => $orderId,
        ], true); // true = return insert ID

        // Build Snap payload
        $user = session()->get(); // has nama, email, nomor_hp

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $tagihan,
            ],
            'customer_details' => [
                'first_name' => $user['nama']     ?? 'Siswa',
                'email'      => $user['email']    ?? '',
                'phone'      => $user['nomor_hp'] ?? '',
            ],
            'item_details' => [[
                'id'       => 'PROG-' . $programId,
                'price'    => $tagihan,
                'quantity' => 1,
                'name'     => $program['nama_program'] . ' (Kelas ' . $program['kelas'] . ')',
            ]],
        ];

        $response = $this->snapRequest($payload);

        if (isset($response['token'])) {
            return $this->response->setJSON([
                'token'       => $response['token'],
                'transaksi_id' => $transaksiId,
            ]);
        }

        // Rollback jika Midtrans gagal
        $this->transaksiModel->delete($transaksiId);

        $errMsg = $response['error_messages'][0] ?? 'Gagal menghubungi Midtrans.';
        return $this->response->setJSON(['error' => $errMsg]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 2. Midtrans Server-to-Server Notification (Webhook)
    // ─────────────────────────────────────────────────────────────────────────
    public function notify()
    {
        $raw  = $this->request->getBody();
        $data = json_decode($raw, true);

        if (empty($data['order_id'])) {
            return $this->response->setStatusCode(400)->setBody('Bad Request');
        }

        $orderId           = $data['order_id'];
        $statusCode        = $data['status_code']        ?? '';
        $grossAmount       = $data['gross_amount']        ?? '0';
        $signatureKeyInput = $data['signature_key']       ?? '';
        $transactionStatus = $data['transaction_status']  ?? '';
        $fraudStatus       = $data['fraud_status']        ?? '';

        // Verify signature
        $expectedSig = hash('sha512', $orderId . $statusCode . $grossAmount . self::SERVER_KEY);
        if ($signatureKeyInput !== $expectedSig) {
            log_message('error', 'Midtrans: signature mismatch for order ' . $orderId);
            return $this->response->setStatusCode(403)->setBody('Invalid signature');
        }

        // Find transaksi
        $transaksi = $this->transaksiModel
            ->where('midtrans_order_id', $orderId)
            ->first();

        if (!$transaksi) {
            log_message('error', 'Midtrans: order not found: ' . $orderId);
            return $this->response->setStatusCode(404)->setBody('Not found');
        }

        $transaksiId = (int) $transaksi['transaksi_id'];

        // Only process if not already lunas
        if ($transaksi['status'] === 'lunas') {
            return $this->response->setBody('OK');
        }

        if (
            $transactionStatus === 'capture' && $fraudStatus === 'accept' ||
            $transactionStatus === 'settlement'
        ) {
            // ✅ Payment success → set lunas + assign guru
            $this->transaksiModel->update($transaksiId, ['status' => 'lunas']);
            $this->assignGuru($transaksiId);

        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            // ❌ Payment failed
            $this->transaksiModel->update($transaksiId, ['status' => 'ditolak']);
        }

        return $this->response->setBody('OK');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 3. Finish — called from onSuccess JS callback (for localhost / no webhook)
    //    Sets status = lunas and runs assignGuru directly from browser request.
    // ─────────────────────────────────────────────────────────────────────────
    public function finish()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Forbidden']);
        }

        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthenticated']);
        }

        $body        = json_decode($this->request->getBody(), true);
        $transaksiId = (int) ($body['transaksi_id'] ?? 0);

        if (!$transaksiId) {
            return $this->response->setJSON(['error' => 'ID tidak valid.']);
        }

        $transaksi = $this->transaksiModel->find($transaksiId);

        // Security: only allow the owner to confirm their own payment
        if (!$transaksi || (int) $transaksi['user_id'] !== (int) $userId) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Akses ditolak.']);
        }

        // Already processed
        if ($transaksi['status'] === 'lunas') {
            return $this->response->setJSON(['ok' => true, 'msg' => 'Already lunas']);
        }

        // Set lunas + assign guru
        $this->transaksiModel->update($transaksiId, ['status' => 'lunas']);
        $this->assignGuru($transaksiId);

        return $this->response->setJSON(['ok' => true]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 4. Cancel — called when user closes Snap popup without paying
    // ─────────────────────────────────────────────────────────────────────────
    public function cancel()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Forbidden']);
        }

        $body        = json_decode($this->request->getBody(), true);
        $transaksiId = (int) ($body['transaksi_id'] ?? 0);

        if ($transaksiId) {
            $transaksi = $this->transaksiModel->find($transaksiId);
            // Only delete if still pending (not paid yet)
            if ($transaksi && $transaksi['status'] === 'pending' && $transaksi['metode_bayar'] === 'midtrans') {
                $this->transaksiModel->delete($transaksiId);
            }
        }

        return $this->response->setJSON(['ok' => true]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private: Auto-assign guru (same logic as TransaksiController::assignGuru)
    // ─────────────────────────────────────────────────────────────────────────
    private function assignGuru(int $transaksiId): void
    {
        $transaksi = $this->transaksiModel->find($transaksiId);
        if (!$transaksi || $transaksi['kelas_id']) return;

        $program = $this->programModel->find($transaksi['program_id']);
        if (!$program) return;

        $tingkat   = $program['tingkat'];
        $programId = (int) $transaksi['program_id'];

        $jadwalId = $transaksi['jadwal_id'] ? (int) $transaksi['jadwal_id'] : null;
        if (!$jadwalId) {
            $db = \Config\Database::connect();
            $pj = $db->table('program_jadwal')
                ->where('program_id', $programId)
                ->orderBy('urutan', 'ASC')
                ->get()->getRowArray();
            if ($pj) {
                $jadwalId = (int) $pj['jadwal_id'];
                $this->transaksiModel->update($transaksiId, ['jadwal_id' => $jadwalId]);
            }
        }

        if (!$jadwalId) return;

        $kelasId = $this->kelasModel->getOrCreateKelas($programId, $jadwalId, $tingkat);
        if (!$kelasId) return;

        $kelas = $this->kelasModel->find($kelasId);

        $this->transaksiModel->update($transaksiId, [
            'kelas_id'    => $kelasId,
            'pengajar_id' => $kelas['pengajar_id'],
        ]);

        $this->kelasModel->tambahTerisi($kelasId);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private: HTTP call to Midtrans Snap API
    // ─────────────────────────────────────────────────────────────────────────
    private function snapRequest(array $payload): array
    {
        $ch = curl_init(self::SNAP_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode(self::SERVER_KEY . ':'),
            ],
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $result = curl_exec($ch);
        $error  = curl_error($ch);
        curl_close($ch);

        if ($error) {
            log_message('error', 'Midtrans cURL error: ' . $error);
            return ['error_messages' => ['Koneksi ke Midtrans gagal: ' . $error]];
        }

        return json_decode($result, true) ?? ['error_messages' => ['Response tidak valid dari Midtrans.']];
    }
}
