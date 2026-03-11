<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Belajar</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #000; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 12px; }
        .header h2 { font-size: 16px; font-weight: bold; }
        .header p { font-size: 11px; color: #555; margin-top: 4px; }
        .filter-info { margin-bottom: 14px; font-size: 11px; color: #555; }
        .filter-info span { margin-right: 16px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #f3f4f6; text-align: left; padding: 7px 6px; border: 1px solid #ddd; font-size: 11px; }
        td { padding: 6px; border: 1px solid #ddd; font-size: 11px; vertical-align: top; }
        tr:nth-child(even) { background: #f9fafb; }
        .badge { padding: 1px 6px; border-radius: 10px; font-size: 10px; font-weight: bold; }
        .badge-sd  { background: #dbeafe; color: #1d4ed8; }
        .badge-smp { background: #dcfce7; color: #166534; }
        .badge-sma { background: #fef3c7; color: #92400e; }
        .nilai-a { color: #065f46; font-weight: bold; }
        .nilai-b { color: #1e40af; font-weight: bold; }
        .nilai-c { color: #92400e; font-weight: bold; }
        .nilai-d { color: #991b1b; font-weight: bold; }
        .summary { display: flex; gap: 24px; margin-bottom: 16px; }
        .summary-item { text-align: center; }
        .summary-item .num { font-size: 22px; font-weight: bold; color: #4285f4; }
        .summary-item .lbl { font-size: 11px; color: #555; }
        .footer { text-align: right; margin-top: 30px; font-size: 11px; }
        @media print {
            body { padding: 10px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom:16px;">
        <button onclick="window.print()" style="padding:8px 20px;background:#4285f4;color:white;border:none;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;">
            🖨️ Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" style="padding:8px 20px;background:#e5e7eb;color:#374151;border:none;border-radius:6px;cursor:pointer;font-size:13px;margin-left:8px;">
            ✖ Tutup
        </button>
    </div>

    <div class="header">
        <h2>LAPORAN HASIL BELAJAR SISWA</h2>
        <p>Bimbel Harapan &mdash; Dicetak: <?= date('d F Y, H:i') ?> WIB</p>
    </div>

    <!-- Info filter -->
    <div class="filter-info">
        <?php if (!empty($filter['tingkat'])): ?>
            <span>Jenjang: <strong><?= $filter['tingkat'] ?></strong></span>
        <?php endif; ?>
        <?php if (!empty($filter['tanggal_dari'])): ?>
            <span>Dari: <strong><?= date('d/m/Y', strtotime($filter['tanggal_dari'])) ?></strong></span>
        <?php endif; ?>
        <?php if (!empty($filter['tanggal_sampai'])): ?>
            <span>Sampai: <strong><?= date('d/m/Y', strtotime($filter['tanggal_sampai'])) ?></strong></span>
        <?php endif; ?>
        <span>Total data: <strong><?= count($hasil) ?></strong></span>
    </div>

    <?php if (empty($hasil)): ?>
        <p style="text-align:center;color:#9ca3af;padding:30px 0;">Tidak ada data untuk filter ini.</p>
    <?php else: ?>
        <!-- Ringkasan nilai -->
        <?php
        $totalNilai = array_sum(array_column($hasil, 'nilai'));
        $rataRata   = count($hasil) > 0 ? round($totalNilai / count($hasil), 1) : 0;
        $nilaiA = count(array_filter($hasil, fn($h) => $h['nilai'] >= 85));
        $nilaiB = count(array_filter($hasil, fn($h) => $h['nilai'] >= 70 && $h['nilai'] < 85));
        $nilaiC = count(array_filter($hasil, fn($h) => $h['nilai'] >= 55 && $h['nilai'] < 70));
        $nilaiD = count(array_filter($hasil, fn($h) => $h['nilai'] < 55));
        ?>
        <div class="summary">
            <div class="summary-item">
                <div class="num"><?= count($hasil) ?></div>
                <div class="lbl">Total Penilaian</div>
            </div>
            <div class="summary-item">
                <div class="num"><?= $rataRata ?></div>
                <div class="lbl">Rata-rata Nilai</div>
            </div>
            <div class="summary-item">
                <div class="num nilai-a"><?= $nilaiA ?></div>
                <div class="lbl">Nilai A (≥85)</div>
            </div>
            <div class="summary-item">
                <div class="num nilai-b"><?= $nilaiB ?></div>
                <div class="lbl">Nilai B (70-84)</div>
            </div>
            <div class="summary-item">
                <div class="num nilai-c"><?= $nilaiC ?></div>
                <div class="lbl">Nilai C (55-69)</div>
            </div>
            <div class="summary-item">
                <div class="num nilai-d"><?= $nilaiD ?></div>
                <div class="lbl">Nilai D (&lt;55)</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:28px;">#</th>
                    <th style="width:70px;">Tanggal</th>
                    <th>Siswa</th>
                    <th style="width:36px;">Jenjang</th>
                    <th>Program / Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th style="width:40px;text-align:center;">Nilai</th>
                    <th>Guru</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($hasil as $h): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                        <td><?= $h['nama_siswa'] ?></td>
                        <td>
                            <?php $t = $h['tingkat_program']; ?>
                            <span class="badge badge-<?= strtolower($t) ?>"><?= $t ?></span>
                        </td>
                        <td><?= $h['nama_program'] ?> Kelas <?= $h['kelas'] ?></td>
                        <td><?= $h['mata_pelajaran'] ?></td>
                        <td style="text-align:center;">
                            <?php $n = (float) $h['nilai']; ?>
                            <span class="<?= $n>=85?'nilai-a':($n>=70?'nilai-b':($n>=55?'nilai-c':'nilai-d')) ?>">
                                <?= $h['nilai'] ?>
                            </span>
                        </td>
                        <td><?= $h['nama_pengajar'] ?></td>
                        <td><?= $h['catatan'] ?? '—' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="footer">
        <p>Dicetak oleh sistem pada <?= date('d F Y H:i') ?> WIB</p>
    </div>

    <script>
        // Otomatis print saat halaman dibuka
        // window.onload = () => window.print();
    </script>
</body>
</html>
