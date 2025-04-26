<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Collaboration;
use App\Models\ContactBrand;
use App\Models\ContactInfluencer;
use App\Models\Feature;
use App\Models\Influencer;
use App\Models\Pack;
use App\Models\Post;
use App\Models\Sector;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // Clear storage directories
        Storage::disk('public')->deleteDirectory('posts_images');
        Storage::disk('public')->deleteDirectory('profile_images');
        Storage::disk('public')->deleteDirectory('videos');

        // Create directories
        Storage::disk('public')->makeDirectory('posts_images');
        Storage::disk('public')->makeDirectory('profile_images');
        Storage::disk('public')->makeDirectory('videos');

        // Create sectors and collaborations
        Sector::factory(5)->create();
        Collaboration::factory(3)->create();

        // Create packs and features
        $packs = Pack::factory(3)->create();
        Feature::factory(5)->create();

        // Attach features to packs
        foreach ($packs as $pack) {
            $pack->features()->attach(Feature::all()->random(2));
        }

        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'Active'
        ]);

        // Create 140 users (Brands and Influencers)
        User::factory(10)->create()->each(function ($user) {
            if ($user->role === 'brand') {
                $brand = Brand::factory()->create(['user_id' => $user->id]);

                // Create 1-3 posts for each brand
                Post::factory(rand(1, 3))->create([
                    'user_id' => $user->id,
                ]);
            } elseif ($user->role === 'influencer') {
                $influencer = Influencer::factory()->create(['user_id' => $user->id]);

                // Create 2-5 posts for each influencer
                Post::factory(rand(2, 5))->create([
                    'user_id' => $user->id,
                ]);
            }
        });

        // Create contact records
        ContactBrand::factory(5)->create();
        ContactInfluencer::factory(5)->create();

        // Create sponsors
        Sponsor::factory(5)->create();
    }
}
