<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>
<style>
    .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,.1); }
    .filter-bar { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; align-items: flex-end; }
    .filter-bar select, .filter-bar input { padding: 8px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
    .filter-bar .btn { padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; font-size: 14px; }
    .btn-primary { background: #4285f4; color: white; }
    .btn-success { background: #22c55e; color: white; text-decoration: none; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8fafc; text-align: left; padding: 10px 8px; border-bottom: 2px solid #e5e7eb; font-size: 13px; }
    td { padding: 10px 8px; border-bottom: 1px solid #f3f4f6; font-size: 13px; }
    tr:hover { background: #f9fafb; }
    .badge { padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; }
    .badge-sd { background: #dbeafe; color: #1d4ed8; }
    .badge-smp { background: #dcfce7; color: #166534; }
    .badge-sma { background: #fef3c7; color: #92400e; }
    .nilai-badge { display: inline-block; width: 42px; text-align: center; padding: 3px 6px; border-radius: 8px; font-weight: 700; }
    .nilai-a { background: #d1fae5; color: #065f46; }
    .nilai-b { background: #dbeafe; color: #1e40af; }
    .nilai-c { background: #fef3c7; color: #92400e; }
    .nilai-d { background: #fee2e2; color: #991b1b; }
    .page-title { font-size: 1.3rem; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
</style>

<section class="container">
    <div class="page-title">📋 Laporan Hasil Belajar</div>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="background:#d1fae5;color:#065f46;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Filter -->
    <form method="get" action="<?= base_url('dashboard/laporan') ?>">
        <div class="filter-bar">
            <select name="tingkat">
                <option value="">-- Semua Jenjang --</option>
                <option value="SD"  <?= ($filter['tingkat'] ?? '') === 'SD'  ? 'selected' : '' ?>>SD</option>
                <option value="SMP" <?= ($filter['tingkat'] ?? '') === 'SMP' ? 'selected' : '' ?>>SMP</option>
                <option value="SMA" <?= ($filter['tingkat'] ?? '') === 'SMA' ? 'selected' : '' ?>>SMA</option>
            </select>

            <select name="program_id">
                <option value="">-- Semua Program --</option>
                <?php foreach ($program as $p): ?>
                    <option value="<?= $p['program_id'] ?>" <?= ($filter['program_id'] ?? '') == $p['program_id'] ? 'selected' : '' ?>>
                        <?= $p['nama_program'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="pengajar_id">
                <option value="">-- Semua Guru --</option>
                <?php foreach ($pengajar as $pg): ?>
                    <option value="<?= $pg['user_id'] ?>" <?= ($filter['pengajar_id'] ?? '') == $pg['user_id'] ? 'selected' : '' ?>>
                        <?= $pg['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div>
                <label style="font-size:12px;color:#6b7280;display:block;">Dari</label>
                <input type="date" name="tanggal_dari" value="<?= $filter['tanggal_dari'] ?? '' ?>">
            </div>
            <div>
                <label style="font-size:12px;color:#6b7280;display:block;">Sampai</label>
                <input type="date" name="tanggal_sampai" value="<?= $filter['tanggal_sampai'] ?? '' ?>">
            </div>

            <button type="submit" class="btn btn-primary">🔍 Filter</button>

            <a href="<?= base_url('dashboard/laporan/cetak?' . http_build_query($filter)) ?>"
               target="_blank" class="btn btn-success">🖨️ Cetak</a>
        </div>
    </form>

    <!-- Tabel -->
    <p style="color:#6b7280;font-size:13px;margin-bottom:12px;">Total: <strong><?= count($hasil) ?></strong> data</p>

    <?php if (empty($hasil)): ?>
        <div style="text-align:center;padding:40px;color:#9ca3af;">Tidak ada data hasil belajar.</div>
    <?php else: ?>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Jenjang</th>
                        <th>Program</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Guru</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($hasil as $h): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                            <td><?= $h['nama_siswa'] ?></td>
                            <td>
                                <?php $t = $h['tingkat_program']; ?>
                                <span class="badge badge-<?= strtolower($t) ?>"><?= $t ?></span>
                            </td>
                            <td><?= $h['nama_program'] ?> <br><small style="color:#6b7280;">Kelas <?= $h['kelas'] ?></small></td>
                            <td><?= $h['mata_pelajaran'] ?></td>
                            <td>
                                <?php $n = (float) $h['nilai']; ?>
                                <span class="nilai-badge <?= $n>=85?'nilai-a':($n>=70?'nilai-b':($n>=55?'nilai-c':'nilai-d')) ?>">
                                    <?= $h['nilai'] ?>
                                </span>
                            </td>
                            <td><?= $h['nama_pengajar'] ?></td>
                            <td style="max-width:200px;white-space:normal;"><?= $h['catatan'] ?? '—' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>
