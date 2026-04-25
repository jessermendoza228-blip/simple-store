@extends('layouts.admin')

@section('content')

<h1>Create Category</h1>

<form method="POST"
action="{{ route('admin.categories.store') }}">

@csrf

<input type="text"
name="name"
placeholder="Category Name">

<button>Create</button>

</form>

@endsection