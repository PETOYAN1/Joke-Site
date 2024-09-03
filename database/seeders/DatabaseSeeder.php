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
        Category::factory(3)->create();
        User::factory(3)->create();
        Post::factory(3)->create();
        Like::factory(3)->create();
        Rate::factory(3)->create();
        View::factory(3)->create();
        Follow::factory(3)->create();
        Comment::factory(3)->create();
        Reply::factory(3)->create();

    }
}
