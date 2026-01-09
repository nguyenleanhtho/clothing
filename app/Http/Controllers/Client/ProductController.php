<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    // public function products()
    // {
    //     return view('client.products');
    // }

    // Hiển thị chi tiết 1 sản phẩm
    // public function show($id)
    // {
    //     // Sau này sẽ code: $product = Product::find($id);
    //     // Hiện tại return view tĩnh để xem giao diện
    //     return view('client.product_detail');
    // }

    public function detail($id)
    {
        // lấy sản phẩm theo ID, kèm theo ảnh và danh mục
        $product = Product::with(['images', 'category'])->findOrFail($id);

        // lấy thêm 4 sản phẩm liên quan cùng danh mục
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $id)
                                ->take(4)
                                ->get();
        return view('client.product_detail', compact('product', 'relatedProducts'));
    }

    // Lấy dữ liệu và phân trang
    public function index()
    {
        // lấy sản phẩm mới nhất, ảnh, nỗi trang 6 sản phẩm
        $products = \App\Models\Product::with('images')->latest()->paginate(6);
        
        return view('client.products', compact('products'));
    }
}