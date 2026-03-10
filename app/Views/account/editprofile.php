<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <style>
     /* Modern Edit Profile CSS - Compact Version */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
    padding: 20px;
}

/* Profile Card Form */
.profile-card {
    background: white;
    width: 100%;
    max-width: 450px;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.profile-card::before {
    content: 'Edit Profile';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 16px;
}

/* Adjust form content to account for header */
.profile-card > * {
    margin-top: 50px;
}

.profile-card > *:first-child {
    margin-top: 16px;
}

/* Profile Photo Container */
.profile-photo-container {
    position: relative;
    width: 100px;
    height: 100px;
    margin-bottom: 20px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border: 3px solid transparent;
    background-clip: padding-box;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.profile-photo-container::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    right: -3px;
    bottom: -3px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    z-index: -1;
}

.profile-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Profile Icon */
.profile-icon {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
}

.profile-icon svg {
    width: 40%;
    height: 40%;
    stroke: #667eea;
    stroke-width: 2;
}

/* Photo Upload Overlay */
.photo-upload-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.photo-upload-overlay:hover {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.95), rgba(118, 75, 162, 0.95));
}

.photo-upload-overlay span {
    color: white;
    font-size: 12px;
    font-weight: 600;
}

/* Form Groups */
.form-group {
    width: 100%;
    margin-bottom: 16px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    color: #4a5568;
}

/* Input Fields */
.input-field {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    box-sizing: border-box;
    background-color: #f8fafc;
    transition: all 0.3s ease;
    color: #2d3748;
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

/* Password field specific styling */
input[type="password"].input-field {
    font-family: 'Segoe UI', monospace;
    letter-spacing: 1px;
}

/* Small text for password hint */
.form-group small {
    display: block;
    margin-top: 4px;
    color: #718096;
    font-size: 0.75rem;
    font-style: italic;
}

/* Error Messages */
.error-message {
    color: #e53935;
    font-size: 0.75rem;
    margin-top: 4px;
    padding: 4px 8px;
    background: rgba(229, 57, 53, 0.1);
    border-radius: 4px;
    border-left: 3px solid #e53935;
}

/* Submit Button */
.edit-button {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 28px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 16px;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.edit-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

/* Hidden file input */
#photoInput {
    display: none;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    body {
        padding: 16px;
    }
    
    .profile-card {
        max-width: 100%;
        padding: 20px;
        border-radius: 10px;
    }
    
    .profile-card::before {
        height: 45px;
        font-size: 1.1rem;
    }
    
    .profile-card > * {
        margin-top: 45px;
    }
    
    .profile-card > *:first-child {
        margin-top: 12px;
    }
    
    .profile-photo-container {
        width: 90px;
        height: 90px;
        margin-bottom: 16px;
    }
    
    .form-group {
        margin-bottom: 14px;
    }
    
    .input-field {
        padding: 10px 14px;
        font-size: 13px;
    }
    
    .edit-button {
        padding: 10px 24px;
        font-size: 13px;
        margin-top: 12px;
    }
}

@media screen and (max-width: 480px) {
    .profile-card {
        padding: 16px;
        border-radius: 8px;
    }
    
    .profile-card::before {
        height: 40px;
        font-size: 1rem;
    }
    
    .profile-card > * {
        margin-top: 40px;
    }
    
    .profile-card > *:first-child {
        margin-top: 10px;
    }
    
    .profile-photo-container {
        width: 80px;
        height: 80px;
        margin-bottom: 12px;
    }
    
    .photo-upload-overlay {
        height: 25px;
    }
    
    .photo-upload-overlay span {
        font-size: 11px;
    }
    
    .form-group {
        margin-bottom: 12px;
    }
    
    .form-label {
        font-size: 0.8rem;
        margin-bottom: 4px;
    }
    
    .input-field {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .edit-button {
        padding: 8px 20px;
        font-size: 12px;
        margin-top: 10px;
    }
    
    .form-group small {
        font-size: 0.7rem;
    }
    
    .error-message {
        font-size: 0.7rem;
    }
}

/* Loading Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.profile-card {
    animation: fadeIn 0.5s ease;
}

/* Focus States for Accessibility */
.edit-button:focus,
.input-field:focus,
.photo-upload-overlay:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Success state for form fields */
.input-field:valid:not(:placeholder-shown) {
    border-color: #48bb78;
    background-color: rgba(72, 187, 120, 0.05);
}

/* Loading state for submit button */
.edit-button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}
    </style>
</head>

<body>

    <form class="profile-card" action="<?= base_url('account/update-profile') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="profile-photo-container">
            <div class="profile-icon" id="defaultIcon" style="<?= session()->get('photo') ? 'display: none;' : '' ?>">
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="35" r="15" stroke="black" stroke-width="3" />
                    <path d="M25 85C25 68 35 60 50 60C65 60 75 68 75 85" stroke="black" stroke-width="3" />
                </svg>
            </div>
            <img id="profilePhoto" class="profile-photo" src="<?= session()->get('photo') ? base_url('uploads/profile/' . session()->get('photo')) : '' ?>" style="<?= session()->get('photo') ? '' : 'display: none;' ?>" alt="Profile Photo">
            <label for="photoInput" class="photo-upload-overlay">
                <span>Ubah Foto</span>
            </label>
            <input type="file" id="photoInput" name="photo" accept="image/*">
        </div>

        <div class="form-group">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="input-field" value="<?= $user['nama'] ?? '' ?>" placeholder="Masukkan nama lengkap">
            <?php if (isset($validation) && $validation->hasError('nama')): ?>
                <div class="error-message"><?= $validation->getError('nama') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="input-field" value="<?= $user['email'] ?? '' ?>" placeholder="contoh@email.com">
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <div class="error-message"><?= $validation->getError('email') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="tel" id="nomor_hp" name="nomor_hp" class="input-field" value="<?= $user['nomor_hp'] ?? '' ?>" placeholder="08xxxxxxxxxx">
            <?php if (isset($validation) && $validation->hasError('nomor_hp')): ?>
                <div class="error-message"><?= $validation->getError('nomor_hp') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="input-field" value="********" placeholder="Masukkan password baru">
            <small>* Kosongkan jika tidak ingin mengubah password</small>
            <?php if (isset($validation) && $validation->hasError('password')): ?>
                <div class="error-message"><?= $validation->getError('password') ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="edit-button">Save Profil</button>
    </form>


    <script>
        // Handle photo upload preview
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const profilePhoto = document.getElementById('profilePhoto');
                    const defaultIcon = document.getElementById('defaultIcon');

                    profilePhoto.src = e.target.result;
                    profilePhoto.style.display = 'block';
                    defaultIcon.style.display = 'none';
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>