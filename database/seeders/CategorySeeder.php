<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['name' => 'Men\'s Clothing', 'slug' => 'mens-clothing', 'is_visible' => true, 'description' => 'Men\'s Clothing description', 'order' => 1, 'parent_id' => null],
            ['name' => 'T-Shirts', 'slug' => 't-shirts', 'is_visible' => true, 'description' => 'Men\'s T-Shirts description', 'order' => 2, 'parent_id' => 1],
            ['name' => 'Jeans', 'slug' => 'jeans', 'is_visible' => true, 'description' => 'Men\'s Jeans description', 'order' => 2, 'parent_id' => 1],
            ['name' => 'Women\'s Clothing', 'slug' => 'womens-clothing', 'is_visible' => true, 'description' => 'Women\'s Clothing description', 'order' => 1, 'parent_id' => null],
            ['name' => 'Dresses', 'slug' => 'dresses', 'is_visible' => true, 'description' => 'Women\'s Dresses description', 'order' => 2, 'parent_id' => 4],
            ['name' => 'Blouses', 'slug' => 'blouses', 'is_visible' => true, 'description' => 'Women\'s Blouses description', 'order' => 2, 'parent_id' => 4],
            // Add more data as needed
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
