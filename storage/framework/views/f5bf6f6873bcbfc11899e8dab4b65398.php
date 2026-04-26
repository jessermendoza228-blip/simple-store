<?php $__env->startSection('content'); ?>

<style>
    /* =========================
       PREMIUM GREY DESIGN SYSTEM
    ========================== */

    body {
        background: linear-gradient(180deg, #b9bcbe 0%, #354055 100%);
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
        color: #111827;
    }

    .orders-container {
        max-width: 980px;
        margin: auto;
        padding: 40px 24px;
    }

    /* =========================
       TITLE (ELEGANT TYPE)
    ========================== */

    .title {
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -1px;
        color: #111827;
        margin-bottom: 30px;
    }

    /* =========================
       EMPTY STATE (SOFT CARD)
    ========================== */

    .empty {
        background: rgba(185, 181, 181, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 60px;
        text-align: center;
        color: #6b7280;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    /* =========================
       ORDER CARD (MODERN GLASS GREY)
    ========================== */

    .order {
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(12px);

        border: 1px solid #e5e7eb;
        border-radius: 18px;

        padding: 22px;
        margin-bottom: 18px;

        box-shadow: 0 8px 25px rgba(0,0,0,0.06);

        transition: all 0.25s ease;

        opacity: 0;
        transform: translateY(14px);
        animation: fadeUp 0.5s ease forwards;
    }

    .order:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(0,0,0,0.08);
        border-color: #d1d5db;
    }

    /* =========================
       HEADER SECTION
    ========================== */

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .order-id {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.4px;
        color: #111827;
    }

    /* =========================
       STATUS BADGE (ELEGANT GREY)
    ========================== */

    .badge {
        background: #f3f4f6;
        color: #374151;

        padding: 6px 12px;
        border-radius: 999px;

        font-size: 12px;
        font-weight: 600;

        border: 1px solid #e5e7eb;
    }

    /* =========================
       ITEMS LIST
    ========================== */

    .items {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #e5e7eb;
    }

    .item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;

        font-size: 14px;
        color: #4b5563;

        transition: all 0.2s ease;
    }

    .item:hover {
        color: #111827;
        transform: translateX(6px);
    }

    .item strong {
        font-weight: 500;
    }

    /* =========================
       TOTAL (MINIMAL PREMIUM LOOK)
    ========================== */

    .total {
        margin-top: 16px;
        display: flex;
        justify-content: flex-end;
    }

    .total span {
        background: linear-gradient(135deg, #111827, #1f2937);
        color: white;

        padding: 8px 16px;
        border-radius: 999px;

        font-size: 13px;
        font-weight: 600;

        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* =========================
       ANIMATION (SMOOTH ENTRY)
    ========================== */

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .order:nth-child(1) { animation-delay: 0.05s; }
    .order:nth-child(2) { animation-delay: 0.1s; }
    .order:nth-child(3) { animation-delay: 0.15s; }
    .order:nth-child(4) { animation-delay: 0.2s; }
</style>
<div class="orders-container">

    <h2 class="title">My Orders</h2>

    <?php if($orders->isEmpty()): ?>
        <div class="empty">
            🛒 No orders yet. Start shopping to see your order history here.
        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="order">

        <div class="order-header">
            <div class="order-id">
                Order #<?php echo e($order->id); ?>

            </div>

            <div class="badge">
                <?php echo e($order->status ?? 'Completed'); ?>

            </div>
        </div>

        <div class="items">

            <?php if($order->orderItems && $order->orderItems->isNotEmpty()): ?>
                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <strong>
                            <?php echo e($item->product->name ?? 'Deleted Product'); ?>

                            (x<?php echo e($item->quantity); ?>)
                        </strong>
                        <span>₱<?php echo e(number_format($item->price, 2)); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="item" style="color:#9ca3af;">
                    No items found
                </div>
            <?php endif; ?>

        </div>

        <div class="total">
            <span>Total: ₱<?php echo e(number_format($order->total, 2)); ?></span>
        </div>

    </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/orders/index.blade.php ENDPATH**/ ?>