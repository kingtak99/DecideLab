#!/usr/bin/env php
<?php

echo "=== Testing Stats Endpoint ===\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/projects/decidelab/public/debug/stats');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $data = json_decode($response, true);
    echo "Total visitors: " . $data['total_records'] . "\n";
    echo "Unique IPs: " . $data['unique_ips'] . "\n";
    echo "With country: " . $data['with_country'] . "\n";
    echo "Success rate: " . $data['success_rate'] . "\n\n";
    echo "Today's data:\n";
    echo "  Total visits: " . $data['today_total'] . "\n";
    echo "  Unique visitors: " . $data['today_unique_ips'] . "\n";
} else {
    echo "Error: HTTP $httpCode\n";
    echo $response . "\n";
}
