<?php

namespace Database\Factories;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'replay' => fake()->text(),
            'user_id' => random_int(DB::table('users')->min('id'), DB::table('users')->max('id')),
            'comment_id' => random_int(DB::table('comments')->min('id'), DB::table('comments')->max('id')),
        ];
    }
}
