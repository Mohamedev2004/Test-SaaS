<?php

namespace Database\Factories;

use App\Models\Collaboration;
use App\Models\ContactBrand;
use App\Models\Influencer;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactBrand>
 */
class ContactBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ContactBrand::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'influencer_id' => Influencer::factory(),
            'collaboration_id' => Collaboration::factory(),
            'message' => $this->faker->paragraph,
        ];
    }
}
