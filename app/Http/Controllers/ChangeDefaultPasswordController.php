<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangeDefaultPasswordController extends Controller
{
    public function show()
    {
        return view('forms.change-default-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->has_default_password = false;
        $user->save();

        return redirect()->route('influencer_welcome')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}
