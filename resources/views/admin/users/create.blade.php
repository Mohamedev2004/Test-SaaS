@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />
    <div class="dashboard__rightt">
        <div class="dash__content">
            <!-- sidebar menu -->
            <div class="sidebar__menu d-md-block d-lg-none">
                <div class="sidebar__action"><i class="fa-solid fa-bars"></i> Sidebar</div>
            </div>
            <!-- sidebar menu end -->

            <div class="max-w-2xl mx-auto mt-10 bg-white p-10 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Ajouter un Utilisateur</h2>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="Entrez le nom" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- E-mail -->
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Adresse E-mail</label>
                        <input type="email" id="email" name="email" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="Entrez l'email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type d'utilisateur -->
                    <div class="mb-6">
                        <label for="user_type" class="block text-lg font-medium text-gray-700 mb-2">Type d'utilisateur</label>
                        <select id="user_type" name="user_type" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">-- Sélectionnez un type --</option>
                            <option value="influencer" {{ old('user_type') == 'influencer' ? 'selected' : '' }}>Influenceur</option>
                            <option value="brand" {{ old('user_type') == 'brand' ? 'selected' : '' }}>Marque</option>
                        </select>
                        @error('user_type')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-purple-600 text-white font-semibold py-3 text-lg rounded-lg hover:bg-purple-700 transition duration-200">
                            Ajouter l'utilisateur
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">
                Copyright © 2025 All Rights Reserved by cocollab
            </p>
        </div>
    </div>
</div>

<x-canva />

@endsection
