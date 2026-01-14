{{-- resources/views/admin/categories/create.blade.php --}}
@extends('admin.layouts.master')

@section('title', 'Thêm danh mục')

@section('content')
<div class="max-w-xl space-y-8">

    <div>
        <h1 class="text-3xl font-black tracking-tight">Thêm danh mục</h1>
        <p class="mt-1 text-xs uppercase tracking-widest text-gray-400">
            Tạo mới một danh mục sản phẩm
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white p-8 rounded-2xl border shadow-sm">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                    Tên danh mục
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
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
                    Lưu
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="px-6 py-3 rounded-xl border
                          text-xs font-bold uppercase tracking-widest
                          hover:bg-zinc-50 transition">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
