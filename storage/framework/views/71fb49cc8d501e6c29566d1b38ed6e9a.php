

<?php $__env->startSection('content'); ?>

<style>
body {
    margin: 0;
    font-family: ui-sans-serif, system-ui;
    background: radial-gradient(circle at top, #0f172a 0%, #0b1220 100%);
    color: #e5e7eb;
}

/* WRAPPER */
.container {
    max-width: 600px;
    margin: auto;
    padding: 40px 20px;
    animation: fadeUp 0.5s ease;
}

/* TITLE */
h1 {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #ffffff;
}

/* CARD FORM */
.form-box {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 25px;

    backdrop-filter: blur(12px);

    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}

/* INPUTS */
input, textarea {
    width: 100%;
    padding: 12px;
    margin-top: 8px;
    margin-bottom: 15px;

    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.1);

    background: rgba(0,0,0,0.3);
    color: #ffffff;

    outline: none;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 10px rgba(59,130,246,0.3);
}

/* LABELS */
label {
    font-size: 13px;
    color: #cbd5e1;
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;

    border: none;
    border-radius: 10px;

    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;

    font-weight: 700;
    cursor: pointer;

    transition: 0.3s;
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(34,197,94,0.3);
}

/* BACK LINK */
.back {
    display: inline-block;
    margin-top: 15px;
    color: #93c5fd;
    text-decoration: none;
    font-size: 13px;
}

.back:hover {
    text-decoration: underline;
}

/* ANIMATION */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<div class="container">

    <h1>➕ Create Category</h1>

    <div class="form-box">

        <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">

            <?php echo csrf_field(); ?>

            <label>Category Name</label>
            <input type="text" name="name" placeholder="Enter category name" required>

            <label>Description</label>
            <textarea name="description" rows="4" placeholder="Enter description (optional)"></textarea>

            <button type="submit">Save Category</button>

        </form>

    </div>

    <a href="<?php echo e(route('admin.categories.index')); ?>" class="back">
        ← Back to Categories
    </a>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>