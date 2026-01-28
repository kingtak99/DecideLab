#!/usr/bin/env php
<?php

// Quick log viewer for debugging
$logFile = __DIR__ . '/storage/logs/laravel.log';

if (!file_exists($logFile)) {
    echo "❌ Log file not found: {$logFile}\n";
    exit(1);
}

echo "📋 Latest log entries (last 50):\n";
echo "════════════════════════════════════════════════\n\n";

$lines = array_reverse(file($logFile));
$count = 0;

foreach ($lines as $line) {
    if (++$count > 50) break;
    
    // Parse log lines
    if (preg_match('/\[(.*?)\] (.*?)\.(.*?): (.*?)(\{.*)?$/i', trim($line), $matches)) {
        $timestamp = $matches[1];
        $level = $matches[3];
        $message = $matches[4];
        $context = $matches[5] ?? '';
        
        // Color codes
        $color = match($level) {
            'ERROR' => "\033[91m",      // Red
            'WARNING' => "\033[93m",    // Yellow
            'INFO' => "\033[92m",       // Green
            'DEBUG' => "\033[94m",      // Blue
            default => "\033[37m"       // White
        };
        $reset = "\033[0m";
        
        echo "{$color}[{$level}]{$reset} {$timestamp}\n";
        echo "   {$message}\n";
        
        if (!empty($context)) {
            echo "   Data: " . substr($context, 0, 200) . (strlen($context) > 200 ? "..." : "") . "\n";
        }
        
        echo "\n";
    }
}

echo "════════════════════════════════════════════════\n";
echo "📊 Log file size: " . round(filesize($logFile) / 1024, 2) . " KB\n";
