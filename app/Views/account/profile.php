<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile View</title>
    <style>
        /* Modern Profile View CSS */
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

/* Profile Card */
.profile-card {
    background: white;
    width: 100%;
    max-width: 450px;
    border-radius: 16px;
    padding: 40px 32px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

/* Profile Photo Container */
.profile-photo-container {
    width: 140px;
    height: 140px;
    margin-bottom: 24px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border: 4px solid transparent;
    background-clip: padding-box;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    position: relative;
}

.profile-photo-container::before {
    content: '';
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    z-index: -1;
}

.profile-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.profile-photo:hover {
    transform: scale(1.05);
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
    width: 50%;
    height: 50%;
    stroke: #667eea;
    stroke-width: 2;
}

/* Profile Name */
.profile-name {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #2d3748;
    text-align: center;
    line-height: 1.2;
}

/* Profile Info Container */
.profile-info-container {
    width: 100%;
    margin-top: 24px;
    background: #f8fafc;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e2e8f0;
}

.profile-info-item {
    padding: 16px 0;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    transition: background-color 0.2s ease;
}

.profile-info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.profile-info-item:first-child {
    padding-top: 0;
}

.profile-info-item:hover {
    background: rgba(102, 126, 234, 0.05);
    margin: 0 -12px;
    padding-left: 12px;
    padding-right: 12px;
    border-radius: 8px;
}

/* Info Labels and Values */
.info-label {
    font-weight: 600;
    min-width: 100px;
    color: #4a5568;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    flex: 1;
    color: #2d3748;
    font-size: 1rem;
    font-weight: 500;
    margin-left: 16px;
}

/* Special styling for password field */
.profile-info-item:last-child .info-value {
    font-family: monospace;
    font-size: 1.2rem;
    letter-spacing: 2px;
    color: #718096;
}

/* Edit Button */
.edit-button {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 14px 32px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 32px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.edit-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
}

.edit-button:hover::before {
    left: 100%;
}

.edit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.edit-button::after {
    content: "✏️";
    margin-left: 4px;
}

/* Icon Indicators for Info Items */
.profile-info-item::before {
    content: '';
    width: 20px;
    height: 20px;
    margin-right: 12px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    opacity: 0.6;
}

.profile-info-item:nth-child(1)::before {
    content: "📧";
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-info-item:nth-child(2)::before {
    content: "📱";
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-info-item:nth-child(3)::before {
    content: "🔒";
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    body {
        padding: 16px;
    }
    
    .profile-card {
        max-width: 100%;
        padding: 32px 24px;
        border-radius: 12px;
    }
    
    .profile-photo-container {
        width: 120px;
        height: 120px;
        margin-bottom: 20px;
    }
    
    .profile-name {
        font-size: 1.6rem;
    }
    
    .profile-info-container {
        margin-top: 20px;
        padding: 16px;
        border-radius: 10px;
    }
    
    .profile-info-item {
        padding: 12px 0;
    }
    
    .info-label {
        min-width: 80px;
        font-size: 0.85rem;
    }
    
    .info-value {
        font-size: 0.95rem;
        margin-left: 12px;
    }
    
    .edit-button {
        padding: 12px 28px;
        font-size: 14px;
        margin-top: 24px;
    }
}

@media screen and (max-width: 480px) {
    .profile-card {
        padding: 28px 20px;
        border-radius: 10px;
    }
    
    .profile-photo-container {
        width: 100px;
        height: 100px;
        margin-bottom: 16px;
    }
    
    .profile-name {
        font-size: 1.4rem;
        margin-bottom: 6px;
    }
    
    .profile-info-container {
        padding: 14px;
    }
    
    .profile-info-item {
        padding: 10px 0;
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    
    .info-label {
        min-width: auto;
        margin-bottom: 4px;
    }
    
    .info-value {
        margin-left: 0;
        width: 100%;
    }
    
    .profile-info-item::before {
        display: none;
    }
    
    .edit-button {
        padding: 10px 24px;
        font-size: 13px;
        margin-top: 20px;
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

.profile-card {
    animation: slideInUp 0.6s ease;
}

/* Focus States for Accessibility */
.edit-button:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Hover effect for profile photo */
.profile-photo-container:hover {
    transform: scale(1.02);
    transition: transform 0.3s ease;
}

/* Additional Visual Enhancements */
.profile-info-item:hover .info-label {
    color: #667eea;
    transition: color 0.2s ease;
}

.profile-info-item:hover .info-value {
    color: #2d3748;
    transition: color 0.2s ease;
}
    </style>
</head>

<body>
    <div class="profile-card">
        <div class="profile-photo-container">
            <?php if (isset($user['photo']) && $user['photo']): ?>
                <!-- Jika ada foto profil, tampilkan foto -->
                <img class="profile-photo" src="<?= base_url('uploads/profile/' . $user['photo']) ?>" alt="Profile Photo">
            <?php else: ?>
                <!-- Jika tidak ada foto, tampilkan ikon default -->
                <div class="profile-icon">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="35" r="15" stroke="black" stroke-width="3" />
                        <path d="M25 85C25 68 35 60 50 60C65 60 75 68 75 85" stroke="black" stroke-width="3" />
                    </svg>
                </div>
            <?php endif; ?>
        </div>

        <h2 class="profile-name"><?= $user['nama'] ?></h2>

        <div class="profile-info-container">
            <div class="profile-info-item">
                <div class="info-label">Email</div>
                <div class="info-value"><?= $user['email'] ?></div>
            </div>
            <div class="profile-info-item">
                <div class="info-label">Nomor HP</div>
                <div class="info-value"><?= $user['nomor_hp'] ?></div>
            </div>
            <div class="profile-info-item">
                <div class="info-label">Password</div>
                <div class="info-value">••••••••</div>
            </div>
        </div>

        <a href="<?= base_url('account/edit-profile') ?>" class="edit-button" style="text-decoration: none;">Edit Profil</a>
    </div>
</body>

</html>