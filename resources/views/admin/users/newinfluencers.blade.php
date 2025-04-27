@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
    <x-sidebar />
    <div class="dashboard__rightt">
        <div class="dash__content ">
            <!-- Sidebar menu -->
            <div class="sidebar__menu d-md-block d-lg-none">
                <div class="sidebar__action"> Sidebar</div>
            </div>
            <!-- Sidebar menu end -->

            <h6 class="fw-semibold mb-30">Liste des nouveaux Influenceur</h6>

            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Rechercher un Influenceur..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Stats Section -->
            <div class="candidate__filter__area">
                <h6 class="font-20">Statistiques</h6>
                <div class="candidate__filter">
                    <ul class="candidate__filter__shorting" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                Total: {{ $total }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                Actif: {{ $active }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                Inactif: {{ $inactive }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <!-- All Influencers -->
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    @if($influencers->isEmpty())
                        <p class="text-center text-gray-500 py-4">Aucun influenceur trouvé.</p>
                    @else
                        @foreach($influencers as $influencer)
                            <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                                <!-- Information Section -->
                                <div class="author__info flex-1">
                                    <div class="author__meta">
                                        <div class="author__name max-w-xs">
                                            <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $influencer->name }}</h6>
                                            <p class="text-sm text-gray-500">{{ $influencer->email }}</p>
                                        </div>
                                    </div>
                                    <div class="author__info__list mt-2 text-sm text-gray-600">
                                        <span>Phone: {{ $influencer->phone }}</span><br>
                                        <span>Statut: {{ $influencer->status }}</span>
                                        <span>Inscrit le: {{ $influencer->created_at }}</span>
                                    </div>
                                </div>

                                <!-- Buttons Section -->
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('influencerstatus', $influencer->id) }}" class="action__item">
                                        <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                            Modifier
                                        </button>
                                    </a>

                                    <form action="{{ route('influencers.destroy', $influencer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-all ease-in-out duration-200 w-full">
                                            Supprimer
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Active Influencers -->
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    @if($activeInfluencers->isEmpty())
                        <p class="text-center text-gray-500 py-4">Aucun influenceur actif.</p>
                    @else
                    @foreach($activeInfluencers as $influencer)
                    <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                        <!-- Information Section -->
                        <div class="author__info flex-1">
                            <div class="author__meta">
                                <div class="author__name max-w-xs">
                                    <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $influencer->name }}</h6>
                                    <p class="text-sm text-gray-500">{{ $influencer->email }}</p>
                                </div>
                            </div>
                            <div class="author__info__list mt-2 text-sm text-gray-600">
                                <span>Phone: {{ $influencer->phone }}</span><br>
                                <span>Statut: {{ $influencer->status }}</span>
                                <span>Inscrit le: {{ $influencer->created_at }}</span>
                            </div>
                        </div>

                        <!-- Buttons Section -->
                        <div class="flex items-center space-x-2">
                            @php
                                // Accessing the related influencer data from the influencer table
                                $relatedInfluencer = $influencer->influencer;

                                // Check if any field is empty (OR condition) from the influencer table
                                $isComplete = !empty($relatedInfluencer->influencerName) &&
                                              !empty($relatedInfluencer->influencerDescription) &&
                                              !empty($relatedInfluencer->influencerAge) &&
                                              !empty($relatedInfluencer->sexe) &&
                                              !empty($relatedInfluencer->sector_id);
                            @endphp

                            <!-- If the influencer data is complete, show the button -->
                            @if ($isComplete)
                                <a href="{{ route('show_influencer_auth_admin', $relatedInfluencer->id) }}" class="action__item">
                                    <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                        voir
                                    </button>
                                </a>
                            @endif

                            <!-- Modify Button (No changes in the route) -->
                            <a href="{{ route('influencerstatus', $influencer->id) }}" class="action__item">
                                <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                    Modifier
                                </button>
                            </a>

                            <!-- Delete Form (No changes in the route) -->
                            <form action="{{ route('influencers.destroy', $influencer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-all ease-in-out duration-200 w-full">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach


                    @endif
                </div>

                <!-- Inactive Influencers -->
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    @if($inactiveInfluencers->isEmpty())
                        <p class="text-center text-gray-500 py-4">Aucun influenceur inactif.</p>
                    @else
                        @foreach($inactiveInfluencers as $influencer)
                            <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                                <!-- Information Section -->
                                <div class="author__info flex-1">
                                    <div class="author__meta">
                                        <div class="author__name max-w-xs">
                                            <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $influencer->name }}</h6>
                                            <p class="text-sm text-gray-500">{{ $influencer->email }}</p>
                                        </div>
                                    </div>
                                    <div class="author__info__list mt-2 text-sm text-gray-600">
                                        <span>Phone: {{ $influencer->phone }}</span><br>
                                        <span>Statut: {{ $influencer->status }}</span>
                                        <span>Inscrit le: {{ $influencer->created_at }}</span>
                                    </div>
                                </div>

                                <!-- Buttons Section -->
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('influencerstatus', $influencer->id) }}" class="action__item">
                                        <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                            Modifier
                                        </button>
                                    </a>
                                    <form action="{{ route('influencers.destroy', $influencer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-all ease-in-out duration-200 w-full">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="d-flex justify-content-center mt-30">
                <p class="copyright" style="font-size: 15px !important;">
                    Copyright © 2025 All Rights Reserved by Cocollab
                </p>
            </div>
        </div>
    </div>
</div>

<x-canva />

<!-- Search Filter JS -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.single__shortlist__item').forEach(item => {
            let name = item.querySelector('.author__name h6').innerText.toLowerCase();
            item.style.display = name.includes(filter) ? '' : 'none';
        });
    });
</script>

@endsection
