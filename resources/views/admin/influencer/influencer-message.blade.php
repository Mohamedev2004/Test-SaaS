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
                <table class="min-w-full border-collapse border border-gray-300 mt-6">
                    <thead>
                        <tr class="bg-[#9C04FF]">
                            <th class="border border-gray-300 px-4 py-2 text-left text-white">Nom</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-white">Marque</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-white">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-white">Téléphone</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-white">Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-white">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($influencerMessages as $message)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $message->user->name }}</td> <!-- Influencer Name -->
                            <td class="border border-gray-300 px-4 py-2">{{ $message->brand->brandName}}</td> <!-- brand Name -->
                            <td class="border border-gray-300 px-4 py-2">{{ $message->user->email }}</td> <!-- Email -->
                            <td class="border border-gray-300 px-4 py-2">{{ $message->user->phone }}</td> <!-- Phone -->
                            <td class="border border-gray-300 px-4 py-2">{{ $message->created_at->format('d/m/Y') }}</td> <!-- Date -->
                            <td class="border border-gray-300 px-4 py-2">{{ $message->message }}</td> <!-- Message -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-600">Aucun message disponible</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
