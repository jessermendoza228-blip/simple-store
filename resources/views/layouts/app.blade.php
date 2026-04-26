<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JMStore</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ REQUIRED FOR AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
         background: radial-gradient(circle at top, #1f2937 0%, #0f172a 100%);
    color: #e5e7eb;
    font-family: ui-sans-serif, system-ui;
}

.card {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    border-color: rgba(59,130,246,0.4);
}

.btn {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    padding: 10px 16px;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    border: none;
    transition: 0.2s ease;
}

.btn:hover {
    transform: scale(1.05);
}
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f6f7fb;
            color: #111;
        }

        .nav {
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.7);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            background: linear-gradient(135deg,#6366f1,#ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search {
            flex: 1;
            margin: 0 20px;
            display: flex;
        }

        .search input {
            width: 100%;
            padding: 10px;
            border-radius: 10px 0 0 10px;
            border: 1px solid #ddd;
        }

        .search button {
            padding: 10px 14px;
            border: none;
            background: #6366f1;
            color: white;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
        }

        .nav-links {
            display: flex;
            gap: 16px;
        }

        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>

<body>

<!-- NAV -->
<div class="nav">
    <div class="container">

        <div class="logo">JMSTORE</div>

        <form class="search" method="GET" action="{{ route('products.index') }}">
            <input type="text" name="search" placeholder="Search products...">
            <button>Search</button>
        </form>

        <div class="nav-links">
            <a href="{{ route('products.index') }}">Shop</a>

            @auth
                <a href="{{ route('orders.index') }}">Orders</a>
                <a href="{{ route('cart.index') }}">Cart</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>

    </div>
</div>

<!-- CONTENT -->
<main style="max-width:1200px;margin:auto;padding:30px;">
    @yield('content')
</main>

<!-- TOAST CONTAINER -->
<div class="toast-container"></div>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ TOAST FUNCTION (ONLY ONCE) -->
<script>
function showToast(message, type) {

    const toast = document.createElement('div');


    toast.className =
        'toast align-items-center text-bg-' +
        (type === 'success' ? 'success' : 'danger') +
        ' border-0';


    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    document.querySelector('.toast-container').appendChild(toast);

    new bootstrap.Toast(toast, { delay: 3000 }).show();
}
</script>

<!-- ✅ AJAX CHECKOUT (CLEAN & SINGLE) -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('checkoutForm');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        try {
            const res = await fetch("{{ route('checkout.store') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await res.json();

            showToast(data.message, data.status);

            if (data.status === 'success') {
                setTimeout(() => location.reload(), 1000);
            }

        } catch (err) {
            showToast('Server error', 'error');
        }
    });

});
</script>

</body>
</html>