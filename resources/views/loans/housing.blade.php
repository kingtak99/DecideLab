@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <!-- Glow Effects -->
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-emerald-600/20 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-6 py-20 text-center">
                <div
                    class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium mb-6">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span data-key="housing-title">{!! __('messages.housing_title') !!}</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    🏠 <span data-key="housing-calculator-title">{!! __('messages.housing_calculator_title') ?? 'Housing Decision Calculator' !!}</span>
                    <span class="text-emerald-400 block mt-2 text-3xl md:text-4xl">
                        <span data-key="housing-calculator-subtitle">{!! __('messages.housing_calculator_subtitle') ?? 'Rent vs Buy Analysis' !!}</span>
                    </span>
                </h1>

                <p class="text-lg text-slate-300 max-w-3xl mx-auto mb-10">
                    {!! __('messages.housing_description') !!}
                </p>
            </div>
        </div>

        <!-- Calculator Section -->
        <div class="min-h-screen flex items-center justify-center px-6 py-20">
            <div class="w-full max-w-4xl">
                <!-- Calculator Card -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10">
                    <h2 class="text-2xl font-bold mb-6 text-white text-center">
                        {{ __('messages.housing_calculator_title') ?? 'Housing Loan Calculator' }}</h2>

                    <div class="grid lg:grid-cols-2 gap-12">
                        <!-- Calculator Form -->
                        <div>
                            <form id="housing-form" class="space-y-6">
                                @csrf

                                <!-- Country Selection -->
                                <div>
                                    <label for="country_id" class="block text-sm font-medium text-slate-300 mb-2">
                                        🌍 <span data-key="country">{{ __('messages.country') ?? 'Country' }}</span>
                                    </label>
                                    <input type="hidden" name="country_id" id="country_id_hidden">
                                    <input type="hidden" name="use_custom_rate" id="use_custom_rate_hidden" value="0">
                                    <select id="country_id" name="country_id_display"
                                        class="housing-input w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 transition-all duration-300"
                                        disabled
                                        title="{{ app()->getLocale() === 'ar' ? 'يمكنك تغيير الدولة من شريط التنقل' : 'You can change the country from the navbar' }}">
                                        <option value="" data-key="select-country">
                                            {{ __('messages.select_country') ?? 'Select Country' }}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                data-currency="{{ $country->currency_code }}"
                                                data-currency-name-en="{{ $country->currency_name_en }}"
                                                data-currency-name-ar="{{ $country->currency_name_ar }}"
                                                data-name-en="{{ $country->name_en }}"
                                                data-name-ar="{{ $country->name_ar }}"
                                                data-interest-rate="{{ $country->loanProfiles->where('loan_type', 'housing')->first()?->interest_rate ?? 5 }}"
                                                data-interest-system="{{ $country->loanProfiles->where('loan_type', 'housing')->first()?->interest_system ?? 'flat' }}"
                                                data-min-years="{{ $country->loanProfiles->where('loan_type', 'housing')->first()?->min_years ?? 5 }}"
                                                data-max-years="{{ $country->loanProfiles->where('loan_type', 'housing')->first()?->max_years ?? 30 }}">
                                                {{ app()->getLocale() === 'ar' ? $country->name_ar : $country->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="mt-2 text-xs text-slate-400 text-center">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ app()->getLocale() === 'ar' ? 'يمكنك تغيير الدولة من شريط التنقل' : 'You can change the country from the navbar' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Property Value -->
                                <div>
                                    <label for="property_value" class="block text-sm font-medium text-slate-300 mb-2">
                                        🏠 <span
                                            data-key="property-value">{{ __('messages.property_value') ?? 'Property Value' }}</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="property_value" name="property_value"
                                            class="housing-input w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 hover:border-slate-600 pr-16"
                                            placeholder="500,000" inputmode="numeric">
                                        <span id="currency-symbol"
                                            class="absolute right-3 top-3 text-slate-400 font-medium">$</span>
                                    </div>
                                    <div class="mt-1 flex justify-between items-center">
                                        <span class="text-xs text-slate-400" data-key="enter-numbers-only">
                                            {{ __('messages.enter_numbers_only') ?? 'Enter numbers only (Arabic or English numerals supported)' }}
                                        </span>
                                        <span id="currency-info" class="text-xs text-emerald-400 font-medium"></span>
                                    </div>
                                </div>

                                <!-- Down Payment -->
                                <div>
                                    <label for="down_payment_percent" class="block text-sm font-medium text-slate-300 mb-2">
                                        💰 <span
                                            data-key="down-payment">{{ __('messages.down_payment') ?? 'Down Payment' }}</span>
                                        (%)
                                    </label>
                                    <input type="text" id="down_payment_percent" name="down_payment"
                                        class="housing-input w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 hover:border-slate-600"
                                        value="20" inputmode="numeric">
                                    <div class="mt-2 text-sm text-slate-400">
                                        <span
                                            data-key="actual-amount">{{ __('messages.actual_amount') ?? 'Actual Amount' }}</span>:
                                        <span id="down-payment-amount">$0</span>
                                    </div>
                                </div>

                                <!-- Loan Term -->
                                <div>
                                    <label for="loan_years" class="block text-sm font-medium text-slate-300 mb-2">
                                        📅 <span data-key="loan-term">{{ __('messages.loan_term') ?? 'Loan Term' }}</span>
                                        (<span data-key="years">{{ __('messages.years') ?? 'Years' }}</span>)
                                    </label>
                                    <input type="text" id="loan_years" name="loan_term"
                                        class="housing-input w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 hover:border-slate-600"
                                        value="25" inputmode="numeric">
                                    <div class="mt-1 text-xs text-slate-400">
                                        <span data-key="range">{{ __('messages.range') ?? 'Range' }}</span>: <span
                                            id="loan-term-range-numbers">5-30</span> <span
                                            data-key="years">{{ __('messages.years') ?? 'years' }}</span>
                                    </div>
                                </div>

                                <!-- Interest Rate Override (Optional) -->
                                <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700/50">
                                    <label for="custom_rate"
                                        class="flex items-center text-sm font-medium text-slate-300 mb-3">
                                        <input type="checkbox" id="use_custom_rate" class="mr-2 accent-emerald-500">
                                        📊 <span
                                            data-key="custom-interest-rate">{{ __('messages.custom_interest_rate') ?? 'Use Custom Interest Rate' }}</span>
                                    </label>
                                    <div class="mb-3 p-2 bg-slate-700/30 rounded-lg border border-slate-600/30">
                                        <div class="text-xs text-slate-400 mb-1">
                                            {{ __('messages.default_rate') ?? 'Default Rate' }}</div>
                                        <div class="text-sm font-semibold text-emerald-400" id="default-rate-display">5%
                                        </div>
                                    </div>
                                    <input type="number" id="custom_rate" name="custom_rate"
                                        class="housing-input w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 hover:border-slate-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                        placeholder="4.5" min="1" max="20" inputmode="decimal">
                                    <div class="mt-2 text-xs text-slate-400" data-key="override-default-rate">
                                        {{ __('messages.override_default_rate') ?? 'Override the default interest rate for this country' }}
                                    </div>
                                    <div id="custom-rate-note" class="mt-1 text-xs text-emerald-400">
                                        {{ __('messages.custom_rate_help') ?? 'Leave empty to use the default rate for the selected country. Provide a value to override and use a custom interest rate in calculations.' }}
                                    </div>
                                </div>

                                <!-- Calculate Button -->
                                <button type="submit" id="calculate-btn"
                                    class="w-full bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span data-key="calculate">{{ __('messages.calculate') ?? 'Calculate' }}</span>
                                    </span>
                                </button>
                            </form>
                        </div>

                        <!-- Results Section -->
                        <div class="space-y-6">
                            <!-- Loan Results -->
                            <div id="loan-results"
                                class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                                <h3 class="text-xl font-bold mb-6 text-white flex items-center gap-2">
                                    <span class="w-3 h-3 bg-emerald-400 rounded-full"></span>
                                    <span
                                        data-key="loan-details">{{ __('messages.loan_details') ?? 'Loan Details' }}</span>
                                </h3>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="bg-slate-800/50 rounded-xl p-4">
                                        <div class="text-sm text-slate-400 mb-1" data-key="monthly-payment">
                                            {{ __('messages.monthly_payment') ?? 'Monthly Payment' }}</div>
                                        <div class="text-2xl font-bold text-emerald-400" id="monthly-payment">$0</div>
                                    </div>

                                    <div class="bg-slate-800/50 rounded-xl p-4">
                                        <div class="text-sm text-slate-400 mb-1" data-key="total-payment">
                                            {{ __('messages.total_payment') ?? 'Total Payment' }}</div>
                                        <div class="text-2xl font-bold text-blue-400" id="total-payment">$0</div>
                                    </div>

                                    <div class="bg-slate-800/50 rounded-xl p-4">
                                        <div class="text-sm text-slate-400 mb-1" data-key="interest-rate">
                                            {{ __('messages.interest_rate') ?? 'Interest Rate' }}</div>
                                        <div class="text-2xl font-bold text-purple-400" id="interest-rate">0%</div>
                                        <div id="interest-rate-note" class="text-xs text-slate-400 mt-1"></div>
                                    </div>

                                    <div class="bg-slate-800/50 rounded-xl p-4">
                                        <div class="text-sm text-slate-400 mb-1" data-key="loan-amount">
                                            {{ __('messages.loan_amount') ?? 'Loan Amount' }}</div>
                                        <div class="text-2xl font-bold text-orange-400" id="loan-amount">$0</div>
                                    </div>
                                </div>

                                <div class="mt-6 p-4 bg-slate-800/30 rounded-xl">
                                    <div class="text-sm text-slate-400 mb-2" data-key="interest-system">
                                        {{ __('messages.interest_system') ?? 'Interest System' }}</div>
                                    <div class="text-lg font-semibold text-white" id="interest-system"
                                        title="{{ __('messages.flat_rate_tooltip') ?? 'Flat rate interest is calculated on the original loan amount.' }}">
                                        -</div>
                                </div>
                            </div>

                            <!-- Rent vs Buy Comparison -->
                            <div id="comparison-results"
                                class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                                <h3 class="text-xl font-bold mb-6 text-white flex items-center gap-2">
                                    <span class="w-3 h-3 bg-blue-400 rounded-full"></span>
                                    <span
                                        data-key="rent-vs-buy">{{ __('messages.rent_vs_buy') ?? 'Rent vs Buy Analysis' }}</span>
                                </h3>

                                <div class="mb-4 p-3 bg-slate-800/30 rounded-lg border border-slate-700/50">
                                    <p class="text-xs text-slate-400 text-center">
                                        {{ __('messages.rent_vs_buy_assumptions') ?? 'Assumes constant rent, 3% annual property appreciation, and no maintenance costs.' }}
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex justify-between items-center p-4 bg-slate-800/50 rounded-xl">
                                        <span
                                            class="text-slate-300">{{ __('messages.monthly_rent') ?? 'Monthly Rent' }}</span>
                                        <input type="number" id="monthly-rent"
                                            class="w-24 px-3 py-1 bg-slate-700 border border-slate-600 rounded text-white text-center"
                                            placeholder="500" min="0">
                                    </div>

                                    <div class="flex justify-between items-center p-4 bg-slate-800/50 rounded-xl">
                                        <span
                                            class="text-slate-300">{{ __('messages.yearly_appreciation') ?? 'Yearly Appreciation' }}
                                            (%)</span>
                                        <input type="number" id="appreciation-rate"
                                            class="w-24 px-3 py-1 bg-slate-700 border border-slate-600 rounded text-white text-center"
                                            value="3" step="0.1">
                                    </div>

                                    <button id="compare-btn"
                                        class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold py-3 px-6 rounded-xl transition-all duration-200">
                                        {{ __('messages.compare_options') ?? 'Compare Options' }}
                                    </button>
                                </div>

                                <div id="comparison-output" class="mt-6 space-y-4 hidden">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-green-500/10 border border-green-500/20 rounded-xl p-4">
                                            <div class="text-sm text-green-400 mb-1"
                                                title="Net cost after property appreciation">
                                                {{ __('messages.buying_cost') ?? 'Buying Cost' }}</div>
                                            <div class="text-xl font-bold text-green-400" id="buying-cost">$0</div>
                                            <div class="text-xs text-green-300/70 mt-1">Net cost after appreciation</div>
                                            <div class="text-xs text-green-300/50 mt-1 italic">
                                                {{ __('messages.buying_cost_explanation') ?? 'Buying cost accounts for estimated property value after 25 years of appreciation.' }}
                                            </div>
                                        </div>
                                        <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-4">
                                            <div class="text-sm text-blue-400 mb-1">
                                                {{ __('messages.renting_cost') ?? 'Renting Cost' }}</div>
                                            <div class="text-xl font-bold text-blue-400" id="renting-cost">$0</div>
                                        </div>
                                    </div>

                                    <div class="bg-slate-800/50 rounded-xl p-4">
                                        <div class="text-sm text-slate-400 mb-2">
                                            {{ __('messages.recommendation') ?? 'Recommendation' }}</div>
                                        <div class="text-lg font-semibold text-white" id="recommendation">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Loading State -->
                            <div id="loading-state"
                                class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                                <div class="flex items-center justify-center py-12">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-emerald-400"></div>
                                    <span
                                        class="ml-3 text-slate-300">{{ __('messages.calculating') ?? 'Calculating...' }}</span>
                                </div>
                            </div>

                            <!-- Error State -->
                            <div id="error-state"
                                class="bg-red-500/10 backdrop-blur-sm rounded-3xl p-8 border border-red-500/20 hidden">
                                <div class="flex items-center gap-3 text-red-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span
                                        id="error-message">{{ __('messages.calculation_error') ?? 'Error calculating results. Please try again.' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pass translations to JavaScript
                const translations = <?php echo json_encode([
                    'country' => __('messages.country'),
                    'select_country' => __('messages.select_country'),
                    'property_value' => __('messages.property_value'),
                    'enter_numbers_only' => __('messages.enter_numbers_only'),
                    'down_payment' => __('messages.down_payment'),
                    'actual_amount' => __('messages.actual_amount'),
                    'loan_term' => __('messages.loan_term'),
                    'years' => __('messages.years'),
                    'range' => __('messages.range'),
                    'custom_interest_rate' => __('messages.custom_interest_rate'),
                    'override_default_rate' => __('messages.override_default_rate'),
                    'default_rate' => __('messages.default_rate'),
                    'calculate' => __('messages.calculate'),
                    'loan_details' => __('messages.loan_details'),
                    'monthly_payment' => __('messages.monthly_payment'),
                    'total_payment' => __('messages.total_payment'),
                    'interest_rate' => __('messages.interest_rate'),
                    'loan_amount' => __('messages.loan_amount'),
                    'interest_system' => __('messages.interest_system'),
                    'rent_vs_buy' => __('messages.rent_vs_buy'),
                    'monthly_rent' => __('messages.monthly_rent'),
                    'yearly_appreciation' => __('messages.yearly_appreciation'),
                    'compare_options' => __('messages.compare_options'),
                    'buying_cost' => __('messages.buying_cost'),
                    'renting_cost' => __('messages.renting_cost'),
                    'recommendation' => __('messages.recommendation'),
                    'renting_recommended_full' => __('messages.renting_recommended_full') ?? 'Renting is recommended, Buying isn\'t recommended',
                    'buying_recommended_full' => __('messages.buying_recommended_full') ?? 'Buying is recommended, Renting isn\'t recommended',
                    'custom_rate_help' => __('messages.custom_rate_help') ?? 'Leave empty to use the default rate for the selected country. Provide a value to override and use a custom interest rate in calculations.',
                    'custom_rate_applied' => __('messages.custom_rate_applied') ?? 'Custom rate applied',
                    'default_rate_used' => __('messages.default_rate_used') ?? 'Using default country rate',
                ]); ?>;

                const currentLang = document.documentElement.lang || 'en';
                const form = document.getElementById('housing-form');
                const countrySelect = document.getElementById('country_id');
                const countryIdHidden = document.getElementById('country_id_hidden');
                const propertyValueInput = document.getElementById('property_value');
                const downPaymentInput = document.getElementById('down_payment_percent');
                const downPaymentAmountSpan = document.getElementById('down-payment-amount');
                const currencySymbolSpan = document.getElementById('currency-symbol');
                const loanTermInput = document.getElementById('loan_years');
                const loanTermRangeNumbers = document.getElementById('loan-term-range-numbers');
                const useCustomRateCheckbox = document.getElementById('use_custom_rate');
                const useCustomRateHidden = document.getElementById('use_custom_rate_hidden');
                const customRateInput = document.getElementById('custom_rate');
                document.getElementById('custom_rate').addEventListener('change', updateCountrySettings);

                // Keep hidden flag in sync with checkbox
                function syncUseCustomHidden() {
                    if (useCustomRateHidden) {
                        useCustomRateHidden.value = useCustomRateCheckbox.checked ? '1' : '0';
                    }
                }

                useCustomRateCheckbox.addEventListener('change', syncUseCustomHidden);
                // initialize hidden value
                syncUseCustomHidden();

                // DO NOT set disabled here - let toggle handler manage it
                //console.log('useCustomRateCheckbox:', useCustomRateCheckbox);
                //console.log('customRateInput:', customRateInput);

                // Arabic to English numeral mapping
                const arabicToEnglish = {
                    '٠': '0',
                    '١': '1',
                    '٢': '2',
                    '٣': '3',
                    '٤': '4',
                    '٥': '5',
                    '٦': '6',
                    '٧': '7',
                    '٨': '8',
                    '٩': '9'
                };

                // Convert Arabic numerals to English
                function convertArabicNumerals(value) {
                    return value.replace(/[٠-٩]/g, match => arabicToEnglish[match]);
                }

                // Validate and convert input
                function processNumericInput(input) {
                    const rawValue = input.value;
                    const englishValue = convertArabicNumerals(rawValue);
                    const numericValue = parseFloat(englishValue.replace(/[^0-9.-]/g, ''));

                    if (!isNaN(numericValue)) {
                        input.value = englishValue.replace(/[^0-9.-]/g, '');
                        return numericValue;
                    }
                    return 0;
                }

                // Initialize with current country from navbar/session
                async function initializeFromNavbar() {
                    try {
                        const currentLocationResponse = await fetch('{{ route('location.current') }}');
                        const currentLocationData = await currentLocationResponse.json();

                        if (currentLocationData.country) {
                            //console.log('Initializing housing calculator with country from navbar:',
                            // currentLocationData.country);
                            const countryOption = Array.from(countrySelect.options).find(option =>
                                option.value == currentLocationData.country.id
                            );
                            if (countryOption) {
                                countrySelect.value = countryOption.value;
                                countryIdHidden.value = countryOption.value;
                                updateCountrySettings();
                            }
                        }
                    } catch (error) {
                        //console.log('Could not initialize from navbar, using default');
                    }
                }

                // Initialize the calculator
                initializeFromNavbar();

                // Also initialize language state
                updateLanguageSpecificElements();

                // Set up periodic sync with navbar (every 2 seconds)
                setInterval(async () => {
                    try {
                        const currentLocationResponse = await fetch('{{ route('location.current') }}');
                        const currentLocationData = await currentLocationResponse.json();

                        if (currentLocationData.country && countrySelect.value != currentLocationData
                            .country.id) {
                            //console.log('🔄 Periodic sync: Updating country from', countrySelect.value,
                            // 'to', currentLocationData.country.id);
                            countrySelect.value = currentLocationData.country.id;
                            countryIdHidden.value = currentLocationData.country.id;
                            updateCountrySettings();
                        } else {
                            //console.log('🔄 Periodic sync: Country already matches or no country data');
                        }
                    } catch (error) {
                        console.error('🔄 Periodic sync error:', error);
                    }
                }, 2000);

                // Initialize country selector on page load
                async function initializeCountrySelector() {
                    try {
                        //console.log('🏠 Initializing country selector...');
                        const currentLocationResponse = await fetch('{{ route('location.current') }}');
                        const currentLocationData = await currentLocationResponse.json();

                        if (currentLocationData.country) {
                            //console.log('🏠 Setting initial country to:', currentLocationData.country);
                            countrySelect.value = currentLocationData.country.id;
                            countryIdHidden.value = currentLocationData.country.id;
                            updateCountrySettings();
                        }
                    } catch (error) {
                        console.error('🏠 Error initializing country selector:', error);
                        // Fallback to default
                        setDefaultCountry();
                    }
                }

                // Initialize immediately and also listen for navbar ready event
                initializeCountrySelector();

                // Also listen for navbar initialization event
                window.addEventListener('navbarReady', function() {
                    //console.log('🏠 Received navbarReady event, re-initializing country selector...');
                    initializeCountrySelector();
                });

                function setDefaultCountry() {
                    // Set Jordan as default country
                    const jordanOption = Array.from(countrySelect.options).find(option => option.getAttribute(
                        'data-currency') === 'JOD');
                    if (jordanOption) {
                        countrySelect.value = jordanOption.value;
                        countryIdHidden.value = jordanOption.value;
                        updateCountrySettings();
                    }
                }

                // Update country-specific settings with smooth transitions
                function updateCountrySettings() {
                    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                    if (!selectedOption || !selectedOption.value) {
                        return;
                    }

                    const currencyCode = selectedOption.getAttribute('data-currency') || '$';
                    const currencyNameEn = selectedOption.getAttribute('data-currency-name-en') || 'US Dollar';
                    const currencyNameAr = selectedOption.getAttribute('data-currency-name-ar') || 'دولار أمريكي';
                    let interestRate = selectedOption.getAttribute('data-interest-rate') || '5';
                    const interestSystem = selectedOption.getAttribute('data-interest-system') || 'flat';
                    const minYears = selectedOption.getAttribute('data-min-years') || '5';
                    const maxYears = selectedOption.getAttribute('data-max-years') || '30';
                    let rate = Number(customRateInput.value);

                    // if (!isNaN(rate) && rate > 0) {
                    //     interestRate = rate;
                    // }

                    console.log("interestRate", interestRate);
                    console.log("customRateInput", customRateInput.value);


                    // Smooth currency transition
                    currencySymbolSpan.style.opacity = '0';
                    const currencyInfoSpan = document.getElementById('currency-info');
                    currencyInfoSpan.style.opacity = '0';

                    setTimeout(() => {
                        currencySymbolSpan.textContent = currencyCode;
                        // Add currency name tooltip
                        const currentLang = document.documentElement.lang || 'en';
                        currencySymbolSpan.title = currentLang === 'ar' ? currencyNameAr : currencyNameEn;

                        // Update currency info display
                        const currencyDisplayName = currentLang === 'ar' ? currencyNameAr : currencyNameEn;
                        currencyInfoSpan.textContent = currencyDisplayName;
                        currencyInfoSpan.title = `Currency: ${currencyDisplayName} (${currencyCode})`;

                        currencySymbolSpan.style.opacity = '1';
                        currencyInfoSpan.style.opacity = '1';
                    }, 150);

                    // Update loan term range
                    loanTermRangeNumbers.textContent = minYears + '-' + maxYears;

                    // Validate current loan term
                    const currentYears = parseInt(loanTermInput.value) || 25;
                    if (currentYears < minYears || currentYears > maxYears) {
                        loanTermInput.value = Math.max(minYears, Math.min(maxYears, currentYears));
                    }

                    // Update custom rate placeholder with country's default rate
                    customRateInput.placeholder = interestRate;

                    // Display default rate in the UI
                    const defaultRateDisplay = document.getElementById('default-rate-display');
                    if (defaultRateDisplay) {
                        defaultRateDisplay.textContent = interestRate + '%';
                    }

                    // Keep the custom-rate help note in sync with translations
                    const customRateNote = document.getElementById('custom-rate-note');
                    if (customRateNote) customRateNote.textContent = translations.custom_rate_help;

                    updateDownPaymentAmount();
                }

                // Get display name for interest system
                function getSystemDisplayName(system) {
                    const names = {
                        'flat': '{{ __('messages.flat_rate') ?? 'Flat Rate' }}',
                        'compound_monthly': '{{ __('messages.compound_monthly') ?? 'Compound Monthly' }}',
                        'apr': '{{ __('messages.apr') ?? 'APR' }}'
                    };
                    return names[system] || system;
                }

                // Update currency info display
                function updateCurrencyInfo() {
                    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                    if (!selectedOption || !selectedOption.value) {
                        document.getElementById('currency-info').textContent = '';
                        return;
                    }

                    const currencyNameEn = selectedOption.getAttribute('data-currency-name-en') || 'US Dollar';
                    const currencyNameAr = selectedOption.getAttribute('data-currency-name-ar') || 'دولار أمريكي';
                    const currencyCode = selectedOption.getAttribute('data-currency') || '$';
                    const currentLang = document.documentElement.lang || 'en';

                    const currencyDisplayName = currentLang === 'ar' ? currencyNameAr : currencyNameEn;
                    const currencyInfoSpan = document.getElementById('currency-info');

                    currencyInfoSpan.textContent = currencyDisplayName;
                    currencyInfoSpan.title = `Currency: ${currencyDisplayName} (${currencyCode})`;
                }

                // Show notification
                function showNotification(message, type = 'info') {
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 px-4 py-2 rounded-lg text-white z-50 transition-all duration-300 ${
            type === 'success' ? 'bg-emerald-500' : 'bg-blue-500'
        }`;
                    notification.textContent = message;
                    document.body.appendChild(notification);

                    setTimeout(() => {
                        notification.style.opacity = '0';
                        setTimeout(() => notification.remove(), 300);
                    }, 3000);
                }

                // Update currency symbol when country changes
                countrySelect.addEventListener('change', function() {
                    updateCountrySettings();
                });

                // Update down payment amount when property value or percentage changes
                function updateDownPaymentAmount() {
                    const propertyValue = processNumericInput(propertyValueInput);
                    const downPaymentPercent = processNumericInput(downPaymentInput);
                    const downPaymentAmount = (propertyValue * downPaymentPercent / 100);
                    const currencyCode = countrySelect.options[countrySelect.selectedIndex]?.getAttribute(
                        'data-currency') || '$';
                    downPaymentAmountSpan.textContent = currencyCode + ' ' + downPaymentAmount.toLocaleString();

                    // Keep the displayed loan amount in sync (live update)
                    updateLoanAmount();
                }

                // Live-update the displayed loan amount (property value - down payment)
                function updateLoanAmount() {
                    const propertyValue = processNumericInput(propertyValueInput);
                    const downPaymentPercent = processNumericInput(downPaymentInput);
                    const downPaymentAmount = (propertyValue * downPaymentPercent / 100);
                    const loanAmount = Math.max(0, propertyValue - downPaymentAmount);
                    const currencyCode = countrySelect.options[countrySelect.selectedIndex]?.getAttribute(
                        'data-currency') || '$';

                    const loanAmountEl = document.getElementById('loan-amount');
                    if (loanAmountEl) {
                        loanAmountEl.textContent = currencyCode + ' ' + Math.round(loanAmount).toLocaleString();
                    }
                }

                // Input event handlers for numeric inputs
                [propertyValueInput, downPaymentInput, loanTermInput].forEach(input => {
                    input.addEventListener('input', function() {
                        processNumericInput(this);
                        if (this === propertyValueInput || this === downPaymentInput) {
                            updateDownPaymentAmount();
                        }
                    });

                    input.addEventListener('blur', function() {
                        // Validate on blur
                        const value = processNumericInput(this);
                        if (this === loanTermInput) {
                            const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                            const minYears = selectedOption?.getAttribute('data-min-years') || '5';
                            const maxYears = selectedOption?.getAttribute('data-max-years') || '30';

                            if (value < minYears || value > maxYears) {
                                this.value = Math.max(minYears, Math.min(maxYears, value));
                                showNotification(
                                    `{{ __('messages.loan_term_range') ?? 'Loan term must be between' }} ${minYears}-${maxYears} {{ __('messages.years') ?? 'years' }}`,
                                    'info');
                            }
                        }
                    });
                });

                // Toggle custom rate input - SIMPLE (NO DISABLING)
                //console.log('Setting up custom rate toggle...');

                // Define toggle function - DO NOT disable input
                function toggleCustomRateInput() {
                    const isChecked = useCustomRateCheckbox.checked;
                    //console.log('Toggle called - checkbox checked:', isChecked);

                    if (isChecked) {
                        customRateInput.focus();
                        //console.log('✅ Input focused for editing');
                    } else {
                        customRateInput.value = '';
                        //console.log('❌ Input cleared');
                    }
                }

                // Set up listeners
                if (useCustomRateCheckbox && customRateInput) {
                    // Set initial state
                    toggleCustomRateInput();

                    // Listen to changes
                    useCustomRateCheckbox.addEventListener('change', toggleCustomRateInput);
                    useCustomRateCheckbox.addEventListener('click', function() {
                        // Slight delay to ensure the checkbox state is updated
                        setTimeout(toggleCustomRateInput, 0);
                    });

                    //console.log('✅ Toggle handlers attached successfully');
                } else {
                    console.error('❌ Failed to find elements:', {
                        useCustomRateCheckbox,
                        customRateInput
                    });
                }

                // Auto-recalculate when custom rate changes
                customRateInput.addEventListener('change', function() {
                    const v = this.value.trim();
                    const rate = parseFloat(v);
                    // If user provided a valid custom value, submit automatically (checkbox optional)
                    if (v !== '' && !isNaN(rate) && rate > 0) {
                        form.dispatchEvent(new Event('submit'));
                        return;
                    }

                    // If checkbox is checked but input cleared, show validation (handled on submit)
                    if (useCustomRateCheckbox.checked && v === '') {
                        showError('{{ __('messages.custom_rate_required') ?? 'Please enter a custom interest rate or uncheck the option.' }}');
                    }
                });

                customRateInput.addEventListener('input', function() {
                    // Real-time validation of custom rate input
                    processNumericInput(this);
                });

                // Form submission
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (!countrySelect.value) {
                        showError(
                            '{{ __('messages.select_country_first') ?? 'Please select a country first.' }}'
                        );
                        return;
                    }

                    // Validate all numeric inputs
                    const propertyValue = processNumericInput(propertyValueInput);
                    const downPaymentPercent = processNumericInput(downPaymentInput);
                    const loanYears = processNumericInput(loanTermInput);

                    if (propertyValue < 10000) {
                        showError(
                            '{{ __('messages.property_value_min') ?? 'Property value must be at least 10,000' }}'
                        );
                        propertyValueInput.focus();
                        return;
                    }

                    if (downPaymentPercent < 0 || downPaymentPercent > 50) {
                        showError(
                            '{{ __('messages.down_payment_range') ?? 'Down payment must be between 0% and 50%' }}'
                        );
                        downPaymentInput.focus();
                        return;
                    }

                    // Validate custom rate if present or if checkbox is checked
                    const rawCustom = customRateInput.value.trim();

                    // If user entered a custom rate (even if checkbox not checked), validate it
                    if (rawCustom !== '') {
                        const customRate = processNumericInput(customRateInput);
                        if (customRate <= 0) {
                            showError(
                                '{{ __('messages.interest_rate_positive') ?? 'Interest rate must be greater than 0' }}'
                            );
                            customRateInput.focus();
                            return;
                        }
                    }

                    // If checkbox is checked but input is empty, require input or uncheck
                    if (useCustomRateCheckbox.checked && rawCustom === '') {
                        showError(
                            '{{ __('messages.custom_rate_required') ?? 'Please enter a custom interest rate or uncheck the option.' }}'
                        );
                        customRateInput.focus();
                        return;
                    }

                    showLoading();

                    // ⭐ CRITICAL: Get custom rate BEFORE creating FormData
                    const customRateValue = customRateInput.value.trim();
                    const useCustomRate = useCustomRateCheckbox.checked;

                    // Ensure hidden flag is correct (keeps parity with checkbox)
                    if (useCustomRateHidden) {
                        useCustomRateHidden.value = useCustomRate ? '1' : '0';
                    }

                    const formData = new FormData(this);

                    // If user entered a custom rate value (non-empty and valid) we will send it and set use_custom_rate=1
                    if (customRateValue !== '' && customRateValue !== '0') {
                        const rateAsNumber = parseFloat(customRateValue);
                        if (!isNaN(rateAsNumber) && rateAsNumber > 0) {
                            formData.set('custom_rate', rateAsNumber.toString());
                            formData.set('use_custom_rate', '1');
                        } else {
                            // Invalid value -> don't send custom
                            console.warn('⚠️ Invalid custom rate value:', customRateValue);
                            formData.delete('custom_rate');
                            formData.set('use_custom_rate', '0');
                        }
                    } else if (useCustomRate) {
                        // Checkbox is checked but input empty (should be prevented by validation earlier), fall back to default
                        formData.delete('custom_rate');
                        formData.set('use_custom_rate', '0');
                    } else {
                        // Neither input nor checkbox -> default rate
                        formData.delete('custom_rate');
                        formData.set('use_custom_rate', '0');
                    }

                    // Log all form data
                    //console.log('📤 Form data being sent:');
                    for (let [key, value] of formData.entries()) {
                        //console.log(`  ${key}: "${value}"`);
                    }
                    //console.log('📤 Final custom_rate in FormData:', formData.get('custom_rate'));
                    //console.log('📤 Has custom_rate?', formData.has('custom_rate'));

                    fetch("{{ route('loan.housing.calculate', ['locale' => $locale]) }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    const errorMessage = err.message || (err.errors ? Object.values(
                                        err.errors).flat().join(', ') : 'Validation error');
                                    throw new Error(errorMessage);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            hideLoading();

                            if (data.error) {
                                showError(data.error);
                                return;
                            }

                            displayResults(data);
                        })
                        .catch(error => {
                            hideLoading();
                            showError(error.message ||
                                '{{ __('messages.network_error') ?? 'Network error. Please try again.' }}'
                            );
                            console.error('Error:', error);
                        });
                });
                compareBtn = document.getElementById('compare-btn');
                // Compare rent vs buy
                compareBtn.addEventListener('click', function() {
                    const monthlyPayment = parseFloat(document.getElementById('monthly-payment').textContent
                        .replace(/[^0-9.-]+/g, '')) || 0;
                    const loanYears = parseInt(document.getElementById('loan_years').value) || 25;
                    const monthlyRent = parseFloat(document.getElementById('monthly-rent').value) || 0;
                    const appreciationRate = parseFloat(document.getElementById('appreciation-rate').value) ||
                        3;
                    const propertyValue = parseFloat(document.getElementById('property_value').value) || 0;

                    if (monthlyPayment === 0 || monthlyRent === 0) {
                        alert(
                            '{{ __('messages.enter_loan_and_rent') ?? 'Please calculate loan first and enter monthly rent.' }}'
                        );
                        return;
                    }

                    // Get down payment
                    const downPaymentPercent = parseFloat(document.getElementById('down_payment_percent')
                        .value) || 20;
                    const downPaymentAmount = propertyValue * (downPaymentPercent / 100);

                    // Calculate costs
                    const totalLoanCost = monthlyPayment * loanYears * 12;
                    const totalRentCost = monthlyRent * loanYears * 12;

                    const totalBuyingCost = downPaymentAmount + totalLoanCost;

                    // Simple appreciation calculation (property value increase)
                    const futureValue = propertyValue * Math.pow(1 + appreciationRate / 100, loanYears);
                    const netBuyingCost = totalBuyingCost - (futureValue -
                        propertyValue); // Subtract appreciation

                    const currencyCode = countrySelect.options[countrySelect.selectedIndex]?.getAttribute(
                        'data-currency') || '$';

                    document.getElementById('buying-cost').textContent = currencyCode + ' ' + Math.round(
                        netBuyingCost).toLocaleString();
                    document.getElementById('renting-cost').textContent = currencyCode + ' ' + Math.round(
                        totalRentCost).toLocaleString();

                    // Recommendation based on net buying cost vs total renting cost
                    const costDifference = Math.abs(netBuyingCost - totalRentCost);
                    const savings = netBuyingCost < totalRentCost ? totalRentCost - netBuyingCost :
                        netBuyingCost - totalRentCost;

                    let recommendation;
                    if (netBuyingCost < totalRentCost) {
                        recommendation = currentLang === 'ar' ?
                            `الشراء أفضل بخسارة ${Math.round(savings).toLocaleString()} ${currencyCode} على ${loanYears} سنوات` :
                            `Buying saves ${currencyCode} ${Math.round(savings).toLocaleString()} over ${loanYears} years`;
                    } else {
                        recommendation = currentLang === 'ar' ?
                            `الإيجار أفضل بخسارة ${Math.round(savings).toLocaleString()} ${currencyCode} على ${loanYears} سنوات` :
                            `Renting saves ${currencyCode} ${Math.round(savings).toLocaleString()} over ${loanYears} years`;
                    }

                    document.getElementById('recommendation').textContent = recommendation;

                    document.getElementById('comparison-output').classList.remove('hidden');
                });

                function displayResults(data) {
                    const currencyCode = data.currency || countrySelect.options[countrySelect.selectedIndex]
                        ?.getAttribute('data-currency') || '$';

                    //console.log('📊 Displaying results with interest rate:', data.interest_rate);
                    //console.log('📊 Custom checkbox checked:', useCustomRateCheckbox.checked);
                    //console.log('📊 Custom input value:', customRateInput.value);

                    // Animate results display
                    document.getElementById('monthly-payment').textContent = currencyCode + ' ' + data.monthly_payment
                        .toLocaleString();
                    document.getElementById('total-payment').textContent = currencyCode + ' ' + data.total_payment
                        .toLocaleString();

                    // Use the backend-provided interest_rate and used_custom_rate flag for accuracy
                    const finalRate = Number(data.interest_rate);

                    // Update interest rate display
                    const interestRateEl = document.getElementById('interest-rate');
                    interestRateEl.textContent = finalRate + '%';

                    // Update note under interest rate based on backend flag
                    const interestRateNoteEl = document.getElementById('interest-rate-note');
                    const usedCustom = data.used_custom_rate === true || data.used_custom_rate === '1' || data.interest_rate_source === 'custom';

                    if (usedCustom) {
                        interestRateNoteEl.textContent = translations.custom_rate_applied || 'Custom rate applied';
                        interestRateNoteEl.classList.remove('text-slate-400');
                        interestRateNoteEl.classList.add('text-emerald-400');
                    } else {
                        interestRateNoteEl.textContent = translations.default_rate_used || 'Using default country rate';
                        interestRateNoteEl.classList.remove('text-emerald-400');
                        interestRateNoteEl.classList.add('text-slate-400');
                    }

                    document.getElementById('loan-amount').textContent = currencyCode + ' ' + data.loan_amount
                        .toLocaleString();
                    document.getElementById('interest-system').textContent = data.interest_system;

                    // Add entrance animation
                    const resultsDiv = document.getElementById('loan-results');
                    resultsDiv.classList.remove('hidden');
                    resultsDiv.style.animation = 'slideInUp 0.5s ease-out';

                    document.getElementById('comparison-results').classList.remove('hidden');
                    document.getElementById('error-state').classList.add('hidden');

                    // Scroll to results
                    setTimeout(() => {
                        resultsDiv.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 300);
                }

                function showLoading() {
                    document.getElementById('loading-state').classList.remove('hidden');
                    document.getElementById('error-state').classList.add('hidden');
                }

                function hideLoading() {
                    document.getElementById('loading-state').classList.add('hidden');
                }

                function showError(message) {
                    document.getElementById('error-message').textContent = message;
                    document.getElementById('error-state').classList.remove('hidden');
                    document.getElementById('loan-results').classList.add('hidden');
                    document.getElementById('comparison-results').classList.add('hidden');
                    hideLoading();
                }

                // Handle language changes (dynamic updates)
                function updateLanguageSpecificElements() {
                    const currentLang = document.documentElement.lang || 'en';

                    // Update currency tooltips and info based on selected country
                    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                    if (selectedOption && selectedOption.value) {
                        const currencyNameEn = selectedOption.getAttribute('data-currency-name-en') || 'US Dollar';
                        const currencyNameAr = selectedOption.getAttribute('data-currency-name-ar') || 'دولار أمريكي';
                        const currencySymbolSpan = document.getElementById('currency-symbol');

                        if (currencySymbolSpan) {
                            currencySymbolSpan.title = currentLang === 'ar' ? currencyNameAr : currencyNameEn;
                        }

                        const currencyInfoSpan = document.getElementById('currency-info');
                        if (currencyInfoSpan) {
                            currencyInfoSpan.textContent = currentLang === 'ar' ? currencyNameAr : currencyNameEn;
                        }
                    }

                    // Update down payment amount display
                    updateDownPaymentAmount();

                    // Update custom-rate help note to match current language
                    const customRateNote = document.getElementById('custom-rate-note');
                    if (customRateNote) customRateNote.textContent = translations.custom_rate_help;

                    // Update country select options text
                    updateCountrySelectOptions(currentLang);

                    // Update all translatable elements
                    updateTranslatableElements(currentLang);
                }

                function updateCountrySelectOptions(lang) {
                    Array.from(countrySelect.options).forEach(option => {
                        if (option.value) {
                            const countryId = option.value;
                            // Find the country data and update the text
                            const countryName = option.getAttribute(`data-name-${lang}`) ||
                                (lang === 'ar' ? option.getAttribute('data-name-ar') : option.getAttribute(
                                    'data-name-en')) ||
                                option.textContent;
                            if (countryName) {
                                option.textContent = countryName;
                            }
                        }
                    });
                }

                function updateTranslatableElements(lang) {
                    // Update elements with data-key attributes using the translations object
                    const elementsToUpdate = [{
                            key: 'country',
                            translation: translations.country
                        },
                        {
                            key: 'select-country',
                            translation: translations.select_country
                        },
                        {
                            key: 'property-value',
                            translation: translations.property_value
                        },
                        {
                            key: 'enter-numbers-only',
                            translation: translations.enter_numbers_only
                        },
                        {
                            key: 'down-payment',
                            translation: translations.down_payment
                        },
                        {
                            key: 'actual-amount',
                            translation: translations.actual_amount
                        },
                        {
                            key: 'loan-term',
                            translation: translations.loan_term
                        },
                        {
                            key: 'years',
                            translation: translations.years
                        },
                        {
                            key: 'range',
                            translation: translations.range
                        },
                        {
                            key: 'custom-interest-rate',
                            translation: translations.custom_interest_rate
                        },
                        {
                            key: 'override-default-rate',
                            translation: translations.override_default_rate
                        },
                        {
                            key: 'calculate',
                            translation: translations.calculate
                        },
                        {
                            key: 'loan-details',
                            translation: translations.loan_details
                        },
                        {
                            key: 'monthly-payment',
                            translation: translations.monthly_payment
                        },
                        {
                            key: 'total-payment',
                            translation: translations.total_payment
                        },
                        {
                            key: 'interest-rate',
                            translation: translations.interest_rate
                        },
                        {
                            key: 'loan-amount',
                            translation: translations.loan_amount
                        },
                        {
                            key: 'interest-system',
                            translation: translations.interest_system
                        },
                        {
                            key: 'rent-vs-buy',
                            translation: translations.rent_vs_buy
                        },
                        {
                            key: 'monthly-rent',
                            translation: translations.monthly_rent
                        },
                        {
                            key: 'yearly-appreciation',
                            translation: translations.yearly_appreciation
                        },
                        {
                            key: 'compare-options',
                            translation: translations.compare_options
                        },
                        {
                            key: 'buying-cost',
                            translation: translations.buying_cost
                        },
                        {
                            key: 'renting-cost',
                            translation: translations.renting_cost
                        },
                        {
                            key: 'recommendation',
                            translation: translations.recommendation
                        }
                    ];

                    // Update elements with data-key attributes
                    elementsToUpdate.forEach(item => {
                        const elements = document.querySelectorAll(`[data-key="${item.key}"]`);
                        elements.forEach(el => {
                            el.textContent = item.translation;
                        });
                    });

                    // Update placeholders
                    const propertyValueInput = document.getElementById('property_value');
                    if (propertyValueInput) {
                        propertyValueInput.placeholder = lang === 'ar' ? '500000' : '500,000';
                    }
                }

                // Listen for country changes from navbar
                window.addEventListener('countryChanged', function(e) {
                    //console.log('🏠 Housing calculator received countryChanged event:', e.detail);
                    const newCountryId = e.detail.countryId;
                    const currentValue = countrySelect.value;
                    //console.log('🏠 Current countrySelect.value:', currentValue, 'New countryId:',
                    // newCountryId);

                    if (currentValue !== newCountryId.toString()) {
                        //console.log('🏠 Updating country selector from', currentValue, 'to', newCountryId);
                        countrySelect.value = newCountryId;
                        countryIdHidden.value = newCountryId;
                        updateCountrySettings();
                        showNotification('Country updated from navbar', 'success');
                    } else {
                        //console.log('🏠 Country already matches, no update needed');
                    }
                });

                // Listen for language changes from navbar
                window.addEventListener('languageChanged', function(e) {
                    //console.log('🏠 Housing calculator received languageChanged event:', e.detail);
                    const newLang = e.detail.language;
                    //console.log('🏠 Updating language to:', newLang);
                    updateLanguageSpecificElements();
                    showNotification('Language updated', 'success');
                });

                // Add CSS animations and input styling
                const style = document.createElement('style');
                style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Language transition effects */
        .lang-transition {
            transition: opacity 0.3s ease;
        }

        .lang-transition.fade {
            opacity: 0.5;
        }
    `;
                document.head.appendChild(style);
            });
        </script>
    @endsection
