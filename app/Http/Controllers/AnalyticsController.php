<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    /**
     * 📊 عرض لوحة التحكم مع إحصائيات نظيفة
     */
    public function dashboard(): View
    {
        // 👤 إحصائيات الزوار الحقيقيين (اليوم)
        $humanTodayStats = Visitor::humanOnly()->today()->get();
        $humanToday = [
            'total_visits' => $humanTodayStats->count(),
            'unique_visitors' => $humanTodayStats->unique('ip_address')->count(),
            'with_account' => $humanTodayStats->whereNotNull('user_id')->count(),
        ];

        // 👤 إحصائيات الزوار الحقيقيين (هذا الشهر)
        $humanMonthStats = Visitor::humanOnly()->thisMonth()->get();
        $humanMonth = [
            'total_visits' => $humanMonthStats->count(),
            'unique_visitors' => $humanMonthStats->unique('ip_address')->count(),
            'with_account' => $humanMonthStats->whereNotNull('user_id')->count(),
        ];

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

        // 📈 أعلى الصفحات بين الزوار الحقيقيين
        $topPages = Visitor::humanOnly()
            ->thisMonth()
            ->selectRaw('url, COUNT(*) as visits')
            ->groupBy('url')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        // 🌍 أعلى الدول (حسب IP)
        $topCountries = Visitor::humanOnly()
            ->thisMonth()
            ->selectRaw('ip_address, COUNT(*) as visits')
            ->groupBy('ip_address')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        return view('analytics.dashboard', compact(
            'humanToday',
            'humanMonth',
            'botToday',
            'botMonth',
            'topPages',
            'topCountries',
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
