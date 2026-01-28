#!/usr/bin/env php
<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Run the application
use Illuminate\Support\Facades\Artisan;
use App\Models\Visitor;

// Create kernel
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get the latest visitors
echo "=== Latest 10 Visitors ===\n";
$visitors = Visitor::latest()->limit(10)->get();

if ($visitors->isEmpty()) {
    echo "❌ No visitors found in database\n";
} else {
    echo "✅ Found " . count($visitors) . " visitors\n\n";
    
    foreach ($visitors as $v) {
        echo "IP: {$v->ip_address}\n";
        echo "  Country: " . ($v->country ?? 'NULL') . "\n";
        echo "  Code: " . ($v->country_code ?? 'NULL') . "\n";
        echo "  User Agent: " . substr($v->user_agent, 0, 50) . "...\n";
        echo "  Time: {$v->visited_at}\n";
        echo "\n";
    }
}

// Summary
echo "\n=== Summary ===\n";
$total = Visitor::count();
$withCountry = Visitor::whereNotNull('country')
    ->where('country', '!=', 'Unknown')
    ->count();
$withoutCountry = Visitor::where(function ($q) {
    $q->whereNull('country')
        ->orWhere('country', 'Unknown');
})->count();

echo "Total visitors: {$total}\n";
echo "With country: {$withCountry}\n";
echo "Without country: {$withoutCountry}\n";
echo "Success rate: " . ($total > 0 ? round(($withCountry / $total) * 100, 2) : 0) . "%\n";
