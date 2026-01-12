@extends('client.layouts.master')

@section('content')

<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>Lịch sử mua hàng</h4>
          <h2>Đơn hàng của bạn</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 50px; margin-bottom: 80px;">
    <div class="row">
        <div class="col-md-12">
            
            @if($orders->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead style="background-color: #f7f7f7;">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                
                                <td>
                                    <ul style="padding-left: 15px; margin-bottom: 0;">
                                        @foreach($order->details as $detail)
                                            <li style="font-size: 14px;">
                                                {{ $detail->product->name }} 
                                                <span class="text-muted">(x{{ $detail->quantity }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                
                                <td style="color: #f33f3f; font-weight: bold;">
                                    {{ number_format($order->total_money) }} đ
                                </td>
                                
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge badge-warning" style="background-color: #ffc107; color: #000;">Chờ xử lý</span>
                                    @elseif($order->status == 'shipping')
                                        <span class="badge badge-info" style="background-color: #17a2b8;">Đang giao</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge badge-success" style="background-color: #28a745;">Hoàn thành</span>
                                    @else
                                        <span class="badge badge-secondary" style="background-color: #6c757d;">Đã hủy</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center">
                    <h4>Bạn chưa có đơn hàng nào.</h4>
                    <a href="{{ route('client.products') }}" class="filled-button mt-3">Mua sắm ngay</a>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection