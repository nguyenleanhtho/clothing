<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 10 sản phẩm mới nhất
        $products = Product::with('images')
                          ->orderBy('created_at', 'desc')
                          ->take(10)
                          ->get();
        
        return view('client.index', compact('products')); 
    }

    public function about()
    {
        return view('client.about');
    }

    public function contact()
    {
        return view('client.contact');
    }

    public function products()
    {
        return view('client.products');
    }
}