

<?php $__env->startSection('content'); ?>

<h1 class="text-2xl font-bold mb-4">Categories</h1>

<a href="<?php echo e(route('admin.categories.create')); ?>"
   class="bg-blue-600 text-white px-4 py-2 rounded">
    Add Category
</a>

<table class="w-full mt-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Name</th>
            <th class="p-2">Slug</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="border-b">
            <td class="p-2"><?php echo e($category->name); ?></td>
            <td class="p-2"><?php echo e($category->slug); ?></td>
            <td class="p-2">
                <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>"
                   class="text-yellow-600">Edit</a>

                <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
                      method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>