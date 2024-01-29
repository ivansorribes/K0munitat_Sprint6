<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\likesPosts;

class likesPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        likesPosts::create([
            'id_user' => 3,
            'id_post' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 3,
            'id_post' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 9,
            'id_post' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 8,
            'id_post' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 7,
            'id_post' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 6,
            'id_post' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 5,
            'id_post' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 4,
            'id_post' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 2,
            'id_post' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        likesPosts::create([
            'id_user' => 1,
            'id_post' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
