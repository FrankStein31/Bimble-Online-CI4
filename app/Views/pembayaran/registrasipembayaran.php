<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<style>
   /* Override body background for this page only */
body {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)) !important;
}

/* Main Container */
.jadwal-pembayaran {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 100px);
    padding: 40px 20px;
    margin: 0;
}

/* Form Container */
.form-container {
    width: 100%;
    max-width: 450px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    padding: 32px;
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
}



/* Adjust form content to account for title */
.form-container > * {
    margin-top: 60px;
}

.form-container > *:first-child {
    margin-top: 0;
}

/* Input Fields */
.input-field {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 15px;
    font-family: inherit;
    box-sizing: border-box;
    background-color: #f8fafc;
    transition: all 0.3s ease;
    margin-bottom: 16px;
}

.input-field:focus {
    outline: none;
    border-color: #667eea;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.input-field:read-only {
    background-color: #f1f5f9;
    color: #64748b;
    cursor: not-allowed;
}

.input-field::placeholder {
    color: #94a3b8;
}

/* Select Dropdown */
select.input-field {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 40px;
    cursor: pointer;
}

select.input-field:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
}

/* File Upload */
.file-upload {
    background: #f8fafc;
    border: 2px dashed #cbd5e0;
    border-radius: 10px;
    padding: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 16px;
    position: relative;
}

