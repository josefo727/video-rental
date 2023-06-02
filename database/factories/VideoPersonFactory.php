<?php

namespace Database\Factories;

use App\Models\VideoPerson;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoPersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoPerson::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video_id' => \App\Models\Video::factory(),
            'people_id' => \App\Models\People::factory(),
        ];
    }
}
