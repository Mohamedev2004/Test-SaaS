@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />
    <div class="dashboard__rightt">
        <div class="dash__content">
            <h6 class="fw-semibold mb-30">Status de la Marque</h6>
            <form action="{{ route('brandstatus.update', $brand->id) }}" method="POST" class="p-4 border rounded-lg shadow w-80 text-center">
                @csrf
                @method('PUT')

                <!-- Brand Image -->
                <div class="flex flex-col items-center mb-4">
                    <p class="text-lg font-bold">{{ $brand->name }}</p>
                    <p class="text-sm text-gray-500">{{ $brand->email }}</p>
                </div>

                <!-- Status Selector -->
                <label for="status" class="block font-bold mb-2">Statut :</label>
                <select name="status" id="status" class="px-4 py-2 border rounded w-full">
                    <option value="Inactive" {{ $brand->status == 'Inactive' ? 'selected' : '' }}>Inactif</option>
                    <option value="Active" {{ $brand->status == 'Active' ? 'selected' : '' }}>Actif</option>
                </select>

                <!-- Pack Selector -->
                <label for="pack" class="block font-bold mt-4 mb-2">Pack :</label>
                <select name="pack_id" id="pack" class="px-4 py-2 border rounded w-full">
                    @foreach($packs as $pack)
                        <option value="{{ $pack->id }}" {{ $brand->pack_id == $pack->id ? 'selected' : '' }}>
                            {{ $pack->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <button type="submit" class="mt-4 px-4 py-2 bg-purple-600 text-white rounded w-full">
                    Mettre à jour
                </button>
            </form>

        </div>

        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by Cocollab</p>
        </div>
    </div>
</div>

<x-canva />

@endsection
