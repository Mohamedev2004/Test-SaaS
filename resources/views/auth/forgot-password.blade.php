@extends('layouts.forms')

@section('content')

<a href="{{ route('welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
    &larr;
</a>

<div class="w-full max-w-md bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
    <h2 class="text-2xl sm:text-3xl font-bold text-white">Réinitialiser le mot de passe</h2>
    <p class="text-base sm:text-lg mt-2">
        Mot de passe oublié ? Aucun souci. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien pour en créer un nouveau.
    </p>

    <form class="mt-6 text-left" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label class="block font-medium">E-mail</label>
            <input type="email" name="email" placeholder="E-mail" class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <p class="mt-4 text-xs sm:text-sm">
        <a href="{{ route('login') }}" class="text-white underline">Retour à la connexion</a>
    </p>
</div>

@endsection
