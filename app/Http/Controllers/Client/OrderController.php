<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        //
        $orders = Order::where('user_id', Auth::id())
                        ->with('details.product') 
                        ->orderByDesc('created_at')
                        ->get();

        return view('client.orders', compact('orders'));
    }

    public function cancel($orderId)
    {
        $order = Order::where('id', $orderId)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        // Chỉ được hủy đơn hàng có trạng thái "pending" (chờ xử lý)
        if ($order->status !== 'pending') {
            return redirect()->route('client.orders.index')
                           ->with('error', 'Chỉ có thể hủy đơn hàng chờ xử lý.');
        }

        // Cộng lại số lượng sản phẩm vào kho
        foreach ($order->details as $detail) {
            $product = $detail->product;
            $product->increment('stock', $detail->quantity);
        }

        // Cập nhật trạng thái đơn hàng
        $order->update(['status' => 'cancelled']);

        return redirect()->route('client.orders.index')
                       ->with('success', 'Hủy đơn hàng thành công!');
    }
    
}
