<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Bimbel Harapan</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; }
        body { min-height:100vh; background:#f8fafc; display:flex; flex-direction:column; }

        /* Navbar */
        .navbar {
            background:linear-gradient(135deg,#667eea,#764ba2);
            padding:13px 24px; display:flex; justify-content:space-between;
            align-items:center; box-shadow:0 2px 12px rgba(102,126,234,.4);
            position:sticky; top:0; z-index:100;
        }
        .navbar-brand { display:flex; align-items:center; gap:12px; }
        .navbar-brand img { width:44px; height:44px; border-radius:8px; object-fit:cover; }
        .navbar-brand span { color:white; font-weight:700; font-size:1rem; }
        .btn-back {
            display:inline-flex; align-items:center; gap:6px;
            background:rgba(255,255,255,.2); color:white;
            text-decoration:none; padding:7px 16px; border-radius:8px;
            font-size:.875rem; font-weight:600; border:1px solid rgba(255,255,255,.3);
            transition:.2s;
        }
        .btn-back:hover { background:rgba(255,255,255,.3); }

        /* Page body */
        .page-body {
            flex:1; display:flex; justify-content:center; align-items:flex-start;
            padding:40px 20px;
        }

        /* Card */
        .profile-card {
            background:white; border-radius:16px; width:100%; max-width:480px;
            box-shadow:0 8px 30px rgba(0,0,0,.1); border:1px solid #e2e8f0;
            overflow:hidden; animation:slideUp .4s ease;
        }
        @keyframes slideUp { from{transform:translateY(24px);opacity:0} to{transform:translateY(0);opacity:1} }

        /* Card header */
        .card-header {
            background:linear-gradient(135deg,#667eea,#764ba2);
            padding:22px 28px 18px; text-align:center;
        }
        .card-header h2 { color:white; font-size:1.1rem; font-weight:700; }
        .card-header p { color:rgba(255,255,255,.75); font-size:.8rem; margin-top:3px; }

        /* Avatar upload */
        .avatar-upload-wrap {
            width:84px; height:84px; border-radius:50%; margin:0 auto 12px;
            border:3px solid rgba(255,255,255,.4); overflow:hidden; position:relative;
            background:rgba(255,255,255,.15); display:flex; align-items:center; justify-content:center;
            cursor:pointer; box-shadow:0 4px 14px rgba(0,0,0,.2);
        }
        .avatar-upload-wrap img, .avatar-upload-wrap .avatar-initial {
            width:100%; height:100%; object-fit:cover;
            font-size:2rem; font-weight:700; color:white;
            display:flex; align-items:center; justify-content:center; line-height:84px;
            text-align:center;
        }
        .avatar-upload-wrap .avatar-initial { display:flex; align-items:center; justify-content:center; }
        .overlay-label {
            position:absolute; inset:0; background:rgba(0,0,0,.45);
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            opacity:0; transition:.2s; cursor:pointer; border-radius:50%;
        }
        .avatar-upload-wrap:hover .overlay-label { opacity:1; }
        .overlay-label span { color:white; font-size:.72rem; font-weight:600; margin-top:2px; }
        #photoInput { display:none; }

        /* Form body */
        .form-body { padding:24px 28px; }

        .form-group { margin-bottom:16px; }
        .form-group label { display:block; font-size:.82rem; font-weight:600; color:#4a5568; margin-bottom:6px; }
        .form-group label .req { color:#e53e3e; }
        .input-field {
            width:100%; padding:10px 13px; border:1px solid #e2e8f0; border-radius:8px;
            font-size:.875rem; color:#2d3748; background:white; outline:none; transition:.2s;
        }
        .input-field:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15); }
        .input-field:disabled { background:#f8fafc; color:#a0aec0; cursor:not-allowed; }
        .form-group small { display:block; margin-top:4px; color:#a0aec0; font-size:.75rem; }

        /* Error */
        .error-message {
            color:#c53030; font-size:.75rem; margin-top:4px;
            padding:4px 8px; background:#fff5f5; border-radius:4px; border-left:3px solid #fc8181;
        }

        /* Divider */
        .divider { border:none; border-top:1px solid #f1f5f9; margin:18px 0; }

        /* Buttons */
        .form-actions { display:flex; gap:10px; margin-top:20px; }
        .btn-save {
            flex:1; padding:11px; border:none; border-radius:9px;
            background:linear-gradient(135deg,#667eea,#764ba2); color:white;
            font-size:.9rem; font-weight:600; cursor:pointer;
            box-shadow:0 3px 10px rgba(102,126,234,.35); transition:.2s;
        }
        .btn-save:hover { opacity:.9; transform:translateY(-1px); }
        .btn-cancel {
            padding:11px 20px; border:1px solid #e2e8f0; border-radius:9px;
            background:white; color:#4a5568; font-size:.875rem; font-weight:600;
            text-decoration:none; display:flex; align-items:center; justify-content:center;
            transition:.2s;
        }
        .btn-cancel:hover { background:#f8fafc; }

        @media (max-width:480px) {
            .page-body { padding:20px 12px; }
            .form-body { padding:18px 16px; }
            .card-header { padding:18px 16px 14px; }
        }
    </style>
</head>
<body>
    <?php
        $role = session()->get('role');
        $profileUrl = base_url('account/profile');
    ?>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="<?= base_url('assets/images/logo-transparent.png') ?>" alt="Logo">
            <span>Bimbel Harapan</span>
        </div>
        <a href="<?= $profileUrl ?>" class="btn-back">← Kembali ke Profil</a>
    </nav>

    <div class="page-body">
        <div class="profile-card">

            <!-- Card Header dengan avatar upload -->
            <div class="card-header">
                <label for="photoInput">
                    <div class="avatar-upload-wrap" title="Klik untuk ganti foto">
                        <div id="defaultIcon" style="<?= session()->get('photo') ? 'display:none' : '' ?>;width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <span class="avatar-initial"><?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)) ?></span>
                        </div>
                        <img id="profilePhoto"
                             src="<?= session()->get('photo') ? base_url('uploads/profile/'.session()->get('photo')) : '' ?>"
                             style="<?= session()->get('photo') ? '' : 'display:none' ?>"
                             alt="Foto Profil">
                        <div class="overlay-label">
                            <span>📷</span>
                            <span>Ganti Foto</span>
                        </div>
                    </div>
                </label>
                <h2>Edit Profil</h2>
                <p>Perbarui informasi akun Anda</p>
            </div>

            <!-- Form -->
            <form class="form-body" action="<?= base_url('account/update-profile') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="file" id="photoInput" name="photo" accept="image/*">

                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" id="nama" name="nama" class="input-field"
                           value="<?= esc($user['nama'] ?? '') ?>" placeholder="Masukkan nama lengkap" required>
                    <?php if (isset($validation) && $validation->hasError('nama')): ?>
                        <div class="error-message"><?= $validation->getError('nama') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="req">*</span></label>
                    <input type="email" id="email" name="email" class="input-field"
                           value="<?= esc($user['email'] ?? '') ?>" placeholder="contoh@email.com" required>
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="error-message"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="nomor_hp">Nomor HP <span class="req">*</span></label>
                    <input type="tel" id="nomor_hp" name="nomor_hp" class="input-field"
                           value="<?= esc($user['nomor_hp'] ?? '') ?>" placeholder="08xxxxxxxxxx" required>
                    <?php if (isset($validation) && $validation->hasError('nomor_hp')): ?>
                        <div class="error-message"><?= $validation->getError('nomor_hp') ?></div>
                    <?php endif; ?>
                </div>

                <hr class="divider">

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password" class="input-field"
                           placeholder="Kosongkan jika tidak ingin ubah">
                    <small>* Biarkan kosong jika tidak ingin mengubah password</small>
                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                        <div class="error-message"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <a href="<?= $profileUrl ?>" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.getElementById('photoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.getElementById('profilePhoto');
                const def = document.getElementById('defaultIcon');
                img.src = ev.target.result;
                img.style.display = 'block';
                if (def) def.style.display = 'none';
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>