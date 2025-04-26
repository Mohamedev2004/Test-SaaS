@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />
    <div class="dashboard__rightt">
        <div class="dash__content ">
            <!-- sidebar menu -->
            <div class="sidebar__menu d-md-block d-lg-none">
                <div class="sidebar__action"><i class="fa-solid fa-bars"></i> Sidebar</div>
            </div>
            <!-- sidebar menu end -->
            <div class="max-w-2xl mx-auto mt-10 bg-white p-10 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Modifier le domaine</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-3 mb-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('sectorupdate', $sector->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom du Domaine -->
                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Domaine</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Entrez le domaine" value="{{ old('name', $sector->name) }}">
                        
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-purple-600 text-white font-semibold py-3 text-lg rounded-lg hover:bg-purple-700 transition duration-200">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by Cocollab</p>
        </div>
    </div>
</div>

<x-canva />

@endsection
