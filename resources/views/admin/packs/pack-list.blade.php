@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />
    <div class="dashboard__rightt">
        <div class="dash__content">
            <div class="sidebar__menu d-md-block d-lg-none">
                <div class="sidebar__action"><i class="fa-solid fa-bars"></i> Sidebar</div>
            </div>
            <div class="flex items-center justify-right">
                <a href="{{ route('packadd') }}">
                    <button class="bg-purple-600 text-white py-1 px-3 rounded-md hover:bg-purple-900">Ajouter un Pack</button>
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300 mt-6">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">Nom du Pack</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Durée</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Caractéristiques</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packs as $pack)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $pack->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $pack->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $pack->pack_type }} Mois</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @foreach ($pack->features as $feature)
                                        - {{ $feature->description }} <br>
                                    @endforeach
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('packedit', $pack->id) }}">
                                        <button class="bg-purple-600 text-white py-1 px-3 rounded-md hover:bg-purple-900">Modifier</button>
                                    </a>
                                    <!--
                                    <form action="{{ route('packdestroy', $pack->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-900 mt-1">
                                            Supprimer
                                        </button>
                                    </form> -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Aucun pack disponible.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by Cocollab</p>
        </div>
    </div>
</div>

@endsection
