<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Collaboration;
use App\Models\ContactInfluencer;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInfluencer>
 */
class ContactInfluencerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ContactInfluencer::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'brand_id' => Brand::factory(),
            'collaboration_id' => Collaboration::factory(),
            'message' => $this->faker->paragraph,
        ];
    }
}
