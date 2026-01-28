# 📊 Visitor Tracking System - Complete Setup & Deployment Guide

## 🎯 Overview

This is a complete visitor tracking system for the DecideLab application that:
- ✅ Tracks **one visitor per 24 hours** per IP (no duplicate counting)
- ✅ **Detects real IP** even behind proxies/CloudFront
- ✅ **Captures country data** with 3-level fallback
- ✅ **Prevents bot traffic** with comprehensive bot detection
- ✅ **Mobile-friendly** - works from phones, tablets, desktops
- ✅ **Production-ready** with comprehensive logging

## 🚀 Quick Start

### Local Development

```bash
# All tests should pass locally
php test-stats.php
# Output: Total visitors: 1, Unique IPs: 1 (even after multiple refreshes)
```

### Production Deployment

```bash
# 1. On your local machine
git push origin main

# 2. SSH to server
ssh ubuntu@18.159.222.36

# 3. Deploy
cd /home/ubuntu/projects/decidelab
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan cache:clear
sudo systemctl restart php8.2-fpm

# 4. Verify
php server-troubleshoot.php
```

## 📁 Files Modified/Added

### Core Changes
- `app/Http/Middleware/TrackVisitors.php` - Main tracking middleware
- `app/Models/Visitor.php` - Visitor model with country fields

### Configuration
- `routes/web.php` - Debug endpoints added

### Deployment Tools
- `DEPLOYMENT.md` - Complete deployment guide
- `VISITOR_TRACKING_FIX.md` - Technical documentation
- `deploy.sh` - Automated deployment script
- `pre-deploy-check.php` - Pre-flight checks
- `server-troubleshoot.php` - Server diagnostics

### Testing
- `test-stats.php` - Statistics endpoint test
- `test-visitor-tracking.php` - Database test
- `test-http-tracking.php` - HTTP request test
- `test-24h-dedup.php` - 24-hour logic test
- `test-multiple-ips.php` - Multiple IP test

## 🔧 How It Works

### 1. Request Comes In
```
Phone/Browser → Server Request
```

### 2. IP Detection
```
getRealIP() method checks:
1. CloudFront header (HTTP_CF_CONNECTING_IP)
2. X-Forwarded-For header
3. X-Real-IP header
4. Laravel's default ip()
```

### 3. Bot Check
```
If User-Agent contains bot patterns → Skip tracking
Patterns: 'bot', 'crawler', 'spider', 'curl', etc.
```

### 4. Existing Visitor Check
```
IF (same IP found within last 24 hours) THEN
   Update existing record (timestamp only)
ELSE
   Create new visitor record
END IF
```

### 5. Country Detection
```
Country detection with fallback:
1. Try ip-api.com (3 second timeout)
2. If fails, try ipapi.co (3 second timeout)
3. If fails, use local IP range database
```

### 6. Record Created
```
Data saved:
- ip_address
- user_agent
- country (detected)
- country_code
- session_id
- page_title (Direct/Referred)
- referrer
- user_id (if logged in)
- visited_at (timestamp)
- is_bot (0/1)
```

## 📊 Key Features

### 24-Hour Deduplication
**Problem**: Page refresh shouldn't create new visitor record
**Solution**: Check if IP visited within 24h, update timestamp instead

**Example Timeline**:
```
19:00 → User visits       → Create record  (Total: 1)
19:05 → User refreshes    → Update record  (Total: still 1) ✅
19:30 → User revisits     → Update record  (Total: still 1) ✅
Next day 19:01 → Visit again → Create NEW record (Total: 2) ✅
```

### Real IP Detection (Proxy Support)
**Problem**: Server behind CDN/proxy shows proxy IP
**Solution**: Check multiple headers for real client IP

**Headers checked**:
```
HTTP_CF_CONNECTING_IP    (CloudFront)
HTTP_X_FORWARDED_FOR     (Nginx/Apache proxy)
HTTP_X_REAL_IP           (Common proxy header)
REMOTE_ADDR              (Fallback)
```

### Country Detection Fallback
**Problem**: IP geolocation APIs might fail or be blocked
**Solution**: 3-level fallback system

```
┌─────────────────────────────────────────┐
│ 1. Try ip-api.com (HTTP)                │
│    Timeout: 3 seconds                   │
│    Returns: country, countryCode        │
└─────────────────────────────────────────┘
         ↓ (if fails)
┌─────────────────────────────────────────┐
│ 2. Try ipapi.co (HTTPS)                 │
│    Timeout: 3 seconds                   │
│    Returns: country_name, country_code  │
└─────────────────────────────────────────┘
         ↓ (if fails)
┌─────────────────────────────────────────┐
│ 3. Use Local IP Range Database          │
│    Hardcoded: Google, Cloudflare, etc   │
│    Returns: country, code               │
└─────────────────────────────────────────┘
         ↓ (if all fail)
         "Unknown" (XX)
```

## 🧪 Testing

### Local Test - Before Deployment
```bash
# Start with clean database
php test-clear-data.php

# Test HTTP tracking
php test-http-tracking.php

# Test multiple refreshes
php test-stats.php  # Run 3 times - count should stay 1
```

