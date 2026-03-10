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
        z-index: 1050;
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
    #delete-modal:target,
    #view-photo-modal:target {
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
            content: "Prodi";
        }

        td:nth-of-type(3):before {
            content: "Kampus";
        }

        td:nth-of-type(4):before {
            content: "Tahun";
        }

        td:nth-of-type(5):before {
            content: "Foto";
        }

        td:nth-of-type(6):before {
            content: "Aksi";
        }

        td:last-child {
            border-bottom: none;
        }

        /* Fix for photo alignment */
        td:nth-of-type(5) {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        td:nth-of-type(5):before {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Fix for photo proof element */
        td:nth-of-type(5) .payment-proof {
            margin-left: auto;
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
            <h1>Daftar Siswa Diterima PTN</h1>
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

        <div class="search-container">
            <input type="text" class="search-input" placeholder="Nama Siswa" id="searchInput">
            <a href="#add-modal" class="add-button">Tambah Siswa</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Nama Kampus</th>
                        <th>Tahun Diterima</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($siswa) && count($siswa) > 0): ?>
                        <?php foreach ($siswa as $s): ?>
                            <tr>
                                <td><?= $s['nama_siswa'] ?></td>
                                <td><?= $s['prodi'] ?></td>
                                <td><?= $s['nama_kampus'] ?></td>
                                <td><?= $s['tahun_diterima'] ?></td>
                                <td>
                                    <?php if ($s['photo']): ?>
                                        <a href="#view-photo-<?= $s['siswa_id'] ?>" class="payment-proof">📃</a>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#delete-<?= $s['siswa_id'] ?>" class="action-btn delete-btn">🗑️</a>
                                    <a href="#edit-<?= $s['siswa_id'] ?>" class="action-btn edit-btn">✏️</a>
                                </td>
                            </tr>
                            <style>
                                #edit-<?= $s['siswa_id'] ?>:target,
                                #view-photo-<?= $s['siswa_id'] ?>:target,
                                #delete-<?= $s['siswa_id'] ?>:target {
                                    display: flex;
                                }
                            </style>

                            <!-- View Photo Modal for this student -->
                            <div id="view-photo-<?= $s['siswa_id'] ?>" class="modal">
                                <div class="modal-content" style="max-width: 500px;">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Foto - <?= $s['nama_siswa'] ?></h3>
                                        <a href="#" class="close-modal">&times;</a>
                                    </div>
                                    <div style="text-align: center; padding: 20px;">
                                        <img src="<?= base_url('uploads/siswa-ptn/' . $s['photo']) ?>" alt="Foto <?= $s['nama_siswa'] ?>"
                                            style="max-width: 100%; border: 1px solid #ddd; border-radius: 4px;">
                                    </div>
                                    <div class="form-buttons">
                                        <a href="#" class="btn btn-primary">Tutup</a>
                                    </div>
                                </div>
                            </div>


                            <!-- Edit Modal for this student -->
                            <div id="edit-<?= $s['siswa_id'] ?>" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Data Siswa</h3>
                                        <a href="#" class="close-modal">&times;</a>
                                    </div>
                                    <form action="<?= base_url('siswa-ptn/update/' . $s['siswa_id']) ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label for="nama-<?= $s['siswa_id'] ?>">Nama Siswa</label>
                                            <input type="text" id="nama-<?= $s['siswa_id'] ?>" name="nama" class="form-control" value="<?= $s['nama_siswa'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="prodi-<?= $s['siswa_id'] ?>">Program Studi</label>
                                            <input type="text" id="prodi-<?= $s['siswa_id'] ?>" name="prodi" class="form-control" value="<?= $s['prodi'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kampus-<?= $s['siswa_id'] ?>">Nama Kampus</label>
                                            <input type="text" id="kampus-<?= $s['siswa_id'] ?>" name="kampus" class="form-control" value="<?= $s['nama_kampus'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun-<?= $s['siswa_id'] ?>">Tahun Diterima</label>
                                            <input type="text" id="tahun-<?= $s['siswa_id'] ?>" name="tahun" class="form-control" value="<?= $s['tahun_diterima'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="foto-<?= $s['siswa_id'] ?>">Foto</label>
                                            <input type="file" id="foto-<?= $s['siswa_id'] ?>" name="foto" class="form-control-file" accept="image/*">
                                            <?php if ($s['photo']): ?>
                                                <small class="text-muted">File saat ini: <?= $s['photo'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-buttons">
                                            <a href="#" class="btn btn-gray">Batal</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Confirmation Modal for this student -->
                            <div id="delete-<?= $s['siswa_id'] ?>" class="modal">
                                <div class="modal-content" style="max-width: 400px;">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Konfirmasi Hapus</h3>
                                        <a href="#" class="close-modal">&times;</a>
                                    </div>
                                    <p>Apakah anda yakin ingin menghapus data siswa <?= $s['nama_siswa'] ?>?</p>
                                    <div class="form-buttons">
                                        <a href="#" class="btn btn-gray">Batal</a>
                                        <a href="<?= base_url('siswa-ptn/delete/' . $s['siswa_id']) ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Tidak ada data siswa</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Siswa PTN</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>
            <form action="<?= base_url('siswa-ptn/add') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" id="nama_siswa" name="nama_siswa" class="form-control" placeholder="Masukkan nama siswa" value="<?= old('nama') ?>">

                </div>
                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" class="form-control" placeholder="Contoh: Teknik Informatika" value="<?= old('prodi') ?>">

                </div>
                <div class="form-group">
                    <label for="kampus">Nama Kampus</label>
                    <input type="text" id="kampus" name="kampus" class="form-control" placeholder="Contoh: Universitas Indonesia" value="<?= old('kampus') ?>">

                </div>
                <div class="form-group">
                    <label for="tahun">Tahun Diterima</label>
                    <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Contoh: 2023" value="<?= old('tahun') ?>">

                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto" class="form-control-file" accept="image/*">
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
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const prodi = row.cells[1].textContent.toLowerCase();
            const campus = row.cells[2].textContent.toLowerCase();

            if (name.includes(searchValue) || prodi.includes(searchValue) || campus.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Auto hide flash messages after 5 seconds
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(message => {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s';
            setTimeout(() => message.style.display = 'none', 500);
        });
    }, 5000);
</script>

<?= $this->endSection() ?>