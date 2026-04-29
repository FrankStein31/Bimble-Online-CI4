<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<style>
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
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
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

    .search-bar { position: relative; margin-bottom: 20px; }
    .search-bar input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        outline: none;
        box-sizing: border-box;
        background: white;
        transition: border-color 0.2s;
    }
    .search-bar input:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.15); }
    .search-bar::before {
        content: "🔍";
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.85rem;
    }

    .day-group {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .day-group-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        cursor: pointer;
        user-select: none;
    }
    .day-group-header .day-label { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 0.95rem; }
    .day-badge { background: rgba(255,255,255,0.25); border-radius: 20px; padding: 2px 10px; font-size: 0.8rem; }
    .chevron { transition: transform 0.25s; font-size: 0.8rem; }
    .chevron.open { transform: rotate(180deg); }
    .day-group-body { overflow: hidden; transition: max-height 0.3s ease; }

    .schedule-table { width: 100%; border-collapse: collapse; }
    .schedule-table thead th {
        background: #f8fafc;
        padding: 10px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    .schedule-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.15s; }
    .schedule-table tbody tr:last-child { border-bottom: none; }
    .schedule-table tbody tr:hover { background: #f8fafc; }
    .schedule-table td { padding: 12px 16px; font-size: 0.9rem; color: #4a5568; vertical-align: middle; }

    .time-range { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; color: #2d3748; font-size: 0.95rem; }
    .time-range .sep { color: #a0aec0; font-size: 0.8rem; }
    .duration-badge { background: #ebf4ff; color: #2b6cb0; border-radius: 20px; padding: 2px 10px; font-size: 0.78rem; font-weight: 600; }

    .action-group { display: flex; gap: 6px; }
    .btn-icon {
        width: 32px; height: 32px;
        border-radius: 6px; border: none; cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.85rem; transition: all 0.15s;
    }
    .btn-icon.edit { background: #ebf8ff; color: #2b6cb0; }
    .btn-icon.del  { background: #fff5f5; color: #c53030; }
    .btn-icon.edit:hover { background: #bee3f8; }
    .btn-icon.del:hover  { background: #fed7d7; }

    .empty-state { text-align: center; padding: 60px 20px; color: #718096; }
    .empty-state .icon { font-size: 3rem; margin-bottom: 12px; }

    .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 500; }
    .alert-success { background: #f0fff4; color: #276749; border-left: 4px solid #48bb78; }
    .alert-error   { background: #fff5f5; color: #c53030; border-left: 4px solid #fc8181; }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 200;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: white;
        border-radius: 14px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 460px;
        overflow: hidden;
        animation: slideUp 0.25s ease;
    }
    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }
    .modal-head {
        display: flex; justify-content: space-between; align-items: center;
        padding: 18px 22px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    .modal-head h3 { margin: 0; font-size: 1rem; font-weight: 600; }
    .modal-close {
        background: rgba(255,255,255,0.2); border: none; color: white;
        width: 28px; height: 28px; border-radius: 50%; cursor: pointer;
        font-size: 1rem; display: flex; align-items: center; justify-content: center;
    }
    .modal-close:hover { background: rgba(255,255,255,0.35); }
    .modal-body { padding: 22px; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #4a5568; margin-bottom: 6px; }
    .form-group label .req { color: #e53e3e; }
    .form-control, .form-select {
        width: 100%; padding: 10px 12px;
        border: 1px solid #e2e8f0; border-radius: 8px;
        font-size: 0.9rem; color: #2d3748; background: white;
        box-sizing: border-box; outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
    }
    .time-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .modal-foot { padding: 14px 22px 20px; display: flex; justify-content: flex-end; gap: 10px; }
    .btn-cancel {
        padding: 9px 18px; border: 1px solid #e2e8f0; border-radius: 8px;
        background: white; color: #4a5568; font-size: 0.9rem; font-weight: 600; cursor: pointer;
    }
    .btn-save {
        padding: 9px 18px; border: none; border-radius: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white; font-size: 0.9rem; font-weight: 600; cursor: pointer;
    }
    .btn-save:hover { opacity: 0.9; }
    .delete-icon { text-align: center; font-size: 3rem; margin-bottom: 10px; }
    .delete-info { text-align: center; padding: 0 10px; }
    .delete-info p { color: #4a5568; font-size: 0.95rem; margin: 0; }

    @media (max-width: 600px) {
        .time-row { grid-template-columns: 1fr; }
        .page-header { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="page-header">
    <h1>📅 Jadwal Bimbel</h1>
    <button class="btn-add" onclick="openAddModal()">＋ Tambah Jadwal</button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error">❌ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?php
    $hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    $grouped   = array_fill_keys($hariOrder, []);
    foreach ($jadwal as $j) {
        $h = ucfirst(strtolower($j['hari']));
        if (isset($grouped[$h])) $grouped[$h][] = $j;
    }
    $totalJadwal = count($jadwal);
    $hariAktif   = count(array_filter($grouped, fn($v) => count($v) > 0));
    $maxCount = 0; $hariTerbanyak = '-';
    foreach ($grouped as $h => $slots) {
        if (count($slots) > $maxCount) { $maxCount = count($slots); $hariTerbanyak = $h; }
    }
?>

<div class="stats-row">
    <div class="stat-card">
        <div class="num"><?= $totalJadwal ?></div>
        <div class="lbl">Total Slot</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $hariAktif ?></div>
        <div class="lbl">Hari Aktif</div>
    </div>
    <!-- <div class="stat-card">
        <div class="num"><?= $maxCount ?></div>
        <div class="lbl">Slot Terbanyak<br><small><?= $hariTerbanyak ?></small></div>
    </div> -->
    <!-- <div class="stat-card">
        <div class="num"><?= 7 - $hariAktif ?></div>
        <div class="lbl">Hari Libur</div>
    </div> -->
</div>

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Cari hari atau jam… (contoh: Senin, 08:00)" oninput="filterJadwal(this.value)">
</div>

<?php if (empty($jadwal)): ?>
    <div class="empty-state">
        <div class="icon">📭</div>
        <p>Belum ada jadwal. Klik <strong>Tambah Jadwal</strong> untuk memulai.</p>
    </div>
<?php else: ?>
    <?php foreach ($hariOrder as $hari): ?>
        <?php if (empty($grouped[$hari])) continue; ?>
        <?php usort($grouped[$hari], fn($a,$b) => strcmp($a['jam_mulai'], $b['jam_mulai'])); ?>
        <div class="day-group" data-day="<?= strtolower($hari) ?>">
            <div class="day-group-header" onclick="toggleDay(this)">
                <div class="day-label">
                    <span>📆</span>
                    <span><?= $hari ?></span>
                    <span class="day-badge"><?= count($grouped[$hari]) ?> slot</span>
                </div>
                <span class="chevron open">▼</span>
            </div>
            <div class="day-group-body">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Durasi</th>
                            <th style="width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grouped[$hari] as $j): ?>
                            <?php
                                $mulai   = substr($j['jam_mulai'], 0, 5);
                                $selesai = substr($j['jam_selesai'], 0, 5);
                                $menit   = (strtotime($j['jam_selesai']) - strtotime($j['jam_mulai'])) / 60;
                                if ($menit < 0) $menit += 1440;
                                $durStr  = ($menit >= 60 ? floor($menit/60).'j ' : '') . ($menit%60 ? ($menit%60).'m' : '');
                            ?>
                            <tr class="jadwal-row" data-search="<?= strtolower($hari.' '.$mulai.' '.$selesai) ?>">
                                <td>
                                    <span class="time-range">
                                        🕐 <?= $mulai ?> <span class="sep">→</span> <?= $selesai ?> <span style="color:#a0aec0;font-weight:400;font-size:0.8rem;">WIB</span>
                                    </span>
                                </td>
                                <td><span class="duration-badge">⏱ <?= trim($durStr) ?></span></td>
                                <td>
                                    <div class="action-group">
                                        <button class="btn-icon edit" title="Edit"
                                            onclick="openEditModal(<?= $j['jadwal_id'] ?>, '<?= $j['hari'] ?>', '<?= $mulai ?>', '<?= $selesai ?>')">✏️</button>
                                        <button class="btn-icon del" title="Hapus"
                                            onclick="openDeleteModal(<?= $j['jadwal_id'] ?>, '<?= $hari ?>', '<?= $mulai ?>–<?= $selesai ?>')">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- MODAL TAMBAH -->
<div class="modal-overlay" id="modalAdd">
    <div class="modal-box">
        <div class="modal-head">
            <h3>➕ Tambah Jadwal</h3>
            <button class="modal-close" onclick="closeModal('modalAdd')">×</button>
        </div>
        <form action="<?= base_url('jadwal/add') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Hari <span class="req">*</span></label>
                    <select name="hari" class="form-select" required>
                        <option value="">— Pilih Hari —</option>
                        <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h): ?>
                            <option value="<?= $h ?>"><?= $h ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="time-row">
                    <div class="form-group">
                        <label>Jam Mulai <span class="req">*</span></label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai <span class="req">*</span></label>
                        <input type="time" name="jam_selesai" class="form-control" required>
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

<!-- MODAL EDIT -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <div class="modal-head">
            <h3>✏️ Edit Jadwal</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">×</button>
        </div>
        <form id="editForm" method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Hari <span class="req">*</span></label>
                    <select name="hari" id="edit_hari" class="form-select" required>
                        <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h): ?>
                            <option value="<?= $h ?>"><?= $h ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="time-row">
                    <div class="form-group">
                        <label>Jam Mulai <span class="req">*</span></label>
                        <input type="time" name="jam_mulai" id="edit_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai <span class="req">*</span></label>
                        <input type="time" name="jam_selesai" id="edit_selesai" class="form-control" required>
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

<!-- MODAL HAPUS -->
<div class="modal-overlay" id="modalDelete">
    <div class="modal-box" style="max-width:380px;">
        <div class="modal-head" style="background:linear-gradient(135deg,#e53e3e,#c53030);">
            <h3>🗑️ Konfirmasi Hapus</h3>
            <button class="modal-close" onclick="closeModal('modalDelete')">×</button>
        </div>
        <div class="modal-body">
            <div class="delete-icon">⚠️</div>
            <div class="delete-info">
                <p>Hapus jadwal <strong id="delete_label" style="color:#c53030;"></strong>?</p>
                <p style="font-size:0.82rem;color:#718096;margin-top:8px;">
                    Tindakan ini tidak bisa dibatalkan. Jadwal yang masih dipakai transaksi tidak boleh dihapus.
                </p>
            </div>
        </div>
        <div class="modal-foot">
            <button type="button" class="btn-cancel" onclick="closeModal('modalDelete')">Batal</button>
            <a id="deleteLink" href="#"
               style="background:linear-gradient(135deg,#e53e3e,#c53030);color:white;text-decoration:none;padding:9px 18px;border-radius:8px;font-size:.9rem;font-weight:600;">
                Ya, Hapus
            </a>
        </div>
    </div>
</div>

<script>
    // Init max-height for open day groups
    document.querySelectorAll('.day-group-body').forEach(b => {
        b.style.maxHeight = b.scrollHeight + 'px';
    });

    function toggleDay(header) {
        const body    = header.nextElementSibling;
        const chevron = header.querySelector('.chevron');
        if (chevron.classList.contains('open')) {
            body.style.maxHeight = '0';
            chevron.classList.remove('open');
        } else {
            body.style.maxHeight = body.scrollHeight + 'px';
            chevron.classList.add('open');
        }
    }

    function openAddModal()  { document.getElementById('modalAdd').classList.add('active'); }

    function openEditModal(id, hari, mulai, selesai) {
        document.getElementById('editForm').action    = '<?= base_url('jadwal/update/') ?>' + id;
        document.getElementById('edit_hari').value   = hari;
        document.getElementById('edit_mulai').value  = mulai;
        document.getElementById('edit_selesai').value = selesai;
        document.getElementById('modalEdit').classList.add('active');
    }

    function openDeleteModal(id, hari, range) {
        document.getElementById('delete_label').textContent = hari + ' ' + range;
        document.getElementById('deleteLink').href = '<?= base_url('jadwal/delete/') ?>' + id;
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

    function filterJadwal(q) {
        q = q.toLowerCase().trim();
        document.querySelectorAll('.day-group').forEach(group => {
            const rows = group.querySelectorAll('.jadwal-row');
            let vis = 0;
            rows.forEach(row => {
                const match = !q || (row.dataset.search || '').includes(q)
                    || group.dataset.day.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) vis++;
            });
            group.style.display = vis > 0 ? '' : 'none';
            if (q && vis > 0) {
                const body = group.querySelector('.day-group-body');
                body.style.maxHeight = body.scrollHeight + 200 + 'px';
                group.querySelector('.chevron').classList.add('open');
            }
        });
    }

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>

<?= $this->endSection() ?>