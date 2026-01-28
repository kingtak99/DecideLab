#!/usr/bin/env php
<?php

// Troubleshooting script for server
// Run this on the production server after deployment

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Visitor;
use Illuminate\Support\Carbon;

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         DecideLab Production Troubleshooting                       ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

// Check 1: Database connection
echo "1️⃣  Database Connection\n";
echo "─────────────────────────────────────\n";
try {
    $count = Visitor::count();
    echo "✅ Connected to database\n";
    echo "   Visitor records: {$count}\n";
} catch (\Exception $e) {
    echo "❌ Database connection failed\n";
    echo "   Error: " . $e->getMessage() . "\n";
    exit(1);
}

// Check 2: Recent visitors
echo "\n2️⃣  Recent Visitors\n";
echo "─────────────────────────────────────\n";
$recent = Visitor::latest()->limit(5)->get();

if ($recent->isEmpty()) {
    echo "⚠️  No visitors recorded yet\n";
} else {
    echo "Latest 5 visitors:\n";
    foreach ($recent as $i => $v) {
        $time = is_string($v->visited_at) ? $v->visited_at : $v->visited_at->format('Y-m-d H:i:s');
        echo ($i+1) . ". IP: {$v->ip_address} | Country: {$v->country} | Time: {$time}\n";
    }
}

// Check 3: Country data
echo "\n3️⃣  Country Data Population\n";
echo "─────────────────────────────────────\n";
$total = Visitor::count();
$with_country = Visitor::where('country', '!=', 'Unknown')
    ->where('country', '!=', null)
    ->count();

if ($total === 0) {
    echo "⚠️  No visitors to check\n";
} else {
    $rate = round(($with_country / $total) * 100, 2);
    echo "✅ Country data: {$with_country}/{$total} ({$rate}%)\n";
    
    if ($rate < 80) {
        echo "⚠️  Low country population rate! Check:\n";
        echo "   - IP geolocation API connectivity\n";
        echo "   - Server firewall/network settings\n";
    }
}

// Check 4: Today's stats
echo "\n4️⃣  Today's Statistics\n";
echo "─────────────────────────────────────\n";
$today = Visitor::whereDate('visited_at', \Carbon\Carbon::today())->count();
$today_unique = Visitor::whereDate('visited_at', \Carbon\Carbon::today())
    ->distinct('ip_address')
    ->count('ip_address');

echo "Total visits today: {$today}\n";
echo "Unique visitors today: {$today_unique}\n";

// Check 5: 24-hour deduplication
echo "\n5️⃣  24-Hour Deduplication Check\n";
echo "─────────────────────────────────────\n";
$last_24h = Visitor::where('visited_at', '>=', now()->subHours(24))->count();
$unique_24h = Visitor::where('visited_at', '>=', now()->subHours(24))
    ->distinct('ip_address')
    ->count('ip_address');

$duplicates = $last_24h - $unique_24h;
echo "Last 24 hours - Total: {$last_24h}, Unique IPs: {$unique_24h}\n";

if ($duplicates > 0) {
    echo "✅ Deduplication working! ({$duplicates} updates)\n";
} else {
    echo "⚠️  No duplicate visitors detected (might be normal if few visitors)\n";
}

// Check 6: Log file
echo "\n6️⃣  Log File Check\n";
echo "─────────────────────────────────────\n";
$log_file = __DIR__ . '/storage/logs/laravel.log';
if (file_exists($log_file)) {
    $size = filesize($log_file);
    $lines = count(file($log_file));
    echo "✅ Log file exists\n";
    echo "   Size: " . round($size / 1024, 2) . " KB\n";
    echo "   Lines: {$lines}\n";
    
    echo "\nRecent log entries (last 10):\n";
    $logLines = array_slice(file($log_file), -10);
    foreach ($logLines as $line) {
        if (strpos($line, 'Visitor tracked') !== false) {
            echo "   → " . trim($line) . "\n";
        }
    }
} else {
    echo "⚠️  Log file not found\n";
}

// Check 7: Summary
echo "\n7️⃣  Summary\n";
echo "─────────────────────────────────────\n";

if ($count > 0 && $rate >= 80 && $duplicates > 0) {
    echo "✅ Everything is working correctly!\n";
} else {
    echo "⚠️  Some issues detected. Check above for details.\n";
}

echo "\n📊 To view stats, visit:\n";
echo "   http://18.159.222.36/debug/stats\n";
echo "   http://18.159.222.36/debug/visitors\n\n";
