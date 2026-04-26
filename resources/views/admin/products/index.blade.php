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

    /* TITLE */
    h1 {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 25px;
    }

    /* GRID */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 18px;
    }

    /* CARD */
    .card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 18px;
        backdrop-filter: blur(12px);
        transition: 0.25s ease;

        opacity: 0;
        transform: translateY(10px);
        animation: fadeUp 0.5s ease forwards;
    }

    .card:hover {
        transform: translateY(-6px);
        border-color: rgba(59,130,246,0.4);
    }

    .card h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .card p {
        color: #9ca3af;
        font-size: 14px;
        margin-top: 8px;
        line-height: 1.4;
    }

    .meta {
        margin-top: 12px;
        font-size: 12px;
        color: #6b7280;
    }

    /* BUTTONS */
    .btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 14px;
        border-radius: 10px;
        background: rgba(59,130,246,0.2);
        border: 1px solid rgba(59,130,246,0.4);
        color: #93c5fd;
        text-decoration: none;
        font-size: 14px;
        transition: 0.2s ease;
    }

    .btn:hover {
        background: rgba(59,130,246,0.35);
        transform: translateY(-2px);
    }

    .actions {
        margin-top: 12px;
        display: flex;
        gap: 10px;
    }

    .actions a {
        font-size: 12px;
        color: #60a5fa;
        text-decoration: none;
    }

    .actions a:hover {
        text-decoration: underline;
    }

    .actions button {
        background: transparent;
        border: 1px solid rgba(239,68,68,0.5);
        color: #f87171;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .actions button:hover {
        background: rgba(239,68,68,0.15);
    }

    /* EMPTY */
    .empty {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 40px;
        text-align: center;
        border-radius: 18px;
        color: #9ca3af;
    }

    /* ANIMATION */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container">

    <h1>Products</h1>

    <a href="{{ route('admin.products.create') }}" class="btn">
        + Add Product
    </a>

    <div class="grid">

        @forelse($products as $product)

            <div class="card">

                <h3>{{ $product->name }}</h3>

                <p>Price: ₱{{ $product->price }}</p>
                <p>Stock: {{ $product->stock }}</p>

                @if($product->category)
                    <p>Category: {{ $product->category->name }}</p>
                @endif

                <div class="meta">
                    Product ID: #{{ $product->id }}
                </div>

                <div class="actions">

                    <a href="{{ route('admin.products.edit', $product->id) }}">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('admin.products.destroy', $product->id) }}"
                          onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                No products found yet.
            </div>

        @endforelse

    </div>

</div>

@endsection