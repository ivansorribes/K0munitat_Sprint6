<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\imagePost;

class imagePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        imagePost::create([
            'id_post' => 1,
            'name' => 'Mandarinas',
            'front_page' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        imagePost::create([
            'id_post' => 2,
            'name' => 'Manzanas',
            'front_page' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        imagePost::create([
            'id_post' => 3,
            'name' => 'Coliflor',
            'front_page' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
