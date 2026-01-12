<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Hiển thị thanh toán
    public function index()
    {
        // Lấy giỏ hàng của user hiện tại
        $cart = Cart::where('user_id', Auth::id())->first();

        if(!$cart || $cart->details->count() == 0)
        {
            return redirect()->route('client.products')->with('error', 'Giỏ hàng trống không thể thanh toán');
        }
        $cartDetails = $cart->details;

        return view('client.checkout', compact('cartDetails'));
    } 
    
    public function process(Request $request)
    {
        // Validate dữ liệu
      $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = Auth::user();

        // 1. Lấy giỏ hàng
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart || $cart->details->count() == 0) {
            return redirect()->route('client.index');
        }

        $cartDetails = $cart->details;

        // Tính tổng tiền
        $totalMoney = 0;
        foreach($cartDetails as $item) {
            $totalMoney += $item->product->price * $item->quantity;
        }

        DB::beginTransaction();
        try {
            // 2. Tạo Đơn hàng (Order)
            $order = Order::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_money' => $totalMoney,
                'status' => 'pending',
                'payment_method' => 'COD'
            ]);

            // 3. Tạo Chi tiết đơn hàng (Order Details)
            foreach ($cartDetails as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            CartDetail::where('cart_id', $cart->id)->delete();
            DB::commit();
            return redirect()->route('client.index')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ sớm.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
