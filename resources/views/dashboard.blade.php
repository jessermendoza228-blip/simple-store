<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <p>Welcome, {{ Auth::user()->name }} 👋</p>

    <hr>

    <h2>System Overview</h2>

    <ul>
        <li>Total Users: (coming soon)</li>
        <li>Total Products: (coming soon)</li>
        <li>Total Orders: (coming soon)</li>
    </ul>

    <hr>

    <a href="{{ route('products.index') }}">Go to Products Page</a>

</body>
</html>