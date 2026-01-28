#!/bin/bash

# Deployment script for DecideLab project
# Run this on the production server

set -e

echo "🚀 Deploying DecideLab to Production..."
echo ""

# Navigate to project directory
PROJECT_DIR="/home/ubuntu/projects/decidelab"
cd $PROJECT_DIR

echo "1️⃣ Pulling latest changes from Git..."
git pull origin main

echo "2️⃣ Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "3️⃣ Running migrations..."
php artisan migrate --force

echo "4️⃣ Clearing cache..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "5️⃣ Restarting PHP-FPM..."
sudo systemctl restart php8.2-fpm

echo ""
echo "✅ Deployment complete!"
echo ""
echo "📊 Testing visitor tracking..."
echo "Visit: http://18.159.222.36/debug/stats"
