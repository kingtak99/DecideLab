<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LifeShockController extends Controller
{
    // صفحة حاسبة صدمة الحياة
    public function showLifeShockSimulation($locale)
    {
        $countries = Country::all();
        $currentCountry = $this->getCurrentCountry();

        return view('life-shock.simulation', compact('countries', 'currentCountry', 'locale'));
    }

    // عملية حساب صدمة الحياة
    public function calculateLifeShock(Request $request, $locale)
    {
        Log::info('LifeShockController@calculateLifeShock called');
        try {
            Log::info('Life shock calculation request received', $request->all());

            // Get inputs
            $age = $request->input('age', 25);
            $socialMediaHours = $request->input('social_media_hours', 0);
            $videoHours = $request->input('video_hours', 0);
            $gamingHours = $request->input('gaming_hours', 0);
            $wastingHours = $request->input('wasting_hours', 0);
            $sleepHours = $request->input('sleep_hours', 8);
            $workHours = $request->input('work_hours', 8);
            $workDays = $request->input('work_days', 5);

            // Calculate life expectancy (simplified)
            $lifeExpectancy = 80; // average
            $yearsLeft = max(0, $lifeExpectancy - $age);

            // Daily hours available (24 - sleep)
            $dailyAvailable = 24 - $sleepHours;

            // Weekly working hours
            $weeklyWorkHours = $workHours * $workDays;

            // Effective daily free time (available time minus work)
            $dailyFree = max(0, $dailyAvailable - $weeklyWorkHours / 7);

            // Total wasting hours requested
            $totalWastingRequested = $socialMediaHours + $videoHours + $gamingHours + $wastingHours;

            // If requested wasting exceeds available free time, normalize proportionally
            if ($totalWastingRequested > $dailyFree && $dailyFree > 0) {
                $normalizationFactor = $dailyFree / $totalWastingRequested;
                $socialMediaHours *= $normalizationFactor;
                $videoHours *= $normalizationFactor;
                $gamingHours *= $normalizationFactor;
                $wastingHours *= $normalizationFactor;
            } elseif ($totalWastingRequested > $dailyFree) {
                // If no free time, set all to 0
                $socialMediaHours = 0;
                $videoHours = 0;
                $gamingHours = 0;
                $wastingHours = 0;
            }

            // Calculate years wasted (using actual daily hours, not 24-hour conversion)
            $yearsOnSocial = ($socialMediaHours * 365.25 * $yearsLeft) / 8760; // 365.25 * 24
            $yearsOnVideo = ($videoHours * 365.25 * $yearsLeft) / 8760;
            $yearsOnGaming = ($gamingHours * 365.25 * $yearsLeft) / 8760;
            $yearsWasting = ($wastingHours * 365.25 * $yearsLeft) / 8760;

            $totalYearsWasted = $yearsOnSocial + $yearsOnVideo + $yearsOnGaming + $yearsWasting;

            // Improved scenario (reduce social by 1 hour, add 0.5 hour learning)
            $improvedSocial = max(0, $socialMediaHours - 1);
            $improvedVideo = $videoHours;
            $improvedGaming = $gamingHours;
            $improvedWasting = $wastingHours;

            // Recalculate with improved values
            $improvedTotalRequested = $improvedSocial + $improvedVideo + $improvedGaming + $improvedWasting;
            if ($improvedTotalRequested > $dailyFree && $dailyFree > 0) {
                $normalizationFactor = $dailyFree / $improvedTotalRequested;
                $improvedSocial *= $normalizationFactor;
                $improvedVideo *= $normalizationFactor;
                $improvedGaming *= $normalizationFactor;
                $improvedWasting *= $normalizationFactor;
            }

            $improvedYearsOnSocial = ($improvedSocial * 365.25 * $yearsLeft) / 8760;
            $improvedYearsOnVideo = ($improvedVideo * 365.25 * $yearsLeft) / 8760;
            $improvedYearsOnGaming = ($improvedGaming * 365.25 * $yearsLeft) / 8760;
            $improvedYearsWasting = ($improvedWasting * 365.25 * $yearsLeft) / 8760;
            $improvedTotal = $improvedYearsOnSocial + $improvedYearsOnVideo + $improvedYearsOnGaming + $improvedYearsWasting;
            $yearsSaved = $totalYearsWasted - $improvedTotal;

            return response()->json([
                'success' => true,
                'years_left' => round($yearsLeft, 1),
                'years_on_social' => round($yearsOnSocial, 1),
                'years_on_video' => round($yearsOnVideo, 1),
                'years_on_gaming' => round($yearsOnGaming, 1),
                'years_wasting' => round($yearsWasting, 1),
                'total_years_wasted' => round($totalYearsWasted, 1),
                'total_days_wasted' => round($totalYearsWasted * 365.25),
                'total_hours_wasted' => round($totalYearsWasted * 8760),
                'years_saved' => round($yearsSaved, 1),
                'age' => $age,
            ]);

        } catch (\Exception $e) {
            Log::error('Life shock calculation error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getCurrentCountry()
    {
        $country = null;

        if (Auth::check() && Auth::user()->country) {
            $country = Auth::user()->country;
        } elseif (Session::has('user_country')) {
            $country = Country::find(Session::get('user_country'));
        }

        // If no country set, default to Jordan
        if (!$country) {
            $country = Country::where('code', 'JOR')->first();
        }

        // If still no country, get the first one
        if (!$country) {
            $country = Country::first();
        }

        return $country;
    }
}