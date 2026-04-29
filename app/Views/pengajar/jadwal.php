<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1>📅 Jadwal & Kelas Saya</h1>
</div>

<?php
    $hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    $byHari = [];
    foreach ($kelasList as $k) {
        // Kelompokkan berdasarkan hari pertama di jadwal_list
        $hariPertama = !empty($k['jadwal_list']) ? $k['jadwal_list'][0]['hari'] : 'Lainnya';
        $byHari[$hariPertama][] = $k;
    }
?>

<?php if (empty($kelasList)): ?>
    <div class="tbl-wrap">
        <div class="empty-state"><div class="icon">📭</div><p>Belum ada kelas yang dijadwalkan untuk Anda.</p></div>
    </div>
<?php else: ?>
    <!-- Stats -->
    <div class="stat-cards" style="grid-template-columns:repeat(auto-fit,minmax(120px,1fr));">
        <div class="stat-card">
            <div class="stat-number"><?= count($kelasList) ?></div>
            <div class="stat-label">Total Kelas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= count($byHari) ?></div>
            <div class="stat-label">Hari Aktif</div>
        </div>
        <?php $totalSiswaSlot = array_sum(array_column($kelasList,'terisi')); ?>
        <div class="stat-card">
            <div class="stat-number"><?= $totalSiswaSlot ?></div>
            <div class="stat-label">Total Siswa</div>
        </div>
    </div>

    <?php foreach ($hariOrder as $hari): ?>
        <?php if (!isset($byHari[$hari])) continue; ?>
        <div style="margin-bottom:16px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                <span style="background:linear-gradient(135deg,#667eea,#764ba2);color:white;padding:4px 14px;border-radius:20px;font-size:.82rem;font-weight:700;">
                    📅 <?= $hari ?>
                </span>
                <span style="font-size:.8rem;color:#718096;"><?= count($byHari[$hari]) ?> kelas</span>
            </div>
            <div class="tbl-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program</th>
                            <th>Jenjang</th>
                            <th>Jadwal Pertemuan</th>
                            <th>Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($byHari[$hari] as $i => $k): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= esc($k['nama_program']) ?></strong></td>
                                <td><span class="badge badge-<?= $k['tingkat'] ?>"><?= $k['tingkat'] ?> Kls <?= $k['kelas_program'] ?></span></td>
                                <td>
                                    <?php if (!empty($k['jadwal_list'])): ?>
                                        <?php foreach ($k['jadwal_list'] as $jdw): ?>
                                            <?php
                                                $mStart = strtotime($jdw['jam_mulai']);
                                                $mEnd   = strtotime($jdw['jam_selesai']);
                                                $menit  = ($mEnd - $mStart) / 60;
                                                $jam    = floor($menit/60); $sisa = $menit % 60;
                                                $durStr = $menit >= 60 ? ($jam.'j'.($sisa ? ' '.$sisa.'m' : '')) : ($menit.'m');
                                            ?>
                                            <div style="white-space:nowrap;line-height:1.9;">
                                                <span style="font-weight:600;color:#2d3748;">🕐 <?= esc($jdw['hari']) ?></span>
                                                <span style="color:#718096;font-size:.85rem;"> <?= substr($jdw['jam_mulai'],0,5) ?>→<?= substr($jdw['jam_selesai'],0,5) ?> WIB</span>
                                                <span style="background:#ebf4ff;color:#2b6cb0;border-radius:8px;padding:1px 7px;font-size:.75rem;margin-left:4px;">⏱ <?= trim($durStr) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span style="color:#a0aec0;font-size:.8rem;">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="<?= $k['terisi'] >= $k['kuota'] ? 'cap-full' : 'cap-ok' ?>">
                                        <?= $k['terisi'] ?>/<?= $k['kuota'] ?> siswa
                                    </span>
                                    <?php if ($k['terisi'] >= $k['kuota']): ?>
                                        <span style="background:#fee2e2;color:#991b1b;padding:1px 7px;border-radius:10px;font-size:.72rem;font-weight:600;margin-left:4px;">PENUH</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
