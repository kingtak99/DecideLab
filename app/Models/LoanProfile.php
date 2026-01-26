<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'loan_type',
        'interest_system',
        'interest_rate',
        'min_years',
        'max_years',
        'processing_fee'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
