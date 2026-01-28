# 🔧 استكشاف الأخطاء والمشاكل (Troubleshooting)

## 🚨 المشكلة الأولى: Migration errors

### الخطأ:
```
SQLSTATE[HY000]: General error: 1030 Got error 28 from storage engine
```

### الحل:
```bash
# 1. أولاً، حاول مرة ثانية
php artisan migrate:rollback
php artisan migrate

# 2. إذا استمر الخطأ، امسح الـ cache
php artisan cache:clear
php artisan config:clear

# 3. شغّل مع verbose
php artisan migrate --verbose
```

---

## 🚨 المشكلة الثانية: Middleware ما بتعمل

### الخطأ:
```
Class not found: App\Http\Middleware\TrackVisitor
```

### الحل:

#### ✅ الحل 1: تأكد من اسم الـ File
```bash
# الملف يجب يكون اسمه بدقة:
# app/Http/Middleware/TrackVisitor.php
# ليس TrackVisitors (بدون s في آخره)
```

#### ✅ الحل 2: تحقق من bootstrap/app.php
```php
// ❌ خطأ - مسافة إضافية
$middleware->web(\App\Http\Middleware\ TrackVisitor::class);

// ✅ صحيح
$middleware->web(\App\Http\Middleware\TrackVisitor::class);
```

#### ✅ الحل 3: Reload composer
```bash
composer dump-autoload
php artisan clear-cache
```

---

## 🚨 المشكلة الثالثة: البيانات ما تُسجَّل

### الخطأ:
```
Visitor::count() returns 0
```

### الحل:

#### ✅ الخطوة 1: تأكد من Migration
```bash
php artisan migrate:status
# يجب تشوف ✓ بجانب 2026_01_28_000001
```

#### ✅ الخطوة 2: تأكد من الـ Middleware
```bash
php artisan route:list
# يجب تشوف الـ middleware في القائمة
```

#### ✅ الخطوة 3: اختبر يدوي
```bash
php artisan tinker
>>> $visitor = App\Models\Visitor::create([
    'ip_address' => '192.168.1.1',
    'user_agent' => 'Test Bot',
    'url' => 'http://test.com',
    'is_bot' => true,
]);
>>> Visitor::count()
# يجب يعطيك 1
```

#### ✅ الخطوة 4: حقق من الـ Routes
```bash
php artisan tinker
>>> \Illuminate\Support\Facades\Route::getRoutes()->getByName('analytics.dashboard')
# يجب يعطيك اسم الـ route بدون أخطاء
```

---

## 🚨 المشكلة الرابعة: Dashboard فارغ

### الخطأ:
```
البيانات ما تظهر في /analytics/dashboard
```

### الحل:

#### ✅ الخطوة 1: تحقق من البيانات
```bash
php artisan tinker
>>> Visitor::count()                    # كم زيارة كلية؟
>>> Visitor::humanOnly()->count()       # كم زائر حقيقي؟
>>> Visitor::botsOnly()->count()        # كم بوت؟
```

#### ✅ الخطوة 2: صنّف البيانات القديمة
```bash
php artisan visitors:classify-bots
```

#### ✅ الخطوة 3: امسح الـ Cache
```bash
php artisan view:clear
php artisan cache:clear
```

#### ✅ الخطوة 4: اختبر مع fresh data
```bash
# أضف زيارة جديدة يدوياً
php artisan tinker
>>> Visitor::create([
    'ip_address' => '127.0.0.1',
    'user_agent' => 'Mozilla/5.0 Test',
    'url' => 'http://localhost/',
    'is_bot' => false,
]);

# ثم افتح Dashboard في المتصفح
```

---

## 🚨 المشكلة الخامسة: Blade View أخطاء

### الخطأ:
```
Undefined variable: humanToday
```

### الحل:

#### ✅ الحل 1: تأكد من المسار الصحيح
```php
// ❌ خطأ
return view('dashboard');

// ✅ صحيح
return view('analytics.dashboard', compact('humanToday'));
```

#### ✅ الحل 2: استخدم compact() صحيح
```php
// في Controller
return view('analytics.dashboard', compact(
    'humanToday',
    'humanMonth',
    'botToday',
    'botMonth',
    'topPages',
));
```

#### ✅ الحل 3: إذا استخدمت Tailwind
```php
// في blade، تأكد من تضمين Tailwind CSS
<link href="https://cdn.tailwindcss.com" rel="stylesheet">
```

---

## 🚨 المشكلة السادسة: API ما بترجع بيانات

### الخطأ:
```
GET /api/stats returns empty JSON
```

### الحل:

#### ✅ الحل 1: تأكد من Route
```bash
php artisan route:list | grep api/stats
```

#### ✅ الحل 2: اختبر مباشرة
```bash
curl -X GET http://localhost/api/stats
```

