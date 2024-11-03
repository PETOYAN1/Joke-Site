<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Follow;
use App\Models\Category;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use App\Models\Rate;
use App\Models\View;
use App\Models\Reply;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(20)->create();
        User::factory(20)->create();
        Post::factory(20)->create();
        Like::factory(20)->create();
        Rate::factory(20)->create();
        View::factory(20)->create();
        Follow::factory(20)->create();
        Comment::factory(20)->create();
        Reply::factory(20)->create();

    }
}
