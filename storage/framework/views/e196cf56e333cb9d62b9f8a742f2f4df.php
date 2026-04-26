

<?php $__env->startSection('content'); ?>

<style>
.container {
    max-width: 1100px;
    margin: auto;
    padding: 30px;
}

h1 {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #fff;
}

/* TABLE */
.table-wrapper {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(12px);
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: rgba(0,0,0,0.4);
}

th, td {
    padding: 14px;
    text-align: left;
    font-size: 14px;
    color: #ffffff;
}

tbody tr {
    border-top: 1px solid rgba(255,255,255,0.08);
    transition: 0.2s ease;
}

tbody tr:hover {
    background: rgba(255,255,255,0.05);
    transform: scale(1.01);
}

/* BUTTON */
.btn {
    background: rgba(59,130,246,0.2);
    border: 1px solid rgba(59,130,246,0.4);
    color: #ffffff;
    padding: 8px 12px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    transition: 0.2s ease;
}

.btn:hover {
    background: rgba(59,130,246,0.35);
    transform: translateY(-2px);
}

/* STATUS BADGES */
.badge {
    padding: 5px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

/* STATUS COLORS */
.pending {
    background: rgba(245, 158, 11, 0.2);
    color: #fbbf24;
    border: 1px solid rgba(245, 158, 11, 0.4);
}

.processing {
    background: rgba(59, 130, 246, 0.2);
    color: #60a5fa;
    border: 1px solid rgba(59, 130, 246, 0.4);
}

.shipped {
    background: rgba(168, 85, 247, 0.2);
    color: #c084fc;
    border: 1px solid rgba(168, 85, 247, 0.4);
}

.delivered {
    background: rgba(34, 197, 94, 0.2);
    color: #4ade80;
    border: 1px solid rgba(34, 197, 94, 0.4);
}

.cancelled {
    background: rgba(239, 68, 68, 0.2);
    color: #f87171;
    border: 1px solid rgba(239, 68, 68, 0.4);
}
</style>

<div class="container">

    <h1>Orders</h1>

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>

                    <td>#<?php echo e($order->id); ?></td>

                    <td><?php echo e($order->user->name ?? 'Guest'); ?></td>

                    <td>₱<?php echo e(number_format($order->total, 2)); ?></td>

                    <td>
                        <span class="badge <?php echo e($order->status); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </td>

                    <td>
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
                           class="btn">
                            View
                        </a>
                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>
                    <td colspan="5" style="text-align:center; padding:20px; color:#9ca3af;">
                        No orders found
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>