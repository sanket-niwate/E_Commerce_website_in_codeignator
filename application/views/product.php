<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Tack Shop | Products</title>
    <meta name="description" content="Premium equestrian gear and accessories for riders and horses">

    <!-- CRITICAL FIX: Removed spaces in CDN URLs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (fixed syntax) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Inter:wght@300;400;500&display=swap"
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
        --dark-gray: #2b2b2b;
        --light-beige: #f7f5f2;
        --border-color: #e8e5e1;
    }

    body {
        background-color: var(--light-beige);
        font-family: 'Inter', sans-serif;
        color: #2b2b2b;
        /* CRITICAL FIX: No top gap */
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    /* Product Grid Header */
    .products-header {
        background: linear-gradient(135deg, var(--primary-red) 0%, #8a3336 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .products-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><text x="10" y="50" font-size="20" fill="%23ffffff">🐴</text><text x="60" y="80" font-size="20" fill="%23ffffff">🏇</text></svg>');
        background-repeat: repeat;
    }

    .products-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 600;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .products-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Product Card Styles */
    .product-card {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.35s ease;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(101, 37, 39, 0.15);
        border-color: var(--primary-red);
    }

    .product-image-wrapper {
        position: relative;
        height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #fcfaf7 0%, #f5f2ee 100%);
        overflow: hidden;
    }

    .product-image-wrapper img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-image-wrapper img {
        transform: scale(1.05);
    }

    /* Out of Stock Badge */
    .stock-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #dc3545;
        color: white;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 15px;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .product-body {
        padding: 20px;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 1.15rem;
        color: var(--dark-gray);
        margin-bottom: 8px;
        min-height: 45px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .product-card:hover .product-name {
        color: var(--primary-red);
    }

    .product-price {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-red);
        margin: 10px 0;
        display: block;
    }

    .product-actions {
        margin-top: 15px;
    }

    .btn-view {
        background-color: var(--primary-red);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        letter-spacing: 0.5px;
    }

    .btn-view:hover {
        background-color: var(--primary-red-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(101, 37, 39, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Product Count & Filter Bar */
    .products-toolbar {
        background: white;
        padding: 20px 0;
        margin-bottom: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .product-count {
        font-weight: 500;
        color: var(--dark-gray);
    }

    /* Empty State */
    .empty-products {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 8px;
        margin: 30px 0;
    }

    .empty-products i {
        font-size: 4rem;
        color: var(--primary-red);
        margin-bottom: 20px;
    }

    .empty-products h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--dark-gray);
        margin-bottom: 15px;
    }

    .empty-products p {
        color: #777;
        max-width: 600px;
        margin: 0 auto 25px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .products-header h1 {
            font-size: 2.2rem;
        }

        .product-image-wrapper {
            height: 220px;
        }

        .product-name {
            font-size: 1.05rem;
            min-height: auto;
        }

        .product-price {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .products-header {
            padding: 40px 0;
        }

        .products-header h1 {
            font-size: 1.8rem;
        }

        .product-image-wrapper {
            height: 200px;
        }

        .btn-view {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>

    <!-- Products Header -->
    <section class="products-header">
        <div class="container">
            <h1>Shop Equestrian Essentials</h1>
            <p>Premium gear for dedicated riders and cherished horses. Curated collection for every equestrian journey.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Toolbar -->
        <div class="products-toolbar">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="product-count">
                        <strong>&nbsp;&nbsp;<?= count($products); ?></strong> products found
                    </span>
                </div>
                <!-- <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <small class="text-muted">Sort by: Featured</small>
                </div> -->
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row">
            <?php if (empty($products)): ?>
            <!-- Empty State -->
            <div class="col-12">
                <div class="empty-products">
                    <div>🏇</div>
                    <h3>No Products Found</h3>
                    <p>We're currently curating our collection. Check back soon for premium equestrian gear!</p>
                    <a href="<?= site_url(); ?>" class="btn btn-outline-dark">Return Home</a>
                </div>
            </div>
            <?php else: ?>
            <?php foreach ($products as $p): ?>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <!-- Image Wrapper -->
                    <div class="product-image-wrapper">
                        <?php if ($p->stock <= 0): ?>
                        <span class="stock-badge">OUT OF STOCK</span>
                        <?php endif; ?>

                        <img src="<?= base_url('assets/images/products/'.$p->image) ?>" alt="<?= $p->name ?>">
                    </div>

                    <!-- Product Info -->
                    <div class="product-body">
                        <h3 class="product-name">
                            <?= $p->name ?>
                        </h3>

                        <span class="product-price">
                            ₹<?= $p->price ?>
                        </span>

                        <div class="product-actions">
                            <?php if ($p->stock > 0): ?>
                            <a href="<?= site_url('home/shop/'.$p->id) ?>" class="btn-view">
                                View Product
                            </a>
                            <?php else: ?>
                            <span style="color:#dc3545; font-weight:500; font-size:0.95rem">
                                Out of Stock
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>