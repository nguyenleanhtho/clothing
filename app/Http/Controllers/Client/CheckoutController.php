<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private function buildBuyNowCartDetails(array $buyNowProducts, bool $withImages): array
    {
        $cartDetails = [];

        foreach ($buyNowProducts as $item) {
            $query = Product::query();
            if ($withImages) {
                $query->with('images');
            }

            $product = $query->find($item['product_id']);
            if (!$product) {
                continue;
            }

            $cartDetail = new \stdClass();
            $cartDetail->product = $product;
            $cartDetail->product_id = $item['product_id'];
            $cartDetail->quantity = $item['quantity'];
            $cartDetails[] = $cartDetail;
        }

        return $cartDetails;
    }

    // Hiển thị thanh toán
    public function index()
    {
        // Kiểm tra nếu là "Mua ngay"
        $buyNowProducts = session('buy_now_products');

        if ($buyNowProducts) {
            $cartDetails = $this->buildBuyNowCartDetails($buyNowProducts, true);
        } else {
            // Nếu không, lấy giỏ hàng bình thường
            $cart = Cart::where('user_id', Auth::id())->first();

            if (!$cart || $cart->details->count() == 0) {
                return redirect()->route('client.products')->with('error', 'Giỏ hàng trống không thể thanh toán');
            }
            $cartDetails = $cart->details;
        }

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

        // Kiểm tra nếu là "Mua ngay"
        $buyNowProducts = session('buy_now_products');

        if ($buyNowProducts) {
            $cartDetails = $this->buildBuyNowCartDetails($buyNowProducts, false);
        } else {
            // 1. Lấy giỏ hàng
            $cart = Cart::where('user_id', $user->id)->first();
            
            if (!$cart || $cart->details->count() == 0) {
                return redirect()->route('client.index');
            }

            $cartDetails = $cart->details;
        }

        // Tính tổng tiền
        $totalMoney = 0;
        foreach ($cartDetails as $item) {
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

            // 3. Tạo Chi tiết đơn hàng (Order Details) và giảm stock sản phẩm
            foreach ($cartDetails as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Giảm stock sản phẩm
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }

            // Nếu không phải mua ngay, xóa giỏ hàng
            if (!$buyNowProducts) {
                $cart = Cart::where('user_id', $user->id)->first();
                CartDetail::where('cart_id', $cart->id)->delete();
            } else {
                // Nếu là mua ngay, xóa session
                session()->forget('buy_now_products');
            }
            
            DB::commit();
            return redirect()->route('client.index')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ sớm.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
