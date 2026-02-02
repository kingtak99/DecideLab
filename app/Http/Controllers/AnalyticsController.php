<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    /**
     * 📊 عرض لوحة التحكم مع إحصائيات نظيفة
     */
    public function dashboard(\Illuminate\Http\Request $request): View
    {
        // Parse date range from query params (defaults to today)
        $start = $request->query('start_date') ? \Carbon\Carbon::parse($request->query('start_date'))->startOfDay() : now()->startOfDay();
        $end = $request->query('end_date') ? \Carbon\Carbon::parse($request->query('end_date'))->endOfDay() : now()->endOfDay();

        // 👤 إحصائيات الزوار الموثوقين (نطاق التاريخ المحدد)
        $trustedTodayStats = Visitor::trustedOnly()->whereBetween('visited_at', [$start, $end])->get();
        $humanToday = [
            'total_visits' => $trustedTodayStats->count(),
            'unique_visitors' => $trustedTodayStats->unique('ip_address')->count(),
            'with_account' => $trustedTodayStats->whereNotNull('user_id')->count(),
        ];

        // Social traffic (FB in-app) — show separately (within date range)
        $socialToday = Visitor::social()->whereBetween('visited_at', [$start, $end])->distinct('ip_address')->count('ip_address');

        // 👤 إحصائيات الزوار الموثوقين (هذا الشهر) — تبقى متاحة للمقارنة
        $trustedMonthStats = Visitor::trustedOnly()->thisMonth()->get();
        $humanMonth = [
            'total_visits' => $trustedMonthStats->count(),
            'unique_visitors' => $trustedMonthStats->unique('ip_address')->count(),
            'with_account' => $trustedMonthStats->whereNotNull('user_id')->count(),
        ];

        // Social traffic (FB in-app) — monthly
        $socialMonth = Visitor::social()->thisMonth()->distinct('ip_address')->count('ip_address');

        // --- Range-aware queries for quick/raw/top pages/countries ---
        $rangeStart = $start;
        $rangeEnd = $end;

        // 🤖 إحصائيات البوتس (اليوم)
        $botTodayStats = Visitor::botsOnly()->today()->get();
        $botToday = [
            'total_scans' => $botTodayStats->count(),
            'unique_bots' => $botTodayStats->unique('ip_address')->count(),
            'security_scanners' => $botTodayStats->filter(fn($v) => 
                str_contains(strtolower($v->user_agent), 'censys') ||
                str_contains(strtolower($v->user_agent), 'palo alto') ||
                str_contains(strtolower($v->user_agent), 'zgrab')
            )->count(),
        ];

        // 🤖 إحصائيات البوتس (هذا الشهر)
        $botMonthStats = Visitor::botsOnly()->thisMonth()->get();
        $botMonth = [
            'total_scans' => $botMonthStats->count(),
            'unique_bots' => $botMonthStats->unique('ip_address')->count(),
        ];

        // 📈 أعلى الصفحات بين الزوار الموثوقين
        $topPages = Visitor::trustedOnly()
            ->thisMonth()
            ->selectRaw('url, COUNT(*) as visits')
            ->groupBy('url')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        // 🔄 Unique visitors per page (trusted)
        $visitorsByPage = Visitor::trustedOnly()
            ->thisMonth()
            ->selectRaw('url, COUNT(DISTINCT ip_address) as unique_count')
            ->groupBy('url')
            ->orderByDesc('unique_count')
            ->limit(5)
            ->get();

        // ⏱️ Session duration stats (trusted)
        $sessionStats = Visitor::trustedOnly()
            ->thisMonth()
            ->whereNotNull('session_duration')
            ->selectRaw('AVG(session_duration) as avg_duration, MAX(session_duration) as max_duration, MIN(session_duration) as min_duration')
            ->first();

        // 🌍 دول الزوار (trusted)
        $countryStats = Visitor::trustedOnly()
            ->thisMonth()
            ->selectRaw('country, country_code, COUNT(DISTINCT ip_address) as visitors')
            ->whereNotNull('country')
            ->where('country', '!=', 'Unknown')
            ->groupBy('country', 'country_code')
            ->orderByDesc('visitors')
            ->limit(15)
            ->get();

        // Quick / Incomplete visits (humanOnly but failed behavioral checks) — within selected range
        $quickTodayCount = Visitor::humanOnly()
            ->whereBetween('visited_at', [$rangeStart, $rangeEnd])
            ->where(function ($q) {
                $q->where('session_duration', '<', 5)
                  ->where('page_views', '<', 2)
                  ->where('has_scroll', false)
                  ->whereRaw("LOWER(user_agent) NOT LIKE '%fb_iab%'")
                  ->whereRaw("LOWER(user_agent) NOT LIKE '%fbav%'")
                  ->whereRaw("LOWER(user_agent) NOT LIKE '%facebook%iab%'");
            })
            ->distinct('ip_address')
            ->count('ip_address');

        // Per-country breakdown for quick visits (to show where quick traffic comes from)
        $quickCountryStats = Visitor::humanOnly()
            ->whereBetween('visited_at', [$rangeStart, $rangeEnd])
            ->where(function ($q) {
                $q->where('session_duration', '<', 5)
                  ->where('page_views', '<', 2)
                  ->where('has_scroll', false)
                  ->whereRaw("LOWER(user_agent) NOT LIKE '%fb_iab%'")
                  ->whereRaw("LOWER(user_agent) NOT LIKE '%fbav%'")
                  ->whereRaw("LOWER(user_agent) NOT LIKE '%facebook%iab%'");
            })
            ->selectRaw('country, country_code, COUNT(DISTINCT ip_address) as visitors')
            ->whereNotNull('country')
            ->where('country', '!=', 'Unknown')
            ->groupBy('country', 'country_code')
            ->orderByDesc('visitors')
            ->get();

        // Raw (unfiltered) metrics for comparison / toggle
        $rawToday = [
            'total_visits' => Visitor::whereBetween('visited_at', [$rangeStart, $rangeEnd])->count(),
            'unique_visitors' => Visitor::whereBetween('visited_at', [$rangeStart, $rangeEnd])->distinct('ip_address')->count('ip_address'),
            'with_account' => Visitor::whereBetween('visited_at', [$rangeStart, $rangeEnd])->whereNotNull('user_id')->count(),
        ];

        $rawTopPages = Visitor::whereBetween('visited_at', [$rangeStart, $rangeEnd])
            ->selectRaw('url, COUNT(*) as visits')
            ->groupBy('url')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        $rawVisitorsByPage = Visitor::whereBetween('visited_at', [$rangeStart, $rangeEnd])
            ->selectRaw('url, COUNT(DISTINCT ip_address) as unique_count')
            ->groupBy('url')
            ->orderByDesc('unique_count')
            ->limit(5)
            ->get();

        $rawCountryStats = Visitor::whereBetween('visited_at', [$rangeStart, $rangeEnd])
            ->selectRaw('country, country_code, COUNT(DISTINCT ip_address) as visitors')
            ->whereNotNull('country')
            ->where('country', '!=', 'Unknown')
            ->groupBy('country', 'country_code')
            ->orderByDesc('visitors')
            ->get();

        $rawChartData = [
            'pages' => [
                'labels' => $rawTopPages->pluck('url')->toArray(),
                'data' => $rawTopPages->pluck('visits')->toArray(),
            ],
            'countries' => [
                'labels' => $rawCountryStats->pluck('country')->toArray(),
                'data' => $rawCountryStats->pluck('visitors')->toArray(),
            ],
            'visitors_by_page' => [
                'labels' => $rawVisitorsByPage->pluck('url')->toArray(),
                'data' => $rawVisitorsByPage->pluck('unique_count')->toArray(),
            ],
        ];

        // 📊 Data for Chart.js (trusted)
        $chartData = [
            'pages' => [
                'labels' => $topPages->pluck('url')->toArray(),
                'data' => $topPages->pluck('visits')->toArray(),
            ],
            'countries' => [
                'labels' => $countryStats->pluck('country')->toArray(),
                'data' => $countryStats->pluck('visitors')->toArray(),
            ],
            'visitors_by_page' => [
                'labels' => $visitorsByPage->pluck('url')->toArray(),
                'data' => $visitorsByPage->pluck('unique_count')->toArray(),
            ],
        ];

        return view('analytics.dashboard', compact(
            'humanToday',
            'humanMonth',
            'socialToday',
            'socialMonth',
            'quickTodayCount',
            'quickCountryStats',
            'rawToday',
            'rawTopPages',
            'rawCountryStats',
            'rawVisitorsByPage',
            'rawChartData',
            'botToday',
            'botMonth',
            'topPages',
            'countryStats',
            'sessionStats',
            'visitorsByPage',
            'chartData',
        ));
    }

    /**
     * 📋 عرض قائمة البوتس المكتشفة
     */
    public function detectedBots(): View
    {
        $bots = Visitor::botsOnly()
            ->thisMonth()
            ->selectRaw('user_agent, ip_address, COUNT(*) as scan_count')
            ->groupBy('user_agent', 'ip_address')
            ->orderByDesc('scan_count')
            ->paginate(20);

        return view('analytics.detected-bots', compact('bots'));
    }

    /**
     * 📊 تقرير JSON (للـ API)
     */
    public function apiStats()
    {
        return response()->json([
            'humans' => [
                'today' => Visitor::humanOnly()->today()->count(),
                'this_month' => Visitor::humanOnly()->thisMonth()->count(),
                'unique_today' => Visitor::humanOnly()->today()->distinct('ip_address')->count('ip_address'),
                'unique_month' => Visitor::humanOnly()->thisMonth()->distinct('ip_address')->count('ip_address'),
            ],
            'bots' => [
                'today' => Visitor::botsOnly()->today()->count(),
                'this_month' => Visitor::botsOnly()->thisMonth()->count(),
                'security_scanners_today' => Visitor::botsOnly()
                    ->today()
                    ->whereRaw("LOWER(user_agent) LIKE '%censys%' OR LOWER(user_agent) LIKE '%palo alto%'")
                    ->count(),
            ],
            'generated_at' => now(),
        ]);
    }
}
