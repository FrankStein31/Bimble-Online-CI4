<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4ff;
    min-height: 100vh;
}
/* Hero */
.hero-greeting {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 20px 80px;
    text-align: center; color: white; position: relative; overflow: hidden;
}
.hero-greeting::before {
    content: ''; position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.hero-greeting .inner { position: relative; max-width: 700px; margin: 0 auto; }
.hero-greeting h1 { font-size: 1.9rem; font-weight: 700; margin-bottom: 6px; }
.hero-greeting p  { font-size: 1rem; opacity: .85; }
/* Tabs */
.page-tabs {
    display: flex; justify-content: center; gap: 10px;
    margin: -28px auto 0; position: relative; z-index: 10;
    max-width: 600px; padding: 0 16px;
}
.page-tab {
    flex: 1; padding: 12px 8px; border-radius: 12px; background: white;
    box-shadow: 0 4px 20px rgba(0,0,0,.12); text-align: center;
    text-decoration: none; color: #4a5568; font-size: .78rem; font-weight: 600;
    transition: all .25s; border: 2px solid transparent;
}
.page-tab:hover, .page-tab.active { border-color: #667eea; color: #667eea; box-shadow: 0 6px 24px rgba(102,126,234,.2); transform: translateY(-2px); }
.page-tab .tab-icon { font-size: 1.3rem; display: block; margin-bottom: 3px; }
/* Content */
.history-content { max-width: 900px; margin: 0 auto; padding: 36px 16px 60px; }
.section-title { font-size: 1.1rem; font-weight: 700; color: #2d3748; margin-bottom: 16px; }
/* Table */
.tbl-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.07); border: 1px solid #e2e8f0; overflow-x: auto; }
.tbl-card table { width: 100%; border-collapse: collapse; min-width: 600px; }
.tbl-card thead { background: linear-gradient(135deg, #667eea, #764ba2); color: white; }
.tbl-card th { padding: 16px 14px; font-size: .82rem; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; white-space: nowrap; border: none; }
.tbl-card td { padding: 14px 14px; border-bottom: 1px solid #f1f5f9; font-size: .88rem; color: #4a5568; vertical-align: middle; }
.tbl-card tbody tr:last-child td { border-bottom: none; }
.tbl-card tbody tr:hover td { background: #f8fafc; }
/* Status pills */
.status-pill { display: inline-flex; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 20px; font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; }
.pill-lunas   { background: #d1fae5; color: #065f46; }
.pill-pending { background: #fef3c7; color: #92400e; }
.pill-ditolak { background: #fee2e2; color: #7f1d1d; }
/* Empty */
.empty-state { text-align: center; padding: 60px 24px; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.06); border: 2px dashed #c7d2fe; }
.empty-state .emoji { font-size: 3.5rem; display: block; margin-bottom: 14px; }
.empty-state p { color: #718096; font-size: .9rem; }
/* Table Container */
.table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e2e8f0;
    overflow-x: auto;
}

/* Modern Table Design */
table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    background-color: white;
    min-width: 600px; /* Prevent table from being too cramped on mobile */
}

/* Header Styling */
thead {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

th {
    text-align: left;
    font-weight: 600;
    padding: 20px 16px;
    border: none;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    white-space: nowrap;
}

/* Body Rows */
tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #e2e8f0;
}



tbody tr:last-child {
    border-bottom: none;
}

td {
    padding: 18px 16px;
    border: none;
    vertical-align: middle;
    color: #4a5568;
    font-size: 0.95rem;
}

/* Zebra Striping */
tbody tr:nth-child(even) {
    background: #f8fafc;
}

tbody tr:nth-child(even):hover {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.08));
}

/* Date Column */
.date-col {
    white-space: nowrap;
    font-weight: 500;
    color: #2d3748;
    font-family: 'Segoe UI', monospace;
}

/* Status Badges - Enhanced */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    min-width: 70px;
    justify-content: center;
    transition: all 0.3s ease;
}

.status-lunas {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-lunas::before {
    content: "✓ ";
    margin-right: 4px;
}

.status-pending {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-pending::before {
    content: "⏳ ";
    margin-right: 4px;
}

.status-ditolak {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.status-ditolak::before {
    content: "✗ ";
    margin-right: 4px;
}

/* No Data State */
.no-data {
    text-align: center;
    padding: 60px 40px;
    color: #718096;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 2px dashed #cbd5e0;
}

.no-data p {
    font-size: 1.1rem;
    margin: 0;
    position: relative;
}

.no-data::before {
    content: "📋";
    display: block;
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
}

/* Currency Formatting */
td:nth-child(4) {
    font-weight: 600;
    color: #667eea;
    font-family: 'Segoe UI', monospace;
}

/* Program Name Styling */
td:nth-child(2) {
    font-weight: 600;
    color: #2d3748;
}

/* Level/Class Styling */
td:nth-child(3) {
    color: #667eea;
    font-weight: 500;
}

/* Mobile Responsive */
@media screen and (max-width: 768px) {
    .history {
        padding: 40px 16px;
    }
    
    .page-title {
        font-size: 1.8rem;
        margin-bottom: 30px;
    }
    
    .table-container {
        border-radius: 8px;
        margin: 0 -4px; /* Extend slightly beyond container */
    }
    
    th {
        padding: 16px 12px;
        font-size: 0.85rem;
    }
    
    td {
        padding: 14px 12px;
        font-size: 0.9rem;
    }
    
    tbody tr:hover {
        transform: none; /* Remove transform on mobile for better touch */
    }
    
    .status-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
        min-width: 60px;
    }
    
    .no-data {
        padding: 40px 20px;
        margin: 0 -4px;
    }
}

@media screen and (max-width: 480px) {
    .history {
        padding: 30px 12px;
    }
    
    .page-title {
        font-size: 1.6rem;
        margin-bottom: 24px;
    }
    
    /* Card Layout for Very Small Screens */
    .table-container {
        background: transparent;
        box-shadow: none;
        border: none;
        overflow: visible;
    }
    
    table,
    thead,
    tbody,
    th,
    td,
    tr {
        display: block;
    }
    
    thead {
        display: none; /* Hide table header */
    }
    
    tbody tr {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        margin-bottom: 16px;
        padding: 20px;
        transform: none;
    }
    
    tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    }
    
    td {
        border: none;
        padding: 8px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: left;
    }
    
    td:before {
        content: attr(data-label);
        font-weight: 600;
        color: #4a5568;
        flex: 0 0 40%;
    }
    
    /* Add data labels via CSS */
    td:nth-child(1):before { content: "Tanggal:"; }
    td:nth-child(2):before { content: "Program:"; }
    td:nth-child(3):before { content: "Tingkat:"; }
    td:nth-child(4):before { content: "Jadwal:"; }
    td:nth-child(5):before { content: "Pengajar:"; }
    td:nth-child(6):before { content: "Tagihan:"; }
    td:nth-child(7):before { content: "Status:"; }
    
    .status-badge {
        margin-left: auto;
    }
    
    .no-data {
        padding: 30px 16px;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-container,
.no-data {
    animation: fadeInUp 0.6s ease;
}

tbody tr {
    animation: fadeInUp 0.6s ease;
}

tbody tr:nth-child(1) { animation-delay: 0.1s; }
tbody tr:nth-child(2) { animation-delay: 0.2s; }
tbody tr:nth-child(3) { animation-delay: 0.3s; }
tbody tr:nth-child(4) { animation-delay: 0.4s; }
tbody tr:nth-child(5) { animation-delay: 0.5s; }
</style>

<!-- Hero -->
<div class="hero-greeting">
    <div class="inner">
        <h1>📋 Riwayat Transaksi</h1>
        <p>Lihat semua histori pendaftaran dan status pembayaran Anda</p>
    </div>
</div>

<!-- Tabs -->
<div class="page-tabs">
    <a href="<?= base_url('/registrasi-pembayaran/paket-aktif') ?>" class="page-tab">
        <span class="tab-icon">📚</span>Paket Aktif
    </a>
    <a href="<?= base_url('/registrasi-pembayaran') ?>" class="page-tab">
        <span class="tab-icon">➕</span>Daftar Baru
    </a>
    <a href="<?= base_url('/registrasi-pembayaran/history') ?>" class="page-tab active">
        <span class="tab-icon">📋</span>Riwayat
    </a>
    <a href="<?= base_url('account/profile') ?>" class="page-tab">
        <span class="tab-icon">👤</span>Akun
    </a>
</div>

<div class="history-content">
    <div class="section-title">📋 Semua Riwayat Pembayaran</div>

    <?php if (empty($transaksi)): ?>
        <div class="empty-state">
            <span class="emoji">📭</span>
            <p>Anda belum memiliki riwayat transaksi</p>
        </div>
    <?php else: ?>
        <div class="tbl-card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Daftar</th>
                        <th>Program</th>
                        <th>Tingkat / Kelas</th>
                        <th>Jadwal</th>
                        <th>Pengajar</th>
                        <th>Tagihan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $i => $row): ?>
                        <tr>
                            <td style="color:#a0aec0;font-size:.8rem;"><?= $i + 1 ?></td>
                            <td style="white-space:nowrap;font-weight:500;color:#2d3748;"><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                            <td><strong><?= esc($row['nama_program']) ?></strong></td>
                            <td>
                                <span style="display:inline-block;background:#eef2ff;color:#3730a3;border-radius:6px;padding:2px 8px;font-size:.75rem;font-weight:600;">
                                    <?= esc($row['tingkat']) ?> Kls <?= esc($row['kelas']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($row['jadwal_list'])): ?>
                                    <?php foreach ($row['jadwal_list'] as $jdw): ?>
                                        <div style="white-space:nowrap;line-height:1.8;">
                                            <strong><?= esc($jdw['hari']) ?></strong>
                                            <small style="color:#718096;"> <?= substr($jdw['jam_mulai'],0,5) ?>–<?= substr($jdw['jam_selesai'],0,5) ?> WIB</small>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span style="color:#a0aec0;font-style:italic;font-size:.8rem;">Belum ditentukan</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($row['nama_pengajar'])): ?>
                                    <span style="color:#2f855a;font-weight:600;">👨‍🏫 <?= esc($row['nama_pengajar']) ?></span>
                                <?php else: ?>
                                    <span style="color:#b7791f;font-style:italic;font-size:.8rem;">Menunggu konfirmasi</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight:600;color:#667eea;white-space:nowrap;">Rp <?= number_format($row['tagihan'], 0, ',', '.') ?></td>
                            <td>
                                <?php if ($row['status'] === 'lunas'): ?>
                                    <span class="status-pill pill-lunas">✓ Lunas</span>
                                <?php elseif ($row['status'] === 'pending'): ?>
                                    <span class="status-pill pill-pending">⏳ Pending</span>
                                <?php else: ?>
                                    <span class="status-pill pill-ditolak">✗ Ditolak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>