@extends('admin.layouts.admin')

@section('content')

<h3>Add Product</h3>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Product name"><br><br>

    <input type="number" name="price" placeholder="Price"><br><br>

    <input type="number" name="stock" placeholder="Stock"><br><br>

    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <input type="file" name="image">

    <br><br>

    <button type="submit">Save</button>
</form>
@endsection