<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\commentsPosts;

class commentsPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        commentsPosts::create([
            'id_post' => 1,
            'id_comment' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        commentsPosts::create([
            'id_post' => 2,
            'id_comment' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        commentsPosts::create([
            'id_post' => 3,
            'id_comment' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
