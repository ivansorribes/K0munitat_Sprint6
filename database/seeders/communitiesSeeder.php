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
        communities::factory()->create([
            'id_admin' => 1,
            'name' => 'Example community',
            'description' => 'This is an example community.',
            'id_autonomousCommunity' => 1,
            'id_region' => 1,
            'private' => false,
            'isActive' => true
        ]);

        communities::factory(10)->create();
    }
}
