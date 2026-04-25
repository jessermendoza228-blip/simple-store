@extends('admin.layouts.admin')

@section('content')

<h3>Dashboard</h3>

<p>Total Products: {{ $totalProducts }}</p>
<p>Total Categories: {{ $totalCategories }}</p>
<p>Total Orders: {{ $totalOrders }}</p>
<p>Total Users: {{ $totalUsers }}</p>
<p>Total Revenue: {{ $totalRevenue }}</p>

@endsection