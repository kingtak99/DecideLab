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
        $userAgent = $request->userAgent();
        $sessionId = session()->getId();

        // Check if this IP has already visited today
        $alreadyVisitedToday = Visitor::where('ip_address', $ip)
            ->whereDate('visited_at', today())
            ->exists();

        if (!$alreadyVisitedToday) {
            // Get country from IP using MaxMind GeoIP
            $country = $this->getCountryFromIP($ip);
            
            // Log the visit with advanced tracking
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'url' => $request->path(),
                'page_title' => $request->header('referer') ? 'Referred' : 'Direct',
                'referrer' => $request->header('referer'),
                'country' => $country['country'] ?? 'Unknown',
                'country_code' => $country['code'] ?? 'XX',
                'session_id' => $sessionId,
                'session_duration' => 0,
                'user_id' => auth()->id(),
                'visited_at' => now(),
            ]);
        } else {
            // Update session duration for existing session
            $lastVisit = Visitor::where('ip_address', $ip)
                ->where('session_id', $sessionId)
                ->latest('visited_at')
                ->first();
            
            if ($lastVisit) {
                $duration = now()->diffInSeconds($lastVisit->visited_at);
                $lastVisit->update(['session_duration' => $duration]);
            }
        }

        return $next($request);
    }

    /**
     * Get country from IP address using a simple lookup
     * For production, use MaxMind GeoIP2 package
     */
    private function getCountryFromIP($ip)
    {
        try {
            // Using ip-api.com (free tier available)
            $response = @file_get_contents("http://ip-api.com/json/{$ip}");
            if ($response) {
                $data = json_decode($response, true);
                return [
                    'country' => $data['country'] ?? 'Unknown',
                    'code' => $data['countryCode'] ?? 'XX'
                ];
            }
        } catch (\Exception $e) {
            // Silently fail
        }

        return ['country' => 'Unknown', 'code' => 'XX'];
    }
}
