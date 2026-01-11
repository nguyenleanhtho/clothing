<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Áo Nam', 'slug' => 'ao-nam'],
            ['name' => 'Áo Nữ', 'slug' => 'ao-nu'],
            ['name' => 'Quần Jean', 'slug' => 'quan-jean'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'id' => Str::uuid(),
                'name' => $cat['name'],
                'slug' => $cat['slug'],
            ]);
        }
    }
}