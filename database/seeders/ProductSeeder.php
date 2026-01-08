<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $cat) {
            for ($i=1; $i<=2; $i++) {
                Product::create([
                    'id' => Str::uuid(),
                    'idCategory' => $cat->id,
                    'name' => $cat->name . " mẫu $i",
                    'description' => "Mô tả " . $cat->name . " mẫu $i",
                    'price' => rand(100000, 500000),
                    'stock' => rand(5, 20),
                    'slug' => Str::slug($cat->name . "-$i"),
                ]);
            }
        }
    }
}
