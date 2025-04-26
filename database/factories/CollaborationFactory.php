<?php

namespace Database\Factories;

use App\Models\Collaboration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaboration>
 */
class CollaborationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Collaboration::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
