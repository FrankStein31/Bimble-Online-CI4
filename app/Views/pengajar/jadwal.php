<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Jadwal & Kelas Saya</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Program</th>
                    <th>Jenjang / Kelas</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kapasitas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kelasList)): ?>
                    <tr><td colspan="7" style="text-align:center; color:#718096; padding:30px;">Belum ada kelas yang diampu</td></tr>
                <?php else: ?>
                    <?php foreach ($kelasList as $i => $k): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($k['nama_program']) ?></td>
                            <td>
                                <span style="background:#dbeafe;color:#1d4ed8;padding:2px 8px;border-radius:10px;font-size:12px;">
                                    <?= $k['tingkat'] ?> Kelas <?= $k['kelas_program'] ?>
                                </span>
                            </td>
                            <td><?= esc($k['hari']) ?></td>
                            <td><?= substr($k['jam_mulai'],0,5) ?></td>
                            <td><?= substr($k['jam_selesai'],0,5) ?></td>
                            <td>
                                <span style="font-weight:600;color:<?= $k['terisi']>=$k['kuota']?'#dc2626':'#059669' ?>">
                                    <?= $k['terisi'] ?>/<?= $k['kuota'] ?> siswa
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
