<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerFileName = $this->faker->image(
            storage_path("app/data"),
            800,
            600
        );
        return [
            'user_id' => random_int(DB::table('users')->min('id'), DB::table('users')->max('id')),
            'title' => fake()->name(),
            'description' => fake()->text(),
            'category_id' => random_int(DB::table('categories')->min('id'), DB::table('categories')->max('id')),
            'image' => "data/" . basename($fakerFileName),
            'published' => rand(0,1)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
