@extends('layouts.admin')

@section('content')

<style>
body {
    margin: 0;
    font-family: ui-sans-serif, system-ui;
    background: radial-gradient(circle at top, #0f172a 0%, #0b1220 100%);
    color: #e5e7eb;
}

/* PAGE WRAPPER */
.container {
    max-width: 1100px;
    margin: auto;
    padding: 30px;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;

    animation: fadeDown 0.5s ease;
}

.header h1 {
    font-size: 28px;
    font-weight: 800;
    color: #ffffff;
}

/* ADD BUTTON */
.add-btn {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(34,197,94,0.2);
}

.add-btn:hover {
    transform: translateY(-3px) scale(1.05);
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
    padding: 20px;

    backdrop-filter: blur(12px);

    transition: 0.3s ease;
    animation: fadeUp 0.5s ease forwards;
    opacity: 0;
    transform: translateY(15px);
}

.card:hover {
    transform: translateY(-8px);
    border-color: rgba(59,130,246,0.5);
    box-shadow: 0 15px 40px rgba(0,0,0,0.5);
}

/* TEXT (FIXED VISIBILITY) */
.card h3 {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff; /* FIXED */
}

.card p {
    font-size: 13px;
    color: #d1d5db; /* FIXED VISIBILITY */
    margin-top: 8px;
}

/* BADGE */
.badge {
    display: inline-block;
    margin-top: 10px;
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 999px;
    background: rgba(59,130,246,0.15);
    color: #ffffff;
    border: 1px solid rgba(59,130,246,0.3);
}

/* EMPTY */
.empty {
    text-align: center;
    padding: 40px;
    color: #9ca3af;
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

    {{-- HEADER --}}
    <div class="header">
        <h1>📂 Categories</h1>

        <a href="{{ route('admin.categories.create') }}" class="add-btn">
            + Add Category
        </a>
    </div>

    {{-- GRID --}}
    <div class="grid">

        @forelse($categories as $category)

            <div class="card">

                <h3>{{ $category->name }}</h3>

                <p>{{ $category->description ?? 'No description available' }}</p>

                <span class="badge">
                    ID: {{ $category->id }}
                </span>

            </div>

        @empty

            <div class="empty">
                No categories found
            </div>

        @endforelse

    </div>

</div>

@endsection