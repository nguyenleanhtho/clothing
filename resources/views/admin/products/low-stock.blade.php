@extends('admin.layouts.master')

@section('title', 'Sản phẩm sắp hết hàng')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-black">Sản phẩm sắp hết hàng (≤10 cái)</h1>
        <a href="{{ route('admin.products.index') }}"
           class="bg-gray-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase">
            ← Quay lại
        </a>
    </div>

    @if(count($products) > 0)
        <div class="overflow-x-auto bg-white border rounded-2xl shadow-sm">
            <table class="w-full text-sm">
                <thead class="bg-red-50 border-b">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3">Ảnh</th>
                        <th class="p-3 text-left">Tên sản phẩm</th>
                        <th class="p-3">Danh mục</th>
                        <th class="p-3 text-right">Giá</th>
                        <th class="p-3 text-center bg-red-100">Kho</th>
                        <th class="p-3">Trạng thái</th>
                        <th class="p-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3 text-center font-medium">{{ $product->id }}</td>
                            <td class="p-3 text-center">
                                @if ($product->primaryImage)
                                    <img src="{{ $product->primaryImage->url }}" class="w-12 h-12 object-cover mx-auto rounded">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-3 font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td class="p-3 text-center">{{ $product->category->name ?? '-' }}</td>
                            <td class="p-3 text-right">{{ number_format($product->price) }} đ</td>
                            <td class="p-3 text-center font-bold bg-red-50">
                                <span class="text-lg">{{ $product->stock }}</span>
                            </td>
                            <td class="p-3 text-center">
                                @if($product->stock <= 0)
                                    <span class="badge badge-danger" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 3px; font-size: 11px;">
                                        <i class="fa fa-times-circle"></i> Hết hàng
                                    </span>
                                @elseif($product->stock <= 5)
                                    <span class="badge badge-danger" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 3px; font-size: 11px;">
                                        <i class="fa fa-exclamation"></i> Cực kỳ hạn
                                    </span>
                                @else
                                    <span class="badge badge-warning" style="background-color: #ffc107; color: black; padding: 5px 10px; border-radius: 3px; font-size: 11px;">
                                        <i class="fa fa-exclamation-triangle"></i> Cảnh báo
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.products.show', $product) }}" class="text-green-600 hover:underline font-medium">Xem</a> |
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline font-medium">
                                    Cập nhật kho
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-green-50 border border-green-200 rounded-2xl p-8 text-center">
            <i class="fa fa-check-circle text-green-500" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
            <h3 class="text-xl font-bold text-green-800 mb-2">Tất cả sản phẩm đều có đủ kho</h3>
            <p class="text-green-600">Không có sản phẩm nào sắp hết hàng!</p>
        </div>
    @endif

</div>
@endsection
