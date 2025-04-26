@if (auth()->check() && auth()->user()->isBrand())
<footer class="rts__section  footer__home__one">
    <div class="container">
        <div class="row">
            <div class="footer__wrapper d-flex flex-wrap flex-column flex-sm-row gap-4 gap-md-0 gap-sm-3 justify-content-between pt-60 pb-60">
                <div class="rts__footer__widget max-320">
                    <a href="{{route('brand_display')}}" class="footer__logo" aria-label="logo">
                    <img src="{{ asset('assets/img/logo/logo.svg') }}" width="160" height="40" alt="logo">
                </a>
                </div>

                <!-- footer menu -->
                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6">Links</div>
                    <ul class="list-unstyled">
                        <li><a href="{{route('brand_display')}}" aria-label="footer__menu__link">Accueil</a></li>
                        <li><a href="{{route('latests_influencers_auth_brand')}}" aria-label="footer__menu__link">Mission Influenceur(Euse)</a></li>
                        <li><a href="{{route('latests_brands_auth_brand')}}" aria-label="footer__menu__link">Marques & Entreprises</a></li>
                        <li><a href="{{route('relation')}}" aria-label="footer__menu__link">Relation Presse</a></li>
                        <li><a href="{{route('sponsoring_brand')}}" aria-label="footer__menu__link">Sponsoring</a></li>
                    </ul>
                </div>

                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6 ">Contactez nous</div>
                    <ul class="list-unstyled mb-3">
                        <li><a href="callto:+212660238895">+212 660-238895</a></li>
                        <li><a href="callto:+212700555111">+212 700-555111</a></li>
                        <li><a href="mailto:contact@cocollab.ma">contact@cocollab.ma</a></li>
                    </ul>
                    <div class="font-20 fw-medium mb-20 text-dark">Social Link</div>
                    <div class="rts__social d-flex gap-4">
                        <!-- <a target="_blank" href="https://facebook.com" aria-label="facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a> -->
                        <a target="_blank" href="https://www.instagram.com/cocollabagency?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" aria-label="instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a target="_blank" href="https://www.linkedin.com/company/cocollab/" aria-label="linkedin">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        <!-- <a target="_blank" href="https://pinterest.com" aria-label="pinterest">
                            <i class="fa-brands fa-pinterest"></i>
                        </a> -->
                        <!-- <a target="_blank" href="https://youtube.com" aria-label="youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a> -->
                    </div>
                </div>

                <!-- newsletter form -->
                <div class="rts__footer__widget max-320">
                    <div class="font-20 fw-medium mb-3 h6 ">Abonnez-vous à notre newsletter.</div>
                    <p class="br-sm-none">Abonnez-vous à notre newsletter <br> et recevez des mises à jour sur nos nouveaux cours.</p>
                    <form action="{{ route('newsletter.subscribe') }}" class="d-flex align-items-center justify-content-between mt-4 newsletter" method="post">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        <button type="submit" class="rts__btn fill__btn">S'abonner</button>
                    </form>
                </div>
                <!-- newsletter form end -->

            </div>
        </div>
    </div>
    <div class="rts__copyright">
        <div class="container">
            <p class="text-center fw-medium py-4">
                Cocollab.ma appartient à la société Cocollab Agency
            </p>
            <p class="text-center fw-medium py-4">
                Tous droits réservés par &copy; Cocollab Agency.
            </p>
        </div>
    </div>
    </footer>
@endif


