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
</style>

<div class="page-header">
    <h1>👨‍🏫 Penugasan Guru (Kelas Bimbel)</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div style="padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:.9rem; font-weight:500; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0;">
        ✅ <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

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
        <tbody>
            <?php if (empty($kelas)): ?>
                <tr><td colspan="6" style="text-align:center; color:#718096; padding:30px;">Tidak ada kelas aktif.</td></tr>
            <?php else: ?>
                <?php foreach ($kelas as $i => $k): ?>
                    <tr>
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
                            <span style="font-weight:600; color:#2b6cb0;"><?= $k['terisi'] ?></span> / <?= $k['kuota'] ?> Siswa
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

<!-- MODAL REASSIGN -->
<div id="modal-reassign" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <h3>🔄 Pindahkan Kelas ke Pengajar Lain</h3>
            <button class="modal-close" onclick="closeModal()">✕</button>
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
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const pengajars = <?= json_encode($pengajar) ?>;

    function openReassignModal(kelasId, currentPengajarId, tingkat) {
        document.getElementById('reassign-kelas-id').value = kelasId;
        
        const select = document.getElementById('reassign-pengajar-id');
        select.innerHTML = '<option value="">— Pilih Pengajar (' + tingkat + ') —</option>';
        
        pengajars.forEach(p => {
            // Filter pengajar yang memiliki jabatan/kemampuan mengajar di tingkat ini
            if (p.jabatan === tingkat) {
                const opt = document.createElement('option');
                opt.value = p.user_id;
                opt.textContent = p.nama + (p.user_id == currentPengajarId ? ' (Pengajar Saat Ini)' : '');
                if (p.user_id == currentPengajarId) {
                    opt.selected = true;
                }
                select.appendChild(opt);
            }
        });

        document.getElementById('modal-reassign').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modal-reassign').classList.remove('active');
    }

    document.querySelectorAll('.modal-overlay').forEach(function(o) {
        o.addEventListener('click', function(e) { if (e.target === this) closeModal(); });
    });
</script>

<?= $this->endSection() ?>
