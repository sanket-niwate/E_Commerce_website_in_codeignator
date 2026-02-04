<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register | The Tack Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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

    .register-wrapper {
        min-height: 100vh;
    }

    .register-image {
        background: url('<?= base_url("assets/images/account/horse_register.jpg"); ?>') center center no-repeat;
        background-size: cover;
        min-height: 100vh;
    }

    .register-form-area {
        background-color: #f7f5f2;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .register-box {
        width: 100%;
        max-width: 460px;
    }

    .register-box h1 {
        font-family: 'Playfair Display', serif;
        color: #652527;
        text-align: center;
        margin-bottom: 35px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 14px;
        border: none;
        margin-bottom: 14px;
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

    .btn-register {
        background-color: #652527;
        color: #fff;
        border-radius: 30px;
        padding: 12px;
        border: none;
        letter-spacing: 1px;
    }

    .btn-register:hover {
        background-color: #552023;
    }

    .register-links {
        text-align: center;
        margin-top: 20px;
        font-size: 0.85rem;
    }

    .register-links a {
        color: #652527;
        text-decoration: none;
        font-weight: 500;
    }

    .register-links a:hover {
        text-decoration: underline;
    }

    .alert {
        border-radius: 8px;
    }

    @media (max-width: 991px) {
        .register-image {
            display: none;
        }
    }
    </style>
</head>

<body>

    <div class="container-fluid register-wrapper">
        <div class="row g-0 h-100">

            <div class="col-lg-6 d-none d-lg-block register-image"></div>

            <div class="col-lg-6 register-form-area">
                <div class="register-box">

                    <h1>Create Account</h1>

                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger text-center"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success text-center"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('auth/register'); ?>">
                        <!-- CSRF -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                            value="<?= set_value('name'); ?>" required>
                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="<?= set_value('email'); ?>" required>
                        <input type="text" name="phone" class="form-control" placeholder="Phone" maxlength="10"
                            value="<?= set_value('phone'); ?>">
                        <textarea name="address" class="form-control" placeholder="Address"
                            rows="2"><?= set_value('address'); ?></textarea>

                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required>
                            <i class="bi bi-eye-slash toggle-password" id="togglePassword"
                                onclick="togglePassword()"></i>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-register">REGISTER</button>
                        </div>

                        <div class="register-links">
                            <p class="mt-4">Already have an account? <a href="<?= site_url('auth/login'); ?>">Log In</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

    setTimeout(() => {
        const alertBox = document.querySelector('.alert');
        if (alertBox) alertBox.style.display = 'none';
    }, 4000);
    </script>

</body>

</html>