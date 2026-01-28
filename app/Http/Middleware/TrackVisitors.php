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

        // Ignore bot requests
        if ($this->isBot($userAgent)) {
            return $next($request);
        }

        // Skip certain paths
        $skipPaths = ['/health', '/ping', '/favicon.ico', '/robots.txt', '/.well-known'];
        if (in_array($request->path(), $skipPaths)) {
            return $next($request);
        }

        try {
            // Get country from IP (with fallback chain: ip-api.com → ipapi.co → local)
            $country = $this->getCountryFromIP($ip);
            
            // Log every visit with complete tracking data
            $visitorData = [
                'ip_address' => $ip,
                'user_agent' => $userAgent ?? 'Unknown',
                'url' => $request->path() ?? '/',
                'page_title' => $request->header('referer') ? 'Referred' : 'Direct',
                'referrer' => $request->header('referer'),
                'country' => $country['country'] ?? 'Unknown',
                'country_code' => $country['code'] ?? 'XX',
                'session_id' => $sessionId,
                'session_duration' => 0,
                'user_id' => auth()->check() ? auth()->id() : null,
                'visited_at' => now(),
                'is_bot' => 0,
            ];

            Visitor::create($visitorData);
            
            // Log success for debugging
            if (config('app.debug')) {
                \Log::info('Visitor tracked', [
                    'ip' => $ip,
                    'country' => $country['country'] ?? 'Unknown',
                    'user_agent' => substr($userAgent ?? '', 0, 50),
                ]);
            }
        } catch (\Exception $e) {
            // Log error but don't break the request
            \Log::error('Visitor tracking failed: ' . $e->getMessage(), [
                'ip' => $ip,
                'trace' => $e->getTraceAsString()
            ]);
        }

        return $next($request);
    }

    /**
     * Check if user agent is a bot
     */
    private function isBot($userAgent): bool
    {
        if (!$userAgent) {
            return false;
        }

        $botPatterns = [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget', 'python',
            'java', 'golang', 'perl', 'ruby', 'php', 'nodejs', 'requests',
            'httpclient', 'axiosbot', 'scrapy', 'selenium', 'headless',
            'googlebot', 'bingbot', 'yandexbot', 'slurp', 'duckduckbot',
            'baiduspider', 'sogoubot', 'exabot', 'facebookexternalhit',
            'twitterbot', 'linkedinbot', 'whatsapp', 'telegrambot', 'slackbot',
            'censys', 'zgrab', 'palo alto', 'shodan', 'nessus',
            'nmap', 'metasploit', 'masscan', 'zmap'
        ];

        $userAgentLower = strtolower($userAgent);
        
        foreach ($botPatterns as $pattern) {
            if (strpos($userAgentLower, $pattern) !== false) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get country from IP address
     * Uses multiple methods with fallbacks
     */
    private function getCountryFromIP($ip)
    {
        // Skip localhost
        if ($ip === '127.0.0.1' || $ip === 'localhost' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return ['country' => 'Local', 'code' => 'LO'];
        }

        // Try ip-api.com with timeout
        $country = $this->getCountryFromIPAPI($ip);
        if ($country) {
            return $country;
        }

        // Try ipapi.co as fallback
        $country = $this->getCountryFromIPAPICo($ip);
        if ($country) {
            return $country;
        }

        // Try geoip.json as final fallback (local or CDN)
        $country = $this->getCountryFromGeoIP($ip);
        if ($country) {
            return $country;
        }

        // Default to Unknown
        return ['country' => 'Unknown', 'code' => 'XX'];
    }

    /**
     * Get country using ip-api.com
     */
    private function getCountryFromIPAPI($ip)
    {
        try {
            // Use curl if available, otherwise file_get_contents
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
                
                $response = curl_exec($ch);
                curl_close($ch);
            } else {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 3,
                        'method' => 'GET'
                    ]
                ]);
                $response = @file_get_contents("http://ip-api.com/json/{$ip}", false, $context);
            }
            
            if ($response) {
                $data = json_decode($response, true);
                if ($data && isset($data['country'])) {
                    return [
                        'country' => $data['country'],
                        'code' => $data['countryCode'] ?? 'XX'
                    ];
                }
            }
        } catch (\Exception $e) {
            // Continue to fallback
        }

        return null;
    }

    /**
     * Get country using ipapi.co as fallback
     */
    private function getCountryFromIPAPICo($ip)
    {
        try {
            // Use curl if available, otherwise file_get_contents
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://ipapi.co/{$ip}/json/");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                
                $response = curl_exec($ch);
                curl_close($ch);
            } else {
                $context = stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                    'http' => [
                        'timeout' => 3,
                        'method' => 'GET'
                    ]
                ]);
                $response = @file_get_contents("https://ipapi.co/{$ip}/json/", false, $context);
            }
            
            if ($response) {
                $data = json_decode($response, true);
                if ($data && isset($data['country_name'])) {
                    return [
                        'country' => $data['country_name'],
                        'code' => $data['country_code'] ?? 'XX'
                    ];
                }
            }
        } catch (\Exception $e) {
            // Continue to next fallback
        }

        return null;
    }

    /**
     * Get country using GeoIP database as final fallback
     * 
     * TODO: For production, implement MaxMind GeoIP2 library:
     * composer require geoip2/geoip2
     */
    private function getCountryFromGeoIP($ip)
    {
        // This is a placeholder for proper GeoIP implementation
        // Currently, we rely on the API-based methods above
        // In production, use MaxMind GeoIP2 or similar for reliability
        
        return null;
    }
}
