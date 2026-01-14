@extends('admin.layouts.master')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="max-w-xl space-y-8">

    <div>
        <h1 class="text-3xl font-black">Thêm sản phẩm mới</h1>
    </div>

    <div class="bg-white p-8 rounded-2xl border shadow-sm">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-1">Danh mục</label>
                <select name="category_id" class="w-full border rounded-xl px-4 py-2" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Tên sản phẩm</label>
                <input type="text" name="name" class="w-full border rounded-xl px-4 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Giá</label>
                <input type="number" name="price" class="w-full border rounded-xl px-4 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Số lượng</label>
                <input type="number" name="stock" class="w-full border rounded-xl px-4 py-2" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Mô tả</label>
                <textarea name="description" rows="4" class="w-full border rounded-xl px-4 py-2"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Ảnh sản phẩm</label>
                <input type="file" name="images[]" multiple class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="flex gap-4 pt-4">
                <button class="bg-black text-white px-6 py-3 rounded-xl text-xs font-black uppercase">
                    Lưu
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border rounded-xl">
                    Hủy
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
