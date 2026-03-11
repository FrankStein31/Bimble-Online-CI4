<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun - Bimbel Harapan</title>
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
            padding:28px 28px 20px; text-align:center; position:relative;
        }
        .avatar-wrap {
            width:100px; height:100px; border-radius:50%; margin:0 auto 14px;
            border:4px solid rgba(255,255,255,.4); overflow:hidden;
            background:rgba(255,255,255,.15); display:flex; align-items:center; justify-content:center;
            box-shadow:0 4px 16px rgba(0,0,0,.2);
        }
        .avatar-wrap img { width:100%; height:100%; object-fit:cover; }
        .avatar-initial {
            font-size:2.4rem; font-weight:700; color:white; line-height:1;
        }
        .card-header h2 { color:white; font-size:1.3rem; font-weight:700; margin-bottom:4px; }
        .role-badge {
            display:inline-block; background:rgba(255,255,255,.25); color:white;
            padding:3px 12px; border-radius:20px; font-size:.78rem; font-weight:600;
        }

        /* Info list */
        .info-list { padding:0 28px 8px; }
        .info-item {
            display:flex; align-items:center; gap:14px; padding:15px 0;
            border-bottom:1px solid #f1f5f9;
        }
        .info-item:last-child { border-bottom:none; }
        .info-icon { font-size:1.1rem; width:28px; text-align:center; flex-shrink:0; }
        .info-content { flex:1; }
        .info-label { font-size:.73rem; font-weight:600; color:#a0aec0; text-transform:uppercase; letter-spacing:.5px; margin-bottom:2px; }
        .info-value { font-size:.95rem; font-weight:500; color:#2d3748; }
        .info-value.muted { color:#a0aec0; letter-spacing:2px; font-size:1rem; }

        /* Jenjang badge */
        .badge { display:inline-block; padding:2px 10px; border-radius:12px; font-size:.78rem; font-weight:600; }
        .badge-SD  { background:#dbeafe; color:#1d4ed8; }
        .badge-SMP { background:#dcfce7; color:#166534; }
        .badge-SMA { background:#fef3c7; color:#92400e; }
        .badge-admin { background:#ede9fe; color:#5b21b6; }

        /* Footer */
        .card-footer { padding:20px 28px 28px; }
        .btn-edit {
            display:flex; justify-content:center; align-items:center; gap:8px;
            background:linear-gradient(135deg,#667eea,#764ba2); color:white;
            text-decoration:none; padding:12px; border-radius:10px;
            font-size:.9rem; font-weight:600; width:100%;
            box-shadow:0 3px 12px rgba(102,126,234,.35); transition:.2s;
        }
        .btn-edit:hover { opacity:.9; transform:translateY(-1px); box-shadow:0 5px 16px rgba(102,126,234,.45); }

        /* Flash */
        .flash { margin:16px 28px 0; padding:11px 14px; border-radius:8px; font-size:.875rem; font-weight:500; }
        .flash-success { background:#f0fff4; color:#276749; border-left:4px solid #48bb78; }
        .flash-error   { background:#fff5f5; color:#c53030; border-left:4px solid #fc8181; }

        @media (max-width:480px) {
            .page-body { padding:20px 12px; align-items:flex-start; }
            .info-list, .card-footer { padding-left:18px; padding-right:18px; }
            .flash { margin-left:18px; margin-right:18px; }
        }
    </style>
</head>
<body>
    <?php
        $role = session()->get('role');
        $dashboardUrl = $role === 'admin' ? base_url('dashboard') : ($role === 'pengajar' ? base_url('pengajar/dashboard') : base_url('siswa/dashboard'));
        $roleLabel = $role === 'admin' ? 'Admin' : ($role === 'pengajar' ? 'Pengajar' : 'Siswa');
        $jabatan = session()->get('jabatan') ?? session()->get('tingkat') ?? null;
    ?>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="<?= base_url('assets/images/logo-transparent.png') ?>" alt="Logo">
            <span>Bimbel Harapan</span>
        </div>
        <a href="<?= $dashboardUrl ?>" class="btn-back">← Dashboard</a>
    </nav>

    <div class="page-body">
        <div class="profile-card">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="flash flash-success">✅ <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="flash flash-error">❌ <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Header -->
            <div class="card-header">
                <div class="avatar-wrap">
                    <?php if (!empty($user['photo'])): ?>
                        <img src="<?= base_url('uploads/profile/'.$user['photo']) ?>" alt="Foto">
                    <?php else: ?>
                        <span class="avatar-initial"><?= strtoupper(substr($user['nama'], 0, 1)) ?></span>
                    <?php endif; ?>
                </div>
                <h2><?= esc($user['nama']) ?></h2>
                <span class="role-badge">
                    <?= $roleLabel ?>
                    <?php if ($jabatan): ?> · <?= $jabatan ?><?php endif; ?>
                </span>
            </div>

            <!-- Info list -->
            <div class="info-list">
                <div class="info-item">
                    <span class="info-icon">📧</span>
                    <div class="info-content">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?= esc($user['email']) ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-icon">📱</span>
                    <div class="info-content">
                        <div class="info-label">Nomor HP</div>
                        <div class="info-value"><?= esc($user['nomor_hp']) ?></div>
                    </div>
                </div>
                <?php if (!empty($user['tingkat']) && $role === 'siswa'): ?>
                <div class="info-item">
                    <span class="info-icon">🎓</span>
                    <div class="info-content">
                        <div class="info-label">Jenjang</div>
                        <div class="info-value">
                            <span class="badge badge-<?= $user['tingkat'] ?>"><?= $user['tingkat'] ?></span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($user['jabatan']) && $role === 'pengajar'): ?>
                <div class="info-item">
                    <span class="info-icon">👨‍🏫</span>
                    <div class="info-content">
                        <div class="info-label">Mengajar</div>
                        <div class="info-value">
                            <span class="badge badge-<?= $user['jabatan'] ?>">Guru <?= $user['jabatan'] ?></span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="info-item">
                    <span class="info-icon">🔒</span>
                    <div class="info-content">
                        <div class="info-label">Password</div>
                        <div class="info-value muted">••••••••</div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <a href="<?= base_url('account/edit-profile') ?>" class="btn-edit">✏️ Edit Profil</a>
            </div>

        </div>
    </div>
</body>
</html>