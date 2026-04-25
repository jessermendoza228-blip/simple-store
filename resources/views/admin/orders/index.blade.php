@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-4">

    <h1 class="text-2xl font-bold">Products</h1>

    <a href="{{ route('admin.products.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Product
    </a>

</div>

<div class="bg-white shadow rounded overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Price</th>
                <th class="p-3 text-left">Stock</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>

      @foreach($orders as $order)
<tr class="border-b hover:bg-gray-100">

    <td class="p-3">{{ $order->id }}</td>
    <td class="p-3">{{ $order->user->name ?? 'Guest' }}</td>
    <td class="p-3">₱{{ $order->total_amount }}</td>
    <td class="p-3">{{ $order->status }}</td>

    <td class="p-3">
        <a href="{{ route('admin.orders.show', $order->id) }}"
           class="bg-blue-500 text-white px-3 py-1 rounded">
            View
        </a>
    </td>

</tr>
@endforeach

        </tbody>

    </table>

</div>

@endsection