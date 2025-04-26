<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class Brand_middleware
{
    public function handle(Request $request, Closure $next): Response
    {
            if (Auth::check() && Auth::user()->isBrand()) {
                if ($request->is(LaravelLocalization::getCurrentLocale() . '/brand*')) {

                // Log::info("User is authenticated: Locale: ");
                    return $next($request);

                }
                return redirect()->route('brand_dashboard');
            }
            return redirect()->route('welcome');
    }
}
