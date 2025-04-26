@extends('layouts.forms')

@section('content')
<style>
    :root {
        --rts-para: #7D8087;
        --rts-black: #000000;
        --rts-heading: #0B0D28;
        --rts-white: #FFFFFF;
        --rts-gray: #F1F1F1;
        --rts-primary: #9C04FF;
        --rts-button-1: #9C04FF;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--rts-primary);
        color: var(--rts-white);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .countdown-container {
        background-color: var(--rts-white);
        color: var(--rts-heading);
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 800px;
        width: 100%;
    }

    .countdown-title {
        font-size: 2rem;
        font-weight: bold;
        color: var(--rts-primary);
        margin-bottom: 30px;
    }

    .countdown {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    .countdown-item {
        background-color: var(--rts-gray);
        padding: 30px 20px;
        border-radius: 10px;
        min-width: 110px;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .countdown-value {
        font-size: 3rem;
        font-weight: bold;
        color: var(--rts-black);
    }

    .countdown-label {
        font-size: 0.9rem;
        color: var(--rts-para);
        text-transform: uppercase;
        margin-top: 8px;
    }

    .expired-message {
        margin-top: 30px;
        padding: 20px;
        font-size: 1.5em;
        background-color: var(--rts-primary);
        color: var(--rts-white);
        border-radius: 8px;
        display: none;
    }

    @media (max-width: 600px) {
        .countdown-item {
            min-width: 80px;
            padding: 20px 15px;
        }

        .countdown-value {
            font-size: 2rem;
        }

        .countdown-label {
            font-size: 0.8rem;
        }
    }
</style>
<body>
    <div class="countdown-container">
        <h1 class="countdown-title">Prêts à collaborer ?</h1>
        <div class="countdown">
            <div class="countdown-item">
                <div class="countdown-value" id="days">00</div>
                <div class="countdown-label">Jours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="hours">00</div>
                <div class="countdown-label">Heures</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="minutes">00</div>
                <div class="countdown-label">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="seconds">00</div>
                <div class="countdown-label">Secondes</div>
            </div>
        </div>
        <div id="expired-message" class="expired-message">
            Merci pour votre patience, vivez maintenant l’expérience !
        </div>

    </div>


    <script>
        const countdownDate = new Date("{{ $countdownDate }}").getTime();
        const homeUrl = "{{ $homeUrl }}";

        const countdown = setInterval(function () {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
            document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

            if (distance < 0) {
                clearInterval(countdown);
                document.querySelector(".countdown").style.display = "none";
                document.getElementById("expired-message").style.display = "block";
                setTimeout(() => window.location.href = homeUrl, 3000);
            }
        }, 1000);
    </script>
</body>
@endsection
