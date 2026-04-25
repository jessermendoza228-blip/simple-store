@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Product</h1>

<form method="POST"
      action="{{ route('admin.products.store') }}"
      enctype="multipart/form-data"
      class="space-y-3">

    @csrf

    <input type="text" name="name" placeholder="Product Name"
           class="border p-2 w-full">

    <input type="number" name="price" placeholder="Price"
           class="border p-2 w-full">

    <input type="number" name="stock" placeholder="Stock"
           class="border p-2 w-full">

    <textarea name="description" placeholder="Description"
              class="border p-2 w-full"></textarea>

    <input type="file" name="image"
           class="border p-2 w-full">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Save Product
    </button>

</form>

@endsection@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Product</h1>

<form method="POST"
      action="{{ route('admin.products.store') }}"
      enctype="multipart/form-data"
      class="space-y-3">

    @csrf

    <input type="text" name="name" placeholder="Product Name"
           class="border p-2 w-full">

    <input type="number" name="price" placeholder="Price"
           class="border p-2 w-full">

    <input type="number" name="stock" placeholder="Stock"
           class="border p-2 w-full">

    <textarea name="description" placeholder="Description"
              class="border p-2 w-full"></textarea>

    <input type="file" name="image"
           class="border p-2 w-full">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Save Product
    </button>

</form>

@endsection