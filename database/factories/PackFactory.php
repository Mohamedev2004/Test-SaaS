<?php

namespace Database\Factories;

use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pack>
 */
class PackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pack::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => fake()->sentence(),
            'pack_type' => $this->faker->randomElement(['1','3','6','12']),
            'pack_duration' => $this->faker->randomNumber(),
        ];
    }
}
