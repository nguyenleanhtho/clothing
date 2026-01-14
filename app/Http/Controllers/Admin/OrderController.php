<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** Danh sách đơn hàng */
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->get();
        $statusLabels = $this->statusLabels();
        return view('admin.orders.index', compact('orders', 'statusLabels'));
    }

    /** Chi tiết đơn hàng + sản phẩm */
    public function show(Order $order)
    {
        $order->load(['user', 'details.product']);
        $statusLabels = $this->statusLabels();
        return view('admin.orders.show', compact('order', 'statusLabels'));
    }

    /** Form sửa trạng thái */
    public function edit(Order $order)
    {
        $statusLabels = $this->statusLabels();

        return view('admin.orders.edit', compact('order', 'statusLabels'));
    }

    /** Cập nhật trạng thái */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,shipping,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }

    /** Map trạng thái */
    private function statusLabels(): array
    {
        return [
            'pending'   => 'Chờ xử lý',
            'shipping'  => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];
    }
}
