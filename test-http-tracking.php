#!/usr/bin/env php
<?php

// Test the API endpoint we created
echo "=== Testing Visitor Tracking via HTTP ===\n";

// Simulate multiple requests by visiting the debug endpoint
$url = 'http://localhost/projects/decidelab/public/debug/visitors';

echo "Making request to: {$url}\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "✅ Request successful (HTTP $httpCode)\n\n";
    $data = json_decode($response, true);
    
    if (is_array($data)) {
        echo "Latest 10 visitors:\n";
        foreach ($data as $idx => $visitor) {
            echo ($idx + 1) . ". IP: {$visitor['ip']}\n";
            echo "   Country: {$visitor['country']}\n";
            echo "   Code: {$visitor['code']}\n";
            echo "   Time: {$visitor['visited_at']}\n";
            echo "\n";
        }
    } else {
        echo "Response:\n";
        echo $response . "\n";
    }
} else {
    echo "❌ Request failed (HTTP $httpCode)\n";
    echo "Response:\n";
    echo $response . "\n";
}
