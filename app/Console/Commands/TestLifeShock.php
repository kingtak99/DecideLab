<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestLifeShock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-life-shock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing LifeShockController...');
        
        try {
            $controller = app(\App\Http\Controllers\LifeShockController::class);
            $this->info('Controller instantiated successfully!');
            
            // Test the calculation method with a mock request
            $mockRequest = new \Illuminate\Http\Request();
            $mockRequest->merge([
                'age' => 25,
                'social_media_hours' => 2,
                'video_hours' => 1,
                'gaming_hours' => 0,
                'wasting_hours' => 1,
                'sleep_hours' => 8,
                'work_hours' => 8,
                'work_days' => 5
            ]);
            
            $response = $controller->calculateLifeShock($mockRequest);
            $this->info('Calculation test passed!');
            
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getContent(), true);
                $this->info('Total years wasted: ' . ($data['total_years_wasted'] ?? 'N/A'));
            } else {
                $this->error('Response status: ' . $response->getStatusCode());
            }
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
        }
    }
}
