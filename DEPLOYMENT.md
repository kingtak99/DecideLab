# 🚀 Production Deployment Guide

## Prerequisites
- SSH access to server `18.159.222.36`
- User: ubuntu (or your SSH user)
- Server has Git, PHP, MySQL, Composer installed

## Deployment Steps

### Option 1: Automatic Deployment (Recommended)

1. **Copy the deployment script to your server:**
```bash
scp deploy.sh ubuntu@18.159.222.36:/home/ubuntu/
```

2. **SSH into the server:**
```bash
ssh ubuntu@18.159.222.36
```

3. **Run the deployment script:**
```bash
bash ~/deploy.sh
```

### Option 2: Manual Deployment

1. **SSH into the server:**
```bash
ssh ubuntu@18.159.222.36
```

2. **Navigate to project directory:**
```bash
cd /home/ubuntu/projects/decidelab
```

3. **Pull latest code:**
```bash
git pull origin main
```

4. **Install dependencies:**
```bash
composer install --no-dev --optimize-autoloader
```

5. **Run migrations:**
```bash
php artisan migrate --force
```

6. **Clear cache:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

7. **Restart PHP-FPM:**
```bash
sudo systemctl restart php8.2-fpm
```

## Verification

After deployment, verify the fix:

1. **Check visitor stats endpoint:**
```
http://18.159.222.36/debug/stats
```

2. **Test from mobile phone:**
   - Open http://18.159.222.36 on your phone
   - Refresh multiple times
   - Check /debug/stats - should show 1 visitor (not multiple)

3. **Check server logs for errors:**
```bash
tail -f /home/ubuntu/projects/decidelab/storage/logs/laravel.log
```

## What Changed

### Main Fix: IP Detection
- Added `getRealIP()` method to handle proxies and CloudFront
- Now correctly detects client IP even behind CDN/load balancer
- Checks multiple headers: `HTTP_CF_CONNECTING_IP`, `HTTP_X_FORWARDED_FOR`, `HTTP_X_REAL_IP`

### 24-Hour Deduplication
- Same IP within 24 hours = updates existing record (not new)
- After 24 hours = creates new visitor record
- Prevents duplicate counting from page refreshes

### Country Detection
- 3-level fallback: ip-api.com → ipapi.co → local database
- Even works offline with local IP range mapping

### Enhanced Logging
- All visitor tracking is now logged to `storage/logs/laravel.log`
- Useful for debugging issues

## Troubleshooting

### Visitors still not showing up?

1. **Check logs:**
```bash
tail -f storage/logs/laravel.log
```

2. **Verify database connection:**
```bash
mysql -u root -p decidelab -e "SELECT COUNT(*) FROM visitors;"
```

3. **Check middleware is registered:**
```bash
grep -r "TrackVisitors" app/Http/Kernel.php
```

4. **Verify IP is being captured:**
```bash
php artisan tinker
> Visitor::latest()->first();
```

### Wrong IP showing?

1. **Check what IP the server is seeing:**
```bash
php artisan tinker
> Visitor::select(['ip_address', 'country', 'visited_at'])->latest()->limit(10)->get();
```

2. **If IP looks like proxy address (127.0.0.1, 10.x.x.x):**
   - Configure Nginx/Apache to pass real IP headers
   - Check `HTTP_CF_CONNECTING_IP`, `HTTP_X_FORWARDED_FOR` headers

### No country data?

1. **Check if APIs are reachable:**
```bash
curl -I http://ip-api.com/json/8.8.8.8
curl -I https://ipapi.co/8.8.8.8/json/
```

2. **If APIs fail, check fallback IP ranges in middleware**

## Success Indicators

✅ After deployment, you should see:
- Visitors recorded in `/debug/stats`
- Same phone visitor = same count after refresh
- Different IPs = different visitors
- Country data populated for each visitor
- Logs showing visitor tracking entries

## Rollback (if needed)

```bash
cd /home/ubuntu/projects/decidelab
git revert HEAD
git push origin main
php artisan migrate:rollback
php artisan cache:clear
sudo systemctl restart php8.2-fpm
```
