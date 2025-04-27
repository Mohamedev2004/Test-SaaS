@extends('layouts.app')

@section('content')

    <style>
        .video__section__content {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            aspect-ratio: 16 / 9 !important;
            /* Keeps a video-like proportion */
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
                            <div
                                class="rts__job__card__big bg-transparent p-0 position-relative z-1 flex-wrap justify-content-between d-flex gap-4 align-items-center">
                                <div class="d-flex gap-4 align-items-center flex-md-row flex-column mx-auto mx-md-0">
                                    <div class="company__icon rounded-full bg-white">
                                        <!-- Display brand logo -->
                                            <!-- @php
                                                $profileImage = $influencer->image
                                                    ? asset('storage/' . $influencer->image)
                                                    : asset('assets/images/influencer-default.jpg');
                                            @endphp -->
                                        <img src="{{ $influencer->profile_image ? Storage::disk('do_spaces')->url($influencer->profile_image) : asset('assets/images/influencer-default.jpg') }}"
                                            alt="" style="width: 100% ; height: 100%; border-radius:100px; border: white 4px solid">
                                    </div>
                                    <div class="job__meta w-100 d-flex text-center text-md-start flex-column gap-2">
                                        <div class="">
                                            <!-- Display brand name -->
                                            <h3 class="job__title h3 mb-0 text-white">
                                                @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status === 'Active')
                                                {{ $influencer->influencerName }}

                                                @endif
                                                @if (auth()->check() && auth()->user()->isAdmin() )
                                                {{ $influencer->influencerName }}

                                                @endif
                                            </h3>
                                        </div>
                                        <div
                                            class="d-flex gap-3 justify-content-center justify-content-md-start flex-wrap mb-3 mt-2">
                                            <!-- Display brand location -->
                                            <div class="d-flex gap-2 align-items-center text-white">
                                                {{ $influencer->influencerAge }}
                                            </div>
                                            <!-- Display collaboration type -->
                                            {{-- <div class="d-flex gap-2 align-items-center">
                                            {{ $brand->collaboration->name  }}
                                        </div> --}}
                                            <!-- Display brand size -->
                                            <div class="d-flex gap-2 align-items-center text-white">
                                                {{ $influencer->sexe }}
                                            </div>
                                            <!-- Display the brand's monthly salary range (if any) -->
                                            <div class="d-flex gap-2 fw-medium align-items-center text-white">
                                                {{ $influencer->nbr_abonne }} abonnés
                                            </div>
                                            <div
                                            class="job__tags d-flex justify-content-center justify-content-md-start flex-wrap gap-3">
                                            <!-- Display the sector where the brand works -->
                                            <a href="#">{{ $influencer->sector->name }}</a>
                                        </div>
                                        </div>

                                        <div
                                            class="job__tags d-flex justify-content-center justify-content-md-start flex-wrap gap-3">
                                            @php
                                                // Safely get platforms in all cases
                                                $platforms = is_string($influencer->influencerPlatforms)
                                                    ? json_decode($influencer->influencerPlatforms, true) ?? []
                                                    : (is_array($influencer->influencerPlatforms)
                                                        ? $influencer->influencerPlatforms
                                                        : []);
                                            @endphp

                                            @if(!empty($platforms))
                                                @foreach($platforms as $platform)
                                                    <a href="#">{{ ucfirst($platform) }}</a>
                                                @endforeach
                                            @else
                                                <span>Aucune plateforme disponible</span>
                                            @endif
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
                                </div>

                                </nav>
                            </div>

                            <!-- Brand Description -->
                            <div id="description" class="mb-30">
                                <h6 class="fw-semibold mb-20">Description de l'Influenceur(euse)</h6>
                                <p>{{ $influencer->influencerDescription }}</p>
                            </div>

                            <!-- Brand Images Section -->
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
                                <!-- @php
                                    $profileImage = $influencer->image
                                    ? asset('storage/' . $influencer->image)
                                    : asset('assets/images/influencer-default.jpg');
                                @endphp -->
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ $influencer->profile_image ? Storage::disk('do_spaces')->url($influencer->profile_image) : asset('assets/images/influencer-default.jpg') }}" alt="">
                            </div>
                            <h5 class="company__name mt-20">
                                @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status === 'Active')
                                {{ $influencer->influencerName }}
                                @endif
                                @if (auth()->check() && auth()->user()->isAdmin())
                                {{ $influencer->influencerName }}
                                @endif
                            </h5>
                            <a href="#contact" class="rts__btn apply__btn mt-40">Contacter</a>
                        </div>

                        <!-- Brand Contact Form -->
                        <div class="job__contact" id="contact">
                            <h6 class="fw-semibold mb-20">Contacter
                                @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status === 'Active')
                                {{ $influencer->influencerName }}
                                @endif
                                @if (auth()->check() && auth()->user()->isAdmin())
                                {{ $influencer->influencerName }}
                                @endif
                            </h6>
                            @auth
                                @if (auth()->user()->isBrand() && auth()->user()->status === 'Active')
                                    <form action="{{ route('contact.brand.store') }}" method="POST"
                                        class="d-flex flex-column gap-4">
                                        @csrf
                                        <input type="hidden" name="influencer_id" value="{{ $influencer->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user() ? auth()->user()->id : '' }}">

                                        <div class="search__item">
                                            <label for="collaboration"
                                                class="mb-3 font-20 fw-medium text-dark text-capitalize">Select
                                                Collaboration</label>
                                            <div class="position-relative">
                                                <select id="collaboration" name="collaboration_id" class="form-select" required>
                                                    <option value="">Sélectionnez une collaboration</option>
                                                    @forelse($collaborations as $collaboration)
                                                        <option value="{{ $collaboration->id }}">{{ $collaboration->name }}
                                                        </option>
                                                    @empty
                                                        <option value="" disabled>Aucune collaboration disponible</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                        <div class="search__item">
                                            <label class="mb-3 font-20 fw-medium text-dark text-capitalize" for="message">Votre
                                                Message</label>
                                            <textarea name="message" id="message" placeholder="Message" required></textarea>
                                        </div>

                                        <button type="submit" class="rts__btn apply__btn w-100">Envoyer</button>
                                    </form>
                                @else
                                    <div class="alert alert-warning">
                                        Seuls les comptes de marques actives peuvent contacter les influenceurs.
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-info">
                                    Veuillez vous <a href="{{ route('login') }}"> Connecter</a> en tant que <strong style="font-weight:bold">Marque</strong> pour contacter
                                    cet influenceur.
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- job list one end -->

        <!-- top employer -->
        <!-- top employer -->
        <!-- top employer -->
        @if ($influencers->count() >= 5)
        <div class="rts__section pb-120 overflow-hidden">
            <div class="container">
                <div class="row justify-content-center position-relative">
                    <div class="col-xl-6 col-lg-10">
                        <div class="rts__section__content text-center mb-60">
                            <h3 class="rts__section__title section__mb">Autres influenceurs(euses)</h3>
                        </div>
                    </div>
                    <div class="rts__slider__control d-none d-md-flex style-gray z-3 w-100 justify-content-between g-0 position-absolute top-50 translate-middle-y">
                        <div class="rts__slide__next slider__btn"><i class="fa-sharp fa-solid fa-chevron-left"></i></div>
                        <div class="rts__slide__prev slider__btn"><i class="fa-sharp fa-solid fa-chevron-right"></i></div>
                    </div>
                </div>
                <div class="row swiper-data overflow-hidden"
                    data-swiper='{
                        "slidesPerView": 4.1,
                        "autoplay": true,
                        "loop": true,
                        "navigation": {
                            "nextEl": ".rts__slide__next",
                            "prevEl": ".rts__slide__prev"
                        },
                        "breakpoints": {
                            "0": { "slidesPerView": 1.05 },
                            "576": { "slidesPerView": 1.05 },
                            "768": { "slidesPerView": 2.05 },
                            "992": { "slidesPerView": 3.05 },
                            "1200": { "slidesPerView": 4.05 }
                        }
                    }'>
                    <div class="swiper-wrapper">
                        @foreach ($influencers as $influencer)
                            <div class="swiper-slide">
                                <div class="rts__job__card style__five">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="company__icon bg-transparent">
                                            <img style="border-radius:8px" src="{{ $influencer->profile_image ? Storage::disk('do_spaces')->url($influencer->profile_image) : asset('assets/images/influencer-default.jpg') }}" alt="">

                                        </div>
                                        @if (auth()->check() && auth()->user()->isBrand())
                                        <a href="{{ route('show_influencer_auth_brand', ['id' => $influencer->id]) }}" class="apply__btn" aria-label="View Profile">Profil</a>
                                        @endif
                                        @if (auth()->check() && auth()->user()->isAdmin())
                                        <a href="{{ route('show_influencer_auth_admin', ['id' => $influencer->id]) }}" class="apply__btn" aria-label="View Profile">Profil</a>
                                        @endif
                                        @if (auth()->check() && auth()->user()->isInfluencer())
                                        <a href="{{ route('show_influencer_auth_influencer', ['id' => $influencer->id]) }}" class="apply__btn" aria-label="View Profile">Profil</a>
                                        @endif
                                        @guest
                                        <a href="{{ route('show_influencer_guest', ['id' => $influencer->id]) }}" class="apply__btn" aria-label="View Profile">Profil</a>
                                        @endguest
                                    </div>
                                    <div class="d-flex  mt-4 flex-wrap">
                                        <div class="d-flex gap-2 align-items-center font-md">
                                            {{ $influencer->sector->name ?? '' }}
                                        </div>
                                    </div>
                                    <div class="font-20 fw-medium job__title mt-3 mb-2">
                                        <a href="#" aria-label="job" class="job__title">
                                            @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status === 'Active')
                                            {{ $influencer->influencerName }}
                                            @endif
                                            @if (auth()->check() && auth()->user()->isAdmin() )
                                            {{ $influencer->influencerName }}
                                            @endif
                                        </a>
                                    </div>
                                    <p>{{ \Illuminate\Support\Str::limit($influencer->influencerDescription, 60) }}</p>
                                    <div class="job__tags d-flex flex-wrap gap-2 mt-4">
                                        <a href="#">{{ $influencer->influencerAge }}</a>
                                        <a href="#">{{ $influencer->sector->name ?? '' }}</a>

                                        <!-- @auth
                                            @if (auth()->user()->isBrand())
                                                <a style="background-color:var(--rts-primary); color: white;"
                                                    href="{{ route('show_brand_auth_brand', ['id' => $influencer->id]) }}">
                                                    Profil
                                                </a>
                                            @elseif (auth()->user()->isInfluencer())
                                                <a style="background-color:var(--rts-primary); color: white;"
                                                    href="{{ route('show_brand_auth_influencer', ['id' => $influencer->id]) }}">
                                                    Profil
                                                </a>
                                            @endif
                                        @else
                                            <a style="background-color:var(--rts-primary); color: white;"
                                                href="{{ route('show_brand_guest', ['id' => $influencer->id]) }}">
                                                Profil
                                            </a>
                                        @endauth -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

    <!-- top employer end -->

    <!-- top employer end -->

    <!-- top employer end -->

    <x-canva />


@endsection
