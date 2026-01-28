# 🚀 للنشر على السيرفر - خطوات سريعة

## الخطوة الأولى: تأكد أن كل شيء مرفوع
```bash
git status
# يجب تكون "working tree clean"
```

## الخطوة الثانية: SSH للسيرفر
```bash
ssh ubuntu@18.159.222.36
```

## الخطوة الثالثة: النشر
```bash
cd /home/ubuntu/projects/decidelab

# اسحب الكود الجديد
git pull origin main

# نزل dependencies
composer install --no-dev

# شغل migrations
php artisan migrate --force

# صفي الكاش
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# أعد تشغيل PHP
sudo systemctl restart php8.2-fpm
```

## الخطوة الرابعة: تأكد إنه شغال
```bash
# شغل diagnostic
php server-troubleshoot.php

# أو افتح في البراوزر
http://18.159.222.36/debug/stats
```

## اختبر من الهاتف
1. افتح http://18.159.222.36 من الهاتف
2. Refresh 5 مرات
3. افتح http://18.159.222.36/debug/stats
4. يجب تشوف: "Unique IPs: 1" (مو 5) ✅

## لو في مشكلة
```bash
# شوف الـ logs
tail -f /home/ubuntu/projects/decidelab/storage/logs/laravel.log

# أو شغل diagnostic
php /home/ubuntu/projects/decidelab/server-troubleshoot.php
```

## Files for Reference
- `DEPLOYMENT.md` - شرح كامل
- `VISITOR_TRACKING_SETUP.md` - شرح النظام
- `server-troubleshoot.php` - diagnostic
