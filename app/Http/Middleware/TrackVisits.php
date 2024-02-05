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
                $numberOfVisits = Statistics::where('name', 'visits_count')->first();

                if ($numberOfVisits) {
                    Cache::put($totalVisitsKey, $numberOfVisits->value, now()->addMinutes(60));
                } else {
                    // Handle the case when the "visits_count" record is not found
                    // You can set a default value or throw an exception
                    // For example:
                    // Cache::put($totalVisitsKey, 0, now()->addMinutes(60));
                    // throw new \Exception('Unable to find "visits_count" record');
                }
            } else {
                Cache::increment($totalVisitsKey);
                Statistics::where('name', 'visits_count')->first()->increment('value');
            }
        }
        return $next($request);
    }

}
