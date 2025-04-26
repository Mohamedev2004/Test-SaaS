<?php
namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use App\Models\CountdownSetting;
use Illuminate\Support\Facades\Log;

class CountdownOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the current countdown setting from the database
        $countdown = CountdownSetting::first();
        
        // Allow all requests if no countdown exists or it has ended
        if (!$countdown || now()->greaterThanOrEqualTo($countdown->current_end_time)) {
            if($request->routeIs('countdown'))
                return redirect('/');
            return $next($request);
        }
        
        // Redirect to countdown page for all other routes
        return redirect()->route('countdown');
    }
}
