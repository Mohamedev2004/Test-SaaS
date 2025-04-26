<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <!-- Latest FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- jQuery (Required for Nice Select) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Nice Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

    <!-- SEO and Social Media -->
    <meta name="robots" content="index, follow">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ secure_asset('assets/images/favicon.svg') }}" type="image/x-icon"> 

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">

    <title>Cocollab</title>

    <!-- Custom Fonts and Icons -->
    <!-- <link rel="stylesheet" href="{{ secure_asset('assets/fonts/icon/css/rt-icons.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ secure_asset('assets/fonts/fontawesome/fontawesome.min.css') }}"> -->

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ secure_asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">

    @yield('styles') <!-- To allow adding extra styles in other views -->
</head>

<body>

    <x-alerts />

    <!-- Include Header -->
    <x-headerdash />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>



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
        <img src="{{secure_asset('assets/img/icon/arrow.svg')}}" alt="">
    </button>
    <!-- all plugin js -->
    <script src="{{secure_asset('assets/js/plugins.min.js')}}"></script>
    <script src="{{secure_asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
<!--     <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.getElementById("file").addEventListener("change", function () {
            let fileName = this.files.length > 0 ? this.files[0].name : "Aucune image sélectionnée";
            document.getElementById("file-name").textContent = fileName;
        });
    </script>

    <script>
        document.getElementById("video").addEventListener("change", function () {
            if (this.files.length > 1) {
                alert("You can only upload up to 1 video.");
                this.value = ""; // Reset the input
            }
        });
    </script>

    <script>
        document.getElementById("images").addEventListener("change", function () {
            if (this.files.length > 3) {
                alert("You can only upload up to 3 images.");
                this.value = ""; // Reset the input
            }
        });
    </script> -->


</body>
</html>
