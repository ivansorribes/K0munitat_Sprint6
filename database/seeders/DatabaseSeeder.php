<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\autonomousCommunities;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(autonomousCommunitiesSeeder::class);
        $this->call(categoriesSeeder::class);
        $this->call(usersSeeder::class);
        $this->call(regionsSeeder::class);
        $this->call(communitiesSeeder::class);
        $this->call(postsSeeder::class);
        // $this->call(commentsSeeder::class);
        $this->call(commentsPostsSeeder::class);
        $this->call(communitiesUsersSeeder::class);
        $this->call(imagePostSeeder::class);
        $this->call(likesPostsSeeder::class);
        $this->call(post_admin_blogSeeder::class);
        $this->call(EventSeeder::class);
    }
}
