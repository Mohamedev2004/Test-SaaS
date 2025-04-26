@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />
    <div class="dashboard__rightt">
        <div class="dash__content">
            <!-- Sidebar menu -->
            <div class="sidebar__menu d-md-block d-lg-none">
                <div class="sidebar__action"><i class="fa-solid fa-bars"></i> Sidebar</div>
            </div>
            <!-- Sidebar menu end -->

            <div class="overflow-x-auto">
                @if ($sponsors->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-600 text-lg">Aucun sponsor trouvé.</p>
                    </div>
                @else
                    <table class="min-w-full border-collapse border border-gray-300 mt-6">
                        <thead>
                            <tr class="bg-[#9C04FF]">
                                <th class="border border-gray-300 px-4 py-2 text-left text-white">Nom</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-white">Email</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-white">Téléphone</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-white">Fichier PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sponsors as $sponsor)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $sponsor->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $sponsor->email }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $sponsor->phone }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ Storage::disk('do_spaces')->url($sponsor->file_path) }}" 
                                       class="text-blue-500 hover:underline" 
                                       target="_blank"
                                       download>
                                        Télécharger PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">
                Copyright © All Rights Reserved by Cocollab
            </p>
        </div>
    </div>
</div>

<x-canva />

@endsection