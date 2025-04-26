@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />

    <div class="dashboard__rightt w-100">
        <div class="dash__content">

            <!-- Menu latéral mobile -->
            <div class="sidebar__menu d-md-block d-lg-none mb-3">
                <div class="sidebar__action"><i class="fa-solid fa-bars"></i> Menu</div>
            </div>

            <div class="container">
                <h6 class="fw-semibold mb-30">Paramètres du countdown</h6>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Informations du compte à rebours -->
                <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                    <h5 class="mb-3">État actuel du countdown</h5>
                    <table class="table table-bordered table-hover mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>Heure de fin initiale</th>
                                <th>Heure de fin actuelle</th>
                                <th>Extension totale (minutes)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $countdown->original_end_time }}</td>
                                <td>{{ $countdown->current_end_time }}</td>
                                <td>{{ $countdown->extension_minutes }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Formulaire de changement de la date originale -->
                <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;margin-bottom: 30px;">
                    <h5 class="mb-3">Changer la date du countdown </h5>
                    <form action="{{ route('countdown.updateOriginalTime') }}" method="POST">
                        @csrf
                        <label for="original_end_time">Changer la date original finale :</label>
                        <input type="datetime-local" name="original_end_time" id="original_end_time"  class="form-control"
                        value="{{ \Carbon\Carbon::parse($countdown->original_end_time)->format('Y-m-d\TH:i') }}" required>
                        
                        <button type="submit" class="btn mt-3 text-white" style="background-color: #9C04FF; border: none;">Update</button>
                    </form>
                    <h5 class="">Ou choisir une durée fixe </h5>
                    <form action="{{ route('countdown.updateOriginalTime') }}" method="POST">
                        @csrf
                        <input type="hidden" name="original_end_time" id="original_end_time"  class="form-control"
                            value="{{ now()->addSeconds(20) }}" required>
                        
                        <button type="submit" class="btn mt-3 text-white" style="background-color: #9C04FF; border: none;">20 secondes</button>
                    </form>
                    <form action="{{ route('countdown.updateOriginalTime') }}" method="POST">
                        @csrf
                        <input type="hidden" name="original_end_time" id="original_end_time"  class="form-control"
                            value="{{ now()->addSeconds(30) }}" required>
                        
                        <button type="submit" class="btn mt-3 text-white" style="background-color: #9C04FF; border: none;">30 secondes</button>
                    </form>
                    <form action="{{ route('countdown.updateOriginalTime') }}" method="POST">
                        @csrf
                        <input type="hidden" name="original_end_time" id="original_end_time"  class="form-control"
                            value="{{ now()->addSeconds(60) }}" required>
                        
                        <button type="submit" class="btn mt-3 text-white" style="background-color: #9C04FF; border: none;">60 secondes</button>
                    </form>
                </div>

                <!-- Formulaire d’extension -->
                <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                    <h5 class="mb-3">Prolonger le countdown</h5>
                    <form action="{{ route('admin.countdown.extend') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="minutes" class="mb-2">Minutes supplémentaires</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="minutes" 
                                name="minutes" 
                                min="1" 
                                max="1440" 
                                required
                            >
                            <small class="form-text text-muted">Maximum 24 heures (1440 minutes)</small>
                        </div>
                        <button type="submit" class="btn mt-3 text-white" style="background-color: #9C04FF; border: none;">
                            Prolonger
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center mt-4 mb-3">
            <p class="text-muted" style="font-size: 15px;">
                Copyright &copy; All Rights Reserved by cocollab
            </p>
        </div>
    </div>
</div>

<x-canva />

@endsection
