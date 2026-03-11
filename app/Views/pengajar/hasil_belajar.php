<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1>📝 Hasil Belajar Siswa</h1>
    <button class="btn-add" onclick="openModal('addModal')">＋ Tambah Hasil Belajar</button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-message flash-success" id="flash-alert">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-message flash-error" id="flash-alert">❌ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Stats -->
<?php
    $nilaiArr = array_filter(array_column($hasil, 'nilai'), fn($v) => $v !== null && $v !== '');
    $rataRata = count($nilaiArr) ? round(array_sum($nilaiArr)/count($nilaiArr), 1) : '-';
    $countA = count(array_filter($nilaiArr, fn($v) => $v >= 85));
    $countB = count(array_filter($nilaiArr, fn($v) => $v >= 70 && $v < 85));
    $countD = count(array_filter($nilaiArr, fn($v) => $v < 55));
?>
<div class="stat-cards">
    <div class="stat-card"><div class="stat-number"><?= count($hasil) ?></div><div class="stat-label">Total Data</div></div>
    <div class="stat-card"><div class="stat-number"><?= $rataRata ?></div><div class="stat-label">Rata-rata Nilai</div></div>
    <div class="stat-card"><div class="stat-number" style="color:#065f46;"><?= $countA ?></div><div class="stat-label">Nilai A (≥85)</div></div>
    <div class="stat-card"><div class="stat-number" style="color:#1e40af;"><?= $countB ?></div><div class="stat-label">Nilai B (70–84)</div></div>
    <div class="stat-card"><div class="stat-number" style="color:#c53030;"><?= $countD ?></div><div class="stat-label">Nilai D (&lt;55)</div></div>
</div>

<div class="toolbar">
    <input type="text" class="search-input" placeholder="🔍  Cari siswa / mata pelajaran…" oninput="filterTable(this.value)">
</div>

<div class="tbl-wrap">
    <table id="hasilTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Program</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($hasil)): ?>
                <tr><td colspan="8"><div class="empty-state"><div class="icon">📭</div><p>Belum ada data hasil belajar.</p></div></td></tr>
            <?php else: ?>
                <?php foreach ($hasil as $i => $h): ?>
                    <tr class="data-row" data-search="<?= strtolower($h['nama_siswa'].' '.$h['mata_pelajaran'].' '.$h['nama_program']) ?>">
                        <td><?= $i + 1 ?></td>
                        <td style="white-space:nowrap;"><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                        <td><strong><?= esc($h['nama_siswa']) ?></strong></td>
                        <td>
                            <?= esc($h['nama_program']) ?><br>
                            <span class="badge badge-<?= $h['tingkat'] ?>"><?= $h['tingkat'] ?></span>
                            <small style="color:#718096;">Kls <?= $h['kelas'] ?></small>
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
                                <a href="<?= base_url('pengajar/hasil-belajar/hapus/'.$h['hasil_id']) ?>"
                                   class="btn-icon del" title="Hapus"
                                   onclick="return confirm('Yakin hapus data ini?')">🗑️</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ===== MODAL TAMBAH ===== -->
<div class="modal" id="addModal" style="display:none;">
    <div class="modal-box">
        <div class="modal-head">
            <h3>➕ Tambah Hasil Belajar</h3>
            <button class="modal-close" onclick="closeModal('addModal')">×</button>
        </div>
        <form action="<?= base_url('pengajar/hasil-belajar/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="two-col">
                    <div class="form-group">
                        <label>Siswa <span class="req">*</span></label>
                        <select name="siswa_id" id="add_siswa" class="form-select" required onchange="autoFillProgram(this.value)">
                            <option value="">Pilih Siswa</option>
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Program <span class="req">*</span></label>
                        <select name="program_id" id="add_program" class="form-select" required>
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $p): ?>
                                <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> Kls <?= $p['kelas'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div id="add_program_hint" style="font-size:.75rem;color:#38a169;margin-top:3px;display:none;">✅ Terdeteksi otomatis dari paket siswa</div>
                    </div>
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
                <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ===== MODAL EDIT (satu, reusable) ===== -->
<div class="modal" id="editModalSingle" style="display:none;">
    <div class="modal-box">
        <div class="modal-head">
            <h3>✏️ Edit Hasil Belajar</h3>
            <button class="modal-close" onclick="closeModal('editModalSingle')">×</button>
        </div>
        <form id="editForm" method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="two-col">
                    <div class="form-group">
                        <label>Siswa <span class="req">*</span></label>
                        <select name="siswa_id" id="e_siswa" class="form-select" required onchange="autoFillEditProgram(this.value)">
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Program <span class="req">*</span></label>
                        <select name="program_id" id="e_program" class="form-select" required>
                            <?php foreach ($program as $p): ?>
                                <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> Kls <?= $p['kelas'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
                <button type="button" class="btn-cancel" onclick="closeModal('editModalSingle')">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Siswa → Program mapping from server
    const siswaMap = <?= json_encode($siswaMap ?? []) ?>;

    function autoFillProgram(siswaId) {
        const programSel = document.getElementById('add_program');
        const hint       = document.getElementById('add_program_hint');
        if (siswaId && siswaMap[siswaId]) {
            programSel.value = siswaMap[siswaId];
            hint.style.display = 'block';
        } else {
            programSel.value = '';
            hint.style.display = 'none';
        }
    }

    function autoFillEditProgram(siswaId) {
        if (siswaId && siswaMap[siswaId]) {
            document.getElementById('e_program').value = siswaMap[siswaId];
        }
    }

    // Override openEditModal dari layout untuk versi terpusat ini
    function openEditModal(id, data) {
        document.getElementById('editForm').action = '<?= base_url('pengajar/hasil-belajar/edit/') ?>' + id;
        document.getElementById('e_siswa').value   = data.siswa_id;
        document.getElementById('e_program').value = data.program_id;
        document.getElementById('e_mapel').value   = data.mata_pelajaran;
        document.getElementById('e_nilai').value   = data.nilai ?? '';
        document.getElementById('e_tanggal').value = data.tanggal;
        document.getElementById('e_catatan').value = data.catatan ?? '';
        openModal('editModalSingle');
    }

    function filterTable(q) {
        q = q.toLowerCase().trim();
        document.querySelectorAll('.data-row').forEach(row => {
            row.style.display = (!q || (row.dataset.search || '').includes(q)) ? '' : 'none';
        });
    }

    // Backdrop click close
    document.querySelectorAll('.modal').forEach(m => {
        m.addEventListener('click', e => { if (e.target === m) closeModal(m.id); });
    });
</script>

<?= $this->endSection() ?>
