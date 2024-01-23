<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\posts;

class postsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        posts::create([
            'id_community' => 1,
            'id_user' => 1,
            'title' => 'Mandarinas', 
            'description' => 'Las mandarinas de mi huerto',
            'category' => 'Fruites',
            'isActive' => 1,
            'type' => 'post',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        posts::create([
            'id_community' => 2,
            'id_user' => 2,
            'title' => 'Manzanas', 
            'description' => 'Las manzanas de mi huerto',
            'category' => 'Fruites',
            'isActive' => 1,
            'type' => 'post',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        posts::create([
            'id_community' => 3,
            'id_user' => 3,
            'title' => 'Coliflores', 
            'description' => 'Las coliflores de mi huerto',
            'category' => 'Verduras',
            'isActive' => 1,
            'type' => 'advertisement',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
