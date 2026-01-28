# 📊 Examples - أمثلة عملية

## استخدام Query Scopes

### مثال 1: عد الزوار الحقيقيين اليوم
```php
$humanToday = Visitor::humanOnly()->today()->count();
// يعيد: 42
```

### مثال 2: الزوار الفريدين (Unique) هذا الشهر
```php
$uniqueVisitors = Visitor::humanOnly()
    ->thisMonth()
    ->distinct('ip_address')
    ->count('ip_address');
// يعيد: 450
```

### مثال 3: زوار لهم حساب في النظام
```php
$registeredUsers = Visitor::humanOnly()
    ->whereNotNull('user_id')
    ->thisMonth()
    ->count();
// يعيد: 120
```

### مثال 4: كشف البوتس من URL محددة
```php
$botsHittingAdmin = Visitor::botsOnly()
    ->where('url', 'LIKE', '%admin%')
    ->count();
// يعيد: 5
```

---

## الكود الكامل في Controller

```php
<?php

namespace App\Http\Controllers;

use App\Models\Visitor;

class ReportsController extends Controller
{
    // تقرير يومي
    public function dailyReport()
    {
        $data = [
            'humans' => [
                'visits' => Visitor::humanOnly()->today()->count(),
                'unique' => Visitor::humanOnly()->today()->distinct('ip_address')->count(),
                'with_account' => Visitor::humanOnly()->today()->whereNotNull('user_id')->count(),
            ],
            'bots' => [
                'total_scans' => Visitor::botsOnly()->today()->count(),
                'unique_bots' => Visitor::botsOnly()->today()->distinct('ip_address')->count(),
                'security_scanners' => $this->countSecurityScanners(),
            ],
            'top_pages' => Visitor::humanOnly()
                ->today()
                ->selectRaw('url, COUNT(*) as hits')
                ->groupBy('url')
                ->orderByDesc('hits')
                ->limit(5)
                ->get(),
        ];

        return view('reports.daily', $data);
    }

    // تقرير شهري
    public function monthlyReport()
    {
        $data = [
            'total_visitors' => Visitor::humanOnly()
                ->thisMonth()
                ->distinct('ip_address')
                ->count(),
            'total_visits' => Visitor::humanOnly()->thisMonth()->count(),
            'registered_users' => Visitor::humanOnly()
                ->thisMonth()
                ->distinct('user_id')
                ->count('user_id'),
            'bot_attacks' => Visitor::botsOnly()->thisMonth()->count(),
        ];

        return view('reports.monthly', $data);
    }

    // إحصائيات مخصصة
    public function customStats(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $userAgent = $request->input('user_agent');

        $query = Visitor::humanOnly()
            ->whereBetween('visited_at', [$from, $to]);

        if ($userAgent) {
            $query->where('user_agent', 'LIKE', "%$userAgent%");
        }

        return response()->json([
            'total' => $query->count(),
            'unique_visitors' => $query->distinct('ip_address')->count(),
            'data' => $query->paginate(20),
        ]);
    }

    private function countSecurityScanners()
    {
        return Visitor::botsOnly()
            ->whereRaw("
                LOWER(user_agent) LIKE '%censys%' OR
                LOWER(user_agent) LIKE '%palo alto%' OR
                LOWER(user_agent) LIKE '%zgrab%' OR
                LOWER(user_agent) LIKE '%nessus%' OR
                LOWER(user_agent) LIKE '%qualys%'
            ")
            ->count();
    }
}
```

---

## في Blade Template

```blade
<div class="stats-container">
    <!-- إحصائيات الزوار -->
    <div class="stat-card">
        <h3>👤 الزوار الحقيقيين (اليوم)</h3>
        <p class="big-number">
            {{ \App\Models\Visitor::humanOnly()->today()->count() }}
        </p>
    </div>

    <!-- الزوار الفريدين -->
    <div class="stat-card">
        <h3>🌍 زوار فريدين</h3>
        <p class="big-number">
            {{ \App\Models\Visitor::humanOnly()
                ->today()
                ->distinct('ip_address')
                ->count() }}
        </p>
    </div>

    <!-- البوتس -->
    <div class="stat-card alert">
        <h3>🤖 عمليات البوتس</h3>
        <p class="big-number">
            {{ \App\Models\Visitor::botsOnly()->today()->count() }}
        </p>
    </div>
</div>

<!-- قائمة أفضل الصفحات -->
<table>
    <thead>
        <tr>
            <th>الصفحة</th>
            <th>الزيارات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topPages as $page)
        <tr>
            <td>{{ $page->url }}</td>
            <td>{{ $page->visits }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

## API Response مثال

### Request:
```
GET /api/stats
```

### Response:
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
  "generated_at": "2026-01-28T14:30:00.000000Z"
}
```

---

## Artisan Commands

### عرض إحصائيات سريعة
```bash
php artisan tinker

>>> Visitor::count()                    // كل الزيارات
>>> Visitor::humanOnly()->count()       // الزوار الحقيقيين فقط
>>> Visitor::botsOnly()->count()        // البوتس فقط
>>> Visitor::humanOnly()->thisMonth()->count()  // الزوار هذا الشهر
```

### تحديث البيانات القديمة
```bash
php artisan visitors:classify-bots
```

---

## حالات استخدام عملية

### 1️⃣ معرفة الـ Conversion Rate الحقيقي

```php
$visitors = Visitor::humanOnly()->thisMonth()->distinct('ip_address')->count();
$conversions = Order::thisMonth()->count();
$rate = ($conversions / $visitors) * 100;

return "$rate% من الزوار قاموا بالشراء";
```

### 2️⃣ اكتشاف محاولات الاختراق

```php
$suspiciousRequests = Visitor::botsOnly()
    ->where('url', 'LIKE', '%/admin%')
    ->orWhere('url', 'LIKE', '%wp-admin%')
    ->orWhere('url', 'LIKE', '%index.php?%')
    ->get();

// يمكن تسجيل تنبيه هنا
```

### 3️⃣ تقرير أداء المحتوى

```php
$topContent = Visitor::humanOnly()
    ->thisMonth()
    ->selectRaw('url, COUNT(*) as visits')
    ->groupBy('url')
    ->havingRaw('COUNT(*) > ?', [10])
    ->orderByDesc('visits')
    ->get();
```

### 4️⃣ تحليل مصادر الزيارات

```php
$mobileVisitors = Visitor::humanOnly()
    ->thisMonth()
    ->whereRaw("LOWER(user_agent) LIKE '%mobile%'")
    ->count();

$desktopVisitors = Visitor::humanOnly()
    ->thisMonth()
    ->whereRaw("LOWER(user_agent) NOT LIKE '%mobile%'")
    ->count();

return [
    'mobile' => $mobileVisitors,
    'desktop' => $desktopVisitors,
];
```

---

**هذه أمثلة فقط - يمكنك توسيعها حسب احتياجاتك! 🚀**
