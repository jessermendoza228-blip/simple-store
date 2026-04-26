<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>JMSTORE</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #e5e7eb;
        }

        /* =========================
           NAVBAR
        ========================== */

        .nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* LOGO */
        .logo {
            font-size: 20px;
            font-weight: 800;
            color: white;
            white-space: nowrap;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            letter-spacing: 1px;
        }

        /* =========================
           SEARCH BAR FIX
        ========================== */

        .search {
            flex: 1;
            display: flex;
        }

        .search input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 10px 0 0 10px;
            outline: none;

            /* 🔥 FIX TEXT VISIBILITY */
            color: #111 !important;
            font-weight: 500;
            font-size: 14px;
        }

        .search input::placeholder {
            color: #6b7280;
        }

        .search button {
            padding: 10px 14px;
            border: none;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            font-weight: bold;
        }

        /* NAV LINKS */
        .nav-links {
            display: flex;
            gap: 10px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
            white-space: nowrap;
        }

        .nav-links a:hover {
            transform: translateY(-2px);
            background: rgba(255,255,255,0.08);
        }

        /* =========================
           MAIN CONTENT
        ========================== */

        main {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
            animation: fadeUp 0.5s ease;
        }

        @keyframes fadeUp {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        /* =========================
           GLOBAL TEXT FIX (IMPORTANT)
        ========================== */

        /* FORCE ALL PRODUCT / PAGE TEXT TO BE READABLE */
        h1, h2, h3, p, span, strong, div {
            color: #111827;
        }

        /* Keep navbar white readable */
        .nav, .nav * {
            color: white;
        }

        /* Card override safety */
        .card, .cart-item, .order {
            color: #111 !important;
        }

        /* =========================
           TOAST
        ========================== */

        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>

<body>

<!-- ===== NAVBAR ===== -->
<div class="nav">
    <div class="container">

        <!-- LOGO -->
        <div class="logo">🛍 JMSTORE</div>

        <!-- SEARCH -->
        <form class="search" method="GET" action="<?php echo e(route('products.index')); ?>">
            <input type="text" name="search" placeholder="Search products...">
            <button type="submit">🔍</button>
        </form>

        <!-- LINKS -->
        <div class="nav-links">

            <a href="<?php echo e(route('dashboard')); ?>">🏠 Home</a>

            <a href="<?php echo e(route('products.index')); ?>">🛒 Shop</a>

            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('orders.index')); ?>">📦 Orders</a>
                <a href="<?php echo e(route('cart.index')); ?>">🛍 Cart</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>">🔐 Login</a>
            <?php endif; ?>

        </div>

    </div>
</div>

<!-- ===== PAGE CONTENT ===== -->
<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- TOAST -->
<div class="toast-container"></div>

</body>
</html><?php /**PATH C:\laragon\www\simple-store\resources\views/layouts/app.blade.php ENDPATH**/ ?>