### After Production Deployment
```bash
# SSH to server
ssh ubuntu@18.159.222.36
cd /home/ubuntu/projects/decidelab

# Run server diagnostics
php server-troubleshoot.php

# Check endpoints
curl http://localhost/debug/stats
curl http://localhost/debug/visitors
```

## 🔍 Debug Endpoints

**Only for development/testing** (remove in production if desired):

### GET /debug/stats
Shows visitor statistics:
```json
{
  "total_records": 42,
  "unique_ips": 38,
  "with_country": 40,
  "today_total": 12,
  "today_unique_ips": 10,
  "success_rate": "95.24%"
}
```

### GET /debug/visitors
Shows last 10 visitors:
```json
[
  {
    "ip": "192.168.1.100",
    "country": "United States",
    "code": "US",
    "user_agent": "Mozilla/5.0...",
    "visited_at": "2026-01-28 19:45:29"
  }
]
```

## 📝 Logs

Check logs for troubleshooting:

```bash
# On server
tail -f /home/ubuntu/projects/decidelab/storage/logs/laravel.log

# Look for lines like:
# [2026-01-28 19:45:29] production.INFO: New visitor tracked {"ip":"192.168.1.100","country":"United States",...}
# [2026-01-28 19:45:35] production.ERROR: Visitor tracking failed {...}
```

## ✅ Verification Checklist

After deployment, verify:

- [ ] Server deployed successfully (git pull completed)
- [ ] Database migrations ran (php artisan migrate)
- [ ] Cache cleared (php artisan cache:clear)
- [ ] PHP-FPM restarted (sudo systemctl restart php8.2-fpm)
- [ ] Endpoint responds: http://18.159.222.36/debug/stats
- [ ] Phone test: Visit from phone, record should appear
- [ ] Refresh test: Refresh 5 times, count should stay at 1
- [ ] Different IP test: Visit from different device, count should be 2
- [ ] 24h test: Wait and visit again tomorrow, should create new record
- [ ] Logs checked: tail -f storage/logs/laravel.log shows visitor records

## 🐛 Troubleshooting

### Problem: No visitors showing up

**Solution Steps**:
1. Check database: `mysql -u root decidelab -e "SELECT COUNT(*) FROM visitors;"`
2. Check logs: `tail -f storage/logs/laravel.log`
3. Run diagnostics: `php server-troubleshoot.php`
4. Verify middleware is registered in `app/Http/Kernel.php`

### Problem: Wrong IP showing (shows proxy IP)

**Solution**:
1. Check headers being passed: Log `$_SERVER` in middleware
2. Configure Nginx/Apache to pass real IP header
3. Update header checks in `getRealIP()` method

### Problem: No country data

**Solution**:
1. Check API connectivity: `curl http://ip-api.com/json/8.8.8.8`
2. Check firewall: Server might be blocking API requests
3. Check logs for API errors
4. Fallback will use local IP range database

### Problem: Still creating duplicate records

**Solution**:
1. Verify 24h logic in middleware (line 58-70)
2. Check database timestamps format
3. Ensure `whereDate()` and `subHours()` working correctly
4. Run diagnostics: `php server-troubleshoot.php`

## 🚀 Production Best Practices

1. **Remove Debug Endpoints** (optional):
   ```php
   // In routes/web.php, remove or comment out:
   // Route::get('/debug/stats', ...);
   // Route::get('/debug/visitors', ...);
   ```

2. **Monitor Logs**:
   ```bash
   # Create monitoring script
   watch -n 1 'tail -n 20 storage/logs/laravel.log | grep "Visitor"'
   ```

3. **Set Up Log Rotation**:
   ```bash
   # Edit /etc/logrotate.d/laravel
   /home/ubuntu/projects/decidelab/storage/logs/*.log {
       daily
       rotate 30
       compress
       delaycompress
   }
   ```

4. **Database Backup**:
   ```bash
   # Regular backup of visitors table
   mysqldump -u root decidelab visitors > visitors_$(date +%Y%m%d).sql
   ```

## 📞 Support

If issues persist:

1. Check `DEPLOYMENT.md` for step-by-step guide
2. Run `server-troubleshoot.php` for diagnostics
3. Check logs: `tail -f storage/logs/laravel.log`
4. Review middleware code: `app/Http/Middleware/TrackVisitors.php`

## 📦 Summary of Changes

| Component | Change | Purpose |
|-----------|--------|---------|
| TrackVisitors.php | +IP proxy detection | Detect real IP behind CDN |
| TrackVisitors.php | +24h deduplication | Prevent duplicate counting |
| Visitor.php | +$fillable fields | Store country data |
| routes/web.php | +Debug endpoints | Monitor visitor data |
| storage/logs | +Enhanced logging | Production debugging |

## ✨ Result

✅ **Visitor tracking system that:**
- Counts each visitor once per 24 hours
- Works from mobile phones
- Detects real IP behind proxies
- Captures country information
- Logs all activity for debugging
- Prevents duplicate counting from refreshes
- Filters out bot traffic
