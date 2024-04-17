<?php

namespace Database\Seeders;

use App\Models\SoldItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoldItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SoldItem::factory()->count(100)->create();
    }
}
