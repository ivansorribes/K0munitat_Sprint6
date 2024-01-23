<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\communities;

class CommunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        communities::create([
            'id_admin' => 1,
            'name' => 'Cultivos de tomates',
            'description' => 'Comunidad de los cultivos de tomates', // password
            'id_autonomousCommunity' => 1,
            'id_region' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'isActive' => 1
        ]);

        communities::create([
            'id_admin' => 2,
            'name' => 'Bicicletas del delta',
            'description' => 'Comunidad de bicicletas del delta', 
            'id_autonomousCommunity' => 2,
            'id_region' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'isActive' => 1
        ]);

        communities::create([
            'id_admin' => 3,
            'name' => 'Tractores',
            'description' => 'Comunidad de los tractores', 
            'id_autonomousCommunity' => 3,
            'id_region' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'isActive' => 1
        ]);
    }
}
