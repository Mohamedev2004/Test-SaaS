<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function index()
{
    $packs = Pack::with('features')->get();
    return view('admin.packs.pack-list', compact('packs'));
}


public function destroy($id)
{
    $pack = Pack::findOrFail($id);
    $pack->delete();

    return redirect()->route('packlist')->with('success', 'Le pack a été supprimé avec succès');

}

public function create()
{
    $features = Feature::all();  // Fetch all features from the database
    return view('admin.packs.pack-add', compact('features'));
}

public function store(Request $request)
{
    // Validate the input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:225', // Adding validation for description
        'pack_type' => 'required|string|max:225',
        'features' => 'array'
    ]);

    // Create the new pack with name and description
    $pack = Pack::create([
        'name' => $request->name,
        'description' => $request->description, // Use description instead of tag
        'pack_type' => $request->pack_type
    ]);

    // Attach the selected features to the pack
    if ($request->has('features')) {
        $pack->features()->attach($request->features);
    }

    // Redirect to the packs list page with a success message
    return redirect()->route('packlist')->with('success', 'Pack ajouté avec succès.');
}



public function edit($id)
{
    // Fetch the pack by its ID
    $pack = Pack::with('features')->findOrFail($id);
    $features = Feature::all();  // Get all features to display in the form

    return view('admin.packs.pack-edit', compact('pack', 'features'));
}


public function update(Request $request, $id)
{
    // Validate the input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:225',  // Add validation for description
        'features' => 'array|nullable',  // Ensure features is an array if selected
    ]);

    // Find the pack by its ID
    $pack = Pack::findOrFail($id);

    // Update the pack details
    $pack->name = $request->input('name');
    $pack->description = $request->input('description');
    $pack->save();

    // Sync the features with the pivot table
    if ($request->has('features')) {
        // Attach the selected features to the pack
        $pack->features()->sync($request->input('features'));
    } else {
        // If no features are selected, detach all previous ones
        $pack->features()->detach();
    }

    // Redirect to the pack list page with a success message
    return redirect()->route('packlist')->with('success', 'Le pack a été mis à jour avec succès');
}
}
