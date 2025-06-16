<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = [
                ['category_name' => 'Games'],
                ['category_name' => 'Sports'],
                ['category_name' => 'Technology'],
                ['category_name' => 'Education'],
            ];

    Category::insert($categories);
    }
}
