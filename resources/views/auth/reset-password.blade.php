@extends('layouts.forms')

@section('content')

<a href="{{ route('welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
    &larr;
</a>

<div class="w-full max-w-md bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
    <h2 class="text-2xl sm:text-3xl font-bold text-white">Nouveau mot de passe</h2>
    <p class="text-base sm:text-lg mt-2">
        Entrez votre adresse e-mail et votre nouveau mot de passe ci-dessous pour réinitialiser votre mot de passe.
    </p>

    <form class="mt-6 text-left" method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Jeton de réinitialisation -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Adresse e-mail -->
        <div>
            <label class="block font-medium">E-mail</label>
            <input type="email" name="email" placeholder="E-mail" class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none"
                value="{{ old('email', $request->email) }}" required autofocus>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nouveau mot de passe -->
        <div class="mt-4">
            <label class="block font-medium">Nouveau mot de passe</label>
            <input id="reset-password" type="password" name="password" placeholder="Nouveau mot de passe" class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirmer le mot de passe -->
        <div class="mt-4">
            <label class="block font-medium">Confirmer le mot de passe</label>
            <input id="reset-cpassword" type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none" required>
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-2 flex items-center">
            <input type="checkbox" id="show-password" class="form-checkbox text-blue-600 w-4 h-4 mr-2">
            <label for="show-password" class="text-sm">Afficher le mot de passe</label>
        </div>

        <button type="submit" class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">
            Réinitialiser le mot de passe
        </button>
    </form>

    <p class="mt-4 text-xs sm:text-sm">
        <a href="{{ route('login') }}" class="text-white underline">Retour à la connexion</a>
    </p>
</div>

@endsection
