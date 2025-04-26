<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Collaboration;
use App\Models\Pack;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        $companyName = $this->faker->company;
        $domain = strtolower(preg_replace('/[^a-z0-9]/i', '', $companyName));

        return [
            'user_id' => User::factory(),
            'logo_image' => $this->storeBrandLogo($domain),
            'brandName' => $companyName,
            'brandSize' => $this->faker->randomElement(['Petite', 'Moyenne', 'Grande']),
            'brandDescription' => $this->faker->paragraph(3),
            'brandLocalisation' => $this->faker->city,
            'pack_id' => Pack::factory(),
            'collaboration_id' => Collaboration::factory(),
        ];
    }

    protected function storeBrandLogo(string $domain): string
    {
        try {
            // Try Clearbit first
            return $this->storeLogoFromUrl(
                'https://logo.clearbit.com/' . $domain . '.com?size=400'
            );
        } catch (\Exception $e) {
            // Fallback to placeholder
            return $this->storeDefaultBrandLogo();
        }
    }

    protected function storeDefaultBrandLogo(): string
    {
        $placeholderUrls = [
            'https://via.placeholder.com/200/EFEFEF/000000?text=BRAND+LOGO',
            'https://via.placeholder.com/200/F5F5F5/000000?text=' . urlencode($this->faker->word),
            'https://via.placeholder.com/200/E0E0E0/000000?text=' . urlencode(substr($this->faker->company, 0, 12))
        ];

        try {
            return $this->storeLogoFromUrl(
                $this->faker->randomElement($placeholderUrls)
            );
        } catch (\Exception $e) {
            // Ultimate fallback - simple SVG logo
            return $this->createSimpleSvgLogo();
        }
    }

    protected function storeLogoFromUrl(string $url): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'brand_') . '.png';

        $response = Http::timeout(10)->get($url);
        if (!$response->successful()) {
            throw new \Exception("Failed to download logo");
        }

        file_put_contents($tempFile, $response->body());

        $filename = 'logo_' . uniqid() . '.png';
        Storage::disk('public')->putFileAs(
            'posts_images',
            new File($tempFile),
            $filename
        );

        unlink($tempFile);
        return 'posts_images/' . $filename;
    }

    protected function createSimpleSvgLogo(): string
    {
        $filename = 'logo_' . uniqid() . '.svg';
        $color = $this->faker->hexColor;
        $text = substr($this->faker->company, 0, 3);

        $svg = <<<SVG
<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg">
  <rect width="100%" height="100%" fill="$color"/>
  <text x="50%" y="50%" font-family="Arial" font-size="24"
        fill="white" text-anchor="middle" dominant-baseline="middle">
    $text
  </text>
</svg>
SVG;

        Storage::disk('public')->put('posts_images/' . $filename, $svg);
        return 'posts_images/' . $filename;
    }

    public function configure()
    {
        return $this->afterMaking(function (Brand $brand) {
            if (!Storage::disk('public')->exists($brand->logo_image)) {
                $brand->logo_image = $this->storeDefaultBrandLogo();
            }
        });
    }
}
