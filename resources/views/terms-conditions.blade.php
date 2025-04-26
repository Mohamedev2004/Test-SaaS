
@extends('layouts.app')

@section('content')

<!-- breadcrumb area -->
<div class="rts__section breadcrumb__background">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 position-relative d-flex justify-content-between align-items-center">
                <div class="breadcrumb__area max-content breadcrumb__padding z-2">
                    <h1 class="breadcrumb-title h3 mb-3 text-white">Termes et Conditions</h1>
                    <nav>
                        <ul class="breadcrumb m-0 lh-1">
                            <li class="breadcrumb-item"><a style="color: white !important;" href="index.html">Acceuil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Termes et Conditions</li>
                        </ul>
                    </nav>
                </div>
                <div class="breadcrumb__area__shape d-flex gap-4 justify-content-end align-items-center">
                    <div class="shape__one common">
                        <img src="{{ secure_asset('assets/img/breadcrumb/shape-1.svg') }}" alt="">
                    </div>
                    <div class="shape__two common">
                        <img src="{{ secure_asset('assets/img/breadcrumb/shape-2.svg') }}" alt="">
                    </div>
                    <div class="shape__three common">
                        <img src="{{ secure_asset('assets/img/breadcrumb/shape-3.svg') }}" alt="">
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
        
        <h3 class="font-bold mb-4">Conditions Générales d’Utilisation – Cocollab</h3>

        <p class="mb-2">
            L’utilisation de la plateforme Cocollab implique l’acceptation pleine et entière des présentes conditions générales. Cocollab est une solution en ligne destinée à faciliter la mise en relation entre marques et influenceurs dans le cadre de collaborations professionnelles. Chaque utilisateur, qu’il soit une marque ou un influenceur, s’engage à fournir des informations exactes lors de son inscription et à utiliser la plateforme de manière honnête et respectueuse. Cocollab se réserve le droit de suspendre ou supprimer tout compte en cas de non-respect des règles d’usage, de comportement inapproprié ou de diffusion de contenu frauduleux. En accédant à Cocollab, les utilisateurs reconnaissent être pleinement responsables des échanges et accords établis via la plateforme. Pour toute question, veuillez nous contacter à l’adresse suivante : contact@cocollab.ma.
        </p>


    </div>
</div>
<!-- job list one end -->

<x-canva />

@endsection
