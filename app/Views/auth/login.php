<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bimbel Harapan</title>
    <style>
        /* Modern Login Page CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Logo Container */
        .logo-container {
            margin-bottom: 32px;
            width: 180px;
            height: auto;
            text-align: center;
        }

        .logo {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 40px 32px;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        /* Form Title */
        .form-title {
            color: #2d3748;
            text-align: center;
            margin-bottom: 32px;
            font-size: 1.8rem;
            font-weight: 600;
            margin-top: 0;
        }

        /* Input Fields */
        .input-field {
            width: 100%;
            padding: 14px 18px;
            margin: 0 0 16px 0;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 15px;
            font-family: inherit;
            background-color: #f8fafc;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-field::placeholder {
            color: #94a3b8;
        }

        /* Submit Button */
        .submit-button {
            width: 100%;
            margin: 24px 0 0 0;
            padding: 14px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .submit-button:hover::before {
            left: 100%;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* Alert Messages */
        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
            border: 1px solid;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee, #fdd);
            color: #c53030;
            border-color: #fed7d7;
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fff4, #e6fffa);
            color: #2f855a;
            border-color: #c6f6d5;
        }

        /* Error Messages */
        .error-message {
            color: #e53935;
            font-size: 0.8rem;
            margin-top: -12px;
            margin-bottom: 16px;
            padding: 4px 8px;
            background: rgba(229, 57, 53, 0.1);
            border-radius: 4px;
            border-left: 3px solid #e53935;
        }

        /* Login Information Links */
        .login-information {
            text-align: center;
            color: #718096;
            margin: 16px 0 0 0;
            font-size: 0.9rem;
        }

        .login-information a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-information a:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .login-information:first-of-type {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            body {
                padding: 16px;
            }

            .logo-container {
                width: 150px;
                margin-bottom: 24px;
            }

            .form-container {
                max-width: 100%;
                padding: 32px 24px;
                border-radius: 12px;
            }

            .form-title {
                font-size: 1.6rem;
                margin-bottom: 24px;
            }

            .input-field {
                padding: 12px 16px;
                font-size: 14px;
                margin-bottom: 14px;
            }

            .submit-button {
                padding: 12px 20px;
                font-size: 14px;
                margin-top: 20px;
            }

            .login-information {
                font-size: 0.85rem;
                margin: 14px 0 0 0;
            }

            .login-information:first-of-type {
                margin-top: 20px;
                padding-top: 16px;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 12px;
            }

            .logo-container {
                width: 120px;
                margin-bottom: 20px;
            }

            .form-container {
                padding: 28px 20px;
                border-radius: 10px;
            }

            .form-title {
                font-size: 1.4rem;
                margin-bottom: 20px;
            }

            .input-field {
                padding: 10px 14px;
                font-size: 13px;
                margin-bottom: 12px;
            }

            .submit-button {
                padding: 10px 18px;
                font-size: 13px;
                margin-top: 16px;
            }

            .alert {
                padding: 12px 16px;
                font-size: 0.85rem;
            }

            .error-message {
                font-size: 0.75rem;
                margin-top: -10px;
                margin-bottom: 12px;
            }

            .login-information {
                font-size: 0.8rem;
                margin: 12px 0 0 0;
            }

            .login-information:first-of-type {
                margin-top: 16px;
                padding-top: 12px;
            }
        }

        /* Loading Animation */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            animation: slideInUp 0.6s ease;
        }

        .logo-container {
            animation: slideInUp 0.6s ease 0.1s both;
        }

        /* Focus States for Accessibility */
        .submit-button:focus,
        .input-field:focus,
        .login-information a:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Success state for form fields */
        .input-field:valid:not(:placeholder-shown) {
            border-color: #48bb78;
            background-color: rgba(72, 187, 120, 0.05);
        }

        /* Loading state for submit button */
        .submit-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .submit-button:disabled::before {
            display: none;
        }

        /* Auto-hide alert animation */
        .alert.fade-out {
            opacity: 0;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body>
    <div class="logo-container">
        <img class="logo" src="<?= base_url('assets/images/logo.png') ?>" alt="Logo  Harapan" />
    </div>

    <div class="form-container">
        <h2 class="form-title">Masuk ke Akun</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <input type="email" name="email" class="input-field" placeholder="Email" required value="<?= old('email') ?>">
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <div class="error-message"><?= $validation->getError('email') ?></div>
            <?php endif; ?>

            <input type="password" name="password" class="input-field" placeholder="Password" required>
            <?php if (isset($validation) && $validation->hasError('password')): ?>
                <div class="error-message"><?= $validation->getError('password') ?></div>
            <?php endif; ?>

            <button type="submit" class="submit-button">Masuk</button>
        </form>

        <div class="login-information">Belum Punya Akun? <a href="<?= base_url('/register') ?>">Daftar Sekarang</a></div>
        <div class="login-information"><a href="<?= base_url('/forgot-password') ?>">Lupa Password</a></div>
    </div>

    <script>
        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            if (alerts.length > 0) {
                setTimeout(function() {
                    alerts.forEach(alert => {
                        alert.style.opacity = '0';
                        alert.style.transition = 'opacity 0.5s';
                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 500);
                    });
                }, 5000);
            }

            // Highlight redirect info if exists
            const redirectInfo = sessionStorage.getItem('redirectAfterLogin');
            if (redirectInfo) {
                const infoElement = document.createElement('div');
                infoElement.classList.add('alert', 'alert-danger');
                infoElement.textContent = 'Silakan login untuk mengakses halaman ' + redirectInfo;

                const formContainer = document.querySelector('.form-container');
                const formTitle = document.querySelector('.form-title');

                formContainer.insertBefore(infoElement, formTitle.nextSibling);
            }
        });
    </script>
</body>

</html>