@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-purple-500/20 text-purple-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>💼</span>
                {{ __('messages.articles_job_change_finance_category') }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {{ __('messages.articles_job_change_finance_title') }}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {{ __('messages.articles_job_change_finance_subtitle') }}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {{ __('messages.articles_job_change_finance_reading_time') }}
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles_job_change_finance_intro_title') }}</h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    {{ __('messages.articles_job_change_finance_intro_text') }}
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_job_change_finance_hidden_costs_title') }}</h2>

                <div class="space-y-6">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-red-500/20">
                        <h3 class="text-2xl font-semibold text-red-400 mb-3">{{ __('messages.articles_job_change_finance_learning_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_job_change_finance_learning_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li>• {{ __('messages.articles_job_change_finance_learning_1') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_learning_2') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_learning_3') }}</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-orange-500/20">
                        <h3 class="text-2xl font-semibold text-orange-400 mb-3">{{ __('messages.articles_job_change_finance_relocation_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_job_change_finance_relocation_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li>• {{ __('messages.articles_job_change_finance_relocation_1') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_relocation_2') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_relocation_3') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_relocation_4') }}</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-yellow-500/20">
                        <h3 class="text-2xl font-semibold text-yellow-400 mb-3">{{ __('messages.articles_job_change_finance_benefits_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_job_change_finance_benefits_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li>• {{ __('messages.articles_job_change_finance_benefits_1') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_benefits_2') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_benefits_3') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_benefits_4') }}</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-pink-500/20">
                        <h3 class="text-2xl font-semibold text-pink-400 mb-3">{{ __('messages.articles_job_change_finance_time_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_job_change_finance_time_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li>• {{ __('messages.articles_job_change_finance_time_1') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_time_2') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_time_3') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_time_4') }}</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_job_change_finance_beyond_title') }}</h2>

                <p class="text-slate-300 mb-6">{{ __('messages.articles_job_change_finance_beyond_text') }}</p>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-slate-800/50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-3">{{ __('messages.articles_job_change_finance_benefits_to_consider') }}</h3>
                        <ul class="text-slate-300 space-y-2">
                            <li>• {{ __('messages.articles_job_change_finance_bonus') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_stock') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_development') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_remote') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_flexible_hours') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_wellness') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_retirement') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_assistance') }}</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-3">{{ __('messages.articles_job_change_finance_costs_reduce') }}</h3>
                        <ul class="text-slate-300 space-y-2">
                            <li>• {{ __('messages.articles_job_change_finance_taxes') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_living') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_commute') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_childcare') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_unvested') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_risk') }}</li>
                            <li>• {{ __('messages.articles_job_change_finance_health_costs') }}</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_job_change_finance_hourly_title') }}</h2>

                <p class="text-slate-300 mb-4">{{ __('messages.articles_job_change_finance_hourly_text') }}</p>

                <div class="bg-slate-800/50 rounded-xl p-6 space-y-4">
                    <div>
                        <p class="text-slate-300"><strong class="text-white">{{ __('messages.articles_job_change_finance_calculation') }}</strong></p>
                    </div>
                    <div class="text-slate-300">
                        <p><strong>Example:</strong></p>
                        <p>• {{ __('messages.articles_job_change_finance_example_current') }}</p>
                        <p>• {{ __('messages.articles_job_change_finance_example_new') }}</p>
                        <p>{{ __('messages.articles_job_change_finance_example_note') }}</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_job_change_finance_questions_title') }}</h2>

                <ol class="text-slate-300 space-y-3 ml-4">
                    <li><strong>1. {{ __('messages.articles_job_change_finance_question_1') }}</strong></li>
                    <li><strong>2. {{ __('messages.articles_job_change_finance_question_2') }}</strong></li>
                    <li><strong>3. {{ __('messages.articles_job_change_finance_question_3') }}</strong></li>
                    <li><strong>4. {{ __('messages.articles_job_change_finance_question_4') }}</strong></li>
                    <li><strong>5. {{ __('messages.articles_job_change_finance_question_5') }}</strong></li>
                    <li><strong>6. {{ __('messages.articles_job_change_finance_question_6') }}</strong></li>
                    <li><strong>7. {{ __('messages.articles_job_change_finance_question_7') }}</strong></li>
                </ol>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_job_change_finance_sense_title') }}</h2>

                <p class="text-slate-300 mb-4">{{ __('messages.articles_job_change_finance_sense_text') }}</p>

                <div class="space-y-3">
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_job_change_finance_sense_1') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_job_change_finance_sense_1_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_job_change_finance_sense_2') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_job_change_finance_sense_2_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_job_change_finance_sense_3') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_job_change_finance_sense_3_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_job_change_finance_sense_4') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_job_change_finance_sense_4_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_job_change_finance_sense_5') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_job_change_finance_sense_5_desc') }}</p>
                    </div>
                </div>

                <div class="bg-purple-900/20 border border-purple-500/30 rounded-lg p-6 mt-12">
                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles_job_change_finance_analyze_title') }}</h3>
                    <p class="text-slate-300 mb-4">{{ __('messages.articles_job_change_finance_analyze_text') }}</p>
                    <a href="{{ url(app()->getLocale() . '/job-change/simulation') }}" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-lg transition duration-200">
                        {{ __('messages.articles_job_change_finance_compare_offers') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
