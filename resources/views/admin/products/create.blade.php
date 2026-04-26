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
        max-width: 800px;
        margin: auto;
        padding: 30px;
    }

    /* TITLE */
    h1 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 20px;
        animation: fadeDown 0.4s ease;
    }

    /* FORM CARD */
    .card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 25px;

        backdrop-filter: blur(12px);

        animation: fadeUp 0.5s ease;
    }

    /* INPUTS */
    input, textarea, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 12px;

        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.15);

        background: rgba(0,0,0,0.3);
        color: white;

        outline: none;
        transition: 0.2s ease;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 10px rgba(59,130,246,0.3);
    }

    textarea {
        resize: none;
        height: 100px;
    }

    /* BUTTON */
    button {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;

        padding: 12px 18px;
        border-radius: 12px;

        cursor: pointer;
        font-weight: 600;

        transition: 0.2s ease;
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

    <h1>➕ Add Product</h1>

    <div class="card">

        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data">

            @csrf

            <input type="text" name="name" placeholder="Product Name" required>

            <input type="number" name="price" placeholder="Price" required>

            <input type="number" name="stock" placeholder="Stock" required>

            <textarea name="description" placeholder="Product Description"></textarea>

            <input type="file" name="image">

            <button type="submit">
                Save Product
            </button>

        </form>

    </div>

</div>

@endsection