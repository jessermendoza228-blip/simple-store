@extends('layouts.admin')

@section('content')

<h1>Order Details</h1>

<p>Order ID: {{ $order->id }}</p>

<p>Status: {{ $order->status }}</p>

<form method="POST"
action="{{ route('admin.orders.update',$order->id) }}">

@csrf
@method('PATCH')

<select name="status">

<option value="pending">Pending</option>
<option value="processing">Processing</option>
<option value="shipped">Shipped</option>
<option value="delivered">Delivered</option>
<option value="cancelled">Cancelled</option>

</select>

<button>Update</button>

</form>

@endsection