<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Link Expired | The Tack Shop</title>
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
        text-align: center;
    }

    .box {
        width: 100%;
        max-width: 420px;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        color: #652527;
        margin-bottom: 20px;
    }

    p {
        color: #555;
        font-size: 0.95rem;
    }

    .btn-main {
        background-color: #652527;
        color: #fff;
        border-radius: 30px;
        padding: 12px;
        border: none;
        letter-spacing: 1px;
        margin-top: 25px;
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

            <!-- RIGHT CONTENT -->
            <div class="col-lg-6 form-area">
                <div class="box">

                    <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger text-center">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                    <?php endif; ?>
                    <h2>link is expired</h2>

                    <p>
                        This password reset link is either <strong>expired</strong> or <strong>invalid</strong>.
                    </p>

                    <p class="mt-2">
                        Please request a new password reset link to continue.
                    </p>

                    <a href="<?= site_url('auth/forgot_password'); ?>" class="btn btn-main w-100">
                        REQUEST NEW LINK
                    </a>

                </div>
            </div>

        </div>
    </div>
    <script>
    setTimeout(() => {
        window.location.href = "<?= site_url('auth/forgot_password'); ?>";
    }, 8000); // 8 seconds
    </script>

</body>

</html>