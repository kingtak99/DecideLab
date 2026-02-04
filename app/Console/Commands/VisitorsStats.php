<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use App\Models\VisitorStatsSnapshot;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class VisitorsStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitors:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take hourly snapshot of visitor stats (total, human, trusted, social)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('📡 Capturing visitors snapshot...');

        // Snapshot the previous hour to avoid partially-complete current hour
        $periodStart = now()->subHour()->startOfHour();
        $periodEnd = $periodStart->copy()->endOfHour();

        $total = Visitor::whereBetween('visited_at', [$periodStart, $periodEnd])->count();
        $humanQ = Visitor::humanOnly()->whereBetween('visited_at', [$periodStart, $periodEnd]);
        $human = $humanQ->count();
        $trustedQ = Visitor::trustedOnly()->whereBetween('visited_at', [$periodStart, $periodEnd]);
        $trusted = $trustedQ->count();
        $social = Visitor::social()->whereBetween('visited_at', [$periodStart, $periodEnd])->count();

        $uniqueVisitorsHuman = $humanQ->distinct('ip_address')->count('ip_address');

        $trustedRatio = $human ? round(($trusted / $human) * 100, 2) : null;
        $socialRatio = $total ? round(($social / $total) * 100, 2) : null;

        $snapshot = VisitorStatsSnapshot::create([
            'period_start' => $periodStart,
            'period_end' => $periodEnd,
            'total' => $total,
            'human' => $human,
            'trusted' => $trusted,
            'social' => $social,
            'unique_visitors_human' => $uniqueVisitorsHuman,
            'trusted_ratio' => $trustedRatio,
            'social_ratio' => $socialRatio,
        ]);

        $this->info('✅ Snapshot saved for ' . $periodStart->toIsoString() . ' - ' . $periodEnd->toIsoString());
        $this->table(
            ['metric', 'value'],
            [
                ['period_start', $periodStart->toDateTimeString()],
                ['period_end', $periodEnd->toDateTimeString()],
                ['total', $total],
                ['human', $human],
                ['trusted', $trusted],
                ['unique_visitors_human', $uniqueVisitorsHuman],
                ['social', $social],
                ['trusted_ratio (%)', $trustedRatio ?? 'N/A'],
                ['social_ratio (%)', $socialRatio ?? 'N/A'],
            ]
        );

        // Log for ops
        logger()->info('visitors:stats snapshot', ['id' => $snapshot->id, 'period_start' => $periodStart->toDateTimeString()]);

        return self::SUCCESS;
    }
}
