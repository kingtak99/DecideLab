@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <!-- Glow Effects -->
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-indigo-600/20 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-6 py-20 text-center">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-sm font-medium mb-6">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: #7c3aed;"></span>
                    <span>{{ __('messages.life_shock_title') ?? 'Life Shock Calculator' }}</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    ⏳ <span class="text-purple-400">{{ __('messages.life_shock_hero_title') ?? 'How much of your life will pass without you realizing?' }}</span>
                </h1>

                <p class="text-lg text-slate-300 max-w-3xl mx-auto mb-10">
                    {{ __('messages.life_shock_hero_description') ?? 'DecideLab turns wasted time into numbers… and numbers hurt.' }}
                </p>

                <a href="#step1" class="inline-flex items-center gap-2 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                    {{ __('messages.calculate_shock_now') ?? '😬 Calculate the Shock Now' }}
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
                        <span class="text-slate-400 text-sm">{{ __('messages.progress') ?? 'Progress' }}</span>
                        <span id="progress-text" class="text-slate-400 text-sm">Step 1 of 5</span>
                    </div>
                    <div class="w-full bg-slate-700 rounded-full h-2">
                        <div id="progress-bar" class="bg-purple-500 h-2 rounded-full transition-all duration-300" style="width: 16.67%"></div>
                    </div>
                </div>

                <!-- Step 1: Age -->
                <div id="step1" class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8">
                    <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.how_old_are_you') ?? 'How old are you?' }}</h2>

                    <form id="shock-form" class="space-y-6">
                        @csrf

                        <div>
                            <label for="age" class="block text-sm font-medium text-slate-300 mb-2">
                                🎂 {{ __('messages.your_age') ?? 'Your Age' }}
                            </label>
                            <input type="number" id="age" name="age" min="1" max="120" class="w-full px-4 py-3 bg-slate-800 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="25" required>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="nextStep(2)" class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition"
                            style="background-color: #0a0d1e;">
                                {{ __('messages.next') ?? 'Next' }} →
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 2: Social Media -->
                <div id="step2" class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.daily_habits') ?? 'Your Daily Habits' }}</h2>

                    <div class="space-y-6">
                        <div>
                            <label for="social_media_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                📱 {{ __('messages.social_media_hours') ?? 'Hours on Social Media per day' }}
                            </label>
                            <input type="range" id="social_media_hours" name="social_media_hours" min="0" max="12" value="2" class="w-full" oninput="updateValue('social_media_hours')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0h</span>
                                <span id="social_media_hours_value" class="font-semibold">2h</span>
                                <span>12h</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="prevStep(1)" class="flex-1 px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                ← {{ __('messages.previous') ?? 'Previous' }}
                            </button>
                            <button type="button" onclick="nextStep(3)" style="background-color: #0a0d1e;" class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                                {{ __('messages.next') ?? 'Next' }} →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Video/Content -->
                <div id="step3" class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <div class="space-y-6">
                        <div>
                            <label for="video_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                📺 {{ __('messages.video_hours') ?? 'Hours watching videos/content per day' }}
                            </label>
                            <input type="range" id="video_hours" name="video_hours" min="0" max="12" value="1" class="w-full" oninput="updateValue('video_hours')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0h</span>
                                <span id="video_hours_value" class="font-semibold">1h</span>
                                <span>12h</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="prevStep(2)" class="flex-1 px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                ← {{ __('messages.previous') ?? 'Previous' }}
                            </button>
                            <button type="button" onclick="nextStep(4)" style="background-color: #0a0d1e;" class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                                {{ __('messages.next') ?? 'Next' }} →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Gaming & Wasting -->
                <div id="step4" class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <div class="space-y-6">
                        <div>
                            <label for="gaming_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                🎮 {{ __('messages.gaming_hours') ?? 'Hours gaming per day' }}
                            </label>
                            <input type="range" id="gaming_hours" name="gaming_hours" min="0" max="12" value="0" class="w-full" oninput="updateValue('gaming_hours')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0h</span>
                                <span id="gaming_hours_value" class="font-semibold">0h</span>
                                <span>12h</span>
                            </div>
                        </div>

                        <div>
                            <label for="wasting_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                🌀 {{ __('messages.wasting_hours') ?? 'Hours wasting time aimlessly per day' }}
                            </label>
                            <input type="range" id="wasting_hours" name="wasting_hours" min="0" max="12" value="1" class="w-full" oninput="updateValue('wasting_hours')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0h</span>
                                <span id="wasting_hours_value" class="font-semibold">1h</span>
                                <span>12h</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="prevStep(3)" class="flex-1 px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                ← {{ __('messages.previous') ?? 'Previous' }}
                            </button>
                            <button type="button" onclick="nextStep(5)" style="background-color: #0a0d1e;" class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                                {{ __('messages.next') ?? 'Next' }} →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Sleep & Work -->
                <div id="step5" class="step bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <div class="space-y-6">
                        <div>
                            <label for="sleep_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                😴 {{ __('messages.sleep_hours') ?? 'Hours of sleep per night' }}
                            </label>
                            <input type="range" id="sleep_hours" name="sleep_hours" min="4" max="12" value="8" class="w-full" oninput="updateValue('sleep_hours')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>4h</span>
                                <span id="sleep_hours_value" class="font-semibold">8h</span>
                                <span>12h</span>
                            </div>
                        </div>

                        <div>
                            <label for="work_hours" class="block text-sm font-medium text-slate-300 mb-2">
                                💼 {{ __('messages.work_hours') ?? 'Work/study hours per day' }}
                            </label>
                            <input type="range" id="work_hours" name="work_hours" min="0" max="16" value="8" class="w-full" oninput="updateValue('work_hours')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0h</span>
                                <span id="work_hours_value" class="font-semibold">8h</span>
                                <span>16h</span>
                            </div>
                        </div>

                        <div>
                            <label for="work_days" class="block text-sm font-medium text-slate-300 mb-2">
                                📅 {{ __('messages.work_days') ?? 'Work/study days per week' }}
                            </label>
                            <input type="range" id="work_days" name="work_days" min="0" max="7" value="5" class="w-full" oninput="updateValue('work_days')" required>
                            <div class="flex justify-between text-xs text-slate-400 mt-1">
                                <span>0</span>
                                <span id="work_days_value" class="font-semibold">5</span>
                                <span>7</span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="prevStep(4)" class="flex-1 px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                                ← {{ __('messages.previous') ?? 'Previous' }}
                            </button>
                            <button type="button" onclick="calculateLifeShock()" style="background-color: #0a0d1e;" class="flex-1 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                                {{ __('messages.calculate_shock') ?? 'Calculate the Shock' }} →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Loading -->
                <div id="loading" class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 mb-8 hidden">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-500 mx-auto mb-4"></div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ __('messages.calculating') ?? '⏳ Calculating...' }}</h3>
                        <p class="text-slate-400">{{ __('messages.most_people_underestimate') ?? 'Most people underestimate this number.' }}</p>
                    </div>
                </div>

                <!-- Results Section -->
                <div id="results-section" class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.the_shock') ?? '😬 The Shock' }}</h2>

                    <div id="results-content" class="space-y-6">
                        <!-- Results will be populated by JavaScript -->
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-700">
                        <button id="try-again" class="w-full px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition mb-4">
                            {{ __('messages.try_another_scenario') ?? 'Try Another Scenario' }}
                        </button>
                        <button id="improve-scenario" class="w-full px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition">
                            {{ __('messages.what_if_one_hour') ?? '👉 What if you changed just ONE hour a day?' }}
                        </button>
                    </div>
                </div>

                <!-- Improved Scenario -->
                <div id="improved-section" class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 border border-white/10 hidden">
                    <h2 class="text-2xl font-bold mb-6 text-white">{{ __('messages.improved_scenario') ?? '🌱 Improved Scenario' }}</h2>

                    <div id="improved-content" class="space-y-6">
                        <!-- Improved results will be shown here -->
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-700">
                        <button onclick="shareResult()" class="w-full px-8 py-4 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-xl transition mb-4">
                            {{ __('messages.share_result') ?? '📤 Share Your Result' }}
                        </button>
                        <button onclick="resetCalculator()" class="w-full px-8 py-4 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-xl transition">
                            {{ __('messages.start_over') ?? '🔄 Start Over' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 5; // Steps 1-5, then results

        // Translations object for JavaScript - safely encoded from PHP
        const translations = {!! json_encode([
            'years_on_social' => __('messages.years_on_social') ?: 'Years on Social Media',
            'years_on_video' => __('messages.years_on_video') ?: 'Years on Videos',
            'years_on_gaming' => __('messages.years_on_gaming') ?: 'Years Gaming',
            'years_wasting' => __('messages.years_wasting') ?: 'Years Wasting Time',
            'if_you_continue' => __('messages.if_you_continue') ?: 'If nothing changes:',
            'total_shock' => __('messages.total_shock') ?: 'Total Shock',
            'years_of_your_life' => __('messages.years_of_your_life') ?: 'Years of your life',
            'time_passes_unnoticed' => __('messages.time_passes_unnoticed') ?: 'This time will pass without you noticing it.',
            'reality_check_days' => __('messages.reality_check_days') ?: 'That\'s over',
            'reality_check_hours' => __('messages.reality_check_hours') ?: '',
            'days' => __('messages.days') ?: 'days',
            'hours' => __('messages.hours') ?: 'hours',
            'painful_comparison' => __('messages.painful_comparison') ?: 'This is longer than your entire life so far.',
            'time_quietly_disappears' => __('messages.time_quietly_disappears') ?: 'This is where your time quietly disappears:',
            'time_leaks_protection' => __('messages.time_leaks_protection') ?: 'Not because you\'re lazy — but because time leaks quietly.',
            'biggest_time_leaks' => __('messages.biggest_time_leaks') ?: 'Your Biggest Time Leaks',
            'decidelab_human_line' => __('messages.decidelab_human_line') ?: 'DecideLab doesn\'t judge you. It just shows what time hides.',
            'what_if_one_hour' => __('messages.what_if_one_hour') ?: '👉 What if you took back just ONE hour a day?',
            'time_you_can_never_get_back' => __('messages.time_you_can_never_get_back') ?: 'That\'s time you can never get back.'
        ]) !!};

        function updateValue(id) {
            const element = document.getElementById(id);
            const valueElement = document.getElementById(id + '_value');
            if (valueElement) {
                if (id.includes('days')) {
                    valueElement.textContent = element.value;
                } else {
                    valueElement.textContent = element.value + 'h';
                }
            }
        }

        function validateStep(step) {
            const requiredFields = {
                1: ['age'],
                2: ['social_media_hours'],
                3: ['video_hours'],
                4: ['gaming_hours', 'wasting_hours'],
                5: ['sleep_hours', 'work_hours', 'work_days']
            };

            const fields = requiredFields[step];
            for (const field of fields) {
                const element = document.getElementById(field);
                if (!element || !element.value) {
                    alert(`Please fill in all required fields in Step ${step}.`);
                    element.focus();
                    return false;
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

        function calculateLifeShock() {
            if (!validateStep(currentStep)) return;

            // Show loading
            document.getElementById('step5').classList.add('hidden');
            document.getElementById('loading').classList.remove('hidden');

            const formData = new FormData();
            const allInputs = document.querySelectorAll('input[name]');
            allInputs.forEach(input => {
                formData.append(input.name, input.value);
            });

            fetch('{{ route("life.shock.calculate", ["locale" => $locale]) }}', {
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
                    document.getElementById('loading').classList.add('hidden');
                    document.getElementById('step5').classList.remove('hidden');
                    return;
                }

                // Hide loading, show results
                document.getElementById('loading').classList.add('hidden');
                document.getElementById('results-section').classList.remove('hidden');

                displayResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                document.getElementById('loading').classList.add('hidden');
                document.getElementById('step5').classList.remove('hidden');
            });
        }

        function displayResults(data) {
            // Sort activities by impact (highest first)
            const activities = [
                { name: translations.years_on_social, value: data.years_on_social, color: 'text-blue-400', icon: '📱' },
                { name: translations.years_on_video, value: data.years_on_video, color: 'text-green-400', icon: '📺' },
                { name: translations.years_on_gaming, value: data.years_on_gaming, color: 'text-purple-400', icon: '🎮' },
                { name: translations.years_wasting, value: data.years_wasting, color: 'text-orange-400', icon: '🌀' }
            ].sort((a, b) => b.value - a.value);

            // Calculate reality check numbers
            const totalDays = data.total_days_wasted;
            const totalHours = data.total_hours_wasted;

            document.getElementById('results-content').innerHTML = `
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-red-400 mb-4">${translations.if_you_continue}</h3>
                </div>

                <!-- Total Shock - BIG AND PROMINENT -->
                <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-8 mb-6 text-center">
                    <h4 class="text-xl font-bold text-red-400 mb-4">${translations.total_shock}</h4>
                    <div class="text-9xl font-bold text-red-400 mb-1">${data.total_years_wasted}</div>
                    <div class="text-lg text-red-300 mb-6">${translations.years_of_your_life}</div>
                    <p class="text-slate-300 text-base mb-4">${translations.time_passes_unnoticed}</p>

                    <!-- Reality Check -->
                    <div class="bg-slate-700/50 rounded-lg p-4 mt-4">
                        <p class="text-slate-400 text-sm mb-1">${translations.reality_check_days} <span class="text-lg font-semibold text-slate-300">${totalDays.toLocaleString()}</span> <span class="text-xs text-slate-500">${translations.days}</span></p>
                        <p class="text-slate-400 text-sm mb-2">${translations.reality_check_hours} <span class="text-lg font-semibold text-slate-300">${totalHours.toLocaleString()}</span> <span class="text-xs text-slate-500">${translations.hours}</span></p>
                        <p class="text-slate-500 text-xs italic">${translations.time_you_can_never_get_back}</p>
                    </div>
                </div>

                <!-- Painful Comparison -->
                <div class="bg-slate-800/50 border border-slate-600 rounded-xl p-6 mb-8">
                    <p class="text-slate-300 text-center text-lg italic">${translations.painful_comparison}</p>
                </div>

                <!-- Biggest Time Leaks -->
                <div class="mb-8">
                    <div class="text-center mb-4">
                        <p class="text-slate-400 text-sm italic mb-2">${translations.time_leaks_protection}</p>
                        <p class="text-slate-400 text-sm italic mb-2">${translations.time_quietly_disappears}</p>
                        <h4 class="text-xl font-bold text-white">${translations.biggest_time_leaks}</h4>
                    </div>
                    <div class="space-y-4">
                        ${activities.map(activity => `
                            <div class="bg-slate-800 p-6 rounded-xl flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">${activity.icon}</span>
                                    <span class="text-white font-medium">${activity.name}</span>
                                </div>
                                <div class="text-3xl font-bold ${activity.color}">${activity.value}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>

                <!-- Human Line -->
                <div class="bg-slate-800/30 border border-slate-700 rounded-xl p-6 mb-8 text-center">
                    <p class="text-slate-400 italic">${translations.decidelab_human_line}</p>
                </div>
            `;
        }

        document.getElementById('improve-scenario').addEventListener('click', function() {
            // Simulate improved calculation
            const socialMedia = parseFloat(document.getElementById('social_media_hours').value);
            const improvedSocial = Math.max(0, socialMedia - 1);

            // Recalculate with improved values
            const formData = new FormData();
            const allInputs = document.querySelectorAll('input[name]');
            allInputs.forEach(input => {
                let value = input.value;
                if (input.name === 'social_media_hours') {
                    value = improvedSocial;
                }
                formData.append(input.name, value);
            });

            fetch('{{ route("life.shock.calculate", ["locale" => $locale]) }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('results-section').classList.add('hidden');
                document.getElementById('improved-section').classList.remove('hidden');

                document.getElementById('improved-content').innerHTML = `
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-green-400 mb-4">{{ __('messages.small_changes_save') ?? 'Small changes save you:' }}</h3>
                        <div class="text-6xl font-bold text-green-400 mb-4">${data.years_saved} {{ __('messages.years') ?? 'Years' }}</div>
                    </div>

                    <div class="bg-slate-800 p-6 rounded-xl">
                        <h4 class="text-lg font-semibold text-white mb-4">{{ __('messages.what_changed') ?? 'What changed:' }}</h4>
                        <ul class="space-y-2 text-slate-300">
                            <li>• {{ __('messages.reduced_social') ?? 'Reduced social media by 1 hour/day' }}</li>
                            <li>• {{ __('messages.added_learning') ?? 'Added 30 minutes of learning/day' }}</li>
                        </ul>
                    </div>
                `;
            });
        });

        function shareResult() {
            const text = "{{ __('messages.share_text') ?? 'I discovered I will waste X years of my life without realizing it. Calculate yours at DecideLab!' }}";
            if (navigator.share) {
                navigator.share({
                    title: 'Life Shock Calculator',
                    text: text,
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(text + ' ' + window.location.href);
                alert('{{ __('messages.copied_to_clipboard') ?? 'Copied to clipboard!' }}');
            }
        }

        function resetCalculator() {
            document.getElementById('improved-section').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            currentStep = 1;
            updateProgress();
            document.getElementById('shock-form').reset();
            // Reset values
            updateValue('social_media_hours');
            updateValue('video_hours');
            updateValue('gaming_hours');
            updateValue('wasting_hours');
            updateValue('sleep_hours');
            updateValue('work_hours');
            updateValue('work_days');
        }

        document.getElementById('try-again').addEventListener('click', resetCalculator);

        // Initialize values
        document.addEventListener('DOMContentLoaded', function() {
            updateValue('social_media_hours');
            updateValue('video_hours');
            updateValue('gaming_hours');
            updateValue('wasting_hours');
            updateValue('sleep_hours');
            updateValue('work_hours');
            updateValue('work_days');
        });
    </script>
@endsection