<?php

namespace App\Http\Controllers;

use App\Models\ContactBrand;
use Illuminate\Http\Request;

class ContactBrandController extends Controller
{
    public function index()
    {
        $brandMessages = ContactBrand::with(['user', 'influencer'])->get();
        return view('admin.brand.brand-message', compact('brandMessages'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'influencer_id' => 'required|exists:influencers,id',
            'collaboration_id' => 'required|exists:collaborations,id',
            'message' => 'required|string|max:2000',
        ]);

        // Create the contact record
        ContactBrand::create([
            'user_id' => auth()->id(),
            'influencer_id' => $validated['influencer_id'],
            'collaboration_id' => $validated['collaboration_id'],
            'message' => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'Message envoyé avec succès');
    }
}
