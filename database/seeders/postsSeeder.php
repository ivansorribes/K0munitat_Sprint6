<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\posts;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'title' => "Farmers on Strike: A Call for Change",
                'description' => "In a significant turn of events, tractor drivers across the region have initiated a strike, bringing to light longstanding grievances within the agricultural sector. ",
                'isActive' => 1,
                'private' => 0,
                'type' => 'post',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                //id 2
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Innovation Meets Agriculture",
                'description' => "In a bold step towards sustainable agriculture, a new farm has been established, setting a benchmark for future farming practices.",
                'isActive' => 1,
                'private' => 0,
                'type' => 'post',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                //id 3
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Rent the Latest in Farming Efficiency",
                'description' => "Unlock the potential of your farm with our cutting-edge agricultural tools available for rent! ",
                'isActive' => 1,
                'private' => 0,
                'type' => 'advertisement',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                //id 4
                'id_user' => 1,
                'id_category' => 1,
                'id_community' => 1,
                'title' => "Premier Tool Rental Services",
                'description' => "Step into the future of farming with our premier tool rental services! Our extensive catalog features everything from high-efficiency soil tillers to advanced irrigation systems, all available at competitive rental rates.",
                'isActive' => 1,
                'private' => 0,
                'type' => 'advertisement',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Añade más registros según sea necesario
        ];

        DB::table('posts')->insert($posts);
    }
}
