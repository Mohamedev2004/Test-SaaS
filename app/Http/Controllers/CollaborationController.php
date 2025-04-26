<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function index()
    {
        // Assuming you have a 'Collaboration' model
        $collaborations = Collaboration::all(); // Retrieve all collaborations from the database

        return view('admin.collaborations.collaboration-list', compact('collaborations')); // Pass the collaborations to the view
    }

    public function destroy($id)
    {
        // Find the collaboration by id and delete it
        $collaboration = Collaboration::findOrFail($id);
        $collaboration->delete();

        // Redirect back to the brand list with a success message
        return redirect()->route('collaborationlist')->with('success', 'La collaboration a bien été supprimée');
    }

    // To show the brand status update page
    public function showCollaborationEditForm($id)
    {
        // Find the brand by id
        $collaboration = Collaboration::findOrFail($id);

        // Return the view with the brand data
        return view('admin.collaborations.collaboration-edit', compact('collaboration'));
    }

    public function add()
    {
        return view('admin.collaborations.collaboration-add'); // The view to show the form
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255', // Validation rule for 'name'
        ]);

        // Create the new collaboration
        Collaboration::create([
            'name' => $request->name,  // Store the 'name' from the form
        ]);

        // Redirect to the collaboration list with a success message
        return redirect()->route('collaborationlist')->with('success', 'La collaboration a bien été créée');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the collaboration by its id
        $collaboration = Collaboration::findOrFail($id);

        // Update the collaboration's name
        $collaboration->update($validated);

        // Redirect to the collaboration list with a success message
        return redirect()->route('collaborationlist')->with('success', 'La collaboration a bien été modifiée');
    }
}
