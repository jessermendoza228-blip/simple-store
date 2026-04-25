<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <div class="w-64 bg-gray-900 text-white min-h-screen p-5">

        <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>

        <ul class="space-y-3">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="block p-2 rounded hover:bg-gray-700">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products.index') }}"
                   class="block p-2 rounded hover:bg-gray-700">
                    Products
                </a>
            </li>

            <li>
                <a href="{{ route('admin.categories.index') }}"
                   class="block p-2 rounded hover:bg-gray-700">
                    Categories
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders.index') }}"
                   class="block p-2 rounded hover:bg-gray-700">
                    Orders
                </a>
            </li>

            <li class="mt-6">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full text-left p-2 rounded bg-red-600 hover:bg-red-700">
                        Logout
                    </button>
                </form>

            </li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-6">

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </div>

</div>

</body>
</html>