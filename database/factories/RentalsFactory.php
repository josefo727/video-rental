<?php

namespace Database\Factories;

use App\Models\Rentals;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rentals::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'total_value' => $this->faker->randomNumber(2),
            'view_limit' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
            'video_id' => \App\Models\Video::factory(),
        ];
    }
}
