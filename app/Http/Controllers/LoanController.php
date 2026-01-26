<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\LoanProfile;

class LoanController extends Controller
{
    // صفحة الفورم
    public function showHousingForm($locale)
    {
        $countries = Country::all();
        return view('loans.housing', compact('countries', 'locale'));
    }

    // عملية الحساب
    public function calculateHousingLoan(Request $request, $locale)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'property_value' => 'required|numeric|min:10000',
            'down_payment' => 'required|numeric|min:0|max:50',
            'loan_term' => 'required|integer|min:5|max:30',
            'custom_rate' => 'nullable|numeric|min:0|max:20',
            'monthly_rent' => 'nullable|numeric|min:0',
            'rent_increase_rate' => 'nullable|numeric|min:0|max:10',
            'property_appreciation' => 'nullable|numeric|min:0|max:15',
        ]);

        $country = Country::findOrFail($request->country_id);
        $loanProfile = LoanProfile::where('country_id', $country->id)
                                  ->where('loan_type', 'housing')
                                  ->first();

        if (!$loanProfile) {
            return response()->json([
                'error' => __('messages.no_loan_profile') ?? 'No loan profile available for this country.'
            ], 404);
        }

        $propertyValue = $request->property_value;
        $downPaymentPercent = $request->down_payment;
        $loanYears = $request->loan_term;

        // Calculate loan amount (property value minus down payment)
        $downPaymentAmount = $propertyValue * ($downPaymentPercent / 100);
        $loanAmount = $propertyValue - $downPaymentAmount;

        $interestRate = $request->custom_rate ?? $loanProfile->interest_rate;
        $monthlyRate = $interestRate / 100 / 12;
        $numPayments = $loanYears * 12;

        // Calculate monthly payment
        $monthlyPayment = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $numPayments)) / (pow(1 + $monthlyRate, $numPayments) - 1);

        // Calculate total paid
        $totalPayment = $monthlyPayment * $numPayments;
        $totalInterest = $totalPayment - $loanAmount;

        // Check interest system
        $interestSystem = $loanProfile->interest_system ?? 'compound_monthly';

        if ($interestSystem === 'flat') {
            // Flat rate calculation
            $totalInterest = $loanAmount * ($interestRate / 100) * $loanYears;
            $monthlyPayment = ($loanAmount + $totalInterest) / $numPayments;
            $totalPayment = $monthlyPayment * $numPayments;
        } elseif ($interestSystem === 'apr') {
            // APR calculation (simplified)
            $apr = $interestRate;
            $monthlyRate = $apr / 100 / 12;
            $monthlyPayment = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $numPayments)) / (pow(1 + $monthlyRate, $numPayments) - 1);
            $totalPayment = $monthlyPayment * $numPayments;
            $totalInterest = $totalPayment - $loanAmount;
        } else {
            // Default compound monthly
        }

        // Calculate rent vs buy analysis if rent data is provided
        $rentVsBuyAnalysis = null;
        $recommendation = null;

        if ($request->has(['monthly_rent', 'rent_increase_rate', 'property_appreciation'])) {
            $rentVsBuyAnalysis = $this->calculateRentVsBuy(
                $propertyValue,
                $downPaymentAmount,
                $monthlyPayment,
                $loanYears,
                $request->monthly_rent,
                $request->rent_increase_rate / 100,
                $request->property_appreciation / 100
            );

            $recommendation = $rentVsBuyAnalysis['net_buying_cost'] < $rentVsBuyAnalysis['total_renting_cost']
                ? __('messages.recommend_buying') ?? 'Buying is recommended, Renting isn\'t recommended'
                : __('messages.recommend_renting') ?? 'Renting is recommended, Buying isn\'t recommended';
        }

        return response()->json([
            'monthly_payment' => round($monthlyPayment, 2),
            'total_payment' => round($totalPayment, 2),
            'loan_amount' => round($loanAmount, 2),
            'down_payment_amount' => round($downPaymentAmount, 2),
            'total_interest' => round($totalPayment - $loanAmount, 2),
            'currency' => $country->currency_code,
            'interest_rate' => $interestRate,
            'interest_system' => $this->getInterestSystemName($loanProfile->interest_system),
            'property_value' => $propertyValue,
            'down_payment' => $downPaymentPercent,
            'loan_term' => $loanYears,
            'rent_vs_buy' => $rentVsBuyAnalysis,
            'recommendation' => $recommendation
        ]);
    }

    private function getInterestSystemName($system)
    {
        $names = [
            'flat' => __('messages.flat_rate') ?? 'Flat Rate',
            'compound_monthly' => __('messages.compound_monthly') ?? 'Compound Monthly',
            'apr' => __('messages.apr') ?? 'APR'
        ];

        return $names[$system] ?? $system;
    }

    private function calculateRentVsBuy($propertyValue, $downPayment, $monthlyMortgage, $loanYears, $monthlyRent, $rentIncreaseRate, $propertyAppreciation)
    {
        $totalMonths = $loanYears * 12;

        // Buying costs
        $totalMortgagePayments = $monthlyMortgage * $totalMonths;
        $totalBuyingCost = $downPayment + $totalMortgagePayments;

        // Renting costs
        $totalRentingCost = 0;
        $currentRent = $monthlyRent;

        for ($month = 1; $month <= $totalMonths; $month++) {
            $totalRentingCost += $currentRent;

            // Increase rent annually
            if ($month % 12 === 0) {
                $currentRent *= (1 + $rentIncreaseRate);
            }
        }

        // Property appreciation
        $futurePropertyValue = $propertyValue * pow(1 + $propertyAppreciation, $loanYears);

        // Net buying cost (after appreciation)
        $netBuyingCost = $totalBuyingCost - ($futurePropertyValue - $propertyValue);

        // Renting also includes opportunity cost of down payment (assuming 4% annual return)
        $opportunityCost = $downPayment * pow(1.04, $loanYears);
        $totalRentingCost += $opportunityCost;

        return [
            'total_buying_cost' => round($totalBuyingCost, 2),
            'net_buying_cost' => round($netBuyingCost, 2),
            'future_property_value' => round($futurePropertyValue, 2),
            'total_renting_cost' => round($totalRentingCost, 2),
            'opportunity_cost' => round($opportunityCost, 2),
            'cost_difference' => round($totalRentingCost - $totalBuyingCost, 2)
        ];
    }
}
