#!/usr/bin/env php
<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

// Create kernel
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Testing 24-Hour Deduplication ===\n\n";

// Clear database
Visitor::truncate();
echo "✅ Database cleared\n\n";

// Create a visitor
echo "1️⃣ Creating first visitor from 8.8.8.8...\n";
Visitor::create([
    'ip_address' => '8.8.8.8',
    'user_agent' => 'Chrome/120.0',
    'url' => '/home',
    'country' => 'United States',
    'country_code' => 'US',
    'session_id' => 'sess-1',
    'page_title' => 'Home',
    'visited_at' => now()->subHours(1), // 1 hour ago
]);

$count = Visitor::count();
echo "   Records: {$count}\n\n";

// Simulate same visitor visiting again (within 24 hours)
echo "2️⃣ Same IP visits again (within 24h)...\n";
$existing = Visitor::where('ip_address', '8.8.8.8')
    ->where('visited_at', '>=', now()->subHours(24))
    ->latest('visited_at')
    ->first();

if ($existing) {
    $existing->update(['visited_at' => now()]);
    echo "   ✅ Updated existing visitor\n";
} else {
    Visitor::create([
        'ip_address' => '8.8.8.8',
        'user_agent' => 'Chrome/120.0',
        'url' => '/about',
        'country' => 'United States',
        'country_code' => 'US',
        'session_id' => 'sess-1',
        'page_title' => 'About',
        'visited_at' => now(),
    ]);
    echo "   ❌ Created new visitor\n";
}

$count = Visitor::count();
echo "   Records: {$count}\n\n";

// Simulate 25+ hours later
echo "3️⃣ Same IP visits after 25 hours...\n";
$existing = Visitor::where('ip_address', '8.8.8.8')
    ->where('visited_at', '>=', now()->subHours(24))
    ->latest('visited_at')
    ->first();

if ($existing) {
    echo "   Found within 24h: {$existing->visited_at}\n";
    echo "   ✅ Updated existing visitor\n";
    $existing->update(['visited_at' => now()->addHours(25)]);
} else {
    echo "   Not found within 24h\n";
    Visitor::create([
        'ip_address' => '8.8.8.8',
        'user_agent' => 'Chrome/120.0',
        'url' => '/contact',
        'country' => 'United States',
        'country_code' => 'US',
        'session_id' => 'sess-2',
        'page_title' => 'Contact',
        'visited_at' => now()->addHours(25),
    ]);
    echo "   ✅ Created new visitor (24h+ passed)\n";
}

$count = Visitor::count();
echo "   Records: {$count}\n\n";

// Summary
echo "=== Final Summary ===\n";
$visitors = Visitor::orderBy('visited_at')->get();
foreach ($visitors as $i => $v) {
    echo ($i+1) . ". IP: {$v->ip_address} | Time: {$v->visited_at->format('Y-m-d H:i:s')}\n";
}

echo "\nTotal records: " . Visitor::count() . "\n";
echo "Expected: 2 (one new after 24h)\n";
