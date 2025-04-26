<?php

namespace App\Http\Controllers;

use App\Models\ContactInfluencer;
use Illuminate\Http\Request;

class ContactInfluencerController extends Controller
{
    public function index()
    {
        $influencerMessages = ContactInfluencer::with(['user', 'brand'])->get();
        return view('admin.influencer.influencer-message', compact('influencerMessages'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'brand_id' => 'required|exists:brands,id',
            'collaboration_id' => 'required|exists:collaborations,id',
            'message' => 'required|string|max:2000',
        ]);

        // Create the contact record
        ContactInfluencer::create([
            'user_id' => auth()->id(),
            'brand_id' => $validated['brand_id'],
            'collaboration_id' => $validated['collaboration_id'],
            'message' => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'Message envoyé avec succès');
    }
}
