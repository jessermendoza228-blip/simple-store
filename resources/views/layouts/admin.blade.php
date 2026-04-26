<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        /* ===== GLOBAL ===== */
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui;
            background: #0b1220; /* deep modern dark */
            color: #e5e7eb;
        }

        /* ===== LAYOUT ===== */
        .flex {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        aside {
            width: 260px;
            background: #0f172a;
            border-right: 1px solid rgba(255,255,255,0.08);
            padding: 20px;
        }

        aside h1 {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 20px;
        }

        nav a {
            display: block;
            padding: 10px 12px;
            border-radius: 10px;
            color: #cbd5e1 !important;
            text-decoration: none;
            transition: 0.2s ease;
            font-weight: 500;
        }

        nav a:hover {
            background: rgba(59,130,246,0.25);
            color: #ffffff !important;
            transform: translateX(4px);
        }

        /* ===== MAIN AREA ===== */
        main {
            flex: 1;
            padding: 30px;
            background: radial-gradient(circle at top, #111827, #0b1220);
            color: #e5e7eb;
        }

        /* ===== CARDS ===== */
        .card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 16px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        /* ===== SUCCESS MESSAGE ===== */
        .success-box {
            background: rgba(34,197,94,0.15);
            border: 1px solid rgba(34,197,94,0.3);
            color: #22c55e;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        /* ===== FORM FIX (IMPORTANT) ===== */
        input,
        textarea,
        select {
            color: #000 !important;         /* TEXT ALWAYS VISIBLE */
            background: #ffffff !important;
            border-radius: 8px;
            padding: 8px;
            border: 1px solid #d1d5db;
        }

        option {
            color: #000 !important;
            background: #ffffff !important;
        }

        label {
            color: #e5e7eb;
        }

        /* ===== BUTTONS ===== */
        button {
            cursor: pointer;
        }

        /* ===== ANIMATION ===== */
        main {
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>

<body>

<div class="flex">

    <!-- SIDEBAR -->
    <aside>

        <h1>Admin Panel</h1>

        <nav>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}">Products</a>
            <a href="{{ route('admin.categories.index') }}">Categories</a>
            <a href="{{ route('admin.orders.index') }}">Orders</a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main>

        @if(session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>