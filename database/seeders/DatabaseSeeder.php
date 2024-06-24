<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(15)->create();
        \App\Models\Product::factory(200)->create();
        \App\Models\Order::factory(10)->create();
        \App\Models\OrderDetail::factory(100)->create();
    }
}
