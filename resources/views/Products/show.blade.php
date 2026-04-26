@extends('layouts.app')

@section('content')

<style>
    body {
        margin: 0;
        font-family: ui-sans-serif, system-ui;
        background: radial-gradient(circle at top, #111827 0%, #0b1220 100%);
        color: #e5e7eb;
    }

    .container {
        max-width: 1000px;
        margin: auto;
        padding: 30px;
    }

    /* PRODUCT CARD */
    .product-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;

        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;

        backdrop-filter: blur(12px);
        padding: 25px;

        animation: fadeUp 0.5s ease;
    }

    /* IMAGE BOX */
    .image-box {
        height: 350px;
        border-radius: 16px;
        background: rgba(255,255,255,0.05);
        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 70px;
        transition: 0.3s ease;
    }

    .image-box:hover {
        transform: scale(1.02);
    }

    /* PRODUCT INFO */
    h2 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .price {
        font-size: 22px;
        font-weight: 700;
        color: #60a5fa;
        margin-bottom: 15px;
    }

    .desc {
        color: #9ca3af;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* FORM */
    input {
        padding: 10px;
        width: 80px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.2);
        background: rgba(0,0,0,0.3);
        color: white;
        outline: none;
    }

    button {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        margin-left: 10px;
        cursor: pointer;
        transition: 0.2s ease;
        font-weight: 600;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59,130,246,0.3);
    }

    /* ANIMATION */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* MOBILE */
    @media (max-width: 768px) {
        .product-card {
            grid-template-columns: 1fr;
        }

        .image-box {
            height: 250px;
        }
    }
</style>

<div class="container">

    <div class="product-card">

        {{-- IMAGE --}}
        <div class="image-box">
            🛍️
        </div>

        {{-- INFO --}}
        <div>

            <h2>{{ $product->name }}</h2>

            <div class="price">
                ₱{{ number_format($product->price, 2) }}
            </div>

            <p class="desc">
                {{ $product->description }}
            </p>

            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf

                <input type="number" name="quantity" value="1" min="1">

                <button type="submit">
                    Add to Cart
                </button>
            </form>

        </div>

    </div>

</div>

@endsection