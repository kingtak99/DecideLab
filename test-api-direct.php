#!/usr/bin/env php
<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Visitor;

// Create kernel
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test the IP geolocation methods directly
echo "=== Testing IP Geolocation APIs ===\n\n";

// Create a test class to access the methods
$middleware = new class {
    
    private function getCountryFromIPAPI($ip)
    {
        try {
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
                
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
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

    private function getCountryFromIPAPICo($ip)
    {
        try {
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

    public function test($ip)
    {
        echo "Testing IP: {$ip}\n";
        echo "─────────────────────────────────────\n";
        
        echo "\n1. Trying ip-api.com...\n";
        $result = $this->getCountryFromIPAPI($ip);
        if ($result) {
            echo "   ✅ Success: {$result['country']} ({$result['code']})\n";
        } else {
            echo "   ❌ Failed\n";
        }
        
        echo "\n2. Trying ipapi.co...\n";
        $result = $this->getCountryFromIPAPICo($ip);
        if ($result) {
            echo "   ✅ Success: {$result['country']} ({$result['code']})\n";
        } else {
            echo "   ❌ Failed\n";
        }
        
        echo "\n";
    }
};

$middleware->test('8.8.8.8');
$middleware->test('1.1.1.1');
$middleware->test('208.67.222.222');

echo "=== Database Status ===\n";
$total = Visitor::count();
$withCountry = Visitor::where('country', '!=', 'Unknown')
    ->where('country', '!=', null)
    ->count();

echo "Total visitors: {$total}\n";
echo "With country: {$withCountry}\n";
if ($total > 0) {
    echo "Success rate: " . round(($withCountry / $total) * 100, 2) . "%\n";
}
