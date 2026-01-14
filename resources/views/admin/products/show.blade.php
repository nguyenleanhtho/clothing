@extends('admin.layouts.master')

@section('title', 'Chi tiết sản phẩm - ' . $product->name)

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-black">{{ $product->name }}</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.edit', $product) }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase hover:bg-blue-700">
                <i class="fa fa-edit"></i> Sửa
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase hover:bg-gray-700">
                ← Quay lại
            </a>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- Ảnh sản phẩm -->
        <div class="col-span-2 bg-white border rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold mb-4">Hình ảnh</h2>
            
            @if($product->images && count($product->images) > 0)
                <div class="grid grid-cols-3 gap-4">
                    @foreach($product->images as $image)
                        <div class="w-full aspect-square rounded-lg border overflow-hidden bg-gray-100 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $image->img_url) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-100 p-8 text-center rounded-lg">
                    <i class="fa fa-image text-gray-300" style="font-size: 48px; display: block; margin-bottom: 12px;"></i>
                    <p class="text-gray-500 font-medium">Chưa có ảnh sản phẩm</p>
                </div>
            @endif
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="bg-white border rounded-2xl shadow-sm p-6 space-y-4">
            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold">Danh mục</p>
                <p class="text-lg font-bold">{{ $product->category->name ?? '-' }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold">Giá</p>
                <p class="text-2xl font-bold text-blue-600">{{ number_format($product->price) }} đ</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold">Kho hàng</p>
                <p class="text-lg font-bold @if($product->stock <= 0) text-red-600 @elseif($product->stock <= 10) text-orange-600 @else text-green-600 @endif">
                    {{ $product->stock }} 
                    @if($product->stock <= 0)
                        <span class="text-sm">(Hết hàng)</span>
                    @elseif($product->stock <= 10)
                        <span class="text-sm">(Sắp hết)</span>
                    @endif
                </p>
            </div>

            <div class="border-t pt-4">
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-2">ID</p>
                <p class="text-sm font-mono bg-gray-100 p-2 rounded">{{ $product->id }}</p>
            </div>

            <div class="border-t pt-4">
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-2">Slug</p>
                <p class="text-sm font-mono bg-gray-100 p-2 rounded break-all">{{ $product->slug }}</p>
            </div>

            <div class="border-t pt-4">
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-2">Ngày tạo</p>
                <p class="text-sm">{{ $product->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="border-t pt-4">
                <p class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-2">Cập nhật</p>
                <p class="text-sm">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Mô tả sản phẩm -->
    <div class="bg-white border rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold mb-4">Mô tả</h2>
        <div class="prose max-w-none">
            @if($product->description)
                {!! nl2br(e($product->description)) !!}
            @else
                <p class="text-gray-500">Chưa có mô tả</p>
            @endif
        </div>
    </div>

</div>
@endsection
