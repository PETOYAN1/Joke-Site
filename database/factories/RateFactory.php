<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(DB::table('users')->min('id'), DB::table('users')->max('id')),
            'post_id' => random_int(DB::table('posts')->min('id'), DB::table('posts')->max('id')),
            'rate' => User::IS_BLOCKED[rand(0,1)]
        ];
    }
}
