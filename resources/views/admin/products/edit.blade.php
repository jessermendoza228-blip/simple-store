@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Product</h1>

<form method="POST"
      action="{{ route('admin.products.update', $product->id) }}"
      enctype="multipart/form-data"
      class="space-y-3">

    @csrf
    @method('PUT')

    <input type="text" name="name"
           value="{{ $product->name }}"
           class="border p-2 w-full">

    <input type="number" name="price"
           value="{{ $product->price }}"
           class="border p-2 w-full">

    <input type="number" name="stock"
           value="{{ $product->stock }}"
           class="border p-2 w-full">

    <textarea name="description"
              class="border p-2 w-full">{{ $product->description }}</textarea>

    <input type="file" name="image"
           class="border p-2 w-full">

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Update Product
    </button>

</form>

@endsection