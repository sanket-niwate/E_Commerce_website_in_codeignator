<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You | The Tack Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --primary-red: #652527;
        --light-beige: #f9f7f3;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--light-beige);
        font-family: 'Inter', sans-serif;
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    .thankyou-container {
        max-width: 600px;
        margin: 80px auto;
        background: white;
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(101, 37, 39, 0.15);
    }

    .checkmark {
        font-size: 6rem;
        color: #28a745;
        margin-bottom: 20px;
        animation: bounce 1s ease;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-20px);
        }

        60% {
            transform: translateY(-10px);
        }
    }

    h1 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-red);
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    p {
        color: #555;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .order-info {
        background: #f8f7f5;
        padding: 25px;
        border-radius: 12px;
        margin: 30px 0;
        text-align: left;
    }

    .order-info p {
        margin-bottom: 10px;
        font-weight: 500;
    }

    .btn-home {
        display: inline-block;
        padding: 14px 40px;
        background: var(--primary-red);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        margin-top: 10px;
    }

    .btn-home:hover {
        background: #803333;
        transform: translateY(-2px);
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>

    <div class="thankyou-container">
        <div class="checkmark">✅</div>
        <h1>Thank You for Your Order!</h1>
        <p>Your payment has been successfully processed. You will receive a confirmation email shortly with your order
            details.</p>

        <div class="order-info">
            <p><strong>Order Status:</strong> Processing</p>
            <p><strong>Payment Method:</strong> Razorpay</p>
            <p><strong>Next Steps:</strong> Our team will process your order and ship it soon!</p>
        </div>

        <a href="<?= site_url('home/products') ?>" class="btn-home">Continue Shopping</a>
    </div>

    <?php $this->load->view('layout/footer'); ?>
</body>

</html>