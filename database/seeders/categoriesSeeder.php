<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\categories;


class categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categories::create([
            'name' => 'Fruits',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        categories::create([
            'name' => 'Vegetables',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        categories::create([
            'name' => 'Medicinal Plants',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        categories::create([
            'name' => 'Tools and Machinery',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        categories::create([
            'name' => 'Gardening Equipment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        categories::create([
            'name' => 'Others',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
