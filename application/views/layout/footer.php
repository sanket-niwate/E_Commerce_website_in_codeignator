<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>The Tack Shop | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Premium equestrian gear and accessories for riders and horses in Singapore">

    <!-- Bootstrap CSS (fixed URL spacing) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (fixed URL syntax) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --primary-red: #652527;
        --accent-orange: #e05a2e;
        /* Improved contrast version */
        --light-beige: #f7f5f2;
        --footer-text: #f1e9e6;
        --footer-link-hover: rgba(255, 255, 255, 0.85);
    }

    body {
        background-color: var(--light-beige);
        font-family: 'Inter', sans-serif;
        color: #2b2b2b;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1 0 auto;
    }

    /* Announcement Bar - Accessible Implementation */
    .announcement-bar {
        background-color: var(--accent-orange);
        color: white;
        padding: 8px 0;
        text-align: center;
        font-weight: 500;
        font-size: 0.95rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    @media (prefers-reduced-motion: reduce) {
        .announcement-bar {
            animation: none !important;
        }
    }

    /* Footer Styles */
    .site-footer {
        background-color: var(--primary-red);
        padding: 60px 0 30px;
        color: var(--footer-text);
        font-family: 'Inter', sans-serif;
    }

    .footer-logo {
        max-width: 200px;
        height: auto;
        transition: opacity 0.3s ease;
    }

    .footer-logo:hover {
        opacity: 0.9;
    }

    .footer-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1.25rem;
        position: relative;
        padding-bottom: 8px;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--accent-orange);
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.65rem;
    }

    .footer-links a {
        text-decoration: none;
        color: var(--footer-text);
        transition: all 0.25s ease;
        display: inline-block;
        line-height: 1.5;
    }

    .footer-links a:hover {
        color: var(--footer-link-hover);
        transform: translateX(3px);
    }

    .footer-contact p {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .footer-contact a {
        color: var(--footer-text);
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .footer-contact a:hover {
        color: var(--footer-link-hover);
        text-decoration: underline;
    }

    .site-footer hr {
        border-color: rgba(255, 255, 255, 0.15);
        margin: 35px 0;
    }

    .footer-bottom {
        font-size: 0.875rem;
        color: #e2d2cd;
        padding-top: 15px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {

        .site-footer .col-md-4,
        .site-footer .col-md-2,
        .site-footer .col-md-3 {
            margin-bottom: 25px;
        }

        .footer-heading::after {
            width: 30px;
        }
    }
    </style>
</head>

<body>
    <!-- Main content placeholder (required for proper document structure) -->
    <main>
        <!-- Page content would go here -->
    </main>

    <!-- Professional Announcement Bar (non-animated for accessibility) -->
    <div class="announcement-bar" role="banner" aria-label="Site announcement">
        <div class="container">
            🐎 Free shipping on orders over $150 • New equestrian collection arriving next week!
        </div>
    </div>

    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <!-- Brand -->
                <div class="col-md-4 mb-4">
                    <a href="<?= base_url(); ?>" class="d-block" aria-label="The Tack Shop Home">
                        <img src="<?= base_url('assets/images/footer/logo-1-light.webp'); ?>" alt="The Tack Shop Logo"
                            class="footer-logo img-fluid">
                    </a>
                    <p class="footer-text mt-3" style="font-size: 0.95rem; max-width: 90%;">
                        Singapore's premier equestrian supply store since 2005. Quality gear for dedicated riders and
                        happy horses.
                    </p>
                </div>

                <!-- Shop -->
                <div class="col-md-2 mb-4">
                    <h3 class="footer-heading">Shop</h3>
                    <ul class="footer-links">
                        <li><a href="<?= site_url('shop/rider'); ?>" aria-label="Rider Equipment">Rider Gear</a></li>
                        <li><a href="<?= site_url('shop/horse'); ?>" aria-label="Horse Tack & Care">Horse Supplies</a>
                        </li>
                        <li><a href="<?= site_url('shop/accessories'); ?>"
                                aria-label="Equestrian Accessories">Accessories</a></li>
                        <li><a href="<?= site_url('new-arrivals'); ?>" aria-label="New Products">New Arrivals</a></li>
                    </ul>
                </div>

                <!-- Account -->
                <div class="col-md-3 mb-4">
                    <h3 class="footer-heading">Account</h3>
                    <ul class="footer-links">
                        <li><a href="<?= site_url('auth/login'); ?>" aria-label="Customer Login">Login</a></li>
                        <li><a href="<?= site_url('auth/register'); ?>" aria-label="Create Account">Register</a></li>
                        <li><a href="<?= site_url('account/orders'); ?>" aria-label="Order History">Order History</a>
                        </li>
                        <li><a href="<?= site_url('account/wishlist'); ?>" aria-label="Saved Items">Wishlist</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-3 mb-4 footer-contact">
                    <h3 class="footer-heading">Contact</h3>
                    <p class="footer-text mb-2">📍 Singapore</p>
                    <p class="mb-2">
                        <a href="mailto:hello@thetackshop.sg" aria-label="Email us at hello@thetackshop.sg">
                            ✉️ hello@thetackshop.sg
                        </a>
                    </p>
                    <p class="mb-3">
                        <a href="tel:+6560000000" aria-label="Call us at +65 6000 0000">
                            📞 +65 6000 0000
                        </a>
                    </p>
                    <div class="d-flex gap-3 mt-2">
                        <a href="#" aria-label="Facebook" class="text-decoration-none">
                            <span style="color:var(--footer-text); font-size:1.25rem">📱</span>
                        </a>
                        <a href="#" aria-label="Instagram" class="text-decoration-none">
                            <span style="color:var(--footer-text); font-size:1.25rem">📸</span>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="d-inline-block bg-dark text-white px-2 py-1 rounded" style="font-size:0.75rem">
                        🌿 Sustainably packaged • Carbon-neutral shipping
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end footer-bottom">
                    © <?= date('Y'); ?> The Tack Shop Pte Ltd. All rights reserved.<br>
                    <a href="<?= site_url('privacy-policy'); ?>" class="text-decoration-none"
                        style="color:#e2d2cd; font-size:0.85em">Privacy Policy</a> •
                    <a href="<?= site_url('terms'); ?>" class="text-decoration-none"
                        style="color:#e2d2cd; font-size:0.85em">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS (fixed URL spacing) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Accessibility enhancement for announcement -->
    <script>
    // Respect user's motion preferences
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelector('.announcement-bar')?.classList.add('no-animation');
    }
    </script>
</body>

</html>