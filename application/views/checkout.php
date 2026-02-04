<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | The Tack Shop</title>
    <meta name="description" content="Secure checkout with Razorpay - The Tack Shop">

    <!-- FIXED: Removed ALL spaces in CDN URLs -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    :root {
        --primary-red: #652527;
        --primary-red-hover: #7a2d30;
        --primary-red-light: #f8f3f2;
        --dark-charcoal: #1a1a1a;
        --soft-gray: #7a7a7a;
        --light-beige: #f9f7f5;
        --border-subtle: #e9e5e0;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 40px rgba(101, 37, 39, 0.12);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #fcfaf7 0%, var(--light-beige) 100%);
        font-family: 'Inter', sans-serif;
        color: var(--dark-charcoal);
        line-height: 1.5;
        padding-top: 0 !important;
        margin-top: 0 !important;
        overflow-x: hidden;
    }

    .checkout-container {
        max-width: 680px;
        margin: 40px auto;
        background: white;
        border-radius: 24px;
        padding: 48px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .checkout-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, var(--primary-red), #8a3336, var(--primary-red));
    }

    .checkout-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border-subtle);
    }

    .checkout-header h1 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-red);
        font-size: 2.5rem;
        font-weight: 600;
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }

    .checkout-header p {
        color: var(--soft-gray);
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
        font-weight: 300;
    }

    /* PAYMENT METHOD SECTION - ELEVATED */
    .payment-method-section {
        background: linear-gradient(135deg, #fff9f8 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 35px;
        border: 1px solid var(--border-subtle);
        position: relative;
        overflow: hidden;
    }

    .payment-method-section::before {
        content: 'SECURE CHECKOUT';
        position: absolute;
        top: -12px;
        right: -35px;
        background: var(--primary-red);
        color: white;
        font-size: 0.82rem;
        font-weight: 700;
        padding: 4px 28px;
        transform: rotate(45deg);
        letter-spacing: 1.5px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.65rem;
        color: var(--primary-red);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
        padding-bottom: 12px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary-red);
        border-radius: 1px;
    }

    .payment-method-desc {
        color: var(--soft-gray);
        line-height: 1.7;
        margin-bottom: 22px;
        font-size: 0.98rem;
    }

    /* PAYMENT OPTIONS - LUXURY CARDS */
    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin: 24px 0;
    }

    .payment-option {
        display: block;
        padding: 20px;
        background: white;
        border: 2px solid var(--border-subtle);
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }

    .payment-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: transparent;
        transition: background 0.3s;
    }

    .payment-option:hover {
        border-color: var(--primary-red-light);
        transform: translateX(3px);
        box-shadow: var(--shadow-sm);
    }

    .payment-option.active {
        border-color: var(--primary-red);
        background: rgba(101, 37, 39, 0.02);
        box-shadow: 0 4px 15px rgba(101, 37, 39, 0.08);
    }

    .payment-option.active::before {
        background: var(--primary-red);
    }

    .payment-option input[type="radio"] {
        display: none;
    }

    .payment-option-content {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .payment-logo {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-red-light);
        border-radius: 16px;
        font-size: 2rem;
        flex-shrink: 0;
        border: 1px solid var(--border-subtle);
        transition: all 0.3s;
    }

    .payment-option.active .payment-logo {
        background: white;
        border-color: var(--primary-red);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(101, 37, 39, 0.15);
    }

    .payment-logo img {
        height: 36px;
        width: auto;
        object-fit: contain;
        opacity: 0.9;
        transition: opacity 0.3s;
    }

    .payment-option.active .payment-logo img {
        opacity: 1;
    }

    .payment-details {
        flex: 1;
    }

    .payment-title {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 1.15rem;
        color: var(--dark-charcoal);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .payment-option.active .payment-title {
        color: var(--primary-red);
    }

    .payment-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        color: var(--soft-gray);
        line-height: 1.5;
    }

    .payment-badge {
        background: var(--primary-red);
        color: white;
        padding: 4px 14px;
        border-radius: 24px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        font-family: 'Inter', sans-serif;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .payment-option[data-method="cod"] .payment-badge {
        background: #28a745;
    }

    .payment-notes {
        background: #fcfbf9;
        border-left: 3px solid var(--primary-red);
        padding: 18px;
        border-radius: 0 12px 12px 0;
        margin-top: 20px;
        font-size: 0.88rem;
        line-height: 1.6;
        color: var(--soft-gray);
    }

    .payment-notes strong {
        color: var(--dark-charcoal);
        font-weight: 500;
    }

    /* ORDER SUMMARY */
    .order-summary {
        margin-bottom: 32px;
        background: #fcfbf9;
        border-radius: 16px;
        padding: 24px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px dashed var(--border-subtle);
        font-weight: 500;
        font-size: 1.05rem;
        color: var(--dark-charcoal);
    }

    .order-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .order-item-name {
        max-width: 70%;
        word-wrap: break-word;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--primary-red);
        margin: 28px 0 36px;
        padding-top: 22px;
        border-top: 2px solid var(--primary-red);
        font-family: 'Playfair Display', serif;
    }

    /* PAYMENT BUTTONS */
    .payment-buttons {
        margin: 35px 0 25px;
    }

    .btn-checkout {
        width: 100%;
        padding: 18px 24px;
        font-size: 1.25rem;
        font-weight: 600;
        background: linear-gradient(to right, var(--primary-red), #7a2d30);
        color: white;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: var(--shadow-md);
        letter-spacing: 0.5px;
        font-family: 'Inter', sans-serif;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-checkout::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        opacity: 0;
        transition: opacity 0.4s;
        z-index: 1;
    }

    .btn-checkout:hover::after {
        opacity: 1;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(101, 37, 39, 0.22);
        background: linear-gradient(to right, var(--primary-red-hover), #853336);
    }

    .btn-checkout:active {
        transform: translateY(0);
        box-shadow: var(--shadow-md);
    }

    .btn-checkout:disabled {
        opacity: 0.85;
        cursor: wait;
        transform: none !important;
    }

    .btn-cod {
        background: linear-gradient(to right, #28a745, #20c997) !important;
    }

    .btn-cod:hover {
        background: linear-gradient(to right, #218838, #1e9d82) !important;
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.25) !important;
    }

    /* CONTINUE SHOPPING */
    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: var(--primary-red);
        text-decoration: none;
        font-weight: 500;
        font-size: 1.02rem;
        transition: all 0.25s ease;
        padding: 10px;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
    }

    .continue-shopping:hover {
        background: rgba(101, 37, 39, 0.04);
        transform: translateX(-3px);
        color: var(--primary-red-hover);
    }

    .continue-shopping i {
        margin-right: 6px;
        font-size: 1.1rem;
        vertical-align: middle;
    }

    /* SECURITY BADGES */
    .security-badges {
        display: flex;
        justify-content: center;
        gap: 28px;
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid var(--border-subtle);
    }

    .security-badge {
        text-align: center;
        font-size: 0.92rem;
        color: var(--soft-gray);
        font-family: 'Inter', sans-serif;
    }

    .security-badge i {
        font-size: 2.1rem;
        margin-bottom: 8px;
        display: block;
    }

    .security-badge:nth-child(1) i {
        color: #1e88e5;
    }

    .security-badge:nth-child(2) i {
        color: #43a047;
    }

    .security-badge:nth-child(3) i {
        color: #8e24aa;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 768px) {
        .checkout-container {
            margin: 20px;
            padding: 32px 24px;
            border-radius: 20px;
        }

        .checkout-header h1 {
            font-size: 2.1rem;
        }

        .payment-option-content {
            flex-direction: column;
            text-align: center;
            gap: 16px;
        }

        .payment-logo {
            width: 55px;
            height: 55px;
        }

        .order-total {
            font-size: 1.65rem;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .btn-checkout {
            padding: 16px 20px;
            font-size: 1.15rem;
        }

        .security-badges {
            flex-direction: column;
            gap: 18px;
        }

        .payment-notes {
            border-radius: 12px;
            border-left-width: 2px;
        }
    }

    @media (max-width: 480px) {
        .checkout-container {
            padding: 28px 20px;
        }

        .checkout-header h1 {
            font-size: 1.9rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .payment-logo {
            width: 50px;
            height: 50px;
        }

        .payment-title {
            font-size: 1.05rem;
        }

        .payment-desc {
            font-size: 0.88rem;
        }

        .order-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .order-item-name {
            max-width: 100%;
        }

        .order-total {
            font-size: 1.55rem;
        }

        .btn-checkout {
            padding: 15px 18px;
            font-size: 1.1rem;
            flex-wrap: wrap;
        }

        .security-badge i {
            font-size: 1.9rem;
        }
    }
    </style>
</head>

<body>
    <?php $this->load->view('layout/navbar'); ?>

    <div class="checkout-container">
        <div class="checkout-header">
            <h1>Secure Checkout</h1>
            <p>Your journey to premium equestrian essentials begins here</p>
        </div>

        <!-- PAYMENT METHOD SELECTION -->
        <div class="payment-method-section">
            <h2 class="section-title"><i class="bi bi-credit-card"></i> Payment Method</h2>
            <p class="payment-method-desc">Select your preferred payment method. All transactions are secured with
                bank-grade encryption.</p>

            <div class="payment-options">
                <!-- RAZORPAY OPTION -->
                <label class="payment-option active" data-method="razorpay">
                    <input type="radio" name="payment_method" value="Razorpay" checked>
                    <div class="payment-option-content">
                        <div class="payment-logo">
                            <!-- <img src="https://cdn.razorpay.com/static/assets/logo/rzp_logo.svg" alt="Razorpay"> -->
                            <?xml version="1.0" encoding="utf-8"?><svg version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                y="0px" viewBox="0 0 122.88 26.53" style="enable-background:new 0 0 122.88 26.53"
                                xml:space="preserve">
                                <style type="text/css">
                                <![CDATA[
                                .st0 {
                                    fill: #3395FF;
                                }

                                .st1 {
                                    fill: #072654;
                                }
                                ]]>
                                </style>
                                <g>
                                    <polygon class="st1" points="11.19,9.03 7.94,21.47 0,21.47 1.61,15.35 11.19,9.03" />
                                    <path class="st1"
                                        d="M28.09,5.08C29.95,5.09,31.26,5.5,32,6.33s0.92,2.01,0.51,3.56c-0.27,1.06-0.82,2.03-1.59,2.8 c-0.8,0.8-1.78,1.38-2.87,1.68c0.83,0.19,1.34,0.78,1.5,1.79l0.03,0.22l0.6,5.09h-3.7l-0.62-5.48c-0.01-0.18-0.06-0.36-0.15-0.52 c-0.09-0.16-0.22-0.29-0.37-0.39c-0.31-0.16-0.65-0.24-1-0.25h-0.21h-2.28l-1.74,6.63h-3.46l4.3-16.38H28.09L28.09,5.08z M122.88,9.37l-4.4,6.34l-5.19,7.52l-0.04,0.04l-1.16,1.68l-0.04,0.06L112,25.09l-1,1.44h-3.44l4.02-5.67l-1.82-11.09h3.57 l0.9,7.23l4.36-6.19l0.06-0.09l0.07-0.1l0.07-0.09l0.54-1.15H122.88L122.88,9.37z M92.4,10.25c0.66,0.56,1.09,1.33,1.24,2.19 c0.18,1.07,0.1,2.18-0.21,3.22c-0.29,1.15-0.78,2.23-1.46,3.19c-0.62,0.88-1.42,1.61-2.35,2.13c-0.88,0.48-1.85,0.73-2.85,0.73 c-0.71,0.03-1.41-0.15-2.02-0.51c-0.47-0.28-0.83-0.71-1.03-1.22l-0.06-0.2l-1.77,6.75h-3.43l3.51-13.4l0.02-0.06l0.01-0.06 l0.86-3.25h3.35l-0.57,1.88l-0.01,0.08c0.49-0.7,1.15-1.27,1.91-1.64c0.76-0.4,1.6-0.6,2.45-0.6C90.84,9.43,91.7,9.71,92.4,10.25 L92.4,10.25z M88.26,12.11c-0.4-0.01-0.8,0.07-1.18,0.22c-0.37,0.15-0.71,0.38-1,0.66c-0.68,0.7-1.15,1.59-1.36,2.54 c-0.3,1.11-0.28,1.95,0.02,2.53c0.3,0.58,0.87,0.88,1.72,0.88c0.81,0.02,1.59-0.29,2.18-0.86c0.66-0.69,1.12-1.55,1.33-2.49 c0.29-1.09,0.27-1.96-0.03-2.57S89.08,12.11,88.26,12.11L88.26,12.11z M103.66,9.99c0.46,0.29,0.82,0.72,1.02,1.23l0.07,0.19 l0.44-1.66h3.36l-3.08,11.7h-3.37l0.45-1.73c-0.51,0.61-1.15,1.09-1.87,1.42c-0.7,0.32-1.45,0.49-2.21,0.49 c-0.88,0.04-1.76-0.21-2.48-0.74c-0.66-0.52-1.1-1.28-1.24-2.11c-0.18-1.06-0.12-2.14,0.19-3.17c0.3-1.15,0.8-2.24,1.49-3.21 c0.63-0.89,1.44-1.64,2.38-2.18c0.86-0.5,1.84-0.77,2.83-0.77C102.36,9.43,103.06,9.61,103.66,9.99L103.66,9.99z M101.92,12.14 c-0.41,0-0.82,0.08-1.19,0.24c-0.38,0.16-0.72,0.39-1.01,0.68c-0.67,0.71-1.15,1.59-1.36,2.55c-0.28,1.08-0.28,1.9,0.04,2.49 c0.31,0.59,0.89,0.87,1.75,0.87c0.4,0.01,0.8-0.07,1.18-0.22s0.71-0.38,1-0.66c0.59-0.63,1.02-1.38,1.26-2.22l0.08-0.31 c0.3-1.11,0.29-1.96-0.03-2.53C103.33,12.44,102.76,12.14,101.92,12.14L101.92,12.14z M81.13,9.63l0.22,0.09l-0.86,3.19 c-0.49-0.26-1.03-0.39-1.57-0.39c-0.82-0.03-1.62,0.24-2.27,0.75c-0.56,0.48-0.97,1.12-1.18,1.82l-0.07,0.27l-1.6,6.11h-3.42 l3.1-11.7h3.37l-0.44,1.72c0.42-0.58,0.96-1.05,1.57-1.4c0.68-0.39,1.44-0.59,2.22-0.59C80.51,9.48,80.83,9.52,81.13,9.63 L81.13,9.63z M68.5,10.19c0.76,0.48,1.31,1.24,1.52,2.12c0.25,1.06,0.21,2.18-0.11,3.22c-0.3,1.18-0.83,2.28-1.58,3.22 c-0.71,0.91-1.61,1.63-2.64,2.12c-1.05,0.49-2.19,0.74-3.35,0.73c-1.22,0-2.22-0.24-3-0.73c-0.77-0.48-1.32-1.24-1.54-2.12 c-0.24-1.06-0.2-2.18,0.11-3.22c0.3-1.17,0.83-2.27,1.58-3.22c0.71-0.9,1.62-1.63,2.66-2.12c1.06-0.49,2.22-0.75,3.39-0.73 C66.57,9.41,67.6,9.67,68.5,10.19L68.5,10.19z M64.84,12.1c-0.81-0.01-1.59,0.3-2.18,0.86c-0.61,0.58-1.07,1.43-1.36,2.57 c-0.6,2.29-0.02,3.43,1.74,3.43c0.8,0.02,1.57-0.29,2.15-0.85c0.6-0.57,1.04-1.43,1.34-2.58c0.3-1.13,0.31-1.98,0.01-2.57 C66.25,12.37,65.68,12.1,64.84,12.1L64.84,12.1z M57.89,9.76l-0.6,2.32l-7.55,6.67h6.06l-0.72,2.73H45.05l0.63-2.41l7.43-6.57 h-5.65l0.72-2.73H57.89L57.89,9.76z M40.96,9.99c0.46,0.29,0.82,0.72,1.02,1.23l0.07,0.19l0.44-1.66h3.37l-3.07,11.7h-3.37 l0.45-1.73c-0.51,0.6-1.14,1.08-1.85,1.41s-1.48,0.5-2.27,0.5c-0.88,0.04-1.74-0.22-2.45-0.74c-0.66-0.52-1.1-1.28-1.24-2.11 c-0.18-1.06-0.12-2.14,0.19-3.17c0.29-1.15,0.8-2.24,1.49-3.21c0.63-0.89,1.44-1.64,2.37-2.18c0.86-0.5,1.84-0.76,2.83-0.76 C39.66,9.44,40.36,9.62,40.96,9.99L40.96,9.99z M39.23,12.14c-0.41,0-0.81,0.08-1.19,0.24c-0.38,0.16-0.72,0.39-1.01,0.68 c-0.68,0.71-1.15,1.59-1.36,2.55c-0.28,1.08-0.27,1.9,0.04,2.49c0.31,0.59,0.89,0.87,1.75,0.87c0.4,0.01,0.8-0.07,1.18-0.22 c0.37-0.15,0.72-0.38,1-0.66c0.59-0.62,1.03-1.38,1.26-2.22l0.08-0.31c0.29-1.11,0.26-1.94-0.03-2.53 C40.64,12.44,40.06,12.14,39.23,12.14L39.23,12.14z M26.85,7.81h-3.21l-1.13,4.28h3.21c1.01,0,1.81-0.17,2.35-0.52 c0.57-0.37,0.98-0.95,1.13-1.63c0.2-0.72,0.11-1.27-0.27-1.62C28.55,7.99,27.86,7.81,26.85,7.81L26.85,7.81z" />
                                    <polygon class="st0"
                                        points="18.4,0 12.76,21.47 8.89,21.47 12.7,6.93 6.86,10.78 7.9,6.95 18.4,0" />
                                </g>
                            </svg>
                        </div>
                        <div class="payment-details">
                            <div class="payment-title"><i class="bi bi-shield-check"></i> Card • UPI • NetBanking</div>
                            <div class="payment-desc">Instant payment • Secured by Razorpay • 128-bit SSL encryption
                            </div>
                        </div>
                        <div class="payment-badge">RECOMMENDED</div>
                    </div>
                </label>

                <!-- COD OPTION -->
                <label class="payment-option" data-method="cod">
                    <input type="radio" name="payment_method" value="COD">
                    <div class="payment-option-content">
                        <div class="payment-logo">💵</div>
                        <div class="payment-details">
                            <div class="payment-title"><i class="bi bi-cash-coin"></i> Cash on Delivery</div>
                            <div class="payment-desc">Pay cash upon delivery • No advance payment • Order confirmed
                                immediately</div>
                        </div>
                        <div class="payment-badge">FREE</div>
                    </div>
                </label>
            </div>

            <div class="payment-notes">
                <strong>Important:</strong> COD available for Singapore addresses only. Razorpay offers instant order
                confirmation. All payments are protected by our 100% security guarantee.
            </div>
        </div>

        <!-- ORDER SUMMARY -->
        <div class="order-summary">
            <h2 class="section-title"><i class="bi bi-bag"></i> Order Summary</h2>
            <?php foreach ($cart as $item): ?>
            <div class="order-item">
                <span class="order-item-name"><?= htmlspecialchars($item['name']) ?> <small>×
                        <?= $item['qty'] ?></small></span>
                <span>₹<?= number_format($item['price'] * $item['qty'], 2) ?></span>
            </div>
            <?php endforeach; ?>

            <div class="order-total">
                <span>ORDER TOTAL</span>
                <span>₹<?= number_format($amount, 2) ?></span>
            </div>
        </div>

        <!-- PAYMENT BUTTONS -->
        <div class="payment-buttons">
            <div id="razorpay-section">
                <button id="payBtn" class="btn-checkout">
                    <i class="bi bi-lock-fill"></i> PAY SECURELY NOW (₹<?= number_format($amount, 2) ?>)
                </button>
            </div>

            <div id="cod-section" style="display:none;">
                <form id="codForm" action="<?= site_url('home/place_cod_order') ?>" method="POST">
                    <input type="hidden" name="total_amount" value="<?= $amount ?>">
                    <button type="submit" class="btn-checkout btn-cod">
                        <i class="bi bi-truck"></i> PLACE ORDER (CASH ON DELIVERY)
                    </button>
                </form>
            </div>
        </div>

        <a href="<?= site_url('home/products') ?>" class="continue-shopping">
            <i class="bi bi-arrow-left"></i> Continue Shopping
        </a>

        <!-- SECURITY BADGES -->
        <div class="security-badges">
            <div class="security-badge">
                <i class="bi bi-shield-lock"></i>
                <div>SSL Encrypted</div>
                <div>256-bit Security</div>
            </div>
            <div class="security-badge">
                <i class="bi bi-patch-check"></i>
                <div>PCI DSS</div>
                <div>Compliant</div>
            </div>
            <div class="security-badge">
                <i class="bi bi-shield-shaded"></i>
                <div>Fraud</div>
                <div>Protection</div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>

    <script>
    document.getElementById('payBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Processing...';
        btn.disabled = true;
        btn.style.opacity = '0.85';

        let statusUpdateAttempted = false;
        const resetButton = () => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            btn.style.opacity = '1';
        };

        const updateOrderStatus = (status, errorDetail = null) => {
            if (statusUpdateAttempted) return Promise.resolve();
            statusUpdateAttempted = true;
            return fetch("<?= site_url('home/payment_status_update') ?>", {
                method: "POST",
                credentials: 'same-origin',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?= $this->security->get_csrf_hash() ?>"
                },
                body: JSON.stringify({
                    status,
                    error: errorDetail,
                    order_id: "<?= $rzp_order ?>"
                })
            }).then(response => {
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                return response.json();
            });
        };

        const options = {
            key: "<?= $key ?>",
            amount: <?= round($amount * 100) ?>,
            currency: "INR",
            name: "The Tack Shop",
            description: "Order #<?= $rzp_order ?>",
            order_id: "<?= $rzp_order ?>",
            image: "<?= base_url('assets/images/navbar/logo-2-dark.webp') ?>",
            handler: function(response) {
                fetch("<?= site_url('home/payment_success') ?>", {
                    method: "POST",
                    credentials: 'same-origin',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "<?= $this->security->get_csrf_hash() ?>"
                    },
                    body: JSON.stringify({
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_signature: response.razorpay_signature,
                        amount: <?= round($amount * 100) ?>
                    })
                }).then(response => {
                    if (!response.ok) throw new Error(`HTTP ${response.status}`);
                    return response.json();
                }).then(data => {
                    if (data.status === 'success') window.location.href =
                        "<?= site_url('home/thank_you') ?>";
                    else throw new Error(data.message || 'Verification failed');
                }).catch(err => {
                    console.error('Payment verification failed:', err);
                    alert(
                        'Payment verification failed. Please contact support with order ID: <?= $rzp_order ?>'
                    );
                    resetButton();
                });
            },
            prefill: {
                name: "<?= $this->session->userdata('name') ?>",
                email: "<?= $this->session->userdata('email') ?>"
            },
            theme: {
                color: "#652527"
            },
            modal: {
                ondismiss: function() {
                    updateOrderStatus('canceled')
                        .then(() => alert(
                            "Payment cancelled. Order status updated.\n\nComplete payment later from your account."
                        ))
                        .catch(err => {
                            console.error('Status update failed:', err);
                            fetch("<?= site_url('home/clear_payment_session') ?>", {
                                method: "POST",
                                credentials: 'same-origin',
                                headers: {
                                    "X-CSRF-TOKEN": "<?= $this->security->get_csrf_hash() ?>"
                                }
                            });
                            alert(
                                "Payment cancelled. Contact support if order status isn't updated (ID: <?= $rzp_order ?>)."
                            );
                        })
                        .finally(() => resetButton());
                }
            }
        };

        const rzp = new Razorpay(options);
        rzp.on('payment.failed', function(response) {
            const errorMsg = response.error.description || 'Unknown error';
            updateOrderStatus('failed', errorMsg)
                .then(() => alert(
                    `Payment failed: ${errorMsg}\n\nOrder status updated. Please retry or contact support.`
                ))
                .catch(err => {
                    console.error('Status update failed:', err);
                    alert(
                        `Payment failed: ${errorMsg}\n\nStatus update failed (Order ID: <?= $rzp_order ?>). Contact support.`
                    );
                })
                .finally(() => resetButton());
        });
        rzp.on('close', () => {
            if (!statusUpdateAttempted) updateOrderStatus('canceled').finally(() => resetButton());
        });
        rzp.open();
    });

    // PAYMENT METHOD TOGGLE
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
            this.classList.add('active');
            const method = this.dataset.method;
            document.getElementById('razorpay-section').style.display = method === 'razorpay' ?
                'block' : 'none';
            document.getElementById('cod-section').style.display = method === 'cod' ? 'block' : 'none';
        });
    });

    // COD FORM HANDLER
    document.getElementById('codForm')?.addEventListener('submit', function(e) {
        const btn = this.querySelector('button');
        if (!confirm('Confirm COD order? You\'ll pay cash when your order arrives.')) {
            e.preventDefault();
            return;
        }
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Placing Order...';
        btn.disabled = true;
    });
    </script>
</body>

</html>