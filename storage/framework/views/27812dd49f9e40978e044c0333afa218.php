<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
</head>

<body class="bg-gray-200 text-gray-900">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white p-5">

        <h1 class="text-xl font-bold mb-6">Admin Panel</h1>

        <nav class="space-y-2">

            <a class="block p-2 rounded hover:bg-gray-700" href="<?php echo e(route('admin.dashboard')); ?>">
                Dashboard
            </a>

            <a class="block p-2 rounded hover:bg-gray-700" href="<?php echo e(route('admin.products.index')); ?>">
                Products
            </a>

            <a class="block p-2 rounded hover:bg-gray-700" href="<?php echo e(route('admin.categories.index')); ?>">
                Categories
            </a>

            <a class="block p-2 rounded hover:bg-gray-700" href="<?php echo e(route('admin.orders.index')); ?>">
                Orders
            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>

</body>
</html><?php /**PATH C:\laragon\www\simple-store\resources\views/layouts/admin.blade.php ENDPATH**/ ?>