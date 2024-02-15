<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\posts_admin_blog;

class posts_admin_blogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        posts_admin_blog::factory(30)->create();
    }
}
