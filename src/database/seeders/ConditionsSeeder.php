<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('conditions')->insert([
            ['condition' => '新品'],
            ['condition' => '中古'],
            ['condition' => '傷あり'],
            // 他の商品状態を追加
        ]);
    }
}
