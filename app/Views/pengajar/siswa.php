<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Daftar Siswa</h1>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message flash-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="search-container">
        <input type="text" class="search-input" placeholder="Cari nama siswa...">
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Program</th>
                    <th>Tingkat</th>
                    <th>Kelas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($siswa)): ?>
                    <tr><td colspan="7" style="text-align:center; color:#718096; padding:30px;">Belum ada siswa aktif</td></tr>
                <?php else: ?>
                    <?php foreach ($siswa as $i => $s): ?>
                        <tr>
                            <td data-label="No"><?= $i + 1 ?></td>
                            <td data-label="Nama">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <?php if ($s['photo']): ?>
                                        <img src="<?= base_url('uploads/profile/' . $s['photo']) ?>" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                                    <?php else: ?>
                                        <div style="width:36px;height:36px;border-radius:50%;background:#667eea;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:14px;">
                                            <?= strtoupper(substr($s['nama'], 0, 1)) ?>
                                        </div>
                                    <?php endif; ?>
                                    <?= esc($s['nama']) ?>
                                </div>
                            </td>
                            <td data-label="No. HP"><?= esc($s['nomor_hp']) ?></td>
                            <td data-label="Program"><?= esc($s['nama_program']) ?></td>
                            <td data-label="Tingkat"><?= esc($s['tingkat']) ?></td>
                            <td data-label="Kelas"><?= esc($s['kelas']) ?></td>
                            <td data-label="Status">
                                <span class="status-lunas">Aktif</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
