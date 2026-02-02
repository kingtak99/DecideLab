<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoanSimulationController extends Controller
{
    // صفحة محاكاة القرض العامة
    public function showLoanSimulation($locale)
    {
        $countries = Country::all();
        $currentCountry = $this->getCurrentCountry();

        return view('loans.simulation', compact('countries', 'currentCountry', 'locale'));
    }

    // عملية حساب محاكاة القرض
    public function calculateLoan(Request $request, $locale)
    {
        try {
            $request->validate([
                'country_id' => 'nullable|exists:countries,id',
                'loan_amount' => 'required|numeric|min:1000',
                'duration_years' => 'required|integer|min:1|max:30',
                'interest_rate' => 'nullable|numeric|min:0|max:50',
                'monthly_income' => 'nullable|numeric|min:0',
                'extra_payments' => 'nullable|numeric|min:0',
                'loan_type' => 'nullable|in:personal,car,home,business,credit_card',
                'finance_model' => 'nullable|in:conventional,murabaha',
            ]);

            // Get country from request or current location
            $countryId = $request->country_id ?: $this->getCurrentCountry()->id;
            $country = Country::findOrFail($countryId);
            $loanAmount = $request->loan_amount;
            $durationYears = $request->duration_years;

            // Determine whether a custom interest rate was provided (typed value overrides default)
            $hasCustomValue = $request->filled('interest_rate') && is_numeric($request->interest_rate);
            $usedCustomRate = $hasCustomValue;
            $interestRate = $hasCustomValue ? $request->interest_rate : $country->interest_rate;
            $interestRateSource = $hasCustomValue ? 'custom' : 'default';

            $monthlyIncome = $request->monthly_income ?? 0;
            $extraPayments = $request->extra_payments ?? 0;
            $loanType = $request->loan_type ?? 'personal'; // Always default to personal
            $financeModel = $request->finance_model ?? 'conventional';

            // Adjust interest rate for Murabaha (profit rate)
            if ($financeModel === 'murabaha') {
                $interestRate = $interestRate * 0.8; // Typically lower for Islamic finance
            }

            $monthlyRate = $interestRate / 100 / 12;
            $numPayments = $durationYears * 12;

            // Debug log: inputs and computed rates
            Log::debug('LoanSimulation: inputs and rate', [
                'request_interest' => $request->interest_rate ?? null,
                'hasCustomValue' => $hasCustomValue,
                'interestRateUsed' => $interestRate,
                'monthlyRate' => $monthlyRate,
                'loanAmount' => $loanAmount,
                'durationYears' => $durationYears,
            ]);

            // Calculate monthly payment (base payment without extra payments)
            if ($monthlyRate > 0) {
                $denominator = pow(1 + $monthlyRate, $numPayments) - 1;
                if ($denominator == 0) {
                    throw new \Exception('Invalid calculation: denominator is zero');
                }
                $monthlyPayment = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $numPayments)) / $denominator;
            } else {
                $monthlyPayment = $loanAmount / $numPayments;
            }

            // Calculate actual loan amortization with extra payments
            $totalPaid = 0;
            $totalInterest = 0;
            $remainingLoan = $loanAmount;
            $actualMonths = 0;
            $monthlyPaymentWithExtra = $monthlyPayment + $extraPayments;

            while ($remainingLoan > 0 && $actualMonths < $numPayments * 2) { // Safety limit
                $actualMonths++;

                // Calculate interest for this month
                $interestPayment = $remainingLoan * $monthlyRate;
                $totalInterest += $interestPayment;

                // Apply payment (base payment + extra payment)
                $principalPayment = min($monthlyPaymentWithExtra, $remainingLoan + $interestPayment);
                $remainingLoan -= ($principalPayment - $interestPayment);

                // Add to total paid
                $totalPaid += $principalPayment;

                // If loan is paid off, break
                if ($remainingLoan <= 0) {
                    break;
                }
            }

            // If loan not paid off within original term, continue with base payment only
            if ($remainingLoan > 0) {
                while ($remainingLoan > 0 && $actualMonths < $numPayments * 3) { // Extended safety limit
                    $actualMonths++;

                    $interestPayment = $remainingLoan * $monthlyRate;
                    $totalInterest += $interestPayment;

                    $principalPayment = min($monthlyPayment, $remainingLoan + $interestPayment);
                    $remainingLoan -= ($principalPayment - $interestPayment);
                    $totalPaid += $principalPayment;

                    if ($remainingLoan <= 0) {
                        break;
                    }
                }
            }

            // Calculate effective monthly payment and years
            $effectiveMonthlyPayment = $actualMonths > 0 ? $totalPaid / $actualMonths : 0;
            $yearsOfLife = ceil($actualMonths / 12);

            // Percentage of income (use effective monthly payment)
            $incomePercentage = $monthlyIncome > 0 ? ($effectiveMonthlyPayment / $monthlyIncome) * 100 : 0;

            // Months financially suffocating (now: >=45% of income considered suffocating; 30-40% is stressful)
            $suffocatingMonths = $incomePercentage >= 45 ? $actualMonths : 0;

            // Insights
            $interestPercentage = $loanAmount > 0 ? ($totalInterest / $loanAmount) * 100 : 0;

            // Calculate first year interest with extra payments
            $firstYearInterest = 0;
            $remainingLoanForFirstYear = $loanAmount;
            $firstYearPayments = 0;

            for ($month = 1; $month <= 12 && $remainingLoanForFirstYear > 0; $month++) {
                $interestPayment = $remainingLoanForFirstYear * $monthlyRate;
                $firstYearInterest += $interestPayment;

                // Apply payment (base + extra)
                $totalPaymentThisMonth = $monthlyPayment + $extraPayments;
                $principalPayment = min($totalPaymentThisMonth - $interestPayment, $remainingLoanForFirstYear);
                $remainingLoanForFirstYear -= $principalPayment;
                $firstYearPayments += $totalPaymentThisMonth;
            }

            $firstYearInterestPercentage = $firstYearPayments > 0 ? ($firstYearInterest / $firstYearPayments) * 100 : 0;

            // Log final outputs for debugging
            Log::debug('LoanSimulation: final results', [
                'interestRateUsed' => $interestRate,
                'monthly_payment' => round($monthlyPayment, 2),
                'total_interest' => round($totalInterest, 2),
                'total_paid' => round($totalPaid, 2),
                'used_custom_rate' => $usedCustomRate,
            ]);

            return response()->json([
                'total_paid' => round($totalPaid, 2),
                'total_interest' => round($totalInterest, 2),
                'monthly_payment' => round($monthlyPayment, 2),
                'effective_monthly_payment' => round($monthlyPayment + $extraPayments, 2),
                'years_of_life' => $yearsOfLife,
                'income_percentage' => round($incomePercentage, 1),
                'suffocating_months' => $suffocatingMonths,
                'interest_percentage' => round($interestPercentage, 1),
                'first_year_interest_percentage' => round($firstYearInterestPercentage, 1),
                'currency' => $country->currency_code,
                'interest_rate' => round($interestRate, 2),
                'used_custom_rate' => $usedCustomRate,
                'interest_rate_source' => $interestRateSource,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in loan calculation', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            return response()->json([
                'error' => 'Validation failed: ' . json_encode($e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Loan calculation error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json([
                'error' => 'An error occurred while calculating the loan. Please check your inputs and try again.'
            ], 400);
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

        return $country;
    }
}
