@extends('layouts.app')

{{-- @section('header')
<x-header />
@endsection --}}
@section('content')
    <!-- banner area -->
    <section class="rts__banner home__one__banner pt-260">
        <div class="rts__banner__background">
            <div class="shape__home__one __first d-none d-lg-block">
                <img src="{{ asset('assets/img/home-1/banner/banner-shape.svg') }}" alt="">
            </div>
            <div class="shape__home__one __second d-none d-lg-block">
                <img src="{{ asset('assets/img/home-1/banner/banner-shape-2.svg') }}" alt="">
            </div>
            <div class="shape__home__one __third">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="rts__banner__wrapper d-flex gap-4 justify-content-between ">
                    <div class="rts__banner__content">
                        <h1 class="rts__banner__title wow animated fadeInUp ">
                            Licenciez votre <span>Patron</span>, Vivez votre
                            <span>Passion</span>.
                        </h1>
                        <p class="rts__banner__desc my-40 wow animated fadeInUp" data-wow-delay=".1s">
                            L'agence Influencer, nos mission vous attendent.
                        </p>
                        <div class="mybuttons">

                            @if (auth()->check() && auth()->user()->isInfluencer())
                                <a href="{{ route('influencer_dashboard') }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Profil</a>
                            @endif

                            @if (auth()->check() && auth()->user()->isBrand())
                                <a href="{{ route('brand_display') }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Profil</a>
                            @endif

                            @guest
                                <button type="submit" class="signin" aria-label="Search" > <a style="color:white" href="{{route('register')}}">Rejoignez-nous</a> </button>
                                <button type="submit" class="signin" aria-label="Search" > <a style="color:white" href="{{route('login')}}">Se connecter</a> </button>
                            @endguest
                        </div>
                    </div>
                    <div class="rts__banner__image position-relative">
                        <figure class="banner__image">
                            <img src="{{ asset('assets/img/home-1/banner/image_2x.webp') }}" alt="banner">
                        </figure>
                        <div class="banner__image__shape">
                            <div class="facebook">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="twitter">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner area end -->
    <!-- work process area -->
    <section class="rts__section section__padding">
        <div class="container">
            <div class="row justify-content-center mb-60">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-center wow animated fadeInUp">
                        <h3 class="rts__section__title section__mb" style="color: var(--rts-primary);">Comment ça fonctionne ?</h3>
                        <p class="rts__section__desc">Des étapes simples, des avantages infinis.</p>
                    </div>
                </div>
            </div>
            <div class="row g-30 justify-content-center">
                <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".1s">
                    <div class="rts__workprocess__box">
                        <div class="rts__icon">
                            <img src="{{ asset('assets/img/home-1/process/icon-1.svg') }}" alt="">
                        </div>
                        <span class="process__title h6 d-block text-white"> <a class="text-white" href="{{route('register')}}">Créez votre compte</a></span>
                        <p class="text-white">Commencez par créer votre compte en renseignant vos informations.
                        </p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".2s">
                    <div class="rts__workprocess__box">
                        <div class="rts__icon">
                            <img src="{{ asset('assets/img/home-1/process/icon-2.svg') }}" alt="">
                        </div>
                        <span class="process__title h6 d-block text-white"> <a class="text-white" href="{{route('allbrands')}}">Recherchez une Marque</a></span>
                        <p class="text-white">Trouvez les meilleures opportunités de collaboration en quelques clics !
                        </p>

                    </div>
                </div>
                @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status === 'Active')
                <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".3s">
                    <div class="rts__workprocess__box rounded-md">
                        <div class="rts__icon">
                            <img src="{{ asset('assets/img/home-1/process/icon-3.svg') }}" alt="">
                        </div>
                        <span class="process__title h6 d-block text-white"><a class="text-white" href="{{route('filter_influnecers_auth_brand')}}">Recherchez un influenceur</a></span>
                        <p class="text-white">Trouvez les meilleures opportunités de collaboration en quelques clics !
                        </p>

                    </div>
                </div>
                @else
                <div class="col-lg-4 col-md-10 wow animated fadeInUp" data-wow-delay=".3s">
                    <div class="rts__workprocess__box rounded-md">
                        <div class="rts__icon">
                            <img src="{{ asset('assets/img/home-1/process/icon-3.svg') }}" alt="">
                        </div>
                        <span class="process__title h6 d-block text-white"><a class="text-white" href="{{route('latests_influencers')}}">Recherchez un influenceur</a></span>
                        <p class="text-white">Trouvez les meilleures opportunités de collaboration en quelques clics !
                        </p>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- work process area end -->

    <!-- brand area -->
    <div class="rts__section rts__brand pb-120 pt-50 text-center">
        <div class="container">
            <div class="row">
                <div class="section__title mb-40">
                    <span class="h6 d-block fw-semibold">Fiable et approuvé par plus de 50 entreprises leaders.</span>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="rts__brand__slider overflow-hidden swiper-data" data-swiper='{
                "slidesPerView":7,
                "loop": true,
                "speed": 1000,
                "autoplay":{
                    "delay":"100"
                },

                "breakpoints": {
                    "0": {
                        "slidesPerView": 2
                    },
                    "480": {
                        "slidesPerView": 3
                    },
                    "768": {
                        "slidesPerView": 4
                    },
                    "1024": {
                        "slidesPerView": 4
                    },
                    "1200": {
                        "slidesPerView": 6
                    },
                    "1400": {
                        "slidesPerView": 7
                    }
                }

            }'>
                    <div class="swiper-wrapper" style="display: flex !important; align-items: center;">
                        <div class="swiper-slide" style="display: flex !important; align-items:  !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b1.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b2.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b3.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b4.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b5.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b6.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b7.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/b8.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/a1.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/a2.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/a3.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                        <div class="swiper-slide" style="display: flex !important; align-items: center !important;">
                            <div class="brand__item">
                                <a href="#" class="brand__item__link" aria-label="brand">
                                <img src="{{ asset('assets/img/home-1/brand/a4.png') }}" alt="">
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand area end -->



    <!-- current open position -->
    <section class="rts__section section__padding">
        <div class="container">
            <div class="row justify-content-center mb-60">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-center wow animated fadeInUp">
                        <h3 class="rts__section__title section__mb">
                            Plus que {{ $eightyPercentCount }}+ Marque sur Cocollab.
                        </h3>
                        <p class="rts__section__desc">
                            Découvrez plus de 100 opportunités de collaboration sur Cocollab et trouvez le partenaire idéal.
                            De nouvelles campagnes vous attendent, que vous soyez marque ou influenceur !
                        </p>
                    </div>
                </div>
            </div>

                    <div id="brands-container" class="row g-30 wow animated fadeInUp" data-wow-delay=".0s">
                        <!-- Brand cards will be loaded dynamically here -->
                    </div>

                    <!-- Pagination Links -->
                    <div id="pagination-container">
                        <!-- Pagination links will be loaded dynamically here -->
                    </div>

        </div>
    </section>


    <script>
        $(document).ready(function() {
            // Function to fetch and display brands
            function fetchBrands(url = "") {
                // Default to current URL if no URL is provided
                if (!url) {
                    url = window.location.href;
                }

                // AJAX request to fetch brand data and pagination
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Update the brands container with brand data
                        var brandHtml = '';
                        $.each(response.brands, function(index, brand) {
                            brandHtml += `
                                <div class="col-lg-6 col-xl-4 col-md-6">
                                    <div class="rts__job__card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="company__icon bg-transparent">
                                                <img src="${brand.logo_image}" alt="${brand.brandName}" style="border-radius:100px; border: purple 2px solid">
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 mt-4 flex-wrap">
                                            <div class="d-flex gap-1 align-items-center">
                                                ${brand.brandLocalisation ?? 'Localisation'}
                                            </div>
                                            <div class="d-flex gap-1 align-items-center">
                                                ${brand.sector_name ?? 'Domaine'}
                                            </div>
                                        </div>
                                        <div class="h6 job__title my-3">
                                            <a href="${brand.show_url}" aria-label="job">
                                                ${brand.brandName}
                                            </a>
                                        </div>
                                        <p class="limited-multiline">${brand.brandDescription}</p>
                                        <div class="job__tags d-flex flex-wrap gap-3 mt-4">
                                            <a href="#">${brand.brandSize}</a>
                                            <a href="#">${brand.collaboration_type}</a>
                                            <a style="background-color:var(--rts-primary); color: white;" href="${brand.show_url}">
                                                Voir Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>`;
                        });

                        // Insert new brand data into the container
                        $('#brands-container').html(brandHtml);

                        // Update the pagination links
                        $('#pagination-container').html(response.pagination);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            }

            // Initial call to fetch brands when page is loaded (considering URL might have pagination)
            fetchBrands();

            // Handle pagination link click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault(); // Prevent default anchor behavior (page refresh)
                var url = $(this).attr('href'); // Get the URL from the clicked pagination link

                // Update the URL to reflect the current page (to maintain state when returning)
                window.history.pushState({}, '', url);

                fetchBrands(url); // Fetch brands for the new page
            });

            // Handle browser back and forward navigation (preserve pagination state)
            window.onpopstate = function() {
                fetchBrands(window.location.href);
            };
        });
        </script>




    <!-- current open position end -->

    <!-- funfact section -->
    <div class="rts__section section__padding">
        <div class="container">
            <div class="row g-30 justify-content-center wow animated slideInUp">
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">10</span>+</h2>
                        <p class="h6 mb-0 fw-semibold">Années d'expérience </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">50</span>+</h2>
                        <p class="h6 mb-0 fw-semibold">Projets réalisés</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">15</span>+</h2>
                        <p class="h6 mb-0 fw-semibold">Membres de l'équipe</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="rts__single__counter">
                        <h2 class="fw-bold ms-lg-3 mx-auto heading__color"><span class="counter">98</span>%</h2>
                        <p class="h6 mb-0 fw-semibold">Clients satisfaits</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- funfact section end -->

    <!-- what we are -->
    <div class="rts__section pb-120">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="rts__image__section">
                        <img src="{{ asset('assets/img/home-1/we-are/image.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="rts__content__section ms-lg-4 ms-md-0 wow animated fadeInUp">
                        <h3 class="fw-bold mb-4">Trouvez l’influenceur / l’influenceuse idéal(e) pour votre marque.</h3>
                        <p>L’Agence Influenceur facilite la collaboration entre marques et influenceurs grâce à des stratégies marketing ciblées. Nous vous aidons à mesurer et optimiser votre influence, à accroître votre audience et à établir des partenariats efficaces avec les marques.</p>
                        <div class="mt-40 rts__listing">
                            <div class="single__listing d-flex align-items-center gap-4">
                                <span class="icon">
                                    </span>
                                <span>Expertise marketing</span>
                            </div>
                            <div class="single__listing d-flex align-items-center gap-4">
                                <span class="icon">
                                    </span>
                                <span>Accompagnement</span>
                            </div>
                            <div class="single__listing d-flex align-items-center gap-4">
                                <span class="icon">
                                    </span>
                                <span>Analyse de performance</span>
                            </div>
                            <div class="single__listing d-flex align-items-center gap-4">
                                <span class="icon">
                                    </span>
                                <span>Réseau étendu  </span>
                            </div>
                        </div>

                        @if (auth()->check() && auth()->user()->isInfluencer())
                        {{-- <a href="{{ route('filter_influnecers_auth_influencer') }}" class="rts__btn common__btn  fill__btn mt-50">Voir Plus</a> --}}
                    @endif

                    @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status = 'Active')
                    <a href="{{ route('filter_influnecers_auth_brand') }}" class="rts__btn common__btn  fill__btn mt-50">Voir Plus</a>
                    @endif

                    @guest
                    {{-- <a href="{{ route('allinfluencers') }}" class="rts__btn common__btn  fill__btn mt-50">Voir Plus</a> --}}
                    @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- what we are end -->

    <!-- testimonial section -->
    <div class="rts__section section__padding rts__testimonial__background">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="rts__testimonial__active overflow-hidden swiper-data" data-swiper='{
                            "slidesPerView": 1,
                            "autoplay": true,
                            "loop": true,
                            "navigation": {
                                "nextEl": ".rts__slide__next",
                                "prevEl": ".rts__slide__prev"
                            }
                        }'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="rts__single__testimonial text-center">
                                    <div class="rts__quote mb-40">
                                        <img class="opacity-100" src="{{ asset('assets/img/icon/quote.svg') }}" alt="">
                                    </div>
                                    <div class="testimonial__text h6 text-black">Une plateforme innovante pour des collaborations authentiques Cocollab.ma offre une solution unique pour les marques et les influenceurs à la recherche de partenariats authentiques, efficaces et mesurables.</div>
                                    <div class="d-flex align-items-center justify-content-center mx-auto gap-3 pt-40 max-content">
                                        <!-- <div class="author__image">
                                            <img src="{{ asset('assets/img/home-1/testimonial/author.jpg') }}" alt="">
                                        </div> -->
                                        <div class="author__content text-start">
                                            <span class="h6">LA VIE ECO</span>
                                            <p class="text-black text-center">Journal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="rts__single__testimonial text-center">
                                    <div class="rts__quote mb-40">
                                        <img class="opacity-100" src="{{ asset('assets/img/icon/quote.svg') }}" alt="">
                                    </div>
                                    <div class="testimonial__text h6 text-black">Le paysage du marketing d’influence au Maroc s’apprête à connaître une évolution notable avec le lancement de Cocollab.ma, une plateforme de mise en relation directe entre marques et influenceurs.</div>
                                    <div class="d-flex align-items-center justify-content-center mx-auto gap-3 pt-40 max-content">
                                        <!-- <div class="author__image">
                                            <img src="{{ asset('assets/img/home-1/testimonial/author.jpg') }}" alt="">
                                        </div> -->
                                        <div class="author__content text-start">
                                            <span class="h6">Maroc Hebdo</span>
                                            <p class="text-black text-center">Journal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial section end -->

    <x-canva />
@endsection
