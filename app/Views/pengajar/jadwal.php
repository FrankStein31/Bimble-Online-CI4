<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Jadwal Mengajar</h1>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message flash-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

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
                    <tr><td colspan="4" style="text-align:center; color:#718096; padding:30px;">Belum ada jadwal tersedia</td></tr>
                <?php else: ?>
                    <?php foreach ($jadwal as $i => $j): ?>
                        <tr>
                            <td data-label="No"><?= $i + 1 ?></td>
                            <td data-label="Hari"><?= esc($j['hari']) ?></td>
                            <td data-label="Jam Mulai"><?= esc($j['jam_mulai']) ?></td>
                            <td data-label="Jam Selesai"><?= esc($j['jam_selesai']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
