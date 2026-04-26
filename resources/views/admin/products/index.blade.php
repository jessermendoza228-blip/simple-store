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
        margin-bottom: 20px;
        color: #ffffff;
        animation: fadeDown 0.4s ease;
    }

    /* ADD BUTTON */
    .btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 14px;
        border-radius: 10px;
        background: rgba(59,130,246,0.2);
        border: 1px solid rgba(59,130,246,0.4);
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        transition: 0.2s ease;
    }

    .btn:hover {
        background: rgba(59,130,246,0.35);
        transform: translateY(-2px);
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
        border-radius: 16px;
        padding: 18px;
        backdrop-filter: blur(12px);

        transition: 0.25s ease;
        animation: fadeUp 0.5s ease forwards;

        opacity: 0;
        transform: translateY(10px);
    }

    .card:hover {
        transform: translateY(-6px);
        border-color: rgba(59,130,246,0.4);
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    }

    .card h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #ffffff;
    }

    .card p {
        margin: 6px 0;
        font-size: 14px;
        color: #cbd5e1;
    }

    .meta {
        margin-top: 10px;
        font-size: 12px;
        color: #9ca3af;
    }

    /* ACTIONS */
    .actions {
        margin-top: 12px;
        display: flex;
        gap: 10px;
    }

    .actions a {
        flex: 1;
        text-align: center;
        padding: 6px;
        border-radius: 8px;
        font-size: 12px;
        text-decoration: none;
        background: rgba(59,130,246,0.25);
        color: #ffffff;
        border: 1px solid rgba(59,130,246,0.4);
        transition: 0.2s ease;
    }

    .actions a:hover {
        transform: scale(1.05);
    }

    .actions button {
        flex: 1;
        background: rgba(239,68,68,0.2);
        border: 1px solid rgba(239,68,68,0.4);
        color: #ffffff;
        padding: 6px;
        border-radius: 8px;
        font-size: 12px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .actions button:hover {
        transform: scale(1.05);
    }

    /* EMPTY */
    .empty {
        text-align: center;
        padding: 40px;
        color: #9ca3af;
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    /* ANIMATIONS */
    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container">

    <h1>📦 Products</h1>

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
                    ID: #{{ $product->id }}
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