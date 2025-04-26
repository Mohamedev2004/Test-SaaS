@extends('layouts.forms')

@section('content')

    <a href="{{ route('welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
        &larr;
    </a>

    <div class="w-full max-w-md bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-white">Vérification de l'adresse email</h2>

        <p class="text-base sm:text-lg mt-2">
            Un lien de vérification a été envoyé à votre adresse email.<br>
            Veuillez cliquer sur le lien pour activer votre compte.
        </p>

        <p class="text-sm mt-4">
            Vous n'avez pas reçu l'email ? Cliquez ci-dessous pour renvoyer le lien.
        </p>

        @if (session('status'))
            <div class="mt-4 text-green-200 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-6 text-left" method="POST" action="{{ route('emailverification.resend') }}">
            @csrf
            <button type="submit"
                class="w-full bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">
                Renvoyer le lien de vérification
            </button>
        </form>
        <form class="mt-2 text-left" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">
                Se Déconnecter</button>
        </form>
    </div>

@endsection
