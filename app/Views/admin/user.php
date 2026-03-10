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
            content: "No. HP";
        }

        td:nth-of-type(3):before {
            content: "Email";
        }

        td:nth-of-type(4):before {
            content: "Role";
        }

        td:nth-of-type(5):before {
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
            <h1>Daftar User</h1>
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
            <a href="#add-modal" class="add-button">Tambah User</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($user) && count($user) > 0): ?>
                    <?php foreach ($user as $u): ?>
                        <tr>
                            <td><?= $u['nama'] ?></td>
                            <td><?= $u['nomor_hp'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= ucfirst($u['role']) ?></td>
                            <td>
                                <a href="#delete-<?= $u['user_id'] ?>" class="action-btn delete-btn">🗑️</a>
                                <a href="#edit-<?= $u['user_id'] ?>" class="action-btn edit-btn">✏️</a>
                            </td>
                        </tr>
                        <style>
                            #edit-<?= $u['user_id'] ?>:target,
                            #delete-<?= $u['user_id'] ?>:target {
                                display: flex;
                            }
                        </style>

                        <!-- Edit Modal for this user -->
                        <div id="edit-<?= $u['user_id'] ?>" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit User</h3>
                                    <a href="#" class="close-modal">&times;</a>
                                </div>
                                <form action="<?= base_url('user/update/' . $u['user_id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="name-<?= $u['user_id'] ?>">Nama</label>
                                        <input type="text" id="name-<?= $u['user_id'] ?>" name="name" class="form-control" value="<?= $u['nama'] ?>" placeholder="contoh: Daffa Riyadi">
                                    </div>
                                    <div class="form-group">
                                        <label for="email-<?= $u['user_id'] ?>">Email</label>
                                        <input type="email" id="email-<?= $u['user_id'] ?>" name="email" class="form-control" value="<?= $u['email'] ?>" placeholder="contoh: email@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_hp-<?= $u['user_id'] ?>">Nomor HP</label>
                                        <input type="text" id="nomor_hp-<?= $u['user_id'] ?>" name="nomor_hp" class="form-control" value="<?= $u['nomor_hp'] ?>" placeholder="contoh: 081231232">
                                    </div>
                                    <div class="form-group">
                                        <label for="role-<?= $u['user_id'] ?>">Role</label>
                                        <select id="role-<?= $u['user_id'] ?>" name="role" class="form-select">
                                            <option value="admin" <?= $u['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="siswa" <?= $u['role'] == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                                            <!-- <option value="pengajar" <?= $u['role'] == 'pengajar' ? 'selected' : '' ?>>Pengajar</option> -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-<?= $u['user_id'] ?>">Password</label>
                                        <input type="password" id="password-<?= $u['user_id'] ?>" name="password" class="form-control" placeholder="Biarkan kosong jika tidak ingin mengubah password">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                    </div>

                                    <div class="form-buttons">
                                        <a href="#" class="btn btn-gray">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal for this user -->
                        <div id="delete-<?= $u['user_id'] ?>" class="modal">
                            <div class="modal-content" style="max-width: 400px;">
                                <div class="modal-header">
                                    <h3 class="modal-title">Konfirmasi Hapus</h3>
                                    <a href="#" class="close-modal">&times;</a>
                                </div>
                                <p>Apakah anda yakin ingin menghapus user "<?= $u['nama'] ?>"?</p>
                                <div class="form-buttons">
                                    <a href="#" class="btn btn-gray">Batal</a>
                                    <a href="<?= base_url('user/delete/' . $u['user_id']) ?>" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data user</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah User Baru</h3>
                <a href="#" class="close-modal">&times;</a>
            </div>
            <form action="<?= base_url('user/add') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="contoh: Daffa Riyadi" value="<?= old('name') ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="contoh: email@gmail.com" value="<?= old('email') ?>">
                </div>
                <div class="form-group">
                    <label for="nomor_hp">Nomor HP</label>
                    <input type="text" id="nomor_hp" name="nomor_hp" class="form-control" placeholder="contoh: 081231232" value="<?= old('nomor_hp') ?>">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="form-select">
                        <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="siswa" <?= old('role') == 'siswa' ? 'selected' : '' ?> selected>Siswa</option>
                        <!-- <option value="pengajar" <?= old('role') == 'pengajar' ? 'selected' : '' ?>>Pengajar</option> -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
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
</script>

<?= $this->endSection() ?>