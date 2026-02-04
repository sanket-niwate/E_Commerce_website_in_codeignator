<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
    /* Global Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .checkout-container {
        max-width: 500px;
        margin: 50px auto;
        background: #fff;
        padding: 30px 35px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    form input,
    form textarea {
        width: 100%;
        padding: 12px 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    form textarea {
        resize: vertical;
        min-height: 80px;
    }

    p.total {
        text-align: right;
        font-size: 18px;
        font-weight: bold;
        color: #222;
        margin-bottom: 25px;
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #3399cc;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #287aa9;
    }

    @media (max-width: 600px) {
        .checkout-container {
            margin: 20px;
            padding: 20px;
        }
    }
    </style>
</head>

<body>
    <div class="checkout-container">
        <h2>Customer Details</h2>
        <form method="post" action="<?= base_url('home/checkout') ?>">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <textarea name="address" placeholder="Address" required></textarea>
            <p class="total">Total: ₹<?= number_format($amount, 2) ?></p>
            <button type="submit">Proceed to Pay</button>
        </form>
    </div>
</body>

</html>