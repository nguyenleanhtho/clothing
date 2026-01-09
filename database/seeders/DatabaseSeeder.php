<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // test
            'password' => bcrypt('123456'), // password: 123456
            'role' => 'client',
        ]);

        // tạo category và product test
        Category::factory(3)->create()->each(function ($category) {
           Product::factory(3)->create(['category_id' => $category->id])->each(function ($product) {
                
                // 3. Với mỗi sản phẩm, tạo luôn cái ảnh
                // Đường dẫn này trỏ tới file ảnh có sẵn trong thư mục public
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_url' => 'client/assets/images/product_01.jpg' 
                ]);
            });

        });
    }
}
