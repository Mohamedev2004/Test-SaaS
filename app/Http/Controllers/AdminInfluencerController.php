<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminInfluencerController extends Controller
{
    // Display the list of influencers
    public function index()
    {
        $influencers = User::where('role', 'influencer')->get(); // Fetch users with 'influencer' role
        $total = $influencers->count();

        $activeInfluencers = $influencers->filter(fn($influencer) => $influencer->status === 'Active');
        $inactiveInfluencers = $influencers->filter(fn($influencer) => $influencer->status === 'Inactive');

        $active = $activeInfluencers->count();
        $inactive = $inactiveInfluencers->count();

        return view('admin.influencer.influencer-list', compact('influencers', 'total', 'active', 'inactive', 'activeInfluencers', 'inactiveInfluencers'));
    }

    public function new()
    {
        $influencers = User::where('role', 'influencer')
                   ->where('created_at', '>=', Carbon::now()->subDays(2))
                   ->get();
        $total = $influencers->count();

        $activeInfluencers = $influencers->filter(fn($influencer) => $influencer->status === 'Active');
        $inactiveInfluencers = $influencers->filter(fn($influencer) => $influencer->status === 'Inactive');

        $active = $activeInfluencers->count();
        $inactive = $inactiveInfluencers->count();

        return view('admin.users.newinfluencers', compact('influencers', 'total', 'active', 'inactive', 'activeInfluencers', 'inactiveInfluencers'));
    }

    // Delete an influencer (user with 'influencer' role)
    public function destroy($id) {
        $influencer = User::where('role', 'influencer')->findOrFail($id);
        $influencer->delete();
        return redirect()->back()->with('success', 'influenceur a bien été supprimé');
    }

    // Show influencer status update form
    public function showStatusForm($id)
    {
        $influencer = User::where('role', 'influencer')->find($id);
        if (!$influencer) {
            return redirect()->back();
        }
        return view('admin.influencer.influencer-status', compact('influencer'));
    }

    // Update the influencer's status
    public function updateStatus(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'status' => 'required|in:Active,Inactive',
        ]);

        // Find the user with 'influencer' role
        $influencerUser = User::where('role', 'influencer')->findOrFail($id);

        // Update user status
        $influencerUser->update([
            'status' => $request->input('status'),
        ]);

        // Check if influencer record already exists
        $influencer = Influencer::where('user_id', $id)->first();

        // If it doesn't exist, create a new influencer record with just user_id
        if (!$influencer) {
            Influencer::create([
                'user_id' => $id,
            ]);
        }

        return redirect()->route('influencerlist')->with('success', 'Statut mis à jour avec succès.');
    }


}
