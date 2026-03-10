<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Bimbel Harapan</title>
    <style>
        /* Reset and Base Styles */
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

        /* Header Styles */
        .header {
            background: #667eea;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
            text-align: center;
            line-height: 1.2;
        }

        /* User Controls */
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
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            border-color: white;
        }

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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            min-width: 120px;
        }

        .user-controls.active .buttons-container {
            display: flex;
        }

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

        .user-button:hover {
            background-color: #5a67d8;
        }

        /* Main Container */
        .main-container {
            display: flex;
            flex: 1;
        }

        /* Sidebar Styles */
        .sidebar {
            background: #667eea;
            width: 220px;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
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
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: white;
        }

        /* Content Area */
        .content {
            flex: 1;
            background-color: #f8fafc;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        /* Hamburger Menu */
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

        /* ===============================
           UNIFIED ADMIN STYLES
           =============================== */

        /* Container Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
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

        /* Top Container with Actions */
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

        .add-button:hover {
            background: #5a67d8;
        }

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
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Table Styles */
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

        tr:hover {
            background-color: #f8fafc;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Action Buttons */
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

        .delete-btn {
            color: #e53935;
        }

        .delete-btn:hover {
            background-color: rgba(229, 57, 53, 0.1);
        }

        .edit-btn {
            color: #667eea;
        }

        .edit-btn:hover {
            background-color: rgba(102, 126, 234, 0.1);
        }

        /* Status Badges */
        .status-lunas {
            color: #2f855a;
            font-weight: 600;
            background: rgba(47, 133, 90, 0.1);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .status-belum,
        .status-pending {
            color: #d69e2e;
            font-weight: 600;
            background: rgba(214, 158, 46, 0.1);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .payment-proof {
            width: 50px;
            height: 30px;
            background-color: #667eea;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .payment-proof:hover {
            background-color: #5a67d8;
        }

        /* Modal Styles */
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
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
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

        .close-modal:hover {
            color: #2d3748;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

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
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control-file {
            display: block;
            width: 100%;
            padding: 10px 0;
            border: 2px dashed #cbd5e0;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-control-file:hover {
            border-color: #667eea;
            background-color: rgba(102, 126, 234, 0.05);
        }

        /* Form Buttons */
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

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a67d8;
        }

        .btn-danger {
            background-color: #e53935;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c62828;
        }

        .btn-gray {
            background-color: #e2e8f0;
            color: #4a5568;
        }

        .btn-gray:hover {
            background-color: #cbd5e0;
        }

        /* Flash Messages */
        .flash-message {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 6px;
            font-weight: 500;
            border-left: 4px solid;
        }

        .flash-success {
            background-color: #f0fff4;
            color: #2f855a;
            border-left-color: #48bb78;
        }

        .flash-error {
            background-color: #fee;
            color: #c53030;
            border-left-color: #e53935;
        }

        /* Show modals with :target selector */
        .modal:target {
            display: flex;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .header {
                padding: 10px 15px;
            }

            .hamburger-menu {
                display: flex;
                margin-right: 15px;
            }

            .sidebar {
                position: fixed;
                left: -220px;
                height: calc(100% - 60px);
                top: 60px;
                z-index: 100;
            }

            .sidebar.active {
                left: 0;
            }

            .site-title {
                font-size: 0.9rem;
            }

            .user-button {
                font-size: 12px;
                padding: 6px 10px;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
            }

            .content {
                padding: 20px 15px;
            }

            .container {
                padding: 20px 15px;
                border-radius: 6px;
            }

            .top-container,
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                width: 100%;
                margin-bottom: 10px;
            }

            .add-button {
                width: 100%;
                text-align: center;
            }

            /* Mobile Table */
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
                border: 1px solid #e2e8f0;
                margin-bottom: 15px;
                border-radius: 6px;
                padding: 15px;
                background: white;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            td {
                border: none;
                border-bottom: 1px solid #f7fafc;
                position: relative;
                padding-left: 50% !important;
                text-align: right;
                padding-top: 10px;
                padding-bottom: 10px;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                top: 10px;
                font-weight: 600;
                color: #4a5568;
                text-align: left;
                width: 45%;
            }

            td:last-child {
                border-bottom: none;
                text-align: center;
                padding-left: 15px !important;
                padding-top: 15px;
            }

            .modal-content {
                padding: 20px 15px;
                width: 95%;
                max-height: 85vh;
            }

            .form-buttons {
                flex-direction: column;
                gap: 8px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media screen and (max-width: 480px) {
            .logo {
                width: 60px;
            }

            .user-avatar {
                width: 28px;
                height: 28px;
            }

            .sidebar {
                width: 200px;
                left: -200px;
            }

            .title-container h1 {
                font-size: 1.5rem;
            }
        }

        /* Additional Utility Classes */
        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #718096;
            font-size: 0.85rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        /* Currency Display */
        .currency {
            font-family: 'Segoe UI', monospace;
            font-weight: 600;
            color: #667eea;
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
                <h1 class="site-title">Dashboard Admin<br>Bimbel Harapan</h1>
            </div>
        </div>
        <div class="user-controls" id="user-controls">
            <div class="user-avatar" id="user-avatar">
                <?php if (session()->get('photo')): ?>
                    <img src="<?= base_url('uploads/profile/' . session()->get('photo')) ?>" alt="User Avatar">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/avatar.png') ?>" alt="User Avatar">
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
            <a href="<?= base_url('dashboard/jadwal') ?>" class="sidebar-link" data-page="jadwal">Jadwal</a>
            <a href="<?= base_url('dashboard/transaksi') ?>" class="sidebar-link" data-page="transaksi">Transaksi</a>
            <a href="<?= base_url('dashboard/program') ?>" class="sidebar-link" data-page="program">Kelola Program</a>
            <a href="<?= base_url('dashboard/user') ?>" class="sidebar-link" data-page="user">Kelola User</a>
            <a href="<?= base_url('dashboard/rekening') ?>" class="sidebar-link" data-page="rekening">Kelola Rekening</a>
            <a href="<?= base_url('dashboard/siswa-ptn') ?>" class="sidebar-link" data-page="siswa-ptn">Siswa Diterima</a>
            <a href="<?= base_url('dashboard/hasil-belajar') ?>" class="sidebar-link" data-page="hasil-belajar">Hasil Belajar</a>
        </nav>

        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('hamburger-menu').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Toggle user dropdown when avatar is clicked
        document.getElementById('user-avatar').addEventListener('click', function(event) {
            document.getElementById('user-controls').classList.toggle('active');
            event.stopPropagation();
        });

        // Close dropdown when clicking anywhere else on the page
        document.addEventListener('click', function(event) {
            const userControls = document.getElementById('user-controls');
            const userAvatar = document.getElementById('user-avatar');
            const sidebar = document.getElementById('sidebar');
            const hamburgerMenu = document.getElementById('hamburger-menu');

            if (!userControls.contains(event.target) || event.target !== userAvatar) {
                userControls.classList.remove('active');
            }

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !hamburgerMenu.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const userControls = document.getElementById('user-controls');

            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
            }
            userControls.classList.remove('active');
        });

        // Set active link based on current URL
        function setActiveLink() {
            const currentUrl = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            sidebarLinks.forEach(link => {
                link.classList.remove('active');
            });

            sidebarLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                const pageName = link.getAttribute('data-page');

                if (currentUrl.includes(pageName)) {
                    link.classList.add('active');
                }
            });

            if (currentUrl.includes('/dashboard') && !document.querySelector('.sidebar-link.active')) {
                const urlSegments = currentUrl.split('/');
                if (urlSegments.length > 2) {
                    const mainSection = urlSegments[2];
                    const matchingLink = document.querySelector(`.sidebar-link[data-page="${mainSection}"]`);
                    if (matchingLink) {
                        matchingLink.classList.add('active');
                    } else {
                        document.querySelector('.sidebar-link').classList.add('active');
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', setActiveLink);

        // Handle sidebar navigation
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.remove('active');
                }
            });
        });

        // Auto hide flash messages
        setTimeout(function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                message.style.opacity = '0';
                message.style.transition = 'opacity 0.5s';
                setTimeout(() => message.style.display = 'none', 500);
            });
        }, 5000);

        // Search functionality (if search input exists)
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Currency formatting function
        function formatCurrency(input) {
            if (input.value) {
                const numericValue = input.value.replace(/[^0-9]/g, '');
                const formattedValue = new Intl.NumberFormat('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(numericValue);

                const helpTextElement = input.nextElementSibling;
                if (helpTextElement && helpTextElement.tagName === 'SMALL') {
                    helpTextElement.textContent = `Format Rupiah: ${formattedValue}`;
                }
            }
        }

        // Auto-fill functionality for forms
        document.addEventListener('DOMContentLoaded', function() {
            // Price input formatting
            const priceInputs = document.querySelectorAll('input[name="harga"], input[name="tagihan"]');
            priceInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
                input.addEventListener('blur', function() {
                    formatCurrency(this);
                });
            });

            // Auto-fill user selection
            const userSelect = document.getElementById('user_id');
            const teleponInput = document.getElementById('telepon');
            if (userSelect && teleponInput) {
                userSelect.addEventListener('change', function() {
                    const selectedOption = userSelect.options[userSelect.selectedIndex];
                    if (selectedOption.value !== "") {
                        const optionText = selectedOption.text;
                        const telepon = optionText.split(" - ")[1];
                        teleponInput.value = telepon;
                    } else {
                        teleponInput.value = '';
                    }
                });
            }

            // Auto-fill program selection
            const programSelect = document.getElementById('program_id');
            const tagihanInput = document.getElementById('tagihan');
            if (programSelect && tagihanInput) {
                programSelect.addEventListener('change', function() {
                    const selectedOption = programSelect.options[programSelect.selectedIndex];
                    if (selectedOption.value !== "") {
                        tagihanInput.value = selectedOption.getAttribute('data-harga') || '';
                    } else {
                        tagihanInput.value = '';
                    }
                });
            }
        });
    </script>
</body>

</html>