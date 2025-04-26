<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    // List all features
    public function index()
    {
        $features = Feature::all();
        return view('admin.features.feature-list', compact('features'));
    }

    // Delete a specific feature
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        return redirect()->route('featurelist')->with('success', 'supprimée avec succès');
    }

    // Show the form to create a new feature
    public function create()
    {
        return view('admin.features.feature-add');
    }

    // Store a new feature in the database
    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'description' => 'required|string|max:500', // Adjusted for 'description'
        ]);

        // Create the new feature
        Feature::create([
            'description' => $request->description,  // Using description
        ]);

        // Redirect to the feature list page with a success message
        return redirect()->route('featurelist')->with('success', 'Feature ajouté avec succès');
    }

    // Show the form to edit an existing feature
    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('admin.features.feature-edit', compact('feature'));
    }

    // Update a feature in the database
    public function update(Request $request, $id)
    {
        // Validate the input fields
        $request->validate([
            'description' => 'required|string|max:500', // Adjusted for 'description'
        ]);

        // Find the feature by its ID
        $feature = Feature::findOrFail($id);

        // Update the feature details
        $feature->description = $request->input('description'); // Using description
        $feature->save();

        // Redirect to the feature list page with a success message
        return redirect()->route('featurelist')->with('success', 'Mise à jour réussie ');
    }
}
