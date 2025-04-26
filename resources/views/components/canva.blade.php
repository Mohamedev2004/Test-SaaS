<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header p-0 mb-5 mt-4">
          <a href="index.html" class="offcanvas-title" id="offcanvasLabel">
            <img src="{{secure_asset('assets/img/logo/logo.svg')}}" alt="logo">
          </a> 
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- login offcanvas -->
         <div class="mb-4 d-block d-sm-none">
          @if (auth()->check() && auth()->user()->isInfluencer())
          <div class="header__right__btn d-flex justify-content-center gap-3">
            <a href="{{ route('influencer_dashboard') }}" class="small__btn d-xl-flex fill__btn border-6 font-xs" aria-label="Job Posting Button">Profil</a>
          </div>
          <div class="header__right__btn mt-4 d-flex justify-content-center gap-3">
            <a class="small__btn d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('password_update_show_form_influencer') }}">
                Changer le mot de passe
            </a>
          </div>
          @endif

          @if (auth()->check() && auth()->user()->isBrand())
          <div class="header__right__btn d-flex justify-content-center gap-3">
            <a href="{{ route('brand_display') }}" class="small__btn d-xl-flex fill__btn border-6 font-xs" aria-label="Job Posting Button">Profil</a>
          </div>
          <div class="header__right__btn mt-4 d-flex justify-content-center gap-3">
            <a class="small__btn d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('password_update_show_form_brand') }}">
                Changer le mot de passe
            </a>
          </div>
          @endif

          @guest
          <div class="header__right__btn d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="small__btn d-xl-flex fill__btn border-6 font-xs" aria-label="Job Posting Button">Se connecter</a>
          </div>
          @endguest
         </div>
         @auth
          <div class="header__right__btn d-flex justify-content-center gap-3 mb-4">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="small__btn d-xl-flex fill__btn border-6 font-xs" aria-label="Logout Button">
                      Se Déconnecter
                  </button>
              </form>
          </div>
         @endauth

         @if (auth()->check() && auth()->user()->isAdmin())
         <div class="header__right__btn d-flex justify-content-center gap-3 mb-4">
           <a class="small__btn d-sm-flex d-xl-flex fill__btn border-6 font-xs" href="{{ route('users.create') }}">Ajouter un utilisateur</a>
         </div>
         @endif
        <div class="offcanvas-body p-0">
          <div class="rts__offcanvas__menu overflow-hidden">
            <div class="offcanvas__menu"></div>
          </div>
          <p class="max-auto font-20 fw-medium text-center text-decoration-underline mt-4">Nos réseaux sociaux</p>
          <div class="rts__social d-flex justify-content-center gap-3 mt-3">
        <a target="_blank" href="https://facebook.com"  aria-label="facebook">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a target="_blank" href="https://www.instagram.com/cocollabagency?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="  aria-label="instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a target="_blank" href="https://linkedin.com"  aria-label="linkedin">
            <i class="fa-brands fa-linkedin"></i>
        </a>
        <!-- <a target="_blank" href="https://pinterest.com"  aria-label="pinterest">
            <i class="fa-brands fa-pinterest"></i>
        </a> -->
        <!-- <a target="_blank" href="https://youtube.com"  aria-label="youtube">
            <i class="fa-brands fa-youtube"></i>
        </a> -->
        </div>
        </div>
</div>