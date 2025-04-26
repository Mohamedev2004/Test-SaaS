<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Collaboration;
use App\Models\Pack;
use App\Models\Post;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function filter(Request $request)
    {
        $query = Brand::whereHas('user', function ($q) {
                $q->where('status', 'Active');
            })
            ->whereNotNull('user_id')
            ->whereNotNull('pack_id')
            ->whereNotNull('collaboration_id')
            ->whereNotNull('sector_id')
            ->whereNotNull('brandName')
            ->whereNotNull('brandSize')
            ->whereNotNull('brandDescription')
            ->whereNotNull('brandLocalisation')
            ->join('packs', 'brands.pack_id', '=', 'packs.id') // Join packs table
            ->select('brands.*') // Select only brand columns to avoid conflict
            ->orderBy('packs.pack_duration', 'desc'); // Sort by pack_duration (change to 'asc' if needed)

        // Search by brand name
        if ($request->filled('search')) {
            $query->where('brandName', 'like', '%' . $request->search . '%');
        }

        // Filter by sector
        if ($request->has('sector') && $request->sector) {
            $query->where('sector_id', $request->sector);
        }

        // Filter by collaboration type
        if ($request->has('collaboration') && $request->collaboration) {
            $query->where('collaboration_id', $request->collaboration);
        }

        // Filter by size
        if ($request->filled('size')) {
            $query->whereIn('brandSize', $request->size);
        }

        $brands = $query->paginate(8)->appends($request->except('page'));

        $sectors = Sector::all();
        $collaborations = Collaboration::all();

        return view('pages.all-brands', compact('brands', 'sectors', 'collaborations'));
    }


    public function latests_brands()
    {
        $featurePackData =  Pack::whereHas('features')->with('features')->get();
        $latestBrands = Brand::whereHas('user', function($q) {
            $q->where('status', 'Active'); // Filter by 'Active' status in the users table
        })
        ->whereNotNull('user_id')           // Ensure user_id is not null
        ->whereNotNull('pack_id')           // Ensure pack_id is not null
        ->whereNotNull('collaboration_id')  // Ensure collaboration_id is not null
        ->whereNotNull('sector_id')         // Ensure sector_id is not null
        ->whereNotNull('brandName')         // Ensure brandName is not null
        ->whereNotNull('brandSize')         // Ensure brandSize is not null
        ->whereNotNull('brandDescription')  // Ensure brandDescription is not null
        ->whereNotNull('brandLocalisation') // Ensure brandLocalisation is not null
        ->latest()                          // Get the latest records
        ->take(6)                           // Limit to 6 results
        ->get();
        return view('pages.brand', compact('latestBrands','featurePackData'));
    }


    // public function profile(){
    //     return view('pages.brand-profile');
    // }
    public function dashboard(){
        // Fetch the brand data for the authenticated user (if exists)
        $brand = Brand::where('user_id', Auth::id())->first();
        $sectors = Sector::all();
        $collaborations = Collaboration::all();
        $posts  = Post::where('user_id',Auth::id())->get();
        return view('brand-dashboard.index', compact('brand', 'sectors','collaborations','posts'));
    }


    // public function display(){
    //     return view('components.footer');
    // }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'brandName' => 'required|string|max:255',
            'brandDescription' => 'required|string',
            'brandSize' => 'required|string',
            'brandLocalisation' => 'required|string',
            'sector_id' => 'required|exists:sectors,id',
            'collaboration_id' => 'required|exists:collaborations,id',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:102400',
            'final_images' => 'sometimes|array',
            'final_images.*' => 'nullable|string',
        ]);

        // Create brand with logo as NULL by default
        $brand = Brand::create([
            'user_id' => auth()->id(),
            'brandName' => $request->brandName,
            'brandDescription' => $request->brandDescription,
            'brandSize' => $request->brandSize,
            'brandLocalisation' => $request->brandLocalisation,
            'sector_id' => $request->sector_id,
            'collaboration_id' => $request->collaboration_id,
            'logo_image' => null,
        ]);

        // Process and store logo if uploaded
        if ($request->hasFile('logo_image')) {
            $logoFile = $request->file('logo_image');
            $logoName = 'logo_' . uniqid() . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('posts_images', $logoName, 'do_spaces');
            $brand->update(['logo_image' => $logoPath]);
        }

        // Process images - initialize an empty array
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

        return redirect()->back()->with('success', 'Votre marque a bien été enregistrée');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'brandName' => 'required|string|max:255',
            'brandDescription' => 'required|string',
            'brandSize' => 'required|string',
            'brandLocalisation' => 'required|string',
            'sector_id' => 'required|exists:sectors,id',
            'collaboration_id' => 'required|exists:collaborations,id',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'image_upload_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:102400',
            'final_images' => 'sometimes|array',
            'final_images.*' => 'nullable|string',
        ]);

        // Find the brand by its ID
        $brand = Brand::find($id);

        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }

        // Fetch existing post or create one if none exists
        $post = Post::firstOrCreate(
            ['user_id' => auth()->id()],
            ['video' => null, 'images' => null]  // Default values if no post exists
        );

        // 1. Handle Logo Image with uniqid() (Brands Table)
        if ($request->hasFile('logo_image')) {
            // Delete old logo if exists
            if ($brand->logo_image) {
                Storage::disk('do_spaces')->delete($brand->logo_image);
            }
            // Store new logo with unique name
            $logoFile = $request->file('logo_image');
            $logoName = 'logo_' . uniqid() . '.' . $logoFile->getClientOriginalExtension();
            $brand->logo_image = $logoFile->storeAs('posts_images', $logoName, 'do_spaces');
        }

        // 2. Handle Video with uniqid() (Posts Table)
        if ($request->hasFile('video')) {
            // Delete old video if exists
            if ($post->video) {
                Storage::disk('do_spaces')->delete($post->video);
            }
            // Store new video with unique name
            $videoFile = $request->file('video');
            $videoName = 'vid_' . uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $post->video = $videoFile->storeAs('videos', $videoName, 'do_spaces');
        }

        // 3. Process Images (EXACTLY as in your original update method)
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

        // Delete any images marked for removal
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageToDelete) {
                Storage::disk('do_spaces')->delete($imageToDelete);
            }
        }

        // Update Post (images + video)
        $post->update([
            'images' => !empty($finalImages) ? json_encode($finalImages) : null,
            'video' => $post->video, // Will be updated if new video was uploaded
        ]);

        // Update Brand
        $brand->update([
            'brandName' => $request->brandName,
            'brandDescription' => $request->brandDescription,
            'brandSize' => $request->brandSize,
            'brandLocalisation' => $request->brandLocalisation,
            'sector_id' => $request->sector_id,
            'collaboration_id' => $request->collaboration_id,
            'logo_image' => $brand->logo_image, // Updated if new logo was uploaded
        ]);

        return redirect()->back()->with('success', 'Les modifications de votre marque ont bien été enregistrées');
    }

}
