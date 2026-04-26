@extends('layouts.admin')

@section('content')

<style>
body {
    margin: 0;
    font-family: ui-sans-serif, system-ui;
    background: radial-gradient(circle at top, #111827 0%, #0b1220 100%);
    color: #e5e7eb;
}

/* HEADER */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px;
    max-width: 1100px;
    margin: auto;
}

/* TITLE */
.top-bar h1 {
    font-size: 28px;
    font-weight: 800;
    animation: fadeDown 0.4s ease;
}

/* ADD BUTTON */
.add-btn {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: 0.25s ease;
    box-shadow: 0 10px 20px rgba(34,197,94,0.25);
    cursor: pointer;
}

.add-btn:hover {
    transform: translateY(-2px) scale(1.05);
}

/* GRID */
.grid {
    max-width: 1100px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 18px;
    padding: 0 30px 30px;
}

/* CARD */
.card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 20px;
    backdrop-filter: blur(12px);
    transition: 0.3s ease;
    animation: fadeUp 0.5s ease forwards;
    opacity: 0;
    transform: translateY(15px);
}

.card:hover {
    transform: translateY(-6px);
    border-color: rgba(59,130,246,0.4);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* TITLE */
.card h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
}

/* META */
.meta {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 6px;
}

/* DESCRIPTION */
.desc {
    font-size: 13px;
    color: #cbd5e1;
    margin-top: 10px;
}

/* ACTIONS */
.actions {
    margin-top: 18px;
    display: flex;
    gap: 10px;
}

/* EDIT */
.edit-btn {
    flex: 1;
    text-align: center;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    padding: 8px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    transition: 0.2s ease;
}

.edit-btn:hover {
    transform: scale(1.05);
}

/* DELETE */
.delete-btn {
    flex: 1;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    transition: 0.2s ease;
}

.delete-btn:hover {
    transform: scale(1.05);
}

/* EMPTY */
.empty {
    text-align: center;
    padding: 40px;
    color: #9ca3af;
}

/* MODAL */
.modal {
    display: none;
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal-box {
    background: #111827;
    padding: 25px;
    border-radius: 12px;
    width: 350px;
    animation: fadeUp 0.3s ease;
}

/* INPUT */
input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 8px;
    border: 1px solid #374151;
    background: #020617;
    color: #fff;
}

/* SAVE BUTTON */
.save-btn {
    width: 100%;
    margin-top: 12px;
    padding: 10px;
    background: #22c55e;
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}

/* ANIMATION */
@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

{{-- TOP BAR --}}
<div class="top-bar">
    <h1>📂 Categories</h1>

    {{-- CHANGE: now opens modal --}}
    <button class="add-btn" onclick="openModal()">
        + Add Category
    </button>
</div>

{{-- GRID --}}
<div class="grid">

    @forelse($categories as $category)

        <div class="card">

            <h3>{{ $category->name }}</h3>

            <div class="meta">
                ID: {{ $category->id }}
            </div>

            <div class="desc">
                {{ $category->description ?? 'No description available' }}
            </div>

            <div class="actions">

                <a href="{{ route('admin.categories.edit', $category->id) }}"
                   class="edit-btn">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('admin.categories.destroy', $category->id) }}"
                      style="flex:1;"
                      onsubmit="return confirm('Delete this category?')">

                    @csrf
                    @method('DELETE')

                    <button class="delete-btn">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="empty">
            No categories found
        </div>

    @endforelse

</div>

{{-- ADD CATEGORY MODAL --}}
<div id="categoryModal" class="modal">

    <div class="modal-box">

        <h3>Add Category</h3>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <input type="text" name="name" placeholder="Category Name" required>

            <textarea name="description" placeholder="Description"></textarea>

            <button class="save-btn">Save</button>
        </form>

        <button onclick="closeModal()" style="margin-top:10px;width:100%;background:#ef4444;color:white;border:none;padding:8px;border-radius:8px;">
            Cancel
        </button>

    </div>

</div>

<script>
function openModal() {
    document.getElementById('categoryModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('categoryModal').style.display = 'none';
}
</script>

@endsection