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
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap"
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
        --light-beige: #f7f5f2;
    }

    /* CRITICAL FIX: Remove all top spacing */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--light-beige);
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
        /* CRITICAL FIX: No top gap */
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    /* Hero Section */
    .hero-sweeper {
        position: relative;
        height: 85vh;
        min-height: 500px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-sweeper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .hero-sweeper:hover img {
        transform: scale(1.05);
    }

    /* Overlay */
    .hero-sweeper::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg,
                rgba(101, 37, 39, 0.65) 0%,
                rgba(101, 37, 39, 0.45) 100%);
    }

    /* Hero Content */
    .hero-content {
        position: absolute;
        inset: 0;
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: var(--white);
        padding: 20px;
        animation: fadeInUp 1s ease;
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

    .hero-content h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        font-weight: 700;
        letter-spacing: 4px;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: textGlow 2s ease-in-out infinite alternate;
    }

    @keyframes textGlow {
        from {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                0 0 20px rgba(255, 255, 255, 0.3);
        }

        to {
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.8),
                0 0 30px rgba(255, 255, 255, 0.5),
                0 0 40px rgba(101, 37, 39, 0.8);
        }
    }

    .hero-content p {
        font-family: 'Inter', sans-serif;
        font-size: 1.3rem;
        letter-spacing: 1.5px;
        max-width: 600px;
        margin-bottom: 30px;
        font-weight: 300;
        opacity: 0.95;
    }

    .btn-outline-light {
        padding: 14px 45px;
        letter-spacing: 1.5px;
        border-width: 2px;
        font-weight: 600;
        font-size: 1.05rem;
        border-radius: 50px;
        transition: all 0.4s ease;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-outline-light:hover {
        background: var(--white);
        color: var(--primary-red);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        border-color: var(--white);
    }

    /* Banner Section */
    .home-banner {
        font-family: 'Playfair Display', serif;
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        padding: 80px 0;
        background: linear-gradient(135deg, #fcfaf7 0%, #f5f2ee 100%);
    }

    .banner-title {
        font-size: 4.2rem;
        color: var(--primary-red);
        line-height: 1.4;
        font-weight: 600;
        position: relative;
        animation: slideInLeft 1.2s ease;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-100px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .banner-icons img {
        width: 70px;
        margin: 15px;
        vertical-align: middle;
        animation: float 3s ease-in-out infinite;
    }

    .banner-icons img:nth-child(2) {
        animation-delay: 0.2s;
    }

    .banner-icons img:nth-child(3) {
        animation-delay: 0.4s;
    }

    .banner-icons img:nth-child(4) {
        animation-delay: 0.6s;
    }

    .banner-icons img:nth-child(5) {
        animation-delay: 0.8s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .custom-outline-btn {
        border: 2px solid var(--primary-red);
        color: var(--primary-red);
        padding: 14px 40px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        letter-spacing: 1.5px;
        font-size: 1.05rem;
        text-transform: uppercase;
        transition: all 0.4s ease;
        margin-top: 30px;
        box-shadow: 0 4px 15px rgba(101, 37, 39, 0.15);
    }

    .custom-outline-btn:hover {
        background: var(--primary-red);
        color: var(--white);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(101, 37, 39, 0.3);
    }

    /* Service Section */
    .service-section {
        background: var(--white);
        padding: 80px 0;
        position: relative;
    }

    .service-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: var(--primary-red);
        border-radius: 2px;
    }

    .service-box {
        text-align: center;
        color: var(--primary-red);
        padding: 30px 20px;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .service-box::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary-red);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.4s ease;
    }

    .service-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(101, 37, 39, 0.15);
    }

    .service-box:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    .service-box img {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
        transition: transform 0.4s ease;
    }

    .service-box:hover img {
        transform: scale(1.15) rotate(5deg);
    }

    .service-box h5 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-dark);
        transition: color 0.4s ease;
    }

    .service-box:hover h5 {
        color: var(--primary-red);
    }

    .service-box p {
        font-family: 'Inter', sans-serif;
        color: var(--text-gray);
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-content h1 {
            font-size: 3.5rem;
        }

        .hero-content p {
            font-size: 1.15rem;
        }

        .banner-title {
            font-size: 3.2rem;
        }

        .banner-icons img {
            width: 55px;
        }

        .service-box img {
            width: 65px;
            height: 65px;
        }
    }

    @media (max-width: 768px) {
        .hero-sweeper {
            height: 70vh;
            min-height: 400px;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            letter-spacing: 3px;
        }

        .hero-content p {
            font-size: 1rem;
            max-width: 450px;
        }

        .btn-outline-light {
            padding: 12px 35px;
            font-size: 0.95rem;
        }

        .home-banner {
            min-height: auto;
            padding: 60px 0;
        }

        .banner-title {
            font-size: 2.5rem;
            line-height: 1.5;
        }

        .banner-icons img {
            width: 45px;
            margin: 8px;
        }

        .custom-outline-btn {
            padding: 12px 30px;
            font-size: 0.95rem;
            margin-top: 20px;
        }

        .service-section {
            padding: 60px 0;
        }

        .service-box {
            padding: 25px 15px;
            margin-bottom: 20px;
        }

        .service-box img {
            width: 60px;
            height: 60px;
        }

        .service-box h5 {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }

        .hero-content p {
            font-size: 0.95rem;
        }

        .banner-title {
            font-size: 2rem;
        }

        .banner-icons img {
            width: 40px;
        }

        .service-box img {
            width: 50px;
            height: 50px;
        }

        .service-box h5 {
            font-size: 1.15rem;
        }

        .service-box p {
            font-size: 0.95rem;
        }
    }
    </style>
