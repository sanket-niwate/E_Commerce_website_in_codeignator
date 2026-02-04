<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Orders</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #eef2f7, #f8f9fa);
        min-height: 100vh;
    }

    /* Page title */
    .page-title {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        color: #fff;
        padding: 22px;
        border-radius: 14px;
        text-align: center;
        margin-bottom: 35px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Card */
    .order-card {
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    /* Table */
    .table thead {
        background: #212529;
        color: #fff;
    }

    .table tbody tr:hover {
        background: #f1f5ff;
    }

    .order-meta small {
        font-size: 13px;
    }

    .price {
        font-weight: 600;
    }

    .badge-status {
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 20px;
    }
    </style>
</head>

<body>

    <div class="container py-5">

        <!-- Page Header -->
        <div class="page-title">
            <h2 class="mb-1"><i class="bi bi-bag-check-fill"></i> Orders Management</h2>
            <p class="mb-0">View all customer orders & items</p>
        </div>

        <!-- Orders Loop -->
        <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
        <div class="card order-card mb-4">

            <!-- Order Header -->
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div class="order-meta">
                    <h6 class="mb-1 fw-bold">
                        Order #<?= $order['id'] ?>
                    </h6>
                    <small class="text-muted">
                        <?= $order['name'] ?> • ₹<?= number_format($order['total'], 2) ?>
                    </small>
                </div>

                <span class="badge badge-status 
                        <?= $order['payment_status'] === 'success' ? 'bg-success' : 'bg-warning text-dark' ?>">
                    <?= ucfirst($order['payment_status']) ?>
                </span>
            </div>

            <!-- Order Items -->
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th width="120">Price</th>
                            <th width="80">Qty</th>
                            <th width="140">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                        <tr>
                            <td class="text-start"><?= $item['product_name'] ?></td>
                            <td>₹<?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td class="price">
                                ₹<?= number_format($item['price'] * $item['qty'], 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle"></i> No orders found.
        </div>
        <?php endif; ?>

    </div>

</body>

</html>