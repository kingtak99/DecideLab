<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // تسجيل الزيارة بعد الـ response
        return $next($request)->header('Cache-Control', 'no-cache')
            ->tap(function ($response) use ($request) {
                $this->recordVisitor($request);
            });
    }

    /**
     * 🎯 تسجيل الزيارة مع كشف البوتس تلقائياً
     */
    private function recordVisitor(Request $request): void
    {
        // تجاهل routes معينة (مثل health checks)
        $ignorePaths = [
            '/health',
            '/ping',
            '/favicon.ico',
            '/robots.txt',
            '/sitemap.xml',
            '/.well-known',
        ];

        $currentPath = $request->getPathInfo();
        foreach ($ignorePaths as $ignorePath) {
            if (str_starts_with($currentPath, $ignorePath)) {
                return;
            }
        }

        $userAgent = $request->userAgent() ?? 'Unknown';
        $isBot = Visitor::isBot($userAgent);

        Visitor::create([
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'url' => $request->fullUrl(),
            'user_id' => auth()->id(),
            'is_bot' => $isBot,
            'visited_at' => now(),
        ]);
    }
}
