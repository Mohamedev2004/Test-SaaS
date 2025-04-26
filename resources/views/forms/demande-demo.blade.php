@extends('layouts.forms')

@section('content')
    <a href="{{ route('welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
        &larr;
    </a>
    <div class="w-full max-w-2xl bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-white">Réserver une rencontre</h2>
        <p class="text-base sm:text-lg mt-2">Veuillez remplir les informations ci-dessous</p>

        <form action="{{ route('meetings.store') }}" method="post" class="mt-6 text-left">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- Name -->
                <div class="sm:col-span-2">
                    <label for="name" class="block font-medium">Nom Complet</label>
                    <input type="text" name="name" id="name" placeholder="Nom Complet"
                        class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block font-medium">Numéro de téléphone</label>
                    <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone"
                        class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('phone') border-red-500 @enderror"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="E-mail"
                        class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Meeting Date -->
                <div class="sm:col-span-2">
                    <label for="meeting_date" class="block font-medium">Date de la rencontre</label>
                    <input type="date" name="meeting_date" id="meeting_date"
                        class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('meeting_date') border-red-500 @enderror"
                        value="{{ old('meeting_date') }}"
                        min="{{ \Carbon\Carbon::today()->toDateString() }}"> <!-- This ensures the date is after today -->
                    @error('meeting_date')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">
                Réserver
            </button>
        </form>
    </div>
@endsection
