

<?php $__env->startSection('content'); ?>

<div class="flex justify-between items-center mb-4">

    <h1 class="text-2xl font-bold">Products</h1>

    <a href="<?php echo e(route('admin.products.create')); ?>"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Product
    </a>

</div>

<div class="bg-white shadow rounded overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Price</th>
                <th class="p-3 text-left">Stock</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>

      <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="border-b hover:bg-gray-100">

    <td class="p-3"><?php echo e($order->id); ?></td>
    <td class="p-3"><?php echo e($order->user->name ?? 'Guest'); ?></td>
    <td class="p-3">₱<?php echo e($order->total_amount); ?></td>
    <td class="p-3"><?php echo e($order->status); ?></td>

    <td class="p-3">
        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>"
           class="bg-blue-500 text-white px-3 py-1 rounded">
            View
        </a>
    </td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>