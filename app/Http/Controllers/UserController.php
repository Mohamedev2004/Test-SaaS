<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreatedByAdminMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required'
        ]);

        $password = Str::random(10);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => $request->user_type,
            'has_default_password' => true,
        ]);

        Mail::to($user->email)->send(new AccountCreatedByAdminMail($user->name,$user->email,$password));

        return redirect()->route('admindashboard')->with('success', 'Utilisateur créé avec succès.');
    }
}
