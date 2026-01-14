@extends('admin.layouts.master')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="space-y-6">

    <h1 class="text-3xl font-black">Danh sách đơn hàng</h1>

    <div class="overflow-x-auto bg-white border rounded-2xl shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Khách hàng</th>
                    <th class="p-3 text-center">Trạng thái</th>
                    <th class="p-3 text-right">Tổng tiền</th>
                    <th class="p-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $order->id }}</td>
                    <td class="p-3">{{ $order->user->name }}</td>
                    <td class="p-3 text-center">
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
                    </td>
                    <td class="p-3 text-right">{{ number_format($order->total_price) }} đ</td>
                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600">Xem</a>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="text-indigo-600">Sửa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
