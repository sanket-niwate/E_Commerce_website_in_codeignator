<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Placed | The Tack Shop</title>
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
    }

    .thankyou-container {
        max-width: 650px;
        margin: 80px auto;
        background: white;
        border-radius: 24px;
        padding: 60px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(101, 37, 39, 0.15);
    }

    .checkmark {
        font-size: 6rem;
        color: #ffc107;
        margin-bottom: 25px;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-red);
        font-size: 2.4rem;
        margin: 20px 0 15px;
    }

    p {
        color: #555;
        font-size: 1.15rem;
        line-height: 1.7;
        margin-bottom: 25px;
    }

    .order-badge {
        display: inline-block;
        background: var(--primary-red);
        color: white;
        padding: 6px 25px;
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: 1px;
        margin: 15px 0;
        font-size: 1.1rem;
    }

    .instructions {
        background: #f8f7f5;
        border-left: 4px solid var(--primary-red);
        padding: 25px;
        border-radius: 12px;
        text-align: left;
        margin: 30px 0;
    }

    .instructions h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-red);
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .instructions ol {
        padding-left: 20px;
        margin-top: 10px;
    }

    .instructions li {
        margin-bottom: 8px;
        line-height: 1.6;
    }

    .btn-home {
        display: inline-block;
        background: var(--primary-red);
        color: white;
        text-decoration: none;
        padding: 14px 45px;
        border-radius: 10px;
        font-weight: 600;
        margin-top: 10px;
        transition: all 0.3s;
    }

    .btn-home:hover {
        background: #803333;
        transform: translateY(-2px);
    }

    @media (max-width:600px) {
        .thankyou-container {
            margin: 20px;
            padding: 40px 25px;
        }

        h1 {
            font-size: 2rem;
        }

        .checkmark {
            font-size: 5rem;
        }
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>

    <div class="thankyou-container">
        <div class="checkmark">💰</div>
        <h1>Order Confirmed!</h1>
        <p>Your Cash on Delivery order has been successfully placed. You'll pay when your order arrives.</p>

        <div class="order-badge">ORDER #<?= $order_id ?></div>

        <div class="instructions">
            <h3>Next Steps:</h3>
            <ol>
                <li><strong>Order Confirmation:</strong> You'll receive an email/SMS with order details shortly</li>
                <li><strong>Processing:</strong> Our team will prepare your order within 24 hours</li>
                <li><strong>Delivery:</strong> Our delivery partner will contact you to schedule delivery</li>
                <li><strong>Payment:</strong> Pay cash directly to the delivery person upon receiving your order</li>
            </ol>
        </div>

        <p style="font-weight:500; color:#e05a2e; margin-top:20px;">
            📞 Questions? Call us at +65 XXXX XXXX (Mon-Fri, 9AM-6PM)
        </p>

        <a href="<?= site_url('home/products') ?>" class="btn-home">Continue Shopping</a>
    </div>

    <?php $this->load->view('layout/footer'); ?>
</body>

</html>