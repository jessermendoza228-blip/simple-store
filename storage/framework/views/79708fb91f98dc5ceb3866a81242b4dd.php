

<?php $__env->startSection('content'); ?>

<h3>Dashboard</h3>

<p>Total Products: <?php echo e($totalProducts); ?></p>
<p>Total Categories: <?php echo e($totalCategories); ?></p>
<p>Total Orders: <?php echo e($totalOrders); ?></p>
<p>Total Users: <?php echo e($totalUsers); ?></p>
<p>Total Revenue: <?php echo e($totalRevenue); ?></p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>