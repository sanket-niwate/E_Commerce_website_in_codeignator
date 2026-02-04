<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $product->name ?> | The Tack Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="<?= htmlspecialchars($product->name) ?> - Premium equestrian gear at The Tack Shop">

    <!-- FIXED: Removed spaces in CDN URLs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
    /* CRITICAL FIX: Remove all top spacing */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary-red: #652527;
        --primary-red-hover: #803333;
        --light-beige: #f9f7f3;
        --white: #ffffff;
        --text-dark: #2b2b2b;
        --text-gray: #555;
        --border-color: #e8e5e1;
    }

    body {
        background: var(--light-beige);
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
        padding-top: 0 !important;
        margin-top: 0 !important;
        overflow-x: hidden;
    }

    /* Flash Messages */
    .flash-message {
        padding: 15px 25px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .flash-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .flash-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .flash-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-red) 0%, #8a3336 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><text x="10" y="50" font-size="20" fill="%23ffffff">🐴</text><text x="60" y="80" font-size="20" fill="%23ffffff">🏇</text></svg>');
        background-repeat: repeat;
    }

    .page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 600;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .breadcrumb {
        background: transparent;
        justify-content: center;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: white;
    }

    .breadcrumb-item.active {
        color: white;
    }

    /* Product Wrapper - Horizontal Layout */
    .product-wrapper {
        background: var(--white);
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
    }

    .product-row {
        align-items: center;
    }

    /* Product Image Column */
    .product-image-col {
        background: linear-gradient(135deg, #fcfaf7 0%, #f5f2ee 100%);
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
    }

    .product-image {
        max-width: 100%;
        max-height: 420px;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .product-image-col:hover .product-image {
        transform: scale(1.05);
    }

    /* Product Info Column */
    .product-info-col {
        padding: 50px;
    }

    .product-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        color: var(--primary-red);
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .product-price {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        font-weight: 700;
        color: var(--primary-red);
        margin: 20px 0 30px;
        display: block;
    }

    .product-desc {
        color: var(--text-gray);
        line-height: 1.8;
        font-size: 1.1rem;
        margin-bottom: 40px;
        padding: 25px;
        background: #f8f7f5;
        border-radius: 10px;
        border-left: 4px solid var(--primary-red);
    }

    /* Status Messages */
    .status-message {
        padding: 20px 25px;
        border-radius: 10px;
        margin-bottom: 30px;
        font-weight: 600;
        text-align: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .status-unavailable {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .status-outofstock {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    /* Add to Cart Form */
    .add-to-cart-section {
        background: #f8f7f5;
        padding: 30px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    .qty-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        padding: 15px 20px;
        background: white;
        border-radius: 10px;
        border: 2px solid var(--border-color);
    }

    .qty-wrapper label {
        font-weight: 600;
        font-size: 18px;
        color: var(--text-dark);
        min-width: 110px;
    }

    .qty-input {
        width: 90px;
        padding: 10px 15px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .qty-input:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 4px rgba(101, 37, 39, 0.15);
    }

    .stock-availability {
        color: var(--text-gray);
        font-size: 0.95rem;
        font-style: italic;
    }

    .add-to-cart-btn {
        background-color: var(--primary-red);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 16px 45px;
        font-size: 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.35s ease;
        width: 100%;
        letter-spacing: 1px;
        box-shadow: 0 6px 18px rgba(101, 37, 39, 0.25);
    }

    .add-to-cart-btn:hover {
        background-color: var(--primary-red-hover);
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(101, 37, 39, 0.35);
    }

    .add-to-cart-btn:active {
        transform: translateY(1px);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .product-info-col {
            padding: 40px;
        }

        .product-title {
            font-size: 32px;
        }

        .product-price {
            font-size: 36px;
        }
    }

    @media (max-width: 768px) {
        .product-row {
            flex-direction: column;
        }

        .product-image-col {
            min-height: 400px;
            padding: 30px;
        }

        .product-image {
            max-height: 350px;
        }

        .product-info-col {
            padding: 40px 30px;
        }

        .product-title {
            font-size: 28px;
        }

        .product-price {
            font-size: 32px;
            margin: 15px 0 25px;
        }

        .qty-wrapper {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .qty-wrapper label {
            min-width: auto;
        }

        .add-to-cart-btn {
            padding: 14px 35px;
            font-size: 18px;
        }

        .page-header {
            padding: 40px 0;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 480px) {
        .product-image-col {
            min-height: 350px;
            padding: 20px;
        }

        .product-image {
            max-height: 300px;
        }

        .product-info-col {
            padding: 30px 20px;
        }

        .product-title {
            font-size: 24px;
        }

        .product-price {
            font-size: 28px;
        }

        .product-desc {
            font-size: 1rem;
            padding: 20px;
        }

        .qty-input {
            width: 80px;
            padding: 8px 12px;
            font-size: 16px;
        }

        .add-to-cart-btn {
            padding: 12px 25px;
            font-size: 16px;
        }
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>

    <section class="page-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('home/products'); ?>">Products</a></li>
                    <li class="breadcrumb-item active"><?= htmlspecialchars($product->name) ?></li>
                </ol>
            </nav>
            <h1><?= htmlspecialchars($product->name) ?></h1>
        </div>
    </section>

    <div class="container">
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="flash-message flash-success">
            <span>✅</span> <?= $this->session->flashdata('success') ?>
        </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
        <div class="flash-message flash-error">
            <span>❌</span> <?= $this->session->flashdata('error') ?>
        </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')): ?>
        <div class="flash-message flash-warning">
            <span>⚠️</span> <?= $this->session->flashdata('warning') ?>
        </div>
        <?php endif; ?>

        <div class="product-wrapper">
            <div class="row product-row">
                <div class="col-md-6 product-image-col">
                    <img src="<?= base_url('assets/images/products/' . $product->image) ?>"
                        alt="<?= htmlspecialchars($product->name) ?>" class="product-image"
                        onerror="this.src='<?= base_url('assets/images/placeholder-product.webp') ?>'">
                </div>

                <div class="col-md-6 product-info-col">
                    <h1 class="product-title"><?= htmlspecialchars($product->name) ?></h1>
                    <span class="product-price">₹<?= number_format($product->price, 2) ?></span>
                    <p class="product-desc"><?= nl2br(htmlspecialchars($product->description)) ?></p>

                    <?php if ($product->status !== 'active'): ?>
                    <div class="status-message status-unavailable">
                        ⚠️ This product is currently unavailable.
                    </div>
                    <?php elseif ($product->stock <= 0): ?>
                    <div class="status-message status-outofstock">
                        📦 Out of stock. Please check back soon!
                    </div>
                    <?php else: ?>
                    <div class="add-to-cart-section">
                        <!-- CRITICAL FIX: Added CSRF token field -->
                        <form action="<?= site_url('home/add') ?>" method="post">
                            <input type="hidden" name="id" value="<?= (int)$product->id ?>">
                            <!-- CSRF TOKEN - REQUIRED FOR CODEIGNITER -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">

                            <div class="qty-wrapper">
                                <label for="qty">Quantity:</label>
                                <input type="number" name="qty" id="qty" value="1" min="1"
                                    max="<?= (int)$product->stock ?>" class="qty-input" required>
                                <span class="stock-availability">(Available: <?= (int)$product->stock ?>)</span>
                            </div>

                            <button type="submit" class="add-to-cart-btn">
                                🛒 Add to Cart
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>