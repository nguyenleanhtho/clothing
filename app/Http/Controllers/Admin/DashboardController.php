<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng doanh thu từ các đơn đã hoàn thành
        $revenue = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', 'completed')
            ->sum(DB::raw('order_details.price * order_details.quantity'));

        // Số đơn hôm nay
        $ordersToday = Order::whereDate('created_at', today())->count();

        // Tổng số sản phẩm
        $productCount = Product::count();

        // Tổng tồn kho
        $inventoryTotal = Product::sum('stock');

        // Số người dùng
        $userCount = User::count();

        // Số danh mục
        $categoryCount = Category::count();

        // Tổng tổng đơn hàng (tất cả trạng thái)
        $totalOrders = Order::count();

        // 5 đơn hàng mới nhất (load details)
        $recentOrders = Order::with(['user', 'details'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.index', [
            'stats' => [
                'revenue'      => $revenue,
                'ordersToday'  => $ordersToday,
                'totalOrders'  => $totalOrders,
                'products'     => $productCount,
                'inventory'    => $inventoryTotal,
                'users'        => $userCount,
                'categories'   => $categoryCount,
            ],
            'recentOrders' => $recentOrders,
        ]);
    }
}

