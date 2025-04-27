@extends('layouts.app')

@section('content')
    <style>
        .apply__btn a {
            color: black;
        }

        .apply__btn a:hover {
            color: white;
        }
    </style>

    <!-- banner area -->
    <section class="rts__banner overflow-hidden rts__section home__three__banner ">
        <div class="rts__banner__background">
        </div>
        <div class="container">
            <div class="row">
                <div
                    class="rts__banner__wrapper d-flex flex-wrap flex-lg-nowrap gap-5 justify-content-between align-items-center">
                    <div class="rts__banner__content max-750">
                        <h1 class="rts__banner__title wow animated fadeInUp ">
                            Booster votre marque avec du contenu authentique.
                        </h1>
                        <p class="rts__banner__desc my-40 br-lg-none  wow animated fadeInUp">
                            Créez un impact durable en racontant votre histoire avec authenticité. <br> Attirez, engagez et
                            fidélisez votre audience grâce à un contenu qui reflète vos valeurs !
                        </p>
                        <div class="mybuttons">
                            @if (auth()->check() && auth()->user()->isInfluencer())
                                <a href="{{ route('filter_brands_auth_influencer') }}"
                                    class="small__btn d-none d-sm-flex no__fill__btn border-6 font-md">Voir Toutes les Marques</a>
                            @endif

                            @if (auth()->check() && auth()->user()->isBrand())
                                <a href="{{ route('filter_brands_auth_brand') }}"
                                    class="small__btn d-none d-sm-flex no__fill__btn border-6 font-md">Voir Toutes les Marques</a>
                            @endif

                            @guest
                                <button type="submit" class="signin" aria-label="Search"> <a style="color:white"
                                        href="{{ route('register') }}">Rejoignez-nous</a> </button>
                                <button type="submit" class="signin" aria-label="Search"> <a style="color:white"
                                        href="{{ route('login') }}">Se connecter</a> </button>
                            @endguest
                        </div>
                    </div>
                    <div class="rts__banner__image position-relative">
                        <figure class="banner__image">
                            <img src="{{ asset('assets/img/home-3/banner/woman.png') }}" alt="banner">
                        </figure>
                        <div class="banner__image__shape">
                            <div class="facebook">
                                <i class="fab fa-linkedin"></i>
                            </div>
                            <div class="twitter">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                        </div>
                        <div class="current__job d-flex gap-3">
                            <div class="rts__icon">
                                <img src="{{ asset('assets/img/icon/job.svg') }}" alt="">
                            </div>
                            <div class="rts__text">
                                <span class="h5 mb-0">80+</span>
                                <span>Marques</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner area end -->

    <!-- pricing section -->
    <div class="rts__section pt--10 " style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="row position-relative justify-content-lg-between justify-content-sm-center gap-4 mb-60">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts_section_content text-md-start text-sm-center">
                        <h3 class="rts_sectiontitle section_mb">Nos packs</h3>
                        <p class="rts_section_desc">Trouvez le plan qui vous convient</p>
                    </div>
                </div>
            </div>

            <div class="monthly__pricing active">
                <div class="row g-30"
                    style="
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-wrap: wrap;
                    ">
                    @if ($featurePackData->isEmpty())
                        <div class="col-lg-5 col-xl-3 col-md-6">
                            <p class="text-muted">Aucun pack disponible pour le moment.</p>
                        </div>
                    @else
                        @foreach ($featurePackData as $data)
                            <div class="col-lg-5 col-xl-3 col-md-6">
                                @if (auth()->check() && auth()->user()->isBrand())
                                <div class="rts__pricing__box"
                                    style="display: flex; flex-direction: column; align-items: flex-start; justify-content: space-between; gap: 10px; min-height: 600px; padding: 20px; border: 1px solid #ddd; border-radius: 12px; flex: 1 1 300px; box-sizing: border-box; background: white;">

                                    <!-- Pack Name -->
                                    <div class="plan__price lh-1 mb-40">
                                        <span style="font-size: 30px !important; font-weight:bold !important;" class="text-xl text-black">{{ $data->name }}</span>
                                    </div>

                                    <!-- Pack Description -->
                                    <div class="h6 fw-medium lh-1 mb-2 text-primary" style="font-weight:bolder !important;margin-bottom:30px !important;">
                                        {{ $data->description }}
                                    </div>


                                    <!-- Features List -->
                                    <div style="flex: 1; width: 100%;">
                                        <ul class="plan__feature text-black" style="list-style-type: disc;">
                                            @foreach ($data->features as $feature)
                                                <li>&#x2714; {{ $feature->description }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Subscribe Button Centered -->
                                    <!-- <div style="width: 100%; text-align: center; margin-top: 20px;">
                                        <a href="{{ route('login') }}" class="rts__btn pricing__btn no__fill__btn">
                                            S'abonner
                                        </a>
                                    </div> -->
                                </div>
                                @endif

                                @if (auth()->check() && auth()->user()->isInfluencer())
                                <div class="rts__pricing__box"
                                    style="display: flex; flex-direction: column; align-items: flex-start; justify-content: space-between; gap: 10px; min-height: 600px; padding: 20px; border: 1px solid #ddd; border-radius: 12px; flex: 1 1 300px; box-sizing: border-box; background: white;">

                                    <!-- Pack Name -->
                                    <div class="plan__price lh-1 mb-40">
                                        <span style="font-size: 30px !important; font-weight:bold !important;" class="text-xl text-black">{{ $data->name }}</span>
                                    </div>

                                    <!-- Pack Description -->
                                    <div class="h6 fw-medium lh-1 mb-2 text-primary" style="font-weight:bolder !important;margin-bottom:30px !important;">
                                        {{ $data->description }}
                                    </div>


                                    <!-- Features List -->
                                    <div style="flex: 1; width: 100%;">
                                        <ul class="plan__feature text-black" style="list-style-type: disc;">
                                            @foreach ($data->features as $feature)
                                                <li>&#x2714; {{ $feature->description }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Subscribe Button Centered -->
                                    <!-- <div style="width: 100%; text-align: center; margin-top: 20px;">
                                        <a href="{{ route('login') }}" class="rts__btn pricing__btn no__fill__btn">
                                            S'abonner
                                        </a>
                                    </div> -->
                                </div>
                                @endif

                                @guest
                                <div class="rts__pricing__box"
                                    style="display: flex; flex-direction: column; align-items: flex-start; justify-content: space-between; gap: 10px; min-height: 600px; padding: 20px; border: 1px solid #ddd; border-radius: 12px; flex: 1 1 300px; box-sizing: border-box; background: white;">

                                    <!-- Pack Name -->
                                    <div class="plan__price lh-1 mb-40">
                                        <span style="font-size: 30px !important; font-weight:bold !important;" class="text-xl text-black">{{ $data->name }}</span>
                                    </div>

                                    <!-- Pack Description -->
                                    <div class="h6 fw-medium lh-1 mb-2 text-primary" style="font-weight:bolder !important;margin-bottom:30px !important;">
                                        {{ $data->description }}
                                    </div>


                                    <!-- Features List -->
                                    <div style="flex: 1; width: 100%;">
                                        <ul class="plan__feature text-black" style="list-style-type: disc;">
                                            @foreach ($data->features as $feature)
                                                <li>&#x2714; {{ $feature->description }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Subscribe Button Centered -->
                                    <div style="width: 100%; text-align: center; margin-top: 20px;">
                                        <a href="{{ route('register') }}" class="rts__btn pricing__btn no__fill__btn">
                                            S'abonner
                                        </a>
                                    </div>
                                </div>
                                @endguest
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div style="width: 100%; text-align: center; margin-top: 60px;">
                <a href="{{ route('demo.request') }}" class="rts__btn pricing__btn no__fill__btn">
                    Demander un Rendez-vous
                </a>
            </div>
        </div>
    </div>
    <!-- pricing section end -->





    <!-- featured job area -->
    <section class="rts__section section__padding featured__job featured__bg">
        <div class="container">
            <div class="row justify-content-between g-4 mb-60">
                <div class="col-xl-6 col-lg-10">
                    <div class="rts__section__content text-start wow animated fadeInUp">
                        <h3 class="rts__section__title section__mb">Nos Marques</h3>
                        <p class="rts__section__desc">Votre communication digitale avec l’Agence Influenceur</p>
                    </div>
                </div>

                <div class="d-flex align-items-end max-content">
                    @if (auth()->check() && auth()->user()->isBrand())
                        <a href="{{ route('filter_brands_auth_brand') }}"
                            class="text-white d-flex gap-2 align-items-center"
                            style="font-size: 20px; font-weight: bolder; text-decoration:underline">Voir Tout</a>
                    @endif
                    @if (auth()->check() && auth()->user()->isInfluencer())
                        <a href="{{ route('filter_brands_auth_influencer') }}"
                            class="text-white d-flex gap-2 align-items-center"
                            style="font-size: 20px; font-weight: bolder; text-decoration:underline">Voir Tout</a>
                    @endif
                    @if (auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('filter_brands_auth_admin') }}"
                        class="text-white d-flex gap-2 align-items-center"
                        style="font-size: 20px; font-weight: bolder; text-decoration:underline">Voir Tout</a>
                @endif
                    @guest
                        <a href="{{ route('allbrands') }}" class="text-white d-flex gap-2 align-items-center"
                            style="font-size: 20px; font-weight: bolder; text-decoration:underline">Voir Tout</a>
                    @endguest
                </div>
            </div>

            <div class="row px-3 d-flex flex-column g-30">
                @if ($latestBrands->isEmpty())
                    <div class="rts__job__card__big d-flex flex-wrap flex-md-nowrap gap-4 align-items-center">
                        <div class="d-flex justify-content-between flex-wrap w-100 gap-3 gap-lg-2">
                            <div class="job__meta">
                                <div class="d-flex gap-3 flex-wrap gap-lg-4 fw-medium">
                                    <div class="d-flex gap-2 align-items-center">
                                        Aucune marque disponible pour le moment.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($latestBrands as $brand)
                        <!-- single brand item -->
                        <div class="rts__job__card__big d-flex flex-wrap flex-md-nowrap gap-4 align-items-center">
                            <div class="company__icon" style="background: #9c04ff;">

                                @php
                                    $logo = $brand->logo_image
                                        ? Storage::disk('do_spaces')->url($brand->logo_image)
                                        : asset('assets/images/influencer-default.jpg');
                                @endphp

                                <img style="border-radius: 100px;height: 90%;width: 90%;" src="{{ $logo }}"
                                    alt="{{ $brand->brandName }}">
                            </div>
                            <div class="d-flex justify-content-between flex-wrap w-100 gap-3 gap-lg-2">
                                <div class="job__meta">
                                    <div class="d-flex align-items-center justify-content-between gap-3">
                                        <a href="#" class="job__title h6 fw-semibold">{{ $brand->brandName }}</a>
                                    </div>
                                    <div class="d-flex gap-3 flex-wrap gap-lg-4 fw-medium">
                                        <div class="d-flex gap-2 align-items-center">
                                            {{ $brand->sector->name ?? 'Non spécifié' }}
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            {{ $brand->brandSize }}
                                        </div>
                                        <!-- <div class="d-flex gap-2 align-items-center">
                                            {{ $brand->created_at->diffForHumans() }}
                                        </div> -->
                                    </div>
                                </div>
                                <div class="d-flex gap-3 gap-lg-5 flex-wrap align-items-center">
                                    <div class="job__tags d-flex flex-wrap gap-3">
                                        <a href="#">{{ $brand->brandLocalisation }}</a>
                                    </div>
                                    <div class="d-flex gap-3 flex-wrap">

                                        <button class="applyy__btn">
                                            @if (auth()->check() && auth()->user()->isBrand())
                                                <a href="{{ route('show_brand_auth_brand', ['id' => $brand->id]) }}">Voir
                                                    Profil</a>
                                            @elseif (auth()->check() && auth()->user()->isInfluencer())
                                                <a href="{{ route('show_brand_auth_influencer', ['id' => $brand->id]) }}">Voir
                                                    Profil</a>
                                            @elseif (auth()->check() && auth()->user()->isAdmin())
                                            <a href="{{ route('show_brand_auth_admin', ['id' => $brand->id]) }}">Voir
                                                Profil</a>
                                            @else
                                                <a href="{{ route('show_brand_guest', ['id' => $brand->id]) }}">Voir
                                                    Profil</a>
                                            @endif
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single brand item end -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- featured job area end -->

    <x-canva />

@endsection
