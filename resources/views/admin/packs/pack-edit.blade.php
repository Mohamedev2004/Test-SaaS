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
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Modifier un Pack</h2>
                <form action="{{ route('packupdate', $pack->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom du Pack -->
                    <div class="mb-6">
                        <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Nom du Pack</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $pack->name) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Entrez le nom du pack">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description du Pack -->
                    <div class="mb-6">
                        <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Description du Pack</label>
                        <textarea id="description" name="description" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Entrez la description du pack">{{ old('description', $pack->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sélection des caractéristiques (Checkboxes) -->
                    <div class="mb-6">
                        <label class="block text-lg font-medium text-gray-700 mb-2">Caractéristiques</label>
                        <div class="mt-3 space-y-3">
                            @foreach ($features as $feature)
                                <label class="flex items-center text-lg">
                                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                                        class="form-checkbox text-blue-600 w-6 h-6"
                                        @if($pack->features->contains($feature->id)) checked @endif>
                                    <span class="ml-3">{{ $feature->description }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('features')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
        <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by cocollab</p>
        </div>
    </div>
</div>
</div>
<!-- content area end -->

<x-canva />

@endsection
