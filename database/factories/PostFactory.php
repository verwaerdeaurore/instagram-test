<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'txt' => $this->faker->realTextBetween($minNbChars = 1, $maxNbChars = 500),
            'img_path' => function () {
                $absolutePath = fake()->image(storage_path('app/public/images'), 640, 480, 'cats', true);

                return str_replace(storage_path('app/public/'), '', $absolutePath);
            },

            'published_at' => $this->faker->dateTimeBetween('-2 months'),
            'user_id' => User::all()->random()->id,
        ];
    }
}
