<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>🏠 Selamat Datang, <?= esc(session()->get('nama')) ?> 👋</h1>
        <?php if (session()->get('jabatan')): ?>
            <span class="badge badge-<?= session()->get('jabatan') ?>" style="margin-top:6px;display:inline-block;">
                Guru <?= session()->get('jabatan') ?>
            </span>
        <?php endif; ?>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-message flash-success">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-message flash-error">❌ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Stats -->
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-number"><?= $totalSiswa ?></div>
        <div class="stat-label">👨‍🎓 Siswa Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $totalHasil ?></div>
        <div class="stat-label">📝 Hasil Diinput</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= count($kelasList) ?></div>
        <div class="stat-label">🏫 Kelas Diampu</div>
    </div>
</div>

<!-- Kelas & Jadwal -->
<div class="page-header" style="margin-bottom:14px;">
    <h1 style="font-size:1.1rem;">📅 Kelas & Jadwal Mengajar</h1>
    <a href="<?= base_url('pengajar/jadwal') ?>" class="btn-add" style="font-size:.8rem;padding:7px 14px;">Lihat Semua →</a>
</div>

<div class="tbl-wrap">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Program</th>
                <th>Jenjang</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Siswa</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($kelasList)): ?>
                <tr><td colspan="6"><div class="empty-state"><div class="icon">📭</div><p>Belum ada kelas yang diampu.</p></div></td></tr>
            <?php else: ?>
                <?php foreach ($kelasList as $i => $k): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><strong><?= esc($k['nama_program']) ?></strong></td>
                        <td><span class="badge badge-<?= $k['tingkat'] ?>"><?= $k['tingkat'] ?> Kls <?= $k['kelas_program'] ?></span></td>
                        <td><?= esc($k['hari']) ?></td>
                        <td style="white-space:nowrap;">🕐 <?= substr($k['jam_mulai'],0,5) ?> – <?= substr($k['jam_selesai'],0,5) ?> WIB</td>
                        <td>
                            <span class="<?= $k['terisi'] >= $k['kuota'] ? 'cap-full' : 'cap-ok' ?>">
                                <?= $k['terisi'] ?>/<?= $k['kuota'] ?> siswa
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
