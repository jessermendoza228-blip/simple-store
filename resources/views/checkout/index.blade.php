@extends('layouts.app')

@section('content')

<div style="max-width:800px;margin:auto;">

    <h1>Your Cart</h1>

    {{-- CART ITEMS --}}
    @php $total = 0; @endphp

    @foreach($cart as $item)
        @php
            $lineTotal = $item['price'] * $item['quantity'];
            $total += $lineTotal;
        @endphp

        <div style="padding:10px; border-bottom:1px solid #ddd;">
            <strong>{{ $item['name'] }}</strong><br>
            Qty: {{ $item['quantity'] }} <br>
            Price: ₱{{ $lineTotal }}
        </div>
    @endforeach

    <h3>Total: ₱{{ $total }}</h3>

    <hr>

    {{-- CHECKOUT FORM (SAME PAGE) --}}
    <h2>Checkout Information</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2; padding:10px;">
            @foreach($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Name"
               style="width:100%; padding:10px; margin-bottom:8px;">

        <input type="email" name="email" placeholder="Email"
               style="width:100%; padding:10px; margin-bottom:8px;">

        <input type="text" name="phone" placeholder="Phone"
               style="width:100%; padding:10px; margin-bottom:8px;">

        <textarea name="address" placeholder="Address"
                  style="width:100%; padding:10px; margin-bottom:8px;"></textarea>

        <button type="submit"
                style="width:100%; padding:10px; background:green; color:white;">
            Place Order
        </button>
    </form>

</div>

@endsection