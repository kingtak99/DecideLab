<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // Check if this IP has already visited today
        $alreadyVisitedToday = Visitor::where('ip_address', $ip)
            ->whereDate('visited_at', today())
            ->exists();

        if (!$alreadyVisitedToday) {
            // Log the visit only if it's a new IP for today
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'user_id' => auth()->id(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
