<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>
<style>
    .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap:wrap; gap:12px; }
    .page-header h1 { font-size:1.5rem; font-weight:700; color:#1a202c; margin:0; }
    .btn-add {
        display:inline-flex; align-items:center; gap:6px;
        background:linear-gradient(135deg,#667eea,#764ba2); color:white;
        border:none; border-radius:8px; padding:9px 18px;
        font-size:.9rem; font-weight:600; cursor:pointer;
        box-shadow:0 2px 8px rgba(102,126,234,.35);
    }
    .btn-add:hover { opacity:.9; }

    /* Tabs */
    .tab-nav { display:flex; gap:0; border-bottom:2px solid #e2e8f0; margin-bottom:24px; }
    .tab-btn-nav {
        padding:10px 22px; background:none; border:none; cursor:pointer;
        font-size:.9rem; font-weight:600; color:#718096;
        border-bottom:3px solid transparent; margin-bottom:-2px;
        transition:all .2s;
    }
    .tab-btn-nav.active { color:#667eea; border-bottom-color:#667eea; }
    .tab-pane { display:none; }
    .tab-pane.active { display:block; }

    /* Alert */
    .alert { padding:12px 16px; border-radius:8px; margin-bottom:18px; font-size:.9rem; font-weight:500; }
    .alert-success { background:#f0fff4; color:#276749; border-left:4px solid #48bb78; }
    .alert-error   { background:#fff5f5; color:#c53030; border-left:4px solid #fc8181; }

    /* Stats */
    .stats-row { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:14px; margin-bottom:22px; }
    .stat-card { background:white; border-radius:10px; padding:14px 18px; box-shadow:0 2px 10px rgba(0,0,0,.06); border:1px solid #e2e8f0; text-align:center; }
    .stat-card .num { font-size:1.7rem; font-weight:700; color:#667eea; }
    .stat-card .lbl { font-size:.78rem; color:#718096; margin-top:2px; }

    /* Search/filter bar */
    .toolbar { display:flex; flex-wrap:wrap; gap:10px; align-items:flex-end; margin-bottom:16px; }
    .toolbar input[type=text], .toolbar select, .toolbar input[type=date] {
        padding:8px 12px; border:1px solid #e2e8f0; border-radius:8px;
        font-size:.85rem; outline:none; background:white;
    }
    .toolbar input[type=text]:focus, .toolbar select:focus { border-color:#667eea; }
    .btn-filter {
        padding:8px 16px; border:none; border-radius:8px;
        background:linear-gradient(135deg,#667eea,#764ba2); color:white;
        font-size:.85rem; font-weight:600; cursor:pointer;
    }
    .btn-reset {
        padding:8px 14px; border:1px solid #e2e8f0; border-radius:8px;
        background:white; color:#4a5568; font-size:.85rem; font-weight:600;
        cursor:pointer; text-decoration:none;
    }
    .btn-print {
        padding:8px 16px; border:none; border-radius:8px;
        background:linear-gradient(135deg,#48bb78,#276749); color:white;
        font-size:.85rem; font-weight:600; cursor:pointer; text-decoration:none;
        display:inline-flex; align-items:center; gap:5px;
    }

    /* Table */
    .tbl-wrap { overflow-x:auto; border-radius:10px; border:1px solid #e2e8f0; }
    table { width:100%; border-collapse:collapse; }
    thead th {
        background:#f8fafc; padding:10px 12px; font-size:.78rem;
        font-weight:600; color:#718096; text-transform:uppercase;
        letter-spacing:.4px; text-align:left; border-bottom:1px solid #e2e8f0;
        white-space:nowrap;
    }
    tbody tr { border-bottom:1px solid #f1f5f9; transition:background .15s; }
    tbody tr:last-child { border-bottom:none; }
    tbody tr:hover { background:#f8fafc; }
    td { padding:10px 12px; font-size:.88rem; color:#4a5568; vertical-align:middle; }
    .empty-state { text-align:center; padding:50px 20px; color:#a0aec0; }
    .empty-state .icon { font-size:2.5rem; margin-bottom:10px; }

    /* Badges */
    .badge { display:inline-block; padding:2px 8px; border-radius:12px; font-size:.75rem; font-weight:600; }
    .badge-SD  { background:#dbeafe; color:#1d4ed8; }
    .badge-SMP { background:#dcfce7; color:#166534; }
    .badge-SMA { background:#fef3c7; color:#92400e; }
    .nilai-badge { display:inline-block; padding:3px 8px; border-radius:8px; font-weight:700; font-size:.85rem; min-width:40px; text-align:center; }
    .nilai-a { background:#d1fae5; color:#065f46; }
    .nilai-b { background:#dbeafe; color:#1e40af; }
    .nilai-c { background:#fef3c7; color:#92400e; }
    .nilai-d { background:#fee2e2; color:#991b1b; }
    .nilai-x { background:#f1f5f9; color:#a0aec0; }

    /* Action */
    .action-group { display:flex; gap:5px; }
    .btn-icon { width:30px; height:30px; border-radius:6px; border:none; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; font-size:.8rem; }
    .btn-icon.edit { background:#ebf8ff; color:#2b6cb0; }
    .btn-icon.del  { background:#fff5f5; color:#c53030; }
    .btn-icon.edit:hover { background:#bee3f8; }
    .btn-icon.del:hover  { background:#fed7d7; }

    /* Modal */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:300; align-items:center; justify-content:center; padding:20px; }
    .modal-overlay.active { display:flex; }
    .modal-box {
        background:white; border-radius:14px; width:100%; max-width:520px;
        box-shadow:0 20px 60px rgba(0,0,0,.2); overflow:hidden;
        animation:slideUp .25s ease; max-height:90vh; display:flex; flex-direction:column;
    }
    @keyframes slideUp { from{transform:translateY(30px);opacity:0} to{transform:translateY(0);opacity:1} }
    .modal-head { display:flex; justify-content:space-between; align-items:center; padding:16px 20px; background:linear-gradient(135deg,#667eea,#764ba2); color:white; flex-shrink:0; }
    .modal-head h3 { margin:0; font-size:.95rem; font-weight:600; }
    .modal-close { background:rgba(255,255,255,.2); border:none; color:white; width:26px; height:26px; border-radius:50%; cursor:pointer; font-size:.9rem; display:flex; align-items:center; justify-content:center; }
    .modal-body { padding:20px; overflow-y:auto; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:.82rem; font-weight:600; color:#4a5568; margin-bottom:5px; }
    .form-group label .req { color:#e53e3e; }
    .form-control, .form-select {
        width:100%; padding:9px 11px; border:1px solid #e2e8f0; border-radius:8px;
        font-size:.88rem; color:#2d3748; box-sizing:border-box; outline:none; background:white;
    }
    .form-control:focus, .form-select:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15); }
    .two-col { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .modal-foot { padding:12px 20px 18px; display:flex; justify-content:flex-end; gap:10px; flex-shrink:0; }
    .btn-cancel { padding:8px 16px; border:1px solid #e2e8f0; border-radius:8px; background:white; color:#4a5568; font-size:.88rem; font-weight:600; cursor:pointer; }
    .btn-save { padding:8px 16px; border:none; border-radius:8px; background:linear-gradient(135deg,#667eea,#764ba2); color:white; font-size:.88rem; font-weight:600; cursor:pointer; }
    .del-modal-head { background:linear-gradient(135deg,#e53e3e,#c53030) !important; }
</style>

<div class="page-header">
    <h1>📋 Hasil Belajar & Laporan</h1>
    <button class="btn-add" onclick="openAddModal()">＋ Tambah Data</button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" id="flash-alert">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error" id="flash-alert">❌ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Tab Navigation -->
<div class="tab-nav">
    <button class="tab-btn-nav active" onclick="switchTab('data', this)">📝 Data Hasil Belajar</button>
    <button class="tab-btn-nav" onclick="switchTab('laporan', this)">📊 Laporan & Cetak</button>
</div>

<!-- ============================================================ -->
<!-- TAB 1: DATA CRUD -->
<!-- ============================================================ -->
<div class="tab-pane active" id="tab-data">

    <?php
        $totalData    = count($hasilAll);
        $nilaiArr     = array_filter(array_column($hasilAll, 'nilai'), fn($v) => $v !== null && $v !== '');
        $rataRata     = count($nilaiArr) ? round(array_sum($nilaiArr)/count($nilaiArr), 1) : '-';
        $countA = count(array_filter($nilaiArr, fn($v) => $v >= 85));
        $countB = count(array_filter($nilaiArr, fn($v) => $v >= 70 && $v < 85));
        $countC = count(array_filter($nilaiArr, fn($v) => $v >= 55 && $v < 70));
        $countD = count(array_filter($nilaiArr, fn($v) => $v < 55));
    ?>
    <div class="stats-row">
        <div class="stat-card"><div class="num"><?= $totalData ?></div><div class="lbl">Total Data</div></div>
        <div class="stat-card"><div class="num"><?= $rataRata ?></div><div class="lbl">Rata-rata Nilai</div></div>
        <div class="stat-card"><div class="num" style="color:#065f46;"><?= $countA ?></div><div class="lbl">Nilai A (≥85)</div></div>
        <div class="stat-card"><div class="num" style="color:#1e40af;"><?= $countB ?></div><div class="lbl">Nilai B (70–84)</div></div>
        <div class="stat-card"><div class="num" style="color:#c53030;"><?= $countD ?></div><div class="lbl">Nilai D (&lt;55)</div></div>
    </div>

    <div class="toolbar">
        <input type="text" id="searchData" placeholder="🔍  Cari siswa / mapel / pengajar…" oninput="filterTable(this.value)" style="min-width:240px;">
    </div>

    <div class="tbl-wrap">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Pengajar</th>
                    <th>Program</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($hasilAll)): ?>
                    <tr><td colspan="9"><div class="empty-state"><div class="icon">📭</div><p>Belum ada data hasil belajar.</p></div></td></tr>
                <?php else: ?>
                    <?php foreach ($hasilAll as $i => $h): ?>
                        <tr class="data-row" data-search="<?= strtolower($h['nama_siswa'].' '.$h['mata_pelajaran'].' '.$h['nama_pengajar'].' '.$h['nama_program']) ?>">
                            <td><?= $i + 1 ?></td>
                            <td style="white-space:nowrap;"><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                            <td><strong><?= esc($h['nama_siswa']) ?></strong></td>
                            <td><?= esc($h['nama_pengajar']) ?></td>
                            <td>
                                <?= esc($h['nama_program']) ?><br>
                                <span class="badge badge-<?= $h['tingkat_program'] ?>"><?= $h['tingkat_program'] ?></span>
                                <span style="color:#718096;font-size:.78rem;">Kls <?= $h['kelas'] ?></span>
                            </td>
                            <td><?= esc($h['mata_pelajaran']) ?></td>
                            <td>
                                <?php if ($h['nilai'] !== null && $h['nilai'] !== ''): ?>
                                    <?php $n = (float)$h['nilai']; ?>
                                    <span class="nilai-badge <?= $n>=85?'nilai-a':($n>=70?'nilai-b':($n>=55?'nilai-c':'nilai-d')) ?>">
                                        <?= number_format($n, 1) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="nilai-badge nilai-x">-</span>
                                <?php endif; ?>
                            </td>
                            <td style="max-width:160px;font-size:.82rem;color:#718096;"><?= esc($h['catatan'] ?? '—') ?></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-icon edit" title="Edit" onclick='openEditModal(<?= $h["hasil_id"] ?>, <?= json_encode($h) ?>)'>✏️</button>
                                    <button class="btn-icon del"  title="Hapus" onclick="openDeleteModal(<?= $h['hasil_id'] ?>, '<?= esc($h['nama_siswa']) ?>', '<?= esc($h['mata_pelajaran']) ?>')">🗑️</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================================ -->
<!-- TAB 2: LAPORAN & CETAK -->
<!-- ============================================================ -->
<div class="tab-pane" id="tab-laporan">
    <form method="get" action="<?= base_url('dashboard/laporan') ?>" id="filterForm" onsubmit="switchToLaporan()">
        <input type="hidden" name="tab" value="laporan">
        <div class="toolbar">
            <div>
                <label style="font-size:.78rem;color:#718096;display:block;margin-bottom:3px;">Jenjang</label>
                <select name="tingkat">
                    <option value="">Semua Jenjang</option>
                    <?php foreach (['SD','SMP','SMA'] as $t): ?>
                        <option value="<?= $t ?>" <?= ($filter['tingkat'] ?? '') === $t ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-size:.78rem;color:#718096;display:block;margin-bottom:3px;">Program</label>
                <select name="program_id">
                    <option value="">Semua Program</option>
                    <?php foreach ($program as $p): ?>
                        <option value="<?= $p['program_id'] ?>" <?= ($filter['program_id'] ?? '') == $p['program_id'] ? 'selected' : '' ?>>
                            <?= esc($p['nama_program']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-size:.78rem;color:#718096;display:block;margin-bottom:3px;">Pengajar</label>
                <select name="pengajar_id">
                    <option value="">Semua Pengajar</option>
                    <?php foreach ($pengajar as $pg): ?>
                        <option value="<?= $pg['user_id'] ?>" <?= ($filter['pengajar_id'] ?? '') == $pg['user_id'] ? 'selected' : '' ?>>
                            <?= esc($pg['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="font-size:.78rem;color:#718096;display:block;margin-bottom:3px;">Dari Tanggal</label>
                <input type="date" name="tanggal_dari" value="<?= $filter['tanggal_dari'] ?? '' ?>">
            </div>
            <div>
                <label style="font-size:.78rem;color:#718096;display:block;margin-bottom:3px;">Sampai</label>
                <input type="date" name="tanggal_sampai" value="<?= $filter['tanggal_sampai'] ?? '' ?>">
            </div>
            <button type="submit" class="btn-filter">🔍 Filter</button>
            <a href="<?= base_url('dashboard/laporan?tab=laporan') ?>" class="btn-reset">↺ Reset</a>
        </div>
    </form>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;flex-wrap:wrap;gap:8px;">
        <span style="font-size:.88rem;color:#718096;">Menampilkan <strong><?= count($hasil) ?></strong> data</span>
        <?php if (!empty($hasil)): ?>
            <a href="<?= base_url('dashboard/laporan/cetak?' . http_build_query(array_filter($filter))) ?>"
               target="_blank" class="btn-print">🖨️ Cetak / Simpan PDF</a>
        <?php endif; ?>
    </div>

    <div class="tbl-wrap">
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
                    <th>Pengajar</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($hasil)): ?>
                    <tr><td colspan="9"><div class="empty-state"><div class="icon">🔍</div><p>Tidak ada data sesuai filter.</p></div></td></tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($hasil as $h): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td style="white-space:nowrap;"><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                            <td><strong><?= esc($h['nama_siswa']) ?></strong></td>
                            <td><span class="badge badge-<?= $h['tingkat_program'] ?>"><?= $h['tingkat_program'] ?></span></td>
                            <td><?= esc($h['nama_program']) ?> <small style="color:#718096;">Kls <?= $h['kelas'] ?></small></td>
                            <td><?= esc($h['mata_pelajaran']) ?></td>
                            <td>
                                <?php if ($h['nilai'] !== null && $h['nilai'] !== ''): ?>
                                    <?php $n = (float)$h['nilai']; ?>
                                    <span class="nilai-badge <?= $n>=85?'nilai-a':($n>=70?'nilai-b':($n>=55?'nilai-c':'nilai-d')) ?>">
                                        <?= number_format($n, 1) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="nilai-badge nilai-x">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($h['nama_pengajar']) ?></td>
                            <td style="font-size:.82rem;color:#718096;max-width:160px;"><?= esc($h['catatan'] ?? '—') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ===== MODAL TAMBAH ===== -->
<div class="modal-overlay" id="modalAdd">
    <div class="modal-box">
        <div class="modal-head">
            <h3>➕ Tambah Hasil Belajar</h3>
            <button class="modal-close" onclick="closeModal('modalAdd')">×</button>
        </div>
        <form action="<?= base_url('dashboard/laporan/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="two-col">
                    <div class="form-group">
                        <label>Siswa <span class="req">*</span></label>
                        <select name="siswa_id" id="add_siswa" class="form-select" required onchange="adminAutoFill(this.value, 'add')">
                            <option value="">Pilih Siswa</option>
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pengajar <span class="req">*</span></label>
                        <select name="pengajar_id" id="add_pengajar" class="form-select" required>
                            <option value="">Pilih Pengajar</option>
                            <?php foreach ($pengajar as $pg): ?>
                                <option value="<?= $pg['user_id'] ?>"><?= esc($pg['nama']) ?> (<?= $pg['jabatan'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Program <span class="req">*</span></label>
                    <select name="program_id" id="add_program" class="form-select" required>
                        <option value="">Pilih Program</option>
                        <?php foreach ($program as $p): ?>
                            <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> Kls <?= $p['kelas'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <div id="add_autodetect_hint" style="font-size:.75rem;color:#38a169;margin-top:3px;display:none;">✅ Terdeteksi otomatis dari paket aktif siswa</div>
                </div>
                <div class="two-col">
                    <div class="form-group">
                        <label>Mata Pelajaran <span class="req">*</span></label>
                        <input type="text" name="mata_pelajaran" class="form-control" placeholder="Matematika" required>
                    </div>
                    <div class="form-group">
                        <label>Nilai <small style="color:#a0aec0;">(0–100, opsional)</small></label>
                        <input type="number" name="nilai" class="form-control" min="0" max="100" step="0.5" placeholder="85">
                    </div>
                </div>
                <div class="two-col">
                    <div class="form-group">
                        <label>Tanggal <span class="req">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <input type="text" name="catatan" class="form-control" placeholder="Opsional">
                    </div>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-cancel" onclick="closeModal('modalAdd')">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ===== MODAL EDIT ===== -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <div class="modal-head">
            <h3>✏️ Edit Hasil Belajar</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">×</button>
        </div>
        <form id="editForm" method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="two-col">
                    <div class="form-group">
                        <label>Siswa <span class="req">*</span></label>
                        <select name="siswa_id" id="e_siswa" class="form-select" required onchange="adminAutoFill(this.value, 'edit')">
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pengajar <span class="req">*</span></label>
                        <select name="pengajar_id" id="e_pengajar" class="form-select" required>
                            <?php foreach ($pengajar as $pg): ?>
                                <option value="<?= $pg['user_id'] ?>"><?= esc($pg['nama']) ?> (<?= $pg['jabatan'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Program <span class="req">*</span></label>
                    <select name="program_id" id="e_program" class="form-select" required>
                        <?php foreach ($program as $p): ?>
                            <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> Kls <?= $p['kelas'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="two-col">
                    <div class="form-group">
                        <label>Mata Pelajaran <span class="req">*</span></label>
                        <input type="text" name="mata_pelajaran" id="e_mapel" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="number" name="nilai" id="e_nilai" class="form-control" min="0" max="100" step="0.5">
                    </div>
                </div>
                <div class="two-col">
                    <div class="form-group">
                        <label>Tanggal <span class="req">*</span></label>
                        <input type="date" name="tanggal" id="e_tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <input type="text" name="catatan" id="e_catatan" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-cancel" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ===== MODAL HAPUS ===== -->
<div class="modal-overlay" id="modalDelete">
    <div class="modal-box" style="max-width:380px;">
        <div class="modal-head del-modal-head">
            <h3>🗑️ Konfirmasi Hapus</h3>
            <button class="modal-close" onclick="closeModal('modalDelete')">×</button>
        </div>
        <div class="modal-body" style="text-align:center;padding:24px;">
            <div style="font-size:2.5rem;margin-bottom:10px;">⚠️</div>
            <p style="color:#4a5568;font-size:.95rem;">Hapus data hasil belajar:<br>
                <strong id="del_label" style="color:#c53030;"></strong></p>
            <p style="color:#718096;font-size:.82rem;margin-top:8px;">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-foot">
            <button type="button" class="btn-cancel" onclick="closeModal('modalDelete')">Batal</button>
            <a id="delLink" href="#" style="padding:8px 16px;border-radius:8px;background:linear-gradient(135deg,#e53e3e,#c53030);color:white;font-size:.88rem;font-weight:600;text-decoration:none;">
                Ya, Hapus
            </a>
        </div>
    </div>
</div>

<script>
    // Siswa → {program_id, pengajar_id} mapping from server
    const adminSiswaMap = <?= json_encode($siswaMap ?? []) ?>;

    function adminAutoFill(siswaId, mode) {
        if (!siswaId || !adminSiswaMap[siswaId]) return;
        const map = adminSiswaMap[siswaId];
        if (mode === 'add') {
            document.getElementById('add_pengajar').value = map.pengajar_id ?? '';
            document.getElementById('add_program').value  = map.program_id ?? '';
            const hint = document.getElementById('add_autodetect_hint');
            if (hint) hint.style.display = 'block';
        } else if (mode === 'edit') {
            document.getElementById('e_pengajar').value = map.pengajar_id ?? '';
            document.getElementById('e_program').value  = map.program_id ?? '';
        }
    }

    // ---- Tab switching ----
    function switchTab(name, btn) {
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.tab-btn-nav').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + name).classList.add('active');
        if (btn) btn.classList.add('active');
    }

    function switchToLaporan() {
        // Called on filter form submit — ensure laporan tab is active after page reload
        localStorage.setItem('activeTab', 'laporan');
    }

    // Auto-activate tab from URL param or localStorage
    (function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || localStorage.getItem('activeTab') || 'data';
        localStorage.removeItem('activeTab');
        if (tab === 'laporan') {
            switchTab('laporan', document.querySelectorAll('.tab-btn-nav')[1]);
        }
    })();

    // ---- Modal helpers ----
    function openAddModal() { document.getElementById('modalAdd').classList.add('active'); }

    function openEditModal(id, data) {
        document.getElementById('editForm').action = '<?= base_url('dashboard/laporan/edit/') ?>' + id;
        document.getElementById('e_siswa').value    = data.siswa_id;
        document.getElementById('e_pengajar').value = data.pengajar_id;
        document.getElementById('e_program').value  = data.program_id;
        document.getElementById('e_mapel').value    = data.mata_pelajaran;
        document.getElementById('e_nilai').value    = data.nilai ?? '';
        document.getElementById('e_tanggal').value  = data.tanggal;
        document.getElementById('e_catatan').value  = data.catatan ?? '';
        document.getElementById('modalEdit').classList.add('active');
    }

    function openDeleteModal(id, siswa, mapel) {
        document.getElementById('del_label').textContent = siswa + ' — ' + mapel;
        document.getElementById('delLink').href = '<?= base_url('dashboard/laporan/hapus/') ?>' + id;
        document.getElementById('modalDelete').classList.add('active');
    }

    function closeModal(id) { document.getElementById(id).classList.remove('active'); }

    document.querySelectorAll('.modal-overlay').forEach(o => {
        o.addEventListener('click', e => { if (e.target === o) o.classList.remove('active'); });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape')
            document.querySelectorAll('.modal-overlay.active').forEach(m => m.classList.remove('active'));
    });

    // ---- Live search on data table ----
    function filterTable(q) {
        q = q.toLowerCase().trim();
        document.querySelectorAll('#dataTable .data-row').forEach(row => {
            row.style.display = (!q || (row.dataset.search || '').includes(q)) ? '' : 'none';
        });
    }

    // ---- Auto-dismiss flash ----
    setTimeout(() => {
        const el = document.getElementById('flash-alert');
        if (el) { el.style.transition='opacity .5s'; el.style.opacity='0'; setTimeout(()=>el.remove(),500); }
    }, 4000);
</script>

<?= $this->endSection() ?>
