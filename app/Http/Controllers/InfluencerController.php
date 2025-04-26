<?php

namespace App\Http\Controllers;

use \Log;
use App\Models\Influencer;
use App\Models\Post;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InfluencerController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function profile(){
        return view('pages.influencer-profile');
    }

    public function latests_influencers()
    {
        $latestInfluencers = Influencer::whereHas('user', function($q) {
            $q->where('status', 'Active'); // Only get influencers with Active users
        })
        ->whereNotNull('user_id')
        ->whereNotNull('influencerName')
        ->whereNotNull('nbr_abonne')
        ->whereNotNull('influencerDescription')
        ->whereNotNull('influencerAge')
        ->whereNotNull('sexe')
        ->whereNotNull('influencerPlatforms')
        ->whereNotNull('sector_id')
        ->latest()
        ->take(6)
        ->get();
        // Ensure influencerPlatforms is an array (if it's a JSON string)
        foreach ($latestInfluencers as $influencer) {
            if (is_string($influencer->influencerPlatforms)) {
                $influencer->influencerPlatforms = json_decode($influencer->influencerPlatforms, true);
            }
        }

        return view('pages.influencer', compact('latestInfluencers'));
    }

    public function filter(Request $request)
    {
        // Define follower ranges
        $follower_ranges = [
            '0-50000' => '0 - 50K',
            '50001-100000' => '50K - 100K',
            '100001-500000' => '100K - 500K',
            '500001-1000000' => '500K - 1M',
            '1000001' => '1M+'
        ];

        // Base query with required conditions
        $query = Influencer::whereHas('user', function($q) {
                $q->where('status', 'Active');
            })
            ->whereNotNull('user_id')
            ->whereNotNull('influencerName')
            ->whereNotNull('nbr_abonne')
            ->whereNotNull('influencerDescription')
            ->whereNotNull('influencerAge')
            ->whereNotNull('sexe')
            ->whereNotNull('influencerPlatforms')
            ->whereNotNull('sector_id');

        // Filter by search term
        if ($request->has('search') && $request->search) {
            $query->where('influencerName', 'like', '%' . $request->search . '%');
        }

        // Filter by sector
        if ($request->has('sector') && $request->sector) {
            $query->where('sector_id', $request->sector);
        }

        // Filter by gender
        if ($request->has('gender')) {
            $query->whereIn('sexe', $request->gender);
        }

        // Filter by followers count
        if ($request->has('nbr_abonnes') && !empty($request->nbr_abonnes)) {
            $followers = $request->nbr_abonnes;

            $query->where(function ($q) use ($followers, $follower_ranges) {
                foreach ($followers as $range) {
                    if (isset($follower_ranges[$range])) {
                        $range_parts = explode('-', $range);
                        if (count($range_parts) === 1) {
                            // "1M+" case
                            $q->orWhere('nbr_abonne', '>=', (int)$range_parts[0]);
                        } else {
                            // Range like '0-50000'
                            $q->orWhereBetween('nbr_abonne', [(int)$range_parts[0], (int)$range_parts[1]]);
                        }
                    }
                }
            });
        }

        // Get paginated results and keep query filters in pagination links
        $influencers = $query->paginate(8)
                            ->appends($request->except('page'));

        $sectors = Sector::all();

        return view('pages.all-influencers', compact('influencers', 'sectors', 'follower_ranges'));
    }




    public function dashboard()
    {
        $user = auth()->user();
        $influencer = Influencer::with('posts')->where('user_id', $user->id)->first();
        $sectors = Sector::all();

        $selectedPlatforms = [];
        if ($influencer) {
            $selectedPlatforms = is_array($influencer->influencerPlatforms)
                               ? $influencer->influencerPlatforms
                               : json_decode($influencer->influencerPlatforms, true) ?? [];
        }

        return view('influencer-dashboard.index', compact(
            'influencer',
            'sectors',
            'selectedPlatforms'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'influencerName' => 'required|string|max:255',
            'influencerDescription' => 'required|string',
            'influencerAge' => 'required|integer|min:13|max:100',
            'sexe' => 'required|in:Masculin,Feminin',
            'nbr_abonne' => 'required|integer|min:0',
            'sector_id' => 'required|exists:sectors,id',
            'influencerPlatforms' => 'required|array',
            'influencerPlatforms.*' => 'string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'image_upload_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'image_upload_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'image_upload_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:102400',
        ]);

        // Process profile image
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $profileImageName = 'profile_' . uniqid() . '.' . $profileImage->getClientOriginalExtension();
            $profileImagePath = $profileImage->storeAs('profile_images', $profileImageName, 'do_spaces');
        }

        // Create influencer
        $influencer = Influencer::create([
            'user_id' => auth()->user()->id,
            'profile_image' => $profileImagePath,
            'influencerName' => $validated['influencerName'],
            'nbr_abonne' => $validated['nbr_abonne'],
            'influencerDescription' => $validated['influencerDescription'],
            'influencerAge' => $validated['influencerAge'],
            'sexe' => $validated['sexe'],
            'influencerPlatforms' => json_encode($validated['influencerPlatforms']),
            'sector_id' => $validated['sector_id'],
        ]);

        // Process post images
        $imagePaths = [];

        foreach (['image_upload_1', 'image_upload_2', 'image_upload_3'] as $index => $field) {
            if ($request->hasFile($field)) {
                $imageFile = $request->file($field);
                $imageName = 'img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePaths[] = $imageFile->storeAs('posts_images', $imageName, 'do_spaces');
            } elseif (!empty($request->final_images[$index])) {
                // Keep existing image if present in final_images and not empty
                $imagePaths[] = $request->final_images[$index];
            }
        }

        // Ensure null if no images
        $imagesData = !empty($imagePaths) ? json_encode($imagePaths) : null;

        // Process video with unique name
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoName = 'vid_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $videoPath = $videoFile->storeAs('videos', $videoName, 'do_spaces');
        }

        // Create post with the media
        Post::create([
            'user_id' => auth()->id(),
            'images' => $imagesData, // Store as NULL if empty
            'video' => $videoPath,
        ]);

        return redirect()->back()->with('success', 'Profil créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'influencerName' => 'required|string|max:255',
            'influencerDescription' => 'required|string',
            'influencerAge' => 'required|integer|min:13|max:100',
            'sexe' => 'required|in:Masculin,Feminin',
            'nbr_abonne' => 'required|integer|min:0',
            'sector_id' => 'required|exists:sectors,id',
            'influencerPlatforms' => 'required|array',
            'influencerPlatforms.*' => 'string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:102400',
            'final_images' => 'sometimes|array',
            'final_images.*' => 'nullable|string',
        ]);

        $influencer = Influencer::find($id);
        if (!$influencer) {
            return back()->with('error', 'Influencer not found.');
        }

        // Get or create post
        $post = $influencer->posts()->first();
        if (!$post) {
            $post = $influencer->posts()->create(['images' => null, 'video' => null]);
        }

        // Handle Profile Image
        if ($request->hasFile('profile_image')) {
            if ($influencer->profile_image) {
                Storage::disk('do_spaces')->delete($influencer->profile_image);
            }
            $profileFile = $request->file('profile_image');
            $profileName = 'profile_' . uniqid() . '.' . $profileFile->getClientOriginalExtension();
            $influencer->profile_image = $profileFile->storeAs('profile_images', $profileName, 'do_spaces');
        }

        // Handle Video
        if ($request->hasFile('video')) {
            if ($post->video) {
                Storage::disk('do_spaces')->delete($post->video);
            }
            $videoFile = $request->file('video');
            $videoName = 'vid_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $post->video = $videoFile->storeAs('videos', $videoName, 'do_spaces');
        }

        // Process Images
        $currentImages = json_decode($post->images ?? '[]', true);
        $finalImages = [];

