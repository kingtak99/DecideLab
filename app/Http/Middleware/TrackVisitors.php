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
        // Get the real IP (handle proxies and proxied requests)
        $ip = $this->getRealIP($request);
        
        // Debug logging - log all IPs for troubleshooting
        \Log::debug('TrackVisitors middleware', [
            'detected_ip' => $ip,
            'remote_addr' => $request->server('REMOTE_ADDR'),
            'x_forwarded_for' => $request->server('HTTP_X_FORWARDED_FOR'),
            'cf_connecting_ip' => $request->server('HTTP_CF_CONNECTING_IP'),
            'user_agent' => substr($request->userAgent() ?? '', 0, 100),
            'path' => $request->path(),
        ]);
        
        // In development, use a test IP for localhost to test geolocation
        if (config('app.debug') && ($ip === '127.0.0.1' || $ip === 'localhost' || str_starts_with($ip, '::1'))) {
            // Use a test IP that resolves to a real country
            $ip = '8.8.8.8'; // Google Public DNS - USA
        }
        
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
            // Create a device fingerprint based on IP + User-Agent combo
            // This allows different devices on same network to be tracked separately
            $userAgentHash = hash('sha256', $userAgent ?? '');
            $deviceFingerprint = "{$ip}_{$userAgentHash}";
            
            // Check if this DEVICE (IP + User-Agent combo) already visited in the last 24 hours
            $existingVisitor = Visitor::where('ip_address', $ip)
                ->where('user_agent', $userAgent)
                ->where('visited_at', '>=', now()->subHours(24))
                ->latest('visited_at')
                ->first();
            
            if ($existingVisitor) {
                // Same device within 24 hours - just update the last visit time

                \Log::debug('Updating existing visitor', [
                    'ip' => $ip,
                    'last_visited' => $existingVisitor->visited_at,
                ]);
                
                \Log::debug('Device fingerprint check', [
                    'device_fp' => $deviceFingerprint,
                    'ip' => $ip,
                    'user_agent' => substr($userAgent ?? '', 0, 80),
                ]);
                
                $existingVisitor->update([
                    'visited_at' => now(),
                    'url' => $request->path() ?? '/',
                    'page_title' => $request->header('referer') ? 'Referred' : 'Direct',
                    'referrer' => $request->header('referer'),
                ]);
                
                if (config('app.debug')) {
                    \Log::info('Visitor updated (same visitor within 24h)', [
                        'ip' => $ip,
                        'last_visited' => $existingVisitor->visited_at,
                    ]);
                }
                
                return $next($request);
            }
            
            // New visitor or 24+ hours have passed - create new record
            $country = $this->getCountryFromIP($ip);
            
            \Log::debug('Country detection result', [
                'ip' => $ip,
                'country' => $country['country'] ?? 'Unknown',
                'code' => $country['code'] ?? 'XX',
            ]);
            
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

            \Log::debug('About to create visitor record', [
                'data' => $visitorData,
            ]);
            
            $created = Visitor::create($visitorData);
            
            \Log::debug('Visitor record created successfully', [
                'id' => $created->id,
                'ip' => $created->ip_address,
            ]);
            
            // Always log for production debugging
            \Log::info('New visitor tracked', [
                'ip' => $ip,
                'country' => $country['country'] ?? 'Unknown',
                'user_agent' => substr($userAgent ?? '', 0, 50),
                'url' => $request->path(),
            ]);
        } catch (\Exception $e) {
            // Always log errors for production debugging
            \Log::error('Visitor tracking failed: ' . $e->getMessage(), [
                'ip' => $ip,
                'error' => $e->getMessage(),
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
        // Skip private IPs in production
        // In development, try to get country data anyway
        if (!config('app.debug')) {
            if ($ip === '127.0.0.1' || $ip === 'localhost' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
                return ['country' => 'Local', 'code' => 'LO'];
            }
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
     * This uses a basic IP range mapping as a fallback
     * For production, implement MaxMind GeoIP2 library:
     * composer require geoip2/geoip2
     */
    private function getCountryFromGeoIP($ip)
    {
        // Common known IP ranges for major data centers
        // This is a simple fallback for development/testing
        $ranges = [
            ['8.8.8.8', '8.8.8.255', 'United States', 'US'],           // Google DNS
            ['1.1.1.1', '1.1.1.255', 'United States', 'US'],           // Cloudflare DNS
            ['208.67.222.0', '208.67.222.255', 'United States', 'US'], // OpenDNS
            ['9.9.9.9', '9.9.9.255', 'United States', 'US'],           // Quad9
        ];
        
        $ipNum = ip2long($ip);
        if ($ipNum === false) {
            return null;
        }
        
        foreach ($ranges as [$startIp, $endIp, $country, $code]) {
            $startNum = ip2long($startIp);
            $endNum = ip2long($endIp);
            
            if ($ipNum >= $startNum && $ipNum <= $endNum) {
                return ['country' => $country, 'code' => $code];
            }
        }
        
        return null;
    }

    /**
     * Get the real IP address of the client
     * Handles proxies and CloudFront / AWS ALB
     */
    private function getRealIP($request)
    {
        // Check for IP from CloudFront or AWS ALB
        if ($request->server('HTTP_CF_CONNECTING_IP')) {
            return $request->server('HTTP_CF_CONNECTING_IP');
        }
        
        // Check for IP from X-Forwarded-For header (proxies)
        if ($request->server('HTTP_X_FORWARDED_FOR')) {
            // X-Forwarded-For can contain multiple IPs, get the first one
            $ips = explode(',', $request->server('HTTP_X_FORWARDED_FOR'));
            return trim($ips[0]);
        }
        
        // Check for X-Real-IP header
        if ($request->server('HTTP_X_REAL_IP')) {
            return $request->server('HTTP_X_REAL_IP');
        }
        
        // Fallback to Laravel's built-in IP method
        return $request->ip();
    }
}
