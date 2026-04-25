@extends('admin.layouts.admin')

@section('content')

<h1>Add Category</h1>

<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Category Name"
           class="border p-2 w-full">

    <button class="bg-green-600 text-white px-4 py-2 mt-2">
        Save
    </button>
</form>

@endsection