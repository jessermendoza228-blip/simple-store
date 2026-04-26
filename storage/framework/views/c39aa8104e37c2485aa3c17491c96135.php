

<?php $__env->startSection('content'); ?>

<h1>Order Details</h1>

<p>Order ID: <?php echo e($order->id); ?></p>

<p>Status: <?php echo e($order->status); ?></p>

<form method="POST"
action="<?php echo e(route('admin.orders.update',$order->id)); ?>">

<?php echo csrf_field(); ?>
<?php echo method_field('PATCH'); ?>

<select name="status">

<option value="pending">Pending</option>
<option value="processing">Processing</option>
<option value="shipped">Shipped</option>
<option value="delivered">Delivered</option>
<option value="cancelled">Cancelled</option>

</select>

<button>Update</button>

</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>