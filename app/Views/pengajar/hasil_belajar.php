<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="title-container">
        <h1>Hasil Belajar Siswa</h1>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash-message flash-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-message flash-error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="top-container">
        <input type="text" class="search-input" placeholder="Cari nama siswa / mata pelajaran...">
        <button class="add-button" onclick="openModal('addModal')">+ Tambah Hasil Belajar</button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
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
                    <tr><td colspan="8" style="text-align:center; color:#718096; padding:30px;">Belum ada data hasil belajar</td></tr>
                <?php else: ?>
                    <?php foreach ($hasil as $i => $h): ?>
                        <tr>
                            <td data-label="No"><?= $i + 1 ?></td>
                            <td data-label="Tanggal"><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                            <td data-label="Nama Siswa"><?= esc($h['nama_siswa']) ?></td>
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
                            <td data-label="Catatan" style="max-width:200px;"><?= esc($h['catatan'] ?? '-') ?></td>
                            <td data-label="Aksi">
                                <button class="action-btn edit-btn" onclick="openEditModal(<?= $h['hasil_id'] ?>, <?= json_encode($h) ?>)" title="Edit">✏️</button>
                                <a href="<?= base_url('pengajar/hasil-belajar/hapus/' . $h['hasil_id']) ?>"
                                   class="action-btn delete-btn"
                                   onclick="return confirm('Yakin hapus data ini?')" title="Hapus">🗑️</a>
                            </td>
                        </tr>
                        <!-- Edit Modal per row -->
                        <div class="modal" id="editModal-<?= $h['hasil_id'] ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit Hasil Belajar</h3>
                                    <button class="close-modal" onclick="closeModal('editModal-<?= $h['hasil_id'] ?>')">×</button>
                                </div>
                                <form action="<?= base_url('pengajar/hasil-belajar/edit/' . $h['hasil_id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label>Siswa</label>
                                        <select name="siswa_id" class="form-select" required>
                                            <?php foreach ($siswa as $s): ?>
                                                <option value="<?= $s['user_id'] ?>" <?= $s['user_id'] == $h['siswa_id'] ? 'selected' : '' ?>>
                                                    <?= esc($s['nama']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Program</label>
                                        <select name="program_id" class="form-select" required>
                                            <?php foreach ($program as $p): ?>
                                                <option value="<?= $p['program_id'] ?>" <?= $p['program_id'] == $h['program_id'] ? 'selected' : '' ?>>
                                                    <?= esc($p['nama_program']) ?> (<?= $p['tingkat'] ?> <?= $p['kelas'] ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" name="mata_pelajaran" class="form-control" value="<?= esc($h['mata_pelajaran']) ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nilai (0–100)</label>
                                        <input type="number" name="nilai" class="form-control" value="<?= $h['nilai'] ?>" min="0" max="100" step="0.1">
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea name="catatan" class="form-control" rows="3"><?= esc($h['catatan']) ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" value="<?= $h['tanggal'] ?>" required>
                                    </div>
                                    <div class="form-buttons">
                                        <button type="button" class="btn btn-gray" onclick="closeModal('editModal-<?= $h['hasil_id'] ?>')">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        <form action="<?= base_url('pengajar/hasil-belajar/tambah') ?>" method="post">
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
                <input type="number" name="nilai" class="form-control" placeholder="Opsional" min="0" max="100" step="0.1">
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan pembelajaran..."></textarea>
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

<?= $this->endSection() ?>
