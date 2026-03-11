<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<style>
    /* ===== Page Layout ===== */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .page-header h1 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0;
    }
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(102,126,234,0.35);
    }
    .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(102,126,234,0.45); }
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 16px 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        text-align: center;
    }
    .stat-card .num { font-size: 1.8rem; font-weight: 700; color: #667eea; }
    .stat-card .lbl { font-size: 0.8rem; color: #718096; margin-top: 2px; }
    .tbl-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 28px;
    }
    .tbl-card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 16px 20px;
        font-weight: 600;
        font-size: 1rem;
    }
    .tbl-card table { width: 100%; border-collapse: collapse; }
    .tbl-card th {
        background: #f7f8fc;
        color: #4a5568;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 12px 16px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }
    .tbl-card td {
        padding: 13px 16px;
        border-bottom: 1px solid #f0f4f8;
        font-size: 0.88rem;
        color: #2d3748;
        vertical-align: middle;
    }
    .tbl-card tr:last-child td { border-bottom: none; }
    .tbl-card tr:hover td { background: #f7f8fc; }
    .badge-tingkat {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .badge-sd  { background: #e6f4ea; color: #2e7d32; }
    .badge-smp { background: #e3f2fd; color: #1565c0; }
    .badge-sma { background: #fce4ec; color: #880e4f; }
    .jadwal-pills { display: flex; flex-wrap: wrap; gap: 5px; }
    .jadwal-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #ede9fe;
        color: #5b21b6;
        border-radius: 10px;
        padding: 3px 9px;
        font-size: 0.73rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .jadwal-pill .dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #764ba2;
        flex-shrink: 0;
    }
    .no-jadwal { color: #a0aec0; font-size: 0.8rem; font-style: italic; }
    .action-group { display: flex; gap: 6px; }
    .btn-icon {
        width: 32px; height: 32px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: all 0.15s;
    }
    .btn-edit  { background: #ebf4ff; color: #2b6cb0; }
    .btn-del { background: #fff5f5; color: #c53030; }
    .btn-edit:hover  { background: #bee3f8; }
    .btn-del:hover { background: #fed7d7; }
    .flash-msg {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .flash-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .flash-error   { background: #fff1f2; color: #9b1c1c; border: 1px solid #fecdd3; }
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: white;
        border-radius: 14px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.18);
        width: 100%;
        max-width: 560px;
        max-height: 92vh;
        overflow-y: auto;
        animation: modalIn 0.2s ease;
    }
    .modal-box.modal-sm { max-width: 420px; }
    @keyframes modalIn {
        from { transform: translateY(-16px); opacity: 0; }
        to   { transform: translateY(0); opacity: 1; }
    }
    .modal-head {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 18px 22px;
        border-radius: 14px 14px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    .modal-head h3 { margin: 0; font-size: 1.05rem; font-weight: 700; }
    .modal-close {
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        width: 28px; height: 28px;
        border-radius: 50%;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    .modal-close:hover { background: rgba(255,255,255,0.35); }
    .modal-body { padding: 22px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-row.col3 { grid-template-columns: 1fr 1fr 1fr; }
    @media (max-width: 520px) { .form-row, .form-row.col3 { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 14px; }
    .form-group label { display: block; font-size: 0.82rem; font-weight: 600; color: #4a5568; margin-bottom: 5px; }
    .form-control, .form-select {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 0.88rem;
        color: #374151;
        background: white;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
    }
    textarea.form-control { resize: vertical; min-height: 80px; }
    .jadwal-section {
        background: #f7f8fc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px;
        margin-bottom: 14px;
    }
    .jadwal-section-title {
        font-size: 0.83rem;
        font-weight: 700;
        color: #5b21b6;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .jadwal-item { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
    .jadwal-item:last-child { margin-bottom: 0; }
    .jadwal-num {
        width: 22px; height: 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .jadwal-item select { flex: 1; }
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
    }
    .btn-cancel {
        padding: 9px 18px;
        border-radius: 7px;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.15s;
    }
    .btn-cancel:hover { background: #f3f4f6; }
    .btn-save {
        padding: 9px 22px;
        border-radius: 7px;
        border: none;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.15s;
    }
    .btn-save:hover { opacity: 0.9; }
    .btn-danger {
        padding: 9px 22px;
        border-radius: 7px;
        border: none;
        background: linear-gradient(135deg, #fc8181, #e53e3e);
        color: white;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    .btn-danger:hover { opacity: 0.88; }
    .empty-state { text-align: center; padding: 48px 20px; color: #a0aec0; }
    .empty-state .icon { font-size: 2.5rem; margin-bottom: 10px; }
</style>

<?php
$hariOrder    = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
$jadwalByHari = [];
foreach ($jadwal as $j) { $jadwalByHari[$j['hari']][] = $j; }

$jadwalOptions = '<option value="">— Pilih Jadwal —</option>';
foreach ($hariOrder as $hari) {
    if (!isset($jadwalByHari[$hari])) continue;
    $jadwalOptions .= '<optgroup label="' . $hari . '">';
    foreach ($jadwalByHari[$hari] as $j) {
        $lbl = $hari . ' ' . substr($j['jam_mulai'],0,5) . '–' . substr($j['jam_selesai'],0,5);
        $jadwalOptions .= '<option value="' . $j['jadwal_id'] . '">' . esc($lbl) . '</option>';
    }
    $jadwalOptions .= '</optgroup>';
}

$countTotal = count($program);
$countSD    = count(array_filter($program, fn($p) => $p['tingkat'] === 'SD'));
$countSMP   = count(array_filter($program, fn($p) => $p['tingkat'] === 'SMP'));
$countSMA   = count(array_filter($program, fn($p) => $p['tingkat'] === 'SMA'));
?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-msg flash-success">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-msg flash-error">❌ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="page-header">
    <h1>📚 Program Bimbel</h1>
    <button class="btn-add" onclick="openModal('modal-add')">+ Tambah Program</button>
</div>

<div class="stats-row">
    <div class="stat-card"><div class="num"><?= $countTotal ?></div><div class="lbl">Total Program</div></div>
    <div class="stat-card"><div class="num"><?= $countSD ?></div><div class="lbl">Program SD</div></div>
    <div class="stat-card"><div class="num"><?= $countSMP ?></div><div class="lbl">Program SMP</div></div>
    <div class="stat-card"><div class="num"><?= $countSMA ?></div><div class="lbl">Program SMA</div></div>
</div>

<div class="tbl-card">
    <div class="tbl-card-header">�� Daftar Program</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Program</th>
                <th>Tingkat</th>
                <th>Kelas</th>
                <th>Durasi</th>
                <th>Harga / Bulan</th>
                <th>Jadwal (3x/minggu)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($program) > 0): ?>
                <?php foreach ($program as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <strong><?= esc($p['nama_program']) ?></strong>
                            <?php if (!empty($p['keterangan'])): ?>
                                <div style="font-size:0.75rem;color:#718096;margin-top:2px;"><?= esc(mb_strimwidth($p['keterangan'], 0, 50, '…')) ?></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php $tc = match($p['tingkat']) { 'SD'=>'badge-sd','SMP'=>'badge-smp','SMA'=>'badge-sma',default=>'' }; ?>
                            <span class="badge-tingkat <?= $tc ?>"><?= esc($p['tingkat']) ?></span>
                        </td>
                        <td><?= esc($p['kelas']) ?></td>
                        <td><?= esc($p['durasi']) ?></td>
                        <td>Rp <?= number_format((float)$p['harga'], 0, ',', '.') ?></td>
                        <td>
                            <?php if (!empty($p['jadwal'])): ?>
                                <div class="jadwal-pills">
                                    <?php foreach ($p['jadwal'] as $js): ?>
                                        <span class="jadwal-pill">
                                            <span class="dot"></span>
                                            <?= esc($js['hari']) ?> <?= substr($js['jam_mulai'],0,5) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <span class="no-jadwal">Belum diatur</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn-icon btn-edit"
                                    onclick="openEditModal(
                                        <?= $p['program_id'] ?>,
                                        <?= htmlspecialchars(json_encode($p['nama_program']), ENT_QUOTES) ?>,
                                        <?= htmlspecialchars(json_encode($p['durasi']), ENT_QUOTES) ?>,
                                        <?= htmlspecialchars(json_encode($p['tingkat']), ENT_QUOTES) ?>,
                                        <?= htmlspecialchars(json_encode($p['kelas']), ENT_QUOTES) ?>,
                                        <?= (int)$p['harga'] ?>,
                                        <?= htmlspecialchars(json_encode($p['keterangan'] ?? ''), ENT_QUOTES) ?>,
                                        <?= htmlspecialchars(json_encode(array_column($p['jadwal'], 'jadwal_id')), ENT_QUOTES) ?>
                                    )" title="Edit">✏️</button>
                                <button class="btn-icon btn-del"
                                    onclick="openDeleteModal(<?= $p['program_id'] ?>, <?= htmlspecialchars(json_encode($p['nama_program']), ENT_QUOTES) ?>)"
                                    title="Hapus">🗑️</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">
                    <div class="empty-state">
                        <div class="icon">📚</div>
                        <div>Belum ada program bimbel. Klik <strong>Tambah Program</strong> untuk memulai.</div>
                    </div>
                </td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ADD MODAL -->
<div id="modal-add" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <h3>➕ Tambah Program Bimbel</h3>
            <button class="modal-close" onclick="closeModal('modal-add')">✕</button>
        </div>
        <div class="modal-body">
            <form action="<?= base_url('program/add') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Nama Program <span style="color:#e53e3e">*</span></label>
                    <input type="text" name="program" class="form-control" placeholder="contoh: Bimbel SMA Kelas 10" value="<?= old('program') ?>" required>
                </div>
                <div class="form-row col3">
                    <div class="form-group">
                        <label>Tingkat <span style="color:#e53e3e">*</span></label>
                        <select name="tingkat" class="form-select" required>
                            <option value="">— Pilih —</option>
                            <option value="SD"  <?= old('tingkat')==='SD'  ? 'selected':'' ?>>SD</option>
                            <option value="SMP" <?= old('tingkat')==='SMP' ? 'selected':'' ?>>SMP</option>
                            <option value="SMA" <?= old('tingkat')==='SMA' ? 'selected':'' ?>>SMA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas <span style="color:#e53e3e">*</span></label>
                        <input type="text" name="kelas" class="form-control" placeholder="contoh: 10" value="<?= old('kelas') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Durasi <span style="color:#e53e3e">*</span></label>
                        <input type="text" name="durasi" class="form-control" placeholder="contoh: 1 Bulan" value="<?= old('durasi') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga / Bulan (Rp) <span style="color:#e53e3e">*</span></label>
                    <input type="number" name="harga" class="form-control" placeholder="contoh: 250000" value="<?= old('harga') ?>" min="0" required>
                </div>
                <div class="jadwal-section">
                    <div class="jadwal-section-title">📅 Jadwal Pertemuan (maks. 3x/minggu)</div>
                    <div class="jadwal-item"><div class="jadwal-num">1</div><select name="jadwal_id[]" class="form-select"><?= $jadwalOptions ?></select></div>
                    <div class="jadwal-item"><div class="jadwal-num">2</div><select name="jadwal_id[]" class="form-select"><?= $jadwalOptions ?></select></div>
                    <div class="jadwal-item"><div class="jadwal-num">3</div><select name="jadwal_id[]" class="form-select"><?= $jadwalOptions ?></select></div>
                    <small style="color:#718096;font-size:0.78rem;">Boleh dikosongkan jika belum ditentukan.</small>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Deskripsi singkat program..."><?= old('keterangan') ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modal-add')">Batal</button>
                    <button type="submit" class="btn-save">💾 Simpan Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="modal-edit" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <h3>✏️ Edit Program Bimbel</h3>
            <button class="modal-close" onclick="closeModal('modal-edit')">✕</button>
        </div>
        <div class="modal-body">
            <form id="form-edit" action="" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Nama Program <span style="color:#e53e3e">*</span></label>
                    <input type="text" id="edit-program" name="program" class="form-control" required>
                </div>
                <div class="form-row col3">
                    <div class="form-group">
                        <label>Tingkat <span style="color:#e53e3e">*</span></label>
                        <select id="edit-tingkat" name="tingkat" class="form-select" required>
                            <option value="">— Pilih —</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas <span style="color:#e53e3e">*</span></label>
                        <input type="text" id="edit-kelas" name="kelas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Durasi <span style="color:#e53e3e">*</span></label>
                        <input type="text" id="edit-durasi" name="durasi" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga / Bulan (Rp) <span style="color:#e53e3e">*</span></label>
                    <input type="number" id="edit-harga" name="harga" class="form-control" min="0" required>
                </div>
                <div class="jadwal-section">
                    <div class="jadwal-section-title">📅 Jadwal Pertemuan (maks. 3x/minggu)</div>
                    <div class="jadwal-item"><div class="jadwal-num">1</div><select id="edit-jadwal-1" name="jadwal_id[]" class="form-select"><?= $jadwalOptions ?></select></div>
                    <div class="jadwal-item"><div class="jadwal-num">2</div><select id="edit-jadwal-2" name="jadwal_id[]" class="form-select"><?= $jadwalOptions ?></select></div>
                    <div class="jadwal-item"><div class="jadwal-num">3</div><select id="edit-jadwal-3" name="jadwal_id[]" class="form-select"><?= $jadwalOptions ?></select></div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea id="edit-keterangan" name="keterangan" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modal-edit')">Batal</button>
                    <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="modal-delete" class="modal-overlay">
    <div class="modal-box modal-sm">
        <div class="modal-head" style="background:linear-gradient(135deg,#fc8181,#e53e3e);">
            <h3>🗑️ Hapus Program</h3>
            <button class="modal-close" onclick="closeModal('modal-delete')">✕</button>
        </div>
        <div class="modal-body">
            <p style="color:#4a5568;margin:0 0 8px;">Apakah Anda yakin ingin menghapus program:</p>
            <p id="delete-program-name" style="font-weight:700;color:#2d3748;font-size:1rem;margin:0 0 12px;"></p>
            <p style="font-size:0.82rem;color:#718096;margin:0;">Semua jadwal yang terhubung dengan program ini akan ikut dihapus.</p>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-delete')">Batal</button>
                <a id="delete-confirm-btn" href="#" class="btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
        document.body.style.overflow = '';
    }
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(function(m) { closeModal(m.id); });
        }
    });
    function openEditModal(id, nama, durasi, tingkat, kelas, harga, keterangan, jadwalIds) {
        document.getElementById('edit-program').value    = nama;
        document.getElementById('edit-durasi').value     = durasi;
        document.getElementById('edit-kelas').value      = kelas;
        document.getElementById('edit-harga').value      = harga;
        document.getElementById('edit-keterangan').value = keterangan;
        var tingkatSel = document.getElementById('edit-tingkat');
        for (var i = 0; i < tingkatSel.options.length; i++) {
            tingkatSel.options[i].selected = (tingkatSel.options[i].value === tingkat);
        }
        for (var n = 1; n <= 3; n++) {
            var sel = document.getElementById('edit-jadwal-' + n);
            var val = jadwalIds[n - 1] !== undefined ? String(jadwalIds[n - 1]) : '';
            sel.value = val;
        }
        document.getElementById('form-edit').action = '<?= base_url('program/update/') ?>' + id;
        openModal('modal-edit');
    }
    function openDeleteModal(id, nama) {
        document.getElementById('delete-program-name').textContent = '"' + nama + '"';
        document.getElementById('delete-confirm-btn').href = '<?= base_url('program/delete/') ?>' + id;
        openModal('modal-delete');
    }
    setTimeout(function() {
        document.querySelectorAll('.flash-msg').forEach(function(el) {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(function() { el.remove(); }, 500);
        });
    }, 5000);
</script>

<?= $this->endSection() ?>
