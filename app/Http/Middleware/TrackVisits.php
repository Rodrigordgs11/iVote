<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $key = 'visitor_count';

        if (!Cache::has($key)) {
            Cache::put($key, 1, now()->addHours(24)); 
        } else {
            Cache::increment($key);
        }

        return $next($request);
    }
}
