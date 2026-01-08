@extends('admin.layout')

@section('title', 'Order Detail')

@section('content')

<h2 class="mb-3">Chi tiết đơn hàng</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


<div class="card shadow-sm mb-4">
    <div class="card-body">
        <p><strong>Mã đơn:</strong> {{ $order->id }}</p>
        <p><strong>Khách hàng:</strong> {{ $order->user->name ?? 'No user' }}</p>
        <p><strong>Trạng thái:</strong> {{ $order->status_label }}</p>
        <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Cập nhật:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}</p>
        <p><strong>Tổng tiền đơn:</strong> {{ number_format($order->total_amount) }} VNĐ</p>
    </div>
</div>


<div class="card shadow-sm mb-4">
    <div class="card-body">

<h4>Cập nhật trạng thái</h4>

@if(!in_array($order->status,['completed','cancelled']))
<form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
    @csrf
    @method('PUT')

    <div class="row g-2">
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Đang xử lý</option>
                <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Đã hủy</option>
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-dark btn-sm">
                <i class="bi bi-save"></i> Lưu
            </button>
        </div>
    </div>
</form>
@else
<p class="text-danger fw-bold">
    Đơn hàng không thể thay đổi trạng thái nữa.
</p>
@endif

    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

<h4>Sản phẩm trong đơn hàng</h4>

@if($order->items->count() == 0)
    <p class="text-muted">Đơn hàng này chưa có sản phẩm.</p>
@else
<table class="table table-bordered">
    <thead class="table-secondary">
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Đã xóa' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price) }} VNĐ</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

    </div>
</div>

@endsection
