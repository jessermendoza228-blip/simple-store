<?php $__env->startSection('content'); ?>

<style>
body {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    font-family: Arial, sans-serif;
}

/* =========================
   MAIN CONTAINER
========================= */

.checkout-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    animation: fadeIn 0.8s ease-in-out;
}

/* =========================
   CARD
========================= */

.card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* =========================
   CART ITEM
========================= */

.cart-item {
    padding: 12px;
    border-bottom: 1px solid #eee;
    color: #111 !important;
}

/* 🔥 FIX PRODUCT NAME VISIBILITY */
.cart-item strong {
    color: #000 !important;
    font-weight: 700;
}

/* =========================
   BUTTON
========================= */

.btn {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
    font-size: 15px;
}

.btn:hover {
    transform: scale(1.03);
    filter: brightness(1.1);
}

/* =========================
   MODAL
========================= */

.modal {
    display: none;
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 25px;
    border-radius: 12px;
    width: 360px;
    animation: pop 0.3s ease;
}

/* =========================
   INPUTS
========================= */

input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 8px;
    border-radius: 8px;
    border: 1px solid #ddd;
    color: #111 !important;
    background: #fff;
}

/* =========================
   TEXT FIX (GLOBAL SAFETY)
========================= */

.card,
.cart-item,
.checkout-container,
.modal-content,
h1, h2, h3, p {
    color: #111827 !important;
}

/* =========================
   EMPTY CART TEXT
========================= */

.empty-text {
    color: #111;
    text-align: center;
    padding: 20px;
}

/* =========================
   ANIMATIONS
========================= */

@keyframes pop {
    from {transform: scale(0.8); opacity:0;}
    to {transform: scale(1); opacity:1;}
}
</style>

<div class="checkout-container">

    
    <div class="card">
        <h1>🛒 Your Cart</h1>

        <?php $total = 0; ?>

        <?php if(!empty($cart)): ?>

            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $lineTotal = $item['price'] * $item['quantity'];
                    $total += $lineTotal;
                ?>

                <div class="cart-item">
                    <strong><?php echo e($item['name']); ?></strong><br>
                    Qty: <?php echo e($item['quantity']); ?><br>
                    ₱<?php echo e($lineTotal); ?>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php else: ?>

            <p class="empty-text">
                Your cart is empty 🛒
            </p>

        <?php endif; ?>

        <h2>Total: ₱<?php echo e($total); ?></h2>
    </div>

    
    <button class="btn" onclick="openModal()">
        Checkout ⚡
    </button>

</div>


<div class="modal" id="checkoutModal">
    <div class="modal-content">

        <h2>Checkout Details</h2>

        <form method="POST" action="<?php echo e(route('checkout.store')); ?>">
            <?php echo csrf_field(); ?>

            <input type="text" name="name" placeholder="Full Name" required>

            <input type="email" name="email" placeholder="Email Address" required>

            <input type="text" name="phone" placeholder="Mobile Number" required>

            <textarea name="address" placeholder="Delivery Address" required></textarea>

            <button class="btn" type="submit" style="margin-top:12px;">
                Confirm Order ✅
            </button>
        </form>

        <br>

        <button onclick="closeModal()"
            style="background:red;color:white;padding:10px;border:none;border-radius:8px;width:100%;">
            Cancel
        </button>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('checkoutModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('checkoutModal').style.display = 'none';
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\simple-store\resources\views/cart/index.blade.php ENDPATH**/ ?>