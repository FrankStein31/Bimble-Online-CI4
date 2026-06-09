<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>

<style>
body {
    background: linear-gradient(135deg, rgba(102,126,234,0.05), rgba(118,75,162,0.05)) !important;
}

.rekap-belajar {
    max-width: 1000px;
    margin: 0 auto;
    padding: 60px 20px;
    min-height: calc(100vh - 100px);
}

.page-title {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.2rem;
    color: #2d3748;
    font-weight: 600;
}

.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 16px;
    margin-bottom: 40px;
}

.summary-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    border: 1px solid #e2e8f0;
}

.summary-card .number {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
}

.summary-card .label {
    font-size: 0.85rem;
    color: #718096;
    margin-top: 4px;
}

.table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}

thead {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

th {
    text-align: left;
    font-weight: 600;
    padding: 16px 14px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

td {
    padding: 16px 14px;
    border-bottom: 1px solid #e2e8f0;
    color: #4a5568;
    font-size: 0.95rem;
    vertical-align: middle;
}

tbody tr:last-child td { border-bottom: none; }
tbody tr:hover { background: #f8fafc; }

.nilai-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
}

.nilai-baik    { background: #c6f6d5; color: #2f855a; }
.nilai-cukup   { background: #fef3c7; color: #d69e2e; }
.nilai-kurang  { background: #fed7d7; color: #c53030; }
.nilai-kosong  { background: #e2e8f0; color: #718096; }

.no-data {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    border: 2px dashed #cbd5e0;
    color: #718096;
}

.no-data::before {
    content: "📚";
    display: block;
    font-size: 3rem;
    margin-bottom: 16px;
}

.filter-section {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    border: 1px solid #e2e8f0;
    margin-bottom: 30px;
}

.filter-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-controls {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    align-items: flex-end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.filter-group select {
    padding: 10px 12px;
    border: 1px solid #cbd5e0;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #2d3748;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.filter-group select:hover {
    border-color: #a0aec0;
}

.filter-group select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.filter-buttons {
    display: flex;
    gap: 10px;
    align-items: flex-end;
}

.btn-filter {
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.btn-filter-reset {
    padding: 10px 20px;
    background: #e2e8f0;
    color: #4a5568;
    border: 1px solid #cbd5e0;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter-reset:hover {
    background: #cbd5e0;
}

</style>

<section class="rekap-belajar">
    <h2 class="page-title">Rekap Perkembangan Belajar</h2>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-title">Filter Data</div>
        <form method="get" id="filter-form">
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="program_id">Program</label>
                    <select name="program_id" id="program_id">
                        <option value="">Semua Program</option>
                        <?php if (!empty($programs)): ?>
                            <?php foreach ($programs as $prog): ?>
                                <option value="<?= $prog['program_id'] ?>" <?= ($selectedProgram == $prog['program_id']) ? 'selected' : '' ?>>
                                    <?= esc($prog['nama_program']) ?> (<?= esc($prog['tingkat']) ?> <?= esc($prog['kelas']) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="pengajar_id">Pengajar</label>
                    <select name="pengajar_id" id="pengajar_id">
                        <option value="">Semua Pengajar</option>
                        <?php if (!empty($pengajars)): ?>
                            <?php foreach ($pengajars as $peng): ?>
                                <option value="<?= $peng['user_id'] ?>" <?= ($selectedPengajar == $peng['user_id']) ? 'selected' : '' ?>>
                                    <?= esc($peng['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="filter-buttons">
                    <button type="submit" class="btn-filter">Filter</button>
                    <a href="<?= base_url('/rekap-belajar') ?>" class="btn-filter-reset">↻ Reset</a>
                </div>
            </div>
        </form>
    </div>

    <?php if (empty($hasil)): ?>
        <div class="no-data">
            <p style="font-size:1.1rem; font-weight:600; margin-bottom:8px;">Belum ada data hasil belajar</p>
            <p>Data akan muncul setelah pengajar menginput hasil belajar Anda.</p>
        </div>
    <?php else: ?>
        <?php
            $totalSesi   = count($hasil);
            $nilaiList   = array_filter(array_column($hasil, 'nilai'), fn($v) => $v !== null);
            $rataRata    = count($nilaiList) ? round(array_sum($nilaiList) / count($nilaiList), 1) : null;
            $mapelList   = array_unique(array_column($hasil, 'mata_pelajaran'));
        ?>
        <div class="summary-cards">
            <div class="summary-card">
                <div class="number"><?= $totalSesi ?></div>
                <div class="label">Total Sesi Belajar</div>
            </div>
            <div class="summary-card">
                <div class="number"><?= $rataRata !== null ? $rataRata : '-' ?></div>
                <div class="label">Rata-rata Nilai</div>
            </div>
            <div class="summary-card">
                <div class="number"><?= count($mapelList) ?></div>
                <div class="label">Mata Pelajaran</div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pengajar</th>
                        <th>Program</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasil as $i => $h): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                            <td><?= esc($h['nama_pengajar']) ?></td>
                            <td><?= esc($h['nama_program']) ?> (<?= esc($h['tingkat']) ?> <?= esc($h['kelas']) ?>)</td>
                            <td><?= esc($h['mata_pelajaran']) ?></td>
                            <td>
                                <?php if ($h['nilai'] !== null): ?>
                                    <?php
                                        $kelas = $h['nilai'] >= 75 ? 'nilai-baik' : ($h['nilai'] >= 60 ? 'nilai-cukup' : 'nilai-kurang');
                                    ?>
                                    <span class="nilai-badge <?= $kelas ?>"><?= number_format($h['nilai'], 1) ?></span>
                                <?php else: ?>
                                    <span class="nilai-badge nilai-kosong">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($h['catatan'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>
