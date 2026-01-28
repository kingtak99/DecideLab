<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Illuminate\Console\Command;

class ClassifyVisitorBots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitors:classify-bots';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'كشف وتصنيف البوتس والـ Crawlers في جدول الزوار القديم';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🤖 جاري تصنيف الزوار...');

        $totalVisitors = Visitor::count();
        $processedCount = 0;
        $botsCount = 0;

        // معالجة البيانات على دفعات (Chunking) للأمان
        Visitor::whereNull('is_bot')
            ->orWhere('is_bot', false)
            ->chunk(100, function ($visitors) use (&$processedCount, &$botsCount) {
                foreach ($visitors as $visitor) {
                    $isBot = Visitor::isBot($visitor->user_agent);
                    $visitor->update(['is_bot' => $isBot]);
                    
                    if ($isBot) {
                        $botsCount++;
                    }
                    
                    $processedCount++;
                    
                    // تحديث Progress Bar
                    $this->output->write(
                        "\r{$processedCount}/{$totalVisitors} ✓"
                    );
                }
            });

        $this->newLine();
        $this->info("✅ انتهى التصنيف!");
        $this->table(['الإحصائية', 'العدد'], [
            ['إجمالي الزوار', $totalVisitors],
            ['البوتس والـ Crawlers', $botsCount],
            ['الزوار الحقيقيين', $totalVisitors - $botsCount],
            ['نسبة البوتس', round(($botsCount / $totalVisitors) * 100, 2) . '%'],
        ]);

        return self::SUCCESS;
    }
}
