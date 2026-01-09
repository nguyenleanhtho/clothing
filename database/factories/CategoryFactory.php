<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Random tên danh mục quần áo cho giống thật
        $name = $this->faker->randomElement(['Áo Thun', 'Áo Sơ Mi', 'Quần Jeans', 'Váy Đầm', 'Giày Sneaker']);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(3), // VD: ao-thun-xyz
        ];
    }
}
