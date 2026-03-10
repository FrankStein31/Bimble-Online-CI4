<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bimbel Bimbel Harapan</title>
    <!-- <link rel="stylesheet" href="./src/styles.css" /> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" /> -->
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 10px;
        }

        /* Header/Navbar - Minimal Height */
        .site-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }


        .site-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 20px;
            /* Dikurangi dari 12px */
        }

        /* Logo - Clean */
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transition: opacity 0.3s ease;
        }

        .logo:hover {
            opacity: 0.9;
        }

        .logo img {
            width: 45px;
            /* Dikurangi dari 50px */
            height: 45px;
            margin-right: 10px;
            border-radius: 6px;
        }

        /* Navigation - Flat Design */
        .main-nav {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .main-nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 6px 14px;
            /* Dikurangi height */
            border-radius: 4px;
            /* Border radius kecil */
            transition: background-color 0.3s ease;
        }

        .main-nav a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* User Profile - Flat */
        .user-profile {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 4px 8px;
            /* Sangat minimal */
            transition: background-color 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .user-avatar {
            width: 32px;
            /* Dikurangi dari 40px */
            height: 32px;
            border-radius: 50%;
            background-color: #f0f0f0;
            overflow: hidden;
            margin-right: 8px;
            /* Dikurangi margin */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-weight: 500;
            /* Dikurangi dari 600 */
            color: white;
            margin-right: 6px;
            font-size: 0.9rem;
        }

        .dropdown-icon {
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            /* Dikurangi dari 5px */
            border-right: 4px solid transparent;
            border-top: 4px solid white;
            transition: transform 0.3s;
        }

        .user-profile.active .dropdown-icon {
            transform: rotate(180deg);
        }

        /* Profile Dropdown - Flat */
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* Shadow minimal */
            border-radius: 6px;
            /* Border radius kecil */
            width: 180px;
            z-index: 1000;
            display: none;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .profile-dropdown.active {
            display: block;
        }

        .dropdown-option {
            padding: 10px 16px;
            /* Dikurangi height */
            display: block;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
            font-weight: 400;
            /* Normal weight */
        }

        .dropdown-option:hover {
            background-color: #f5f5f5;
        }

        .dropdown-option.logout {
            border-top: 1px solid #eee;
            color: #e53935;
        }

        .dropdown-option.logout:hover {
            background-color: #ffeaea;
        }

        /* Login Button - Flat */
        .btn {
            text-decoration: none;
            padding: 6px 16px;
            /* Height minimal */
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline {
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            /* Border tipis */
            background: transparent;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.6);
        }

        /* Default user icon */
        .user-icon {
            width: 18px;
            /* Dikurangi size */
            height: 18px;
            stroke: #666;
            fill: none;
            stroke-width: 2;
        }

        /* Footer */
        .site-footer {
            background: linear-gradient(135deg, #2d3748, #4a5568);
            color: white;
            padding: 30px 0 20px;
            /* Dikurangi padding */
            text-align: center;
            margin-top: 40px;
            /* Dikurangi margin */
        }

        .site-footer h3 {
            margin-bottom: 15px;
            /* Dikurangi margin */
            font-size: 1.5rem;
            /* Dikurangi size */
            color: #667eea;
        }

        .site-footer p {
            margin-bottom: 6px;
            /* Dikurangi margin */
            opacity: 0.9;
            font-size: 0.95rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .site-header .container {
                padding: 6px 20px;
                /* Lebih kecil untuk mobile */
            }

            .main-nav {
                gap: 8px;
            }

            .main-nav a {
                padding: 5px 10px;
                font-size: 0.85rem;
            }

            .user-profile {
                padding: 3px 6px;
            }

            .user-name {
                display: none;
            }

            .user-avatar {
                width: 28px;
                /* Lebih kecil untuk mobile */
                height: 28px;
                margin-right: 6px;
            }

            .profile-dropdown {
                right: -10px;
                width: 160px;
            }

            .logo img {
                width: 40px;
                height: 40px;
            }

            .btn-outline {
                padding: 5px 12px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .site-header .container {
                padding: 5px 15px;
                /* Sangat minimal */
            }

            .main-nav {
                gap: 6px;
            }

            .main-nav a {
                padding: 4px 8px;
                font-size: 0.8rem;
            }

            .user-avatar {
                width: 26px;
                height: 26px;
            }

            .logo img {
                width: 36px;
                height: 36px;
            }
        }
    </style>
</head>

<body>
    <header class="site-header">
        <div class="container">
            <a href="<?= base_url('/') ?>" class="logo">
                <img width="50" class="logo" src="<?= base_url('assets/images/logo-transparent.png') ?>" alt="Logo Bimbel Harapan" />
            </a>
            <nav class="main-nav">
                <a href="<?= base_url('/') ?>">Beranda</a>

                <!-- Di dalam navbar -->
                <?php if (session()->get('logged_in') && session()->get('role') == 'siswa'): ?>
                    <!-- Tampilkan menu yang memerlukan login, jika sudah login -->
                    <a href="<?= base_url('/jadwal') ?>">Jadwal</a>

                    <?php if (session()->get('has_transaction')): ?>
                        <!-- Jika sudah pernah transaksi, tampilkan menu Paket Aktif -->
                        <a href="<?= base_url('/registrasi-pembayaran/paket-aktif') ?>">Paket Aktif</a>
                    <?php else: ?>
                        <!-- Jika belum pernah transaksi, tampilkan menu Registrasi Pembayaran -->
                        <a href="<?= base_url('/registrasi-pembayaran') ?>">Registrasi Pembayaran</a>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Link yang mengarahkan ke login jika belum login -->
                    <a href="javascript:void(0);" class="require-login" data-redirect="jadwal">Jadwal</a>
                    <a href="javascript:void(0);" class="require-login" data-redirect="registrasi-pembayaran">Registrasi Pembayaran</a>
                <?php endif; ?>
            </nav>

            <?php if (session()->get('logged_in') && session()->get('role') == 'siswa'): ?>
                <!-- Tampilkan profil jika sudah login sebagai siswa -->
                <div class="user-profile" id="userProfile">
                    <div class="user-avatar">
                        <?php if (session()->get('photo')): ?>
                            <img src="<?= base_url('uploads/profile/' . session()->get('photo')) ?>" alt="Foto Profil">
                        <?php else: ?>
                            <svg class="user-icon" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="35" r="15" stroke="black" stroke-width="3" />
                                <path d="M25 85C25 68 35 60 50 60C65 60 75 68 75 85" stroke="black" stroke-width="3" />
                            </svg>
                        <?php endif; ?>
                    </div>
                    <span class="user-name"><?= session()->get('nama') ?? 'Siswa' ?></span>
                    <span class="dropdown-icon"></span>

                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="<?= base_url('/account/profile') ?>" class="dropdown-option">Lihat Profil</a>
                        <a href="<?= base_url('/account/edit-profile') ?>" class="dropdown-option">Ubah Akun</a>
                        <a href="<?= base_url('/logout') ?>" class="dropdown-option logout">Keluar</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Tampilkan tombol login jika belum login -->
                <a href="<?= base_url('/login') ?>" class="btn btn-outline">Masuk/Daftar</a>
            <?php endif; ?>
        </div>
    </header>


    <?= $this->renderSection('content') ?> <!-- Menampilkan konten yang berubah -->

    <!-- Footer / Kontak -->
    <footer class="site-footer">
        <div class="container">
            <h3>Kontak</h3>
            <p><strong>Bimbel bimbel Harapan</strong></p>
            <p>Dusun Toros, Babbalan, Kec. Batuan, Kabupaten Sumenep, Jawa Timur 69417</p>
            <p>WhatsApp: (+62 999 8382 9771)</p>
            <p>Instagram: @bimbelharapan.course</p>
        </div>
    </footer>

    <script>
        // Toggle dropdown saat profil diklik
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk dropdown profil
            const userProfile = document.getElementById('userProfile');
            const profileDropdown = document.getElementById('profileDropdown');

            if (userProfile) {
                userProfile.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userProfile.classList.toggle('active');
                    profileDropdown.classList.toggle('active');
                });

                // Tutup dropdown saat klik di luar
                document.addEventListener('click', function(e) {
                    if (!userProfile.contains(e.target)) {
                        userProfile.classList.remove('active');
                        profileDropdown.classList.remove('active');
                    }
                });
            }

            // Menangani klik pada menu yang memerlukan login
            const requireLoginLinks = document.querySelectorAll('.require-login');
            requireLoginLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const redirectPage = this.getAttribute('data-redirect');

                    // Tampilkan dialog konfirmasi
                    if (confirm('Anda perlu masuk untuk mengakses halaman ini. Lanjutkan ke halaman login?')) {
                        // Simpan halaman yang ingin dikunjungi dalam session storage
                        sessionStorage.setItem('redirectAfterLogin', redirectPage);
                        // Arahkan ke halaman login/daftar
                        window.location.href = '<?= base_url('/login') ?>';
                    }
                });
            });

            // Cek apakah ada redirect setelah login
            const redirectAfterLogin = sessionStorage.getItem('redirectAfterLogin');
            if (redirectAfterLogin && window.location.pathname.includes('/login')) {
                // Tambahkan informasi ke halaman login bahwa pengguna perlu login
                const loginInfo = document.createElement('div');
                loginInfo.classList.add('login-notification');
                loginInfo.textContent = 'Silakan login untuk mengakses halaman ' + redirectAfterLogin;
                loginInfo.style.backgroundColor = '#f8d7da';
                loginInfo.style.color = '#721c24';
                loginInfo.style.padding = '10px 15px';
                loginInfo.style.marginBottom = '15px';
                loginInfo.style.borderRadius = '5px';

                // Masukkan notifikasi ke awal form login
                const loginForm = document.querySelector('form');
                if (loginForm) {
                    loginForm.insertBefore(loginInfo, loginForm.firstChild);
                }
            }
        });
    </script>
</body>

</html>