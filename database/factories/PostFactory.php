<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'video' => $this->maybeCreateVideo(),
            'images' => $this->maybeCreateImages(),
        ];
    }

    /**
     * Maybe create a video file (50% chance) with max 10 seconds duration
     */
    protected function maybeCreateVideo(): ?string
    {
        if (!$this->faker->boolean(50)) {
            return null;
        }

        try {
            // Download a short sample video (under 10 seconds)
            $videoUrl = 'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4';
            $tempFile = tempnam(sys_get_temp_dir(), 'vid_') . '.mp4';
            file_put_contents($tempFile, file_get_contents($videoUrl));

            // Verify and ensure video is under 10 seconds
            $tempFile = $this->ensureVideoDuration($tempFile, 10);

            // Store with uniqid filename
            $filename = 'vid_' . uniqid() . '.mp4';
            Storage::disk('public')->putFileAs(
                'videos',
                new File($tempFile),
                $filename
            );

            unlink($tempFile);
            return 'videos/' . $filename;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Ensure video doesn't exceed max duration (in seconds)
     */
    protected function ensureVideoDuration(string $path, int $maxSeconds): string
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_PATH', '/usr/bin/ffmpeg'),
            'ffprobe.binaries' => env('FFPROBE_PATH', '/usr/bin/ffprobe'),
        ]);

        $video = $ffmpeg->open($path);
        $duration = $video->getFormat()->get('duration');

        if ($duration <= $maxSeconds) {
            return $path;
        }

        // If video is too long, trim it
        $outputPath = tempnam(sys_get_temp_dir(), 'shortvid_') . '.mp4';
        $video
            ->filters()
            ->clip(TimeCode::fromSeconds(0), TimeCode::fromSeconds($maxSeconds));
        $video->save(new \FFMpeg\Format\Video\X264(), $outputPath);

        unlink($path); // Delete original
        return $outputPath;
    }

    /**
     * Maybe create 1-3 images (80% chance)
     */
    protected function maybeCreateImages(): ?string
    {
        if (!$this->faker->boolean(80)) {
            return null;
        }

        $imageCount = $this->faker->numberBetween(1, 3);
        $imagePaths = [];

        for ($i = 0; $i < $imageCount; $i++) {
            try {
                $imageUrl = 'https://picsum.photos/800/600?random=' . $i;
                $tempFile = tempnam(sys_get_temp_dir(), 'img_') . '.jpg';
                file_put_contents($tempFile, file_get_contents($imageUrl));

                $filename = 'img_' . uniqid() . '.jpg';
                Storage::disk('public')->putFileAs(
                    'posts_images',
                    new File($tempFile),
                    $filename
                );

                $imagePaths[] = 'posts_images/' . $filename;
                unlink($tempFile);
            } catch (\Exception $e) {
                continue;
            }
        }

        return !empty($imagePaths) ? json_encode($imagePaths) : null;
    }

    public function configure()
    {
        return $this->afterMaking(function (Post $post) {
            if ($post->video && !Storage::disk('public')->exists($post->video)) {
                $post->video = null;
            }

            if ($post->images) {
                $images = json_decode($post->images, true);
                $validImages = array_filter($images, fn($img) => Storage::disk('public')->exists($img));
                $post->images = !empty($validImages) ? json_encode(array_values($validImages)) : null;
            }
        });
    }
}
