<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'user_id',
        'visited_at',
    ];

    protected $dates = ['visited_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
