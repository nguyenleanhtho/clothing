{{-- resources/views/admin/categories/edit.blade.php --}}
@extends('admin.layouts.master')

@section('title', 'Sửa danh mục')

@section('content')
<div class="max-w-xl space-y-8">

    <div>
        <h1 class="text-3xl font-black tracking-tight">Cập nhật danh mục</h1>
        <p class="mt-1 text-xs uppercase tracking-widest text-gray-400">
            Chỉnh sửa thông tin danh mục
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white p-8 rounded-2xl border shadow-sm">
        <form action="{{ route('admin.categories.update', $category->id) }}"
              method="POST"
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                    Tên danh mục
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full border rounded-xl px-4 py-3 text-sm
                              focus:outline-none focus:ring-2 focus:ring-black/10 focus:border-black"
                       placeholder="Nhập tên danh mục"
                       required>

                @error('name')
                    <p class="text-red-500 text-xs mt-2 font-medium">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                        class="bg-black text-white px-6 py-3 rounded-xl
                               text-xs font-black uppercase tracking-widest
                               hover:bg-neutral-800 transition">
                    Cập nhật
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="px-6 py-3 rounded-xl border
                          text-xs font-bold uppercase tracking-widest
                          hover:bg-zinc-50 transition">
                    Hủy
                </a>
            </div>

        </form>
    </div>

</div>
@endsection
