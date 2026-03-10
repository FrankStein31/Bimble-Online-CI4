<?= $this->extend('layouts/sidebar') ?>
<?= $this->section('content') ?>
<style>
    /* Base styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .top-container {
        margin-bottom: 20px;
    }

    .add-button {
        background-color: #4285f4;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 15px;
        cursor: pointer;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: white;
        text-align: left;
        padding: 12px 8px;
        border-bottom: 2px solid #ddd;
    }

    td {
        padding: 12px 8px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .action-btn {
        background: none;
        border: none;
        cursor: pointer;
        margin-right: 5px;
        font-size: 18px;
    }

    .delete-btn {
        color: #f44336;
    }

    .edit-btn {
        color: #2196F3;
    }

    .form-control-file {
        display: block;
        width: 100%;
        padding: 8px 0;
    }

    /* Modal styling */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 500px;
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        position: sticky;
        top: 0;
        background: white;
        z-index: 1;
    }

    .modal-title {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #777;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: white;
    }

    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #4285f4;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-gray {
        background-color: #e0e0e0;
        color: #333;
    }

    /* Show modals with :target selector */
    #add-modal:target,
    #edit-modal:target,
    #delete-modal:target {
        display: flex;
    }

    a {
        text-decoration: none;
    }

    .title-container {
        margin: 10px 0 20px 0;
    }

    /* Flash Messages */
    .flash-message {
        padding: 12px 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .flash-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .flash-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Responsive table for mobile */
    @media screen and (max-width: 768px) {
        .container {
            padding: 15px 10px;
        }

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        td {
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
            text-align: right;
        }

        td:before {
            position: absolute;
            left: 12px;
            top: 12px;
            font-weight: bold;
            text-align: left;
        }

        /* Add labels for each cell on mobile */
        td:nth-of-type(1):before {
            content: "Nama";
        }

        td:nth-of-type(2):before {
            content: "Durasi";
        }

        td:nth-of-type(3):before {
            content: "Tingkat";
        }

        td:nth-of-type(4):before {
            content: "Kelas";
        }

        td:nth-of-type(5):before {
            content: "Harga";
        }

        td:nth-of-type(6):before {
            content: "Aksi";
        }

        td:last-child {
            border-bottom: none;
        }

        .top-container {
            text-align: center;
        }

        .add-button {
            display: inline-block;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        .modal-content {
            padding: 15px;
            width: 95%;
        }
    }
</style>

<section>
    <div class="container">
        <div class="title-container">
            <h1>Daftar Program Bimbel</h1>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-message flash-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-message flash-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="top-container">
            <a href="#add-modal" class="add-button">Tambah Program</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Durasi</th>
                    <th>Tingkat</th>
                    <th>Kelas</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($program) && count($program) > 0): ?>
                    <?php foreach ($program as $p): ?>
                        <tr>
                            <td><?= $p['nama_program'] ?></td>
                            <td><?= $p['durasi'] ?></td>
                            <td><?= $p['tingkat'] ?></td>
                            <td><?= $p['kelas'] ?></td>
                            <td>Rp.
                                <?php
                                // Format harga ke format Rupiah (tanpa decimal)
                                $harga = $p['harga'];

                                // Remove decimal part if it's .00
                                if (substr($harga, -3) === '.00') {
                                    $harga = substr($harga, 0, -3);
                                }

                                // Format with thousand separator
                                if (is_numeric($harga)) {
                                    echo number_format((float)$harga, 0, '', '.');
                                } else {
                                    echo $harga; // If not numeric, display as is
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#delete-<?= $p['program_id'] ?>" class="action-btn delete-btn">🗑️</a>
                                <a href="#edit-<?= $p['program_id'] ?>" class="action-btn edit-btn">✏️</a>
                            </td>
                        </tr>
                        <style>
                            #edit-<?= $p['program_id'] ?>:target,
                            #delete-<?= $p['program_id'] ?>:target {
                                display: flex;
                            }
                        </style>

                        <!-- Edit Modal for this program -->
                        <div id="edit-<?= $p['program_id'] ?>" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit Program</h3>
                                    <a href="#" class="close-modal">&times;</a>
                                </div>
                                <form action="<?= base_url('program/update/' . $p['program_id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="program-<?= $p['program_id'] ?>">Nama</label>
                                        <input type="text" id="program-<?= $p['program_id'] ?>" name="program" class="form-control" value="<?= $p['nama_program'] ?>" placeholder="contoh: Bimbel SMA">
                                    </div>
                                    <div class="form-group">
                                        <label for="durasi-<?= $p['program_id'] ?>">Durasi</label>
                                        <input type="text" id="durasi-<?= $p['program_id'] ?>" name="durasi" class="form-control" value="<?= $p['durasi'] ?>" placeholder="contoh: 1 Bulan">
                                    </div>
                                    <div class="form-group">
                                        <label for="tingkat-<?= $p['program_id'] ?>">Tingkat</label>
                                        <input type="text" id="tingkat-<?= $p['program_id'] ?>" name="tingkat" class="form-control" value="<?= $p['tingkat'] ?>" placeholder="contoh: SMA">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas-<?= $p['program_id'] ?>">Kelas</label>
                                        <input type="text" id="kelas-<?= $p['program_id'] ?>" name="kelas" class="form-control" value="<?= $p['kelas'] ?>" placeholder="contoh: 10">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga-<?= $p['program_id'] ?>">Harga</label>
                                        <input type="text" id="harga-<?= $p['program_id'] ?>" name="harga" class="form-control"
                                            value="<?php
                                                    $harga = $p['harga'];
                                                    $numeric_value = preg_replace('/[^0-9]/', '', preg_replace('/\.00$/', '', $harga));
                                                    echo $numeric_value;
                                                    ?>"
                                            placeholder="contoh: 200000"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            onblur="formatCurrency(this)">
                                        <small class="text-muted">Input angka saja tanpa titik atau koma</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan-<?= $p['program_id'] ?>">Keterangan</label>
                                        <textarea
                                            id="keterangan-<?= $p['program_id'] ?>"
                                            name="keterangan"
                                            class="form-control"
                                            placeholder="Masukkan keterangan program"
                                            rows="4"><?= $p['keterangan'] ?></textarea>
                                    </div>

                                    <div class="form-buttons">
                                        <a href="#" class="btn btn-gray">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal for this program -->
                        <div id="delete-<?= $p['program_id'] ?>" class="modal">
                            <div class="modal-content" style="max-width: 400px;">
                                <div class="modal-header">
                                    <h3 class="modal-title">Konfirmasi Hapus</h3>
                                    <a href="#" class="close-modal">&times;</a>
                                </div>
                                <p>Apakah anda yakin ingin menghapus program "<?= $p['nama_program'] ?>"?</p>
                                <div class="form-buttons">
                                    <a href="#" class="btn btn-gray">Batal</a>
                                    <a href="<?= base_url('program/delete/' . $p['program_id']) ?>" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada program bimbel yang tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Program Modal -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Program Bimbel</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>
            <form action="<?= base_url('program/add') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="program">Nama</label>
                    <input type="text" id="program" name="program" class="form-control" placeholder="contoh: Bimbel SMA" value="<?= old('program') ?>">
                </div>
                <div class="form-group">
                    <label for="durasi">Durasi</label>
                    <input type="text" id="durasi" name="durasi" class="form-control" placeholder="contoh: 1 Bulan" value="<?= old('durasi') ?>">
                </div>
                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <input type="text" id="tingkat" name="tingkat" class="form-control" placeholder="contoh: SMA" value="<?= old('tingkat') ?>">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" id="kelas" name="kelas" class="form-control" placeholder="contoh: 10" value="<?= old('kelas') ?>">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" id="harga" name="harga" class="form-control"
                        placeholder="contoh: 200000"
                        value="<?= old('harga') ?>"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        onblur="formatCurrency(this)">
                    <small class="text-muted">Input angka saja tanpa titik atau koma</small>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control"
                        placeholder="Masukkan keterangan program"
                        rows="4"><?= old('keterangan') ?></textarea>
                </div>

                <div class="form-buttons">
                    <a href="#" class="btn btn-gray">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    // Auto hide flash messages after 5 seconds
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(message => {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s';
            setTimeout(() => message.style.display = 'none', 500);
        });
    }, 5000);

    // Format currency function for price fields
    function formatCurrency(input) {
        // Only continue if the input has a value
        if (input.value) {
            // Store the caret position
            const caretPos = input.selectionStart;
            // Store original length
            const originalLength = input.value.length;

            // Format the number without decimal places
            const numericValue = input.value.replace(/[^0-9]/, '').replace(/\.00$/, '');

            // Show formatted value in a tooltip or help text
            const formattedValue = new Intl.NumberFormat('id-ID', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(numericValue);

            // Find the small text element next to the input
            const helpTextElement = input.nextElementSibling;
            if (helpTextElement && helpTextElement.tagName === 'SMALL') {
                helpTextElement.textContent = `Format Rupiah: ${formattedValue}`;
            }
        }
    }

    // Apply formatting to all price inputs on page load
    document.addEventListener('DOMContentLoaded', function() {
        const priceInputs = document.querySelectorAll('input[name="harga"]');
        priceInputs.forEach(input => {
            formatCurrency(input);
        });
    });
</script>

<?= $this->endSection() ?>