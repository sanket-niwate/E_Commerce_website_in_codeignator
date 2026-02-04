<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password | The Tack Shop</title>
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

    .form-control:focus {
        box-shadow: none;
        border: 1px solid #652527;
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

    .links {
        text-align: center;
        margin-top: 20px;
        font-size: 0.85rem;
    }

    .links a {
        color: #652527;
        text-decoration: none;
        font-weight: 500;
    }

    .links a:hover {
        text-decoration: underline;
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

                    <h1>Forgot Password</h1>

                    <p class="text-center text-muted mb-4">
                        Enter your email and we’ll send you a reset link.
                    </p>

                    <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success text-center">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger text-center">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('auth/send_reset_link'); ?>">
                        <!-- CSRF token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>">

                        <input type="email" name="email" class="form-control" placeholder="Email address" required
                            value="<?= set_value('email'); ?>">

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-main">
                                SEND RESET LINK
                            </button>
                        </div>
                    </form>


                    <div class="links">
                        <p class="mt-4">
                            <a href="<?= site_url('auth/login'); ?>">Back to Login</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
    setTimeout(() => {
        const alertBox = document.querySelector('.alert');
        if (alertBox) alertBox.style.display = 'none';
    }, 3000);
    </script>

</body>

</html>