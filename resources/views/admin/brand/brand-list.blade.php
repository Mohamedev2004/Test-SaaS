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

        <h6 class="fw-semibold mb-30">Liste des Marques</h6>
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Rechercher un influenceur..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div class="candidate__filter__area">
            <h6 class="font-20">Statistiques</h6>
            <div class="candidate__filter">
                <ul class="candidate__filter__shorting" id="myTab" role="tablist">
                    <!-- Total Count -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                            Total: {{ $total }}
                        </button>
                    </li>

                    <!-- Active Count -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                            Actif: {{ $active }}
                        </button>
                    </li>

                    <!-- Inactive Count -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                            Inactif: {{ $inactive }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                @if($brands->isEmpty())
                    <p class="text-center text-gray-500">Aucune marque disponible.</p>
                @else
                    @foreach($brands as $brand)
                        <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                            <div class="author__info flex-1">
                                <div class="author__meta">
                                    <div class="author__name max-w-xs">
                                        <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $brand->name }}</h6>
                                        <p class="text-sm text-gray-500">{{ $brand->email }}</p>
                                    </div>
                                </div>
                                <div class="author__info__list mt-2 text-sm text-gray-600">
                                    <span>Phone: {{ $brand->phone }}</span><br>
                                    <span>Statut: {{ $brand->status }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('brandstatus', $brand->id) }}" class="action__item">
                                    <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                        Modifier
                                    </button>
                                </a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
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
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                @if($activeBrands->isEmpty())
                    <p class="text-center text-gray-500">Aucune marque active.</p>
                @else
                    @foreach($activeBrands as $brand)
                        <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                            <div class="author__info flex-1">
                                <div class="author__meta">
                                    <div class="author__name max-w-xs">
                                        <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $brand->name }}</h6>
                                        <p class="text-sm text-gray-500">{{ $brand->email }}</p>
                                    </div>
                                </div>
                                <div class="author__info__list mt-2 text-sm text-gray-600">
                                    <span>Phone: {{ $brand->phone }}</span><br>
                                    <span>Statut: {{ $brand->status }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('brandstatus', $brand->id) }}" class="action__item">
                                    <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                        Modifier
                                    </button>
                                </a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
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
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                @if($inactiveBrands->isEmpty())
                    <p class="text-center text-gray-500">Aucune marque inactive.</p>
                @else
                    @foreach($inactiveBrands as $brand)
                    <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                            <div class="author__info flex-1">
                                <div class="author__meta">
                                    <div class="author__name max-w-xs">
                                        <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $brand->name }}</h6>
                                        <p class="text-sm text-gray-500">{{ $brand->email }}</p>
                                    </div>
                                </div>
                                <div class="author__info__list mt-2 text-sm text-gray-600">
                                    <span>Phone: {{ $brand->phone }}</span><br>
                                    <span>Statut: {{ $brand->status }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('brandstatus', $brand->id) }}" class="action__item">
                                    <button class="bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-all ease-in-out duration-200 w-full">
                                        Modifier
                                    </button>
                                </a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
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

    <div class="d-flex justify-content-center mt-30">
    <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by cocollab</p>
    </div>
</div>
</div>
</div>
<!-- content area end -->

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
