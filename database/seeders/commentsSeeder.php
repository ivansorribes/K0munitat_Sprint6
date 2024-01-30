<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\comments;

class commentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        comments::create([
            'id_user' => 3,
            'comment' => 'Muy buena publicación',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        comments::create([
            'id_user' => 5,
            'comment' => 'Yo tengo de mejores...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        comments::create([
            'id_user' => 8,
            'comment' => 'Me dejas comprar 3 kilos?',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        comments::create([
            'id_user' => 9,
            'comment' => 'Wow, justo lo que necesito!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
