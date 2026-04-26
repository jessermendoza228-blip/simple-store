@extends('layouts.app')

@section('content')

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

    @if(!empty($cart) && count($cart) > 0)
        @foreach($cart as $id => $item)
            <div class="cart-item">
                <h3>{{ $item['name'] }}</h3>
                <p>Price: ₱{{ number_format($item['price'], 2) }}</p>
                <p>Qty: {{ $item['quantity'] }}</p>
                <p>Subtotal: ₱{{ number_format($item['price'] * $item['quantity'], 2) }}</p>

                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <form method="POST" action="{{ route('cart.update', $id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">
                        <button type="submit" class="btn-update">Update</button>
                    </form>

                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div style="margin-top: 30px; text-align: right;">
            <h2>Total: ₱{{ number_format($total, 2) }}</h2>
            
            <form id="checkoutForm">
                @csrf
                <button type="submit" id="checkout-btn" class="btn-checkout">
                    Checkout
                </button>
            </form>
        </div>

    @else
        <div style="text-align: center; padding: 50px;">
            <p>Your cart is empty.</p>
            <a href="{{ url('/') }}" class="btn-update" style="text-decoration: none; padding: 10px 20px;">Go Shopping</a>
        </div>
    @endif
</div>

{{-- This script handles the AJAX checkout process --}}
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

            fetch("{{ route('checkout.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                window.location.href = "{{ url('/orders') }}"; 
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

@endsection