.file-upload:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.file-upload.has-file {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.file-upload-text {
    color: #64748b;
    font-size: 15px;
    font-weight: 500;
    text-align: center;
}

.file-upload.has-file .file-upload-text {
    color: #667eea;
}

.file-upload::before {
    content: '📁';
    font-size: 1.5rem;
    margin-right: 8px;
}

.file-upload.has-file::before {
    content: '✅';
}

/* Alert Messages */
.alert {
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    text-align: center;
    font-weight: 500;
    border: 1px solid;
}

.alert-danger {
    background: linear-gradient(135deg, #fee, #fdd);
    color: #c53030;
    border-color: #fed7d7;
}

.alert-success {
    background: linear-gradient(135deg, #f0fff4, #e6fffa);
    color: #2f855a;
    border-color: #c6f6d5;
}

/* Button Container */
.button-container {
    display: flex;
    gap: 12px;
    margin-top: 24px;
}

/* Buttons */
.button {
    padding: 14px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    flex: 1;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
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

/* Primary Button (Submit) */
.button[type="submit"],
.button:last-child {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.button[type="submit"]:hover,
.button:last-child:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

/* Secondary Button (Nomor Rekening) */
.button:first-child {
    background: white;
    color: #667eea;
    border: 2px solid #667eea;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
}

.button:first-child:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .jadwal-pembayaran {
        padding: 20px 16px;
        min-height: calc(100vh - 80px);
    }
    
    .form-container {
        max-width: 100%;
        padding: 24px;
        border-radius: 12px;
    }
    
    .form-container::after {
        font-size: 1.3rem;
        top: 16px;
        left: 24px;
        right: 24px;
    }
    
    .input-field {
        padding: 12px 16px;
        font-size: 14px;
    }
    
    .file-upload {
        padding: 16px;
    }
    
    .button {
        padding: 12px 16px;
        font-size: 14px;
    }
    
    .button-container {
        flex-direction: column;
        gap: 10px;
    }
}

@media screen and (max-width: 480px) {
    .jadwal-pembayaran {
        padding: 16px 12px;
    }
    
    .form-container {
        padding: 20px;
        border-radius: 10px;
    }
    
    .form-container::after {
        font-size: 1.2rem;
        top: 14px;
        left: 20px;
        right: 20px;
    }
    
    .input-field {
        padding: 10px 14px;
        margin-bottom: 12px;
    }
    
    .file-upload {
        padding: 14px;
    }
    
    .button {
        padding: 10px 14px;
        font-size: 13px;
    }
    
    .alert {
        padding: 12px 16px;
        font-size: 13px;
    }
}

/* Loading State */
.button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.button:disabled::before {
    display: none;
}

/* Focus States for Accessibility */
.button:focus,
.input-field:focus,
.file-upload:focus-within {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Animation for form appearance */
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

.form-container {
    animation: slideInUp 0.6s ease;
}

/* Smooth transitions for form elements */
.input-field,
.file-upload,
.button {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
<section class="containter jadwal-pembayaran">
    <form class="form-container" action="<?= base_url('registrasi-pembayaran/submit') ?>" method="post" enctype="multipart/form-data">
        <h4 style="margin-top:0;margin-bottom:20px;color:#2d3748;font-size:1.2rem;font-weight:700;">
            📚 Daftar Program Bimbel
            <?php if (session()->get('tingkat')): ?>
                <span style="font-size:0.8rem;background:#667eea;color:white;padding:3px 10px;border-radius:20px;margin-left:8px;">
                    Jenjang <?= session()->get('tingkat') ?>
                </span>
            <?php endif; ?>
        </h4>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- Nama siswa otomatis terisi -->
        <input type="text" class="input-field" name="nama" value="<?= session()->get('nama') ?>" readonly placeholder="Nama">

        <!-- Nomor telepon otomatis terisi -->
        <input type="text" class="input-field" name="nomor_hp" value="<?= session()->get('nomor_hp') ?>" readonly placeholder="No Telp">

        <!-- Pilihan program bimbel (sudah difilter sesuai tingkat siswa) -->
        <select name="program_id" id="program_id" class="input-field" required>
            <option value="">-- Pilih Program Bimbel --</option>
            <?php foreach ($program as $p): ?>
                <option value="<?= $p['program_id'] ?>" data-harga="<?= $p['harga'] ?>">
                    <?= $p['nama_program'] ?> - Kelas <?= $p['kelas'] ?>
                    (Rp <?= number_format($p['harga'], 0, ',', '.') ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Pilihan jadwal -->
        <select name="jadwal_id" id="jadwal_id" class="input-field" required>
            <option value="">-- Pilih Jadwal --</option>
            <?php foreach ($jadwal as $j): ?>
                <option value="<?= $j['jadwal_id'] ?>">
                    <?= $j['hari'] ?> | <?= substr($j['jam_mulai'], 0, 5) ?> - <?= substr($j['jam_selesai'], 0, 5) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Field harga otomatis terisi -->
        <input type="number" name="tagihan" id="tagihan" class="input-field" placeholder="Tagihan (otomatis)" readonly>

        <!-- Info rekening bank -->
        <?php if (!empty($rekening)): ?>
        <div style="background:#f0f9ff;border:1px solid #bfdbfe;border-radius:10px;padding:14px;margin-bottom:16px;font-size:13px;">
            <strong style="color:#1d4ed8;">💳 Transfer ke:</strong>
            <?php foreach ($rekening as $rek): ?>
                <div style="margin-top:6px;color:#1e40af;">
                    <?= $rek['bank'] ?> — <?= $rek['no_rek'] ?> a.n. <strong><?= $rek['nama'] ?></strong>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Upload bukti pembayaran -->
        <label for="bukti_pembayaran" class="file-upload" id="file-upload-label">
            <input type="file" name="photo_bukti" id="bukti_pembayaran" style="display:none" accept="image/*" required>
            <span class="file-upload-text" id="file-name">📷 Upload Bukti Pembayaran</span>
        </label>

        <div class="button-container">
            <a href="<?= base_url('/registrasi-pembayaran/transfer-bank') ?>" class="button">Nomor Rekening</a>
            <button type="submit" class="button">Submit</button>
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const programSelect = document.getElementById('program_id');
        const tagihanInput  = document.getElementById('tagihan');

        programSelect.addEventListener('change', function() {
            const opt = programSelect.options[programSelect.selectedIndex];
            tagihanInput.value = opt.value ? (opt.getAttribute('data-harga') || '') : '';
        });

        const fileInput      = document.getElementById('bukti_pembayaran');
        const fileName       = document.getElementById('file-name');
        const fileUploadLabel = document.getElementById('file-upload-label');

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileName.textContent = '✅ ' + fileInput.files[0].name;
                fileUploadLabel.classList.add('has-file');
            } else {
                fileName.textContent = '📷 Upload Bukti Pembayaran';
                fileUploadLabel.classList.remove('has-file');
            }
        });
    });
</script>
<?= $this->endSection() ?>