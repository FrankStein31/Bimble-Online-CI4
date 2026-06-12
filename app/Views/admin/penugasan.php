<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    .tbl-card { background:white; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.06); border:1px solid #e2e8f0; overflow:hidden; }
    .tbl-card-header { background:linear-gradient(135deg,#667eea,#764ba2); color:white; padding:16px 20px; font-weight:600; font-size:1rem; }
    .tbl-card table { width:100%; border-collapse:collapse; }
    .tbl-card th { background:#f7f8fc; color:#4a5568; font-size:.8rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em; padding:12px 14px; border-bottom:1px solid #e2e8f0; text-align: left; }
    .tbl-card td { padding:14px; border-bottom:1px solid #f0f4f8; font-size:.9rem; color:#2d3748; vertical-align:middle; }
    .tbl-card tr:last-child td { border-bottom:none; }
    .tbl-card tr:hover td { background:#f7f8fc; }

    .btn-reassign {
        background: #ebf4ff; color: #2b6cb0; border: none; border-radius: 6px; padding: 6px 12px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
    }
    .btn-reassign:hover { background: #bee3f8; }

    .badge-tingkat { display:inline-block; padding:3px 10px; border-radius:12px; font-size:.75rem; font-weight:700; }
    .badge-sd  { background:#e6f4ea; color:#2e7d32; }
    .badge-smp { background:#e3f2fd; color:#1565c0; }
    .badge-sma { background:#fce4ec; color:#880e4f; }

    /* Modal */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:1000; align-items:center; justify-content:center; padding:16px; }
    .modal-overlay.active { display:flex; }
    .modal-box { background:white; border-radius:14px; box-shadow:0 10px 40px rgba(0,0,0,.18); width:100%; max-width:440px; animation:modalIn .2s ease; }
    @keyframes modalIn { from{transform:translateY(-16px);opacity:0} to{transform:translateY(0);opacity:1} }
    .modal-head { background:linear-gradient(135deg,#667eea,#764ba2); color:white; padding:18px 22px; border-radius:14px 14px 0 0; display:flex; justify-content:space-between; align-items:center; }
    .modal-head h3 { margin:0; font-size:1.1rem; font-weight:700; }
    .modal-close { background:rgba(255,255,255,.2); border:none; color:white; width:28px; height:28px; border-radius:50%; font-size:1rem; cursor:pointer; }
    .modal-close:hover { background:rgba(255,255,255,.35); }
    .modal-body { padding:22px; }
    .form-group { margin-bottom:16px; }
    .form-group label { display:block; font-size:.85rem; font-weight:600; color:#4a5568; margin-bottom:6px; }
    .form-select { width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:.9rem; color:#374151; outline:none; }
    .form-select:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15); }
    .modal-footer { display:flex; justify-content:flex-end; gap:10px; padding-top:16px; border-top:1px solid #e2e8f0; }
    .btn-cancel { padding:9px 18px; border-radius:8px; border:1px solid #d1d5db; background:white; color:#374151; font-size:.9rem; font-weight:600; cursor:pointer; }
    .btn-save   { padding:9px 22px; border-radius:8px; border:none; background:linear-gradient(135deg,#667eea,#764ba2); color:white; font-size:.9rem; font-weight:600; cursor:pointer; }

    /* Tabs */
    .tab-bar { display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap; }
    .tab-btn { padding:10px 20px; border-radius:10px; border:2px solid #e2e8f0; background:white; color:#4a5568; font-size:.88rem; font-weight:700; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:6px; }
    .tab-btn:hover { border-color:#667eea; color:#667eea; }
    .tab-btn.active { background:linear-gradient(135deg,#667eea,#764ba2); color:white; border-color:transparent; box-shadow:0 4px 14px rgba(102,126,234,.3); }
    .tab-count { background:rgba(255,255,255,.25); border-radius:20px; padding:1px 8px; font-size:.75rem; font-weight:800; }
    .tab-btn:not(.active) .tab-count { background:#edf2f7; color:#4a5568; }

    /* Filter */
    .filter-bar { position:relative; margin-bottom:20px; max-width:400px; }
    .filter-bar input { width:100%; padding:10px 14px 10px 40px; border:1.5px solid #e2e8f0; border-radius:10px; font-size:.9rem; outline:none; box-sizing:border-box; background:white; transition:border-color .2s; }
    .filter-bar input:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.1); }
    .filter-bar::before { content:"🔍"; position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:.85rem; }

    /* Student popup trigger */
    .siswa-trigger { display:inline-flex; align-items:center; gap:6px; cursor:pointer; }
    .siswa-trigger .siswa-count { font-weight:700; color:#2b6cb0; }
    .siswa-trigger .siswa-info { background:#ebf4ff; color:#2b6cb0; border:none; border-radius:50%; width:20px; height:20px; font-size:.7rem; font-weight:800; cursor:pointer; display:inline-flex; align-items:center; justify-content:center; transition:all .15s; }
    .siswa-trigger .siswa-info:hover { background:#667eea; color:white; }
    .siswa-empty { color:#a0aec0; font-size:.85rem; }

    /* Student list modal */
    .siswa-list { list-style:none; margin:0; padding:0; }
    .siswa-list li { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #f0f4f8; }
    .siswa-list li:last-child { border-bottom:none; }
    .siswa-avatar { width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#667eea,#764ba2); color:white; display:flex; align-items:center; justify-content:center; font-size:.8rem; font-weight:700; flex-shrink:0; }
    .siswa-detail { flex:1; }
    .siswa-detail .siswa-name { font-weight:600; color:#2d3748; font-size:.9rem; }
    .siswa-detail .siswa-phone { font-size:.78rem; color:#718096; }
    .btn-transfer-siswa { background:#fff3e0; color:#e65100; border:1px solid #ffcc80; border-radius:6px; padding:4px 10px; font-size:.75rem; font-weight:600; cursor:pointer; white-space:nowrap; transition:all .2s; flex-shrink:0; }
    .btn-transfer-siswa:hover { background:#ffe0b2; border-color:#ffa726; }

    /* Select2 overrides for reassign modal */
    .select2-container--default .select2-selection--single {
        height: 42px; border: 1px solid #d1d5db; border-radius: 8px; padding: 6px 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px; color: #374151; font-size: .9rem; padding: 0;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 40px; }
    .select2-dropdown { border-radius: 8px; border-color: #d1d5db; box-shadow: 0 4px 12px rgba(0,0,0,.1); }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background: linear-gradient(135deg,#667eea,#764ba2);
    }
    .select2-results__option { padding: 10px 14px; font-size: .9rem; }
</style>

<div class="page-header">
    <h1>👨‍🏫 Kelas Bimbel</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div style="padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:.9rem; font-weight:500; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;">
        ✅ <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:.9rem; font-weight:500; background:#fef2f2; color:#991b1b; border:1px solid #fecaca;">
        ⚠️ <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php
// Count per tingkat for tabs
$countAll = count($kelas);
$countSD  = count(array_filter($kelas, fn($k) => $k['tingkat'] === 'SD'));
$countSMP = count(array_filter($kelas, fn($k) => $k['tingkat'] === 'SMP'));
$countSMA = count(array_filter($kelas, fn($k) => $k['tingkat'] === 'SMA'));
?>

<!-- Tabs -->
<div class="tab-bar">
    <button class="tab-btn active" onclick="filterTab('all', this)">Semua <span class="tab-count"><?= $countAll ?></span></button>
    <button class="tab-btn" onclick="filterTab('SD', this)">🟢 SD <span class="tab-count"><?= $countSD ?></span></button>
    <button class="tab-btn" onclick="filterTab('SMP', this)">🔵 SMP <span class="tab-count"><?= $countSMP ?></span></button>
    <button class="tab-btn" onclick="filterTab('SMA', this)">🟣 SMA <span class="tab-count"><?= $countSMA ?></span></button>
</div>

<!-- Filter -->
<div class="filter-bar">
    <input type="text" id="searchFilter" placeholder="Cari program atau nama pengajar…" oninput="applyFilter()">
</div>

<div class="tbl-card">
    <div class="tbl-card-header">Daftar Kelas dan Pengajar Saat Ini</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Program</th>
                <th>Jadwal</th>
                <th>Siswa Terisi</th>
                <th>Pengajar Saat Ini</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="kelasBody">
            <?php if (empty($kelas)): ?>
                <tr><td colspan="6" style="text-align:center; color:#718096; padding:30px;">Tidak ada kelas aktif.</td></tr>
            <?php else: ?>
                <?php foreach ($kelas as $i => $k): ?>
                    <?php $searchStr = strtolower($k['nama_program'] . ' ' . ($k['nama_pengajar'] ?? '')); ?>
                    <tr class="kelas-row" data-tingkat="<?= esc($k['tingkat']) ?>" data-search="<?= esc($searchStr) ?>">
                        <td><?= $i + 1 ?></td>
                        <td>
                            <strong><?= esc($k['nama_program']) ?></strong><br>
                            <?php $tc = match($k['tingkat']) { 'SD'=>'badge-sd','SMP'=>'badge-smp','SMA'=>'badge-sma',default=>'' }; ?>
                            <span class="badge-tingkat <?= $tc ?>"><?= $k['tingkat'] ?></span> Kls <?= esc($k['nama_kelas']) ?>
                        </td>
                        <td>
                            <strong><?= esc($k['hari']) ?></strong><br>
                            <span style="color:#718096; font-size:0.85rem;"><?= substr($k['jam_mulai'], 0, 5) ?> - <?= substr($k['jam_selesai'], 0, 5) ?> WIB</span>
                        </td>
                        <td>
                            <?php if (!empty($k['siswa_list'])): ?>
                                <div class="siswa-trigger" onclick='openSiswaModal(<?= json_encode($k['siswa_list'], JSON_HEX_APOS | JSON_HEX_QUOT) ?>, "<?= esc($k['nama_program'], 'js') ?>", <?= $k['kelas_id'] ?>, <?= $k['program_id'] ?>)'>
                                    <span class="siswa-count"><?= $k['terisi'] ?></span> / <?= $k['kuota'] ?> Siswa
                                    <span class="siswa-info" title="Lihat daftar siswa">i</span>
                                </div>
                            <?php else: ?>
                                <span class="siswa-empty"><?= $k['terisi'] ?> / <?= $k['kuota'] ?> Siswa</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($k['nama_pengajar']): ?>
                                <strong><?= esc($k['nama_pengajar']) ?></strong>
                            <?php else: ?>
                                <span style="color:#e53e3e; font-size:0.85rem;">Belum ada pengajar</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn-reassign" onclick="openReassignModal(<?= $k['kelas_id'] ?>, <?= $k['pengajar_id'] ?: 'null' ?>, '<?= $k['tingkat'] ?>')">🔄 Pindah Pengajar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- MODAL: Student List -->
<div id="modal-siswa" class="modal-overlay">
    <div class="modal-box" style="max-width:400px;">
        <div class="modal-head">
            <h3 id="siswa-modal-title">👥 Daftar Siswa</h3>
            <button class="modal-close" onclick="closeSiswaModal()">✕</button>
        </div>
        <div class="modal-body" style="max-height:400px; overflow-y:auto;">
            <ul class="siswa-list" id="siswa-list-content">
                <!-- Populated by JS -->
            </ul>
        </div>
    </div>
</div>

<!-- MODAL REASSIGN -->
<div id="modal-reassign" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <h3>🔄 Pindahkan Kelas ke Pengajar Lain</h3>
            <button class="modal-close" onclick="closeAllModals()">✕</button>
        </div>
        <form action="<?= base_url('dashboard/penugasan/reassign') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="kelas_id" id="reassign-kelas-id">
            <div class="modal-body">
                <p style="font-size:0.85rem; color:#718096; margin-bottom:16px;">
                    Dengan mengubah pengajar, semua siswa di kelas ini akan otomatis dipindahkan ke pengajar yang baru dipilih. Pastikan jadwal pengajar baru tidak bentrok.
                </p>
                <div class="form-group">
                    <label>Pilih Pengajar Baru</label>
                    <select name="pengajar_id" id="reassign-pengajar-id" class="form-select" required>
                        <option value="">— Pilih Pengajar —</option>
                        <!-- Options populated via JS to filter by tingkat/jabatan -->
                    </select>
                </div>
            </div>
            <div class="modal-footer" style="padding:16px 22px 22px;">
                <button type="button" class="btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: Transfer Siswa -->
<div id="modal-transfer" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head" style="background:linear-gradient(135deg,#f57c00,#e65100);">
            <h3>↔️ Pindahkan Siswa ke Kelas Lain</h3>
            <button class="modal-close" onclick="closeAllModals()">✕</button>
        </div>
        <form action="<?= base_url('dashboard/penugasan/transfer-siswa') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="transaksi_id" id="transfer-transaksi-id">
            <input type="hidden" name="from_kelas_id" id="transfer-from-kelas-id">
            <div class="modal-body">
                <p style="font-size:0.85rem; color:#718096; margin-bottom:8px;">
                    Pindahkan siswa <strong id="transfer-siswa-name"></strong> ke kelas lain (program yang sama).
                </p>
                <p style="font-size:0.8rem; color:#a0aec0; margin-bottom:16px;">
                    Siswa akan otomatis dipindahkan ke pengajar dan jadwal kelas tujuan.
                </p>
                <div class="form-group">
                    <label>Pilih Kelas Tujuan</label>
                    <select name="to_kelas_id" id="transfer-to-kelas-id" class="form-select" required>
                        <option value="">— Pilih Kelas —</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer" style="padding:16px 22px 22px;">
                <button type="button" class="btn-cancel" onclick="closeAllModals()">Batal</button>
                <button type="submit" class="btn-save" style="background:linear-gradient(135deg,#f57c00,#e65100);">Pindahkan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const pengajars = <?= json_encode($pengajar) ?>;
    const allKelas  = <?= json_encode($kelas, JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

    // ── Tab filter ──
    let activeTab = 'all';
    function filterTab(tingkat, btn) {
        activeTab = tingkat;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        applyFilter();
    }

    // ── Combined tab + search filter ──
    function applyFilter() {
        const q = document.getElementById('searchFilter').value.toLowerCase().trim();
        const rows = document.querySelectorAll('#kelasBody .kelas-row');
        let visibleIdx = 0;
        rows.forEach(row => {
            const tingkat = row.dataset.tingkat;
            const search  = row.dataset.search || '';
            const matchTab = (activeTab === 'all' || tingkat === activeTab);
            const matchSearch = (!q || search.includes(q));
            if (matchTab && matchSearch) {
                row.style.display = '';
                // Re-number visible rows
                row.querySelector('td').textContent = ++visibleIdx;
            } else {
                row.style.display = 'none';
            }
        });
    }

    // ── Student list modal ──
    function openSiswaModal(siswaList, programName, kelasId, programId) {
        document.getElementById('siswa-modal-title').textContent = '👥 Siswa — ' + programName;
        const ul = document.getElementById('siswa-list-content');
        ul.innerHTML = '';
        siswaList.forEach(function(s, idx) {
            const initials = s.nama.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
            const li = document.createElement('li');
            li.innerHTML = '<div class="siswa-avatar">' + initials + '</div>' +
                '<div class="siswa-detail">' +
                '<div class="siswa-name">' + (idx + 1) + '. ' + s.nama + '</div>' +
                '<div class="siswa-phone">📱 ' + (s.nomor_hp || '-') + '</div>' +
                '</div>' +
                '<button class="btn-transfer-siswa" onclick="openTransferModal(' + s.transaksi_id + ', ' + kelasId + ', ' + programId + ', \'' + s.nama.replace(/'/g, "\\'") + '\')">↔️ Pindah</button>';
            ul.appendChild(li);
        });
        document.getElementById('modal-siswa').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeSiswaModal() {
        document.getElementById('modal-siswa').classList.remove('active');
        document.body.style.overflow = '';
    }

    // ── Reassign modal ──
    function openReassignModal(kelasId, currentPengajarId, tingkat) {
        document.getElementById('reassign-kelas-id').value = kelasId;

        const $select = $('#reassign-pengajar-id');

        // Destroy previous Select2 instance
        if ($select.data('select2')) $select.select2('destroy');

        // Clear and populate options
        $select.empty().append('<option value="">— Pilih Pengajar (' + tingkat + ') —</option>');

        pengajars.forEach(p => {
            if (p.jabatan === tingkat) {
                let label = p.nama;
                const opt = new Option(label, p.user_id, false, false);

                if (p.user_id == currentPengajarId) {
                    label += ' (Pengajar Saat Ini)';
                    $(opt).prop('selected', true);
                } else if (p.is_full == true || p.is_full == 1) {
                    label += ' (FULL — ' + p.total_terisi + '/' + p.total_kuota + ')';
                    $(opt).prop('disabled', true);
                } else {
                    label += ' (' + p.total_terisi + '/' + p.total_kuota + ')';
                }
                opt.textContent = label;
                $select.append(opt);
            }
        });

        // Init Select2
        $select.select2({
            placeholder: '— Pilih Pengajar (' + tingkat + ') —',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modal-reassign')
        });

        document.getElementById('modal-reassign').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAllModals() {
        document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
        document.body.style.overflow = '';
    }

    // ── Transfer siswa modal ──
    function openTransferModal(transaksiId, fromKelasId, programId, siswaName) {
        document.getElementById('transfer-transaksi-id').value = transaksiId;
        document.getElementById('transfer-from-kelas-id').value = fromKelasId;
        document.getElementById('transfer-siswa-name').textContent = siswaName;

        const select = document.getElementById('transfer-to-kelas-id');
        select.innerHTML = '<option value="">— Pilih Kelas Tujuan —</option>';

        allKelas.forEach(k => {
            if (k.program_id == programId && k.kelas_id != fromKelasId) {
                const isFull = parseInt(k.terisi) >= parseInt(k.kuota);
                const label = k.nama_program + ' — ' + k.nama_kelas + ' (' + k.hari + ' ' + k.jam_mulai.substring(0,5) + ') [' + k.terisi + '/' + k.kuota + '] ' + (k.nama_pengajar ? '→ ' + k.nama_pengajar : '') + (isFull ? ' FULL' : '');
                const opt = new Option(label, k.kelas_id, false, false);
                if (isFull) $(opt).prop('disabled', true);
                select.appendChild(opt);
            }
        });

        document.getElementById('modal-transfer').classList.add('active');
    }

    document.querySelectorAll('.modal-overlay').forEach(function(o) {
        o.addEventListener('click', function(e) { if (e.target === this) closeAllModals(); });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeAllModals();
    });
</script>

<?= $this->endSection() ?>
