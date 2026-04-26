<?php $__env->startSection('content'); ?>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    padding: 20px;
}

/* CARD */
.card {
    background: white;
    border-radius: 16px;
    padding: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px) scale(1.02);
}

/* PRICE */
.price {
    color: green;
    font-weight: bold;
}

/* STOCK BADGE */
.stock {
    display: inline-block;
    margin: 8px 0;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
}

.in {
    background: #dcfce7;
    color: #16a34a;
}

.out {
    background: #fee2e2;
    color: #dc2626;
}

/* BUTTON */
.btn {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}

/* AVAILABLE */
.btn.available {
    background: linear-gradient(135deg, #f97316, #ef4444);
    color: white;
}

/* DISABLED */
.btn.disabled {
    background: #9ca3af;
    color: #fff;
    cursor: not-allowed;
}
</style>


<div class="grid">

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="card">

            <h3><?php echo e($product->name); ?></h3>

            <p class="price">
                ₱<?php echo e($product->price); ?>

            </p>

            
            <?php if($product->stock > 0): ?>
                <span class="stock in">
                    In Stock: <?php echo e($product->stock); ?>

                </span>
            <?php else: ?>
                <span class="stock out">
                    Out of Stock
                </span>
            <?php endif; ?>

            
            <form method="POST" action="<?php echo e(route('cart.add', $product->id)); ?>">
                <?php echo csrf_field(); ?>

                <button 
                    class="btn <?php echo e($product->stock > 0 ? 'available' : 'disabled'); ?>"
                    <?php echo e($product->stock > 0 ? '' : 'disabled'); ?>

                >
                    <?php echo e($product->stock > 0 ? 'Add to Cart' : 'Unavailable'); ?>

                </button>

            </form>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/products/index.blade.php ENDPATH**/ ?>