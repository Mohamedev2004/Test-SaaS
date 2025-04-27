<?php

namespace Database\Factories;

use App\Models\Influencer;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class InfluencerFactory extends Factory
{
    protected $model = Influencer::class;

    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $genderDisplay = $gender === 'male' ? 'Masculin' : 'Feminin';

        // Generate a temporary image URL from an API
        $imageUrl = $this->getProfileImageUrl($gender);

        return [
            'user_id' => User::factory(),
            'profile_image' => $this->storeProfileImage($imageUrl),
            'influencerName' => $this->faker->name($gender),
            'nbr_abonne' => $this->faker->numberBetween(1000, 1000000),
            'influencerDescription' => $this->faker->paragraph(3),
            'influencerAge' => $this->faker->numberBetween(18, 45),
            'sexe' => $genderDisplay,
            'influencerPlatforms' => json_encode($this->getRandomPlatforms()), // Store platforms as JSON
            'sector_id' => Sector::factory(),
        ];
    }

    /**
     * Generate a profile image URL based on gender
     */
    private function getProfileImageUrl(string $gender): string
    {
        $services = [
            'randomuser' => 'https://randomuser.me/api/portraits/' .
                ($gender === 'male' ? 'men' : 'women') . '/' .
                $this->faker->numberBetween(1, 99) . '.jpg',
            'dicebear' => 'https://avatars.dicebear.com/api/avataaars/' .
                $this->faker->word . '.svg?background=%23ffffff',
            'unsplash' => 'https://source.unsplash.com/random/300x300/?' .
                ($gender === 'male' ? 'man' : 'woman') . ',portrait'
        ];

        return $this->faker->randomElement($services);
    }

    /**
     * Store the profile image in public storage
     */
    private function storeProfileImage(string $imageUrl): string
    {
        try {
            // Create temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'inf_') . '.jpg';

            // Download the image
            $imageContent = @file_get_contents($imageUrl);
            if ($imageContent === false) {
                throw new \Exception("Failed to download image");
            }

            file_put_contents($tempFile, $imageContent);

            // Store in public storage
            $filename = 'profile_' . uniqid() . '.jpg';
            $path = Storage::disk('public')->putFileAs(
                'profile_images',
                new File($tempFile),
                $filename
            );

            // Clean up
            unlink($tempFile);

            return 'profile_images/' . $filename;
        } catch (\Exception $e) {
            return 'profile_images/default.jpg'; // Default image in case of error
        }
    }

    /**
     * Generate random social media platforms
     */
    private function getRandomPlatforms(): array
    {
        $platforms = [
            ['Instagram'],
            ['TikTok'],
            ['YouTube'],
            ['Instagram', 'TikTok'],
            ['Instagram', 'YouTube'],
            ['TikTok', 'YouTube'],
            ['Instagram', 'TikTok', 'YouTube'],
            ['Twitter', 'Instagram']
        ];

        return $this->faker->randomElement($platforms);
    }

    /**
     * Configure the factory to ensure images exist
     */
    public function configure()
    {
        return $this->afterMaking(function (Influencer $influencer) {
            if (!Storage::disk('public')->exists($influencer->profile_image)) {
                $influencer->profile_image = 'profile_images/default.jpg';
            }
        });
    }
}
