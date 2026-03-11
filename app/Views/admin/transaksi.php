<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<style>
    .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .page-header h1 { font-size:1.6rem; font-weight:700; color:#1a202c; margin:0; }
    .btn-add { display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg,#667eea,#764ba2); color:white; border:none; border-radius:8px; padding:10px 20px; font-size:.9rem; font-weight:600; cursor:pointer; transition:all .2s; box-shadow:0 2px 8px rgba(102,126,234,.35); }
    .btn-add:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(102,126,234,.45); }

    .stats-row { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:16px; margin-bottom:28px; }
    .stat-card { background:white; border-radius:10px; padding:16px 20px; box-shadow:0 2px 10px rgba(0,0,0,.06); border:1px solid #e2e8f0; text-align:center; }
    .stat-card .num { font-size:1.8rem; font-weight:700; color:#667eea; }
    .stat-card .lbl { font-size:.8rem; color:#718096; margin-top:2px; }

    .search-bar { position:relative; margin-bottom:20px; }
    .search-bar input { width:100%; padding:10px 16px 10px 40px; border:1px solid #e2e8f0; border-radius:8px; font-size:.9rem; outline:none; box-sizing:border-box; background:white; transition:border-color .2s; }
    .search-bar input:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15); }
    .search-bar::before { content:"🔍"; position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:.85rem; }

    .tbl-card { background:white; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.06); border:1px solid #e2e8f0; overflow:hidden; }
    .tbl-card-header { background:linear-gradient(135deg,#667eea,#764ba2); color:white; padding:16px 20px; font-weight:600; font-size:1rem; }
    .tbl-card table { width:100%; border-collapse:collapse; }
    .tbl-card th { background:#f7f8fc; color:#4a5568; font-size:.78rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em; padding:12px 14px; border-bottom:1px solid #e2e8f0; white-space:nowrap; }
    .tbl-card td { padding:12px 14px; border-bottom:1px solid #f0f4f8; font-size:.87rem; color:#2d3748; vertical-align:middle; }
    .tbl-card tr:last-child td { border-bottom:none; }
    .tbl-card tr:hover td { background:#f7f8fc; }

    /* Status pills */
    .pill { display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:12px; font-size:.75rem; font-weight:700; white-space:nowrap; }
    .pill-lunas   { background:#d1fae5; color:#065f46; }
    .pill-pending { background:#fef3c7; color:#92400e; }
    .pill-ditolak { background:#fee2e2; color:#7f1d1d; }

    /* Tingkat badge */
    .badge-tingkat { display:inline-block; padding:2px 8px; border-radius:10px; font-size:.72rem; font-weight:700; }
    .badge-sd  { background:#e6f4ea; color:#2e7d32; }
    .badge-smp { background:#e3f2fd; color:#1565c0; }
    .badge-sma { background:#fce4ec; color:#880e4f; }

    /* Inline status action buttons */
    .status-actions { display:flex; gap:5px; flex-wrap:wrap; }
    .btn-status { display:inline-flex; align-items:center; gap:3px; padding:4px 10px; border:none; border-radius:8px; font-size:.75rem; font-weight:700; cursor:pointer; transition:all .15s; white-space:nowrap; }
    .btn-lunas   { background:#d1fae5; color:#065f46; }
    .btn-lunas:hover   { background:#6ee7b7; }
    .btn-ditolak { background:#fee2e2; color:#7f1d1d; }
    .btn-ditolak:hover { background:#fca5a5; }
    .btn-pending { background:#fef3c7; color:#92400e; }
    .btn-pending:hover { background:#fcd34d; }

    /* Action group */
    .action-group { display:flex; gap:6px; }
    .btn-icon { width:30px; height:30px; border-radius:6px; border:none; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; font-size:.82rem; transition:all .15s; }
    .btn-edit  { background:#ebf4ff; color:#2b6cb0; }
    .btn-del   { background:#fff5f5; color:#c53030; }
    .btn-bukti { background:#f0fdf4; color:#065f46; }
    .btn-edit:hover  { background:#bee3f8; }
    .btn-del:hover   { background:#fed7d7; }
    .btn-bukti:hover { background:#bbf7d0; }

    /* Flash */
    .flash-msg { padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:.9rem; font-weight:500; display:flex; align-items:center; gap:8px; }
    .flash-success { background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; }
    .flash-error   { background:#fff1f2; color:#9b1c1c; border:1px solid #fecdd3; }

    /* Modal */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1000; align-items:center; justify-content:center; padding:16px; }
    .modal-overlay.active { display:flex; }
    .modal-box { background:white; border-radius:14px; box-shadow:0 10px 40px rgba(0,0,0,.18); width:100%; max-width:540px; max-height:92vh; overflow-y:auto; animation:modalIn .2s ease; }
    .modal-box.sm { max-width:420px; }
    @keyframes modalIn { from{transform:translateY(-16px);opacity:0} to{transform:translateY(0);opacity:1} }
    .modal-head { background:linear-gradient(135deg,#667eea,#764ba2); color:white; padding:18px 22px; border-radius:14px 14px 0 0; display:flex; justify-content:space-between; align-items:center; position:sticky; top:0; z-index:1; }
    .modal-head.red { background:linear-gradient(135deg,#fc8181,#e53e3e); }
    .modal-head h3 { margin:0; font-size:1.05rem; font-weight:700; }
    .modal-close { background:rgba(255,255,255,.2); border:none; color:white; width:28px; height:28px; border-radius:50%; font-size:1rem; cursor:pointer; display:flex; align-items:center; justify-content:center; }
    .modal-close:hover { background:rgba(255,255,255,.35); }
    .modal-body { padding:22px; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:.82rem; font-weight:600; color:#4a5568; margin-bottom:5px; }
    .form-control, .form-select { width:100%; padding:9px 12px; border:1px solid #d1d5db; border-radius:7px; font-size:.88rem; color:#374151; background:white; box-sizing:border-box; transition:border-color .2s,box-shadow .2s; outline:none; }
    .form-control:focus, .form-select:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15); }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; padding-top:16px; border-top:1px solid #e2e8f0; }
    .btn-cancel { padding:9px 18px; border-radius:7px; border:1px solid #d1d5db; background:white; color:#374151; font-size:.88rem; font-weight:600; cursor:pointer; }
    .btn-save   { padding:9px 22px; border-radius:7px; border:none; background:linear-gradient(135deg,#667eea,#764ba2); color:white; font-size:.88rem; font-weight:600; cursor:pointer; }
    .btn-danger { padding:9px 22px; border-radius:7px; border:none; background:linear-gradient(135deg,#fc8181,#e53e3e); color:white; font-size:.88rem; font-weight:600; cursor:pointer; text-decoration:none; display:inline-block; }

    .proof-thumb { width:52px; height:40px; object-fit:cover; border-radius:6px; border:1px solid #e2e8f0; cursor:pointer; vertical-align:middle; }
    .proof-thumb:hover { border-color:#667eea; }
    .no-proof { color:#cbd5e0; font-size:.8rem; }

    .empty-state { text-align:center; padding:48px; color:#a0aec0; }
    .empty-state .icon { font-size:2.5rem; margin-bottom:10px; }
</style>

<?php
$totalAll     = count($transaksi);
$totalLunas   = count(array_filter($transaksi, fn($r) => $r['status'] === 'lunas'));
$totalPending = count(array_filter($transaksi, fn($r) => $r['status'] === 'pending'));
$totalDitolak = count(array_filter($transaksi, fn($r) => $r['status'] === 'ditolak'));
?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-msg flash-success">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-msg flash-error">❌ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="page-header">
    <h1>💳 Daftar Transaksi</h1>
    <button class="btn-add" onclick="openModal('modal-add')">+ Tambah Pembayaran</button>
</div>

<div class="stats-row">
    <div class="stat-card"><div class="num"><?= $totalAll ?></div><div class="lbl">Total</div></div>
    <div class="stat-card"><div class="num" style="color:#065f46"><?= $totalLunas ?></div><div class="lbl">Lunas</div></div>
    <div class="stat-card"><div class="num" style="color:#92400e"><?= $totalPending ?></div><div class="lbl">Pending</div></div>
    <div class="stat-card"><div class="num" style="color:#7f1d1d"><?= $totalDitolak ?></div><div class="lbl">Ditolak</div></div>
</div>

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Cari nama siswa, program, status…" oninput="filterTable(this.value)">
</div>

<div class="tbl-card">
    <div class="tbl-card-header">📋 Data Transaksi</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Siswa</th>
                <th>Program</th>
                <th>Pengajar</th>
                <th>Tagihan</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Ubah Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="transaksiBody">
            <?php if (empty($transaksi)): ?>
                <tr><td colspan="9">
                    <div class="empty-state"><div class="icon">💳</div><div>Belum ada transaksi.</div></div>
                </td></tr>
            <?php else: ?>
                <?php foreach ($transaksi as $i => $row): ?>
                    <tr data-search="<?= strtolower($row['nama'] . ' ' . $row['nama_program'] . ' ' . $row['status']) ?>">
                        <td><?= $i + 1 ?></td>
                        <td>
                            <strong><?= esc($row['nama']) ?></strong><br>
                            <?php if (!empty($row['tingkat'])): ?>
                                <?php $tc = match($row['tingkat']) { 'SD'=>'badge-sd','SMP'=>'badge-smp','SMA'=>'badge-sma',default=>'' }; ?>
                                <span class="badge-tingkat <?= $tc ?>"><?= $row['tingkat'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= esc($row['nama_program']) ?>
                            <small style="display:block;color:#718096;">Kelas <?= esc($row['kelas']) ?></small>
                        </td>
                        <td>
                            <?php if (!empty($row['nama_pengajar'])): ?>
                                <span style="color:#2d3748;font-weight:600;"><?= esc($row['nama_pengajar']) ?></span>
                            <?php else: ?>
                                <span style="color:#f59e0b;font-size:.78rem;">⏳ Belum assigned</span>
                            <?php endif; ?>
                        </td>
                        <td>Rp <?= number_format($row['tagihan'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($row['photo_bukti']): ?>
                                <img src="<?= base_url('uploads/bukti_pembayaran/' . $row['photo_bukti']) ?>"
                                    class="proof-thumb"
                                    onclick="openBuktiModal('<?= base_url('uploads/bukti_pembayaran/' . $row['photo_bukti']) ?>', '<?= esc($row['nama'], 'js') ?>')"
                                    alt="Bukti">
                            <?php else: ?>
                                <span class="no-proof">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $pillClass = match($row['status']) { 'lunas'=>'pill-lunas','pending'=>'pill-pending',default=>'pill-ditolak' };
                            $pillIcon  = match($row['status']) { 'lunas'=>'✅','pending'=>'⏳',default=>'❌' };
                            $pillLabel = match($row['status']) { 'lunas'=>'Lunas','pending'=>'Pending',default=>'Ditolak' };
                            ?>
                            <span class="pill <?= $pillClass ?>"><?= $pillIcon ?> <?= $pillLabel ?></span>
                        </td>
                        <td>
                            <?php if ($row['status'] === 'lunas'): ?>
                                <span style="color:#a0aec0;font-size:.78rem;">—</span>
                            <?php else: ?>
                                <div class="status-actions">
                                    <form method="post" action="<?= base_url('transaksi/status/' . $row['transaksi_id']) ?>" style="display:inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="lunas">
                                        <button type="submit" class="btn-status btn-lunas" title="Konfirmasi Lunas">✅ Lunas</button>
                                    </form>
                                    <?php if ($row['status'] !== 'ditolak'): ?>
                                        <form method="post" action="<?= base_url('transaksi/status/' . $row['transaksi_id']) ?>" style="display:inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn-status btn-ditolak" title="Tolak Pembayaran">❌ Tolak</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($row['status'] !== 'pending'): ?>
                                        <form method="post" action="<?= base_url('transaksi/status/' . $row['transaksi_id']) ?>" style="display:inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="btn-status btn-pending" title="Reset ke Pending">⏳ Pending</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn-icon btn-edit" title="Edit Detail"
                                    onclick="openEditModal(
                                        <?= $row['transaksi_id'] ?>,
                                        <?= (int)$row['user_id'] ?>,
                                        <?= (int)$row['program_id'] ?>,
                                        <?= (float)$row['tagihan'] ?>,
                                        '<?= esc($row['status'], 'js') ?>'
                                    )">✏️</button>
                                <button class="btn-icon btn-del" title="Hapus"
                                    onclick="openDeleteModal(<?= $row['transaksi_id'] ?>, '<?= esc($row['nama'], 'js') ?>')">🗑️</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Jadwal per program as JSON for JS -->
<?php
$pjJson = [];
foreach ($program as $p) {
    $pid = $p['program_id'];
    $pjJson[$pid] = [
        'harga'  => (int)$p['harga'],
        'jadwal' => isset($programJadwal[$pid]) ? implode(', ', $programJadwal[$pid]) : 'Jadwal belum diatur',
    ];
}
?>
<script>
const programData = <?= json_encode($pjJson) ?>;
</script>

<!-- ADD MODAL -->
<div id="modal-add" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head"><h3>➕ Tambah Pembayaran</h3><button class="modal-close" onclick="closeModal('modal-add')">✕</button></div>
        <div class="modal-body">
            <form action="<?= base_url('transaksi/add') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Nama Siswa <span style="color:#e53e3e">*</span></label>
                    <select name="user_id" class="form-select" required>
                        <option value="">— Pilih Siswa —</option>
                        <?php foreach ($siswa as $s): ?>
                            <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?> - <?= esc($s['nomor_hp']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Program Bimbel <span style="color:#e53e3e">*</span></label>
                    <select name="program_id" id="add-program-sel" class="form-select" required>
                        <option value="">— Pilih Program —</option>
                        <?php foreach ($program as $p): ?>
                            <option value="<?= $p['program_id'] ?>">
                                <?= esc($p['nama_program']) ?> - <?= $p['tingkat'] ?> Kelas <?= $p['kelas'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group" id="add-jadwal-info" style="display:none">
                    <label>Jadwal Program</label>
                    <div id="add-jadwal-text" style="padding:8px 12px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;font-size:.85rem;color:#065f46;font-weight:600;">—</div>
                </div>
                <div class="form-group">
                    <label>Tagihan (Rp)</label>
                    <input type="number" id="add-tagihan" name="tagihan" class="form-control" placeholder="Otomatis dari program">
                </div>
                <div class="form-group">
                    <label>Bukti Pembayaran</label>
                    <input type="file" name="photo_bukti" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Status <span style="color:#e53e3e">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="pending">⏳ Pending</option>
                        <option value="lunas">✅ Lunas</option>
                        <option value="ditolak">❌ Ditolak</option>
                    </select>
                </div>
                <p style="font-size:.78rem;color:#718096;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;padding:8px 12px;">
                    ℹ️ Saat status <strong>Lunas</strong>, pengajar akan otomatis di-assign ke siswa berdasarkan jadwal program.
                </p>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('modal-add')">Batal</button>
                    <button type="submit" class="btn-save">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="modal-edit" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head"><h3>✏️ Edit Transaksi</h3><button class="modal-close" onclick="closeModal('modal-edit')">✕</button></div>
        <div class="modal-body">
            <form id="form-edit" action="" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <select id="edit-user" name="user_id" class="form-select" required>
                        <option value="">— Pilih Siswa —</option>
                        <?php foreach ($siswa as $s): ?>
                            <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?> - <?= esc($s['nomor_hp']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Program Bimbel</label>
                    <select id="edit-program" name="program_id" class="form-select" required onchange="onEditProgramChange(this)">
                        <option value="">— Pilih Program —</option>
                        <?php foreach ($program as $p): ?>
                            <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> - <?= $p['tingkat'] ?> Kelas <?= $p['kelas'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jadwal Program</label>
                    <div id="edit-jadwal-info" style="padding:8px 12px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:7px;font-size:.85rem;color:#065f46;font-weight:600;">—</div>
                    <small style="color:#718096;">Jadwal diambil otomatis dari program yang dipilih.</small>
                </div>
                <div class="form-group">
                    <label>Tagihan (Rp)</label>
                    <input type="number" id="edit-tagihan" name="tagihan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Ganti Bukti Pembayaran <small style="color:#718096">(kosongkan jika tidak diubah)</small></label>
                    <input type="file" name="photo_bukti" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="edit-status" name="status" class="form-select" required>
                        <option value="pending">⏳ Pending</option>
                        <option value="lunas">✅ Lunas</option>
                        <option value="ditolak">❌ Ditolak</option>
                    </select>
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
    <div class="modal-box sm">
        <div class="modal-head red"><h3>🗑️ Hapus Transaksi</h3><button class="modal-close" onclick="closeModal('modal-delete')">✕</button></div>
        <div class="modal-body">
            <p style="color:#4a5568;margin:0 0 6px;">Hapus transaksi milik:</p>
            <p id="delete-name" style="font-weight:700;color:#2d3748;font-size:1rem;margin:0 0 10px;"></p>
            <p style="font-size:.82rem;color:#718096;">Tindakan ini tidak bisa dibatalkan.</p>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('modal-delete')">Batal</button>
                <a id="delete-confirm" href="#" class="btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- BUKTI MODAL -->
<div id="modal-bukti" class="modal-overlay">
    <div class="modal-box sm">
        <div class="modal-head"><h3 id="bukti-title">Bukti Pembayaran</h3><button class="modal-close" onclick="closeModal('modal-bukti')">✕</button></div>
        <div class="modal-body" style="text-align:center;padding:16px;">
            <img id="bukti-img" src="" alt="Bukti" style="max-width:100%;border-radius:8px;border:1px solid #e2e8f0;">
        </div>
    </div>
</div>

<script>
    function openModal(id)  { document.getElementById(id).classList.add('active'); document.body.style.overflow='hidden'; }
    function closeModal(id) { document.getElementById(id).classList.remove('active'); document.body.style.overflow=''; }
    document.querySelectorAll('.modal-overlay').forEach(function(o) {
        o.addEventListener('click', function(e) { if (e.target===this) closeModal(this.id); });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key==='Escape') document.querySelectorAll('.modal-overlay.active').forEach(function(m){ closeModal(m.id); });
    });

    // Add modal: auto-fill tagihan + show jadwal from program
    document.getElementById('add-program-sel').addEventListener('change', function() {
        const pid = this.value;
        const info = programData[pid];
        if (info) {
            document.getElementById('add-tagihan').value = info.harga || '';
            document.getElementById('add-jadwal-text').textContent = info.jadwal;
            document.getElementById('add-jadwal-info').style.display = '';
        } else {
            document.getElementById('add-tagihan').value = '';
            document.getElementById('add-jadwal-info').style.display = 'none';
        }
    });

    function onEditProgramChange(sel) {
        const pid = sel.value;
        const info = programData[pid];
        document.getElementById('edit-jadwal-info').textContent = info ? info.jadwal : '—';
    }

    function openEditModal(id, userId, programId, tagihan, status) {
        document.getElementById('form-edit').action = '<?= base_url('transaksi/update/') ?>' + id;
        document.getElementById('edit-user').value    = userId;
        document.getElementById('edit-program').value = programId;
        document.getElementById('edit-tagihan').value = tagihan;
        document.getElementById('edit-status').value  = status;
        // Show jadwal info for current program
        const info = programData[programId];
        document.getElementById('edit-jadwal-info').textContent = info ? info.jadwal : '—';
        openModal('modal-edit');
    }

    function openDeleteModal(id, nama) {
        document.getElementById('delete-name').textContent = nama;
        document.getElementById('delete-confirm').href = '<?= base_url('transaksi/delete/') ?>' + id;
        openModal('modal-delete');
    }

    function openBuktiModal(url, nama) {
        document.getElementById('bukti-img').src   = url;
        document.getElementById('bukti-title').textContent = 'Bukti — ' + nama;
        openModal('modal-bukti');
    }

    function filterTable(q) {
        q = q.toLowerCase().trim();
        document.querySelectorAll('#transaksiBody tr').forEach(function(row) {
            row.style.display = (!q || (row.dataset.search || '').includes(q)) ? '' : 'none';
        });
    }

    setTimeout(function() {
        document.querySelectorAll('.flash-msg').forEach(function(el) {
            el.style.transition = 'opacity .5s';
            el.style.opacity = '0';
            setTimeout(function(){ el.remove(); }, 500);
        });
    }, 5000);
</script>

<?= $this->endSection() ?>
