<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In | The Tack Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Secure login for The Tack Shop equestrian gear">

    <!-- CRITICAL FIX: Removed spaces in CDN URLs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --primary-red: #652527;
        --primary-red-hover: #803333;
        --primary-red-light: #f5e9e8;
        --dark-gray: #2b2b2b;
        --light-beige: #f7f5f2;
        --border-color: #e8e5e1;
        --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 10px 30px rgba(101, 37, 39, 0.15);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
        font-family: 'Inter', sans-serif;
        background-color: var(--light-beige);
        overflow-x: hidden;
    }

    /* FULL-WIDTH CONTAINER */
    .login-wrapper {
        min-height: 100vh;
        width: 100vw;
        display: flex;
        overflow: hidden;
    }

    /* LEFT PANEL - IMAGE (50% width) */
    .login-image-panel {
        flex: 1;
        background: linear-gradient(rgba(101, 37, 39, 0.75), rgba(101, 37, 39, 0.55)),
            url('<?= base_url("assets/images/account/horse_login.jpg"); ?>') center center no-repeat;
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 60px 40px;
        position: relative;
        color: white;
        text-align: center;
    }

    .login-image-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.12"><text x="10" y="50" font-size="28" fill="%23ffffff">🐴</text><text x="60" y="80" font-size="28" fill="%23ffffff">🏇</text></svg>');
        background-repeat: repeat;
    }

    .login-image-content {
        position: relative;
        z-index: 1;
        max-width: 500px;
        animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-image-content h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
        letter-spacing: 2px;
        line-height: 1.2;
    }

    .login-image-content p {
        font-size: 1.35rem;
        opacity: 0.95;
        line-height: 1.8;
        margin-top: 15px;
        font-weight: 300;
    }

    .brand-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        display: inline-block;
        padding: 8px 30px;
        border-radius: 40px;
        margin-top: 30px;
        font-weight: 600;
        letter-spacing: 2px;
        font-size: 1.1rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* RIGHT PANEL - FORM (50% width) */
    .login-form-panel {
        flex: 1;
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 80px 60px;
        position: relative;
        overflow-y: auto;
    }

    .login-form-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 8px;
        height: 100%;
        background: linear-gradient(to bottom, var(--primary-red), #8a3336);
    }

    .login-form-container {
        width: 100%;
        max-width: 480px;
    }

    .login-logo {
        text-align: center;
        margin-bottom: 40px;
    }

    .login-logo img {
        max-height: 70px;
        width: auto;
        object-fit: contain;
        filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.1));
    }

    .login-title {
        font-family: 'Playfair Display', serif;
        color: var(--primary-red);
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.6rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        position: relative;
        padding-bottom: 15px;
    }

    .login-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-red);
        border-radius: 4px;
    }

    /* Form Controls */
    .form-group {
        margin-bottom: 28px;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-gray);
        margin-bottom: 12px;
        font-size: 1.1rem;
        display: block;
    }

    .form-control {
        border-radius: 14px;
        padding: 18px 25px;
        border: 2px solid var(--border-color);
        font-size: 1.1rem;
        transition: all 0.35s ease;
        background: #fcfbf9;
        width: 100%;
    }

    .form-control:focus {
        border-color: var(--primary-red);
        box-shadow: 0 0 0 5px rgba(101, 37, 39, 0.12);
        background: white;
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .toggle-password {
        position: absolute;
        right: 25px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--primary-red);
        font-size: 1.5rem;
        transition: color 0.3s;
        z-index: 10;
    }

    .password-wrapper .toggle-password:hover {
        color: var(--primary-red-hover);
    }

    /* Buttons */
    .btn-login {
        background: linear-gradient(90deg, var(--primary-red), #8a3336);
        color: white;
        border-radius: 16px;
        padding: 18px;
        border: none;
        font-weight: 700;
        letter-spacing: 2px;
        font-size: 1.25rem;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(101, 37, 39, 0.35);
        width: 100%;
        text-transform: uppercase;
        margin-top: 15px;
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:hover {
        background: linear-gradient(90deg, var(--primary-red-hover), #9a4444);
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(101, 37, 39, 0.45);
    }

    .btn-login:active {
        transform: translateY(1px);
    }

    /* Links */
    .login-links {
        text-align: center;
        margin-top: 35px;
        font-size: 1.05rem;
    }

    .login-links a {
        color: var(--primary-red);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
        position: relative;
        padding: 5px 0;
    }

    .login-links a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: var(--primary-red);
        transition: width 0.3s;
    }

    .login-links a:hover::after {
        width: 100%;
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 32px 0;
        color: #888;
        font-weight: 600;
        font-size: 1.05rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 2px solid var(--border-color);
    }

    .divider span {
        padding: 0 25px;
    }

    /* Alerts */
    .alert {
        border-radius: 14px;
        border: none;
        padding: 18px 25px;
        margin-bottom: 30px;
        font-weight: 600;
        box-shadow: var(--shadow-sm);
        animation: fadeInDown 0.5s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Footer */
    .login-footer {
        text-align: center;
        margin-top: 35px;
        color: #777;
        font-size: 0.95rem;
        padding-top: 25px;
        border-top: 1px solid var(--border-color);
    }

    /* Responsive Design - Full Width Horizontal to Vertical */
    @media (max-width: 1199px) {
        .login-wrapper {
            flex-direction: column;
        }

        .login-image-panel {
            width: 100%;
            height: 400px;
            padding: 40px 20px;
        }

        .login-image-content h1 {
            font-size: 2.6rem;
        }

        .login-image-content p {
            font-size: 1.2rem;
        }

        .login-form-panel {
            width: 100%;
            padding: 60px 30px;
        }

        .login-form-panel::before {
            width: 100%;
            height: 8px;
            top: 0;
            left: 0;
            border-radius: 0;
        }

        .login-title {
            font-size: 2.3rem;
        }
    }

    @media (max-width: 768px) {
        .login-image-panel {
            height: 350px;
            padding: 30px 15px;
        }

        .login-image-content h1 {
            font-size: 2.2rem;
        }

        .login-image-content p {
            font-size: 1.1rem;
        }

        .brand-badge {
            font-size: 0.95rem;
            padding: 6px 20px;
            margin-top: 20px;
        }

        .login-form-panel {
            padding: 50px 20px;
        }

        .login-form-container {
            max-width: 100%;
        }

        .login-logo img {
            max-height: 60px;
        }

        .login-title {
            font-size: 2.0rem;
        }

        .btn-login {
            padding: 16px;
            font-size: 1.15rem;
        }

        .form-control {
            padding: 16px 20px;
            font-size: 1.05rem;
        }

        .login-footer {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .login-image-panel {
            height: 300px;
            padding: 25px 10px;
        }

        .login-image-content h1 {
            font-size: 1.9rem;
        }

        .login-image-content p {
            font-size: 1rem;
            line-height: 1.6;
        }

        .login-form-panel {
            padding: 40px 15px;
        }

        .login-title {
            font-size: 1.8rem;
        }

        .btn-login {
            padding: 15px;
            font-size: 1.1rem;
        }

        .form-control {
            padding: 15px 18px;
            font-size: 1rem;
        }

        .divider {
            font-size: 0.95rem;
        }
    }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <!-- LEFT PANEL: FULL-WIDTH IMAGE (50% on desktop) -->
        <div class="login-image-panel">
            <div class="login-image-content">
                <h1>WELCOME BACK,<br>RIDER</h1>
                <p>Premium equestrian gear for dedicated riders<br>and cherished horses</p>
                <div class="brand-badge">EST. 2005 • SINGAPORE'S PREMIER EQUESTRIAN STORE</div>
            </div>
        </div>

        <!-- RIGHT PANEL: FULL-WIDTH FORM (50% on desktop) -->
        <div class="login-form-panel">
            <div class="login-form-container">
                <div class="login-logo">
                    <img src="<?= base_url('assets/images/navbar/logo-2-dark.webp'); ?>" alt="The Tack Shop Logo">
                </div>

                <h1 class="login-title">MEMBER LOGIN</h1>

                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= $this->session->flashdata('error'); ?>
                </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= $this->session->flashdata('success'); ?>
                </div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('auth/login'); ?>">
                    <!-- CSRF Token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="your@email.com"
                            value="<?= set_value('email'); ?>" required autocomplete="email">
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="••••••••" required autocomplete="current-password">
                            <i class="bi bi-eye-slash toggle-password" id="togglePassword"
                                onclick="togglePassword()"></i>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>SECURE LOGIN
                    </button>

                    <!-- Divider -->
                    <div class="divider">
                        <span>OR CONTINUE WITH</span>
                    </div>

                    <!-- Links -->
                    <div class="login-links">
                        <p class="mb-3">
                            <a href="<?= site_url('auth/forgot_password'); ?>">
                                <i class="bi bi-key me-1"></i>Forgot password?
                            </a>
                        </p>
                        <p class="mb-0">
                            New rider?
                            <a href="<?= site_url('auth/register'); ?>">
                                <i class="bi bi-person-plus me-1"></i>Create account
                            </a>
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="login-footer">
                        <p>© <?= date('Y'); ?> The Tack Shop Pte Ltd. All rights reserved.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CRITICAL FIX: Removed spaces in CDN URL -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Toggle password visibility
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePassword');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        }
    }

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade');
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 400);
            }, 5000);
        });

        // Auto-focus email field
        document.getElementById('email').focus();
    });
    </script>
</body>

</html>