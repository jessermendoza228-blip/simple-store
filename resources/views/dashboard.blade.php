@extends('layouts.app')

@section('content')

<style>
    body {
        margin: 0;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
        color: #111827;
        background: radial-gradient(circle at top, #1f2937 0%, #0f172a 100%);
    }

    .dashboard {
        max-width: 1100px;
        margin: auto;
        padding: 40px 24px;
    }

    /* TITLE */
    .title {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -1px;
        color: #ffffff;
        animation: fadeDown 0.6s ease;
    }

    .subtitle {
        color: #cbd5e1;
        margin-bottom: 28px;
        font-size: 14px;
    }

    /* GRID */
    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 30px;
    }

    /* CARD */
    .card {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 16px;
        padding: 22px;
        backdrop-filter: blur(12px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        transition: all 0.25s ease;
        color: #111827; /* FIX TEXT VISIBILITY */
    }

    .card:hover {
        transform: translateY(-6px);
        border-color: rgba(255,255,255,0.25);
    }

    .label {
        font-size: 13px;
        color: #e5e7eb;
        margin-bottom: 6px;
    }

    .value {
        font-size: 28px;
        font-weight: 800;
        color: #ffffff;
    }

    /* SECTION */
    .section {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 16px;
        padding: 22px;
        backdrop-filter: blur(10px);
    }

    .section h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 14px;
        color: #ffffff;
    }

    /* ACTIONS */
    .item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        font-size: 14px;

        color: #111827; /* FIX: make text visible */
        background: rgba(255,255,255,0.04);
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: 0.2s ease;
    }

    .item:hover {
        transform: translateX(6px);
        background: rgba(255,255,255,0.1);
    }

    .item span {
        color: #ffffff; /* FIX LABEL VISIBILITY */
        font-weight: 500;
    }

    .item:last-child {
        border-bottom: none;
    }

    /* BUTTON */
    .btn {
        padding: 7px 14px;
        border-radius: 10px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
        box-shadow: 0 10px 20px rgba(59,130,246,0.25);
    }

    .btn:hover {
        transform: scale(1.05);
    }

    /* ANIMATIONS */
    @keyframes fadeDown {
        from {opacity: 0; transform: translateY(-10px);}
        to {opacity: 1; transform: translateY(0);}
    }

    @media (max-width: 900px) {
        .grid {
            grid-template-columns: 1fr;
        }
    }

</style>

<div class="dashboard">

    <div class="title">Dashboard</div>
    <div class="subtitle">
       JM༼ つ ◕_◕ ༽つ
    </div>

    {{-- STATS --}}
    <div class="grid">

        <div class="card">
            <div class="label">Cart Items</div>
            <div class="value">
                @php
                    $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
                @endphp
                {{ $cartCount }}
            </div>
        </div>

        <div class="card">
            <div class="label">My Orders</div>
            <div class="value">📦</div>
        </div>

        <div class="card">
            <div class="label">Account</div>
            <div class="value">Active</div>
        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="section">

        <h3>Quick Actions</h3>

        <div class="item">
            <span>Browse Products</span>
            <a href="{{ route('products.index') }}" class="btn">Open</a>
        </div>

        <div class="item">
            <span>View Cart</span>
            <a href="{{ route('cart.index') }}" class="btn">Open</a>
        </div>

        <div class="item">
            <span>Order History</span>
            <a href="{{ route('orders.index') }}" class="btn">Open</a>
        </div>

        <div class="item">
            <span>Admin Panel (if admin)</span>
            <a href="{{ route('admin.dashboard') }}" class="btn">Open</a>
        </div>

    </div>

</div>

@endsection