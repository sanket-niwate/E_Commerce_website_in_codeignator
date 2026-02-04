<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Add Product</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #eef2f7, #f8f9fa);
        min-height: 100vh;
    }

    .page-title {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        color: #fff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card {
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .preview-img {
        max-width: 180px;
        max-height: 180px;
        object-fit: contain;
        display: none;
        margin-top: 10px;
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        background: #fff;
    }

    table img {
        border-radius: 8px;
        background: #fff;
        padding: 3px;
    }

    .table thead {
        background: #212529;
        color: #fff;
    }

    .table tbody tr:hover {
        background: #f1f5ff;
    }

    .price-badge {
        background: #198754;
        color: #fff;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 14px;
    }

    .action-btns a {
        margin: 0 3px;
    }

    .pagination-wrapper {
        margin-top: 30px;
    }

    .pagination {
        gap: 6px;
    }

    .pagination li a,
    .pagination li span {
        padding: 8px 14px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        color: #333;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .pagination li a:hover {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .pagination li.active span {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .pagination li.disabled span {
        color: #aaa;
        background: #f8f9fa;
        border-color: #dee2e6;
    }
    </style>
</head>

<body>

    <div class="container py-5">

        <!-- PAGE HEADER -->
        <div class="page-title">
            <h2 class="mb-1"><i class="bi bi-box-seam"></i> Product Management</h2>
            <p class="mb-0">Add, view, edit & manage products</p>
        </div>

        <!-- ADD PRODUCT CARD -->
        <div class="card p-4 mb-5">
            <h4 class="mb-4 text-primary">
                <i class="bi bi-plus-circle"></i> Add New Product
            </h4>

            <!-- Flash messages -->
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('admin/insert_product') ?>" enctype="multipart/form-data">
                <!-- CSRF token -->
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <!-- Product Name -->
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Product Name</label>
                    <div class="col-md-9">
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>
                </div>

                <!-- Price -->
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Price (₹)</label>
                    <div class="col-md-9">
                        <input type="number" name="price" class="form-control" placeholder="Enter price" step="0.01"
                            required>
                    </div>
                </div>

                <!-- Stock -->
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Stock Quantity</label>
                    <div class="col-md-9">
                        <input type="number" name="stock" class="form-control" placeholder="Enter stock quantity"
                            value="0" required>
                    </div>
                </div>

                <!-- Status -->
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Status</label>
                    <div class="col-md-9">
                        <select name="status" class="form-control" required>
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-semibold">Description</label>
                    <div class="col-md-9">
                        <textarea name="description" class="form-control" rows="3"
                            placeholder="Short product description" required></textarea>
                    </div>
                </div>

                <!-- Product Image -->
                <div class="row mb-4">
                    <label class="col-md-3 col-form-label fw-semibold">Product Image</label>
                    <div class="col-md-9">
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(this)">
                        <img id="preview" class="preview-img mt-2" style="max-width:120px;">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="offset-md-3 col-md-9">
                        <button type="submit" class="btn btn-success w-100 py-2">
                            <i class="bi bi-check-circle"></i> Insert Product
                        </button>
                    </div>
                </div>
            </form>
        </div>



        <!-- PRODUCT LIST -->
        <div class="card p-4">
            <h4 class="mb-4 text-dark">
                <i class="bi bi-list-ul"></i> Product List
            </h4>

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price (₹)</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                        <?php foreach ($products as $p): ?>
                        <tr>
                            <!-- ID -->
                            <td><?= $p->id ?></td>

                            <!-- Image -->
                            <td>
                                <?php
                                    $img_path = 'assets/images/products/' . $p->image;
                                    if (!empty($p->image) && file_exists(FCPATH . $img_path)):
                                ?>
                                <img src="<?= base_url($img_path) ?>" width="60">
                                <?php else: ?>
                                <img src="<?= base_url('assets/images/default.png') ?>" width="60">
                                <?php endif; ?>
                            </td>

                            <!-- Name -->
                            <td class="fw-semibold"><?= $p->name ?></td>

                            <!-- Description -->
                            <td><?= $p->description ?></td>

                            <!-- Price -->
                            <td><?= number_format($p->price, 2) ?></td>

                            <!-- Stock -->
                            <td><?= $p->stock ?></td>

                            <!-- Status -->
                            <td>
                                <?php if(isset($p->status) && $p->status == 'active'): ?>
                                <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>

                            <!-- Created At -->
                            <td><?= date('d-m-Y H:i', strtotime($p->created_at)) ?></td>

                            <!-- Updated At -->
                            <td><?= date('d-m-Y H:i', strtotime($p->updated_at)) ?></td>

                            <!-- Actions -->
                            <td>
                                <a href="<?= site_url('products/edit/'.$p->id) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= site_url('products/delete/'.$p->id) ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this product?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="10">No products found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if(isset($links)): ?>
            <div class="pagination-wrapper d-flex justify-content-center mt-4">
                <?= $links ?>
            </div>
            <?php endif; ?>
        </div>


    </div>
    <!-- JS for Image Preview -->
    <script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>



</body>

</html>