<!DOCTYPE html>
<html lang="en">

<head>
    @PwaHead
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="description" content="Cocollab est une plateforme qui met en relation les marques et les influenceurs. Trouvez le bon partenaire pour vos collaborations en toute simplicité.">
    <meta name="keywords" content="collaboration marque influenceur, plateforme influence marketing, mise en relation marque influenceur, marketing d’influence, partenariat influenceur, influenceur Instagram, influenceur TikTok, influenceur YouTube, stratégie d’influence, marketplace influenceurs">
    <link rel="canonical" href="">

    <style>
            .loader-wrapper.fade-out {
        animation: fadeOut 1s ease-in-out forwards;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    </style>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> --}}





    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <!-- Latest FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- jQuery (Required for Nice Select) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

    <!-- Nice Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" ></script>

    <!-- SEO and Social Media -->
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Cocollab">
    <meta property="og:description" content="Cocollab est une plateforme qui met en relation les marques et les influenceurs. Trouvez le bon partenaire pour vos collaborations en toute simplicité.">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Cocollab">
    <meta name="twitter:description" content="Cocollab est une plateforme qui met en relation les marques et les influenceurs. Trouvez le bon partenaire pour vos collaborations en toute simplicité.">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">

    <title>Cocollab</title>

    <!-- Custom Fonts and Icons -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/icon/css/rt-icons.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/fontawesome.min.css') }}"> -->

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .small.text-muted {
            display: none;
        }
        #pagination-container .pagination * {
            background: #9c04ff;
            color: rgb(255, 255, 255);
        }
    </style>

    @yield('styles') <!-- To allow adding extra styles in other views -->
</head>

<body>

    <x-alerts />


    {{-- <!-- Include Header --> --}}

    {{-- @yield('header') --}}
    @if (auth()->user() && auth()->user()->isAdmin())
        <x-headerdash />
    @endif

    @if (auth()->user() && auth()->user()->isInfluencer())
        <x-header />
    @endif
    @if (auth()->user() && auth()->user()->isBrand())
    <x-header />
@endif
@guest
<x-header />
@endguest


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Include Footer -->
    
    <x-footer />


    @yield('scripts') <!-- To allow adding extra scripts in other views -->
    <!-- THEME PRELOADER START -->
    <div class="loader-wrapper">
        <div class="loader">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- THEME PRELOADER END -->
    <button type="button" class="rts__back__top" id="rts-back-to-top">
        <img src="{{ asset('assets/img/icon/arrow.svg') }}" alt="">
    </button>
    <!-- all plugin js -->
    <script src="{{asset('assets/js/plugins.min.js')}}" ></script>
    <script src="{{asset('assets/js/main.js')}}" ></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.innerWidth <= 576) {
                const prevButton = document.querySelector('.page-item.disabled[aria-disabled="true"] .page-link');
                const nextButton = document.querySelector('.page-item[rel="next"] .page-link');

                if (prevButton) {
                    prevButton.textContent = "Précédent";
                }

                if (nextButton) {
                    nextButton.textContent = "Suivant";
                }
            }
        });
        window.onload = function() {
        const loaderWrapper = document.querySelector('.loader-wrapper');

        // Add a class to apply fade-out effect
        loaderWrapper.classList.add('fade-out');

        // After the animation ends, hide the loader
        loaderWrapper.addEventListener('animationend', function() {
            loaderWrapper.style.display = 'none';
        });
    };
    // Disable right click
    document.addEventListener('contextmenu', e => e.preventDefault());

     // Disable PrintScreen key (won't block Win+Shift+S, but helps)
     document.addEventListener("keyup", e => {
         if (e.key === "PrintScreen") {
             navigator.clipboard.writeText(""); // silently clears clipboard
         }
     });

     // Block dev tools keys (F12, Ctrl+Shift+I, etc.)
     document.onkeydown = function(e) {
         if (
             e.key === "F12" ||
             (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J" || e.key === "C")) ||
             (e.ctrlKey && e.key === "U")
         ) {
             return false;
         }
     };
        </script>

@RegisterServiceWorkerScript
</body>
</html>