// Process Images
$finalImages = [];
for ($i = 1; $i <= 3; $i++) {
    $uploadField = 'image_upload_' . $i;
    $submittedImage = $request->final_images[$i] ?? null;

    if ($request->hasFile($uploadField)) {
        // Handle new upload
        $imageFile = $request->file($uploadField);
        $imageName = 'img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $finalImages[] = $imageFile->storeAs('posts_images', $imageName, 'do_spaces');
    } elseif ($submittedImage && !in_array($submittedImage, $request->delete_images ?? [])) {
        // Keep existing image if not marked for deletion
        $finalImages[] = $submittedImage;
    }
}

// Handle image deletions
if ($request->has('delete_images')) {
    foreach ($request->delete_images as $imageToDelete) {
        Storage::disk('do_spaces')->delete($imageToDelete);
    }
}


        // Update Post
        $post->update([
            'images' => !empty($finalImages) ? json_encode($finalImages) : null,
            'video' => $post->video,
        ]);

        // Update Influencer
        $influencer->update([
            'influencerName' => $request->influencerName,
            'influencerDescription' => $request->influencerDescription,
            'influencerAge' => $request->influencerAge,
            'sexe' => $request->sexe,
            'nbr_abonne' => $request->nbr_abonne,
            'sector_id' => $request->sector_id,
            'influencerPlatforms' => json_encode($request->influencerPlatforms),
            'profile_image' => $influencer->profile_image,
        ]);

        return redirect()->back()->with('success', 'influenceur a été mis à jour avec succès');
    }



    // public function store(Request $request)
    // {
    //     $validated = $this->validateInfluencerData($request);
    //     $validated['influencerPlatforms'] = json_encode($validated['influencerPlatforms']);

    //     // Handle profile image
    //     if ($request->hasFile('profile_image')) {
    //         $path = $request->file('profile_image')->store('profile_images', 'public');
    //         $validated['profile_image'] = $path;
    //     }

    //     // Create or update influencer
    //     $influencer = Influencer::updateOrCreate(
    //         ['user_id' => Auth::id()],
    //         $validated
    //     );

    //     // Handle media
    //     $this->handleMedia($request);

    //     return redirect()->back()->with('success', 'Profile updated successfully');
    // }

    public function edit($id)
    {
        $influencer = Influencer::findOrFail($id);
        $sectors = Sector::all();
        $selectedPlatforms = json_decode($influencer->influencerPlatforms, true) ?? [];
        $posts = Post::where('user_id', Auth::id())->get();

        return view('influencer-dashboard.index', compact(
            'influencer',
            'sectors',
            'selectedPlatforms',
            'posts'
        ));
    }

    // public function update(Request $request, $id)
    // {
    //     $validated = $this->validateInfluencerData($request);
    //     $influencer = Influencer::findOrFail($id);
    //     $validated['influencerPlatforms'] = json_encode($validated['influencerPlatforms']);

    //     // Handle profile image
    //     if ($request->hasFile('profile_image')) {
    //         if ($influencer->profile_image) {
    //             Storage::disk('public')->delete($influencer->profile_image);
    //         }
    //         $path = $request->file('profile_image')->store('profile_images', 'public');
    //         $validated['profile_image'] = $path;
    //     }

    //     $influencer->update($validated);
    //     $this->handleMedia($request);

    //     return redirect()->back()->with('success', 'Profile updated successfully');
    // }

    public function removeMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:image,video',
            'path' => 'required|string',
            'post_id' => 'required|exists:posts,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $post = Post::findOrFail($request->post_id);

        try {
            if ($request->type === 'image') {
                $images = json_decode($post->images, true) ?? [];
                if (($key = array_search($request->path, $images)) !== false) {
                    unset($images[$key]);
                    Storage::disk('do_spaces')->delete($request->path);
                    $post->images = !empty($images) ? json_encode(array_values($images)) : null;
                    $post->save();
                }
            } else {
                if ($post->video === $request->path) {
                    Storage::disk('do_spaces')->delete($post->video);
                    $post->video = null;
                    $post->save();
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error removing media'], 500);
        }
    }

    protected function validateInfluencerData(Request $request)
    {
        return $request->validate([
            'influencerName' => 'required|string|max:255',
            'influencerAge' => 'required|integer|min:13|max:100',
            'influencerDescription' => 'nullable|string',
            'sexe' => 'required|in:Masculin,Feminin',
            'sector_id' => 'required|exists:sectors,id',
            'influencerPlatforms' => 'required|array|min:1',
            'influencerPlatforms.*' => 'required|string',
            'nbr_abonne' => 'required|integer|min:0',
            'profile_image' => 'nullable|image|max:2048',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:102400',
        ]);
    }

    protected function handleMedia(Request $request)
    {
        $user = Auth::user();
        $post = Post::firstOrNew(['user_id' => $user->id]);

        // Handle images
        $currentImages = $post->images ? json_decode($post->images, true) : [];

        // Remove deleted images
        if ($request->has('removed_images')) {
            $removedImages = json_decode($request->removed_images, true) ?? [];
            foreach ($removedImages as $image) {
                if (($key = array_search($image, $currentImages)) !== false) {
                    unset($currentImages[$key]);
                    Storage::disk('do_spaces')->delete($image);
                }
            }
            $currentImages = array_values($currentImages);
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if (count($currentImages) < 3) {
                    $path = $image->store('post_images', 'do_spaces');
                    $currentImages[] = $path;
                }
            }
        }

        $post->images = !empty($currentImages) ? json_encode($currentImages) : null;

        // Handle video
        if ($request->has('removed_video') && $request->removed_video === '1' && $post->video) {
            Storage::disk('do_spaces')->delete($post->video);
            $post->video = null;
        }

        if ($request->hasFile('video')) {
            if ($post->video) {
                Storage::disk('do_spaces')->delete($post->video);
            }
            $path = $request->file('video')->store('post_videos', 'do_spaces');
            $post->video = $path;
        }

        $post->save();
    }
}
