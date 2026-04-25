@extends('layouts.admin')

@section('content')

<div class="text-black">

    <!-- HEADER -->
    <h1 class="text-3xl font-bold mb-6">
        📊 Admin Dashboard
    </h1>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">

        <div class="bg-white p-4 rounded-xl shadow border">
            <p class="text-gray-500">Total Orders</p>
            <h2 class="text-2xl font-bold">{{ $totalOrders }}</h2>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border">
            <p class="text-gray-500">Products</p>
            <h2 class="text-2xl font-bold">{{ $totalProducts }}</h2>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border">
            <p class="text-gray-500">Users</p>
            <h2 class="text-2xl font-bold">{{ $totalUsers }}</h2>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border">
            <p class="text-gray-500">Categories</p>
            <h2 class="text-2xl font-bold">{{ $totalCategories }}</h2>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border">
            <p class="text-gray-500">Revenue</p>
            <h2 class="text-2xl font-bold">₱{{ number_format($totalRevenue, 2) }}</h2>
        </div>

    </div>

    <!-- RECENT ORDERS -->
    <h2 class="text-2xl font-bold mb-4">
        🧾 Recent Orders
    </h2>

    <div class="bg-white shadow-xl rounded-xl overflow-hidden border">

        <table class="w-full text-black">

            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($recentOrders as $order)

                <tr class="border-b hover:bg-gray-100 transition">

                    <td class="p-4 font-semibold">
                        #{{ $order->id }}
                    </td>

                    <td class="p-4">

                        @if($order->status == 'completed')
                            <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm">
                                Completed
                            </span>
                        @elseif($order->status == 'pending')
                            <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-sm">
                                Pending
                            </span>
                        @else
                            <span class="bg-red-200 text-red-800 px-3 py-1 rounded-full text-sm">
                                Cancelled
                            </span>
                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="2" class="p-4 text-center text-gray-500">
                        No recent orders
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection