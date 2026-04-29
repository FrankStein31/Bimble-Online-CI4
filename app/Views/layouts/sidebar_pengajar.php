<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengajar - Bimbel Harapan</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; }
        body { display:flex; flex-direction:column; min-height:100vh; background:#f8fafc; }

        /* ── Header ── */
        .header {
            background:linear-gradient(135deg,#667eea,#764ba2);
            padding:12px 20px; display:flex; justify-content:space-between; align-items:center;
            box-shadow:0 2px 10px rgba(102,126,234,.4); position:sticky; top:0; z-index:1000;
        }
        .header-left { display:flex; align-items:center; gap:15px; }
        .logo { width:72px; height:auto; border-radius:6px; margin-right:10px; }
        .site-title { color:white; font-size:1rem; font-weight:700; line-height:1.3; }

        /* User avatar dropdown */
        .user-controls { display:flex; flex-direction:column; position:relative; }
        .user-avatar {
            width:40px; height:40px; border-radius:50%; cursor:pointer; overflow:hidden;
            border:2px solid rgba(255,255,255,.4); transition:.3s;
        }
        .user-avatar:hover { border-color:white; }
        .user-avatar img { width:100%; height:100%; object-fit:cover; }
        .buttons-container {
            display:none; flex-direction:column; gap:8px;
            position:absolute; top:50px; right:0; background:white;
            padding:12px; border-radius:10px; box-shadow:0 4px 20px rgba(0,0,0,.15);
            z-index:1001; min-width:130px;
        }
        .user-controls.active .buttons-container { display:flex; }
        .user-button {
            background:linear-gradient(135deg,#667eea,#764ba2); color:white; border:none;
            border-radius:7px; padding:8px 12px; cursor:pointer; font-size:13px;
            font-weight:600; text-align:center; text-decoration:none; transition:.2s;
        }
        .user-button:hover { opacity:.85; }

        /* ── Layout ── */
        .main-container { display:flex; flex:1; }

        /* ── Sidebar ── */
        .sidebar {
            background:linear-gradient(180deg,#667eea,#764ba2);
            width:220px; padding:20px 0; display:flex; flex-direction:column;
            transition:.3s; box-shadow:2px 0 10px rgba(102,126,234,.25);
        }
        .sidebar-link {
            color:rgba(255,255,255,.85); text-decoration:none; padding:13px 22px;
            transition:.2s; border-left:3px solid transparent; font-weight:500;
            font-size:.9rem; display:flex; align-items:center; gap:8px;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background:rgba(255,255,255,.15); border-left-color:white; color:white;
        }

        /* ── Content ── */
        .content { flex:1; background:#f8fafc; padding:28px; min-height:calc(100vh - 68px); }

        /* ── Hamburger ── */
        .hamburger-menu { display:none; flex-direction:column; justify-content:space-between; height:22px; cursor:pointer; padding:4px; }
        .hamburger-line { width:24px; height:3px; background:white; border-radius:2px; transition:.3s; }

        /* ════════════════════════════════
           SHARED PAGE STYLES
        ════════════════════════════════ */

        /* Page header */
        .page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; flex-wrap:wrap; gap:12px; }
        .page-header h1 { font-size:1.4rem; font-weight:700; color:#1a202c; margin:0; }

        /* Btn add */
        .btn-add {
            display:inline-flex; align-items:center; gap:6px;
            background:linear-gradient(135deg,#667eea,#764ba2); color:white;
            border:none; border-radius:8px; padding:9px 18px;
            font-size:.875rem; font-weight:600; cursor:pointer;
            box-shadow:0 2px 8px rgba(102,126,234,.35); text-decoration:none;
        }
        .btn-add:hover { opacity:.9; }

        /* Alert / Flash */
        .alert, .flash-message {
            padding:12px 16px; border-radius:8px; margin-bottom:18px;
            font-size:.9rem; font-weight:500;
        }
        .alert-success, .flash-success { background:#f0fff4; color:#276749; border-left:4px solid #48bb78; }
        .alert-error,   .flash-error   { background:#fff5f5; color:#c53030; border-left:4px solid #fc8181; }

        /* Stats */
        .stat-cards, .stats-row {
            display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr));
            gap:14px; margin-bottom:22px;
        }
        .stat-card {
            background:white; border-radius:10px; padding:16px 18px;
            box-shadow:0 2px 10px rgba(0,0,0,.06); border:1px solid #e2e8f0; text-align:center;
        }
        .stat-card .stat-number, .stat-card .num { font-size:1.8rem; font-weight:700; color:#667eea; }
        .stat-card .stat-label,  .stat-card .lbl { font-size:.8rem; color:#718096; margin-top:3px; }

        /* Toolbar / search */
        .toolbar, .top-container, .search-container {
            display:flex; flex-wrap:wrap; gap:10px; align-items:center; margin-bottom:16px;
        }
        .search-input {
            padding:9px 14px; border:1px solid #e2e8f0; border-radius:8px;
            font-size:.875rem; outline:none; background:white; min-width:240px;
        }
        .search-input:focus { border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15); }

        /* Table */
        .table-container, .tbl-wrap { overflow-x:auto; border-radius:10px; border:1px solid #e2e8f0; }
        table { width:100%; border-collapse:collapse; background:white; }
        thead th {
            background:#f8fafc; padding:10px 13px; font-size:.78rem;
            font-weight:700; color:#718096; text-transform:uppercase;
            letter-spacing:.4px; text-align:left; border-bottom:1px solid #e2e8f0;
            white-space:nowrap;
        }
        tbody tr { border-bottom:1px solid #f1f5f9; transition:background .15s; }
        tbody tr:last-child { border-bottom:none; }
        tbody tr:hover { background:#f8fafc; }
        td { padding:10px 13px; font-size:.875rem; color:#4a5568; vertical-align:middle; }
        .empty-state { text-align:center; padding:50px 20px; color:#a0aec0; }
        .empty-state .icon { font-size:2.5rem; margin-bottom:10px; }

        /* Badges */
        .badge { display:inline-block; padding:2px 9px; border-radius:12px; font-size:.75rem; font-weight:600; }
        .badge-SD  { background:#dbeafe; color:#1d4ed8; }
        .badge-SMP { background:#dcfce7; color:#166534; }
        .badge-SMA { background:#fef3c7; color:#92400e; }
        .badge-aktif { background:#d1fae5; color:#065f46; }

        .nilai-badge { display:inline-block; padding:3px 8px; border-radius:8px; font-weight:700; font-size:.85rem; min-width:42px; text-align:center; }
        .nilai-a { background:#d1fae5; color:#065f46; }
        .nilai-b { background:#dbeafe; color:#1e40af; }
        .nilai-c { background:#fef3c7; color:#92400e; }
        .nilai-d { background:#fee2e2; color:#991b1b; }
        .nilai-x { background:#f1f5f9; color:#a0aec0; }

        /* Status */
        .status-lunas { background:#d1fae5; color:#065f46; padding:3px 9px; border-radius:12px; font-size:.75rem; font-weight:600; }

        /* Capacity */
        .cap-ok   { font-weight:700; color:#059669; }
        .cap-full { font-weight:700; color:#dc2626; }

        /* Action buttons */
        .action-group { display:flex; gap:5px; }
        .action-btn, .btn-icon {
            width:30px; height:30px; border-radius:6px; border:none; cursor:pointer;
            display:inline-flex; align-items:center; justify-content:center; font-size:.85rem;
            text-decoration:none; transition:.15s;
        }
        .edit-btn, .btn-icon.edit { background:#ebf8ff; color:#2b6cb0; }
        .edit-btn:hover, .btn-icon.edit:hover { background:#bee3f8; }
        .delete-btn, .btn-icon.del { background:#fff5f5; color:#c53030; }
        .delete-btn:hover, .btn-icon.del:hover { background:#fed7d7; }

        /* ── Modal Overlay (admin-style) ── */
        .modal-overlay {
            display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
            z-index:300; align-items:center; justify-content:center; padding:20px;
        }
        .modal-overlay.active { display:flex; }
        /* Legacy support: .modal display:flex on openModal() */
        .modal {
            display:none; position:fixed; inset:0; background:rgba(0,0,0,.5);
            z-index:300; align-items:center; justify-content:center; padding:20px;
        }

        .modal-box, .modal-content {
            background:white; border-radius:14px; width:100%; max-width:520px;
            box-shadow:0 20px 60px rgba(0,0,0,.2); overflow:hidden;
            animation:slideUp .25s ease; max-height:90vh;
            display:flex; flex-direction:column;
        }
        @keyframes slideUp { from{transform:translateY(30px);opacity:0} to{transform:translateY(0);opacity:1} }

        .modal-head, .modal-header {
            display:flex; justify-content:space-between; align-items:center;
            padding:15px 20px;
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white; flex-shrink:0;
        }
        .modal-head h3, .modal-header .modal-title { margin:0; font-size:.95rem; font-weight:600; color:white; }
        .modal-close, .close-modal {
            background:rgba(255,255,255,.2); border:none; color:white;
            width:26px; height:26px; border-radius:50%; cursor:pointer;
            font-size:.95rem; display:flex; align-items:center; justify-content:center;
        }
        .modal-close:hover, .close-modal:hover { background:rgba(255,255,255,.35); }

        .modal-body { padding:20px; overflow-y:auto; }

        .form-group { margin-bottom:14px; }
        .form-group label { display:block; font-size:.82rem; font-weight:600; color:#4a5568; margin-bottom:5px; }
        .form-group label .req { color:#e53e3e; }
        .form-control, .form-select {
            width:100%; padding:9px 12px; border:1px solid #e2e8f0; border-radius:8px;
            font-size:.875rem; color:#2d3748; box-sizing:border-box; outline:none;
            background:white; transition:.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,.15);
        }
        .two-col { display:grid; grid-template-columns:1fr 1fr; gap:12px; }

        .modal-foot, .form-buttons {
            padding:12px 20px 18px; display:flex; justify-content:flex-end;
            gap:10px; flex-shrink:0; border-top:1px solid #f1f5f9;
        }
        .btn-cancel, .btn-gray {
            padding:8px 16px; border:1px solid #e2e8f0; border-radius:8px;
            background:white; color:#4a5568; font-size:.875rem; font-weight:600;
            cursor:pointer; text-decoration:none;
        }
        .btn-save, .btn-primary {
            padding:8px 16px; border:none; border-radius:8px;
            background:linear-gradient(135deg,#667eea,#764ba2); color:white;
            font-size:.875rem; font-weight:600; cursor:pointer; text-decoration:none;
        }
        .btn-save:hover, .btn-primary:hover { opacity:.9; }
        .btn-danger { background:linear-gradient(135deg,#e53e3e,#c53030); color:white; padding:8px 16px; border:none; border-radius:8px; font-size:.875rem; font-weight:600; cursor:pointer; }

        @media (max-width:768px) {
            .hamburger-menu { display:flex; margin-right:12px; }
            .sidebar { position:fixed; left:-220px; height:calc(100% - 60px); top:60px; z-index:100; }
            .sidebar.active { left:0; }
            .content { padding:18px 14px; }
            .two-col { grid-template-columns:1fr; }
            .search-input { min-width:100%; }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-left">
            <div class="hamburger-menu" id="hamburger-menu">
                <div class="hamburger-line"></div>
                <div class="hamburger-line"></div>
                <div class="hamburger-line"></div>
            </div>
            <div style="display:flex;align-items:center;">
                <img class="logo" src="<?= base_url('assets/images/logo-transparent.png') ?>" alt="Logo">
                <h1 class="site-title">Dashboard Pengajar<br><span style="font-weight:400;font-size:.85rem;opacity:.85;">Bimbel Harapan</span></h1>
            </div>
        </div>
        <div class="user-controls" id="user-controls">
            <div class="user-avatar" id="user-avatar">
                <?php if (session()->get('photo')): ?>
                    <img src="<?= base_url('uploads/profile/' . session()->get('photo')) ?>" alt="Avatar">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/avatar.png') ?>" alt="Avatar">
                <?php endif; ?>
            </div>
            <div class="buttons-container">
                <a href="<?= base_url('/account/profile') ?>" class="user-button">👤 Ubah Akun</a>
                <a href="<?= base_url('/logout') ?>" class="user-button">🚪 Keluar</a>
            </div>
        </div>
    </header>

    <div class="main-container">
        <nav class="sidebar" id="sidebar">
            <a href="<?= base_url('pengajar/dashboard') ?>"     class="sidebar-link" data-page="dashboard">🏠 Dashboard</a>
            <a href="<?= base_url('pengajar/jadwal') ?>"        class="sidebar-link" data-page="jadwal">📅 Jadwal Mengajar</a>
            <a href="<?= base_url('pengajar/siswa') ?>"         class="sidebar-link" data-page="siswa">👥 Daftar Siswa</a>
            <a href="<?= base_url('pengajar/hasil-belajar') ?>" class="sidebar-link" data-page="hasil-belajar">📝 Hasil Belajar</a>
        </nav>

        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
        document.getElementById('hamburger-menu').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
        document.getElementById('user-avatar').addEventListener('click', function (e) {
            document.getElementById('user-controls').classList.toggle('active');
            e.stopPropagation();
        });
        document.addEventListener('click', function (e) {
            const uc = document.getElementById('user-controls');
            const sb = document.getElementById('sidebar');
            const hb = document.getElementById('hamburger-menu');
            if (!uc.contains(e.target)) uc.classList.remove('active');
            if (window.innerWidth <= 768 && !sb.contains(e.target) && !hb.contains(e.target)) sb.classList.remove('active');
        });
        (function setActiveLink() {
            const path = window.location.pathname;
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
                if (path.includes(link.getAttribute('data-page'))) link.classList.add('active');
            });
        })();

        // Auto-dismiss flash
        setTimeout(function () {
            document.querySelectorAll('.flash-message, .alert').forEach(el => {
                el.style.transition = 'opacity .5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);

        // ESC close any modal
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.active').forEach(m => m.classList.remove('active'));
                document.querySelectorAll('.modal[style*="flex"]').forEach(m => m.style.display = 'none');
            }
        });

        // Legacy modal helpers (used by hasil_belajar view)
        function openModal(id) {
            const el = document.getElementById(id);
            if (el) { el.classList.add('active'); el.style.display = 'flex'; }
        }
        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) { el.classList.remove('active'); el.style.display = 'none'; }
        }
        function openEditModal(id, data) {
            openModal('editModal-' + id);
        }
    </script>
</body>
</html>
