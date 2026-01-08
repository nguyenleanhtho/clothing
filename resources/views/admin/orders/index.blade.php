@extends('admin.layout')

@section('title', 'Orders')

@section('content')

<h2 class="mb-3">Danh sách đơn hàng</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Tổng tiền</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->user->name ?? 'No User' }}</td>
            <td>
                <span class="badge 
                    @if($o->status=='pending') bg-warning
                    @elseif($o->status=='processing') bg-primary
                    @elseif($o->status=='completed') bg-success
                    @else bg-danger
                    @endif">
                    {{ strtoupper($o->status) }}
                </span>
            </td>
            <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $o->updated_at->format('d/m/Y H:i') }}</td>
            <td>{{ number_format($o->total_amount) }} VNĐ</td>
            <td>
                <a class="btn btn-sm btn-dark" 
                   href="{{ route('admin.orders.show', $o->id) }}">
                    Xem chi tiết
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

    </div>
</div>

@endsection
