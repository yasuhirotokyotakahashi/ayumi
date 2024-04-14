<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category' => '家電'],
            ['category' => '衣料品'],
            ['category' => '医薬品'],
            ['category' => 'スポーツ用品'],
            ['category' => '食料品'],
            // 他のカテゴリを追加
        ]);
    }
}
