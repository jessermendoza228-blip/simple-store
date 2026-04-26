@extends('layouts.app')

@section('content')

<style>
/* =========================
   PREMIUM MODERN UI UPGRADE
========================= */

body {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
    color: #e5e7eb;
}

/* CONTAINER */
.orders-container {
    max-width: 980px;
    margin: auto;
    padding: 40px 24px;
}

/* TITLE */
.title {
    font-size: 38px;
    font-weight: 900;
    letter-spacing: -1px;
    margin-bottom: 30px;
    background: linear-gradient(90deg, #60a5fa, #a78bfa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: fadeDown 0.6s ease;
}

/* EMPTY STATE */
.empty {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 60px;
    text-align: center;
    color: #9ca3af;
}

/* ORDER CARD */
.order {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    transition: all 0.3s ease;
    animation: fadeUp 0.5s ease forwards;
}

.order:hover {
    transform: translateY(-6px);
    border-color: rgba(59,130,246,0.5);
    box-shadow: 0 18px 40px rgba(59,130,246,0.15);
}

/* HEADER */
.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* ORDER ID */
.order-id {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff; /* FIX */
}

/* BADGE */
.badge {
    background: rgba(255,255,255,0.1);
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    border: 1px solid rgba(255,255,255,0.1);
    color: #ffffff; /* FIX */
    font-weight: 600;
}

/* ITEMS */
.items {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 14px;
    color: #d1d5db;
    transition: 0.2s;
}

/* FIX PRODUCT NAME + QTY */
.item span:first-child {
    color: #ffffff !important;
    font-weight: 600;
}

/* FIX PRICE */
.item span:last-child {
    color: #ffffff !important;
    font-weight: 600;
}

.item:hover {
    transform: translateX(6px);
    color: #ffffff;
}

/* TOTAL */
.total {
    margin-top: 16px;
    display: flex;
    justify-content: flex-end;
}

.total span {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: white;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
}

/* CANCEL BUTTON */
.cancel-btn {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s ease;
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(239,68,68,0.2);
}

.cancel-btn:hover {
    transform: scale(1.08);
    box-shadow: 0 15px 30px rgba(239,68,68,0.3);
}

/* MODAL BACKDROP */
.modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
    z-index: 999;
}

/* MODAL BOX */
.modal-box {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 22px;
    border-radius: 14px;
    width: 340px;
    color: white;
}

/* TEXTAREA */
textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 10px;
    border: none;
    outline: none;
}

/* ANIMATIONS */
@keyframes fadeUp {
    from {opacity: 0; transform: translateY(10px);}
    to {opacity: 1; transform: translateY(0);}
}

@keyframes fadeDown {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<div class="orders-container">

    <h2 class="title">My Orders</h2>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="empty">🛒 No orders yet.</div>
    @endif

    @foreach($orders as $order)

    <div class="order">

        <div class="order-header">

            <div class="order-id">
                Order #{{ $order->id }}
            </div>

            <div style="display:flex;gap:10px;align-items:center;">

                <div class="badge">
                    {{ $order->status }}
                </div>

                @if($order->status !== 'cancelled')
                    <button class="cancel-btn"
                        onclick="openModal({{ $order->id }})">
                        Cancel
                    </button>
                @endif

            </div>

        </div>

        <div class="items">
            @foreach($order->orderItems as $item)
                <div class="item">
                    <span>
                        {{ $item->product->name }} x{{ $item->quantity }}
                    </span>
                    <span>
                        ₱{{ $item->price }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="total">
            <span>Total: ₱{{ $order->total }}</span>
        </div>

    </div>

    @endforeach

</div>

<div id="cancelModal" class="modal">

    <div class="modal-box">

        <h3>Cancel Order</h3>

        <form id="cancelForm" method="POST">
            @csrf

            <textarea name="cancel_reason"
                      placeholder="Reason for cancellation"
                      required></textarea>

            <button type="submit" class="cancel-btn" style="width:100%;">
                Confirm Cancel
            </button>
        </form>

        <button onclick="closeModal()" style="margin-top:10px;width:100%;">
            Close
        </button>

    </div>

</div>

<script>
function openModal(orderId) {
    document.getElementById('cancelModal').style.display = 'flex';
    document.getElementById('cancelForm').action =
        "{{ url('/orders') }}/" + orderId + "/cancel";
}

function closeModal() {
    document.getElementById('cancelModal').style.display = 'none';
}
</script>

@endsection