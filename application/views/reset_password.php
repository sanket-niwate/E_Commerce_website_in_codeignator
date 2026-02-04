<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password | The Tack Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    .wrapper {
        min-height: 100vh;
    }

    .left-image {
        background: url('<?= base_url("assets/images/account/horse_login.jpg"); ?>') center center no-repeat;
        background-size: cover;
        min-height: 100vh;
    }

    .form-area {
        background-color: #f7f5f2;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .box {
        width: 100%;
        max-width: 420px;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        color: #652527;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 14px;
        border: none;
        margin-bottom: 15px;
    }

    .btn-main {
        background-color: #652527;
        color: #fff;
        border-radius: 30px;
        padding: 12px;
        border: none;
        letter-spacing: 1px;
    }

    .btn-main:hover {
        background-color: #552023;
    }

    @media (max-width: 991px) {
        .left-image {
            display: none;
        }
    }
    </style>
</head>

<body>

    <div class="container-fluid wrapper">
        <div class="row g-0 h-100">

            <!-- LEFT IMAGE -->
            <div class="col-lg-6 d-none d-lg-block left-image"></div>

            <!-- RIGHT FORM -->
            <div class="col-lg-6 form-area">
                <div class="box">

                    <h1>Reset Password</h1>


                    <form method="post" action="<?= site_url('auth/update_password'); ?>">
                        <!-- CSRF token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">

                        <!-- Hidden token -->
                        <input type="hidden" name="token" value="<?= $token ?>">

                        <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger text-center">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success text-center">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                        <?php endif; ?>

                        <div class="password-wrapper mb-3">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="New Password" required>
                            <i class="bi bi-eye-slash toggle-password" id="togglePassword"
                                onclick="togglePassword()"></i>
                        </div>

                        <div class="password-wrapper mb-3">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                placeholder="Confirm Password" required>
                            <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword"
                                onclick="toggleConfirmPassword()"></i>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-main">
                                UPDATE PASSWORD
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePassword');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }

    function toggleConfirmPassword() {
        const passwordField = document.getElementById('confirm_password');
        const toggleIcon = document.getElementById('toggleConfirmPassword');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }

    // Auto-hide alerts after 3s
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => el.style.display = 'none');
    }, 3000);
    </script>
</body>

</html>