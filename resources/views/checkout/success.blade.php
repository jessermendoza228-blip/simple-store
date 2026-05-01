@extends('layouts.app')

@section('content')

<style>
body {
    margin: 0;
    font-family: ui-sans-serif, system-ui;
    background: radial-gradient(circle at top, #0f172a, #020617);
    color: #e5e7eb;
}

.container {
    max-width: 700px;
    margin: auto;
    padding: 50px 20px;
    text-align: center;
    animation: fadeUp 0.5s ease;
}

.card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 30px;
    backdrop-filter: blur(12px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

h1 {
    font-size: 30px;
    margin-bottom: 10px;
}

p {
    color: #94a3b8;
    margin: 8px 0;
}

.badge {
    display: inline-block;
    padding: 6px 12px;
    background: #22c55e;
    border-radius: 999px;
    font-size: 13px;
    margin-top: 10px;
}

.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background: #3b82f6;
    color: white;
    text-decoration: none;
    border-radius: 10px;
}

@keyframes fadeUp {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<div class="container">

    <div class="card">

      <h1>✅ Order Successful!</h1>
<p>Thank you for your purchase.</p>
<a href="/products">Continue Shopping</a>

        {{-- SAFETY FIX: prevents blank page errors --}}
        @if($order)

            <p><strong>Order ID:</strong> #{{ $order->id }}</p>

            <p><strong>Total:</strong> ₱{{ number_format($order->total ?? 0, 2) }}</p>

            <span class="badge">
                Status: {{ $order->status ?? 'Pending' }}
            </span>

        @else

            <p style="color:red;">
                Order data not found.
            </p>

        @endif

        <br>

        <a href="{{ url('/products') }}" class="btn">
            Continue Shopping
        </a>

    </div>

</div>

@endsection