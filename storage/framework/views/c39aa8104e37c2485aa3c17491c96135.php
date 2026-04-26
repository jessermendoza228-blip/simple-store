

<?php $__env->startSection('content'); ?>

<style>
.container {
    max-width: 700px;
    margin: auto;
}

.card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    padding: 20px;
    border-radius: 16px;
    color: #fff;
    backdrop-filter: blur(10px);
}

h1 {
    margin-bottom: 20px;
}

p {
    margin: 8px 0;
    color: #e5e7eb;
}

select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    background: #fff;
    color: #000;
    margin-top: 10px;
    border: 1px solid #ccc;
}

button {
    margin-top: 15px;
    padding: 10px 15px;
    background: #3b82f6;
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    transition: 0.2s ease;
}

button:hover {
    background: #2563eb;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    background: #facc15;
    color: #000;
    font-size: 12px;
}
</style>

<div class="container">

    <div class="card">

        <h1>Order Details</h1>

        <p><strong>Order ID:</strong> #<?php echo e($order->id); ?></p>

        <p>
            <strong>Status:</strong>
            <span class="badge"><?php echo e($order->status); ?></span>
        </p>

        
        <form method="POST" action="<?php echo e(route('admin.orders.update', $order->id)); ?>">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label>Update Status</label>

            <select name="status">

                <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>
                    Pending
                </option>

                <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>
                    Processing
                </option>

                <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>
                    Shipped
                </option>

                <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>
                    Delivered
                </option>

                <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>
                    Cancelled
                </option>

            </select>

            <button type="submit">Update Order</button>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>