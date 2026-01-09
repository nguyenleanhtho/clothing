<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth; // Để kiểm tra đăng nhập

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng!');
        }

        // 2. Lấy dữ liệu từ Form gửi lên
        $productId = $request->product_id;
        $quantity = $request->quantity;

        // 3. Tìm (hoặc tạo) Giỏ hàng cho User này
        // Logic: Tìm trong bảng 'carts' xem user_id này có giỏ chưa. Nếu chưa thì tạo mới.
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
            // Nếu muốn lưu trạng thái giỏ hàng, có thể thêm ['status' => 'new']
        );

        // 4. Kiểm tra xem Sản phẩm này đã có trong Giỏ chi tiết chưa?
        $cartDetail = CartDetail::where('cart_id', $cart->id)
                                ->where('product_id', $productId)
                                ->first();

        if ($cartDetail) {
            // Sản phẩm đã có -> Cộng dồn số lượng
            $cartDetail->quantity += $quantity;
            $cartDetail->save();
        } else {
            // Sản phẩm chưa có -> Tạo dòng mới trong cart_details
            // Cần lấy giá sản phẩm để lưu (nếu bảng cart_details có cột price)
            $product = Product::find($productId);

            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                // 'price' => $product->price
            ]);
        }

        // 5. Thông báo và quay lại trang cũ
        return redirect()->route('client.cart');
    }

    // xem giỏ hàng  
    public function index()
    {
        // tìm giỏ hàng của user đăng nhập
        $cart = Cart::where('user_id', Auth::id())->first();

        $cartDetails = [];

        if($cart){
            $cartDetails = CartDetail::with('product.images')
                                        ->where('cart_id', $cart->id)
                                        ->get();
        }

        return view('client.cart_details', compact('cartDetails'));
    }
}