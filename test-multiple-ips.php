#!/usr/bin/env php
<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Visitor;

// Create kernel
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Simulate visitors from different IPs
echo "=== Simulating Multiple Visitors from Different IPs ===\n\n";

$testIPs = [
    '8.8.8.8' => 'Google DNS (USA)',
    '1.1.1.1' => 'Cloudflare (USA)',
    '208.67.222.222' => 'OpenDNS (USA)',
];

foreach ($testIPs as $ip => $label) {
    echo "Adding visitor from {$label}: {$ip}\n";
    Visitor::create([
        'ip_address' => $ip,
        'user_agent' => 'Test User Agent',
        'url' => '/test',
        'country' => 'United States',
        'country_code' => 'US',
        'session_id' => 'test-session',
        'page_title' => 'Test',
        'visited_at' => now(),
    ]);
}

echo "\n=== Summary ===\n";
$total = Visitor::count();
$unique = Visitor::distinct('ip_address')->count('ip_address');
$withCountry = Visitor::where('country', '!=', 'Unknown')
    ->where('country', '!=', null)
    ->count();

echo "Total records: {$total}\n";
echo "Unique IPs: {$unique}\n";
echo "With country: {$withCountry}\n";
echo "\n=== All Visitors ===\n";

$visitors = Visitor::latest()->get();
foreach ($visitors as $i => $v) {
    echo ($i+1) . ". IP: {$v->ip_address} | Country: {$v->country} | Time: {$v->visited_at}\n";
}
