<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'country_id', 'code', 'symbol', 'name_en', 'name_ar', 'rate_to_usd'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
