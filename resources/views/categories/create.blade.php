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
    max-width: 600px;
    margin: auto;
    padding: 40px;
}

/* CARD */
.card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 25px;
    backdrop-filter: blur(12px);
}

/* TITLE */
h1 {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 20px;
}

/* INPUT */
input, textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    border-radius: 10px;
    border: 1px solid #374151;
    background: #111827;
    color: #fff;
}

/* BUTTON */
.btn {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.btn:hover {
    transform: scale(1.02);
}
</style>

<div class="container">

    <div class="card">

        <h1>Add Category</h1>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <input type="text" name="name" placeholder="Category Name" required>

            <textarea name="description" placeholder="Description (optional)"></textarea>

            <button class="btn">Save Category</button>

        </form>

    </div>

</div>

@endsection