<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categories_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Smartphone', 'description' => 'Smartphone description'],
            ['name' => 'Laptop', 'description' => 'Laptop description'],
            ['name' => 'Tablet', 'description' => 'Tablet description'],
            ['name' => 'Smartwatch', 'description' => 'Smartwatch description'],
            ['name' => 'Desktop', 'description' => 'Desktop description'],
            ['name' => 'Camera', 'description' => 'Camera description'],
            ['name' => 'Printer', 'description' => 'Printer description'],
            ['name' => 'Headphone', 'description' => 'Headphone description'],
            ['name' => 'Speaker', 'description' => 'Speaker description'],
            ['name' => 'Monitor', 'description' => 'Monitor description'],
        ];

        DB::table('categories')->insert($categories);
    }
}
