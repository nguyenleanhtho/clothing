<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $name = $this->faker->randomElement(['Áo Thun Teelab', 'Quần Short Kaki', 'Váy Hoa Nhí', 'Áo Polo Nam', 'Giày Thể Thao']);
        
        return [
            // category_id sẽ được điền tự động ở bước sau (trong Seeder)
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => 'Chất liệu thoáng mát, thiết kế trẻ trung năng động.',
            'price' => $this->faker->numberBetween(100, 2000) * 1000, // Giá từ 100k đến 2tr
            'stock' => 50, // Tồn kho 50 cái
        ];
    }
}
