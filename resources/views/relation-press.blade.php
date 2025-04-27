@extends('layouts.app')

@section('content')

<!-- banner area -->
<section class="rts__banner overflow-hidden rts__section home__three__banner ">
    <div class="rts__banner__background">
    </div>
    <div class="container">
        <div class="row">
            <div class="rts__banner__wrapper d-flex flex-wrap flex-lg-nowrap gap-5  align-items-center">
                <div class="rts__banner__content max-750">
                    <h1 class="rts__banner__title wow animated fadeInUp ">
                        L’art d’inspirer les médias
                    </h1>
                    <p class="rts__banner__desc my-40 br-lg-none  wow animated fadeInUp">
                        Stratégie ciblée, storytelling percutant et réseau média clé en main : nous lions votre marque aux bons interlocuteurs pour une influence presse qui compte.
                    </p>
                </div>
                <div class="rts__banner__image position-relative">
                    <figure class="banner__image">
                        <img src="{{ asset('assets/img/home-3/banner/woman1.png') }}" alt="banner">
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner area end -->

<!-- work process area -->
<section class="rts__section section__padding" style="margin-top:70px !important;margin-bottom:70px !important;">
    <div class="container">
        <div class="row justify-content-center mb-60">
            <div class="col-xl-6 col-lg-10">
                <div class="rts__section__content text-center wow animated fadeInUp">
                    <h3 class="rts__section__title section__mb" style="color: var(--rts-primary);">
                        Pourquoi choisir notre service Relations Presse ?
                    </h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 d-flex bg-purple-600">
                <div class="rts__workprocess__box w-100 d-flex flex-column " style="min-height: 360px; padding: 30px; border-radius: 12px; background-color: #55008C;">
                    <div class="rts__icon mb-3">
                        <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                    </div>
                    <div>
                        <span class="process__title h6 d-block text-white mb-2">Accès à un réseau médiatique qualifié</span>
                        <p class="text-white">Journalistes, rédacteurs, blogueurs spécialisés et influenceurs à forte crédibilité.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="rts__workprocess__box w-100 d-flex flex-column " style="min-height: 360px; padding: 30px; border-radius: 12px; background-color: #55008C;">
                    <div class="rts__icon mb-3">
                        <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                    </div>
                    <div>
                        <span class="process__title h6 d-block text-white mb-2">Stratégies sur-mesure</span>
                        <p class="text-white">Communiqués, interviews, articles sponsorisés ou placements produits dans des médias influents.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="rts__workprocess__box w-100 d-flex flex-column " style="min-height: 360px; padding: 30px; border-radius: 12px; background-color: #55008C;">
                    <div class="rts__icon mb-3">
                        <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                    </div>
                    <div>
                        <span class="process__title h6 d-block text-white mb-2">Authenticité & crédibilité</span>
                        <p class="text-white">Bénéficiez du pouvoir de recommandation de la presse pour renforcer la confiance en votre marque.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
                <div class="rts__workprocess__box w-100 d-flex flex-column" style="min-height: 360px; padding: 30px; border-radius: 12px; background-color: #55008C;">
                    <div class="rts__icon mb-3">
                        <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                    </div>
                    <div>
                        <span class="process__title h6 d-block text-white mb-2">Suivi mesurable</span>
                        <p class="text-white">Analyse d’impact (couverture médiatique, trafic, engagement).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- work process area end -->

<!-- breadcrumb area -->
<div class="rts__section breadcrumb__background">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                <div class="breadcrumb__area max-content breadcrumb__padding z-2">
                    <h1 class="breadcrumb-title h3 mb-4 text-white text-center">Idéal pour : Lancements de produits, storytelling de marque, gestion de réputation ou renforcement sectoriel.  </h1>
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

<section class="rts__section section__padding">
    <div class="container">
        <div class="row align-items-center justify-content-center g-30">
            <div class="col-lg-5 offset-xl-1 col-xl-5">
                <div class="rts__workprocess__image">
                    <img src="{{ asset('assets/img/home-3/about/about-image.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-7 col-xl-6">
                <div class="rts__workprocess__content mx-0 mx-lg-5  wow animated fadeInUp">
                    <div class="rts__section__content text-start">
                        <h3 class="rts__section__title mb-3">Comment ça marche ?</h3>
                    </div>
                    <div class="single__feature__list">

                        <div class="single__item d-flex align-items-start flex-wrap flex-sm-nowrap gap-4">
                            <div class="">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="content">
                                <span class="h6 d-block" style="font-size: 20px !important">Ciblez les bons interlocuteurs (médias traditionnels ou digitaux).  </span>
                            </div>
                        </div>
                        <div class="single__item d-flex align-items-start flex-wrap flex-sm-nowrap gap-4">
                            <div class="">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="content">
                                <span class="h6 d-block" style="font-size: 20px !important">Collaborez directement pour façonner votre narrative.  </span>
                            </div>
                        </div>
                        <div class="single__item d-flex align-items-start flex-wrap flex-sm-nowrap gap-4">
                            <div class="">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/check.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="content">
                                <span class="h6 d-block" style="font-size: 20px !important">Amplifiez votre présence avec des contenus relayés par des voix autorisées.  </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-canva />

@endsection
