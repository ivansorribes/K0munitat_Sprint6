<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\post_admin_blog;

class post_admin_blogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        post_admin_blog::create([
            'title' => 'Potted Cherry Tomatoes',
            'description' => 'Explore how to cultivate cherry tomatoes in pots. From choosing the right variety to watering and pruning, we guide you step by step to enjoy your own fresh tomatoes at home.',
            'post_image' => 'tomate.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Lettuces in Small Spaces',
            'description' => 'Learn to grow lettuces even if you have limited space. We showcase vertical farming techniques and how to keep your lettuces healthy without taking up too much room.',
            'post_image' => 'lechuga.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Carrots on Urban Balconies',
            'description' => 'Living in the city and dreaming of growing carrots? In this article, we explain how to do it on urban balconies. Tips for the ideal substrate and ensuring the growth of juicy carrots.',
            'post_image' => 'zanahoria.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Aromatic Herbs in Sunny Windows',
            'description' => 'Cultivating your own aromatic herbs is easier than you think. Discover how to create a small herb garden on your sunny windows. Infuse your dishes with fresh and homemade flavors!',
            'post_image' => 'hierba.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Beginner-Friendly Pot Peppers',
            'description' => 'If you are new to gardening, potted peppers are an excellent choice. We teach you the basics, from planting to harvesting. Enjoy fresh peppers grown by yourself!',
            'post_image' => 'pimiento.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Vertical Strawberry Gardens',
            'description' => 'Turn any corner into a strawberry haven! Learn how to grow strawberries in vertical hangers to maximize space and relish the taste of these delicious, homegrown fruits.',
            'post_image' => 'fresa.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Hanging Cucumber Planters',
            'description' => 'Craving fresh cucumbers? This guide walks you through growing cucumbers in hanging planters—an ideal solution for small spaces. Discover the secrets to flavorful cucumber harvests.',
            'post_image' => 'pepino.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Zucchinis on the Balcony',
            'description' => 'No need for a large garden to cultivate zucchinis. In this tutorial, we explain how to grow zucchinis on a balcony. From choosing the right pot to harvest, enjoy fresh and healthy zucchinis!',
            'post_image' => 'zucini.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Onions in Planter Boxes',
            'description' => 'Onions are kitchen essentials, and growing them in planter boxes is a breeze. Learn how to plant, care for, and harvest onions in your own space. Enjoy fresh, flavorful onions at home!',
            'post_image' => 'cebolla.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        post_admin_blog::create([
            'title' => 'Shade-Friendly Arugula Windowsills',
            'description' => 'Even in shaded spaces, you can grow arugula. Discover how to have your own supply of fresh arugula in windows with little light. Practical tips to ensure healthy growth, even in limited sunlight.',
            'post_image' => 'arugula.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
