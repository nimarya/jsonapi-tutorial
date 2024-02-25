<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(5)->create();
        $categories = Category::factory()->count(5)->create();

        Post::factory()->count(100)->create([
            'author_id' => fn() => $users->random(),
        ]);

        Post::all()->each(function ($post) use ($categories) { 
            $post->categories()->attach(
                $categories->random(rand(1, 2))->pluck('id')->toArray()
            ); 
        });
    }
}
