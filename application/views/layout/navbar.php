<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>The Tack Shop | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Premium equestrian gear and accessories for riders and horses in Singapore">

    <!-- Bootstrap (FIXED: Removed spaces in URL) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (FIXED: Removed spaces in URL) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --primary-red: #652527;
        --primary-red-hover: #803333;
        --primary-red-light: #f5e9e8;
        --white: #ffffff;
        --text-dark: #2b2b2b;
        --text-gray: #555;
        --border-color: #e8e5e1;
        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: #f7f5f2;
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
        padding-top: 100px;
    }

    /* Navbar Container */
    .navbar-custom {
        background-color: var(--white);
        box-shadow: var(--shadow-md);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        transition: all 0.3s ease;
        padding: 0;
    }

    .navbar-custom.scrolled {
        box-shadow: var(--shadow-sm);
        padding: 5px 0;
    }

    /* Container */
    .navbar-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Logo Section */
    .navbar-brand-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px 0;
        transition: all 0.3s ease;
    }

    .navbar-brand {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .navbar-brand img {
        max-height: 65px;
        width: auto;
        object-fit: contain;
        transition: all 0.35s ease;
        filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.1));
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 10px rgba(101, 37, 39, 0.2));
    }

    /* Mobile Logo */
    @media (max-width: 768px) {
        .navbar-brand img {
            max-height: 50px;
        }
    }

    /* Navigation Links - FIXED MARGIN-TOP */
    .navbar-nav {
        position: relative;
        padding: 15px 0;
        margin-top: 0;
        /* Explicitly set to 0 */
        margin-bottom: 0;
    }

    .nav-link {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-dark) !important;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        padding: 8px 16px !important;
        position: relative;
        transition: all 0.3s ease;
        border-radius: 6px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: var(--primary-red);
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: var(--primary-red) !important;
        background-color: var(--primary-red-light);
        transform: translateY(-2px);
    }

    .nav-link:hover::after {
        width: 70%;
    }

    .nav-link.active {
        color: var(--primary-red) !important;
        font-weight: 600;
    }

    .nav-link.active::after {
        width: 70%;
        background-color: var(--primary-red);
    }

    /* Toggler Button */
    .navbar-toggler {
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        background-color: var(--white);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        margin: 10px auto;
    }

    .navbar-toggler:hover {
        background-color: var(--primary-red-light);
        transform: rotate(90deg);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(101, 37, 39, 0.15);
    }

    .navbar-toggler-icon {
        background-image: url("image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(101, 37, 39, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Collapsible Menu */
    .navbar-collapse {
        border-top: 1px solid var(--border-color);
        margin-top: 10px;
        padding-top: 15px;
    }

    @media (min-width: 992px) {
        .navbar-collapse {
            border-top: none;
            margin-top: 0;
            padding-top: 0;
        }
    }

    /* Active Indicator Dot */
    .nav-item {
        position: relative;
    }

    .nav-item.active::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 8px;
        height: 8px;
        background-color: var(--primary-red);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    @media (min-width: 992px) {
        .nav-item.active::before {
            opacity: 1;
        }
    }

    /* Hover Underline Animation */
    @media (min-width: 992px) {
        .nav-link {
            padding: 10px 20px !important;
        }

        .nav-link::after {
            bottom: -5px;
        }
    }

    /* Mobile Styling */
    @media (max-width: 991px) {
        .navbar-nav {
            flex-direction: column;
            padding: 10px 0;
            margin-top: 0 !important;
            /* Ensure no margin on mobile */
        }

        .nav-link {
            padding: 12px 20px !important;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            border-radius: 0;
            margin: 0;
        }

        .nav-link:last-child {
            border-bottom: none;
        }

        .nav-link::after {
            display: none;
        }

        .nav-item.active::before {
            display: none;
        }
    }

    /* Sticky Navbar Effect */
    @media (min-width: 992px) {
        .navbar-custom.scrolled .navbar-brand img {
            max-height: 55px;
        }
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom" id="mainNavbar">
        <div class="container navbar-container flex-column">

            <!-- Logo / Company Name -->
            <a class="navbar-brand mx-auto my-2" href="<?= site_url('home/index') ?>">
                <img src="<?= base_url('assets/images/navbar/logo-2-dark.webp'); ?>" alt="The Tack Shop">
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links (Second Row) -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li
                        class="nav-item px-2 <?= ($this->uri->segment(2) == 'index' || $this->uri->segment(1) == '') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('home/index') ?>">Home</a>
                    </li>
                    <li class="nav-item px-2 <?= ($this->uri->segment(2) == 'products') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('home/products') ?>">Shop</a>
                    </li>
                    <li class="nav-item px-2 <?= ($this->uri->segment(2) == 'cart') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('home/cart') ?>">Cart</a>
                    </li>
                    <li
                        class="nav-item px-2 <?= ($this->uri->segment(1) == 'auth' && $this->uri->segment(2) == 'login') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('auth/login') ?>">Login</a>
                    </li>
                    <li
                        class="nav-item px-2 <?= ($this->uri->segment(1) == 'auth' && $this->uri->segment(2) == 'register') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('auth/register') ?>">Register</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="<?= site_url('auth/logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Sticky navbar effect on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('mainNavbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
    </script>
</body>

</html>