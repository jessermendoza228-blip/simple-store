@extends('layouts.app')

@section('content')

<style>
body {
    margin: 0;
    font-family: ui-sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: white;
}

.container {
    max-width: 600px;
    margin: auto;
    padding: 40px;
}

.card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 25px;
    animation: fadeUp 0.5s ease;
}

h2 {
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    margin-top: 10px;
}

button {
    margin-top: 15px;
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}

button:hover {
    transform: scale(1.03);
}

.error {
    background: rgba(239,68,68,0.2);
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
}

@keyframes fadeUp {
    from {opacity: 0; transform: translateY(10px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<div class="container">

    <div class="card">

        <h2>Checkout</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf

            <input type="text" name="payment_method" placeholder="Payment method (optional)">

            <button type="submit">Place Order</button>
        </form>

    </div>

</div>

@endsection