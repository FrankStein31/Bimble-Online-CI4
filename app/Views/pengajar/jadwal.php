<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<style>
.filter-section {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    border: 1px solid #e2e8f0;
    margin-bottom: 24px;
}

.filter-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-controls {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    align-items: flex-end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.filter-group select {
    padding: 10px 12px;
    border: 1px solid #cbd5e0;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #2d3748;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.filter-group select:hover {
    border-color: #a0aec0;
}

.filter-group select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.filter-buttons {
    display: flex;
    gap: 10px;
    align-items: flex-end;
}

.btn-filter {
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-filter-reset {
    padding: 10px 20px;
    background: #e2e8f0;
    color: #4a5568;
    border: 1px solid #cbd5e0;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter-reset:hover {
    background: #cbd5e0;
}
</style>

<div class="page-header">
    <h1>📅 Jadwal & Kelas Saya</h1>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div class="filter-title">Filter Data</div>
    <form method="get" id="filter-form">
        <div class="filter-controls">
            <div class="filter-group">
                <label for="program_id">Program</label>
                <select name="program_id" id="program_id">
                    <option value="">Semua Program</option>
                    <?php if (!empty($programs)): ?>
                        <?php foreach ($programs as $prog): ?>
                            <option value="<?= $prog['program_id'] ?>" <?= ($selectedProgram == $prog['program_id']) ? 'selected' : '' ?>>
                                <?= esc($prog['nama_program']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="filter-buttons">
                <button type="submit" class="btn-filter">Filter</button>
                <a href="<?= base_url('/pengajar/jadwal') ?>" class="btn-filter-reset">↻ Reset</a>
            </div>
        </div>
    </form>
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
