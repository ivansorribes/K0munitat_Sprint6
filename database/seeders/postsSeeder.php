<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\posts;
use Illuminate\Support\Facades\DB;

class postsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                //id 1
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Título del post 1",
                'description' => "Descripción del post 1",
                'isActive' => 1,
                'private' => 0,
                'type' => 'post',
            ],
            [
                //id 2
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Título del post 2",
                'description' => "Descripción del post 2",
                'isActive' => 1,
                'private' => 0,
                'type' => 'post',
            ],
            [
                //id 3
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Título del advertisement 2",
                'description' => "Descripción del advertisement 1",
                'isActive' => 1,
                'private' => 0,
                'type' => 'advertisement',
            ],
            [
                //id 4
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Título del advertisement 2",
                'description' => "Descripción del advertisement 2",
                'isActive' => 1,
                'private' => 0,
                'type' => 'advertisement',
            ],
            // Añade más registros según sea necesario
        ];

        DB::table('posts')->insert($posts);
    }
}
