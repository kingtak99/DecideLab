<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'code',
        'flag_code',
        'currency_code',
        'currency_name_en',
        'currency_name_ar',
        'is_active',
        'interest_rate',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function loanProfiles()
    {
        return $this->hasMany(LoanProfile::class);
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' ? $this->name_ar : $this->name_en;
    }
}
