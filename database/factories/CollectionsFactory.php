<?php

namespace Database\Factories;

use App\Models\Collections;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collections::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
