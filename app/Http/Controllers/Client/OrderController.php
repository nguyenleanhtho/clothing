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

    
}
