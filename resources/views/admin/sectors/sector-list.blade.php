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
            <div class="flex items-center justify-right">
                <a href="{{ route('sectoradd') }}">
                    <button class="bg-purple-600 text-white py-1 px-3 rounded-md hover:bg-purple-900">Ajouter un Domaine</button>
                </a>
            </div>
            <!-- sidebar menu end -->

            <div class="overflow-x-auto">
                @if ($sectors->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-600 text-lg">Aucun domaine trouvé.</p>
                    </div>
                @else
                    <table class="min-w-full border-collapse border border-gray-300 mt-6">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">Nom du Domaine</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sectors as $sector)
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $sector->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('sectoredit', $sector->id) }}">
                                            <button class="bg-purple-600 text-white py-1 px-3 rounded-md hover:bg-purple-900">Modifier</button>
                                        </a>
                                        <!--
                                        <form action="{{ route('sectordestroy', $sector->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-900 mt-1">Supprimer</button>
                                        </form>
                                    -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by Cocollab</p>
        </div>
    </div>
</div>

<x-canva />

@endsection
