@extends('admin.layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Categories</h1>

<a href="{{ route('admin.categories.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded">
    Add Category
</a>

<table class="w-full mt-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Name</th>
            <th class="p-2">Slug</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $category)
        <tr class="border-b">
            <td class="p-2">{{ $category->name }}</td>
            <td class="p-2">{{ $category->slug }}</td>
            <td class="p-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}"
                   class="text-yellow-600">Edit</a>

                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                      method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection