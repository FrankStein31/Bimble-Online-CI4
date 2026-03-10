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
            content: "Bank";
        }

        td:nth-of-type(2):before {
            content: "No Rek";
        }

        td:nth-of-type(3):before {
            content: "Nama";
        }

        td:nth-of-type(4):before {
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
            <h1>Daftar Nomor Rekening</h1>
        </div>
        <div class="top-container">
            <a href="#add-modal" class="add-button">Tambah Rekening</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>No Rekening</th>
                    <th>Nama Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekening as $rek) : ?>
                    <tr>
                        <td><?= $rek['bank'] ?></td>
                        <td><?= $rek['no_rek'] ?></td>
                        <td><?= $rek['nama'] ?></td>
                        <td>
                            <a href="#delete-<?= $rek['rekening_id'] ?>" class="action-btn delete-btn">🗑️</a>
                            <a href="#edit-<?= $rek['rekening_id'] ?>" class="action-btn edit-btn">✏️</a>
                        </td>
                    </tr>
                    <style>
                        #edit-<?= $rek['rekening_id'] ?>:target,
                        #delete-<?= $rek['rekening_id'] ?>:target {
                            display: flex;
                        }
                    </style>

                    <!-- Edit Schedule Modal -->
                    <div id="edit-<?= $rek['rekening_id'] ?>" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Rekening</h3>
                                <a href="#" class="close-modal">&times;</a>
                            </div>
                            <form action="<?= base_url('rekening/update/' . $rek['rekening_id']) ?>" method="post">
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <input type="text" name="bank" value="<?= $rek['bank'] ?>" id="bank" class="form-control" placeholder="contoh: BCA">
                                </div>
                                <div class="form-group">
                                    <label for="noRek">Nomor Rekening</label>
                                    <input name="no_rek" type="text" value="<?= $rek['no_rek'] ?>" id="noRek" class="form-control" placeholder="contoh: 00119923">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input name="nama" type="text" value="<?= $rek['nama'] ?>" id="nama" class="form-control" placeholder="contoh: Daffa Riyadi">
                                </div>
                                <div class="form-buttons">
                                    <a href="#" class="btn btn-gray">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="delete-<?= $rek['rekening_id'] ?>" class="modal">
                        <div class="modal-content" style="max-width: 400px;">
                            <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Hapus</h3>
                                <a href="#" class="close-modal">&times;</a>
                            </div>
                            <p>Apakah anda yakin ingin menghapus nomor rekening ini?</p>
                            <div class="form-buttons">
                                <a href="#" class="btn btn-gray">Batal</a>
                                <a href="<?= base_url('rekening/delete/' . $rek['rekening_id']) ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <!-- Add Schedule Modal -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Rekening Baru</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>
            <form action="<?= base_url('rekening/add') ?>" method="post">
                <div class="form-group">
                    <label for="bank">Bank</label>
                    <input name="bank" type="text" id="bank" class="form-control" placeholder="contoh: BCA">
                </div>
                <div class="form-group">
                    <label for="noRek">Nomor Rekening</label>
                    <input type="text" name="no_rek" id="noRek" class="form-control" placeholder="contoh: 00119923">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="contoh: Daffa Riyadi">
                </div>
                <div class="form-buttons">
                    <a href="#" class="btn btn-gray">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</section>
<?= $this->endSection() ?>