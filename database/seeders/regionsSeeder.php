<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\regions;
use Illuminate\Support\Facades\DB;

class regionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['id_autonomousCommunity' => 1, 'name' => 'Almería'],
            ['id_autonomousCommunity' => 1, 'name' => 'Cádiz'],
            ['id_autonomousCommunity' => 1, 'name' => 'Córdoba'],
            ['id_autonomousCommunity' => 1, 'name' => 'Granada'],
            ['id_autonomousCommunity' => 1, 'name' => 'Huelva'],
            ['id_autonomousCommunity' => 1, 'name' => 'Jaén'],
            ['id_autonomousCommunity' => 1, 'name' => 'Málaga'],
            ['id_autonomousCommunity' => 1, 'name' => 'Sevilla'],
            ['id_autonomousCommunity' => 9, 'name' => 'Catalunya'],
            ['id_autonomousCommunity' => 10, 'name' => 'Comunitat Valenciana'],
            ['id_autonomousCommunity' => 11, 'name' => 'Extremadura'],
            ['id_autonomousCommunity' => 12, 'name' => 'Galicia'],
            ['id_autonomousCommunity' => 13, 'name' => 'Madrid, Comunidad de'],
            ['id_autonomousCommunity' => 14, 'name' => 'Murcia, Región de'],
            ['id_autonomousCommunity' => 15, 'name' => 'Navarra, Comunidad Foral de'],
            ['id_autonomousCommunity' => 16, 'name' => 'País Vasco'],
            ['id_autonomousCommunity' => 17, 'name' => 'Rioja, La'],
            ['id_autonomousCommunity' => 18, 'name' => 'Ceuta'],
            ['id_autonomousCommunity' => 19, 'name' => 'Melilla'],
            ['id_autonomousCommunity' => 18, 'name' => 'Ceuta'],
        ]);
    }
}