@if (auth()->check() && auth()->user()->isInfluencer())
<footer class="rts__section  footer__home__one">
    <div class="container">
        <div class="row">
            <div class="footer__wrapper d-flex flex-wrap flex-column flex-sm-row gap-4 gap-md-0 gap-sm-3 justify-content-between pt-60 pb-60">
                <div class="rts__footer__widget max-320">
                    <a href="{{route('influencer_welcome')}}" class="footer__logo" aria-label="logo">
                    <img src="{{ asset('assets/img/logo/logo.svg') }}" width="160" height="40" alt="logo">
                </a>
                </div>

                <!-- footer menu -->
                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6">Links</div>
                    <ul class="list-unstyled">
                        <li><a href="{{route('influencer_welcome')}}" aria-label="footer__menu__link">Accueil</a></li>
                        <li><a href="{{route('latests_influencers_auth_influencer')}}" aria-label="footer__menu__link">Mission Influenceur(Euse)</a></li>
                        <li><a href="{{route('latests_brands_auth_influencer')}}" aria-label="footer__menu__link">Marques & Entreprises</a></li>
                        <li><a href="{{route('relation')}}" aria-label="footer__menu__link">Relation Presse</a></li>
                        <li><a href="{{route('sponsoring_influencer')}}" aria-label="footer__menu__link">Sponsoring</a></li>
                    </ul>
                </div>

                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6 ">Contactez nous</div>
                    <ul class="list-unstyled mb-3">
                        <li><a href="callto:+212660238895">+212 660-238895</a></li>
                        <li><a href="callto:+212700555111">+212 700-555111</a></li>
                        <li><a href="mailto:contact@cocollab.ma">contact@cocollab.ma</a></li>
                    </ul>
                    <div class="font-20 fw-medium mb-20 text-dark">Social Link</div>
                    <div class="rts__social d-flex gap-4">
                        <!-- <a target="_blank" href="https://facebook.com" aria-label="facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a> -->
                        <a target="_blank" href="https://www.instagram.com/cocollabagency?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" aria-label="instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a target="_blank" href="https://www.linkedin.com/company/cocollab/" aria-label="linkedin">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        <!-- <a target="_blank" href="https://pinterest.com" aria-label="pinterest">
                            <i class="fa-brands fa-pinterest"></i>
                        </a>
                        <a target="_blank" href="https://youtube.com" aria-label="youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a> -->
                    </div>
                </div>

                <!-- newsletter form -->
                <div class="rts__footer__widget max-320">
                    <div class="font-20 fw-medium mb-3 h6 ">Abonnez-vous à notre newsletter.</div>
                    <p class="br-sm-none">Abonnez-vous à notre newsletter <br> et recevez des mises à jour sur nos nouveaux cours.</p>
                    <form action="{{ route('newsletter.subscribe') }}" class="d-flex align-items-center justify-content-between mt-4 newsletter" method="post">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        <button type="submit" class="rts__btn fill__btn">S'abonner</button>
                    </form>
                </div>
                <!-- newsletter form end -->

            </div>
        </div>
    </div>
    <div class="rts__copyright">
        <div class="container">
            <p class="text-center fw-medium py-4">
                Cocollab.ma appartient à la société Cocollab Agency
            </p>
            <p class="text-center fw-medium py-4">
                Tous droits réservés par &copy; Cocollab Agency.
            </p>
        </div>
    </div>
    </footer>
@endif



@guest
<footer class="rts__section  footer__home__one">
    <div class="container">
        <div class="row">
            <div class="footer__wrapper d-flex flex-wrap flex-column flex-sm-row gap-4 gap-md-0 gap-sm-3 justify-content-between pt-60 pb-60">
                <div class="rts__footer__widget max-320">
                    <a href="{{route('welcome')}}" class="footer__logo" aria-label="logo">
                    <img src="{{ asset('assets/img/logo/logo.svg') }}" width="160" height="40" alt="logo">
                </a>
                </div>

                <!-- footer menu -->
                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6">Liens</div>
                    <ul class="list-unstyled">
                        <li><a href="{{route('welcome')}}" aria-label="footer__menu__link">Accueil</a></li>
                        <li><a href="{{route('latests_influencers')}}" aria-label="footer__menu__link">Mission Influenceur(Euse)</a></li>
                        <li><a href="{{route('latests_brands')}}" aria-label="footer__menu__link">Marques & Entreprises</a></li>
                        <li><a href="{{route('relation')}}" aria-label="footer__menu__link">Relation Presse</a></li>
                        <li><a href="{{route('terms-conditions')}}" aria-label="footer__menu__link">Termes & Conditions</a></li>
                        <li><a href="{{route('sponsoring')}}" aria-label="footer__menu__link">Sponsoring</a></li>
                    </ul>
                </div>

                <div class="rts__footer__widget max-content">
                    <div class="font-20 fw-medium mb-3 h6 ">Contactez nous</div>
                    <ul class="list-unstyled mb-3">
                        <li><a href="callto:+212660238895">+212 660-238895</a></li>
                        <li><a href="callto:+212700555111">+212 700-555111</a></li>
                        <li><a href="mailto:contact@cocollab.ma">contact@cocollab.ma</a></li>
                    </ul>
                    <div class="font-20 fw-medium mb-20 text-dark">Nos réseaux sociaux</div>
                    <div class="rts__social d-flex gap-4">
                        <!-- <a target="_blank" href="https://facebook.com" aria-label="facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a> -->
                        <a target="_blank" href="https://www.instagram.com/cocollabagency?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" aria-label="instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a target="_blank" href="https://www.linkedin.com/company/cocollab/" aria-label="linkedin">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        <!-- <a target="_blank" href="https://youtube.com" aria-label="youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a> -->
                    </div>
                </div>

                <!-- newsletter form -->
                <div class="rts__footer__widget max-320">
                    <div class="font-20 fw-medium mb-3 h6 ">Abonnez-vous à notre newsletter.</div>
                    <p class="br-sm-none">Abonnez-vous à notre newsletter <br> et recevez des mises à jour sur nos nouveaux cours.</p>
                    <form action="{{ route('newsletter.subscribe') }}" class="d-flex align-items-center justify-content-between mt-4 newsletter" method="post">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        <button type="submit" class="rts__btn fill__btn">S'abonner</button>
                    </form>
                </div>
                <!-- newsletter form end -->

            </div>
        </div>
    </div>
    <div class="rts__copyright">
        <div class="container">
            <p class="text-center fw-medium py-4">
                Cocollab.ma appartient à la société Cocollab Agency
            </p>
            <p class="text-center fw-medium py-4">
                Tous droits réservés par &copy; Cocollab Agency.
            </p>
        </div>
    </div>
    </footer>
@endguest

