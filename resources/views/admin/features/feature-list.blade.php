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
            <div class="flex items-center justify-right">
                <a href="{{ route('featureadd') }}">
                    <button class="bg-purple-600 text-white py-1 px-3 rounded-md hover:bg-purple-900">Ajouter une Caractéristique</button>
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300 mt-6">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">Caractéristique</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($features as $feature)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $feature->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('featureedit', $feature->id) }}">
                                        <button class="bg-purple-600 text-white py-1 px-3 rounded-md hover:bg-purple-900">Modifier</button>
                                    </a>
                                    <form action="{{ route('featuredestroy', $feature->id) }}" method="POST" class="inline-block mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-900">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Aucune Caractéristique disponible.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by cocollab</p>
        </div>
    </div>
</div>

<x-canva />

@endsection
