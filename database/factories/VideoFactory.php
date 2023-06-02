<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'attributes' => $this->faker->text(255),
            'original_language' => $this->faker->text(255),
            'classification' => $this->faker->text(255),
            'series_id' => \App\Models\Series::factory(),
        ];
    }
}
