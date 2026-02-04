<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VisitorHeartbeatController extends Controller
{
    /**
     * Receive heartbeat pings from front-end and update visitor session_duration / page_views.
     */
    public function ping(Request $request): JsonResponse
    {
        $data = $request->validate([
            'session_id' => 'required|string',
            'page' => 'nullable|string',
            'delta' => 'nullable|integer',
            'has_scroll' => 'nullable|boolean',
        ]);

        $sessionId = $data['session_id'];
        $page = $data['page'] ?? null;
        $delta = $data['delta'] ?? null;
        $hasScroll = $data['has_scroll'] ?? null;

        $visitor = Visitor::where('session_id', $sessionId)
            ->where('visited_at', '>=', now()->subHours(24))
            ->latest('visited_at')
            ->first();

        if (!$visitor) {
            // Nothing to update (no matching visitor in last 24h)
            return response()->json(['updated' => false], 204);
        }

        // Calculate delta seconds conservatively
        if (!$delta) {
            if ($visitor->last_heartbeat_at) {
                $delta = Carbon::now()->diffInSeconds($visitor->last_heartbeat_at);
            } else {
                $delta = 15; // default seconds
            }
        }

        // sanitize delta
        $delta = max(1, min(300, (int)$delta));

        // Update session duration and visited_at
        $visitor->increment('session_duration', $delta);
        $visitor->last_heartbeat_at = now();
        $visitor->visited_at = now();

        // If page changed, increment page_views and update url
        if ($page && $page !== $visitor->url) {
            $visitor->increment('page_views');
            $visitor->url = $page;
        }

        // Mark has_scroll if reported
        if ($hasScroll) {
            $visitor->has_scroll = true;
        }

        // Recalculate confidence score (lightweight) and save
        $newScore = $visitor->recalculateConfidence(true);

        return response()->json(['updated' => true, 'session_duration' => $visitor->session_duration, 'confidence_score' => $newScore]);
    }
}
