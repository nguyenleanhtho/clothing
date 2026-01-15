@extends('admin.layouts.master')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-black">Danh sách sản phẩm</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.lowStock') }}"
               class="bg-red-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase hover:bg-red-700">
                <i class="fa fa-exclamation-triangle"></i> Sắp hết hàng
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="bg-black text-white px-6 py-3 rounded-xl text-xs font-black uppercase">
                + Thêm sản phẩm
            </a>
        </div>
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
                    <th class="p-3 text-center">Kho</th>
                    <th class="p-3 text-center">Trạng thái</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 text-center">{{ $product->id }}</td>
                        <td class="p-3 text-center">
                            @if ($product->primaryImage)
                                <img src="{{ $product->primaryImage->url }}" class="w-12 h-12 object-cover mx-auto">
                            @endif
                        </td>
                        <td class="p-3 font-medium">{{ $product->name }}</td>
                        <td class="p-3 text-center">{{ $product->category->name ?? '-' }}</td>
                        <td class="p-3 text-right">{{ number_format($product->price) }} đ</td>
                        <td class="p-3 text-center font-bold">
                            <span @if($product->stock <= 0) class="text-red-600" @elseif($product->stock <= 10) class="text-orange-600" @else class="text-green-600" @endif>
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            @if($product->stock <= 0)
                                <span style="background-color: #dc3545; color: white; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold;">
                                    <i class="fa fa-times-circle"></i> HẾT HÀNG
                                </span>
                            @elseif($product->stock <= 5)
                                <span style="background-color: #dc3545; color: white; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold;">
                                    <i class="fa fa-exclamation"></i> CỰC KỲ HẠN
                                </span>
                            @elseif($product->stock <= 10)
                                <span style="background-color: #ffc107; color: black; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold;">
                                    <i class="fa fa-exclamation-triangle"></i> CẢNH BÁO
                                </span>
                            @else
                                <span style="background-color: #28a745; color: white; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold;">
                                    <i class="fa fa-check-circle"></i> BÌNH THƯỜNG
                                </span>
                            @endif
                        </td>
                        <td class="p-3 text-center space-x-2">
                            <a href="{{ route('admin.products.show', $product) }}" class="text-green-600 hover:underline">Xem</a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Xóa sản phẩm?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-6 text-center text-gray-400">
                            Chưa có sản phẩm
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
