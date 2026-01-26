<?php

namespace Database\Seeders;

use App\Models\LoanProfile;
use App\Models\Country;
use Illuminate\Database\Seeder;

class LoanProfilesSeeder extends Seeder
{
    public function run(): void
    {
        // قواعد افتراضية حسب المنطقة (تقديرية)
        $defaultInterest = [
            'Middle East' => ['system' => 'flat', 'rate' => 6.5],
            'Europe' => ['system' => 'compound_monthly', 'rate' => 4.5],
            'Asia' => ['system' => 'apr', 'rate' => 5.5],
            'America' => ['system' => 'apr', 'rate' => 5.0],
        ];

        $countries = Country::all();

        foreach ($countries as $country) {

            // تحديد المنطقة تبسيطية
            $continent = 'Europe'; // Default
            if (in_array($country->code, ['JOR','ARE','SAU','EGY','LBN','KWT','QAT','BHR','OMN','IRQ','SYR','PSE','YEM'])) {
                $continent = 'Middle East';
            } elseif (in_array($country->code, ['IND','PAK','IRN'])) {
                $continent = 'Asia';
            } elseif (in_array($country->code, ['USA','CAN','AUS'])) {
                $continent = 'America';
            }

            $profile = $defaultInterest[$continent];

            LoanProfile::create([
                'country_id' => $country->id,
                'loan_type' => 'housing',
                'interest_system' => $profile['system'],
                'interest_rate' => $profile['rate'],
                'min_years' => 1,
                'max_years' => 30,
                'processing_fee' => 0,
            ]);
        }
    }
}
