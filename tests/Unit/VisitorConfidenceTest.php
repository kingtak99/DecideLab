<?php

use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

uses(Tests\TestCase::class);

it('calculates scroll without duration', function () {
    $v = new Visitor([
        'ip_address' => '1.2.3.4',
        'user_agent' => 'TestAgent',
        'visited_at' => now(),
        'session_duration' => 0,
        'page_views' => 1,
        'has_scroll' => true,
        'is_bot' => false,
    ]);

    $score = $v->recalculateConfidence(false);

    expect($score)->toBe(15);
});

it('calculates duration without scroll', function () {
    $v = new Visitor([
        'ip_address' => '1.2.3.5',
        'user_agent' => 'TestAgent',
        'visited_at' => now(),
        'session_duration' => 40,
        'page_views' => 1,
        'has_scroll' => false,
        'is_bot' => false,
    ]);

    $score = $v->recalculateConfidence(false);

    expect($score)->toBe(20);
});

it('bounds negative scores to zero for bots', function () {
    $v = new Visitor([
        'ip_address' => '1.2.3.6',
        'user_agent' => 'BadBot',
        'visited_at' => now(),
        'session_duration' => 0,
        'page_views' => 1,
        'has_scroll' => false,
        'is_bot' => true,
    ]);

    $score = $v->recalculateConfidence(false);

    expect($score)->toBe(0);
});

it('returns engaged-level score when combined signals are high', function () {
    $v = new Visitor([
        'ip_address' => '1.2.3.7',
        'user_agent' => 'SocialAgent',
        'visited_at' => now(),
        'session_duration' => 100,
        'page_views' => 3,
        'has_scroll' => true,
        'is_social' => true,
        'user_id' => 1,
        'is_bot' => false,
    ]);

    $score = $v->recalculateConfidence(false);

    expect($score)->toBeGreaterThanOrEqual(75);
});
