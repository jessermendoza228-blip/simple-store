@extends('layouts.admin')

@section('content')

<h1>Edit Category</h1>

<form method="POST"
action="{{ route('admin.categories.update',$category->id) }}">

@csrf
@method('PUT')

<input type="text"
name="name"
value="{{ $category->name }}">

<button>Update</button>

</form>

@endsection