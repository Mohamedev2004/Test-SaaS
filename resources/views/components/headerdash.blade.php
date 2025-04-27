<!-- header area -->
<style>
.naviguer{
    background: #9c04ff;
}
.li_dropdown{
    border-top: 1px solid white;
    border-bottom: 1px solid white;
    border-left: none;
    border-right: none;
}
.naviguer:focus,
.naviguer:hover {
    background: #9c04ff;
}
.drop__width{
    width: 100%;
}
@media (max-width: 800px) {
    #dropdown {
        display: none;
    }
}

</style>
<header class="rts__section rts__dashboard__header position-fixed w-100 lg:p-2">
        <div class="container-fluid g-0">
            <div class="rts__menu__background mw-100  mobile__padding rounded-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rts__logo">
                            <a href="index.html">
                            <img class="logo__image" src="{{asset('assets/img/logo/logo.svg')}}" width="160" height="40" alt="logo">
                        </a>
                        </div>


                        <div class="rts__menu d-flex gap-5 gap-lg-4 gap-xl-5 align-items-center">

                            <div class="header__right__btn d-flex align-items-center gap-30">
                                <div class="user__info ">
                                    <div class="d-flex gap-3 align-items-center pointer" data-bs-toggle="dropdown">
                                        <div class="user__name d-none d-xl-block">
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->user()->role === 'admin')
                                <div class="dropdown-center" id="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle naviguer"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Naviguer
                                    </button>
                                    <ul class="dropdown-menu" style="padding: 0px">
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn  font-xs drop__width" href="{{ route('welcome_admin') }}">Acceuil</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('admindashboard') }}">Dashboard</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('latests_influencers_auth_admin') }}">Influenceurs</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('latests_brands_auth_admin') }}">Marques</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('filter_influnecers_auth_admin') }}">Tous les influenceurs</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('filter_brands_auth_admin') }}">Toutes les marques</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('relation_admin') }}">Relations Presse</a></li>
                                      <li class="li_dropdown"><a class="dropdown-item small__btn d-none d-sm-flex d-xl-flex fill__btn font-xs drop__width" href="{{ route('terms-conditions_admin') }}">Termes & Conditions</a></li>
                                    </ul>
                                  </div>
                                {{-- <a class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('welcome_admin') }}">Acceuil</a>
                                <a class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('admindashboard') }}">dashboard</a> --}}
                                    <a class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('users.create') }}">Ajouter un utilisateur</a>
                                @endif
                                @auth
                                @if (auth()->user()->isInfluencer())
                                <a class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('password_update_show_form_influencer') }}">
                                    Changer le mot de passe
                                </a>
                                @endif
                                @if (auth()->user()->isBrand())
                                <a class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('password_update_show_form_brand') }}">
                                    Changer le mot de passe
                                </a>
                                @endif

                                @endauth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs">Se Déconnecter</button>
                                </form>
                                {{-- <a href="{{ route('logout') }}" class="small__btn d-none d-sm-flex d-xl-flex fill__btn border-6 font-xs" aria-label="Job Posting Button">Se Déconnecter</a> --}}
                                <button class="d-md-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="fa-solid fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
