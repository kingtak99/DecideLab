#!/usr/bin/env php
<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Run the application
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

// Create kernel
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Delete old visitors
echo "Deleting old visitor data...\n";
Visitor::truncate();
echo "✅ Database cleared\n";

// Now we'll test with a real API
echo "\n=== Testing IP Geolocation ===\n";

// Simulate a real IP
$testIPs = [
    '8.8.8.8' => 'Google DNS (USA)',
    '1.1.1.1' => 'Cloudflare (USA)',
];

// Create a temporary visitor to test
echo "Creating test visitor with real IP...\n";
$visitor = Visitor::create([
    'ip_address' => '8.8.8.8',
    'user_agent' => 'Test User Agent',
    'url' => '/test',
    'country' => 'United States',
    'country_code' => 'US',
    'session_id' => 'test-session',
    'page_title' => 'Test',
    'visited_at' => now(),
]);

echo "✅ Test visitor created\n";

// Verify
$saved = Visitor::where('ip_address', '8.8.8.8')->first();
if ($saved) {
    echo "✅ Visitor saved successfully\n";
    echo "   IP: {$saved->ip_address}\n";
    echo "   Country: {$saved->country}\n";
    echo "   Code: {$saved->country_code}\n";
} else {
    echo "❌ Failed to save visitor\n";
}
