<?php $__env->startSection('content'); ?>

<style>
.cart-container {
    max-width: 900px;
    margin: auto;
    animation: fadeIn 0.6s ease-in-out;
}

.cart-item {
    background: white;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform 0.2s;
}

.cart-item:hover {
    transform: scale(1.02);
}

button {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.btn-update {
    background: #f59e0b;
    color: white;
}

.btn-remove {
    background: #ef4444;
    color: white;
}

.btn-checkout {
    background: #2563eb;
    color: white;
    padding: 10px 20px;
    margin-top: 20px;
    border-radius: 8px;
    width: 100%;
    font-size: 1.1rem;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<div class="cart-container">
    <h1>Your Cart</h1>

    <?php if(!empty($cart) && count($cart) > 0): ?>
        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cart-item">
                <h3><?php echo e($item['name']); ?></h3>
                <p>Price: ₱<?php echo e(number_format($item['price'], 2)); ?></p>
                <p>Qty: <?php echo e($item['quantity']); ?></p>
                <p>Subtotal: ₱<?php echo e(number_format($item['price'] * $item['quantity'], 2)); ?></p>

                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <form method="POST" action="<?php echo e(route('cart.update', $id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" style="width: 60px;">
                        <button type="submit" class="btn-update">Update</button>
                    </form>

                    <form method="POST" action="<?php echo e(route('cart.remove', $id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-remove">Remove</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div style="margin-top: 30px; text-align: right;">
            <h2>Total: ₱<?php echo e(number_format($total, 2)); ?></h2>
            
            <form id="checkoutForm">
                <?php echo csrf_field(); ?>
                <button type="submit" id="checkout-btn" class="btn-checkout">
                    Checkout
                </button>
            </form>
        </div>

    <?php else: ?>
        <div style="text-align: center; padding: 50px;">
            <p>Your cart is empty.</p>
            <a href="<?php echo e(url('/')); ?>" class="btn-update" style="text-decoration: none; padding: 10px 20px;">Go Shopping</a>
        </div>
    <?php endif; ?>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkoutForm');
    const checkoutBtn = document.getElementById('checkout-btn');

    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Disable button to prevent double-clicking
            checkoutBtn.disabled = true;
            checkoutBtn.innerText = 'Processing...';

            fetch("<?php echo e(route('checkout.store')); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({}) 
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok) {
                    return data;
                } else {
                    // If the server returns an error (like the product_id issue)
                    throw new Error(data.message || 'Server Error');
                }
            })
            .then(data => {
                alert('Order placed successfully!');
                window.location.href = "<?php echo e(url('/orders')); ?>"; 
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Checkout failed: ' + error.message);
                
                // Re-enable button so user can try again
                checkoutBtn.disabled = false;
                checkoutBtn.innerText = 'Checkout';
            });
        });
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/cart/index.blade.php ENDPATH**/ ?>