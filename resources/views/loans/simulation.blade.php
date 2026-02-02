@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <!-- Glow Effects -->
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-emerald-600/20 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-6 py-20 text-center">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-sm font-medium mb-6">
                    {{-- <span class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></span> --}}
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: #092ac0;"></span>

                    <span>{{ __('messages.loan_simulation_page_title') }}</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    🏦 <span class="text-indigo-400">{{ __('messages.loan_simulation_page_title') }}</span>
                </h1>

                <p class="text-lg text-slate-300 max-w-3xl mx-auto mb-10">
                    {{ __('messages.loan_simulation_subtitle') }}
                </p>

                <a href="#calculator" class="inline-flex items-center gap-2 px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl transition">
                    {{ __('messages.start_simulation') }}
                    <span>←</span>
                </a>
            </div>
        </div>

        <!-- Calculator Section -->
        <div id="calculator" class="min-h-screen flex items-center justify-center px-6 py-20">
            <div class="w-full max-w-6xl">
                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Calculator Form -->
                    <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10">
                        <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.loan_simulation_page_title') }}</h2>

                        <form id="loan-form" class="space-y-6">
                            @csrf

                            <!-- Country Selection (Read-only) -->
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">
                                    🌍 {{ __('messages.country') }}
                                </label>
                                <div class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-slate-400 flex items-center cursor-not-allowed">
                                    @if($currentCountry)
                                        <img src="https://flagcdn.com/{{ strtolower($currentCountry->flag_code) }}.svg" alt="{{ $currentCountry->name }}" class="w-6 h-4 mr-3 rounded">
                                        <span>{{ $currentCountry->name }} ({{ $currentCountry->currency_code }})</span>
                                    @else
                                        <span>{{ __('messages.select_country') }}</span>
                                    @endif
                                </div>
                                <input type="hidden" name="country_id" value="{{ $currentCountry ? $currentCountry->id : '' }}">
                            </div>

                            <!-- Loan Type (Hidden - Always Personal) -->
                            <input type="hidden" id="loan_type" name="loan_type" value="personal">

                            <!-- Finance Model (Read-only - Personal) -->
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">
                                    🕌 {{ __('messages.finance_model') }}
                                </label>
                                <div class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-slate-400 cursor-not-allowed">
                                    {{ __('messages.personal') }}
                                </div>
                                <input type="hidden" name="finance_model" value="conventional">
                            </div>

                            <!-- Loan Amount -->
                            <div>
                                <label for="loan_amount" class="block text-sm font-medium text-slate-300 mb-2">
                                    💰 {{ __('messages.loan_amount') }} (<span id="currency-display">USD</span>)
                                </label>
                                <input type="number" id="loan_amount" name="loan_amount" min="1000" class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="10000">
                            </div>

                            <!-- Duration -->
                            <div>
                                <label for="duration_years" class="block text-sm font-medium text-slate-300 mb-2">
                                    ⏰ {{ __('messages.duration_years') }}
                                </label>
                                <input type="number" id="duration_years" name="duration_years" min="1" max="30" class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="5">
                            </div>

                            <!-- Interest Rate -->
                            <div>
                                <label for="interest_rate" class="block text-sm font-medium text-slate-300 mb-2">
                                    📈 {{ __('messages.interest_rate') }}
                                </label>
                                <input type="number" id="interest_rate" name="interest_rate" step="0.1" min="0" max="50" class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" value="{{ $currentCountry ? $currentCountry->interest_rate : 5.0 }}" placeholder="5.0">
                                <input type="hidden" id="use_custom_rate" name="use_custom_rate" value="0">
                                <div id="custom-rate-note" class="mt-2 text-sm text-indigo-400">
                                    {{ __('messages.custom_rate_help') }}
                                </div>
                                <div id="custom-rate-pending" class="mt-2 text-sm text-amber-400 hidden">
                                    {{ __('messages.custom_rate_pending') }}
                                </div>
                            </div>

                            <!-- Monthly Income -->
                            <div>
                                <label for="monthly_income" class="block text-sm font-medium text-slate-300 mb-2">
                                    💼 {{ __('messages.monthly_income') }} (<span id="currency-display-income">USD</span>)
                                </label>
                                <input type="number" id="monthly_income" name="monthly_income" min="0" step="1" class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="5000">
                                <div id="income-feedback" class="mt-2 text-sm text-indigo-400 hidden">
                                    <!-- Feedback will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Extra Payments -->
                            <div>
                                <label for="extra_payments" class="block text-sm font-medium text-slate-300 mb-2">
                                    ➕ {{ __('messages.extra_payments') }} (<span id="currency-display-extra">USD</span>)
                                </label>
                                <input type="number" id="extra_payments" name="extra_payments" min="0" class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="0">
                            </div>

                            <button type="submit" class="w-full px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl transition">
                                {{ __('messages.calculate') }}
                            </button>
                        </form>
                    </div>

                    <!-- Results Section -->
                    <div id="results-section" class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                        <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.results') }}</h2>

                        <div id="results-content" class="space-y-6">
                            <!-- Results will be populated by JavaScript -->
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-700">
                            <button id="try-again" class="w-full px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                {{ __('messages.try_another_scenario') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loan-form');
            const resultsSection = document.getElementById('results-section');
            const resultsContent = document.getElementById('results-content');
            const tryAgainBtn = document.getElementById('try-again');
            const currencyDisplays = document.querySelectorAll('#currency-display, #currency-display-income, #currency-display-extra');
            const interestRateInput = document.getElementById('interest_rate');
            const monthlyIncomeInput = document.getElementById('monthly_income');
            const incomeFeedback = document.getElementById('income-feedback');

            // Monthly income feedback
            monthlyIncomeInput.addEventListener('input', function() {
                const value = parseFloat(this.value);
                if (value > 0 && value < 1000) {
                    incomeFeedback.textContent = '💡 ' + __('income_feedback_low');
                    incomeFeedback.classList.remove('hidden');
                } else if (value >= 1000 && value < 3000) {
                    incomeFeedback.textContent = '💡 ' + __('income_feedback_moderate');
                    incomeFeedback.classList.remove('hidden');
                } else if (value >= 3000) {
                    incomeFeedback.textContent = '💡 ' + __('income_feedback_good');
                    incomeFeedback.classList.remove('hidden');
                } else {
                    incomeFeedback.classList.add('hidden');
                }
            });

            // Initialize currency displays and interest rate
            const currentCurrency = @json($currentCountry ? $currentCountry->currency_code : "USD");
            const currentRate = @json($currentCountry ? $currentCountry->interest_rate : 5.0);
            currencyDisplays.forEach(display => display.textContent = currentCurrency);
            interestRateInput.value = currentRate;
            const useCustomRateHidden = document.getElementById('use_custom_rate');

            // When user types a custom rate, just set the hidden flag; do NOT auto-submit — user must click Calculate
            interestRateInput.addEventListener('input', function() {
                const val = parseFloat(this.value);
                const pendingEl = document.getElementById('custom-rate-pending');
                if (!isNaN(val) && val >= 0 && val <= 50 && val !== parseFloat(currentRate)) {
                    useCustomRateHidden.value = '1';
                    if (pendingEl) pendingEl.classList.remove('hidden');
                } else {
                    useCustomRateHidden.value = '0';
                    if (pendingEl) pendingEl.classList.add('hidden');
                }
            });

            // Listen for country changes from navbar
            window.addEventListener('countryChanged', function(e) {
                console.log('💰 Loan simulation received countryChanged event:', e.detail);
                const newCountry = e.detail;
                if (newCountry && newCountry.currency_code) {
                    currencyDisplays.forEach(display => display.textContent = newCountry.currency_code);
                }
                if (newCountry && newCountry.interest_rate) {
                    interestRateInput.value = newCountry.interest_rate;
                    useCustomRateHidden.value = '0';
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Ensure use_custom_rate is set based on interest input
                const enteredRate = parseFloat(interestRateInput.value);
                if (!isNaN(enteredRate) && enteredRate >= 0 && enteredRate <= 50 && enteredRate !== parseFloat(currentRate)) {
                    useCustomRateHidden.value = '1';
                } else {
                    useCustomRateHidden.value = '0';
                }

                // If using custom rate, make sure it's valid and present
                if (useCustomRateHidden.value === '1') {
                    if (interestRateInput.value === '' || isNaN(enteredRate)) {
                        alert('{{ __('messages.custom_rate_required') }}');
                        return;
                    }
                }

                const formData = new FormData(this);

                fetch('{{ route("loan.simulation.calculate", ["locale" => $locale]) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    displayResults(data, formData);
                    resultsSection.classList.remove('hidden');
                    resultsSection.scrollIntoView({ behavior: 'smooth' });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });

            // Try another scenario
            tryAgainBtn.addEventListener('click', function() {
                resultsSection.classList.add('hidden');
                form.reset();
            });

            function displayResults(data, formData) {
                const currency = data.currency;

                // Determine payment ratio message and colors based on income percentage
                let paymentRatioMessage = '';
                let zoneBgColor = '';
                let zoneTextColor = '';
                let zoneBorderColor = '';

                if (data.income_percentage <= 20) {
                    paymentRatioMessage = __('payment_ratio_comfortable');
                    zoneBgColor = 'bg-green-900';
                    zoneTextColor = 'text-green-300';
                    zoneBorderColor = 'border-green-500';
                } else if (data.income_percentage <= 30) {
                    paymentRatioMessage = __('payment_ratio_caution');
                    zoneBgColor = 'bg-blue-900';
                    zoneTextColor = 'text-blue-300';
                    zoneBorderColor = 'border-blue-500';
                } else if (data.income_percentage <= 40) {
                    paymentRatioMessage = __('payment_ratio_stress');
                    zoneBgColor = 'bg-yellow-900';
                    zoneTextColor = 'text-yellow-300';
                    zoneBorderColor = 'border-yellow-500';
                } else if (data.income_percentage <= 60) {
                    paymentRatioMessage = __('payment_ratio_high_risk');
                    zoneBgColor = 'bg-orange-900';
                    zoneTextColor = 'text-orange-300';
                    zoneBorderColor = 'border-orange-500';
                } else {
                    paymentRatioMessage = __('payment_ratio_not_feasible');
                    zoneBgColor = 'bg-red-900';
                    zoneTextColor = 'text-red-300';
                    zoneBorderColor = 'border-red-500';
                }

                // Helper functions for localized year/month labels
                function formatYears(n) {
                    n = parseInt(n) || 0;
                    const unit = (n === 1) ? __('year_singular') : __('year_plural');
                    return `${n} ${unit}`;
                }
                function formatMonths(n) {
                    n = parseInt(n) || 0;
                    if (n === 0) return `0 ${__('month_singular')}`; // prefer singular for 0 as per Arabic UX preference
                    const unit = (n === 1) ? __('month_singular') : __('month_plural');
                    return `${n} ${unit}`;
                }

                // Currency localization and formatting helper
                function currencyName(code) {
                    // Localized currency names (add more mappings as needed)
                    const map = {
                        'JOD': { 'ar': 'دينار أردني', 'en': 'JOD' }
                    };
                    const loc = "{{ $locale }}" || 'en';
                    if (map[code] && map[code][loc]) return map[code][loc];
                    return code;
                }

                function formatMoney(value, code) {
                    const num = Number(value) || 0;
                    const loc = "{{ $locale }}" === 'ar' ? 'ar-EG' : 'en-US';
                    const formatted = num.toLocaleString(loc, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    return `${formatted} ${currencyName(code)}`;
                }

                resultsContent.innerHTML = `
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400">${__('total_paid')}</div>
                            <div class="text-2xl font-bold text-white">${formatMoney(data.total_paid, currency)}</div>
                        </div>
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400">${__('total_interest')}</div>
                            <div class="text-2xl font-bold text-red-400">${formatMoney(data.total_interest, currency)}</div>
                        </div>
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400" title="${__('monthly_payment')}">${__('monthly_payment')}</div>
                            <div class="text-2xl font-bold text-indigo-400">${formatMoney(data.monthly_payment, currency)}</div>
                        </div>
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400" title="${__('effective_monthly_payment')}">${__('effective_monthly_payment')}</div>
                            <div class="text-2xl font-bold text-green-400">${formatMoney(data.effective_monthly_payment, currency)}</div>
                        </div>
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400">${__('years_of_life')}</div>
                            <div class="text-2xl font-bold text-yellow-400">${formatYears(data.years_of_life)}</div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="text-sm text-slate-400">{{ __('messages.interest_rate_applied') }}: <span class="text-white font-semibold">${data.interest_rate}%</span> ${data.used_custom_rate ? '({{ __('messages.custom_rate_applied') }})' : '({{ __('messages.default_rate_used') }})'}</div>
                    </div>

                    <div class="mt-6">
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400">${__('income_percentage')}</div>
                            <div class="text-2xl font-bold ${data.income_percentage > 35 ? 'text-red-400' : 'text-green-400'}">${data.income_percentage}%</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="bg-slate-800 p-4 rounded-xl">
                            <div class="text-sm text-slate-400" title="${__('suffocating_months_explanation')}">${__('suffocating_months')}</div>
                            <div class="text-2xl font-bold text-red-400">${formatMonths(data.suffocating_months)}</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-xl font-bold text-white mb-4">${__('insights')}</h3>
                        <div class="space-y-3">
                            <div class="bg-slate-800 p-4 rounded-xl">
                                <div class="text-slate-300">${__('interest_cost_percentage').replace('{percentage}', data.interest_percentage)}</div>
                            </div>
                            <div class="bg-slate-800 p-4 rounded-xl">
                                <div class="text-slate-300">${__('first_year_interest').replace('{percentage}', data.first_year_interest_percentage)}</div>
                            </div>
                            ${data.income_percentage > 0 ? `
                            <div class="bg-slate-800 p-4 rounded-xl border-l-4 ${zoneBorderColor}">
                                <div class="${zoneTextColor} font-semibold">${paymentRatioMessage}</div>
                                <div class="text-xs text-slate-400 mt-2">${__('payment_ratio_thresholds')}</div>
                            </div>
                            ` : ''}
                        </div>
                    </div>

                    <!-- Comparison Section -->
                    <div class="mt-8" id="comparison-section">
                        <h3 class="text-xl font-bold text-white mb-4">${__('comparison_with_extra')}</h3>
                        <div class="text-sm text-slate-400 mb-4">Calculating comparison...</div>
                    </div>
                `;

                // Calculate comparison without extra payments
                if (parseFloat(formData.get('extra_payments')) > 0) {
                    const comparisonFormData = new FormData();
                    comparisonFormData.append('country_id', formData.get('country_id'));
                    comparisonFormData.append('loan_amount', formData.get('loan_amount'));
                    comparisonFormData.append('duration_years', formData.get('duration_years'));
                    comparisonFormData.append('monthly_income', formData.get('monthly_income'));
                    comparisonFormData.append('extra_payments', '0'); // No extra payments
                    comparisonFormData.append('finance_model', formData.get('finance_model'));
                    comparisonFormData.append('interest_rate', formData.get('interest_rate') || '');
                    comparisonFormData.append('use_custom_rate', formData.get('use_custom_rate') || '0');
                    fetch('{{ route("loan.simulation.calculate", ["locale" => $locale]) }}', {
                        method: 'POST',
                        body: comparisonFormData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(comparisonData => {
                        const interestSaved = (comparisonData.total_interest - data.total_interest).toFixed(2);
                        const yearsSaved = comparisonData.years_of_life - data.years_of_life;

                        // Dynamic text for singular/plural
                        const yearText = yearsSaved === 1 ? __('year_saved') : __('years_saved');
                        const yearValue = yearsSaved === 1 ? __('year_singular') : __('year_plural');

                        document.getElementById('comparison-section').innerHTML = `
                            <h3 class="text-xl font-bold text-white mb-4">${__('comparison_with_extra')}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-slate-700 p-4 rounded-xl">
                                    <div class="text-sm text-slate-400">${__('without_extra_payments')}</div>
                                    <div class="text-lg font-semibold text-slate-300">${comparisonData.total_interest} ${currency} ${__('total_interest')}</div>
                                    <div class="text-sm text-slate-400">${formatYears(comparisonData.years_of_life)}</div>
                                </div>
                                <div class="bg-green-900 p-4 rounded-xl">
                                    <div class="text-sm text-green-400">${__('with_extra_payments')}</div>
                                    <div class="text-lg font-semibold text-green-300">${data.total_interest} ${currency} ${__('total_interest')}</div>
                                    <div class="text-sm text-green-400">${formatYears(data.years_of_life)}</div>
                                </div>
                                <div class="bg-blue-900 p-4 rounded-xl">
                                    <div class="text-sm text-blue-400">${__('interest_saved')}: ${interestSaved} ${currency}</div>
                                    <div class="text-lg font-semibold text-blue-300">${yearText}: ${yearsSaved} ${yearValue}</div>
                                </div>
                            </div>
                        `;
                    })
                    .catch(error => {
                        console.error('Comparison calculation failed:', error);
                        document.getElementById('comparison-section').innerHTML = `
                            <h3 class="text-xl font-bold text-white mb-4">${__('comparison_with_extra')}</h3>
                            <div class="text-sm text-red-400">Failed to calculate comparison</div>
                        `;
                    });
                } else {
                    document.getElementById('comparison-section').innerHTML = '';
                }
            }
        });
    </script>

    <script>
        // Translation strings for JavaScript
        const translations = {
            total_paid: "{{ __('messages.total_paid') }}",
            total_interest: "{{ __('messages.total_interest') }}",
            monthly_payment: "{{ __('messages.monthly_payment') }}",
            years_of_life: "{{ __('messages.years_of_life') }}",
            income_percentage: "{{ __('messages.income_percentage') }}",
            suffocating_months: "{{ __('messages.suffocating_months') }}",
            insights: "{{ __('messages.insights') }}",
            interest_cost_percentage: "{{ __('messages.interest_cost_percentage') }}",
            first_year_interest: "{{ __('messages.first_year_interest') }}",
            stress_zone: "{{ __('messages.stress_zone') }}",
            income_feedback_low: "{{ __('messages.income_feedback_low') }}",
            income_feedback_moderate: "{{ __('messages.income_feedback_moderate') }}",
            income_feedback_good: "{{ __('messages.income_feedback_good') }}",
            payment_ratio_comfortable: "{{ __('messages.payment_ratio_comfortable') }}",
            payment_ratio_caution: "{{ __('messages.payment_ratio_caution') }}",
            payment_ratio_stress: "{{ __('messages.payment_ratio_stress') }}",
            payment_ratio_high_risk: "{{ __('messages.payment_ratio_high_risk') }}",
            payment_ratio_not_feasible: "{{ __('messages.payment_ratio_not_feasible') }}",
            payment_ratio_thresholds: "{{ __('messages.payment_ratio_thresholds') }}",
            effective_monthly_payment: "{{ __('messages.effective_monthly_payment') }}",
            comparison_with_extra: "{{ __('messages.comparison_with_extra') }}",
            without_extra_payments: "{{ __('messages.without_extra_payments') }}",
            with_extra_payments: "{{ __('messages.with_extra_payments') }}",
            interest_saved: "{{ __('messages.interest_saved') }}",
            years_saved: "{{ __('messages.years_saved') }}",
            year_saved: "{{ __('messages.year_saved') }}",
            year_singular: "{{ __('messages.year_singular') }}",
            year_plural: "{{ __('messages.year_plural') }}",
            month_singular: "{{ __('messages.month_singular') }}",
            month_plural: "{{ __('messages.month_plural') }}",
            custom_rate_help: "{{ __('messages.custom_rate_help') }}",
            custom_rate_applied: "{{ __('messages.custom_rate_applied') }}",
            default_rate_used: "{{ __('messages.default_rate_used') }}",
            default_rate: "{{ __('messages.default_rate') }}",
            custom_rate_required: "{{ __('messages.custom_rate_required') }}"
        };

        // JavaScript function equivalent to Laravel's __()
        function __(key) {
            return translations[key] || key;
        }
    </script>
@endsection