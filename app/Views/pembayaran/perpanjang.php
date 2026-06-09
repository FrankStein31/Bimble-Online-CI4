<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4ff;
    min-height: 100vh;
}
/* Hero */
.hero-greeting {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    padding: 40px 20px 80px;
    text-align: center; color: white; position: relative; overflow: hidden;
}
.hero-greeting::before {
    content: ''; position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.hero-greeting .inner { position: relative; max-width: 700px; margin: 0 auto; }
.hero-greeting h1 { font-size: 1.9rem; font-weight: 700; margin-bottom: 6px; }
.hero-greeting p  { font-size: 1rem; opacity: .85; }
/* Form area */
.form-area { max-width: 500px; margin: -40px auto 60px; padding: 0 16px; position: relative; z-index: 10; }
.form-card { background: white; border-radius: 18px; box-shadow: 0 6px 28px rgba(0,0,0,.1); overflow: hidden; border: 1px solid #e2e8f0; }
.form-card-head { background: linear-gradient(135deg,#10b981,#059669); padding: 18px 24px; color: white; }
.form-card-head h3 { font-size: 1rem; font-weight: 700; margin: 0; }
.form-card-head p  { font-size: .78rem; opacity: .85; margin: 4px 0 0; }
.form-card-body { padding: 24px; }
/* Inputs */
.field-label { font-size: .75rem; font-weight: 600; color: #718096; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 5px; }
.f-input { width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: .9rem; color: #2d3748; background: white; transition: border-color .2s; outline: none; font-family: inherit; box-sizing: border-box; }
.f-input[readonly] { background: #f8fafc; color: #718096; }
.f-input[readonly].filled { background: #f0fdf4; color: #166534; font-weight: 700; border-color: #86efac; }
.form-group { margin-bottom: 16px; }
/* Bank info */
.bank-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 14px 16px; margin-bottom: 16px; }
.bank-box .bank-title { font-size: .78rem; font-weight: 700; color: #1d4ed8; margin-bottom: 6px; }
.bank-item { font-size: .85rem; color: #1e40af; margin-top: 4px; }
/* Payment method toggle */
.method-toggle {
    display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px;
}
.method-card {
    border: 2px solid #e2e8f0; border-radius: 12px; padding: 14px 12px; cursor: pointer; text-align: center; transition: all .2s; background: white; position: relative;
}
.method-card:hover { border-color: #10b981; background: #ecfdf5; }
.method-card.active { border-color: #10b981; background: #ecfdf5; box-shadow: 0 0 0 3px rgba(16,185,129,.15); }
.method-card .m-icon { font-size: 1.8rem; display: block; margin-bottom: 6px; }
.method-card .m-label { font-size: .82rem; font-weight: 700; color: #2d3748; }
.method-card .m-desc  { font-size: .72rem; color: #718096; margin-top: 3px; }
.method-card .m-check { position: absolute; top: 8px; right: 8px; width: 18px; height: 18px; border-radius: 50%; background: #10b981; color: white; font-size: .65rem; display: none; align-items: center; justify-content: center; }
.method-card.active .m-check { display: flex; }
.midtrans-badge { background: linear-gradient(135deg,#0891b2,#0e7490); color: white; border-radius: 20px; padding: 2px 10px; font-size: .65rem; font-weight: 700; letter-spacing: .5px; display: inline-block; margin-top: 4px; }
.pay-panel { display: none; }
.pay-panel.visible { display: block; }
/* File drop */
.file-drop { border: 2px dashed #c7d2fe; border-radius: 10px; padding: 24px 16px; text-align: center; cursor: pointer; transition: all .2s; margin-bottom: 16px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px; background: white; }
.file-drop:hover { border-color: #10b981; background: #ecfdf5; }
.file-drop.has-file { border-color: #10b981; background: #ecfdf5; }
.file-drop .drop-icon { font-size: 2rem; line-height: 1; }
.file-drop .drop-text { font-size: .85rem; color: #718096; font-weight: 500; }
.btn-primary { width: 100%; padding: 13px; border: none; border-radius: 10px; background: linear-gradient(135deg,#10b981,#059669); color: white; font-size: .92rem; font-weight: 700; cursor: pointer; transition: all .2s; }
.btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(16,185,129,.4); }
.alert { padding: 10px 14px; border-radius: 8px; margin-bottom: 14px; font-size: .875rem; font-weight: 500; }
.alert-danger  { background: #fee2e2; color: #7f1d1d; border-left: 3px solid #ef4444; }
.alert-success { background: #d1fae5; color: #065f46; border-left: 3px solid #10b981; }
.info-note { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 12px 14px; margin-bottom: 16px; font-size: .82rem; color: #166534; line-height: 1.5; }
</style>

<!-- Hero -->
<div class="hero-greeting">
    <div class="inner">
        <h1>🔄 Perpanjang Paket</h1>
        <p>Lanjutkan belajarmu dengan program yang sudah ada tanpa harus daftar ulang.</p>
    </div>
</div>

<div class="form-area">
    <div class="form-card">
        <div class="form-card-head">
            <h3>💳 Detail Perpanjangan</h3>
            <p>Jadwal dan pengajarmu akan otomatis dilanjutkan.</p>
        </div>
        <div class="form-card-body">

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">❌ <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php 
                $progLama = $program[0] ?? []; 
                $tagihanAsli = $progLama['harga'] ?? 0;
            ?>

            <div class="form-group">
                <div class="field-label">Program yang Diperpanjang</div>
                <input type="text" class="f-input" value="<?= esc($transaksiLama['nama_program']) ?> — Kelas <?= esc($transaksiLama['kelas']) ?>" readonly>
            </div>
            <div class="form-group">
                <div class="field-label">Tagihan Perpanjangan</div>
                <input type="text" class="f-input filled" value="Rp <?= number_format($tagihanAsli, 0, ',', '.') ?>" readonly>
            </div>

            <div class="info-note">
                👨‍🏫 <strong>Pengajar & Jadwal:</strong> Tetap sama seperti sebelumnya.
            </div>

            <!-- ── Payment Method Toggle ── -->
            <div class="field-label" style="margin-bottom:8px;">Pilih Metode Pembayaran</div>
            <div class="method-toggle">
                <div class="method-card active" id="method-manual" onclick="selectMethod('manual')">
                    <span class="m-check">✓</span>
                    <span class="m-icon">🏦</span>
                    <div class="m-label">Transfer Manual</div>
                    <div class="m-desc">Upload bukti transfer</div>
                </div>
                <div class="method-card" id="method-midtrans" onclick="selectMethod('midtrans')">
                    <span class="m-check">✓</span>
                    <span class="m-icon">⚡</span>
                    <div class="m-label">Bayar Sekarang</div>
                    <div class="m-desc">Langsung aktif</div>
                    <span class="midtrans-badge">Midtrans</span>
                </div>
            </div>

            <!-- ── Panel: Manual ── -->
            <div class="pay-panel visible" id="panel-manual">
                <form action="<?= base_url('registrasi-pembayaran/perpanjang-submit') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="transaksi_lama_id" value="<?= $transaksiLama['transaksi_id'] ?>">
                    <input type="hidden" name="tagihan" value="<?= $tagihanAsli ?>">

                    <?php if (!empty($rekening)): ?>
                    <div class="bank-box">
                        <div class="bank-title">💳 Transfer ke rekening berikut:</div>
                        <?php foreach ($rekening as $rek): ?>
                            <div class="bank-item">
                                <?= esc($rek['bank']) ?> — <strong><?= esc($rek['no_rek']) ?></strong> a.n. <?= esc($rek['nama']) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <input type="file" name="photo_bukti" id="bukti_pembayaran"
                        style="position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;"
                        accept="image/*" required>
                    <label for="bukti_pembayaran" class="file-drop" id="file-drop-label">
                        <span class="drop-icon">📷</span>
                        <span class="drop-text" id="file-name">Klik atau seret untuk upload bukti transfer</span>
                    </label>

                    <button type="submit" class="btn-primary">✅ Konfirmasi Perpanjangan</button>
                    <a href="<?= base_url('registrasi-pembayaran/history') ?>" style="display:block; text-align:center; font-size:.85rem; color:#718096; margin-top:16px; text-decoration:none;">Batal</a>
                </form>
            </div>

            <!-- ── Panel: Midtrans ── -->
            <div class="pay-panel" id="panel-midtrans">
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:14px 16px;margin-bottom:16px;font-size:.85rem;color:#1e40af;line-height:1.6;">
                    ⚡ <strong>Bayar Langsung via Midtrans</strong><br>
                    <span style="color:#065f46;font-weight:600;">✅ Pembayaran berhasil → paket otomatis diperpanjang!</span>
                </div>
                <button type="button" class="btn-primary" id="btn-bayar-midtrans" onclick="bayarMidtrans()">
                    ⚡ Bayar Sekarang
                </button>
                <a href="<?= base_url('registrasi-pembayaran/history') ?>" style="display:block; text-align:center; font-size:.85rem; color:#718096; margin-top:16px; text-decoration:none;">Batal</a>
            </div>

        </div>
    </div>
</div>

<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-CGmzPqJNEWcIRSj7"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // File drop
    const fileInput = document.getElementById('bukti_pembayaran');
    const fileName  = document.getElementById('file-name');
    const fileDrop  = document.getElementById('file-drop-label');

    function applyFile(file) {
        if (!file) return;
        fileName.textContent = '✅ ' + file.name;
        fileDrop.classList.add('has-file');
    }
    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) applyFile(fileInput.files[0]);
        else { fileName.textContent = 'Klik atau seret untuk upload bukti transfer'; fileDrop.classList.remove('has-file'); }
    });
    fileDrop.addEventListener('dragover',  e => { e.preventDefault(); fileDrop.style.borderColor='#10b981'; });
    fileDrop.addEventListener('dragleave', ()  => { fileDrop.style.borderColor=''; });
    fileDrop.addEventListener('drop', function (e) {
        e.preventDefault(); fileDrop.style.borderColor='';
        if (e.dataTransfer.files.length > 0) {
            const dt = new DataTransfer();
            dt.items.add(e.dataTransfer.files[0]);
            fileInput.files = dt.files;
            applyFile(e.dataTransfer.files[0]);
        }
    });
});

function selectMethod(method) {
    document.getElementById('method-manual').classList.toggle('active',   method === 'manual');
    document.getElementById('method-midtrans').classList.toggle('active', method === 'midtrans');
    document.getElementById('panel-manual').classList.toggle('visible',   method === 'manual');
    document.getElementById('panel-midtrans').classList.toggle('visible', method === 'midtrans');
}

function bayarMidtrans() {
    const programId = "<?= $transaksiLama['program_id'] ?>";
    const tagihan   = "<?= $tagihanAsli ?>";
    const lamaId    = "<?= $transaksiLama['transaksi_id'] ?>";

    const btn = document.getElementById('btn-bayar-midtrans');
    btn.disabled    = true;
    btn.textContent = '⏳ Memproses...';

    const formData = new FormData();
    formData.append('program_id', programId);
    formData.append('tagihan', tagihan);
    formData.append('transaksi_lama_id', lamaId);
    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

    fetch('<?= base_url('midtrans/token') ?>', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData,
    })
    .then(r => r.json())
    .then(data => {
        btn.disabled    = false;
        btn.textContent = '⚡ Bayar Sekarang';

        if (data.error) {
            alert('❌ ' + data.error);
            return;
        }

        // Open Midtrans Snap popup
        snap.pay(data.token, {
            onSuccess: function (result) {
                fetch('<?= base_url('midtrans/finish') ?>', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        transaksi_id: data.transaksi_id,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                    }),
                }).then(() => {
                    window.location.href = '<?= base_url('/registrasi-pembayaran/paket-aktif') ?>?midtrans=success';
                }).catch(() => {
                    window.location.href = '<?= base_url('/registrasi-pembayaran/paket-aktif') ?>?midtrans=success';
                });
            },
            onPending: function (result) {
                window.location.href = '<?= base_url('/registrasi-pembayaran/paket-aktif') ?>?midtrans=pending';
            },
            onError: function (result) {
                alert('❌ Pembayaran gagal. Silakan coba lagi.');
            },
            onClose: function () {
                fetch('<?= base_url('midtrans/cancel') ?>', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ transaksi_id: data.transaksi_id, '<?= csrf_token() ?>': '<?= csrf_hash() ?>' }),
                });
            },
        });
    })
    .catch(() => {
        btn.disabled    = false;
        btn.textContent = '⚡ Bayar Sekarang';
        alert('❌ Terjadi kesalahan. Silakan coba lagi.');
    });
}
</script>
<?= $this->endSection() ?>
