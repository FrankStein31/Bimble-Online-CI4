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

    .search-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .search-input {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        width: 250px;
        outline: none;
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

    /* Responsive table */
    .table-container {
        width: 100%;
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

    .status-lunas {
        color: #4CAF50;
        font-weight: bold;
    }

    .status-belum {
        color: #f44336;
        font-weight: bold;
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

    .payment-proof {
        width: 60px;
        height: 30px;
        background-color: #f0f0f0;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
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
    #edit-daffa-modal:target,
    #edit-riyadi-modal:target,
    #delete-daffa-modal:target,
    #delete-riyadi-modal:target,
    #view-daffa-proof:target,
    #view-riyadi-proof:target {
        display: flex;
    }

    .file-upload {
        display: flex;
        align-items: center;
    }

    .file-upload-btn {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 5px 0 0 5px;
        padding: 8px 12px;
        cursor: pointer;
    }

    .file-name {
        border: 1px solid #ced4da;
        border-left: none;
        flex-grow: 1;
        padding: 9px 12px;
        border-radius: 0 5px 5px 0;
        background-color: #f8f9fa;
        color: #6c757d;
    }

    a {
        text-decoration: none;
    }

    .title-container {
        margin: 10px 0 20px 0;
    }

    /* Responsive table for mobile */
    @media screen and (max-width: 768px) {
        .container {
            padding: 15px 10px;
        }

        .search-container {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
            margin-bottom: 10px;
        }

        .add-button {
            width: 100%;
            text-align: center;
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
            min-height: 30px;
            /* Ensures consistent height */
        }

        td:before {
            position: absolute;
            left: 12px;
            top: 12px;
            font-weight: bold;
            text-align: left;
            width: 45%;
            /* Control width of label */
        }

        /* Add labels for each cell on mobile */
        td:nth-of-type(1):before {
            content: "Nama";
        }

        td:nth-of-type(2):before {
            content: "Kelas";
        }

        td:nth-of-type(3):before {
            content: "Nomer Telepon";
        }

        td:nth-of-type(4):before {
            content: "Paket";
        }

        td:nth-of-type(5):before {
            content: "Tagihan";
        }

        td:nth-of-type(6):before {
            content: "Bukti Pembayaran";
        }

        td:nth-of-type(7):before {
            content: "Status";
        }

        td:nth-of-type(8):before {
            content: "Aksi";
        }

        td:last-child {
            border-bottom: none;
        }

        /* Fix for bukti pembayaran alignment */
        td:nth-of-type(6) {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        td:nth-of-type(6):before {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Fix for payment proof element */
        td:nth-of-type(6) .payment-proof {
            margin-left: auto;
        }

        /* Fix for action buttons alignment */
        td:nth-of-type(8) {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        td:nth-of-type(8):before {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
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
            <h1>Daftar Transaksi</h1>
        </div>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Nama Siswa">
            <a href="#add-modal" class="add-button">Tambah Pembayaran</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Nomer Telepon</th>
                        <th>Paket</th>
                        <th>Tagihan</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transaksi)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">Tidak ada data transaksi</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($transaksi as $row): ?>
                            <tr>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['kelas'] ?? '-' ?></td>
                                <td><?= $row['nomor_hp'] ?? '-' ?></td>
                                <td><?= $row['nama_program'] ?></td>
                                <td>Rp <?= number_format($row['tagihan'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($row['photo_bukti']): ?>
                                        <a href="#view-photo-<?= $row['transaksi_id'] ?>" class="payment-proof">📃</a>
                                    <?php else: ?>
                                        <span class="payment-proof" style="background-color: #f8d7da;">❌</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 'lunas'): ?>
                                        <span class="status-lunas">Lunas</span>
                                    <?php elseif ($row['status'] == 'pending'): ?>
                                        <span class="status-belum">Pending</span>
                                    <?php else: ?>
                                        <span class="status-belum">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#delete-modal-<?= $row['transaksi_id'] ?>" class="action-btn delete-btn">🗑️</a>
                                    <a href="#edit-modal-<?= $row['transaksi_id'] ?>" class="action-btn edit-btn">✏️</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Payment Modal -->
    <!-- Di bagian modal tambah transaksi -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Pembayaran</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>
            <form action="<?= base_url('transaksi/add') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">

                <div class="form-group">
                    <label for="user_id">Nama Siswa</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        <option value="">Pilih Siswa</option>
                        <?php foreach ($siswa as $s): ?>
                            <option value="<?= $s['user_id'] ?>"
                                data-telepon="<?= $s['nomor_hp'] ?>">
                                <?= $s['nama'] ?> - <?= $s['nomor_hp'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" id="kelas" name="kelas" class="form-control" placeholder="Contoh: 10 SMA">
                </div>

                <div class="form-group">
                    <label for="telepon">Nomor Telepon</label>
                    <input type="text" id="telepon" name="telepon" class="form-control" placeholder="Contoh: 08123456789" readonly>
                </div>

                <!-- Bagian lainnya tetap sama -->
                <div class="form-group">
                    <label for="program_id">Program Bimbel</label>
                    <select name="program_id" id="program_id" class="form-select" required>
                        <option value="">Pilih Program</option>
                        <?php foreach ($program as $p): ?>
                            <option value="<?= $p['program_id'] ?>" data-harga="<?= $p['harga'] ?>"><?= $p['nama_program'] ?> - <?= $p['tingkat'] ?> Kelas <?= $p['kelas'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tagihan">Tagihan</label>
                    <input type="text" id="tagihan" name="tagihan" class="form-control" placeholder="Contoh: 200000">
                </div>

                <div class="form-group">
                    <label for="photo_bukti">Bukti Pembayaran</label>
                    <input type="file" id="photo_bukti" name="photo_bukti" class="form-control-file" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="">Pilih Status</option>
                        <option value="pending">Pending</option>
                        <option value="lunas">Lunas</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="form-buttons">
                    <a href="#" class="btn btn-gray">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk autofill -->


    <!-- Edit Payment Modal-->

    <?php foreach ($transaksi as $row): ?>
        <div id="edit-modal-<?= $row['transaksi_id'] ?>" class="modal edit-modal">
            <style>
                #edit-modal-<?= $row['transaksi_id'] ?>:target {
                    display: flex;
                }
            </style>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Pembayaran</h3>
                    <a href="#" class="close-modal">&times;</a>
                </div>
                <form action="<?= base_url('transaksi/update/' . $row['transaksi_id']) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="transaksi_id" value="<?= $row['transaksi_id'] ?>">

                    <div class="form-group">
                        <label for="edit-user-<?= $row['transaksi_id'] ?>">Nama Siswa</label>
                        <select name="user_id" id="edit-user-<?= $row['transaksi_id'] ?>" class="form-select" required>
                            <option value="">Pilih Siswa</option>
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s['user_id'] ?>" <?= ($row['user_id'] == $s['user_id']) ? 'selected' : '' ?>><?= $s['nama'] ?> - <?= $s['nomor_hp'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit-program-<?= $row['transaksi_id'] ?>">Program Bimbel</label>
                        <select name="program_id" id="edit-program-<?= $row['transaksi_id'] ?>" class="form-select" required>
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $p): ?>
                                <option value="<?= $p['program_id'] ?>" data-harga="<?= $p['harga'] ?>" <?= ($row['program_id'] == $p['program_id']) ? 'selected' : '' ?>><?= $p['nama_program'] ?> - <?= $p['tingkat'] ?> Kelas <?= $p['kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit-tagihan-<?= $row['transaksi_id'] ?>">Tagihan</label>
                        <input type="number" name="tagihan" id="edit-tagihan-<?= $row['transaksi_id'] ?>" class="form-control" value="<?= $row['tagihan'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="edit-photo-<?= $row['transaksi_id'] ?>">Bukti Pembayaran</label>
                        <?php if ($row['photo_bukti']): ?>
                            <div>
                                <img src="<?= base_url('uploads/bukti_pembayaran/' . $row['photo_bukti']) ?>" alt="Bukti Pembayaran" style="max-width: 200px; margin-bottom: 10px;">
                                <p><small>File saat ini: <?= $row['photo_bukti'] ?></small></p>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="photo_bukti" id="edit-photo-<?= $row['transaksi_id'] ?>" class="form-control-file" accept="image/*">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah bukti pembayaran.</small>
                    </div>

                    <div class="form-group">
                        <label for="edit-status-<?= $row['transaksi_id'] ?>">Status</label>
                        <select name="status" id="edit-status-<?= $row['transaksi_id'] ?>" class="form-select" required>
                            <option value="">Pilih Status</option>
                            <option value="pending" <?= ($row['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="lunas" <?= ($row['status'] == 'lunas') ? 'selected' : '' ?>>Lunas</option>
                            <option value="ditolak" <?= ($row['status'] == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                        </select>
                    </div>

                    <div class="form-buttons">
                        <a href="#" class="btn btn-gray">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($transaksi as $row): ?>
        <style>
            #delete-modal-<?= $row['transaksi_id'] ?>:target {
                display: flex;
            }
        </style>
        <div id="delete-modal-<?= $row['transaksi_id'] ?>" class="modal">
            <div class="modal-content" style="max-width: 400px;">
                <div class="modal-header">
                    <h3 class="modal-title">Konfirmasi Hapus</h3>
                    <a href="#" class="close-modal">&times;</a>
                </div>
                <p>Apakah anda yakin ingin menghapus transaksi pembayaran <?= $row['nama'] ?>?</p>
                <div class="form-buttons">
                    <a href="#" class="btn btn-gray">Batal</a>
                    <a href="<?= base_url('transaksi/delete/' . $row['transaksi_id']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!--  view bukti -->
    <?php foreach ($transaksi as $row): ?>
        <style>
            #view-photo-<?= $row['transaksi_id'] ?>:target {
                display: flex;
            }
        </style>

        <!-- View Photo Modal for this student -->
        <div id="view-photo-<?= $row['transaksi_id'] ?>" class="modal">
            <div class="modal-content" style="max-width: 500px;">
                <div class="modal-header">
                    <h3 class="modal-title">Bukti Pembayaran - <?= $row['nama'] ?></h3>
                    <a href="#" class="close-modal">&times;</a>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <img src="<?= base_url('uploads/bukti_pembayaran/' . $row['photo_bukti']) ?>" alt="Foto <?= $row['nama'] ?>"
                        style="max-width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div class="form-buttons">
                    <a href="#" class="btn btn-primary">Tutup</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>






</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-fill untuk form tambah
        const userSelect = document.getElementById('user_id');
        const teleponInput = document.getElementById('telepon');

        userSelect.addEventListener('change', function() {
            const selectedOption = userSelect.options[userSelect.selectedIndex];

            if (selectedOption.value !== "") {
                // Ambil nomor telepon dari teks option (format: "Nama - 08123456789")
                const optionText = selectedOption.text;
                const telepon = optionText.split(" - ")[1];
                teleponInput.value = telepon;
            } else {
                teleponInput.value = '';
            }
        });

        // Script untuk auto-fill tagihan berdasarkan program
        const programSelect = document.getElementById('program_id');
        const tagihanInput = document.getElementById('tagihan');

        programSelect.addEventListener('change', function() {
            const selectedOption = programSelect.options[programSelect.selectedIndex];

            if (selectedOption.value !== "") {
                tagihanInput.value = selectedOption.getAttribute('data-harga') || '';
            } else {
                tagihanInput.value = '';
            }
        });

        // Fungsi pencarian
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                // Ambil nama siswa dari kolom pertama (indeks 0)
                const namaSiswa = row.cells[0].textContent.toLowerCase();

                // Tampilkan baris jika nama mengandung kata yang dicari, sembunyikan jika tidak
                if (namaSiswa.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>