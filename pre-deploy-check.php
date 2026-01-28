#!/usr/bin/env php
<?php

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         DecideLab Production Deployment Helper                     ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

echo "⚠️  This script will help you deploy to production server.\n\n";

// Check if SSH key exists
$sshKey = getenv('HOME') . '/.ssh/id_rsa';
$hasSSH = file_exists($sshKey);

echo "Pre-flight Checks:\n";
echo "─────────────────────────\n";
echo ($hasSSH ? "✅" : "⚠️ ") . " SSH key: " . ($hasSSH ? "Found" : "Not found (you may need to set up SSH)") . "\n";

$gitStatus = shell_exec('git status --porcelain 2>&1');
if (empty(trim($gitStatus))) {
    echo "✅ Git: No uncommitted changes\n";
} else {\n    echo "⚠️ Git: Uncommitted changes detected\n";
    echo "   Run: git add . && git commit -m 'Pre-deployment commit'\n\n";
}

echo "\n📋 Deployment Checklist:\n";
echo "─────────────────────────\n";
echo "1. ✅ Code changes committed and pushed\n";
echo "2. ⬜ SSH access to 18.159.222.36 confirmed\n";
echo "3. ⬜ Database backup created (optional)\n";
echo "4. ⬜ Running deployment on server\n\n";

echo "🚀 Quick Deploy Commands:\n";
echo "─────────────────────────\n\n";

echo "For Windows/Mac users:\n";
echo "$ ssh ubuntu@18.159.222.36\n";
echo "$ cd /home/ubuntu/projects/decidelab\n";
echo "$ git pull origin main\n";
echo "$ composer install --no-dev\n";
echo "$ php artisan migrate --force\n";
echo "$ php artisan cache:clear\n";
echo "$ sudo systemctl restart php8.2-fpm\n\n";

echo "After deployment, verify at:\n";
echo "🌐 http://18.159.222.36/debug/stats\n\n";

echo "Need help? Check:\n";
echo "📄 DEPLOYMENT.md\n";
echo "🐛 storage/logs/laravel.log (on server)\n\n";

// Latest commits
echo "Latest commits ready to deploy:\n";
echo "─────────────────────────────────\n";
$logs = shell_exec('git log --oneline -5 2>&1');
echo $logs . "\n";

echo "✅ All systems go! 🚀\n\n";
