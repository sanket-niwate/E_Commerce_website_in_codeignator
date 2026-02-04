<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In | The Tack Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Inter:wght@300;400&display=swap"
        rel="stylesheet">

    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        font-family: 'Inter', sans-serif;
    }

    .login-wrapper {
        min-height: 100vh;
    }

    .login-image {
        background: url('<?= base_url("assets/images/account/horse_login.jpg"); ?>') center center no-repeat;
        background-size: cover;
        min-height: 100vh;
    }

    .login-form-area {
        background-color: #f7f5f2;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .login-box {
        width: 100%;
        max-width: 420px;
    }

    .login-box h1 {
        font-family: 'Playfair Display', serif;
        color: #652527;
        text-align: center;
        margin-bottom: 40px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 14px;
        border: none;
        margin-bottom: 15px;
    }

    .form-control:focus {
        box-shadow: none;
        border: 1px solid #652527;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #652527;
        font-size: 1.2rem;
        user-select: none;
    }

    .btn-login {
        background-color: #652527;
        color: #fff;
        border-radius: 30px;
        padding: 12px;
        border: none;
        letter-spacing: 1px;
    }

    .btn-login:hover {
        background-color: #552023;
    }

    .login-links {
        text-align: center;
        margin-top: 20px;
        font-size: 0.85rem;
    }

    .login-links a {
        color: #652527;
        text-decoration: none;
        font-weight: 500;
    }

    .login-links a:hover {
        text-decoration: underline;
    }

    .alert {
        border-radius: 8px;
    }

    @media (max-width: 991px) {
        .login-image {
            display: none;
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid login-wrapper">
        <div class="row g-0 h-100">
            <!-- LEFT IMAGE -->
            <div class="col-lg-6 d-none d-lg-block login-image"></div>

            <!-- RIGHT FORM -->
            <div class="col-lg-6 login-form-area">
                <div class="login-box">

                    <h1>Log In</h1>

                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger text-center"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success text-center"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('auth/login'); ?>">
                        <!-- CSRF Token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">

                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="<?= set_value('email'); ?>" required>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required>
                            <i class="bi bi-eye-slash toggle-password" id="togglePassword"
                                onclick="togglePassword()"></i>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-login">LOG IN</button>
                        </div>

                        <div class="login-links">
                            <p class="mt-4"><a href="<?= site_url('auth/forgot_password'); ?>">Forgot your password?</a>
                            </p>
                            <p>Not a member? <a href="<?= site_url('auth/register'); ?>">Register</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle password visibility -->
    <script>
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
    </script>

    <!-- Auto-hide alerts -->
    <script>
    setTimeout(() => {
        const alertBox = document.querySelector('.alert');
        if (alertBox) alertBox.style.display = 'none';
    }, 4000);
    </script>
</body>

</html>