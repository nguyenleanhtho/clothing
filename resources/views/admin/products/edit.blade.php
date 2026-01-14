@extends('admin.layouts.master')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="max-w-xl space-y-8">

    <h1 class="text-3xl font-black">Cập nhật sản phẩm</h1>

    <div class="bg-white p-8 rounded-2xl border shadow-sm">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold mb-1">Danh mục</label>
                <select name="category_id" class="w-full border rounded-xl px-4 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded-xl px-4 py-2">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Giá</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded-xl px-4 py-2">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Số lượng</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded-xl px-4 py-2">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Mô tả</label>
                <textarea name="description" rows="4" class="w-full border rounded-xl px-4 py-2">{{ $product->description }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Ảnh sản phẩm</label>
                <div class="flex gap-3 flex-wrap mb-3">
                    @foreach ($product->images as $img)
                        <div class="relative border p-2 rounded hover:bg-red-50 transition">
                            <img src="{{ asset('storage/'.$img->img_url) }}" class="w-24 h-24 object-cover rounded">
                            <label class="absolute top-1 left-1 flex items-center">
                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" 
                                       class="w-4 h-4 cursor-pointer" title="Chọn để xóa">
                            </label>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500 mb-3">Chọn checkbox trên ảnh để xóa</p>

                <input type="file" name="images[]" multiple class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="flex gap-4 pt-4">
                <button class="bg-black text-white px-6 py-3 rounded-xl text-xs font-black uppercase">
                    Cập nhật
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border rounded-xl">
                    Hủy
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
