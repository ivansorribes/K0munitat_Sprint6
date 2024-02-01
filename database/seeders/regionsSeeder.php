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
            // ARAGON
            ['id_autonomousCommunity' => 2, 'name' => 'Huesca'],
            ['id_autonomousCommunity' => 2, 'name' => 'Teruel'],
            ['id_autonomousCommunity' => 2, 'name' => 'Zaragoza'],
            // ASTURIAS
            ['id_autonomousCommunity' => 3, 'name' => 'Asturias'],
            // Illes balears
            ['id_autonomousCommunity' => 4, 'name' => 'Balears, Illes'],
            // Canarias
            ['id_autonomousCommunity' => 5, 'name' => 'Palmas, Las'],
            ['id_autonomousCommunity' => 5, 'name' => 'Santa Cruz de Tenerife'],
            // Cantabria
            ['id_autonomousCommunity' => 6, 'name' => 'Cantabria'],
            // Castilla y Leon
            ['id_autonomousCommunity' => 7, 'name' => 'Ávila'],
            ['id_autonomousCommunity' => 7, 'name' => 'Burgos'],
            ['id_autonomousCommunity' => 7, 'name' => 'León'],
            ['id_autonomousCommunity' => 7, 'name' => 'Palencia'],
            ['id_autonomousCommunity' => 7, 'name' => 'Salamanca'],
            ['id_autonomousCommunity' => 7, 'name' => 'Segovia'],
            ['id_autonomousCommunity' => 7, 'name' => 'Soria'],
            ['id_autonomousCommunity' => 7, 'name' => 'Valladolid'],
            ['id_autonomousCommunity' => 7, 'name' => 'Zamora'],
            // CAstilla La mancha
            ['id_autonomousCommunity' => 8, 'name' => 'Albacete'],
            ['id_autonomousCommunity' => 8, 'name' => 'Ciudad Real'],
            ['id_autonomousCommunity' => 8, 'name' => 'Cuenca'],
            ['id_autonomousCommunity' => 8, 'name' => 'Guadalajara'],
            ['id_autonomousCommunity' => 8, 'name' => 'Toledo'],
            //Catalunya
            ['id_autonomousCommunity' => 9, 'name' => 'Barcelona'],
            ['id_autonomousCommunity' => 9, 'name' => 'Girona'],
            ['id_autonomousCommunity' => 9, 'name' => 'Lleida'],
            ['id_autonomousCommunity' => 9, 'name' => 'Tarragona'],
            // Valencia
            ['id_autonomousCommunity' => 10, 'name' => 'Alicante/Alacant'],
            ['id_autonomousCommunity' => 10, 'name' => 'Castellón/Castelló'],
            ['id_autonomousCommunity' => 10, 'name' => 'Valencia/València'],
            // Extremadura
            ['id_autonomousCommunity' => 11, 'name' => 'Badajoz'],
            ['id_autonomousCommunity' => 11, 'name' => 'Cáceres'],
            // Galicia
            ['id_autonomousCommunity' => 12, 'name' => 'Coruña, A'],
            ['id_autonomousCommunity' => 12, 'name' => 'Lugo'],
            ['id_autonomousCommunity' => 12, 'name' => 'Ourense'],
            ['id_autonomousCommunity' => 12, 'name' => 'Pontevedra'],
            // Madrid
            ['id_autonomousCommunity' => 13, 'name' => 'Madrid'],
            // Murcia
            ['id_autonomousCommunity' => 14, 'name' => 'Murcia'],
            // Navarra
            ['id_autonomousCommunity' => 15, 'name' => 'Navarra'],
            // Pais Vasco
            ['id_autonomousCommunity' => 16, 'name' => 'Araba/Álava'],
            ['id_autonomousCommunity' => 16, 'name' => 'Bizkaia'],
            ['id_autonomousCommunity' => 16, 'name' => 'Gipuzkoa'],
            // La Rioja
            ['id_autonomousCommunity' => 17, 'name' => 'Rioja, La'],
            //Ceuta
            ['id_autonomousCommunity' => 18, 'name' => 'Ceuta'],
            // Melilla
            ['id_autonomousCommunity' => 19, 'name' => 'Melilla'],
        ]);
    }
}
