<?= $this->extend('layouts/sidebar_pengajar') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1>👥 Daftar Siswa Saya</h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-message flash-success">✅ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<!-- Stats -->
<div class="stat-cards" style="grid-template-columns:repeat(auto-fit,minmax(130px,1fr));margin-bottom:18px;">
    <?php
        $totalSiswa = count($siswa);
        $perTingkat = ['SD'=>0,'SMP'=>0,'SMA'=>0];
        foreach ($siswa as $s) {
            $t = $s['tingkat'] ?? '';
            if (isset($perTingkat[$t])) $perTingkat[$t]++;
        }
    ?>
    <div class="stat-card"><div class="stat-number"><?= $totalSiswa ?></div><div class="stat-label">Total Siswa</div></div>
    <div class="stat-card"><div class="stat-number" style="color:#1d4ed8;"><?= $perTingkat['SD'] ?></div><div class="stat-label">Siswa SD</div></div>
    <div class="stat-card"><div class="stat-number" style="color:#166534;"><?= $perTingkat['SMP'] ?></div><div class="stat-label">Siswa SMP</div></div>
    <div class="stat-card"><div class="stat-number" style="color:#92400e;"><?= $perTingkat['SMA'] ?></div><div class="stat-label">Siswa SMA</div></div>
</div>

<div class="toolbar">
    <input type="text" class="search-input" id="searchSiswa" placeholder="🔍  Cari nama siswa / program…" oninput="filterSiswa(this.value)">
</div>

<div class="tbl-wrap">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Siswa</th>
                <th>No. HP</th>
                <th>Program</th>
                <th>Jenjang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="siswaTbody">
            <?php if (empty($siswa)): ?>
                <tr><td colspan="6"><div class="empty-state"><div class="icon">👤</div><p>Belum ada siswa aktif.</p></div></td></tr>
            <?php else: ?>
                <?php foreach ($siswa as $i => $s): ?>
                    <tr class="siswa-row" data-search="<?= strtolower($s['nama'].' '.($s['nama_program'] ?? '').' '.($s['tingkat'] ?? '')) ?>">
                        <td><?= $i + 1 ?></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <?php if (!empty($s['photo'])): ?>
                                    <img src="<?= base_url('uploads/profile/'.$s['photo']) ?>" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;">
                                <?php else: ?>
                                    <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:.9rem;flex-shrink:0;">
                                        <?= strtoupper(substr($s['nama'],0,1)) ?>
                                    </div>
                                <?php endif; ?>
                                <strong><?= esc($s['nama']) ?></strong>
                            </div>
                        </td>
                        <td><?= esc($s['nomor_hp']) ?></td>
                        <td><?= esc($s['nama_program'] ?? '-') ?> <small style="color:#718096;">Kls <?= esc($s['kelas'] ?? '') ?></small></td>
                        <td><span class="badge badge-<?= $s['tingkat'] ?>"><?= esc($s['tingkat']) ?></span></td>
                        <td><span class="badge-aktif badge">Aktif</span></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    function filterSiswa(q) {
        q = q.toLowerCase().trim();
        document.querySelectorAll('.siswa-row').forEach(row => {
            row.style.display = (!q || (row.dataset.search || '').includes(q)) ? '' : 'none';
        });
    }
</script>

<?= $this->endSection() ?>
