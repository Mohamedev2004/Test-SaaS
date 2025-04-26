<!-- header area -->
<header class="rts__section rts__header absolute__header">
    <div class="container-none">
        <div class="rts__menu__background">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    @if (auth()->check() && auth()->user()->isBrand())
                    <div class="rts__logo">
                        <a href="{{route('brand_dashboard')}}">
                        <img class="logo__image" src="{{ asset('assets/img/logo/logo.svg') }}" width="250" alt="logo">
                    </a>
                    </div>
                    <div class="rts__menu d-flex gap-5 gap-lg-4 gap-xl-5 align-items-center">
                        <div class="navigation d-none d-lg-block">
                            <nav class="navigation__menu" id="offcanvas__menu">
                                <ul class="list-unstyled">
                                    <li class="space">
                                        <a href="{{route('brand_dashboard')}}" class="navigation__menu--item__link">Accueil</a>
                                    </li>

                                    <li class="space">
                                        <a href="{{route('latests_influencers_auth_brand')}}" class="navigation__menu--item__link">Influenceurs
                                        </a>

                                    </li>

                                    <li class="space">
                                        <a href="{{route('latests_brands_auth_brand')}}" class="navigation__menu--item__link">Marques
                                        </a>

                                    </li>


                                    <li class="space">
                                        <a href="{{route('sponsoring_brand')}}" class="navigation__menu--item__link">Sponsoring</a>

                                    </li>

                                </ul>
                            </nav>
                        </div>

                        <div class="header__right__btn d-flex gap-3">
                            <a href="{{ route('brand_display') }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Editer Profil</a>
                            <button class="d-md-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="fa-solid fa-bars"></i></button>
                        </div>
                        @if (auth()->check() && auth()->user()->isBrand() && auth()->user()->status === 'Active')
                        <div class="header__right__btn d-flex gap-3">
                            <a href="{{ route('brand_single_profile_page', ['id' => auth()->user()->id]) }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Profil</a>
                        </div>
                        @endif
                    </div>
                    @endif
                    @if (auth()->check() && auth()->user()->isInfluencer())
                    <div class="rts__logo">
                        <a href="{{route('influencer_welcome')}}">
                        <img class="logo__image" src="{{ asset('assets/img/logo/logo.svg') }}" width="250" alt="logo">
                    </a>
                    </div>
                    <div class="rts__menu d-flex gap-5 gap-lg-4 gap-xl-5 align-items-center">
                        <div class="navigation d-none d-lg-block">
                            <nav class="navigation__menu" id="offcanvas__menu">
                                <ul class="list-unstyled">
                                    <li class="space">
                                        <a href="{{route('influencer_welcome')}}" class="navigation__menu--item__link">Accueil</a>
                                    </li>

                                    <li class="space">
                                        <a href="{{route('latests_influencers_auth_influencer')}}" class="navigation__menu--item__link">Influenceurs
                                        </a>

                                    </li>

                                    <li class="space">
                                        <a href="{{route('latests_brands_auth_influencer')}}" class="navigation__menu--item__link">Marques
                                        </a>

                                    </li>


                                    <li class="space">
                                        <a href="{{route('sponsoring_influencer')}}" class="navigation__menu--item__link">Sponsoring</a>

                                    </li>

                                </ul>
                            </nav>
                        </div>

                        <div class="header__right__btn d-flex gap-3">
                            <a href="{{ route('influencer_dashboard') }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Editer profil</a>
                            <button class="d-md-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="fa-solid fa-bars"></i></button>
                        </div>
                        @if (auth()->check() && auth()->user()->isInfluencer() && auth()->user()->status === 'Active')
                        <div class="header__right__btn d-flex gap-3">
                            <a href="{{ route('influencer_single_profile_page', ['id' => auth()->user()->id]) }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Profil</a>
                        </div>
                        @endif
                    </div>
                    @endif

                    @guest
                    <div class="rts__logo">
                        <a href="{{route('welcome')}}">
                        <img class="logo__image" src="{{ asset('assets/img/logo/logo.svg') }}" width="250" alt="logo">
                    </a>
                    </div>
                    <div class="rts__menu d-flex gap-5 gap-lg-4 gap-xl-5 align-items-center">
                        <div class="navigation d-none d-lg-block">
                            <nav class="navigation__menu" id="offcanvas__menu">
                                <ul class="list-unstyled">
                                    <li class="space">
                                        <a href="{{route('welcome')}}" class="navigation__menu--item__link">Accueil
                                        </a>
                                    </li>

                                    <li class="space">
                                        <a href="{{route('latests_influencers')}}" class="navigation__menu--item__link">Influenceurs
                                        </a>

                                    </li>

                                    <li class="space">
                                        <a href="{{route('latests_brands')}}" class="navigation__menu--item__link">Marques 
                                        </a>

                                    </li>


                                    <li class="space">
                                        <a href="{{route('sponsoring')}}" class="navigation__menu--item__link">Sponsoring</a>

                                    </li>

                                    <li class="space">
                                        <a href="{{route('relation')}}" class="navigation__menu--item__link">Relations Presse</a>

                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="header__right__btn d-flex gap-3">
                            <a href="{{ route('login') }}" class="small__btn d-none d-sm-flex no__fill__btn border-6 font-xs">Se connecter</a>
                            <button class="d-md-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="fa-solid fa-bars"></i></button>
                        </div>
                    </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
