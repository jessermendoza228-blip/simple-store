@extends('layouts.admin')

@section('content')

<style>
    body {
        margin: 0;
        font-family: ui-sans-serif, system-ui;
        background: radial-gradient(circle at top, #111827 0%, #0b1220 100%);
        color: #e5e7eb;
    }

    .container {
        max-width: 1100px;
        margin: auto;
        padding: 30px;
    }

    h1 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    /* TABLE WRAPPER */
    .table-wrapper {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        overflow: hidden;
        backdrop-filter: blur(12px);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: rgba(0,0,0,0.4);
    }

    th, td {
        padding: 14px;
        text-align: left;
        font-size: 14px;

        /* ✅ FIX ADDED HERE */
        color: #ffffff;
    }

    tbody tr {
        border-top: 1px solid rgba(255,255,255,0.08);
        transition: 0.2s ease;
    }

    tbody tr:hover {
        background: rgba(255,255,255,0.05);
        transform: scale(1.01);
    }

    /* BUTTON */
    .btn {
        background: rgba(219, 219, 219, 0.2);
        border: 1px solid rgba(59,130,246,0.4);
        color: #ffffff;
        padding: 8px 12px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        transition: 0.2s ease;
        display: inline-block;
    }

    .btn:hover {
        background: rgba(59,130,246,0.35);
        transform: translateY(-2px);
    }

    /* STATUS BADGE */
    .badge {
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        background: rgba(34,197,94,0.15);
        color: #ffffff;
        border: 1px solid rgba(34,197,94,0.3);
    }

</style>

<div class="container">

    <h1>Orders</h1>

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($orders as $order)

                <tr>

                    <td>#{{ $order->id }}</td>

                    <td>{{ $order->user->name ?? 'Guest' }}</td>

                    <td>₱{{ number_format($order->total, 2) }}</td>

                    <td>
                        <span class="badge">
                            {{ $order->status ?? 'Completed' }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="btn">
                            View
                        </a>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align:center; padding:20px; color:#9ca3af;">
                        No orders found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection