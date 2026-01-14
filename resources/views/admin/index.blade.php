@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-10 text-black">

    <!-- Header -->
    <div class="flex items-end justify-between">
        <div>
            <h1 class="text-4xl font-black tracking-tight">Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">Tổng quan hệ thống bán hàng</p>
        </div>
        <span class="text-xs uppercase tracking-widest text-gray-400">
            {{ now()->format('d/m/Y') }}
        </span>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border rounded-2xl p-6">
            <div class="text-xs uppercase text-gray-400 mb-2">Doanh thu</div>
            <div class="text-3xl font-black">{{ number_format($stats['revenue']) }} đ</div>
            <p class="text-xs text-green-600 mt-2">Đơn hoàn thành</p>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <div class="text-xs uppercase text-gray-400 mb-2">Đơn hàng hôm nay</div>
            <div class="text-3xl font-black">{{ $stats['ordersToday'] }}</div>
            <p class="text-xs text-gray-500 mt-2">Tổng: {{ $stats['totalOrders'] }} đơn</p>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <div class="text-xs uppercase text-gray-400 mb-2">Sản phẩm</div>
            <div class="text-3xl font-black">{{ $stats['products'] }}</div>
            <p class="text-xs text-gray-500 mt-2">{{ $stats['categories'] }} danh mục</p>
        </div>

        <div class="bg-white border rounded-2xl p-6">
            <div class="text-xs uppercase text-gray-400 mb-2">Tồn kho</div>
            <div class="text-3xl font-black">{{ $stats['inventory'] }}</div>
        </div>
    </div>

    <!-- Recent orders -->
    <div class="bg-white border rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="font-black text-lg">Đơn hàng gần đây</h2>
            <a href="{{ route('admin.orders.index') }}"
               class="text-sm text-blue-600 hover:underline">
                Xem tất cả
            </a>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Khách hàng</th>
                    <th class="p-3 text-left">Trạng thái</th>
                    <th class="p-3 text-right">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentOrders as $order)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">#{{ $order->id }}</td>
                    <td class="p-3">{{ $order->user->name }}</td>
                    <td class="p-3">{{ $order->status_text }}</td>
                    <td class="p-3 text-right">
                        {{ number_format($order->total_price) }} đ
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
