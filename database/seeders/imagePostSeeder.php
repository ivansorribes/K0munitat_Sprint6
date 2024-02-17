<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\imagePost;
use Illuminate\Support\Facades\DB;


class imagePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagesPosts = [
            [
                //id 1
                'id_post' => 1,
                'name' => "25lQqNX1SMes2GzLEQXoFlWRZikXfvNVNPzeohcz.webp",
                'front_page' => 0,
            ],
            // [
            //     //id 2
            //     'id_post' => 2,
            //     'name' => 1,
            //     'front_page' => 0,
            // ],
            // [
            //     //id 3
            //     'id_post' => 3,
            //     'name' => 1,
            //     'front_page' => 0,
            // ],
            // [
            //     //id 4
            //     'id_post' => 4,
            //     'name' => 1,
            //     'front_page' => 0,
            // ],
            // Añade más registros según sea necesario
        ];

        DB::table('imagePost')->insert($imagesPosts);
    }
}
