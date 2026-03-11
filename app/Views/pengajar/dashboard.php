<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Selamat Datang, <?= esc(session()->get('nama')) ?> 👋</h1>
        <?php if (session()->get('jabatan')): ?>
            <span style="background:#d1fae5;color:#065f46;padding:4px 12px;border-radius:16px;font-size:13px;font-weight:600;">
                Guru <?= session()->get('jabatan') ?>
            </span>
        <?php endif; ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message flash-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-message flash-error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="stat-cards">
        <div class="stat-card">
            <div class="stat-number"><?= $totalSiswa ?></div>
            <div class="stat-label">Total Siswa Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $totalHasil ?></div>
            <div class="stat-label">Hasil Belajar Diinput</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= count($kelasList) ?></div>
            <div class="stat-label">Kelas Diampu</div>
        </div>
    </div>

    <div class="title-container" style="margin-top: 20px;">
        <h1 style="font-size: 1.3rem;">Kelas & Jadwal Mengajar</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Program</th>
                    <th>Jenjang / Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Terisi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kelasList)): ?>
                    <tr><td colspan="6" style="text-align:center; color:#718096;">Belum ada kelas yang diampu</td></tr>
                <?php else: ?>
                    <?php foreach ($kelasList as $i => $k): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $k['nama_program'] ?></td>
                            <td>
                                <span style="background:#dbeafe;color:#1d4ed8;padding:2px 8px;border-radius:10px;font-size:12px;">
                                    <?= $k['tingkat'] ?> Kelas <?= $k['kelas_program'] ?>
                                </span>
                            </td>
                            <td><?= $k['hari'] ?></td>
                            <td><?= substr($k['jam_mulai'],0,5) ?> – <?= substr($k['jam_selesai'],0,5) ?></td>
                            <td>
                                <span style="font-weight:600;color:<?= $k['terisi'] >= $k['kuota'] ? '#dc2626' : '#059669' ?>">
                                    <?= $k['terisi'] ?>/<?= $k['kuota'] ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
