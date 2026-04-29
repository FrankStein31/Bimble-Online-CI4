<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Rekapitulasi Hasil Belajar</h1>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message flash-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-message flash-error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="top-container">
        <input type="text" class="search-input" placeholder="Cari nama siswa / pengajar / mapel...">
        <button class="add-button" onclick="openModal('addModal')">+ Tambah</button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
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
                <?php if (empty($hasil)): ?>
                    <tr><td colspan="9" style="text-align:center; color:#718096; padding:30px;">Belum ada data hasil belajar</td></tr>
                <?php else: ?>
                    <?php foreach ($hasil as $i => $h): ?>
                        <tr>
                            <td data-label="No"><?= $i + 1 ?></td>
                            <td data-label="Tanggal"><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                            <td data-label="Siswa"><?= esc($h['nama_siswa']) ?></td>
                            <td data-label="Pengajar"><?= esc($h['nama_pengajar']) ?></td>
                            <td data-label="Program"><?= esc($h['nama_program']) ?> (<?= esc($h['tingkat']) ?> <?= esc($h['kelas']) ?>)</td>
                            <td data-label="Mata Pelajaran"><?= esc($h['mata_pelajaran']) ?></td>
                            <td data-label="Nilai">
                                <?php if ($h['nilai'] !== null): ?>
                                    <strong style="color:<?= $h['nilai'] >= 75 ? '#2f855a' : ($h['nilai'] >= 60 ? '#d69e2e' : '#c53030') ?>">
                                        <?= number_format($h['nilai'], 1) ?>
                                    </strong>
                                <?php else: ?>
                                    <span style="color:#718096;">-</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Catatan" style="max-width:180px;"><?= esc($h['catatan'] ?? '-') ?></td>
                            <td data-label="Aksi">
                                <button class="action-btn edit-btn" onclick="openEditModalAdmin(<?= $h['hasil_id'] ?>, <?= json_encode($h) ?>)" title="Edit">✏️</button>
                                <a href="<?= base_url('hasil-belajar/delete/' . $h['hasil_id']) ?>"
                                   class="action-btn delete-btn"
                                   onclick="return confirm('Yakin hapus data ini?')" title="Hapus">🗑️</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Hasil Belajar</h3>
            <button class="close-modal" onclick="closeModal('addModal')">×</button>
        </div>
        <form action="<?= base_url('hasil-belajar/add') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Siswa</label>
                <select name="siswa_id" class="form-select" required>
                    <option value="">Pilih Siswa</option>
                    <?php foreach ($siswa as $s): ?>
                        <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Pengajar</label>
                <select name="pengajar_id" class="form-select" required>
                    <option value="">Pilih Pengajar</option>
                    <?php foreach ($pengajar as $p): ?>
                        <option value="<?= $p['user_id'] ?>"><?= esc($p['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Program</label>
                <select name="program_id" class="form-select" required>
                    <option value="">Pilih Program</option>
                    <?php foreach ($program as $p): ?>
                        <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> <?= $p['kelas'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" class="form-control" placeholder="Contoh: Matematika" required>
            </div>
            <div class="form-group">
                <label>Nilai (0–100)</label>
                <input type="number" name="nilai" class="form-control" min="0" max="100" step="0.1">
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="form-buttons">
                <button type="button" class="btn btn-gray" onclick="closeModal('addModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Hasil Belajar</h3>
            <button class="close-modal" onclick="closeModal('editModal')">×</button>
        </div>
        <form id="editForm" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Siswa</label>
                <select name="siswa_id" id="edit_siswa_id" class="form-select" required>
                    <?php foreach ($siswa as $s): ?>
                        <option value="<?= $s['user_id'] ?>"><?= esc($s['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Pengajar</label>
                <select name="pengajar_id" id="edit_pengajar_id" class="form-select" required>
                    <?php foreach ($pengajar as $p): ?>
                        <option value="<?= $p['user_id'] ?>"><?= esc($p['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Program</label>
                <select name="program_id" id="edit_program_id" class="form-select" required>
                    <?php foreach ($program as $p): ?>
                        <option value="<?= $p['program_id'] ?>"><?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> <?= $p['kelas'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" id="edit_mata_pelajaran" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nilai (0–100)</label>
                <input type="number" name="nilai" id="edit_nilai" class="form-control" min="0" max="100" step="0.1">
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <textarea name="catatan" id="edit_catatan" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
            </div>
            <div class="form-buttons">
                <button type="button" class="btn btn-gray" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }

    function openEditModalAdmin(id, data) {
        document.getElementById('editForm').action = '<?= base_url('hasil-belajar/update/') ?>' + id;
        document.getElementById('edit_siswa_id').value    = data.siswa_id;
        document.getElementById('edit_pengajar_id').value = data.pengajar_id;
        document.getElementById('edit_program_id').value  = data.program_id;
        document.getElementById('edit_mata_pelajaran').value = data.mata_pelajaran;
        document.getElementById('edit_nilai').value       = data.nilai;
        document.getElementById('edit_catatan').value     = data.catatan;
        document.getElementById('edit_tanggal').value     = data.tanggal;
        openModal('editModal');
    }

    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.style.display = 'none';
        });
    });
</script>

<?= $this->endSection() ?>
