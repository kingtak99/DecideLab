#!/usr/bin/env php
<?php
/**
 * Housing Loan Custom Rate Debug Script
 * Run from command line to verify the custom rate feature is working
 */

echo "\n========================================\n";
echo "  Housing Loan Custom Rate Debug Tool\n";
echo "========================================\n\n";

// Get the last 50 lines of the Laravel log
$logPath = __DIR__ . '/storage/logs/laravel.log';

if (!file_exists($logPath)) {
    echo "❌ Error: Could not find Laravel log file\n";
    echo "   Expected location: {$logPath}\n";
    exit(1);
}

echo "📄 Checking Laravel logs for custom rate calculations...\n\n";

$lines = array_reverse(file($logPath));
$relevantLines = [];
$foundCustomRate = false;

foreach ($lines as $line) {
    if (strpos($line, 'Housing Loan Calculation') !== false) {
        $foundCustomRate = true;
    }
    
    if ($foundCustomRate && (strpos($line, 'Housing Loan') !== false || strpos($line, 'custom_rate') !== false)) {
        $relevantLines[] = trim($line);
    }
    
    if (count($relevantLines) >= 10) {
        break;
    }
}

if (empty($relevantLines)) {
    echo "⚠️  No 'Housing Loan Calculation' entries found in logs.\n";
    echo "   This could mean:\n";
    echo "   1. The feature hasn't been tested yet\n";
    echo "   2. Logging is disabled\n\n";
    echo "   Test the feature manually:\n";
    echo "   1. Go to Housing Simulation\n";
    echo "   2. Check 'Use Custom Interest Rate'\n";
    echo "   3. Enter a value (e.g., 7)\n";
    echo "   4. Click Calculate\n";
    echo "   5. Run this script again\n\n";
} else {
    echo "✅ Found Housing Loan Calculation logs:\n\n";
    foreach ($relevantLines as $line) {
        // Pretty print the log line
        if (preg_match('/"(custom_rate|final_interest_rate|has_custom_rate)":\s*([^,}]+)/', $line, $matches)) {
            echo "   • {$matches[1]}: {$matches[2]}\n";
        } else {
            echo "   {$line}\n";
        }
    }
    echo "\n";
}

// Check the database for loan profiles
echo "📊 Checking Country Loan Profiles...\n\n";

$dbPath = __DIR__ . '/.env';
if (file_exists($dbPath)) {
    echo "✅ Found .env file\n";
    echo "   Database should be configured\n";
    echo "\n";
    
    echo "💡 Quick Test:\n";
    echo "   1. Open a browser and go to: /en/loans/housing\n";
    echo "   2. Open DevTools Console (F12)\n";
    echo "   3. Select a country\n";
    echo "   4. Check the 'Use Custom Interest Rate' checkbox\n";
    echo "   5. Enter a rate (e.g., 7)\n";
    echo "   6. Click Calculate\n";
    echo "   7. Look in console for these logs:\n";
    echo "      - 'Before submission' (with useCustomRate and customRateValue)\n";
    echo "      - 'Form data being sent' (should include custom_rate)\n";
    echo "      - 'Displaying results' (should show your custom rate)\n\n";
    
    echo "📸 If it's not working, screenshot:\n";
    echo "   - Console output\n";
    echo "   - Network tab showing POST request\n";
    echo "   - The displayed interest rate\n";
    echo "\n";
} else {
    echo "❌ Could not find .env file\n";
}

echo "========================================\n";
echo "  End of Debug Output\n";
echo "========================================\n\n";
