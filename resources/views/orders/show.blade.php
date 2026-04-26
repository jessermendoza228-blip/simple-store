@extends('layouts.app')

@section('content')

<h2>Order #{{ $order->id }}</h2>

<p>Total: ₱{{ $order->total }}</p>

@foreach($order->orderItems as $item)

<div class="card">

    <p>{{ $item->product->name }}</p>
    <p>Qty: {{ $item->quantity }}</p>
    <p>Price: ₱{{ $item->price }}</p>

</div>

@endforeach

@endsection