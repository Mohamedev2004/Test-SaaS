<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Collaboration;
use App\Models\Influencer;
use App\Models\Meeting;
use App\Models\Post;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve all active brands, ordered by pack duration (long to short)
        $brands = Brand::with(['collaboration', 'sector', 'user'])
            ->join('packs', 'brands.pack_id', '=', 'packs.id')
            ->whereHas('user', function ($query) {
                $query->where('status', 'Active');
            })
            ->whereNotNull('brands.user_id')
            ->whereNotNull('brands.pack_id')
            ->whereNotNull('brands.collaboration_id')
            ->whereNotNull('brands.sector_id')
            ->whereNotNull('brands.brandName')
            ->whereNotNull('brands.brandSize')
            ->whereNotNull('brands.brandDescription')
            ->whereNotNull('brands.brandLocalisation')
            ->orderByDesc('packs.pack_duration')  // Always order by pack duration from long to short
            ->select('brands.*', 'packs.pack_duration')  // Select necessary columns
            ->paginate(6);  // Paginate the results, 6 per page

        // Handle the pagination for Ajax requests
        if ($request->ajax()) {
            $isAuthenticated = auth()->check();
            $user = auth()->user();

            return response()->json([
                'brands' => $brands->map(function ($brand) use ($isAuthenticated, $user) {
                    return [
                        'logo_image' => $brand->logo_image
                            ? Storage::disk('do_spaces')->url($brand->logo_image)
                            : asset('assets/images/influencer-default.jpg'),
                        'brandName' => $brand->brandName,
                        'brandLocalisation' => $brand->brandLocalisation,
                        'sector_name' => $brand->sector->name,
'show_url' => $isAuthenticated
    ? ($user->isBrand()
        ? route('show_brand_auth_brand', $brand->id)
        : ($user->isInfluencer()
            ? route('show_brand_auth_influencer', $brand->id)
            : ($user->isAdmin()
                ? route('show_brand_auth_admin', $brand->id) // 👈 use your new route for Admin
                : route('show_brand_guest', $brand->id)))
    )
    : route('show_brand_guest', $brand->id), // Fallback to guest route if not authenticated

                        'brandDescription' => $brand->brandDescription,
                        'brandSize' => $brand->brandSize,
                        'collaboration_type' => $brand->collaboration->name,
                    ];
                }),
                'pagination' => (string) $brands->links(), // Pagination links
            ]);
        }

        // Get active brands count
        $activeBrandsCount = Brand::whereHas('user', function ($query) {
            $query->where('status', 'Active');
        })
        ->whereNotNull('user_id')
        ->whereNotNull('pack_id')
        ->whereNotNull('collaboration_id')
        ->whereNotNull('sector_id')
        ->whereNotNull('brandName')
        ->whereNotNull('brandSize')
        ->whereNotNull('brandDescription')
        ->whereNotNull('brandLocalisation')
        ->count();

        // Calculate 80% of active brands
        $eightyPercentCount = round($activeBrandsCount * 0.8);

        return view('welcome', compact('brands', 'eightyPercentCount'));
    }


    public function show_brand($id)
    {
        // Fetch the brand along with its relationships (collaboration, sector, and posts)
        $brand = Brand::with(['collaboration', 'sector'])->find($id);

        // If no brand found or the necessary relationships are missing, redirect back
        if (!$brand || !$brand->collaboration || !$brand->sector) {
            return redirect()->back()->with('error', 'Brand not found or missing required relationships.');
        }

        // Get the user associated with this brand
        $user = User::find($brand->user_id);

        // Fetch the posts associated with the user of this brand
        $posts = Post::where('user_id', $user->id)->get();

        // Fetch other brands for the sidebar or whatever purpose
        $brands = Brand::with('sector')
            ->whereHas('user', function($q) {
                $q->where('status', 'Active'); // Only users with 'Active' status
            })
            ->whereNotNull('user_id')
            ->whereNotNull('pack_id')
            ->whereNotNull('collaboration_id')
            ->whereNotNull('sector_id')
            ->whereNotNull('brandName')
            ->whereNotNull('brandSize')
            ->whereNotNull('brandDescription')
            ->whereNotNull('brandLocalisation')
            ->latest()
            ->limit(6)
            ->get();

        // Fetch collaborations
        $collaborations = Collaboration::all();

        // Return the brand view and pass the brand and posts data
        return view('pages.brand-profile', compact('brand', 'brands', 'posts', 'collaborations'));
    }



    public function show_influencer($id)
    {
        // Fetch the influencer along with its relationships (collaboration, sector, and posts)
        $influencer = Influencer::with(['sector'])->find($id);

        if (!$influencer ||  !$influencer->sector) {
            return redirect()->back()->with('error', 'Influencer not found or missing required relationships.');
        }

        // Get the user associated with this influencer
        $user = User::find($influencer->user_id);

        // Fetch the posts associated with the user of this influencer
        $posts = Post::where('user_id', $user->id)->get();

        // Fetch other influencers for the sidebar or whatever purpose
        $influencers = Influencer::with('sector')
        ->whereHas('user', function($q) {
            $q->where('status', 'Active'); // Only influencers with Active users
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
        ->limit(6)
        ->get();

        // Fetch collaborations
        $collaborations = Collaboration::all();
        // Return the influencer view and pass the influencer and posts data
        return view('pages.influencer-profile', compact('influencer', 'influencers', 'posts', 'collaborations'));
    }



    public function pack()
    {

        if (auth()->check() && auth()->user()->isBrand()) {
            return redirect()->route('brand_display');
        }
        if (auth()->check() && auth()->user()->isInfluencer()) {
            return redirect()->route('influencer_dashboard');
        }

        return redirect()->route('login');
    }

    public function sponsoring()
    {
        return view('forms.sponsor');
    }

    public function sponsoring_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'pdf' => 'required|mimes:pdf|max:10240', // PDF validation
        ]);

        // Step 1: Store the file with uniqid
        $pdfPath = $request->file('pdf')->storeAs(
            'sponsoring_pdfs',
            uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension(),
            'do_spaces' // clean, valid parameter
        );

        // Step 2: Create the new sponsor record
        Sponsor::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'file_path' => $pdfPath, // Storing the file path
        ]);

        // Step 3: Redirect with a success message
        return redirect()->back()->with('success', 'Demande de sponsoring soumise avec succès');
    }

    public function demoRequest()
    {
        return view('forms.demande-demo');
    }

    public function meeting_store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'meeting_date' => 'required|date|after:today', // Ensure the meeting date is in the future
        ]);

        // Create a new meeting record in the database
        Meeting::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'meeting_date' => $request->meeting_date,
        ]);

        // Redirect back with a success message
        return redirect()->route('welcome')->with('success', 'Votre rencontre a été réservée avec succès!');
    }

    public function terms()
    {
        return view('terms-conditions');
    }

    public function press()
    {
        return view('relation-press');
    }

}
