<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;


class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'email' => 'ivan@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'ivansorribes',
            'firstname' => 'Ivan',
            'lastname' => 'Sorribes',
            'city' => 'Deltebre',
            'postcode' => 43580,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'email' => 'tatiana@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'tatianavalentiny',
            'firstname' => 'Tatiana',
            'lastname' => 'Valentinyova',
            'city' => 'Sant Carles de la Rapita',
            'postcode' => 43540,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'roger@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'rogerarques',
            'firstname' => 'Roger',
            'lastname' => 'Arques',
            'city' => 'Amposta',
            'postcode' => 43870,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'jordi@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'jordinavarro',
            'firstname' => 'Jordi',
            'lastname' => 'Navarro',
            'city' => 'Amposta',
            'postcode' => 43870,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'cristian@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'cristiancutar',
            'firstname' => 'Cristian',
            'lastname' => 'Cutar',
            'city' => 'Camarles',
            'postcode' => 43894,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'macarena@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'macarenagonzales',
            'firstname' => 'Macarena',
            'lastname' => 'Gonzales',
            'city' => 'Amposta',
            'postcode' => 43870,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'paula@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'paulacruzado',
            'firstname' => 'Paula',
            'lastname' => 'Cruzado',
            'city' => 'Amposta',
            'postcode' => 43870,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'xavi@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'xavifibla',
            'firstname' => 'Xavi',
            'lastname' => 'Fibla',
            'city' => 'Amposta',
            'postcode' => 43870,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'email' => 'alvaro@k0munitat.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'username' => 'alvaromolina',
            'firstname' => 'Alvaro',
            'lastname' => 'Molina',
            'city' => 'Amposta',
            'postcode' => 43870,
            'telephone' => fake()->phoneNumber(),
            'profile_image' => 'DefaultImage.png',
            'profile_description' => 'Test description',
            'created_at' => now(),
            'role' => 'superAdmin',
            'remember_token' => Str::random(10),
        ]);

        for ($month = 1; $month <= 12; $month++) {
            // Generar al menos un usuario para cada mes
            User::create([
                'email' => Str::random(5) . '@k0munitat.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'username' => Str::random(8),
                'firstname' => Str::random(6),
                'lastname' => Str::random(6),
                'city' => 'Amposta',
                'postcode' => 43870,
                'telephone' => '123456789', // Cambiar a fake()->phoneNumber() si estás usando Faker
                'profile_image' => 'DefaultImage.png',
                'profile_description' => 'Test description',
                'created_at' => now()->year(2024)->month($month)->day(rand(1, 28)), // Aleatorizar el día del mes
                'role' => 'superAdmin',
                'remember_token' => Str::random(10),
            ]);
        }

        // Generar usuarios adicionales para el año 2024 con fechas de creación aleatorias
        for ($i = 0; $i < 8; $i++) { // Generar 8 usuarios adicionales para otros meses
            $month = rand(1, 12); // Elegir un mes aleatorio
            $day = rand(1, 28); // Elegir un día aleatorio
            User::create([
                'email' => Str::random(5) . '@k0munitat.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'username' => Str::random(8),
                'firstname' => Str::random(6),
                'lastname' => Str::random(6),
                'city' => 'Amposta',
                'postcode' => 43870,
                'telephone' => '123456789', // Cambiar a fake()->phoneNumber() si estás usando Faker
                'profile_image' => 'DefaultImage.png',
                'profile_description' => 'Test description',
                'created_at' => now()->year(2024)->month($month)->day($day), // Asignar fecha de creación aleatoria
                'role' => 'superAdmin',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
