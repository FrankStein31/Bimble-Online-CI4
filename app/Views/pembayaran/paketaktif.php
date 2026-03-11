<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>

<style>
   /* Override body background for this page only */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)) !important;
}

/* Main Container */
.paket-aktif {
    min-height: calc(100vh - 100px);
    padding: 60px 20px;
    max-width: 1000px;
    margin: 0 auto;
}

/* Page Title */
.paket-aktif h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.2rem;
    color: #2d3748;
    font-weight: 600;
}

/* Course Card */
.course-card {
    background: white;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 24px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.course-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.course-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

/* Course Title */
.course-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 16px;
    color: #2d3748;
    line-height: 1.3;
}

/* Course Details Layout */
.course-details {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 24px;
}

.course-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

/* Course Info Items */
.course-class,
.course-price,
.course-description {
    font-size: 15px;
    line-height: 1.5;
    display: flex;
    align-items: flex-start;
}

.course-class {
    color: #667eea;
    font-weight: 600;
}

.course-price {
    color: #2d3748;
    font-weight: 600;
    font-family: 'Segoe UI', monospace;
}

.course-description {
    color: #718096;
}

/* Status Info */
.course-status-info {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    color: #4a5568;
}

/* Enhanced Status Badges */
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

/* Course Status Link */
.course-status {
    flex-shrink: 0;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    border: 2px solid #667eea;
    background: white;
    transition: all 0.3s ease;
    text-align: center;
    min-width: 120px;
}

.course-status:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

/* No Package State */
.no-package {
    text-align: center;
    background: white;
    padding: 60px 40px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 2px dashed #cbd5e0;
    max-width: 600px;
    margin: 0 auto;
}

.no-package::before {
    content: "📦";
    display: block;
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.no-package h3 {
    margin-bottom: 16px;
    color: #4a5568;
    font-size: 1.3rem;
    font-weight: 600;
}

.no-package p {
    color: #718096;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 24px;
}

/* Register Button */
.register-btn {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    position: relative;
    overflow: hidden;
}

.register-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
}

.register-btn:hover::before {
    left: 100%;
}

.register-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .paket-aktif {
        padding: 40px 16px;
    }
    
    .paket-aktif h2 {
        font-size: 1.8rem;
        margin-bottom: 30px;
    }
    
    .course-card {
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    
    .course-details {
        flex-direction: column;
        gap: 20px;
    }
    
    .course-status {
        align-self: flex-start;
        min-width: auto;
    }
    
    .course-title {
        font-size: 1.2rem;
    }
    
    .course-class,
    .course-price,
    .course-description {
        font-size: 14px;
    }
    
    .no-package {
        padding: 40px 24px;
        margin: 0 -4px;
    }
    
    .no-package h3 {
        font-size: 1.2rem;
    }
    
    .register-btn {
        padding: 12px 24px;
        font-size: 14px;
    }
}

@media screen and (max-width: 480px) {
    .paket-aktif {
        padding: 30px 12px;
    }
    
    .paket-aktif h2 {
        font-size: 1.6rem;
        margin-bottom: 24px;
    }
    
    .course-card {
        padding: 20px;
        border-radius: 10px;
    }
    
    .course-title {
        font-size: 1.1rem;
    }
    
    .course-info {
        gap: 10px;
    }
    
    .course-details {
        gap: 16px;
    }
    
    .status-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }
    
    .no-package {
        padding: 30px 20px;
    }
    
    .no-package::before {
        font-size: 3rem;
        margin-bottom: 16px;
    }
    
    .no-package h3 {
        font-size: 1.1rem;
    }
    
    .register-btn {
        padding: 10px 20px;
        font-size: 13px;
    }
}

/* Loading Animation */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.course-card,
.no-package {
    animation: slideInUp 0.6s ease;
}

.course-card:nth-child(2) { animation-delay: 0.1s; }
.course-card:nth-child(3) { animation-delay: 0.2s; }
.course-card:nth-child(4) { animation-delay: 0.3s; }

/* Additional Info Labels */
.course-class::before,
.course-price::before,
.course-description::before,
.course-jadwal::before,
.course-pengajar::before {
    font-weight: 600;
    color: #4a5568;
    min-width: 80px;
    margin-right: 8px;
}

.course-class::before    { content: "Kelas:"; }
.course-price::before    { content: "Harga:"; }
.course-description::before { content: "Keterangan:"; }
.course-jadwal::before   { content: "📅 Jadwal:"; }
.course-pengajar::before { content: "👨‍🏫 Pengajar:"; }

.course-jadwal {
    color: #2d3748;
    font-weight: 500;
    display: flex;
    align-items: flex-start;
}

.course-pengajar {
    color: #2d3748;
    font-weight: 500;
    display: flex;
    align-items: flex-start;
}

.pengajar-assigned {
    color: #2f855a;
    font-weight: 600;
}

.pengajar-pending {
    color: #b7791f;
    font-style: italic;
}

/* Focus States for Accessibility */
.course-status:focus,
.register-btn:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Hover Animations */
.course-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.course-status,
.register-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

<section class="container paket-aktif">
    <h2>Paket Aktif Anda</h2>

    <?php if (empty($transaksi)): ?>
        <div class="no-package">
            <h3>Anda belum memiliki paket aktif</h3>
            <p>Silakan melakukan registrasi pembayaran untuk memulai bimbel.</p>
            <a href="<?= base_url('/registrasi-pembayaran') ?>" class="register-btn">Registrasi Sekarang</a>
        </div>
    <?php else: ?>
        <?php foreach ($transaksi as $paket): ?>
            <div class="course-card">
                <div class="course-title"><?= esc($paket['nama_program']) ?></div>
                <div class="course-details">
                    <div class="course-info">
                        <div class="course-class">Kelas: <?= esc($paket['tingkat']) ?> <?= esc($paket['kelas']) ?></div>
                        <div class="course-price">Harga: Rp <?= number_format($paket['harga'], 0, ',', '.') ?></div>
                        <div class="course-description">Keterangan: <?= esc($paket['keterangan'] ?? 'Tidak ada keterangan') ?></div>

                        <?php if (!empty($paket['hari'])): ?>
                        <div class="course-jadwal">
                            <?= esc($paket['hari']) ?>
                            <?php if (!empty($paket['jam_mulai'])): ?>
                                &nbsp;|&nbsp; <?= substr($paket['jam_mulai'], 0, 5) ?> – <?= substr($paket['jam_selesai'], 0, 5) ?> WIB
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                        <div class="course-jadwal"><span style="color:#a0aec0;font-style:italic;">Jadwal belum diatur</span></div>
                        <?php endif; ?>

                        <div class="course-pengajar">
                            <?php if (!empty($paket['nama_pengajar'])): ?>
                                <span class="pengajar-assigned"><?= esc($paket['nama_pengajar']) ?></span>
                            <?php else: ?>
                                <span class="pengajar-pending">Pengajar akan di-assign setelah konfirmasi pembayaran</span>
                            <?php endif; ?>
                        </div>

                        <div class="course-status-info">
                            Status:
                            <?php if ($paket['status'] == 'lunas'): ?>
                                <span class="status-badge status-lunas">Lunas</span>
                            <?php elseif ($paket['status'] == 'pending'): ?>
                                <span class="status-badge status-pending">Pending</span>
                            <?php else: ?>
                                <span class="status-badge status-ditolak">Ditolak</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="<?= base_url('/registrasi-pembayaran/history') ?>" class="course-status">Lihat History</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>