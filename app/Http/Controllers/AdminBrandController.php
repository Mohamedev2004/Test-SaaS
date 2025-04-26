<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandPack;
use App\Models\Pack;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AdminBrandController extends Controller
{
    // Function to fetch all brands
    public function index()
    {
        $brands = User::where('role', 'brand')->get();
        $activeBrands = User::where('role', 'brand')->where('status', 'Active')->get();
        $inactiveBrands = User::where('role', 'brand')->where('status', 'Inactive')->get();

        $total = $brands->count();
        $active = $activeBrands->count();
        $inactive = $inactiveBrands->count();

        return view('admin.brand.brand-list', compact('brands', 'activeBrands', 'inactiveBrands', 'total', 'active', 'inactive'));
    }

    public function new()
    {
        $brands = User::where('role', 'brand')
            ->where('created_at', '>=', Carbon::now()->subDays(2))
            ->get();
        $total = $brands->count();

        $activeBrands = $brands->filter(fn($brand) => $brand->status === 'Active');
        $inactiveBrands = $brands->filter(fn($brand) => $brand->status === 'Inactive');

        $active = $activeBrands->count();
        $inactive = $inactiveBrands->count();

        return view('admin.users.newbrand', compact('brands', 'total', 'active', 'inactive', 'activeBrands', 'inactiveBrands'));
    }



    public function destroy($id)
    {
        // Find the user with the role 'brand' by ID and delete them
        $brand = User::where('role', 'brand')->findOrFail($id);
        $brand->delete();

        // Redirect back to the brand list with a success message
        return redirect()->route('brandlist')->with('success', 'La marque a bien été supprimée');
    }

    // To show the brand status update page
    public function showStatusForm($id)
    {

        $brand = User::where('role', 'brand')->find($id);
        if (!$brand) {
            return redirect()->back();
        }
        $packs = Pack::whereHas('features')->get();

        return view('admin.brand.brand-status', compact('brand', 'packs'));
    }


    // Method to update the brand's status
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Active,Inactive',
            'pack_id' => 'required|exists:packs,id',
        ]);

        $user = User::where('role', 'brand')->findOrFail($id);
        $newStatus = $validated['status'];
        $newPack = Pack::findOrFail($validated['pack_id']);

        // Get the associated brand
        $brand = Brand::firstOrCreate([
            'user_id' => $user->id
        ],[
            'pack_id' => $newPack->id
        ]);

        $currentBrandPack = $brand?->brandPacks()
                ->orderByDesc('end_date')
                ->first();

        // ⛔ Prevent deactivation if pack still active
        if ($user->status === 'Active' && $newStatus === 'Inactive') {
            if ($currentBrandPack && now()->lt($currentBrandPack->end_date)) {
                return redirect()->route('brandlist')
                    ->with('error', 'Impossible de désactiver ce compte avant la fin de la durée du pack.');
            }
        }

        // ✅ Update user status and current pack
        $user->update([
            'status' => $newStatus,
            'pack_id' => $newPack->id,
        ]);

        // 📆 Calculate new pack dates
        $startDate = ($currentBrandPack && now()->lt($currentBrandPack->end_date))
            ? $currentBrandPack->end_date
            : now();

        $endDate = Carbon::parse($startDate)->addDays($newPack->pack_duration);

        // 💾 Create new entry in pivot table
        BrandPack::create([
            'brand_id' => $brand->id,
            'pack_id' => $newPack->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return redirect()->route('brandlist')->with('success', 'Statut et pack mis à jour avec succès.');
    }



    public function renewPack($brandId)
    {
        $brand = Brand::findOrFail($brandId);

        // Get the latest pack history
        $lastPack = BrandPack::where('brand_id', $brand->id)
            ->latest('end_date')
            ->first();

        if (!$lastPack) {
            return redirect()->back()->with('error', 'Aucun pack trouvé à renouveler.');
        }

        $pack = Pack::findOrFail($lastPack->pack_id);

        $newStart = Carbon::parse($lastPack->end_date);

        $newEnd = $newStart->copy()->addDays($pack->pack_duration);

        // Create a new brand_pack entry
        BrandPack::create([
            'brand_id' => $brand->id,
            'pack_id' => $pack->id,
            'start_date' => $newStart,
            'end_date' => $newEnd,
        ]);

        $brand->user->status = 'Active';
        $brand->user->save();

        return redirect()->back()->with('success', 'Pack renouvelé avec succès et statut mis à jour.');
    }



    public function packShow()
    {
        // Existing logic
        $brands = Brand::with([
            'user',
            'brandPacks' => function ($query) {
                $query->latest('end_date');
            }
        ])
            ->has('brandPacks')
            ->get();

        return view('admin.brand.brand-renew', compact('brands'));
    }

}
