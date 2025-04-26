@extends('layouts.forms')

@section('content')

<a href="{{ route('welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
    &larr;
</a>

<!-- Make the container bigger -->
<div class="w-full max-w-5xl bg-purple-500 p-12 sm:p-16 rounded-3xl shadow-lg text-white text-center">
    <label class="block font-bold text-2xl mb-4">Vous êtes ?</label>
    <div class="flex gap-4">
        <a href="{{ route('register') }}" class="w-1/2 bg-white text-gray-800 py-3 rounded-lg text-center border-2 border-gray-300 hover:bg-purple-600">Influenceur</a>
        <a href="{{ route('register-brand') }}" class="w-1/2 bg-white text-gray-800 py-3 rounded-lg text-center border-2 border-gray-300 hover:bg-purple-600">Marque</a>
    </div>

    <p class="mt-4 text-xs sm:text-sm">Vous avez déjà un compte ? <a href="{{ route('login') }}" class="text-white underline">Connectez-vous.</a></p>
</div>

@endsection
