<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = Order::findOrFail($id);
        if (in_array($order->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Đơn hàng đã hoàn thành hoặc đã hủy, không thể cập nhật thêm!');
        }
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
