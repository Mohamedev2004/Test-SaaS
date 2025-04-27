<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- jQuery (Required for Nice Select) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Nice Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

    <meta name="robots" content="index, follow">
    <!-- for open graph social media -->
    <meta property="og:title" content="Your Ultimate Job HTML Template">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <!-- favicon -->
    <link rel="shortcut-icon" href="" type="image/x-icon">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <title>Cocollab</title>
    <!-- rt icons -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/icon/css/rt-icons.css') }}"> -->
    <!-- fontawesome -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/fontawesome.min.css') }}"> -->
    <!-- all plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- jQuery (Required for Nice Select) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Nice Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

    <meta name="robots" content="index, follow">
    <!-- for open graph social media -->
    <meta property="og:title" content="Your Ultimate Job HTML Template">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <!-- favicon -->
    <link rel="shortcut-icon" href="" type="image/x-icon">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <title>Cocollab</title>
    <!-- rt icons -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/icon/css/rt-icons.css') }}"> -->
    <!-- fontawesome -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/fontawesome.min.css') }}"> -->
    <!-- all plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<body>

    @yield('header')

    @yield('content')

    @yield('footer')



    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header p-0 mb-5 mt-4">
          <a href="index.html" class="offcanvas-title" id="offcanvasLabel">
            <img src="{{ asset('assets/img/logo/logo.svg') }}" alt="logo">
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- login offcanvas -->
         <div class="mb-4 d-block d-sm-none">
          <div class="header__right__btn d-flex justify-content-center gap-3">
            <a href="#" class="small__btn d-xl-flex fill__btn border-6 font-xs" aria-label="Job Posting Button">Se connecter</a>
        </div>
         </div>
        <div class="offcanvas-body p-0">
          <div class="rts__offcanvas__menu overflow-hidden">
            <div class="offcanvas__menu"></div>
          </div>
          <p class="max-auto font-20 fw-medium text-center text-decoration-underline mt-4">Nos réseaux sociaux</p>
          <div class="rts__social d-flex justify-content-center gap-3 mt-3">
        <a target="_blank" href="https://facebook.com"  aria-label="facebook">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a target="_blank" href="https://instagram.com"  aria-label="instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a target="_blank" href="https://linkedin.com"  aria-label="linkedin">
            <i class="fa-brands fa-linkedin"></i>
        </a>
        <a target="_blank" href="https://pinterest.com"  aria-label="pinterest">
            <i class="fa-brands fa-pinterest"></i>
        </a>
        <a target="_blank" href="https://youtube.com"  aria-label="youtube">
            <i class="fa-brands fa-youtube"></i>
        </a>
        </div>
        </div>
    </div>

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

</body>


<script src="{{ asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>
</html>
