<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>


<style>
    /* Override body background for this page only */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)) !important;
    }

    /* Main Container */
    .transfer-bank {
        min-height: calc(100vh - 100px);
        padding: 60px 20px;
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Main Card Container */
    .card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    /* Card Title */
    .card-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 30px;
        color: #2d3748;
        line-height: 1.3;
    }

    /* Account Info Container */
    .account-info {
        margin: 20px 0;
        padding: 24px;
        border-radius: 12px;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
    }

    .account-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        border-color: #667eea;
    }

    /* Removed emoji decoration */

    /* Bank Name */
    .account-bank {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 12px;
        color: #667eea;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Account Number */
    .account-number {
        font-size: 1.3rem;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        letter-spacing: 2px;
        margin-bottom: 12px;
        color: #2d3748;
        background: white;
        padding: 12px 16px;
        border-radius: 8px;
        border: 2px dashed #cbd5e0;
        display: inline-block;
        position: relative;
    }

    /* Removed emoji decoration */

    /* Account Name */
    .account-name {
        color: #718096;
        font-size: 0.95rem;
        font-style: italic;
        font-weight: 500;
    }

    /* Back Button */
    .button {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px 32px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        position: relative;
        overflow: hidden;
    }

    .button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .button:hover::before {
        left: 100%;
    }

    .button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
    }

    .button::after {
        content: '←';
        margin-right: 4px;
        font-size: 1.1rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #718096;
        font-size: 1rem;
        line-height: 1.6;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 12px;
        border: 2px dashed #cbd5e0;
        position: relative;
    }

    .empty-state::before {
        content: '';
        display: block;
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #cbd5e0, #a0aec0);
        border-radius: 50%;
        opacity: 0.3;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .transfer-bank {
            padding: 40px 16px;
            min-height: calc(100vh - 80px);
        }

        .card {
            padding: 30px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 1.6rem;
            margin-bottom: 24px;
        }

        .account-info {
            padding: 20px;
            margin: 16px 0;
        }

        .account-number {
            font-size: 1.1rem;
            letter-spacing: 1px;
            padding: 10px 12px;
        }

        .button {
            padding: 14px 28px;
            font-size: 0.95rem;
        }
    }

    @media screen and (max-width: 480px) {
        .transfer-bank {
            padding: 30px 12px;
        }

        .card {
            padding: 24px 20px;
            border-radius: 10px;
        }

        .card-title {
            font-size: 1.4rem;
            margin-bottom: 20px;
        }

        .account-info {
            padding: 16px;
            margin: 12px 0;
        }

        .account-bank {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .account-number {
            font-size: 1rem;
            letter-spacing: 1px;
            padding: 8px 10px;
        }

        .account-number::after {
            display: none;
        }

        .account-name {
            font-size: 0.9rem;
        }

        .button {
            padding: 12px 24px;
            font-size: 0.9rem;
        }

        .empty-state {
            padding: 30px 16px;
        }

        .empty-state::before {
            width: 50px;
            height: 50px;
            margin-bottom: 16px;
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

    .card,
    .button {
        animation: slideInUp 0.6s ease;
    }

    .account-info:nth-child(2) {
        animation-delay: 0.1s;
    }

    .account-info:nth-child(3) {
        animation-delay: 0.2s;
    }

    .account-info:nth-child(4) {
        animation-delay: 0.3s;
    }

    .account-info:nth-child(5) {
        animation-delay: 0.4s;
    }

    /* Focus States for Accessibility */
    .button:focus {
        outline: 2px solid #667eea;
        outline-offset: 2px;
    }

    /* Copy functionality hint */
    .account-number:hover {
        background: #f7fafc;
        cursor: pointer;
    }

    .account-number:active {
        transform: scale(0.98);
    }
</style>
<section class="container transfer-bank">
    <div class="card">
        <div class="card-title">Transfer Bank</div>
        <?php if (empty($bankAccounts)): ?>
            <div style="text-align: center; padding: 20px;">
                Tidak ada informasi rekening bank saat ini.
            </div>
        <?php else: ?>
            <?php foreach ($bankAccounts as $account): ?>
                <div class="account-info">
                    <div class="account-bank"><?= $account['bank'] ?></div>
                    <div class="account-number"><?= $account['no_rek'] ?></div>
                    <div class="account-name">a.n <?= $account['nama'] ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <a href="<?= base_url('/registrasi-pembayaran') ?>" class="button">Kembali</a>
</section>

<?= $this->endSection() ?>