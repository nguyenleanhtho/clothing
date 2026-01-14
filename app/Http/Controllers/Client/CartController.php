<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function isJsonRequest(Request $request): bool
    {
        return $request->header('Content-Type') === 'application/json'
            || $request->wantsJson()
            || $request->expectsJson();
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            if ($this->isJsonRequest($request)) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập!'], 401);
            }
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng!');
        }

        // 2. Lấy dữ liệu từ Form gửi lên
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        $isBuyNow = $request->redirect_to_checkout ?? false;

        // Kiểm tra sản phẩm có tồn tại không
        $product = Product::find($productId);
        if (!$product) {
            $message = 'Sản phẩm không tồn tại!';
            if ($this->isJsonRequest($request)) {
                return response()->json(['success' => false, 'message' => $message], 404);
            }
            return redirect()->back()->with('error', $message);
        }

        // Kiểm tra stock sản phẩm
        if ($product->stock <= 0) {
            $message = 'Sản phẩm này hiện đã hết hàng!';
            if ($this->isJsonRequest($request)) {
                return response()->json(['success' => false, 'message' => $message], 400);
            }
            return redirect()->back()->with('error', $message);
        }

        if ($quantity > $product->stock) {
            $message = 'Số lượng không đủ! Chỉ còn ' . $product->stock . ' sản phẩm.';
            if ($this->isJsonRequest($request)) {
                return response()->json(['success' => false, 'message' => $message], 400);
            }
            return redirect()->back()->with('error', $message);
        }

        // Nếu là "Mua ngay", lưu vào session thay vì giỏ hàng thường
        if ($isBuyNow) {
            session(['buy_now_products' => [
                [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]
            ]]);
            
            return redirect()->route('client.checkout');
        }

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
            $newQuantity = $cartDetail->quantity + $quantity;
            
            // Kiểm tra không vượt quá stock
            if ($newQuantity > $product->stock) {
                $message = 'Số lượng tổng cộng vượt quá stock! Chỉ còn ' . $product->stock . ' sản phẩm.';
                if ($this->isJsonRequest($request)) {
                    return response()->json(['success' => false, 'message' => $message], 400);
                }
                return redirect()->back()->with('error', $message);
            }
            
            $cartDetail->quantity = $newQuantity;
            $cartDetail->save();
        } else {
            // Sản phẩm chưa có -> Tạo dòng mới trong cart_details
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                // 'price' => $product->price
            ]);
        }

        // Tính tổng số lượng trong giỏ hàng
        $cartCount = CartDetail::where('cart_id', $cart->id)->sum('quantity');

        // Nếu là AJAX request
        if ($this->isJsonRequest($request)) {
            return response()->json([
                'success' => true, 
                'message' => 'Đã thêm vào giỏ hàng!',
                'cart_count' => $cartCount
            ]);
        }

        // Nếu không thì quay về giỏ hàng
        return redirect()->route('client.cart')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
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

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $cartDetail = CartDetail::find($id);

        if($cartDetail)
        {
            $cartDetail->quantity = $request->quantity;
            $cartDetail->save();

            return redirect()->back()->with('success');
        }

        return redirect()->back()->with('error');
    }

    // Xóa sản phẩm
    public function remove($id)
    {
        $cartDetail = CartDetail::find($id);

        if($cartDetail)
        {
            $cartDetail->delete();
            return redirect()->back()->with('success');
        }

        return redirect()->back()->with('error');
    }
}