@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Breadcrumbs -->
    <div class="bg-slate-900/30 border-b border-white/10">
        <div class="max-w-4xl mx-auto px-6 py-3">
            <nav class="flex items-center gap-2 text-sm text-slate-400">
                <a href="{{ url('/') }}" class="hover:text-white transition">{{ __('messages.home') }}</a>
                <span class="text-slate-600">{{ __('messages.breadcrumb_separator') }}</span>
                <a href="{{ url(app()->getLocale() . '/articles') }}" class="hover:text-white transition">{{ __('messages.articles') }}</a>
                <span class="text-slate-600">{{ __('messages.breadcrumb_separator') }}</span>
                <span class="text-slate-300">{{ __('messages.articles_life_insurance_guide_title') }}</span>
            </nav>
        </div>
    </div>

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-pink-500/20 text-pink-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>🛡️</span>
                {{ __('messages.articles_life_insurance_guide_category') }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {{ __('messages.articles_life_insurance_guide_title') }}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {{ __('messages.articles_life_insurance_guide_subtitle') }}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {{ __('messages.articles_life_insurance_guide_reading_time') }}
            </div>
            
            <!-- Author and Publication Date -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="text-pink-400">✍️</span>
                    <span>{{ __('messages.author') }}: <strong class="text-slate-300">{{ __('messages.author_name') }}</strong></span>
                </div>
                <div class="hidden sm:block text-slate-600">•</div>
                <div class="flex items-center gap-2">
                    <span class="text-pink-400">📅</span>
                    <span>{{ __('messages.published') }}: <strong class="text-slate-300">{{ __('messages.published_date') }}</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles_life_insurance_guide_intro_title') }}</h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    {{ __('messages.articles_life_insurance_guide_intro_text') }}
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_life_insurance_guide_need_title') }}</h2>

                <p class="text-slate-300 mb-4">{{ __('messages.articles_life_insurance_guide_need_text') }}</p>

                <div class="space-y-3">
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_life_insurance_guide_dependents') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_dependents_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_life_insurance_guide_debt') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_debt_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_life_insurance_guide_obligations') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_obligations_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-emerald-400">✓ {{ __('messages.articles_life_insurance_guide_income') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_income_desc') }}</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_life_insurance_guide_types_title') }}</h2>

                <div class="space-y-8">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-blue-500/20">
                        <h3 class="text-2xl font-semibold text-blue-400 mb-3">{{ __('messages.articles_life_insurance_guide_term_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_life_insurance_guide_term_desc') }}</p>
                        
                        <div class="space-y-3">
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_term_pros') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_pros_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_pros_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_pros_3') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_pros_4') }}</li>
                                </ul>
                            </div>
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_term_cons') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_cons_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_cons_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_term_cons_3') }}</li>
                                </ul>
                            </div>
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_term_cost') }}</strong>
                                <p class="text-slate-300 ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_term_cost') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-purple-500/20">
                        <h3 class="text-2xl font-semibold text-purple-400 mb-3">{{ __('messages.articles_life_insurance_guide_whole_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_life_insurance_guide_whole_desc') }}</p>
                        
                        <div class="space-y-3">
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_whole_pros') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_pros_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_pros_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_pros_3') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_pros_4') }}</li>
                                </ul>
                            </div>
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_whole_cons') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_cons_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_cons_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_cons_3') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_whole_cons_4') }}</li>
                                </ul>
                            </div>
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_whole_cost') }}</strong>
                                <p class="text-slate-300 ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_whole_cost') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-emerald-500/20">
                        <h3 class="text-2xl font-semibold text-emerald-400 mb-3">{{ __('messages.articles_life_insurance_guide_universal_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_life_insurance_guide_universal_desc') }}</p>
                        
                        <div class="space-y-3">
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_universal_pros') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_universal_pros_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_universal_pros_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_universal_pros_3') }}</li>
                                </ul>
                            </div>
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_universal_cons') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_universal_cons_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_universal_cons_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_universal_cons_3') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-yellow-500/20">
                        <h3 class="text-2xl font-semibold text-yellow-400 mb-3">{{ __('messages.articles_life_insurance_guide_variable_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_life_insurance_guide_variable_desc') }}</p>
                        
                        <div class="space-y-3">
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_variable_pros') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_pros_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_pros_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_pros_3') }}</li>
                                </ul>
                            </div>
                            <div>
                                <strong class="text-white">{{ __('messages.articles_life_insurance_guide_variable_cons') }}</strong>
                                <ul class="text-slate-300 ml-4 mt-1 space-y-1">
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_cons_1') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_cons_2') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_cons_3') }}</li>
                                    <li>• {{ __('messages.articles_life_insurance_guide_variable_cons_4') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_life_insurance_guide_how_much_title') }}</h2>

                <p class="text-slate-300 mb-4">{{ __('messages.articles_life_insurance_guide_how_much_text') }}</p>

                <div class="bg-slate-800/50 rounded-xl p-6 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_life_insurance_guide_income_replacement') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_life_insurance_guide_income_calc') }}</p>
                        <p class="text-slate-300 ml-4 mt-1 text-sm">{{ __('messages.articles_life_insurance_guide_income_example') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_life_insurance_guide_debt_coverage') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_life_insurance_guide_debt_calc') }}</p>
                        <p class="text-slate-300 ml-4 mt-1 text-sm">{{ __('messages.articles_life_insurance_guide_debt_example') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_life_insurance_guide_future_needs') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_life_insurance_guide_future_calc') }}</p>
                        <p class="text-slate-300 ml-4 mt-1 text-sm">{{ __('messages.articles_life_insurance_guide_future_example') }}</p>
                    </div>
                    <div class="border-t border-slate-700 pt-4">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_life_insurance_guide_total_needed') }}</h3>
                        <p class="text-slate-300 ml-4">{{ __('messages.articles_life_insurance_guide_total_calc') }}</p>
                        <p class="text-slate-300 ml-4 text-sm mt-2">{{ __('messages.articles_life_insurance_guide_total_note') }}</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_life_insurance_guide_premiums_title') }}</h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-slate-800/50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-3">{{ __('messages.articles_life_insurance_guide_factors_control') }}</h3>
                        <ul class="text-slate-300 space-y-2">
                            <li>✓ {{ __('messages.articles_life_insurance_guide_quit_smoking') }}</li>
                            <li>✓ {{ __('messages.articles_life_insurance_guide_healthy_weight') }}</li>
                            <li>✓ {{ __('messages.articles_life_insurance_guide_exercise') }}</li>
                            <li>✓ {{ __('messages.articles_life_insurance_guide_avoid_risks') }}</li>
                            <li>✓ {{ __('messages.articles_life_insurance_guide_quotes') }}</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-3">{{ __('messages.articles_life_insurance_guide_factors_no_control') }}</h3>
                        <ul class="text-slate-300 space-y-2">
                            <li>✗ {{ __('messages.articles_life_insurance_guide_age') }}</li>
                            <li>✗ {{ __('messages.articles_life_insurance_guide_gender') }}</li>
                            <li>✗ {{ __('messages.articles_life_insurance_guide_family_history') }}</li>
                            <li>✗ {{ __('messages.articles_life_insurance_guide_pre_existing') }}</li>
                            <li>✗ {{ __('messages.articles_life_insurance_guide_hazardous_job') }}</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_life_insurance_guide_best_rate_title') }}</h2>

                <ol class="text-slate-300 space-y-3 ml-4">
                    <li><strong>1. </strong>{{ __('messages.articles_life_insurance_guide_apply_young') }}</li>
                    <li><strong>2. </strong>{{ __('messages.articles_life_insurance_guide_health_order') }}</li>
                    <li><strong>3. </strong>{{ __('messages.articles_life_insurance_guide_compare_quotes') }}</li>
                    <li><strong>4. </strong>{{ __('messages.articles_life_insurance_guide_honest_application') }}</li>
                    <li><strong>5. </strong>{{ __('messages.articles_life_insurance_guide_appropriate_coverage') }}</li>
                    <li><strong>6. </strong>{{ __('messages.articles_life_insurance_guide_term_most') }}</li>
                    <li><strong>7. </strong>{{ __('messages.articles_life_insurance_guide_bundle') }}</li>
                </ol>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_life_insurance_guide_mistakes_title') }}</h2>

                <div class="space-y-4">
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_life_insurance_guide_mistake_1') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_mistake_1_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_life_insurance_guide_mistake_2') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_mistake_2_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_life_insurance_guide_mistake_3') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_mistake_3_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_life_insurance_guide_mistake_4') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_mistake_4_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_life_insurance_guide_mistake_5') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_life_insurance_guide_mistake_5_desc') }}</p>
                    </div>
                </div>

                <div class="bg-pink-900/20 border border-pink-500/30 rounded-lg p-6 mt-12">
                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles_life_insurance_guide_protect_future_title') }}</h3>
                    <p class="text-slate-300">{{ __('messages.articles_life_insurance_guide_protect_future_text') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
