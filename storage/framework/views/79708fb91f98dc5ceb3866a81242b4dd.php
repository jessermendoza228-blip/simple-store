

<?php $__env->startSection('content'); ?>

<style>
    /* GLOBAL BACKGROUND (MATCHES YOUR ADMIN THEME) */
    body {
        margin: 0;
        font-family: ui-sans-serif, system-ui;
        background: radial-gradient(circle at top, #111827 0%, #0b1220 100%);
        color: #e5e7eb;
    }

    .container {
        max-width: 1100px;
        margin: auto;
        padding: 30px;
    }

    h3 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 20px;
        color: #e5e7eb;
        animation: fadeDown 0.4s ease;
    }

    /* GRID */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    /* CARD */
    .card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        padding: 20px;

        backdrop-filter: blur(10px);

        transition: 0.3s ease;
        animation: fadeUp 0.5s ease forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    .card:hover {
        transform: translateY(-6px);
        border-color: rgba(59,130,246,0.5);
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    }

    .label {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 8px;
    }

    .value {
        font-size: 24px;
        font-weight: 800;
        color: #ffffff;
    }

    /* ACCENTS */
    .blue { border-left: 4px solid #3b82f6; }
    .green { border-left: 4px solid #22c55e; }
    .yellow { border-left: 4px solid #facc15; }
    .purple { border-left: 4px solid #a855f7; }
    .red { border-left: 4px solid #ef4444; }

    /* ANIMATION */
    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container">

    <h3>Dashboard Overview</h3>

    <div class="grid">

        <div class="card blue">
            <div class="label">Total Products</div>
            <div class="value"><?php echo e($totalProducts); ?></div>
        </div>

        <div class="card green">
            <div class="label">Total Categories</div>
            <div class="value"><?php echo e($totalCategories); ?></div>
        </div>

        <div class="card yellow">
            <div class="label">Total Orders</div>
            <div class="value"><?php echo e($totalOrders); ?></div>
        </div>

        <div class="card purple">
            <div class="label">Total Users</div>
            <div class="value"><?php echo e($totalUsers); ?></div>
        </div>

        <div class="card red">
            <div class="label">Total Revenue</div>
            <div class="value">₱<?php echo e(number_format($totalRevenue, 2)); ?></div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>