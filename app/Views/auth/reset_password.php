<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Bimbel Harapan</title>
    <style>
        /* Modern Reset Password Page CSS */
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
            max-width: 450px;
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
            margin-bottom: 24px;
            font-size: 1.8rem;
            font-weight: 600;
            margin-top: 0;
        }

        /* Info Text */
        .info-text {
            text-align: center;
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 32px;
            line-height: 1.5;
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
            font-family: 'Segoe UI', monospace;
            background-color: #f8fafc;
            color: #2d3748;
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }

        .input-field:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-field::placeholder {
            color: #94a3b8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            letter-spacing: normal;
        }

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin: -12px 0 16px 0;
            overflow: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-strength.show {
            opacity: 1;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-weak {
            background: #e53935;
            width: 25%;
        }

        .password-strength-fair {
            background: #ff9800;
            width: 50%;
        }

        .password-strength-good {
            background: #4caf50;
            width: 75%;
        }

        .password-strength-strong {
            background: #2e7d32;
            width: 100%;
        }

        /* Password match indicator */
        .input-field.password-match {
            border-color: #48bb78;
            background-color: rgba(72, 187, 120, 0.05);
        }

        .input-field.password-mismatch {
            border-color: #e53935;
            background-color: rgba(229, 57, 53, 0.05);
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
            padding: 16px 20px;
            margin-bottom: 24px;
            border-radius: 10px;
            font-weight: 500;
            border: 1px solid;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee, #fdd);
            color: #c53030;
            border-color: #fed7d7;
        }

        .alert ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
            text-align: left;
        }

        .alert ul li {
            margin-bottom: 4px;
            line-height: 1.4;
        }

        /* Password Requirements */
        .password-requirements {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            color: #4a5568;
        }

        .password-requirements h4 {
            margin: 0 0 8px 0;
            color: #2d3748;
            font-size: 0.9rem;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 16px;
        }

        .password-requirements li {
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .requirement-met {
            color: #2f855a;
            text-decoration: line-through;
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
                margin-bottom: 20px;
            }

            .info-text {
                font-size: 0.85rem;
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

            .password-requirements {
                padding: 12px;
                font-size: 0.8rem;
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
                margin-bottom: 16px;
            }

            .info-text {
                font-size: 0.8rem;
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
                font-size: 0.8rem;
            }

            .password-requirements {
                padding: 10px;
                font-size: 0.75rem;
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
        .input-field:focus {
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
    </style>
</head>

<body>
    <div class="logo-container">
        <img class="logo" src="<?= base_url('assets/images/logo.png') ?>" alt="Logo Bimbel Harapan" />
    </div>

    <div class="form-container">
        <h2 class="form-title">Reset Password</h2>

        <p class="info-text">
            Masukkan password baru Anda. Pastikan password yang Anda pilih aman dan mudah diingat.
        </p>

        <div class="password-requirements">
            <h4>Persyaratan Password:</h4>
            <ul>
                <li>Minimal 8 karakter</li>
                <li>Mengandung huruf besar dan kecil</li>
                <li>Mengandung angka</li>
                <li>Kedua password harus sama</li>
            </ul>
        </div>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('reset-password-process') ?>" method="post">
            <input type="hidden" name="token" value="<?= $token ?>">

            <input type="password" class="input-field" id="password" name="password" placeholder="Password Baru" required>
            <div class="password-strength" id="passwordStrength">
                <div class="password-strength-bar" id="strengthBar"></div>
            </div>

            <input type="password" class="input-field" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>

            <button type="submit" class="submit-button">Ubah Password</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const strengthIndicator = document.getElementById('passwordStrength');
            const strengthBar = document.getElementById('strengthBar');

            // Password strength checker
            password.addEventListener('input', function() {
                const value = this.value;
                const strength = checkPasswordStrength(value);

                if (value.length > 0) {
                    strengthIndicator.classList.add('show');
                    strengthBar.className = 'password-strength-bar password-strength-' + strength;
                } else {
                    strengthIndicator.classList.remove('show');
                }

                checkPasswordMatch();
            });

            // Password confirmation checker
            confirmPassword.addEventListener('input', checkPasswordMatch);

            function checkPasswordStrength(password) {
                let score = 0;

                if (password.length >= 8) score++;
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;

                if (score === 0) return 'weak';
                if (score <= 1) return 'weak';
                if (score === 2) return 'fair';
                if (score === 3) return 'good';
                return 'strong';
            }

            function checkPasswordMatch() {
                const pass = password.value;
                const confirmPass = confirmPassword.value;

                if (confirmPass.length > 0) {
                    if (pass === confirmPass) {
                        confirmPassword.classList.remove('password-mismatch');
                        confirmPassword.classList.add('password-match');
                    } else {
                        confirmPassword.classList.remove('password-match');
                        confirmPassword.classList.add('password-mismatch');
                    }
                } else {
                    confirmPassword.classList.remove('password-match', 'password-mismatch');
                }
            }
        });
    </script>
</body>

</html>