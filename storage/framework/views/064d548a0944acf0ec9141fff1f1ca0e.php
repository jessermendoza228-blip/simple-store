<?php $__env->startSection('content'); ?>

<h2 class="fade" style="font-size:28px; margin-bottom:20px;">
    Discover Premium Products
</h2>

<div style="
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap:20px;
">

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="card fade">

    <div style="
        height:160px;
        border-radius:12px;
        background:linear-gradient(135deg,#e0e7ff,#fce7f3);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:40px;
    ">
        🛍️
    </div>

    <h3 style="margin-top:12px;"><?php echo e($product->name); ?></h3>

    <p style="color:#6366f1; font-weight:bold;">
        ₱<?php echo e($product->price); ?>

    </p>

    <form method="POST" action="<?php echo e(route('cart.add', $product->id)); ?>">
        <?php echo csrf_field(); ?>

        <input type="number" name="quantity" value="1" min="1"
               style="width:60px; padding:6px; border-radius:8px;">

        <button class="btn btn-primary">Add</button>
    </form>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/products/index.blade.php ENDPATH**/ ?>