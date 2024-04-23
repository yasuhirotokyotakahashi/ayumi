<?php

namespace Database\Seeders;

use App\Models\CategoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CategoryItem::factory()->count(20)->create();
    }
}
