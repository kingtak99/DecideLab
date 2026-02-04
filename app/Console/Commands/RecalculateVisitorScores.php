<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Visitor;

class RecalculateVisitorScores extends Command
{
    protected $signature = 'visitors:recalculate-scores {--chunk=1000} {--days=30} {--dry-run}';
    protected $description = 'Recalculate confidence_score for visitors (chunked, dry-run supported)';

    public function handle()
    {
        $chunk = (int)$this->option('chunk');
        $days = (int)$this->option('days');
        $dry = (bool)$this->option('dry-run');

        $this->info("Starting visitor confidence score recalculation (chunk={$chunk}, days={$days}, dry=" . ($dry ? 'yes' : 'no') . ")");

        $query = Visitor::query();

        if ($days > 0) {
            $query->where('visited_at', '>=', now()->subDays($days));
        }

        // Only target rows that likely need recalculation: either score == 0 OR we have a heartbeat to evaluate
        $query->where(function ($q) {
            $q->where('confidence_score', 0)
              ->orWhereNotNull('last_heartbeat_at');
        });

        $total = $query->count();
        $this->info("Found {$total} visitors to examine");

        $processed = 0;
        $updated = 0;

        $query->orderBy('id')->chunkById($chunk, function ($visitors) use (&$processed, &$updated, $dry, $total) {
            foreach ($visitors as $v) {
                $processed++;
                // Calculate new score without saving by default; save only when not dry-run
                $new = $v->recalculateConfidence(false);

                if ($new !== (int)$v->confidence_score) {
                    if ($dry) {
                        $this->line("[dry] Visitor {$v->id}: {$v->confidence_score} -> {$new}");
                    } else {
                        $v->confidence_score = $new;
                        $v->save();
                        $updated++;
                    }
                }

                if ($processed % 100 === 0) {
                    $this->info("Processed {$processed}/{$total} (updated {$updated})");
                    // small sleep to reduce IO burst
                    usleep(50000);
                }
            }
        });

        $this->info("Done. Processed: {$processed}, Updated: {$updated}");

        return 0;
    }
}
