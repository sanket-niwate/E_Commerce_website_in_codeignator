<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your Cart | The Tack Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your shopping cart at The Tack Shop - Premium equestrian gear">

    <!-- Bootstrap (FIXED: Removed spaces in URL) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
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
        --light-beige: #f8f9fa;
    }

    /* CRITICAL FIX: Remove all top spacing */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }



    body {
        background: var(--light-beige);
        font-family: 'Inter', sans-serif;
        color: var(--text-dark);
        padding-top: 20px;
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-red) 0%, #8a3336 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
        margin-bottom: 50px;
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
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Cart Card */
    .cart-card {
        background: var(--white);
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    /* Empty Cart */
    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        background: var(--white);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: var(--primary-red);
        margin-bottom: 20px;
    }

    .empty-cart h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .empty-cart p {
        color: var(--text-gray);
        margin-bottom: 25px;
    }

    /* Cart Table */
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .cart-table thead th {
        background: var(--primary-red);
        color: white;
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 20px;
        text-align: left;
    }

    .cart-table tbody td {
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    .cart-table tbody tr:hover {
        background-color: #f9f8f7;
    }

    .cart-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Product Info */
    .product-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        background: linear-gradient(135deg, #fcfaf7 0%, #f5f2ee 100%);
        padding: 10px;
        border-radius: 8px;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    /* Price & Total */
    .cart-price,
    .cart-total {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--primary-red);
    }

    /* Quantity Controls */
    .qty-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .qty-change {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-red-light);
        color: var(--primary-red);
        border: none;
        border-radius: 6px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        user-select: none;
        transition: all 0.3s ease;
    }

    .qty-change:hover {
        background: var(--primary-red);
        color: white;
        transform: scale(1.1);
    }

    .qty-input {
        width: 50px;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        padding: 6px 8px;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .qty-input:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(101, 37, 39, 0.1);
    }

    /* Remove Button */
    .btn-remove {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-remove:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Grand Total */
    .grand-total-row {
        background: linear-gradient(135deg, var(--primary-red-light) 0%, #f8f5f4 100%);
        border-top: 3px solid var(--primary-red);
    }

    .grand-total-row td {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.25rem;
        padding: 20px;
    }

    .grand-total-label {
        color: var(--text-dark);
    }

    .grand-total-amount {
        color: var(--primary-red);
        font-size: 1.5rem;
    }

    /* Checkout Section */
    .checkout-section {
        background: var(--white);
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .checkout-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .checkout-row:last-child {
        border-bottom: none;
        padding-top: 25px;
    }

    .checkout-label {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .checkout-amount {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--primary-red);
    }

    .btn-continue {
        background: transparent;
        color: var(--primary-red);
        border: 2px solid var(--primary-red);
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1.05rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .btn-continue:hover {
        background: var(--primary-red);
        color: white;
        transform: translateX(5px);
    }

    .btn-checkout {
        background: var(--primary-red);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px 40px;
        font-weight: 600;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(101, 37, 39, 0.2);
    }

    .btn-checkout:hover {
        background: var(--primary-red-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(101, 37, 39, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 40px 0;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .cart-card,
        .checkout-section {
            padding: 20px;
        }

        .cart-table thead th,
        .cart-table tbody td {
            padding: 12px 15px;
            font-size: 0.9rem;
        }

        .product-info {
            flex-direction: column;
            text-align: center;
        }

        .product-image {
            width: 70px;
            height: 70px;
        }

        .product-name {
            font-size: 1rem;
            margin-top: 10px;
        }

        .qty-form {
            flex-direction: column;
            gap: 8px;
        }

        .grand-total-row td {
            font-size: 1.1rem;
            padding: 15px;
        }

        .grand-total-amount {
            font-size: 1.3rem;
        }

        .btn-checkout {
            padding: 12px 30px;
            font-size: 1rem;
        }

        .btn-continue {
            padding: 10px 25px;
            font-size: 0.95rem;
        }
    }

    @media (max-width: 480px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .cart-table {
            display: block;
            overflow-x: auto;
        }

        .cart-table thead th,
        .cart-table tbody td {
            padding: 10px 12px;
            font-size: 0.85rem;
        }

        .product-image {
            width: 60px;
            height: 60px;
        }

        .qty-input {
            width: 45px;
            font-size: 14px;
        }

        .grand-total-row td {
            font-size: 1rem;
            padding: 12px;
        }

        .grand-total-amount {
            font-size: 1.2rem;
        }
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Your Shopping Cart</h1>
            <p>Review your items before proceeding to checkout</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <?php if (empty($cart)): ?>
        <!-- Empty Cart -->
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h3>Your Cart is Empty</h3>
            <p>Looks like you haven't added any items to your cart yet.</p>
            <a href="<?= site_url('home/products') ?>" class="btn btn-lg"
                style="background: #652527; color: white; padding: 12px 40px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Start Shopping
            </a>
        </div>
        <?php else: ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-card">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $grand = 0; ?>
                            <?php foreach ($cart as $item): ?>
                            <?php $total = $item['price'] * $item['qty']; ?>
                            <?php $grand += $total; ?>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="<?= base_url('assets/images/products/'.$item['image']) ?>"
                                            alt="<?= $item['name'] ?>" class="product-image">
                                        <div class="product-name"><?= $item['name'] ?></div>
                                    </div>
                                </td>
                                <td class="cart-price">₹<?= $item['price'] ?></td>
                                <td>
                                    <form action="<?= site_url('home/update') ?>" method="post" class="qty-form">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <!-- CRITICAL: ADD CSRF TOKEN -->
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                            value="<?= $this->security->get_csrf_hash(); ?>">
                                        <button type="button" class="qty-change"
                                            onclick="changeQty(this, -1)">-</button>
                                        <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1"
                                            class="qty-input" onchange="this.form.submit()">
                                        <button type="button" class="qty-change" onclick="changeQty(this, 1)">+</button>
                                    </form>
                                </td>
                                <td class="cart-total">₹<?= $total ?></td>
                                <td>
                                    <a href="<?= site_url('home/remove/'.$item['id']) ?>" class="btn-remove">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="grand-total-row">
                                <td colspan="3" class="grand-total-label">Grand Total</td>
                                <td colspan="2" class="grand-total-amount">₹<?= $grand ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Checkout Summary -->
            <div class="col-lg-4">
                <div class="checkout-section">
                    <h4 class="mb-4"
                        style="font-family: 'Playfair Display', serif; color: var(--primary-red); font-weight: 600; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                        Order Summary
                    </h4>

                    <div class="checkout-row">
                        <span class="checkout-label">Subtotal</span>
                        <span class="checkout-amount">₹<?= $grand ?></span>
                    </div>

                    <div class="checkout-row">
                        <span class="checkout-label">Shipping</span>
                        <span class="checkout-amount">Free</span>
                    </div>

                    <div class="checkout-row">
                        <span class="checkout-label" style="font-size: 1.3rem;">Total</span>
                        <span class="checkout-amount" style="font-size: 1.6rem;">₹<?= $grand ?></span>
                    </div>

                    <!-- FIXED: Changed to anchor tag with direct checkout link -->
                    <a href="<?= site_url('home/checkout') ?>" class="btn-checkout">
                        🛒 Proceed to Checkout
                    </a>

                    <a href="<?= site_url('home/products') ?>" class="btn-continue">
                        ← Continue Shopping
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php $this->load->view('layout/footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function changeQty(el, delta) {
        const input = el.parentElement.querySelector('input[name="qty"]');
        let value = parseInt(input.value) || 1;
        value += delta;
        if (value < 1) value = 1; // minimum 1
        input.value = value;

        // Automatically submit the form after changing
        input.form.submit();
    }
    </script>

    <!-- Add this INSIDE your <head> section in layout/navbar.php or main template -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-add CSRF token to ALL POST forms
        document.querySelectorAll('form[method="post"]').forEach(form => {
            if (!form.querySelector('input[name="<?= $this->security->get_csrf_token_name(); ?>"]')) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '<?= $this->security->get_csrf_token_name(); ?>';
                input.value = '<?= $this->security->get_csrf_hash(); ?>';
                form.appendChild(input);
            }
        });
    });
    </script>
</body>

</html>