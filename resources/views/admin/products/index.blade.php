@extends('admin.layouts.master')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-black">Danh sách sản phẩm</h1>
        <a href="{{ route('admin.products.create') }}"
           class="bg-black text-white px-6 py-3 rounded-xl text-xs font-black uppercase">
            + Thêm sản phẩm
        </a>
    </div>

    <div class="overflow-x-auto bg-white border rounded-2xl shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3">Ảnh</th>
                    <th class="p-3 text-left">Tên</th>
                    <th class="p-3">Danh mục</th>
                    <th class="p-3">Giá</th>
                    <th class="p-3">Kho</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 text-center">{{ $product->id }}</td>
                        <td class="p-3 text-center">
                            @if ($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->img_url) }}" class="w-12 h-12 object-cover mx-auto">
                            @endif
                        </td>
                        <td class="p-3 font-medium">{{ $product->name }}</td>
                        <td class="p-3 text-center">{{ $product->category->name ?? '-' }}</td>
                        <td class="p-3 text-right">{{ number_format($product->price) }} đ</td>
                        <td class="p-3 text-center">{{ $product->stock }}</td>
                        <td class="p-3 text-center space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Xóa sản phẩm?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-400">
                            Chưa có sản phẩm
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
