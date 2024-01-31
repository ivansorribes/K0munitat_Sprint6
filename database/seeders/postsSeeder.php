<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\posts;

class postsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        posts::factory(10)->create();
        
        
    }
}
