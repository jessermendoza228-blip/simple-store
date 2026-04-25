<!DOCTYPE html>
<html>
<head>
    <title>Admin Products</title>

    <style>
        body { font-family: Arial; margin: 20px; }

        .btn {
            background: green;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }

        .actions a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h1>Products</h1>

<a href="<?php echo e(route('admin.products.create')); ?>" class="btn">
    + Add Product
</a>

<div class="grid">

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="card">
        <h3><?php echo e($product->name); ?></h3>
        <p>₱<?php echo e($product->price); ?></p>
        <p>Stock: <?php echo e($product->stock); ?></p>

        <div class="actions">
            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>">
                Edit
            </a>

            <form method="POST"
                  action="<?php echo e(route('admin.products.destroy', $product->id)); ?>"
                  style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <button onclick="return confirm('Delete this product?')">
                    Delete
                </button>
            </form>
        </div>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

</body>
</html><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/products/index.blade.php ENDPATH**/ ?>