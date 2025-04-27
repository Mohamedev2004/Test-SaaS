<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="keywords" content="">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">

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

    @yield('styles') <!-- To allow adding extra styles in other views -->
</head>

<body class="flex items-center justify-center min-h-screen bg-purple-900 px-4 relative">

<x-alerts />

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
        <img src="{{ asset('assets/img/icon/arrow.svg') }}" alt="">
    </button>
    <!-- all plugin js -->
    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById('fileInput');
            const fileName = document.getElementById('fileName');

            if (fileInput) {
                fileInput.addEventListener('change', function (event) {
                    fileName.textContent = event.target.files.length > 0 ? event.target.files[0].name : "Document";
                });
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
    document.addEventListener('DOMContentLoaded', function () {
        const loginPasswordInput = document.getElementById('login-password');

        const resetPasswordInput1 = document.getElementById('reset-password');
        const resetPasswordInput2 = document.getElementById('reset-cpassword');

        const toggleCheckbox = document.getElementById('show-password');

        toggleCheckbox.addEventListener('change', function () {
            if(loginPasswordInput)
                loginPasswordInput.type = this.checked ? 'text' : 'password';
            if(resetPasswordInput1)
                resetPasswordInput1.type = this.checked ? 'text' : 'password';
            if(resetPasswordInput2)
                resetPasswordInput2.type = this.checked ? 'text' : 'password';

        });
    });
    </script>


</body>
</html>
