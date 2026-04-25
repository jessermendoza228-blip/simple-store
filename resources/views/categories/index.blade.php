@extends('layouts.admin')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1>Categories</h1>

    <a href="{{ route('admin.categories.create') }}"
       style="background:green; color:white; padding:8px 12px; text-decoration:none; border-radius:5px;">
        + Add Category
    </a>
</div>

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#f2f2f2;">
            <th style="padding:10px; border:1px solid #ddd;">ID</th>
            <th style="padding:10px; border:1px solid #ddd;">Name</th>
            <th style="padding:10px; border:1px solid #ddd;">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($categories as $category)
        <tr>
            <td style="padding:10px; border:1px solid #ddd;">
                {{ $category->id }}
            </td>

            <td style="padding:10px; border:1px solid #ddd;">
                {{ $category->name }}
            </td>

            <td style="padding:10px; border:1px solid #ddd;">

                <a href="{{ route('admin.categories.edit', $category->id) }}"
                   style="color:blue; margin-right:10px;">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('admin.categories.destroy', $category->id) }}"
                      style="display:inline;"
                      onsubmit="return confirm('Delete this category?')">

                    @csrf
                    @method('DELETE')

                    <button style="background:red; color:white; border:none; padding:5px 8px; border-radius:4px;">
                        Delete
                    </button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="padding:10px; text-align:center;">
                No categories found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection