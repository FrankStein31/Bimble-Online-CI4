<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4ff;
    min-height: 100vh;
}

/* ── Hero greeting ── */
.hero-greeting {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 20px 80px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}
.hero-greeting::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.hero-greeting .inner { position: relative; max-width: 700px; margin: 0 auto; }
.hero-greeting h1 { font-size: 1.9rem; font-weight: 700; margin-bottom: 6px; }
.hero-greeting p  { font-size: 1rem; opacity: .85; }
.jenjang-pill {
    display: inline-block;
    background: rgba(255,255,255,.2);
    border: 1px solid rgba(255,255,255,.35);
    border-radius: 30px;
    padding: 4px 14px;
    font-size: .8rem;
    font-weight: 600;
    letter-spacing: .5px;
    margin-top: 10px;
}

/* ── Quick-action tabs ── */
.page-tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: -28px auto 0;
    position: relative;
    z-index: 10;
    max-width: 600px;
    padding: 0 16px;
}
.page-tab {
    flex: 1;
    padding: 12px 8px;
    border-radius: 12px;
    background: white;
    box-shadow: 0 4px 20px rgba(0,0,0,.12);
    text-align: center;
    text-decoration: none;
    color: #4a5568;
    font-size: .78rem;
    font-weight: 600;
    transition: all .25s;
    border: 2px solid transparent;
}
.page-tab:hover, .page-tab.active {
    border-color: #667eea;
    color: #667eea;
    box-shadow: 0 6px 24px rgba(102,126,234,.2);
    transform: translateY(-2px);
}
.page-tab .tab-icon { font-size: 1.3rem; display: block; margin-bottom: 3px; }

/* ── Main content ── */
.main-content { max-width: 800px; margin: 0 auto; padding: 36px 16px 60px; }

/* ── Flash ── */
.flash-msg { border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; font-weight: 500; font-size: .9rem; }
.flash-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
.flash-error   { background: #fee2e2; color: #7f1d1d; border-left: 4px solid #ef4444; }

/* ── Section title ── */
.section-title { font-size: 1.1rem; font-weight: 700; color: #2d3748; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }

/* ── Paket card ── */
.paket-card {
    background: white;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,.08);
    margin-bottom: 24px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    transition: transform .25s, box-shadow .25s;
}
.paket-card:hover { transform: translateY(-3px); box-shadow: 0 8px 32px rgba(0,0,0,.12); }
.paket-card-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    padding: 18px 22px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
}
.paket-card-header .nama { font-size: 1.1rem; font-weight: 700; line-height: 1.3; }
.paket-card-header .kelas-pill {
    background: rgba(255,255,255,.2);
    border: 1px solid rgba(255,255,255,.35);
    border-radius: 20px;
    padding: 3px 12px;
    font-size: .75rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
}
.paket-card-body { padding: 20px 22px; }

/* ── Info grid ── */
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; }
@media (max-width: 500px) { .info-grid { grid-template-columns: 1fr; } }
.info-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 11px 13px;
    background: #f8fafc;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
}
.info-item .icon { font-size: 1.1rem; flex-shrink: 0; margin-top: 1px; }
.info-item .label { font-size: .68rem; color: #a0aec0; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
.info-item .value { font-size: .88rem; font-weight: 600; color: #2d3748; margin-top: 1px; }
.info-item .value.muted { color: #b7791f; font-style: italic; font-weight: 400; }
.info-item .value.green { color: #2f855a; }

/* ── Jadwal strips ── */
.jadwal-section { margin-bottom: 16px; }
.jadwal-section .sub-label { font-size: .7rem; color: #718096; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 8px; }
.jadwal-strips { display: flex; gap: 8px; flex-wrap: wrap; }
.jadwal-strip {
    display: flex; align-items: center; gap: 6px;
    background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 8px;
    padding: 7px 12px; font-size: .82rem; color: #3730a3; font-weight: 600;
}
.jadwal-strip .dot { width: 8px; height: 8px; border-radius: 50%; background: #667eea; flex-shrink: 0; }

/* ── Status bar ── */
.status-bar {
    display: flex; align-items: center; justify-content: space-between;
    gap: 10px; padding-top: 14px; border-top: 1px solid #e2e8f0; flex-wrap: wrap;
}
.status-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 14px; border-radius: 20px; font-size: .78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px;
}
.pill-lunas   { background: #d1fae5; color: #065f46; }
.pill-pending { background: #fef3c7; color: #92400e; }
.pill-ditolak { background: #fee2e2; color: #7f1d1d; }
.btn-detail {
    text-decoration: none; font-size: .82rem; font-weight: 600; color: #667eea;
    padding: 6px 14px; border: 1.5px solid #667eea; border-radius: 8px; transition: all .2s;
}
.btn-detail:hover { background: #667eea; color: white; }

/* ── Empty state ── */
.empty-state { text-align: center; padding: 60px 24px; background: white; border-radius: 18px; box-shadow: 0 4px 20px rgba(0,0,0,.06); border: 2px dashed #c7d2fe; }
.empty-state .emoji { font-size: 4rem; display: block; margin-bottom: 16px; }
.empty-state h3 { font-size: 1.2rem; color: #2d3748; margin-bottom: 10px; }
.empty-state p  { color: #718096; font-size: .92rem; margin-bottom: 24px; line-height: 1.6; }
.btn-daftar {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white; text-decoration: none; padding: 13px 28px; border-radius: 12px;
    font-weight: 700; font-size: .95rem; box-shadow: 0 4px 15px rgba(102,126,234,.4);
    transition: all .25s;
}
.btn-daftar:hover { transform: translateY(-2px); box-shadow: 0 6px 22px rgba(102,126,234,.5); }

/* ── Pending banner ── */
.pending-banner {
    background: linear-gradient(135deg, #fffbeb, #fef3c7);
    border: 1px solid #fde68a; border-radius: 12px; padding: 14px 18px;
    display: flex; align-items: flex-start; gap: 10px;
    margin-bottom: 20px; font-size: .875rem; color: #78350f;
}
.pending-banner .icon { font-size: 1.3rem; flex-shrink: 0; }

/* OLD classes kept for compat – hidden */
.paket-aktif, .course-card, .no-package { display: none !important; }
</style>

<!-- Hero -->
<div class="hero-greeting">
    <div class="inner">
        <h1>👋 Halo, <?= esc(session()->get('nama') ?? 'Siswa') ?>!</h1>
        <p>Selamat datang di portal belajar Bimbel Harapan. Semangat belajarnya! 📚</p>
        <?php if (session()->get('tingkat')): ?>
            <span class="jenjang-pill">🎓 Jenjang <?= session()->get('tingkat') ?></span>
        <?php endif; ?>
    </div>
</div>

<!-- Tabs -->
<div class="page-tabs">
    <a href="<?= base_url('/registrasi-pembayaran/paket-aktif') ?>" class="page-tab active">
        <span class="tab-icon">📚</span>Paket Aktif
    </a>
    <a href="<?= base_url('/registrasi-pembayaran') ?>" class="page-tab">
        <span class="tab-icon">➕</span>Daftar Baru
    </a>
    <a href="<?= base_url('/registrasi-pembayaran/history') ?>" class="page-tab">
        <span class="tab-icon">📋</span>Riwayat
    </a>
    <a href="<?= base_url('account/profile') ?>" class="page-tab">
        <span class="tab-icon">👤</span>Akun
    </a>
</div>

<div class="main-content">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-msg flash-success">✅ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-msg flash-error">❌ <?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php
        $hasPending = false;
        foreach ($transaksi as $p) { if ($p['status'] === 'pending') { $hasPending = true; break; } }
    ?>

    <?php if ($hasPending): ?>
        <div class="pending-banner">
            <span class="icon">⏳</span>
            <div><strong>Menunggu Konfirmasi</strong><br>Ada pembayaran yang sedang dalam proses verifikasi. Admin akan mengkonfirmasi dan mengassign pengajar untuk Anda segera.</div>
        </div>
    <?php endif; ?>

    <?php if (empty($transaksi)): ?>
        <div class="empty-state">
            <span class="emoji">🎒</span>
            <h3>Anda belum mendaftar program bimbel</h3>
            <p>Mulai perjalanan belajarmu sekarang! Pilih program bimbel yang sesuai dengan jenjang dan kebutuhanmu.</p>
            <a href="<?= base_url('/registrasi-pembayaran') ?>" class="btn-daftar">✨ Daftar Program Sekarang</a>
        </div>
    <?php else: ?>
        <div class="section-title">📚 Program Bimbel Anda</div>

        <?php foreach ($transaksi as $paket): ?>
            <div class="paket-card">
                <div class="paket-card-header">
                    <div class="nama"><?= esc($paket['nama_program']) ?></div>
                    <div class="kelas-pill"><?= esc($paket['tingkat']) ?> · Kls <?= esc($paket['kelas']) ?></div>
                </div>
                <div class="paket-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="icon">👨‍🏫</span>
                            <div class="text">
                                <div class="label">Pengajar</div>
                                <?php if (!empty($paket['nama_pengajar'])): ?>
                                    <div class="value green"><?= esc($paket['nama_pengajar']) ?></div>
                                <?php else: ?>
                                    <div class="value muted">Akan di-assign admin</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="icon">💰</span>
                            <div class="text">
                                <div class="label">Biaya</div>
                                <div class="value">Rp <?= number_format($paket['harga'], 0, ',', '.') ?>/bln</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="icon">⏱️</span>
                            <div class="text">
                                <div class="label">Durasi per Sesi</div>
                                <div class="value"><?= $paket['durasi'] ?? 120 ?></div>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="icon">📅</span>
                            <div class="text">
                                <div class="label">Frekuensi</div>
                                <div class="value">3× / Minggu</div>
                            </div>
                        </div>
                    </div>

                    <div class="jadwal-section">
                        <div class="sub-label">📆 Jadwal Pertemuan</div>
                        <div class="jadwal-strips">
                            <?php if (!empty($paket['jadwal_list'])): ?>
                                <?php foreach ($paket['jadwal_list'] as $jdw): ?>
                                    <div class="jadwal-strip">
                                        <span class="dot"></span>
                                        <?= esc($jdw['hari']) ?>
                                        &nbsp;·&nbsp; <?= substr($jdw['jam_mulai'],0,5) ?>–<?= substr($jdw['jam_selesai'],0,5) ?> WIB
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="font-size:.82rem;color:#b7791f;font-style:italic;">⏳ Jadwal akan ditentukan setelah konfirmasi admin</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!empty($paket['keterangan'])): ?>
                        <div style="font-size:.82rem;color:#718096;background:#f7fafc;border-radius:8px;padding:10px 12px;margin-bottom:14px;border-left:3px solid #667eea;">
                            📝 <?= esc($paket['keterangan']) ?>
                        </div>
                    <?php endif; ?>

                    <div class="status-bar">
                        <div>
                            <?php if ($paket['status'] === 'lunas'): ?>
                                <span class="status-pill pill-lunas">✓ Aktif</span>
                            <?php elseif ($paket['status'] === 'pending'): ?>
                                <span class="status-pill pill-pending">⏳ Menunggu Konfirmasi</span>
                            <?php else: ?>
                                <span class="status-pill pill-ditolak">✗ Ditolak</span>
                            <?php endif; ?>
                        </div>
                        <a href="<?= base_url('/registrasi-pembayaran/history') ?>" class="btn-detail">Lihat Detail →</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div style="text-align:center;margin-top:8px;">
            <a href="<?= base_url('/registrasi-pembayaran') ?>" class="btn-daftar" style="font-size:.85rem;padding:10px 22px;">➕ Daftar Program Lain</a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
