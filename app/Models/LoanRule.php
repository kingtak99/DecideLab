<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRule extends Model
{
    protected $fillable = [
        'country_id', 'default_interest_rate', 'max_interest_rate', 'max_installment_ratio'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
