<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'user_id',
        'is_bot',
        'visited_at',
        'country',
        'country_code',
        'session_id',
        'session_duration',
        'page_title',
        'referrer',
    ];

    protected $dates = ['visited_at'];
    protected $casts = [
        'is_bot' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Query Scopes للفلترة الذكية
    public function scopeHumanOnly(Builder $query): Builder
    {
        return $query->where('is_bot', false);
    }

    public function scopeBotsOnly(Builder $query): Builder
    {
        return $query->where('is_bot', true);
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('visited_at', now());
    }

    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year);
    }

    // 🤖 كشف البوتس من User-Agent
    public static function isBot(string $userAgent): bool
    {
        $botPatterns = [
            // Crawlers & Scanners
            'bot', 'crawler', 'spider', 'scraper',
            'curl', 'wget', 'python', 'java(?!script)',
            'php', 'ruby', 'perl', 'go-http',
            
            // Security & Network Tools
            'zgrab', 'nmap', 'nikto', 'masscan',
            'censys', 'shodan', 'qualys', 'nessus',
            'palo alto', 'cortex', 'nuclei', 'metasploit',
            
            // SEO Tools
            'googlebot', 'bingbot', 'yandex', 'baidu',
            'facebook', 'twitter', 'linkedin', 'whatsapp',
            'telegram', 'slack', 'discord',
            
            // Monitoring & APM
            'datadog', 'newrelic', 'elastic', 'prometheus',
            'grafana', 'pingdom', 'uptime',
            
            // Other Bots
            'libredtail', 'genomecrwaler', 'grpc',
            'headless', 'phantom', 'selenium',
            'apachebench', 'wrk', 'fasthttp',
            'libwww', 'httpbanner', 'http banner',
        ];

        $userAgentLower = strtolower($userAgent);

        foreach ($botPatterns as $pattern) {
            if (strpos($userAgentLower, $pattern) !== false) {
                return true;
            }
        }

        return false;
    }

    // 🎯 حساب الزوار الحقيقيين (Unique Humans)
    public static function getHumanStats(string $period = 'today'): array
    {
        $query = self::humanOnly();

        if ($period === 'today') {
            $query->today();
        } elseif ($period === 'month') {
            $query->thisMonth();
        }

        return [
            'total_visits' => $query->count(),
            'unique_visitors' => $query->distinct('ip_address')->count('ip_address'),
            'with_user_account' => $query->whereNotNull('user_id')->count(),
        ];
    }

    // 📊 حساب إحصائيات البوتس (للمراقبة)
    public static function getBotStats(string $period = 'today'): array
    {
        $query = self::botsOnly();

        if ($period === 'today') {
            $query->today();
        } elseif ($period === 'month') {
            $query->thisMonth();
        }

        return [
            'total_scans' => $query->count(),
            'unique_bots' => $query->distinct('ip_address')->count('ip_address'),
            'security_scanners' => $query->whereRaw("LOWER(user_agent) LIKE '%censys%' OR LOWER(user_agent) LIKE '%palo alto%' OR LOWER(user_agent) LIKE '%zgrab%'")->count(),
        ];
    }
}