#### ✅ الحل 3: تصحيح Response
```php
// في AnalyticsController
public function apiStats()
{
    return response()->json([
        'humans' => [
            'today' => Visitor::humanOnly()->today()->count(),
            'this_month' => Visitor::humanOnly()->thisMonth()->count(),
        ],
        // ... باقي الكود
    ]);
}
```

---

## 🚨 المشكلة السابعة: حذف آخر نسخة عن طريق الخطأ

### الخطأ:
```
حذفت ملف مهم بالخطأ!
```

### الحل:

#### ✅ للـ Database (Migration)
```bash
# عد للحالة السابقة
php artisan migrate:rollback

# إذا كانت آخر خطوة فقط
php artisan migrate:rollback --step=1
```

#### ✅ للـ Blade Views
```bash
# إعادة إنشاء الملف من backup أو النموذج
# أو انسخ من EXAMPLES.md
```

#### ✅ للـ PHP Files
```bash
# استخدم git
git checkout app/Http/Controllers/AnalyticsController.php
```

---

## 🚨 المشكلة الثامنة: الـ is_bot عمود NULL

### الخطأ:
```
بعض الصفوف عندها is_bot = NULL
```

### الحل:

```bash
# شغّل التصنيف مع force
php artisan visitors:classify-bots --force

# أو يدوياً في Tinker
php artisan tinker
>>> Visitor::whereNull('is_bot')->each(function($v) {
    $v->update(['is_bot' => App\Models\Visitor::isBot($v->user_agent)]);
});
```

---

## 🚨 المشكلة التاسعة: الأداء بطيء

### الخطأ:
```
Dashboard بطيء جداً
Queries كثيرة
```

### الحل:

#### ✅ الحل 1: أضف Index
```bash
php artisan tinker
>>> DB::statement('ALTER TABLE visitors ADD INDEX is_bot_index (is_bot)');
>>> DB::statement('ALTER TABLE visitors ADD INDEX visited_at_index (visited_at)');
```

#### ✅ الحل 2: استخدم Pagination
```php
// في Controller
$bots = Visitor::botsOnly()->paginate(20); // 20 في كل صفحة
```

#### ✅ الحل 3: Cache النتائج
```php
// استخدم Cache
$stats = \Illuminate\Support\Facades\Cache::remember('bot_stats', 3600, function() {
    return Visitor::getBotStats('month');
});
```

#### ✅ الحل 4: Database Query optimization
```php
// ❌ بطيء
foreach(Visitor::all() as $visitor) {
    // معالجة
}

// ✅ سريع
Visitor::chunk(100, function($visitors) {
    foreach($visitors as $visitor) {
        // معالجة
    }
});
```

---

## 🚨 المشكلة العاشرة: Pattern detection ما بتشتغل

### الخطأ:
```
بوت معروف ما بيتكتشف
```

### الحل:

#### ✅ الخطوة 1: اختبر الـ Pattern
```bash
php artisan tinker
>>> $ua = "Mozilla/5.0 zgrab/0.x";
>>> Visitor::isBot($ua);
# يجب يعطيك true
```

#### ✅ الخطوة 2: أضف Pattern جديد
```php
// في app/Models/Visitor.php
$botPatterns = [
    // ... patterns موجودة ...
    'your-custom-bot-name',  // ✨ أضفت جديد
];
```

#### ✅ الخطوة 3: عيّن البيانات القديمة
```bash
php artisan visitors:classify-bots --force
```

---

## 📋 Troubleshooting Checklist

- [ ] Migration تمام ✅
- [ ] Middleware مفعل ✅
- [ ] Routes موجودة ✅
- [ ] Views موجودة ✅
- [ ] البيانات تُسجَّل ✅
- [ ] Dashboard يعرض أرقام ✅
- [ ] API تعمل ✅
- [ ] Command شغّال ✅

---

## 🆘 لما تستعين بـ Support

إذا قاعدة تحاول تحل مشكلة وما فادت، جاهز الـ info التالي:

```bash
# معلومات النظام
php -v
php artisan --version
php artisan env

# معلومات قاعدة البيانات
php artisan tinker
>>> DB::select('SELECT VERSION()');

# معلومات الـ Composer
composer show

# الأخطاء من Logs
tail -f storage/logs/laravel.log
```

---

## 💡 نصائح عامة

1. **اقرأ الخطأ بعناية** - غالباً الرسالة تقول أين المشكلة
2. **شغّل من Terminal** - أسهل من الـ UI
3. **استخدم Tinker** - للاختبار السريع
4. **امسح الـ Cache** - يحل 50% من المشاكل
5. **اقرأ الـ Logs** - في `storage/logs/`
6. **استخدم Artisan** - جزء من Laravel وآمن

---

**تذكر: الصبر والمنطق يحلان أي مشكلة! 💪**
