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

    /* EMPTY STATE */
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

    <h1>Categories</h1>

    <div class="grid">

        @forelse($categories as $category)

            <div class="card">

                <h3>{{ $category->name }}</h3>

                @if($category->description)
                    <p>{{ $category->description }}</p>
                @else
                    <p>No description available</p>
                @endif

                <div class="meta">
                    Category ID: #{{ $category->id }}
                </div>

            </div>

        @empty

            <div class="empty">
                No categories found yet.
            </div>

        @endforelse

    </div>

</div>

@endsection