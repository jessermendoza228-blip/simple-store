

<?php $__env->startSection('content'); ?>

<h3>Add Product</h3>

<form method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <input type="text" name="name" placeholder="Product name"><br><br>

    <input type="number" name="price" placeholder="Price"><br><br>

    <input type="number" name="stock" placeholder="Stock"><br><br>

    <select name="category_id">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>">
                <?php echo e($category->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <br><br>

    <input type="file" name="image">

    <br><br>

    <button type="submit">Save</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/products/create.blade.php ENDPATH**/ ?>