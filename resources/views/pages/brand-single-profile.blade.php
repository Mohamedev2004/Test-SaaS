@extends('layouts.app')

@section('content')

<style>
    .video__section__content {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    aspect-ratio: 16 / 9 !important; /* Keeps a video-like proportion */
    overflow: hidden !important;
}

.video__section__content img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
}
.rts__job__card.style__five{
    height: 450px !important;
}
</style>

<!-- breadcrumb area -->
<div class="rts__section breadcrumb__background">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                <div class="breadcrumb__area max-content breadcrumb__padding">
                    <div class="rts__job__card__big bg-transparent p-0 position-relative z-1 flex-wrap justify-content-between d-flex gap-4 align-items-center">
                        <div class="d-flex gap-4 align-items-center flex-md-row flex-column mx-auto mx-md-0">
                            <div class="company__icon rounded-2 bg-transparent">
                                <!-- Display brand logo -->
                                <img style="width:100%; height:100%;border-radius:100px; border: white 4px solid" src="{{ $brand->logo_image ? Storage::disk('do_spaces')->url($brand->logo_image) : asset('assets/images/brand-default.jpg') }}" alt="{{ $brand->brandName }}">
                            </div>
                            <div class="job__meta w-100 d-flex text-center text-md-start flex-column gap-2">
                                <div class="">
                                    <!-- Display brand name -->
                                    <h3 class="job__title h3 mb-0 text-white">{{ $brand->brandName }}</h3>
                                </div>
                                <div class="d-flex gap-3 justify-content-center justify-content-md-start flex-wrap mb-3 mt-2">
                                    <!-- Display brand location -->
                                    <div class="d-flex gap-2 align-items-center text-white">
                                        {{ $brand->brandLocalisation ?? 'Location not available' }}
                                    </div>
                                    <!-- Display collaboration type -->
                                    <div class="d-flex gap-2 align-items-center text-white">
                                        {{ $brand->collaboration->name  }}
                                    </div>
                                    <!-- Display brand size -->
                                    <div class="d-flex gap-2 align-items-center text-white">
                                        {{ $brand->brandSize }}
                                    </div>
                                    <!-- Display the brand's monthly salary range (if any) -->
                                    {{-- <div class="d-flex gap-2 fw-medium align-items-center">
                                        $1000 - $2000 Monthly
                                    </div> --}}
                                </div>
                                <div class="job__tags d-flex justify-content-center justify-content-md-start flex-wrap gap-3">
                                    <!-- Display the sector where the brand works -->
                                    <a href="#">{{ $brand->sector->name  }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb__area__shape d-flex gap-4 justify-content-end align-items-center">
                    <div class="shape__one common"></div>
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

<!-- job list one -->
<div class="rts__section section__padding">
    <div class="container">
        <div class="row g-30">
            <div class="col-lg-8">
                <div class="rts__job__details">
                    <!-- Tab Navigation -->
                    <div class="rts__tab active__link mb-30">
                        <nav>
                            @php
                            $hasImages = $posts->contains(function ($post) {
                                return $post->images && count(json_decode($post->images, true)) > 0;
                            });

                            $hasVideo = $posts->contains(function ($post) {
                                return $post->video;
                            });
                        @endphp

                        <div class="nav nav-tabs">
                            <a class="nav-link active" href="#all">All</a>
                            <a class="nav-link" href="#description">Description</a>

                            @if ($hasImages)
                                <a class="nav-link" href="#images">Images</a>
                            @endif

                            @if ($hasVideo)
                                <a class="nav-link" href="#video">Video</a>
                            @endif
                        </nav>
                    </div>

                    <!-- Brand Description -->
                    <div id="description" class="mb-30">
                        <h6 class="fw-semibold mb-20">Description de la Marque</h6>
                        <p>{{ $brand->brandDescription ?? 'Description not available' }}</p>
                    </div>


                    @php
                    $hasImages = $posts->contains(function ($post) {
                        return $post->images && count(json_decode($post->images, true)) > 0;
                    });
                @endphp

                @if ($hasImages)
                    <div id="images" class="mb-30">
                        <h6 class="fw-semibold mb-30 mt-30">Images</h6>
                        <div class="row g-30 row-cols-lg-2 row-cols-xl-3 row-cols-sm-2 row-cols-1">
                            @foreach ($posts as $post)
                                @if ($post->images)
                                    @foreach (json_decode($post->images, true) as $image)
                                        <div class="col">
                                            <img class="rounded-2" src="{{ Storage::disk('do_spaces')->url($image) }}" alt="">
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                    <!-- Brand Images Section -->
                    {{-- <div id="images" class="mb-30">
                        <h6 class="fw-semibold mb-30 mt-30">Images</h6>
                        <div class="row g-30 row-cols-lg-2 row-cols-xl-3 row-cols-sm-2 row-cols-1">
                            @foreach ($posts as $post)
                            <div class="row mb-4"> <!-- Ajout d'un espace entre les posts -->
                                @if ($post->images && count(json_decode($post->images, true)) > 0)
                                    @foreach (json_decode($post->images, true) as $image)
                                        <div class="col-md-4 mb-3"> <!-- Responsive et espace entre images -->
                                            <div class="card h-100"> <!-- Carte de hauteur égale -->
                                                <img class="card-img-top rounded-2" src="{{ asset('storage/' . $image) }}" alt="Image du post">
                                                <div class="card-body">
                                                    <p class="card-text text-muted small">Posté le {{ $post->created_at->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body text-center py-5"> <!-- Espacement vertical -->
                                                <i class="bi bi-image fs-1 text-muted mb-3"></i> <!-- Icône -->
                                                <h5 class="card-title text-muted">Aucune image disponible</h5>
                                                <p class="card-text text-muted">Ce post ne contient pas d'image</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        </div>
                    </div> --}}


                    <!-- Brand Video Section -->
                    @if ($posts->contains(function ($post) { return $post->video; }))
                    <div class="video__section mt-40" id="video">
                        <h5 class="mb-30 d-block">Video</h5>
                        <div class="video__section__content">
                            @foreach ($posts as $post)
                                @if ($post->video)
                                    <div class="col-md-6 col-lg-4" style="width:100%; height: 100%;">
                                        <div class="card h-100 shadow-sm" style="display: flex; align-items: center; justify-content: center;">
                                            <div class="position-relative">
                                                <video class="card-img-top" controls style="object-fit: cover; height: 200px; width: 100%;">
                                                    <source src="{{ Storage::disk('do_spaces')->url($post->video) }}" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                </div>
            </div>

            <!-- Brand Sidebar (Company Info) -->
            <div class="col-lg-4 d-flex flex-column gap-40">
                <div class="company__card">
                    <div style="margin:auto;width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 2px solid white;">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ $brand->logo_image ? Storage::disk('do_spaces')->url($brand->logo_image) : asset('assets/images/brand-default.jpg') }}" alt="{{ $brand->brandName }}">
                    </div>
                    <h5 class="company__name mt-20">{{ $brand->brandName }}</h5>
                    <a href="#contact" class="rts__btn apply__btn mt-40">Contacter</a>
                </div>

                <!-- Brand Contact Form -->
                <div class="job__contact" id="contact">
                    <h6 class="fw-semibold mb-20">Contact {{ $brand->brandName }}</h6>
                    @auth
                        @if(auth()->user()->role === 'influencer' && auth()->user()->status === 'Active')
                            <form action="{{ route('contact.influencer.store') }}" method="POST" class="d-flex flex-column gap-4">
                                @csrf
                                <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user() ? auth()->user()->id : '' }}">

                                <div class="search__item">
                                    <label for="collaboration" class="mb-3 font-20 fw-medium text-dark text-capitalize">Select Collaboration</label>
                                    <div class="position-relative">
                                        <select id="collaboration" name="collaboration_id" class="form-select" required>
                                            <option value="">Sélectionnez une collaboration</option>
                                            @forelse($collaborations as $collaboration)
                                                <option value="{{ $collaboration->id }}">{{ $collaboration->name }}</option>
                                            @empty
                                                <option value="" disabled>Aucune collaboration disponible</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="search__item">
                                    <label class="mb-3 font-20 fw-medium text-dark text-capitalize" for="message">Votre Message</label>
                                    <textarea name="message" id="message" placeholder="Message" required></textarea>
                                </div>
                                <button type="submit" class="rts__btn apply__btn w-100">Envoyer</button>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                Seuls les comptes d'influenceurs actifs peuvent contacter les marques.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-info">
                            Veuillez vous <a href="{{ route('login') }}"> Connecter</a> en tant qu'<strong style="font-weight:bold">Influenceur</strong> pour contacter cette marque.
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- top employer end -->

<!-- top employer end -->

<!-- top employer end -->

<x-canva />


@endsection
