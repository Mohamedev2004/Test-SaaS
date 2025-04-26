<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorController extends Controller
{

    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsor.sponsoring-message', compact('sponsors'));
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:sponsors,email',
            'pdf' => 'required|mimes:pdf|max:2048', // Updated from 'file' to 'pdf'
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('pdf')) {
            $filePath = $request->file('pdf')->storeAs(
                'sponsors',
                uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension(),
                'do_spaces'
            );
        }

        // Store the form data in the database
        $sponsor = Sponsor::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'file_path' => $filePath,
        ]);

        // Redirect with success message
        return redirect()->route('influencer_welcome')->with('success', 'Demande envoyée avec succès!');
    }

}
