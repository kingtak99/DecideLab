<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class JobChangeController extends Controller
{
    // صفحة محاكاة تغيير الوظيفة
    public function showJobChangeSimulation($locale)
    {
        $countries = Country::all();
        $currentCountry = $this->getCurrentCountry();

        return view('job-change.simulation', compact('countries', 'currentCountry', 'locale'));
    }

    // عملية حساب محاكاة تغيير الوظيفة
    public function calculateJobChange(Request $request, $locale)
    {
        Log::info('JobChangeController@calculateJobChange called');
        try {
            Log::info('Job change calculation request received', $request->all());

            // Get inputs
            $currentSalary = $request->input('current_salary', 0);
            $currentHours = $request->input('current_hours', 8);
            $currentStress = $request->input('current_stress', 5);
            $newSalary = $request->input('new_salary', 0);
            $newHours = $request->input('new_hours', 8);
            $newStress = $request->input('new_stress', 5);
            $contractType = $request->input('new_contract', 'permanent');
            $sleepLess = $request->input('sleep_less') == '1';
            $familyTimeLess = $request->input('family_time_decrease') == '1';
            $burnoutRisk = $request->input('burnout_risk') == '1';
            $learningDifficulty = $request->input('learning_difficulty', 5);
            $quitProbability = $request->input('quit_probability', 0);

            // Get country and currency
            $country = $this->getCurrentCountry();
            $currency = $country ? $country->currency_code : 'USD';

            // Calculate weekly hours (assuming 5 work days)
            $currentWeeklyHours = $currentHours * 5;
            $newWeeklyHours = $newHours * 5;

            // Calculate hourly rates (monthly salary / (weekly hours * 4.3 weeks per month))
            $currentHourlyRate = $currentSalary > 0 && $currentWeeklyHours > 0 ? $currentSalary / ($currentWeeklyHours * 4.3) : 0;
            $newHourlyRate = $newSalary > 0 && $newWeeklyHours > 0 ? $newSalary / ($newWeeklyHours * 4.3) : 0;

            // Calculate percentages
            $salaryIncrease = $currentSalary > 0 ? (($newSalary - $currentSalary) / $currentSalary) * 100 : 0;
            $hourlyRateChange = $currentHourlyRate > 0 ? (($newHourlyRate - $currentHourlyRate) / $currentHourlyRate) * 100 : 0;
            $stressIncrease = $currentStress > 0 ? (($newStress - $currentStress) / $currentStress) * 100 : 0;

            // Calculate time change per year (assuming 50 weeks per year)
            $timeChangeHoursYear = ($newWeeklyHours - $currentWeeklyHours) * 50;

            // Calculate risk score (improved logic)
            $riskScore = 50; // base

            // Salary impact
            if ($salaryIncrease < 5) $riskScore += 15; // low salary gain
            elseif ($salaryIncrease > 20) $riskScore -= 10; // high gain

            // Stress impact - bonus for improvement
            if ($stressIncrease < -50) $riskScore -= 20; // major stress reduction
            elseif ($stressIncrease < -20) $riskScore -= 10; // good stress reduction
            elseif ($stressIncrease > 20) $riskScore += 10; // stress increase

            // Time impact
            if ($timeChangeHoursYear > 50) $riskScore += 10;
            elseif ($timeChangeHoursYear < -10) $riskScore -= 5; // time reduction

            // Contract impact - less penalty if stress improves
            $contractPenalty = 25;
            if ($stressIncrease < -30) $contractPenalty = 15; // reduced penalty for stress improvement
            if ($contractType !== 'permanent') $riskScore += $contractPenalty;

            // Hidden costs
            if ($sleepLess) $riskScore += 8;
            if ($familyTimeLess) $riskScore += 12;
            if ($burnoutRisk) $riskScore += 15;
            $riskScore += $learningDifficulty * 1.5; // reduced weight
            $riskScore += $quitProbability * 0.3; // reduced weight

            $riskScore = min(100, max(0, $riskScore));

            // Determine decision with more nuance
            $decision = 'worth_it';
            if ($riskScore > 75) {
                if ($stressIncrease < -40 && $contractType !== 'permanent') {
                    $decision = 'risky'; // override for major stress reduction
                } else {
                    $decision = 'not_worth_it';
                }
            } elseif ($riskScore > 50) {
                $decision = 'risky';
            }
            // Keep worth_it if risk <=50 or major stress improvement

            return response()->json([
                'success' => true,
                'currency' => $currency,
                'current' => [
                    'hourly_rate' => round($currentHourlyRate, 2),
                    'total_hours_week' => $currentWeeklyHours,
                    'stress' => $currentStress,
                ],
                'new' => [
                    'hourly_rate' => round($newHourlyRate, 2),
                    'total_hours_week' => $newWeeklyHours,
                    'stress' => $newStress,
                ],
                'comparison' => [
                    'salary_increase' => round($salaryIncrease, 1),
                    'hourly_rate_change' => round($hourlyRateChange, 1),
                    'stress_increase' => round($stressIncrease, 1),
                    'time_change_hours_year' => round($timeChangeHoursYear, 0),
                ],
                'risk_score' => round($riskScore, 0),
                'decision' => $decision,
                'contract_type' => $contractType,
                'hidden_costs' => [
                    'sleep_less' => $sleepLess,
                    'family_time_less' => $familyTimeLess,
                    'burnout_risk' => $burnoutRisk,
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Job change calculation error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Test error: ' . $e->getMessage()
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