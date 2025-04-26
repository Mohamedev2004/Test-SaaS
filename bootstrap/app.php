<?php

use App\Http\Middleware\Admin_middleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Brand_middleware;
use App\Http\Middleware\CheckEmailVerification;
use App\Http\Middleware\CheckPasswordChange;
use App\Http\Middleware\Influencer_middleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;









return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'auth'=>Authenticate::class,
            'guest'=>RedirectIfAuthenticated::class,
            'admin'=>Admin_middleware::class,
            'brand'=>Brand_middleware::class,
            'influencer'=>Influencer_middleware::class,
            'checkpasswordchange' => CheckPasswordChange::class,
            'checkemailverification' => CheckEmailVerification::class,
            'countdown' => \App\Http\Middleware\CountdownOnly::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
