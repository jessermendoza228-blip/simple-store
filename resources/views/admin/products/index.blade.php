<!DOCTYPE html>
<html>
<head>
    <title>Admin Products</title>

    <style>
        body { font-family: Arial; margin: 20px; }

        .btn {
            background: green;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }

        .actions a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h1>Products</h1>

<a href="{{ route('admin.products.create') }}" class="btn">
    + Add Product
</a>

<div class="grid">

@foreach($products as $product)

    <div class="card">
        <h3>{{ $product->name }}</h3>
        <p>₱{{ $product->price }}</p>
        <p>Stock: {{ $product->stock }}</p>

        <div class="actions">
            <a href="{{ route('admin.products.edit', $product->id) }}">
                Edit
            </a>

            <form method="POST"
                  action="{{ route('admin.products.destroy', $product->id) }}"
                  style="display:inline;">
                @csrf
                @method('DELETE')

                <button onclick="return confirm('Delete this product?')">
                    Delete
                </button>
            </form>
        </div>
    </div>

@endforeach

</div>

</body>
</html>