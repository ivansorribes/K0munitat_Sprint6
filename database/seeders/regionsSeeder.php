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
            ['id' => 4, 'id_autonomousCommunity' => 1, 'name' => 'Almería'],
            ['id' => 11, 'id_autonomousCommunity' => 1, 'name' => 'Cádiz'],
            ['id' => 14, 'id_autonomousCommunity' => 1, 'name' => 'Córdoba'],
            ['id' => 18, 'id_autonomousCommunity' => 1, 'name' => 'Granada'],
            ['id' => 21, 'id_autonomousCommunity' => 1, 'name' => 'Huelva'],
            ['id' => 23, 'id_autonomousCommunity' => 1, 'name' => 'Jaén'],
            ['id' => 29, 'id_autonomousCommunity' => 1, 'name' => 'Málaga'],
            ['id' => 41, 'id_autonomousCommunity' => 1, 'name' => 'Sevilla'],
            // ARAGON
            ['id' => 22, 'id_autonomousCommunity' => 2, 'name' => 'Huesca'],
            ['id' => 44, 'id_autonomousCommunity' => 2, 'name' => 'Teruel'],
            ['id' => 50, 'id_autonomousCommunity' => 2, 'name' => 'Zaragoza'],
            // ASTURIAS
            ['id' => 33, 'id_autonomousCommunity' => 3, 'name' => 'Asturias'],
            // Illes balears
            ['id' => 7, 'id_autonomousCommunity' => 4, 'name' => 'Balears, Illes'],
            // Canarias
            ['id' => 35, 'id_autonomousCommunity' => 5, 'name' => 'Palmas, Las'],
            ['id' => 38, 'id_autonomousCommunity' => 5, 'name' => 'Santa Cruz de Tenerife'],
            // Cantabria
            ['id' => 39, 'id_autonomousCommunity' => 6, 'name' => 'Cantabria'],
            // Castilla y Leon
            ['id' => 5, 'id_autonomousCommunity' => 7, 'name' => 'Ávila'],
            ['id' => 9, 'id_autonomousCommunity' => 7, 'name' => 'Burgos'],
            ['id' => 24, 'id_autonomousCommunity' => 7, 'name' => 'León'],
            ['id' => 34, 'id_autonomousCommunity' => 7, 'name' => 'Palencia'],
            ['id' => 37, 'id_autonomousCommunity' => 7, 'name' => 'Salamanca'],
            ['id' => 40, 'id_autonomousCommunity' => 7, 'name' => 'Segovia'],
            ['id' => 42, 'id_autonomousCommunity' => 7, 'name' => 'Soria'],
            ['id' => 47, 'id_autonomousCommunity' => 7, 'name' => 'Valladolid'],
            ['id' => 49, 'id_autonomousCommunity' => 7, 'name' => 'Zamora'],
            // CAstilla La mancha
            ['id' => 2, 'id_autonomousCommunity' => 8, 'name' => 'Albacete'],
            ['id' => 13, 'id_autonomousCommunity' => 8, 'name' => 'Ciudad Real'],
            ['id' => 16, 'id_autonomousCommunity' => 8, 'name' => 'Cuenca'],
            ['id' => 19, 'id_autonomousCommunity' => 8, 'name' => 'Guadalajara'],
            ['id' => 45, 'id_autonomousCommunity' => 8, 'name' => 'Toledo'],
            //Catalunya
            ['id' => 8, 'id_autonomousCommunity' => 9, 'name' => 'Barcelona'],
            ['id' => 17, 'id_autonomousCommunity' => 9, 'name' => 'Girona'],
            ['id' => 25, 'id_autonomousCommunity' => 9, 'name' => 'Lleida'],
            ['id' => 43, 'id_autonomousCommunity' => 9, 'name' => 'Tarragona'],
            // Valencia
            ['id' => 3, 'id_autonomousCommunity' => 10, 'name' => 'Alicante/Alacant'],
            ['id' => 12, 'id_autonomousCommunity' => 10, 'name' => 'Castellón/Castelló'],
            ['id' => 46, 'id_autonomousCommunity' => 10, 'name' => 'Valencia/València'],
            // Extremadura
            ['id' => 6, 'id_autonomousCommunity' => 11, 'name' => 'Badajoz'],
            ['id' => 10, 'id_autonomousCommunity' => 11, 'name' => 'Cáceres'],
            // Galicia
            ['id' => 15, 'id_autonomousCommunity' => 12, 'name' => 'Coruña, A'],
            ['id' => 27, 'id_autonomousCommunity' => 12, 'name' => 'Lugo'],
            ['id' => 32, 'id_autonomousCommunity' => 12, 'name' => 'Ourense'],
            ['id' => 36, 'id_autonomousCommunity' => 12, 'name' => 'Pontevedra'],
            // Madrid
            ['id' => 28, 'id_autonomousCommunity' => 13, 'name' => 'Madrid'],
            // Murcia
            ['id' => 30, 'id_autonomousCommunity' => 14, 'name' => 'Murcia'],
            // Navarra
            ['id' => 31, 'id_autonomousCommunity' => 15, 'name' => 'Navarra'],
            // Pais Vasco
            ['id' => 1, 'id_autonomousCommunity' => 16, 'name' => 'Araba/Álava'],
            ['id' => 48, 'id_autonomousCommunity' => 16, 'name' => 'Bizkaia'],
            ['id' => 20, 'id_autonomousCommunity' => 16, 'name' => 'Gipuzkoa'],
            // La Rioja
            ['id' => 26, 'id_autonomousCommunity' => 17, 'name' => 'Rioja, La'],
            //Ceuta
            ['id' => 51, 'id_autonomousCommunity' => 18, 'name' => 'Ceuta'],
            // Melilla
            ['id' => 52, 'id_autonomousCommunity' => 19, 'name' => 'Melilla'],
        ]);
    }
}
