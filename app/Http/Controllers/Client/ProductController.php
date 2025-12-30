<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function products()
    {
        return view('client.products');
    }

    // Hiển thị chi tiết 1 sản phẩm
    public function show($id)
    {
        // Sau này sẽ code: $product = Product::find($id);
        // Hiện tại return view tĩnh để xem giao diện
        return view('client.product_detail');
    }
}