@extends('admin.layouts.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="space-y-6 max-w-4xl">

    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-black">Chi tiết đơn hàng #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 border rounded-xl text-sm">← Quay lại danh sách</a>
    </div>

    <div class="bg-white border rounded-2xl p-6 space-y-2">
        <p><strong>Khách hàng:</strong> {{ $order->user->name }}</p>
        <div class="flex items-center gap-3">
            <p class="m-0"><strong>Trạng thái:</strong> {{ $order->status_text }}</p>
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="inline-flex items-center gap-2">
                @csrf
                @method('PUT')
                <select name="status" class="border rounded px-2 py-1 text-sm">
                    @foreach ($statusLabels as $key => $label)
                        <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="text-xs px-3 py-1 border rounded hover:bg-gray-100">Lưu</button>
            </form>
        </div>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }} đ</p>
    </div>

    <div class="overflow-x-auto bg-white border rounded-2xl shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-3 text-left">Sản phẩm</th>
                    <th class="p-3 text-right">Giá</th>
                    <th class="p-3 text-center">Số lượng</th>
                    <th class="p-3 text-right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->product->name }}</td>
                    <td class="p-3 text-right">{{ number_format($item->price) }} đ</td>
                    <td class="p-3 text-center">{{ $item->quantity }}</td>
                    <td class="p-3 text-right">
                        {{ number_format($item->price * $item->quantity) }} đ
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
