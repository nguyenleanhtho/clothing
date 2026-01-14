@extends('admin.layouts.master')

@section('title', 'Cập nhật trạng thái đơn hàng')

@section('content')
<div class="max-w-xl space-y-6">

    <h1 class="text-3xl font-black">
        Cập nhật trạng thái – Đơn #{{ $order->id }}
    </h1>

    <div class="bg-white border rounded-2xl p-6">
        <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold mb-1">Trạng thái</label>
                <select name="status" class="w-full border rounded-xl px-4 py-2">
                    @foreach ($statusLabels as $key => $label)
                        <option value="{{ $key }}" @selected($order->status === $key)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-4 pt-2">
                <button class="bg-black text-white px-6 py-3 rounded-xl text-xs font-black uppercase">
                    Lưu
                </button>
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-3 border rounded-xl">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
