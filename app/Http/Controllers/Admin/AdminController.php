<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'revenue'   => Order::where('status', 'completed')->sum('total'),
            'orders'    => Order::count(),
            'products'  => Product::count(),
            'inventory' => Product::sum('stock'),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}
