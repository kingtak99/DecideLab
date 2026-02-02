<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Visitor;

class BackfillVisitorBehavior extends Command
{
    protected $signature = 'visitors:backfill-behavior';

    protected $description = 'Backfill visitors: set page_views, has_scroll and is_social for existing records';

    public function handle()
    {
        $this->info('Starting backfill...');

        Visitor::chunkById(500, function ($visitors) {
            foreach ($visitors as $v) {
                $updates = [];

                if (is_null($v->page_views)) {
                    $updates['page_views'] = 1;
                }

                if (is_null($v->has_scroll)) {
                    $updates['has_scroll'] = false;
                }

                if (is_null($v->is_social)) {
                    $ua = strtolower($v->user_agent ?? '');
                    $updates['is_social'] = (strpos($ua, 'fb_iab') !== false || strpos($ua, 'fbav') !== false) ? 1 : 0;
                }

                if (!empty($updates)) {
                    $v->update($updates);
                }
            }
        });

        $this->info('Backfill completed.');
        return 0;
    }
}
