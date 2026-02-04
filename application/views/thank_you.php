<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thank You | MyStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thank-card {
        background: #fff;
        border-radius: 12px;
        padding: 40px;
        max-width: 450px;
        width: 100%;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .thank-icon {
        font-size: 60px;
        color: #28a745;
    }
    </style>
</head>

<body>

    <div class="thank-card">
        <div class="thank-icon mb-3">✔</div>
        <h2 class="mb-2">Thank You!</h2>
        <p class="text-muted mb-4">
            Your payment was successful and your order has been placed.
        </p>

        <a href="<?= base_url('home/products') ?>" class="btn btn-success px-4">
            Back to Shop
        </a>
    </div>

</body>

</html>