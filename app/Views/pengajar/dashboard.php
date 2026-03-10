<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Selamat Datang, <?= esc(session()->get('nama')) ?> 👋</h1>
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
            <div class="stat-number"><?= count($jadwal) ?></div>
            <div class="stat-label">Jadwal Tersedia</div>
        </div>
    </div>

    <div class="title-container" style="margin-top: 20px;">
        <h1 style="font-size: 1.3rem;">Jadwal Mengajar</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($jadwal)): ?>
                    <tr><td colspan="4" style="text-align:center; color:#718096;">Belum ada jadwal</td></tr>
                <?php else: ?>
                    <?php foreach ($jadwal as $i => $j): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($j['hari']) ?></td>
                            <td><?= esc($j['jam_mulai']) ?></td>
                            <td><?= esc($j['jam_selesai']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px; display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="<?= base_url('pengajar/siswa') ?>" class="add-button">Lihat Daftar Siswa</a>
        <a href="<?= base_url('pengajar/hasil-belajar') ?>" class="add-button">Input Hasil Belajar</a>
    </div>
</div>

<?= $this->endSection() ?>
