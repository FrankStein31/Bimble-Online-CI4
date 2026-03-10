<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<style>
    /* History Section */
.history {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 60px 20px;
    max-width: 1000px;
    margin: 0 auto;
    min-height: calc(100vh - 200px);
}

.page-title {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.2rem;
    color: #2d3748;
    font-weight: 600;
}

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
    td:nth-child(4):before { content: "Tagihan:"; }
    td:nth-child(5):before { content: "Status:"; }
    
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
<section class="container history">
    <h2 class="page-title">Riwayat Transaksi</h2>

    <?php if (empty($transaksi)): ?>
        <div class="no-data">
            <p>Anda belum memiliki riwayat transaksi</p>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Program</th>
                        <th>Tingkat/Kelas</th>
                        <th>Tagihan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $row): ?>
                        <tr>
                            <td class="date-col"><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                            <td><?= $row['nama_program'] ?></td>
                            <td><?= $row['tingkat'] ?> <?= $row['kelas'] ?></td>
                            <td>Rp <?= number_format($row['tagihan'], 0, ',', '.') ?></td>
                            <td>
                                <?php if ($row['status'] == 'lunas'): ?>
                                    <span class="status-badge status-lunas">Lunas</span>
                                <?php elseif ($row['status'] == 'pending'): ?>
                                    <span class="status-badge status-pending">Pending</span>
                                <?php else: ?>
                                    <span class="status-badge status-ditolak">Ditolak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>