</head>

<body class="home-page">
    <?php $this->load->view('layout/navbar'); ?>

    <script>
    // Add home-specific class to navbar AFTER it's loaded
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar-custom');
        if (navbar) {
            navbar.classList.add('home-transparent');
            // Force initial state
            if (window.scrollY < 50) {
                navbar.classList.remove('scrolled');
            }
        }

        // Smooth scroll adjustment for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const navbarHeight = 100; // Match CSS variable
                    const targetPosition = targetElement.getBoundingClientRect().top + window
                        .pageYOffset - navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
    </script>

    <!-- Hero Sweeper - FULL VIEWPORT HEIGHT -->
    <section class="hero-sweeper">
        <img src="<?= base_url('assets/images/home/horse rider.jpg'); ?>" alt="The Tack Shop">
        <div class="hero-content">
            <h1>THE TACK SHOP</h1>
            <p>Premium equestrian essentials for horse & rider</p>
            <a href="<?= site_url('home/products') ?>" class="btn btn-outline-light btn-lg">
                SHOP COLLECTION
            </a>
        </div>
    </section>

    <!-- BANNER SECTION -->
    <section class="home-banner">
        <div>
            <h1 class="banner-title">
                <div class="banner-icons my-4">
                    At <img src="<?= base_url('assets/images/banner/equestrian_2.webp') ?>"> The Tack Shop,
                    <img src="<?= base_url('assets/images/banner/boot.webp') ?>">
                    <img src="<?= base_url('assets/images/banner/helmet.webp') ?>"><br>
                    we're passionate <img src="<?= base_url('assets/images/banner/white_horse.webp') ?>"> about <br>
                    all things equestrian.
                    <img src="<?= base_url('assets/images/banner/equestrian_1.webp') ?>">
                </div>
            </h1>
            <a href="#" class="custom-outline-btn">MORE ABOUT US</a>
        </div>
    </section>

    <!-- SERVICE SECTION -->
    <section class="service-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 service-box">
                    <img src="//thetackshop.sg/cdn/shop/files/free_shipping.svg?v=1732181657&width=100"
                        alt="Free Shipping">
                    <h5>Free Shipping</h5>
                    <p>For local orders over $399</p>
                </div>
                <div class="col-md-4 service-box">
                    <img src="//thetackshop.sg/cdn/shop/files/store.svg?v=1732181699&width=100" alt="Store Pickup">
                    <h5>Store Pickup</h5>
                    <p>Collect as soon as today</p>
                </div>
                <div class="col-md-4 service-box">
                    <img src="//thetackshop.sg/cdn/shop/files/return.svg?v=1732181704&width=100" alt="Easy Returns">
                    <h5>Easy Returns</h5>
                    <p>Within 7 days of purchase</p>
                </div>
            </div>
        </div>
    </section>

    <?php $this->load->view('layout/footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Enhanced scroll handling for home page
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar-custom.home-transparent');
        if (!navbar) return;

        let lastScroll = 0;
        const navbarHeight = 100; // Match CSS variable

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            // Show/hide navbar on scroll
            if (currentScroll <= 0) {
                navbar.classList.remove('scrolled');
                return;
            }

            // Scrolled down
            if (currentScroll > lastScroll && currentScroll > navbarHeight) {
                navbar.classList.add('scrolled');
            }
            // Scrolled up
            else if (currentScroll < lastScroll) {
                navbar.classList.add('scrolled');
            }

            lastScroll = currentScroll;
        });

        // Initial check
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        }
    });
    </script>
</body>

</html>