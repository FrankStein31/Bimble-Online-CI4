<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Harapan</title>
    <style>
        /* Modern Forgot Password Page CSS */
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

        /* Info Text */
        .info-text {
            text-align: center;
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        /* Input Fields */
        .input-field {
            width: 100%;
            padding: 14px 18px;
            margin: 0 0 20px 0;
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

        /* Email validation styling */
        .input-field[type="email"]:invalid:not(:placeholder-shown) {
            border-color: #e53935;
            background-color: rgba(229, 57, 53, 0.05);
        }

        .input-field[type="email"]:valid:not(:placeholder-shown) {
            border-color: #48bb78;
            background-color: rgba(72, 187, 120, 0.05);
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
            font-size: 0.9rem;
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

        /* Back Link */
        .back-link {
            text-align: center;
            margin: 24px 0 0 0;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .back-link a::before {
            content: "←";
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .back-link a:hover::before {
            transform: translateX(-2px);
        }

        .back-link a:hover {
            color: #5a67d8;
            text-decoration: underline;
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

            .info-text {
                font-size: 0.85rem;
                margin-bottom: 20px;
            }

            .input-field {
                padding: 12px 16px;
                font-size: 14px;
                margin-bottom: 16px;
            }

            .submit-button {
                padding: 12px 20px;
                font-size: 14px;
                margin-top: 20px;
            }

            .back-link {
                margin-top: 20px;
                padding-top: 16px;
            }

            .back-link a {
                font-size: 0.85rem;
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

            .info-text {
                font-size: 0.8rem;
                margin-bottom: 16px;
            }

            .input-field {
                padding: 10px 14px;
                font-size: 13px;
                margin-bottom: 14px;
            }

            .submit-button {
                padding: 10px 18px;
                font-size: 13px;
                margin-top: 16px;
            }

            .alert {
                padding: 12px 16px;
                font-size: 0.8rem;
            }

            .back-link {
                margin-top: 16px;
                padding-top: 12px;
            }

            .back-link a {
                font-size: 0.8rem;
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
        .back-link a:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
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
        <h2 class="form-title">Lupa Password</h2>

        <p class="info-text">
            Masukkan email yang terdaftar dan kami akan mengirimkan password baru ke email Anda.
        </p>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('debug')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('debug') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('forgot-password-process') ?>" method="post">
            <input type="email" class="input-field" id="email" name="email" placeholder="Email" required>
            <button type="submit" class="submit-button">Dapatkan Password Baru</button>
        </form>

        <div class="back-link">
            <a href="<?= base_url('login') ?>">Kembali ke Login</a>
        </div>
    </div>

    <script>
        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            if (alerts.length > 0) {
                setTimeout(function() {
                    alerts.forEach(alert => {
                        alert.classList.add('fade-out');
                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 500);
                    });
                }, 5000);
            }
        });
    </script>
</body>

</html>