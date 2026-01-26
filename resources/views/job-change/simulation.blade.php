@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <!-- Glow Effects -->
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-indigo-600/20 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-6 py-20 text-center">
                <div
                    class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-sm font-medium mb-6">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: #7c3aed;"></span>
                    <span>{{ __('messages.job_change_title') }}</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    💼 <span class="text-purple-400">{{ __('messages.job_change_title') }}</span>
                </h1>

                <p class="text-lg text-slate-300 max-w-3xl mx-auto mb-10">
                    {!! __('messages.job_change_description') !!}
                </p>

                <a href="#step1"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                    {{ __('messages.job_change_button') }}
                    <span>←</span>
                </a>
            </div>
        </div>

        <!-- Steps Section -->
        <div class="px-6 py-20">
            <div class="max-w-4xl mx-auto">

                <!-- Progress Bar -->
                <div class="mb-12">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-slate-400 text-sm">Progress</span>
                        <span id="progress-text" class="text-slate-400 text-sm">Step 1 of 5</span>
                    </div>
                    <div class="w-full bg-slate-700 rounded-full h-2">
                        <div id="progress-bar" class="bg-purple-500 h-2 rounded-full transition-all duration-300"
                            style="width: 20%"></div>
                    </div>
                </div>

                <!-- Step 1: Current Job -->
                <div id="step1"
                    class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8">
                    <h2 class="text-2xl font-bold mb-6 text-white">1️⃣
                        {{ __('messages.current_job_title') ?? 'Your Current Job' }}</h2>

                    <form id="job-form" class="space-y-6">
                        @csrf

                        <!-- Country Selection (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                🌍 {{ __('messages.country') }}
                            </label>
                            <div
                                class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-slate-400 flex items-center cursor-not-allowed">
                                @if ($currentCountry)
                                    <img src="https://flagcdn.com/{{ strtolower($currentCountry->flag_code) }}.svg"
                                        alt="{{ $currentCountry->name }}" class="w-6 h-4 mr-3 rounded">
                                    <span>{{ $currentCountry->name }} ({{ $currentCountry->currency_code }})</span>
                                @else
                                    <span>{{ __('messages.select_country') }}</span>
                                @endif
                            </div>
                            <input type="hidden" name="country_id"
                                value="{{ $currentCountry ? $currentCountry->id : '' }}">
                        </div>

                        <!-- Current Monthly Salary -->
                        <div>
                            <label for="current_salary" class="block text-sm font-medium text-slate-300 mb-2">
                                💰 {{ __('messages.current_monthly_salary') ?? 'Current Monthly Salary' }} (<span
                                    id="currency-display">USD</span>)
                            </label>
                            <input type="number" id="current_salary" name="current_salary" min="0"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="3000" required>
                        </div>

                        <!-- Working Hours -->
                        <div>
                            <label for="current_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                🕒 {{ __('messages.working_hours_day') ?? 'Working Hours / Day' }}
                            </label>
                            <input type="number" id="current_hours" name="current_hours" min="1" max="24"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="8" required>
                        </div>

                        <!-- Stress Level -->
                        <div>
                            <label for="current_stress" class="block text-sm font-medium text-slate-300 mb-2">
                                🧠 {{ __('messages.stress_level') ?? 'Stress Level (1-10)' }}
                            </label>
                            <input type="range" id="current_stress" name="current_stress" min="1" max="10"
                                value="5" class="w-full" oninput="updateStressValue('current_stress')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>1 (Relaxed)</span>
                                <span id="current_stress_value" class="font-semibold">5</span>
                                <span>10 (High Stress)</span>
                            </div>
                        </div>

                        <!-- Commute Time -->
                        <div>
                            <label for="current_commute" class="block text-sm font-medium text-slate-300 mb-2">
                                🚗 {{ __('messages.commute_time') ?? 'Commute Time (minutes/day)' }}
                            </label>
                            <input type="number" id="current_commute" name="current_commute" min="0"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="60" required>
                        </div>

                        <!-- Monthly Job Expenses -->
                        <div>
                            <label for="current_expenses" class="block text-sm font-medium text-slate-300 mb-2">
                                💸 {{ __('messages.monthly_job_expenses') ?? 'Monthly Expenses related to job' }}
                            </label>
                            <input type="number" id="current_expenses" name="current_expenses" min="0"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="200" required>
                            <p class="text-xs text-slate-400 mt-1">
                                {{ __('messages.job_expenses_hint') ?? 'Transportation, food, coffee, etc.' }}</p>
                        </div>

                        <!-- Vacation Days -->
                        <div>
                            <label for="current_vacation" class="block text-sm font-medium text-slate-300 mb-2">
                                🏖️ {{ __('messages.vacation_days_year') ?? 'Vacation Days / Year' }}
                            </label>
                            <input type="number" id="current_vacation" name="current_vacation" min="0"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="21" required>
                        </div>

                        <!-- Job Stability -->
                        <div>
                            <label for="current_stability" class="block text-sm font-medium text-slate-300 mb-2">
                                🔐 {{ __('messages.job_stability') ?? 'Job Stability' }}
                            </label>
                            <select id="current_stability" name="current_stability"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                required>
                                <option value="high">{{ __('messages.high') ?? 'High' }}</option>
                                <option value="medium" selected>{{ __('messages.medium') ?? 'Medium' }}</option>
                                <option value="low">{{ __('messages.low') ?? 'Low' }}</option>
                            </select>
                        </div>

                        <button type="button" onclick="nextStep(2)"
                            class="w-full px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition"
                            style="background-color: #0a0d1e;">
                            {{ __('messages.next_step') ?? 'Next: New Job Offer' }} →
                        </button>
                    </form>
                </div>

                <!-- Step 2: New Job Offer -->
                <div id="step2"
                    class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-white">2️⃣
                        {{ __('messages.new_job_offer_title') ?? 'New Job Offer' }}</h2>

                    <!-- New Job Form Fields -->
                    <div class="space-y-6">
                        <!-- Offered Salary -->
                        <div>
                            <label for="new_salary" class="block text-sm font-medium text-slate-300 mb-2">
                                💰 {{ __('messages.offered_salary') ?? 'Offered Salary' }} (<span
                                    id="currency-display-new">USD</span>)
                            </label>
                            <input type="number" id="new_salary" name="new_salary" min="0"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="4000" required>
                        </div>

                        <!-- Expected Working Hours -->
                        <div>
                            <label for="new_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                🕒 {{ __('messages.expected_working_hours') ?? 'Expected Working Hours' }}
                            </label>
                            <input type="number" id="new_hours" name="new_hours" min="1" max="24"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="8" required>
                        </div>

                        <!-- Expected Stress Level -->
                        <div>
                            <label for="new_stress" class="block text-sm font-medium text-slate-300 mb-2">
                                🧠 {{ __('messages.expected_stress_level') ?? 'Expected Stress Level (1-10)' }}
                            </label>
                            <input type="range" id="new_stress" name="new_stress" min="1" max="10"
                                value="5" class="w-full" oninput="updateStressValue('new_stress')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>1 (Relaxed)</span>
                                <span id="new_stress_value" class="font-semibold">5</span>
                                <span>10 (High Stress)</span>
                            </div>
                        </div>

                        <!-- Commute Time -->
                        <div>
                            <label for="new_commute" class="block text-sm font-medium text-slate-300 mb-2">
                                🚗 {{ __('messages.new_commute_time') ?? 'Commute Time (minutes/day)' }}
                            </label>
                            <input type="number" id="new_commute" name="new_commute" min="0"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="30" required>
                        </div>

                        <!-- Work Type -->
                        <div>
                            <label for="new_work_type" class="block text-sm font-medium text-slate-300 mb-2">
                                🏢 {{ __('messages.work_type') ?? 'Work Type' }}
                            </label>
                            <select id="new_work_type" name="new_work_type"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                required>
                                <option value="remote">{{ __('messages.remote') ?? 'Remote' }}</option>
                                <option value="hybrid" selected>{{ __('messages.hybrid') ?? 'Hybrid' }}</option>
                                <option value="onsite">{{ __('messages.onsite') ?? 'On-site' }}</option>
                            </select>
                        </div>

                        <!-- Growth Potential -->
                        <div>
                            <label for="new_growth" class="block text-sm font-medium text-slate-300 mb-2">
                                📈 {{ __('messages.growth_potential') ?? 'Growth Potential' }}
                            </label>
                            <select id="new_growth" name="new_growth"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                required>
                                <option value="low">{{ __('messages.low') ?? 'Low' }}</option>
                                <option value="medium" selected>{{ __('messages.medium') ?? 'Medium' }}</option>
                                <option value="high">{{ __('messages.high') ?? 'High' }}</option>
                            </select>
                        </div>

                        <!-- Contract Type -->
                        <div>
                            <label for="new_contract" class="block text-sm font-medium text-slate-300 mb-2">
                                📃 {{ __('messages.contract_type') ?? 'Contract Type' }}
                            </label>
                            <select id="new_contract" name="new_contract"
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                required>
                                <option value="permanent" selected>{{ __('messages.permanent') ?? 'Permanent' }}</option>
                                <option value="1year">{{ __('messages.one_year') ?? '1 Year' }}</option>
                                <option value="freelance">{{ __('messages.freelance') ?? 'Freelance' }}</option>
                            </select>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="prevStep(1)"
                                class="flex-1 px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                ← {{ __('messages.previous') ?? 'Previous' }}
                            </button>
                            <button type="button" onclick="nextStep(3)"
                                class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition"
                                  style="background-color: #0a0d1e;">
                                {{ __('messages.next_hidden_costs') ?? 'Next: Hidden Costs' }} →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Hidden Costs -->
                <div id="step3"
                    class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-white">3️⃣
                        {{ __('messages.hidden_costs_title') ?? 'Hidden Costs & Reality Check' }}</h2>

                    <div class="space-y-6">
                        <!-- Sleep Less -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                😴 {{ __('messages.sleep_less') ?? 'Will you sleep less?' }}
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="sleep_less" value="1" class="mr-2" required>
                                    <span class="text-slate-300">{{ __('messages.yes') ?? 'Yes' }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="sleep_less" value="0" class="mr-2" checked>
                                    <span class="text-slate-300">{{ __('messages.no') ?? 'No' }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Family Time Decrease -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                👨‍👩‍👧 {{ __('messages.family_time_decrease') ?? 'Will family time decrease?' }}
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="family_time_decrease" value="1" class="mr-2"
                                        required>
                                    <span class="text-slate-300">{{ __('messages.yes') ?? 'Yes' }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="family_time_decrease" value="0" class="mr-2"
                                        checked>
                                    <span class="text-slate-300">{{ __('messages.no') ?? 'No' }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Burnout Risk -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">
                                🧘 {{ __('messages.burnout_risk') ?? 'Do you expect burnout in < 1 year?' }}
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="burnout_risk" value="1" class="mr-2" required>
                                    <span class="text-slate-300">{{ __('messages.yes') ?? 'Yes' }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="burnout_risk" value="0" class="mr-2" checked>
                                    <span class="text-slate-300">{{ __('messages.no') ?? 'No' }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Learning Curve Difficulty -->
                        <div>
                            <label for="learning_difficulty" class="block text-sm font-medium text-slate-300 mb-2">
                                📚 {{ __('messages.learning_curve_difficulty') ?? 'Learning curve difficulty (1-10)' }}
                            </label>
                            <input type="range" id="learning_difficulty" name="learning_difficulty" min="1"
                                max="10" value="3" class="w-full" oninput="updateDifficultyValue()" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>1 (Easy)</span>
                                <span id="learning_difficulty_value" class="font-semibold">3</span>
                                <span>10 (Very Difficult)</span>
                            </div>
                        </div>

                        <!-- Quit Probability -->
                        <div>
                            <label for="quit_probability" class="block text-sm font-medium text-slate-300 mb-2">
                                🔁 {{ __('messages.quit_probability') ?? 'Probability you\'ll quit within 12 months (%)' }}
                            </label>
                            <input type="range" id="quit_probability" name="quit_probability" min="0"
                                max="100" value="20" class="w-full" oninput="updateQuitValue()" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0%</span>
                                <span id="quit_probability_value" class="font-semibold">20%</span>
                                <span>100%</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="prevStep(2)"
                                class="flex-1 px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                ← {{ __('messages.previous') ?? 'Previous' }}
                            </button>
                            <button type="button" onclick="calculateJobChange()"
                                class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition"
                                  style="background-color: #0a0d1e;">
                                {{ __('messages.calculate_decision') ?? 'Calculate Decision' }} →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Results Section -->
                <div id="results-section"
                    class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.results') ?? 'Results' }}</h2>

                    <div id="results-content" class="space-y-6">
                        <!-- Results will be populated by JavaScript -->
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-700">
                        <button id="try-again"
                            class="w-full px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                            {{ __('messages.try_another_scenario') ?? 'Try Another Scenario' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

        function updateStressValue(id) {
            document.getElementById(id + '_value').textContent = document.getElementById(id).value;
        }

        function updateDifficultyValue() {
            document.getElementById('learning_difficulty_value').textContent = document.getElementById(
                'learning_difficulty').value;
        }

        function updateQuitValue() {
            document.getElementById('quit_probability_value').textContent = document.getElementById('quit_probability')
                .value + '%';
        }

        function validateStep(step) {
            const requiredFields = {
                1: ['current_salary', 'current_hours', 'current_stress', 'current_commute', 'current_expenses', 'current_vacation', 'current_stability'],
                2: ['new_salary', 'new_hours', 'new_stress', 'new_commute', 'new_work_type', 'new_growth', 'new_contract'],
                3: ['sleep_less', 'family_time_decrease', 'burnout_risk', 'learning_difficulty', 'quit_probability']
            };

            const fields = requiredFields[step];
            for (const field of fields) {
                const element = document.querySelector(`[name="${field}"]`);
                if (!element) continue;

                if (element.type === 'radio') {
                    const checked = document.querySelector(`input[name="${field}"]:checked`);
                    if (!checked) {
                        alert(`Please fill in all required fields in Step ${step}.`);
                        return false;
                    }
                } else if (element.type === 'number' || element.type === 'range') {
                    if (!element.value || element.value === '') {
                        alert(`Please fill in all required fields in Step ${step}.`);
                        element.focus();
                        return false;
                    }
                } else if (element.tagName === 'SELECT') {
                    if (!element.value) {
                        alert(`Please fill in all required fields in Step ${step}.`);
                        element.focus();
                        return false;
                    }
                }
            }
            return true;
        }

        function nextStep(step) {
            if (!validateStep(currentStep)) return;

            document.getElementById('step' + currentStep).classList.add('hidden');
            document.getElementById('step' + step).classList.remove('hidden');
            currentStep = step;
            updateProgress();
        }

        function prevStep(step) {
            document.getElementById('step' + currentStep).classList.add('hidden');
            document.getElementById('step' + step).classList.remove('hidden');
            currentStep = step;
            updateProgress();
        }

        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('progress-text').textContent = `Step ${currentStep} of ${totalSteps}`;
        }

        function calculateJobChange() {
            // Validate all steps before calculating
            for (let step = 1; step <= totalSteps; step++) {
                if (!validateStep(step)) {
                    // Go to the invalid step
                    document.getElementById('step' + currentStep).classList.add('hidden');
                    document.getElementById('step' + step).classList.remove('hidden');
                    currentStep = step;
                    updateProgress();
                    return;
                }
            }

            const formData = new FormData();

            // Manually collect all inputs from all steps
            const allInputs = document.querySelectorAll('input[name], select[name]');
            allInputs.forEach(input => {
                if (input.type === 'radio' || input.type === 'checkbox') {
                    if (input.checked) {
                        formData.append(input.name, input.value);
                    }
                } else {
                    formData.append(input.name, input.value);
                }
            });

            // Log form data for debugging
            console.log('Form data being sent:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            fetch('{{ route("job.change.calculate", ["locale" => $locale]) }}', {
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

                    displayResults(data);
                    document.getElementById('step3').classList.add('hidden');
                    document.getElementById('results-section').classList.remove('hidden');
                    document.getElementById('results-section').scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Generate dynamic risky reasons
                    const reasons = generateRiskyReasons(data);
                    const reasonsHtml = reasons.map(reason => `
                    <li class="flex items-start gap-3">
                        <span class="text-red-400 mt-1">•</span>
                        <span>${reason}</span>
                    </li>
                `).join('');
                    document.getElementById('risky-reasons').innerHTML = reasonsHtml;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }

        function displayResults(data) {
            const currency = data.currency;

            let decisionColor = '';
            let decisionText = '';
            if (data.decision === 'worth_it') {
                decisionColor = 'text-green-400';
                decisionText = '✅ Worth it';
            } else if (data.decision === 'risky') {
                decisionColor = 'text-yellow-400';
                decisionText = '⚠️ Risky';
            } else {
                decisionColor = 'text-red-400';
                decisionText = '❌ Not worth it';
            }

            document.getElementById('results-content').innerHTML = `
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold ${decisionColor} mb-2">${decisionText}</h3>
                    <p class="text-slate-300">{{ __('messages.decision_explanation') ?? 'Based on your inputs, here\'s the analysis:' }}</p>
                </div>

                <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-xl p-4 mb-6">
                    <p class="text-yellow-400 font-semibold text-center">{{ __('messages.stress_impact_fact') }}</p>
                </div>

                <div class="text-center mb-6">
                    <p class="text-slate-400 italic">{{ __('messages.tool_philosophy') }}</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-slate-800 p-6 rounded-xl">
                        <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.current_job') ?? 'Current Job' }}</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ __('messages.hourly_rate') ?? 'Hourly Rate' }}:</span>
                                <span class="text-white">${data.current.hourly_rate} ${currency}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ __('messages.weekly_hours') ?? 'Weekly Hours' }}:</span>
                                <span class="text-white">${data.current.total_hours_week}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ __('messages.stress_level') ?? 'Stress Level' }}:</span>
                                <span class="text-white">${data.current.stress}/10</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 p-6 rounded-xl">
                        <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.new_job') ?? 'New Job' }}</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ __('messages.hourly_rate') ?? 'Hourly Rate' }}:</span>
                                <span class="text-white">${data.new.hourly_rate} ${currency}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ __('messages.weekly_hours') ?? 'Weekly Hours' }}:</span>
                                <span class="text-white">${data.new.total_hours_week}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ __('messages.stress_level') ?? 'Stress Level' }}:</span>
                                <span class="text-white">${data.new.stress}/10</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl mb-8">
                    <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.risk_assessment') ?? 'Risk Assessment' }}</h4>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-slate-300">{{ __('messages.risk_score') ?? 'Risk Score' }}:</span>
                            <span class="text-xs text-slate-400 cursor-help" title="{{ __('messages.risk_calculation_tooltip') }}">ℹ️</span>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold ${data.risk_score < 40 ? 'text-green-400' : data.risk_score < 70 ? 'text-yellow-400' : 'text-red-400'}">${data.risk_score}/100</span>
                            <div class="text-sm text-slate-400">${getRiskLabel(data.risk_score)}</div>
                        </div>
                    </div>
                    <div class="w-full bg-slate-700 rounded-full h-4 mb-3 relative">
                        <div class="bg-gradient-to-r from-green-500 via-yellow-500 to-red-500 h-4 rounded-full transition-all duration-500" style="width: ${data.risk_score}%"></div>
                        <div class="absolute top-0 left-0 w-full h-4 flex">
                            <div class="flex-1 text-xs text-center text-white font-medium pt-1">Safe</div>
                            <div class="flex-1 text-xs text-center text-white font-medium pt-1">Risky</div>
                            <div class="flex-1 text-xs text-center text-white font-medium pt-1">Danger</div>
                        </div>
                    </div>
                    <br>
                    <div class="text-sm text-slate-400 mb-4">
                        ${getRiskExplanation(data.risk_score)}
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="text-center">
                            <div class="text-lg font-bold ${getBurnoutColor(data)}">${getBurnoutLevel(data)}</div>
                            <div class="text-slate-400">{{ __('messages.burnout_risk') ?? 'Burnout Risk' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold ${getEnergyColor(data)}">${getEnergyImpact(data)}%</div>
                            <div class="text-slate-400">{{ __('messages.energy_drop') ?? 'Energy Drop' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold ${getBalanceColor(data)}">${getBalanceLevel(data)}</div>
                            <div class="text-slate-400">{{ __('messages.work_life_balance') ?? 'Work-Life Balance' }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl mb-8">
                    <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.comparison') ?? 'Comparison' }}</h4>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold ${data.comparison.salary_increase >= 0 ? 'text-green-400' : 'text-red-400'}">${data.comparison.salary_increase}%</div>
                            <div class="text-sm text-slate-400">{{ __('messages.salary_increase') ?? 'Salary Increase' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold ${data.comparison.hourly_rate_change >= 0 ? 'text-green-400' : 'text-red-400'}">${data.comparison.hourly_rate_change}%</div>
                            <div class="text-sm text-slate-400">{{ __('messages.effective_hourly_value') ?? 'Effective Hourly Value' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold ${data.comparison.stress_increase <= 0 ? 'text-green-400' : 'text-red-400'}">${data.comparison.stress_increase}%</div>
                            <div class="text-sm text-slate-400">{{ __('messages.stress_increase') ?? 'Stress Increase' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold ${data.comparison.time_change_hours_year <= 0 ? 'text-green-400' : 'text-red-400'}">${data.comparison.time_change_hours_year}h</div>
                            <div class="text-sm text-slate-400">{{ __('messages.time_change_year') ?? 'Time Change/Year' }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl mb-8">
                    <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.why_risky') ?? 'Why This Is Risky' }}</h4>
                    <ul class="space-y-3 text-slate-300" id="risky-reasons">
                        <!-- Dynamic reasons will be inserted here -->
                    </ul>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl">
                    <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.final_advice') ?? 'Final Advice' }}</h4>
                    <p class="text-slate-300 leading-relaxed">
                        ${getAdviceText(data)}
                    </p>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl">
                    <h4 class="text-lg font-semibold text-white mb-4">💡 {{ __('messages.improve_outcome') ?? 'Improve this outcome by:' }}</h4>
                    <ul class="space-y-3 text-slate-300 mb-6">
                        <li class="flex items-start gap-3">
                            <span class="text-purple-400 mt-1">•</span>
                            <span>{{ __('messages.negotiation_tips') ?? 'Negotiating remote days' }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-purple-400 mt-1">•</span>
                            <span>{{ __('messages.reduce_hours') ?? 'Reducing weekly hours by 3–5' }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-purple-400 mt-1">•</span>
                            <span>{{ __('messages.stress_buffer') ?? 'Asking for a stress buffer period (first 3 months)' }}</span>
                        </li>
                    </ul>
                    <button onclick="recalculateWithImprovements()" class="w-full px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                        👉 {{ __('messages.recalculate_improvements') ?? 'Recalculate with improvements' }}
                    </button>
                </div>
            `;
        }

        function getAdviceText(data) {
            const stressChange = data.comparison.stress_increase;
            const salaryIncrease = data.comparison.salary_increase;
            const contractType = data.contract_type;

            if (data.decision === 'worth_it') {
                if (stressChange < -40) {
                    return "{{ __('messages.advice_stress_priority') ?? 'This change makes sense if reducing stress is your top priority. The psychological improvement may outweigh the limited financial gain and contract risks.' }}";
                }
                return "{{ __('messages.advice_worth_it_strong') ?? 'This change makes sense only if your priority is income growth in the short term (6-12 months). The financial benefits outweigh the risks, but monitor your stress levels closely.' }}";
            } else if (data.decision === 'risky') {
                if (stressChange < -30 && contractType !== 'permanent') {
                    return "{{ __('messages.advice_mixed_stress_contract') ?? 'This is a mixed decision. The significant stress reduction is positive, but the limited contract adds uncertainty. Consider if the psychological benefits justify the risks.' }}";
                }
                return "{{ __('messages.advice_risky_strong') ?? 'This change has both benefits and significant risks. Consider negotiating better terms or preparing for potential challenges. Without boundaries, burnout within 9-12 months is likely.' }}";
            } else {
                return "{{ __('messages.advice_not_worth_strong') ?? 'Based on your inputs, this change may not be worth the risks. The costs seem to outweigh the benefits significantly. Consider staying and seeking growth opportunities in your current role.' }}";
            }
        }

        function getRiskExplanation(score) {
            if (score < 40) {
                return "{{ __('messages.risk_explanation_safe') ?? 'This score indicates the job change is financially positive with manageable risks. The benefits likely outweigh the costs.' }}";
            } else if (score < 70) {
                return "{{ __('messages.risk_explanation_risky') ?? 'This score means the job change is financially positive but mentally costly. The risks are significant and should not be ignored.' }}";
            } else {
                return "{{ __('messages.risk_explanation_dangerous') ?? 'This score indicates high risk. The job change may lead to burnout, health issues, or regret within the first year.' }}";
            }
        }

        function getRiskLabel(score) {
            if (score < 40) {
                return "{{ __('messages.risk_label_low') ?? 'Low Risk Decision' }}";
            } else if (score < 70) {
                return "{{ __('messages.risk_label_medium') ?? 'High Risk Decision' }}";
            } else {
                return "{{ __('messages.risk_label_high') ?? 'Very High Risk Decision' }}";
            }
        }

        function generateRiskyReasons(data) {
            const reasons = [];

            // Primary reasons based on inputs
            if (data.comparison.salary_increase < 10) {
                reasons.push(
                    "{{ __('messages.low_salary_increase') ?? 'Low salary increase may not justify the transition costs' }}"
                    );
            }

            if (data.contract_type !== 'permanent') {
                reasons.push(
                    "{{ __('messages.limited_contract_risk') ?? 'Limited contract duration reduces stability and increases invisible psychological pressure' }}"
                    );
            }

            // Secondary reasons
            if (data.hidden_costs && data.hidden_costs.sleep_less) {
                reasons.push(
                    "{{ __('messages.sleep_reduction') ?? 'Reduced sleep can lead to long-term health issues' }}");
            }

            if (data.hidden_costs && data.hidden_costs.family_time_less) {
                reasons.push(
                    "{{ __('messages.family_time_reduction') ?? 'Less family time affects personal relationships and mental health' }}"
                    );
            }

            if (data.hidden_costs && data.hidden_costs.burnout_risk) {
                reasons.push("{{ __('messages.burnout_concern') ?? 'High burnout risk requires careful monitoring' }}");
            }

            // If no specific reasons, add general
            if (reasons.length === 0) {
                reasons.push(
                    "{{ __('messages.general_risks') ?? 'Consider all factors carefully before making the decision' }}"
                    );
            }

            return reasons;
        }

        function getBurnoutLevel(data) {
            const newStress = data.new.stress;
            const hasBurnoutRisk = data.hidden_costs && data.hidden_costs.burnout_risk;
            if (newStress <= 3 && !hasBurnoutRisk) return "{{ __('messages.low') ?? 'Low' }}";
            if (newStress <= 6) return "{{ __('messages.medium') ?? 'Medium' }}";
            return "{{ __('messages.high') ?? 'High' }}";
        }

        function getBurnoutColor(data) {
            const level = getBurnoutLevel(data);
            if (level === "{{ __('messages.low') ?? 'Low' }}") return "text-green-400";
            if (level === "{{ __('messages.medium') ?? 'Medium' }}") return "text-yellow-400";
            return "text-red-400";
        }

        function getEnergyImpact(data) {
            const stressChange = data.comparison.stress_increase;
            const sleepLess = data.hidden_costs && data.hidden_costs.sleep_less;
            let impact = stressChange * 0.5; // stress affects energy
            if (sleepLess) impact += 10;
            return Math.round(impact);
        }

        function getEnergyColor(data) {
            const impact = getEnergyImpact(data);
            if (impact < 0) return "text-green-400"; // improvement
            if (impact < 10) return "text-yellow-400";
            return "text-red-400";
        }

        function getBalanceLevel(data) {
            const timeChange = data.comparison.time_change_hours_year;
            const familyLess = data.hidden_costs && data.hidden_costs.family_time_less;
            if (timeChange <= 0 && !familyLess) return "{{ __('messages.better') ?? 'Better' }}";
            if (timeChange <= 50) return "{{ __('messages.same') ?? 'Same' }}";
            return "{{ __('messages.worse') ?? 'Worse' }}";
        }

        function getBalanceColor(data) {
            const level = getBalanceLevel(data);
            if (level === "{{ __('messages.better') ?? 'Better' }}") return "text-green-400";
            if (level === "{{ __('messages.same') ?? 'Same' }}") return "text-yellow-400";
            return "text-red-400";
        }

        function recalculateWithImprovements() {
            document.getElementById('results-section').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            currentStep = 1;
            updateProgress();
            // Don't reset the form, let user modify values
            document.getElementById('step1').scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const currencyDisplays = document.querySelectorAll('#currency-display, #currency-display-new');
            const currentCurrency = @json($currentCountry ? $currentCountry->currency_code : 'USD');
            currencyDisplays.forEach(display => display.textContent = currentCurrency);

            // Listen for country changes from navbar
            window.addEventListener('countryChanged', function(e) {
                console.log('💼 Job change received countryChanged event:', e.detail);
                const newCountry = e.detail;
                if (newCountry && newCountry.currency_code) {
                    currencyDisplays.forEach(display => display.textContent = newCountry.currency_code);
                }
            });

            // Try another scenario
            document.getElementById('try-again').addEventListener('click', function() {
                document.getElementById('results-section').classList.add('hidden');
                document.getElementById('step1').classList.remove('hidden');
                currentStep = 1;
                updateProgress();
                document.getElementById('job-form').reset();
            });
        });
    </script>
@endsection
