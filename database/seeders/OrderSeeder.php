<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($users as $user) {
            $orderCount = rand(1, 2);

            for ($i = 0; $i < $orderCount; $i++) {
                $order = Order::create([
                    'id' => Str::uuid(),
                    'idUser' => $user->id,
                    'status' => 'pending',
                ]);

                $orderItems = $products->random(rand(1, 3));

                foreach ($orderItems as $prod) {
                    OrderDetail::create([
                        'id' => Str::uuid(),
                        'idOrder' => $order->id,
                        'idProduct' => $prod->id,
                        'price' => $prod->price,
                        'quantity' => rand(1, 3),
                    ]);
                }
            }
        }
    }
}
