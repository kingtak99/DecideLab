<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorStatsSnapshot extends Model
{
    protected $table = 'visitor_stats_snapshots';

    protected $fillable = [
        'period_start',
        'period_end',
        'total',
        'human',
        'trusted',
        'social',
        'unique_visitors_human',
        'trusted_ratio',
        'social_ratio',
    ];

    protected $casts = [
        'period_start' => 'datetime',
        'period_end' => 'datetime',
        'total' => 'integer',
        'human' => 'integer',
        'trusted' => 'integer',
        'social' => 'integer',
        'unique_visitors_human' => 'integer',
        'trusted_ratio' => 'decimal:2',
        'social_ratio' => 'decimal:2',
    ];
}
