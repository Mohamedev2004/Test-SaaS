@extends('layouts.forms')

@section('content')

@auth
    @if (auth()->user()->isBrand())
    <a href="{{ route('brand_display') }}" class="absolute top-4 left-8 text-white text-4xl">
        &larr;
    </a>
    @elseif (auth()->user()->isInfluencer())
    <a href="{{ route('influencer_dashboard') }}" class="absolute top-4 left-8 text-white text-4xl">
        &larr;
    </a>
    @endif
@endauth
<div class="w-full max-w-md bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
    <h2 class="text-2xl sm:text-3xl font-bold text-white">Changer le mot de passe</h2>

    <form class="mt-6 text-left" method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Mot de passe actuel</label>
            <input type="password" name="current_password" placeholder="Mot de passe actuel"
                   class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none"
                   autocomplete="current-password" >
            @error('current_password', 'updatePassword')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label class="block font-medium">Nouveau mot de passe</label>
            <input type="password" name="password" placeholder="Nouveau mot de passe"
                   class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none"
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label class="block font-medium">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe"
                   class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none"
                   autocomplete="new-password" >
        </div>

        <button type="submit"
                class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">
            Mettre à jour le mot de passe
        </button>

        @if (session('status') === 'password-updated')
            <div class="text-green-300 mt-4 text-sm">Mot de passe mis à jour avec succès.</div>
        @endif
    </form>
</div>

@endsection
