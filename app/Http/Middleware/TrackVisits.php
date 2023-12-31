<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\Statistics;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $key = 'visited';

        if (!$request->session()->has($key)) {
            $request->session()->put($key, true);

            $totalVisitsKey = 'visitor_count';
            if (!Cache::has($totalVisitsKey)) {
                $numberOfVisits = Statistics::where('name', 'visits_count')->first()->value;
                Cache::put($totalVisitsKey, $numberOfVisits, now()->addMinutes(60));
            } else {
                Cache::increment($totalVisitsKey);
                Statistics::where('name', 'visits_count')->first()->increment('value');
            }
        }
        return $next($request);
    }

}
