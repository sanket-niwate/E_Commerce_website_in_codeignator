<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
        margin: 0;
        padding: 0;
    }

    .checkout-container {
        max-width: 550px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 15px;
        padding: 35px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .checkout-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #00695c;
        font-weight: 700;
    }

    ul {
        list-style-type: none;
        padding: 0;
        margin-bottom: 25px;
    }

    ul li {
        padding: 12px 0;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        font-weight: 500;
        color: #424242;
        transition: color 0.2s;
    }

    ul li:hover {
        color: #00796b;
    }

    p.total {
        font-weight: 700;
        font-size: 20px;
        text-align: right;
        margin-bottom: 30px;
        color: #1b5e20;
    }

    button#payBtn {
        width: 100%;
        padding: 15px;
        font-size: 18px;
        border: none;
        border-radius: 50px;
        background: linear-gradient(90deg, #00bfa5, #1de9b6);
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        transition: background 0.3s, transform 0.2s;
    }

    button#payBtn:hover {
        background: linear-gradient(90deg, #00bfa5, #00c853);
        transform: translateY(-2px);
    }

    /* Mobile Responsive */
    @media (max-width: 600px) {
        .checkout-container {
            margin: 30px 20px;
            padding: 25px;
        }

        button#payBtn {
            font-size: 16px;
        }
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>
    <div class="checkout-container">
        <h2>Order Summary</h2>
        <ul>
            <?php foreach ($cart as $item): ?>
            <li>
                <span><?= htmlspecialchars($item['name']) ?> x <?= $item['qty'] ?></span>
                <span>₹<?= number_format($item['price'] * $item['qty'], 2) ?></span>
            </li>
            <?php endforeach; ?>
        </ul>

        <p class="total">Total: ₹<?= number_format($amount, 2) ?></p>
        <button id="payBtn">Pay Now</button>
    </div>
    <?php $this->load->view('layout/footer'); ?>
    <script>
    document.getElementById('payBtn').onclick = function(e) {
        e.preventDefault();

        var options = {
            key: "<?= $key ?>",
            amount: <?= $amount * 100 ?>, // in paise
            currency: "INR",
            name: "My Store",
            description: "Order Payment",
            order_id: "<?= $rzp_order ?>",
            handler: function(response) {
                fetch("<?= base_url('home/payment_success') ?>", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(response)
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert("Payment Successful!");
                            window.location.href = "<?= base_url('home/thank_you') ?>";
                        } else {
                            alert("Payment Failed: " + data.error);
                        }
                    });
            },
            theme: {
                color: "#00bfa5"
            },
            modal: {
                ondismiss: function() {
                    alert("Payment Cancelled");
                }
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    };
    </script>

</body>

</html>