@extends('admin.layouts.admin')

@section('content')

<h2 class="text-xl font-bold mb-4">Edit Category</h2>

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @method('PUT')

    <input type="text" name="name"
           value="{{ $category->name }}"
           class="w-full border p-2 rounded">

    <button class="bg-yellow-500 text-white px-4 py-2 rounded">
        Update Category
    </button>

</form>

@endsection