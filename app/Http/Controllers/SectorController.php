<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index() {
        $sectors = Sector::all(); // Fetch all sectors
        return view('admin.sectors.sector-list', compact('sectors')); // Pass to view
    }

    public function destroy($id)
    {
        // Find the sector by id and delete it
        $sector = Sector::findOrFail($id);
        $sector->delete();

        // Redirect back to the brand list with a success message
        return redirect()->route('sectorlist')->with('success', 'Secteur supprimé avec succès');
    }

    // To show the brand status update page
    public function showSectorEditForm($id)
    {
        // Find the brand by id
        $sector = Sector::findOrFail($id);

        // Return the view with the brand data
        return view('admin.sectors.sector-edit', compact('sector'));
    }

    public function add()
    {
        return view('admin.sectors.sector-add'); // The view to show the form
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255', // Validation rule for 'name'
        ]);

        // Create the new sector
        Sector::create([
            'name' => $request->name,  // Store the 'name' from the form
        ]);

        // Redirect to the sector list with a success message
        return redirect()->route('sectorlist')->with('success', 'Le secteur a été ajouté avec succès');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the sector by its id
        $sector = Sector::findOrFail($id);

        // Update the sector's name
        $sector->update($validated);

        // Redirect to the sector list with a success message
        return redirect()->route('sectorlist')->with('success', 'Le secteur a été mis à jour avec succès');
    }
}
