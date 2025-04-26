
@extends('layouts.app')

@section('content')

<!-- breadcrumb area -->
<div class="rts__section breadcrumb__background">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                <div class="breadcrumb__area max-content breadcrumb__padding z-2">
                    <h1 class="breadcrumb-title h3 mb-3 text-white">Marques</h1>
                    <nav>
                        <ul class="breadcrumb m-0 lh-1">
                            <li class="breadcrumb-item"><a style="color: white !important;" href="index.html">Acceuil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Marques</li>
                        </ul>
                    </nav>
                </div>
                <div class="breadcrumb__area__shape d-flex gap-4 justify-content-end align-items-center">
                    <div class="shape__one common">
                        <img src="{{ asset('assets/img/breadcrumb/shape-1.svg') }}" alt="">
                    </div>
                    <div class="shape__two common">
                        <img src="{{ asset('assets/img/breadcrumb/shape-2.svg') }}" alt="">
                    </div>
                    <div class="shape__three common">
                        <img src="{{ asset('assets/img/breadcrumb/shape-3.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- influencer list one -->
<div class="rts__section section__padding">
    <div class="container">
        <div class="row g-30">
            <div class="col-lg-5 col-xl-4">
                <div class="job__search__section mb-40">
                    @if (auth()->check() && auth()->user()->isInfluencer())
                    <form action="{{ route('filter_brands_auth_influencer') }}" method="GET" class="d-flex flex-column row-30">
                    @endif
                    @if (auth()->check() && auth()->user()->isBrand())
                    <form action="{{ route('filter_brands_auth_brand') }}" method="GET" class="d-flex flex-column row-30">
                    @endif
                    @guest
                    <form action="{{ route('allbrands') }}" method="GET" class="d-flex flex-column row-30">
                    @endguest                        
                        <!-- Search by brand name -->
                        <div class="search__item">
                            <label for="search" class="mb-20 font-20 fw-medium text-dark text-capitalize">Rechercher par nom</label>
                            <div class="position-relative">
                                <input type="text" id="search" name="search" placeholder="Entrez le nom de la marque" value="{{ request('search') }}" >
                            </div>
                        </div>

                        <!-- Filter by Domain -->
                        <div class="search__item">
                            <h6 class="mb-2 font-20 fw-medium text-dark text-capitalize">Rechercher par domaine</h6>
                            <div class="position-relative">
                                <select name="sector" id="sector" class="nice-select">
                                    <option value="">Domaine</option>
                                    @foreach($sectors as $sector)
                                        <option value="{{ $sector->id }}" {{ request('sector') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Filter by Collaboration -->
                        <div class="search__item">
                            <h6 class="mb-2 font-20 fw-medium text-dark text-capitalize">Rechercher par Collaboration</h6>
                            <div class="position-relative">
                                <select name="collaboration" id="collaboration" class="nice-select">
                                    <option value="">Collaboration</option>
                                    @foreach($collaborations as $collaboration)
                                        <option  value="{{ $collaboration->id }}" {{ request('collaboration') == $collaboration->id ? 'seleceted' : '' }}>{{ $collaboration->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <!-- Filter by brand size -->
                        <div class="search__item">
                            <h6 class="mb-2 font-20 fw-medium text-dark text-capitalize">Taille</h6>
                            <div class="search__item__list">
                                <div class="d-flex align-items-center justify-content-between list">
                                    <div class="d-flex gap-2 align-items-center checkbox">
                                        <input type="checkbox" name="size[]" value="Petite" id="petite" {{ in_array('Petite', request('size', [])) ? 'checked' : '' }}>
                                        <label for="petite">Petite</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between list">
                                    <div class="d-flex gap-2 align-items-center checkbox">
                                        <input type="checkbox" name="size[]" value="Moyenne" id="moyenne" {{ in_array('Moyenne', request('size', [])) ? 'checked' : '' }}>
                                        <label for="moyenne">Moyenne</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between list">
                                    <div class="d-flex gap-2 align-items-center checkbox">
                                        <input type="checkbox" name="size[]" value="Grande" id="grande" {{ in_array('Grande', request('size', [])) ? 'checked' : '' }}>
                                        <label for="grande">Grande</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Search and Reset buttons -->

                        <div class="d-flex gap-3">
                            <!-- Search button -->
                            <button type="submit" class="rts__btn no__fill__btn max-content mx-auto job__search__btn font-sm">
                                Trouver la Marque
                            </button>

                            @if (auth()->check() && auth()->user()->isBrand())

                            <a href="{{ route('filter_brands_auth_brand', ['reset' => true]) }}" class="rts__btn no__fill__btn max-content mx-auto job__search__btn font-sm">
                                Réinitialiser
                            </a>

                            @endif
                            @if (auth()->check() && auth()->user()->isInfluencer())

                            <a href="{{ route('filter_brands_auth_influencer', ['reset' => true]) }}" class="rts__btn no__fill__btn max-content mx-auto job__search__btn font-sm">
                                Réinitialiser
                            </a>

                            @endif
                            @guest
                            <a href="{{ route('allbrands', ['reset' => true]) }}" class="rts__btn no__fill__btn max-content mx-auto job__search__btn font-sm">
                                Réinitialiser
                            </a>
                            @endguest
                        </div>
                    </form>
                </div>
            </div>




            <div class="col-lg-7 col-xl-8">
                <div class="top__query mb-40 d-flex flex-wrap gap-4 gap-xl-0 justify-content-between align-items-center">
                    <span class="text-dark font-20 fw-medium">Affichage de 8 Marques par page</span>
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div class="d-flex align-items-center gap-3" id="nav-tab" role="tablist">
                            <button class="rts__btn no__fill__btn grid-style nav-link active" data-bs-toggle="tab" data-bs-target="#grid">Grille</button>
                            <button class="rts__btn no__fill__btn list-style nav-link" data-bs-toggle="tab" data-bs-target="#list">Liste</button>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" role="tabpanel" id="grid">
                        <div class="row g-30">
                            @if ($brands->isEmpty())
                            <p class="text-center text-muted">Aucune marque disponible pour le moment.</p>
                        @else
                        @foreach($brands as $brand)
                        <div class="col-xl-6 col-md-6 col-lg-12">
                            <div class="rts__author__card style__default d-flex flex-column gap-3">
                                <div class="author_icon">
                                    <!-- Display the brand logo image dynamically -->
                                   <!--  @php
                                        $logo = $brand->logo_image
                                            ? Storage::disk('do_spaces')->url($brand->logo_image)
                                            : asset('assets/images/influencer-default.jpg');
                                    @endphp -->

                                <img class="rounded-5" src="{{ $brand->logo_image ? Storage::disk('do_spaces')->url($brand->logo_image) : asset('assets/images/brand-default.jpg') }}" alt="{{ $brand->brandName }} ">

                                    {{-- <img src="{{ asset('storage/'.$brand->logo_image) }}" class="rounded-5" alt="{{ $brand->brandName }}"> --}}
                                </div>
                                <div class="job__meta w-100 d-flex flex-column gap-3">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <!-- Display the brand name -->
                                        @if (auth()->check() && auth()->user()->isBrand())
                                        <a href="{{ route('show_brand_auth_brand', ['id' => $brand->id]) }}" class="job__title h6 mb-0">{{ $brand->brandName }}</a>
                                        @endif
                                        @if (auth()->check() && auth()->user()->isInfluencer())
                                        <a href="{{ route('show_brand_auth_influencer', ['id' => $brand->id]) }}" class="job__title h6 mb-0">{{ $brand->brandName }}</a>
                                        @endif
                                        @guest
                                        <a href="{{ route('show_brand_guest', ['id' => $brand->id]) }}" class="job__title h6 mb-0">{{ $brand->brandName }}</a>
                                        @endguest
                                        <span class="author limited-multiline text-justify">{{ $brand->brandDescription }}</span>
                                    </div>
                                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                                        <div class="d-flex gap-2 align-items-center">
                                            <!-- Display the brand location -->
                                            {{ $brand->brandLocalisation }}
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <!-- Display the brand size -->
                                            {{ $brand->brandSize }}
                                        </div>
                                    </div>
                                    <div class="job__tags d-flex justify-content-center mb-3 flex-wrap gap-3">
                                        <!-- Display the brand sector -->
                                        <a href="#">{{ $brand->sector->name }}</a>
                                        <!-- Display the brand's collaboration type -->
                                        <a href="#">{{ $brand->collaboration->name }}</a>
                                    </div>
                                    @if (auth()->check() && auth()->user()->isBrand())
                                    <a href="{{ route('show_brand_auth_brand', ['id' => $brand->id]) }}" class="apply__btn max-content">Voir Profil</a>
                                    @endif
                                    @if (auth()->check() && auth()->user()->isInfluencer())
                                    <a href="{{ route('show_brand_auth_influencer', ['id' => $brand->id]) }}" class="apply__btn max-content">Voir Profil</a>
                                    @endif
                                    @guest
                                    <a href="{{ route('show_brand_guest', ['id' => $brand->id]) }}" class="apply__btn max-content">Voir Profil</a>
                                    @endguest
                                    <!-- Link to the brand profile -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="pagination-container" style="display: flex; justify-content: center;">
                            {{ $brands->links() }}
                        </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="list">
                        <div class="row g-30">
                            @if ($brands->isEmpty())
                            <p class="text-center text-muted">Aucune marque disponible pour le moment.</p>
                            @else
                            @foreach($brands as $brand)
                            <div class="col-12">
                                <div class="rts__author__card__big style__gradient__two flex-wrap d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex gap-3 gap-md-4 flex-column flex-md-row justify-content-start align-items-start align-items-md-center">
                                        <div class="author__icon">
                                            <!-- @php
                                                $logo = $brand->logo_image
                                                    ? asset('storage/' . $brand->logo_image)
                                                    : asset('assets/images/influencer-default.jpg');
                                            @endphp -->

                                        <img class="rounded-10" src="{{ $brand->logo_image ? Storage::disk('do_spaces')->url($brand->logo_image) : asset('assets/images/brand-default.jpg') }}" alt="{{ $brand->brandName }} ">
                                        </div>
                                        <div class="job__meta">
                                            <div class="d-flex align-items-start flex-column">
                                                <!-- Display the brand name -->
                                                 @if (auth()->check() && auth()->user()->isBrand())
                                                    <a href="{{ route('show_brand_auth_brand', ['id' => $brand->id]) }}" class="job__title mb-0 h6 fw-semibold">{{  $brand->brandName }}</a>
                                                    @endif
                                                    @if (auth()->check() && auth()->user()->isInfluencer())
                                                    <a href="{{ route('show_brand_auth_influencer', ['id' => $brand->id]) }}" class="job__title mb-0 h6 fw-semibold">{{ $brand->brandName }}</a>
                                                    @endif
                                                    @guest
                                                    <a href="{{ route('show_brand_guest', ['id' => $brand->id]) }}" class="job__title mb-0 h6 fw-semibold">{{ $brand->brandName }}</a>
                                                    @endguest
                                                <span class="author limited-multiline text-justify">{{ $brand->brandDescription }}</span>
                                            </div>
                                            <div class="job__tags mt-3 d-flex flex-wrap gap-3">
                                                <!-- Display the brand sector -->
                                                <a href="#">{{ $brand->sector->name }}</a>
                                                <!-- Display the brand's collaboration type -->
                                                <a href="#">{{ $brand->collaboration->name }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-5 flex-wrap align-items-center">
                                        <div class="d-flex gap-3 flex-wrap gap-lg-4 fw-medium">
                                            <div class="d-flex gap-2 align-items-center">
                                                <!-- Display the brand location -->
                                                {{ $brand->brandLocalisation }}
                                            </div>
                                            <div class="d-flex gap-2 align-items-center">
                                                <i class="fa-light rt-briefcase"></i> {{ $brand->brandSize }}
                                            </div>
                                        </div>
                                        @if (auth()->check() && auth()->user()->isBrand())
                                        <a href="{{ route('show_brand_auth_brand', ['id' => $brand->id]) }}" class="apply__btn" aria-label="View Profile">Voir Profil</a>
                                        @endif
                                        @if (auth()->check() && auth()->user()->isInfluencer())
                                        <a href="{{ route('show_brand_auth_influencer', ['id' => $brand->id]) }}" class="apply__btn" aria-label="View Profile">Voir Profil</a>
                                        @endif
                                        @guest
                                        <a href="{{ route('show_brand_guest', ['id' => $brand->id]) }}" class="apply__btn" aria-label="View Profile">Voir Profil</a>
                                        @endguest

                                    </div>
                                </div>
                            </div>
                        @endforeach
                            @endif
                            <div id="pagination-container" style="display: flex; justify-content: center;">
                                {{ $brands->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="rts__pagination mx-auto pt-60 max-content">
                    <ul class="d-flex gap-2">
                        <li><a href="#" class="inactive"><i class="rt-chevron-left"></i></a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="rt-chevron-right"></i></a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- job list one end -->

<x-canva />

@endsection
