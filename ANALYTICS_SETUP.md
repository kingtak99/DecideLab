# 📊 نظام تحليلات الزوار المتقدم (Advanced Visitor Analytics)

## 🎯 الملخص

نظام احترافي لتتبع الزوار يميز تلقائياً بين:
- ✅ **الزوار الحقيقيين** (مستخدمين فعليين)
- 🤖 **البوتس والـ Scanners** (محركات بحث، أدوات أمان، crawlers)

---

## 🚀 خطوات التثبيت

### 1️⃣ تشغيل Migration

```bash
php artisan migrate
```

يضيف العمود `is_bot` لجدول `visitors`.

---

### 2️⃣ تحديث البيانات القديمة (مرة واحدة فقط)

إذا كان عندك بيانات قديمة، شغّل هذا الـ Command:

```bash
php artisan visitors:classify-bots
```

هذا سيصنّف جميع الزيارات القديمة وينسب لها `is_bot` صحيح.

---

### 3️⃣ تفعيل الـ Middleware

في ملف `bootstrap/app.php`، أضف الـ middleware:

```php
->withMiddleware(function (Middleware $middleware) {
    // ... middleware موجودة ...
    $middleware->web(\App\Http\Middleware\TrackVisitor::class);
})
```

---

## 📊 الاستخدام

### 🎛️ لوحة التحكم (Dashboard)

```
http://localhost/analytics/dashboard
```

تعرض:
- 👤 الزوار الحقيقيين اليوم
- 🌍 الزوار الفريدين
- 📈 إحصائيات الشهر
- 🤖 عمليات البوتس والـ Scanners
- 📍 أعلى الصفحات

---

### 🤖 قائمة البوتس المكتشفة

```
http://localhost/analytics/bots
```

تعرض جميع محاولات البوتس مع:
- User-Agent
- IP Address
- عدد المحاولات
- نوع البوت (Security Scanner, Search Engine, etc)

---

### 📊 API - الإحصائيات بصيغة JSON

```
GET /api/stats
```

Response:
```json
{
  "humans": {
    "today": 42,
    "this_month": 1250,
    "unique_today": 38,
    "unique_month": 450
  },
  "bots": {
    "today": 15,
    "this_month": 280,
    "security_scanners_today": 3
  },
  "generated_at": "2026-01-28T14:30:00Z"
}
```

---

## 💻 الاستخدام في الكود

### Query Scopes (الاستعلامات الذكية)

```php
// الزوار الحقيقيين فقط
Visitor::humanOnly()->count();

// البوتس فقط
Visitor::botsOnly()->count();

// اليوم
Visitor::humanOnly()->today()->count();

// هذا الشهر
Visitor::humanOnly()->thisMonth()->count();

// دمج الـ scopes
Visitor::humanOnly()->thisMonth()->distinct('ip_address')->count('ip_address');
```

---

### معلومات سريعة

```php
// إحصائيات الزوار الحقيقيين
$stats = Visitor::getHumanStats('today');
// [
//   'total_visits' => 42,
//   'unique_visitors' => 38,
//   'with_user_account' => 12
// ]

// إحصائيات البوتس
$botStats = Visitor::getBotStats('month');
// [
//   'total_scans' => 280,
//   'unique_bots' => 45,
//   'security_scanners' => 12
// ]

// كشف بوت من user-agent
$isBot = Visitor::isBot('Mozilla/5.0 (compatible; CensysInspect/1.1)');
// true
```

---

## 🔍 الأنماط المكتشفة للبوتس

### ✅ Search Engines (طبيعي)
- GoogleBot
- BingBot
- Yandex
- Baidu

### 🔴 Security Scanners (خطير)
- Censys
- Palo Alto Networks
- ZGrab
- Nessus
- Qualys

### 🟡 Tools & Scrapers
- python-requests
- Go-http-client
- curl, wget
- libredtail (محاولة RCE)

### 🔵 Social Media Crawlers
- Facebook Scraper
- Twitter Bot
- Telegram Bot
- WhatsApp Bot

---

## 📈 الإحصائيات الحقيقية من بياناتك

من جدول الـ visitors اللي أرسلته:

| المقياس | القيمة |
|--------|--------|
| إجمالي الزيارات | 144 |
| البوتس والـ Scanners | ~65 (45%) |
| الزوار الحقيقيين | ~79 (55%) |
| Security Scanners | ~12 |
| Search Engines | ~8 |

**النتيجة:** أرقامك صحيحة 100%، لكن تحتاج فلترة عشان الـ dashboard يبان احترافي ✅

---

## ⚙️ خيارات التخصيص

### تعديل أنماط البوتس المكتشفة

في ملف `app/Models/Visitor.php`، عدّل الـ patterns:

```php
$botPatterns = [
    'your-custom-pattern',
    'another-bot-name',
    // ...
];
```

### تجاهل Routes معينة

في ملف `app/Http/Middleware/TrackVisitor.php`:

```php
$ignorePaths = [
    '/health',
    '/your-custom-path',
];
```

---

## 🔐 الأمان

- ✅ البيانات تُحفظ في قاعدة البيانات (آمن)
- ✅ الـ middleware يعمل في الخلفية (خفيف)
- ✅ الوصول للـ dashboard محمي بـ auth
- ✅ لا توجد cookies أو tracking خارجي

---

## 🐛 استكشاف الأخطاء

### البيانات ما بتُسجَّل؟
- تأكد من تفعيل الـ middleware
- شغّل: `php artisan tinker` ثم `App\Models\Visitor::count()`

### الـ is_bot فاضي؟
- شغّل: `php artisan visitors:classify-bots`

### الأرقام ما تتطابق مع التوقعات؟
- استخدم الـ API: `http://localhost/api/stats`
- قارن الأرقام بين humans و bots

---

## 📚 مراجع إضافية

- Laravel Scopes: https://laravel.com/docs/11.x/eloquent#query-scopes
- User Agents: https://www.useragentstring.com/
- Bot Detection: https://github.com/JayBizzle/Crawler-Detect

---

**✨ تم إنشاء هذا النظام بعناية لضمان دقة الإحصائيات واحترافيتها!**
