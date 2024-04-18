<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\autonomousCommunities;
use Illuminate\Support\Facades\DB;

class autonomousCommunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('autonomousCommunities')->insert([
            ['name' => 'Andalucía'],
            ['name' => 'Aragón'],
            ['name' => 'Asturias, Principado de'],
            ['name' => 'Balears, Illes'],
            ['name' => 'Canarias'],
            ['name' => 'Cantabria'],
            ['name' => 'Castilla y León'],
            ['name' => 'Castilla - La Mancha'],
            ['name' => 'Catalunya'],
            ['name' => 'Comunitat Valenciana'],
            ['name' => 'Extremadura'],
            ['name' => 'Galicia'],
            ['name' => 'Madrid, Comunidad de'],
            ['name' => 'Murcia, Región de'],
            ['name' => 'Navarra, Comunidad Foral de'],
            ['name' => 'País Vasco'],
            ['name' => 'Rioja, La'],
            ['name' => 'Ceuta'],
            ['name' => 'Melilla'],
        ]);
    }
}
