<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengajar - Bimbel Harapan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8fafc;
        }

        .header {
            background: #667eea;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-right: 10px;
            border-radius: 6px;
        }

        .site-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .user-controls {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: auto;
            margin-bottom: 10px;
            cursor: pointer;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s ease;
        }

        .user-avatar:hover { border-color: white; }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .buttons-container {
            display: none;
            flex-direction: column;
            gap: 8px;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            z-index: 1000;
            min-width: 120px;
        }

        .user-controls.active .buttons-container { display: flex; }

        .user-button {
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .user-button:hover { background-color: #5a67d8; }

        .main-container {
            display: flex;
            flex: 1;
        }

        .sidebar {
            background: #667eea;
            width: 220px;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar-link {
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(255,255,255,0.15);
            border-left-color: white;
        }

        .content {
            flex: 1;
            background-color: #f8fafc;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        .hamburger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            height: 24px;
            cursor: pointer;
            padding: 5px;
        }

        .hamburger-line {
            width: 25px;
            height: 3px;
            background-color: white;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        /* ===== UNIFIED STYLES ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
        }

        .title-container {
            margin-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
        }

        .title-container h1 {
            color: #2d3748;
            font-size: 2rem;
            font-weight: 600;
        }

        .top-container,
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .add-button {
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .add-button:hover { background: #5a67d8; }

        .search-input {
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            width: 300px;
            outline: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 6px;
            overflow: hidden;
        }

        th {
            background: #667eea;
            color: white;
            text-align: left;
            padding: 15px 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #4a5568;
            font-size: 0.9rem;
        }

        tr:hover { background-color: #f8fafc; }
        tr:last-child td { border-bottom: none; }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            margin-right: 8px;
            font-size: 18px;
            padding: 5px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .delete-btn { color: #e53935; }
        .delete-btn:hover { background-color: rgba(229,57,53,0.1); }
        .edit-btn { color: #667eea; }
        .edit-btn:hover { background-color: rgba(102,126,234,0.1); }

        .status-lunas {
            color: #2f855a;
            font-weight: 600;
            background: rgba(47,133,90,0.1);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1050;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
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
            margin-bottom: 25px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
        }

        .modal-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
            color: #2d3748;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #718096;
            transition: color 0.3s ease;
        }

        .close-modal:hover { color: #2d3748; }

        .form-group { margin-bottom: 20px; }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5a67d8; }
        .btn-danger { background-color: #e53935; color: white; }
        .btn-danger:hover { background-color: #c62828; }
        .btn-gray { background-color: #e2e8f0; color: #4a5568; }
        .btn-gray:hover { background-color: #cbd5e0; }

        .flash-message {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 6px;
            font-weight: 500;
            border-left: 4px solid;
        }

        .flash-success { background-color: #f0fff4; color: #2f855a; border-left-color: #48bb78; }
        .flash-error   { background-color: #fee; color: #c53030; border-left-color: #e53935; }

        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
            text-align: center;
        }

        .stat-card .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #667eea;
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            color: #718096;
            margin-top: 4px;
        }

        @media screen and (max-width: 768px) {
            .hamburger-menu { display: flex; margin-right: 15px; }
            .sidebar { position: fixed; left: -220px; height: calc(100% - 60px); top: 60px; z-index: 100; }
            .sidebar.active { left: 0; }
            .content { padding: 20px 15px; }
            .container { padding: 20px 15px; }
            .top-container, .search-container { flex-direction: column; align-items: stretch; }
            .search-input { width: 100%; }
            .add-button { width: 100%; text-align: center; }
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
            <div class="logo-container">
                <img class="logo" src="<?= base_url('assets/images/logo-transparent.png') ?>" alt="Logo Bimbel Harapan">
                <h1 class="site-title">Dashboard Pengajar<br>Bimbel Harapan</h1>
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
                <a href="<?= base_url('/account/profile') ?>" class="user-button">Ubah Akun</a>
                <a href="<?= base_url('/logout') ?>" class="user-button">Keluar</a>
            </div>
        </div>
    </header>

    <div class="main-container">
        <nav class="sidebar" id="sidebar">
            <a href="<?= base_url('pengajar/dashboard') ?>" class="sidebar-link" data-page="dashboard">Dashboard</a>
            <a href="<?= base_url('pengajar/jadwal') ?>" class="sidebar-link" data-page="jadwal">Jadwal Mengajar</a>
            <a href="<?= base_url('pengajar/siswa') ?>" class="sidebar-link" data-page="siswa">Daftar Siswa</a>
            <a href="<?= base_url('pengajar/hasil-belajar') ?>" class="sidebar-link" data-page="hasil-belajar">Hasil Belajar</a>
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
            const userControls = document.getElementById('user-controls');
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger-menu');
            if (!userControls.contains(e.target)) userControls.classList.remove('active');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });

        (function setActiveLink() {
            const path = window.location.pathname;
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
                if (path.includes(link.getAttribute('data-page'))) link.classList.add('active');
            });
        })();

        setTimeout(function () {
            document.querySelectorAll('.flash-message').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.style.display = 'none', 500);
            });
        }, 5000);

        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                const val = this.value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
                });
            });
        }

        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal(modal.id);
            });
        });

        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function openEditModal(id, data) {
            const modal = document.getElementById('editModal-' + id);
            if (modal) {
                Object.keys(data).forEach(key => {
                    const el = modal.querySelector('[name="' + key + '"]');
                    if (el) el.value = data[key];
                });
                modal.style.display = 'flex';
            }
        }
    </script>
</body>

</html>
