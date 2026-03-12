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
                <span class="text-slate-300">{{ __('messages.articles_loan_types_guide_title') }}</span>
            </nav>
        </div>
    </div>

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>📚</span>
                {{ __('messages.articles_loan_types_guide_category') }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {{ __('messages.articles_loan_types_guide_title') }}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {{ __('messages.articles_loan_types_guide_subtitle') }}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {{ __('messages.articles_loan_types_guide_reading_time') }}
            </div>
            
            <!-- Author and Publication Date -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="text-indigo-400">✍️</span>
                    <span>{{ __('messages.author') }}: <strong class="text-slate-300">{{ __('messages.author_name') }}</strong></span>
                </div>
                <div class="hidden sm:block text-slate-600">•</div>
                <div class="flex items-center gap-2">
                    <span class="text-indigo-400">📅</span>
                    <span>{{ __('messages.published') }}: <strong class="text-slate-300">{{ __('messages.published_date') }}</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles_loan_types_guide_intro_title') }}</h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    {{ __('messages.articles_loan_types_guide_intro_text') }}
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_loan_types_guide_types_title') }}</h2>

                <div class="space-y-8">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-indigo-500/20">
                        <h3 class="text-2xl font-semibold text-indigo-400 mb-3">{{ __('messages.articles_loan_types_guide_mortgage_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_loan_types_guide_mortgage_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>{{ __('messages.articles_loan_types_guide_mortgage_term') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_mortgage_rate') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_mortgage_matters') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_mortgage_risk') }}</strong></li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-purple-500/20">
                        <h3 class="text-2xl font-semibold text-purple-400 mb-3">{{ __('messages.articles_loan_types_guide_auto_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_loan_types_guide_auto_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>{{ __('messages.articles_loan_types_guide_auto_term') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_auto_rate') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_auto_collateral') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_auto_cost') }}</strong></li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-emerald-500/20">
                        <h3 class="text-2xl font-semibold text-emerald-400 mb-3">{{ __('messages.articles_loan_types_guide_student_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_loan_types_guide_student_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>{{ __('messages.articles_loan_types_guide_student_federal') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_student_private') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_student_grace') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_student_impact') }}</strong></li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-red-500/20">
                        <h3 class="text-2xl font-semibold text-red-400 mb-3">{{ __('messages.articles_loan_types_guide_personal_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_loan_types_guide_personal_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>{{ __('messages.articles_loan_types_guide_personal_term') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_personal_rate') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_personal_collateral') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_personal_speed') }}</strong></li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-yellow-500/20">
                        <h3 class="text-2xl font-semibold text-yellow-400 mb-3">{{ __('messages.articles_loan_types_guide_business_title') }}</h3>
                        <p class="text-slate-300 mb-3">{{ __('messages.articles_loan_types_guide_business_desc') }}</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>{{ __('messages.articles_loan_types_guide_business_types') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_business_requirements') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_business_risk') }}</strong></li>
                            <li><strong>{{ __('messages.articles_loan_types_guide_business_amount') }}</strong></li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_loan_types_guide_key_factors_title') }}</h2>

                <div class="bg-slate-800/50 rounded-xl p-6 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_loan_types_guide_apr_title') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_loan_types_guide_apr_desc') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_loan_types_guide_term_title') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_loan_types_guide_term_desc') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_loan_types_guide_fees_title') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_loan_types_guide_fees_desc') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles_loan_types_guide_credit_title') }}</h3>
                        <p class="text-slate-300">{{ __('messages.articles_loan_types_guide_credit_desc') }}</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_loan_types_guide_choose_title') }}</h2>

                <ol class="text-slate-300 space-y-4 ml-4">
                    <li>{{ __('messages.articles_loan_types_guide_choose_1') }}</li>
                    <li>{{ __('messages.articles_loan_types_guide_choose_2') }}</li>
                    <li>{{ __('messages.articles_loan_types_guide_choose_3') }}</li>
                    <li>{{ __('messages.articles_loan_types_guide_choose_4') }}</li>
                    <li>{{ __('messages.articles_loan_types_guide_choose_5') }}</li>
                    <li>{{ __('messages.articles_loan_types_guide_choose_6') }}</li>
                </ol>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">{{ __('messages.articles_loan_types_guide_mistakes_title') }}</h2>

                <div class="space-y-4">
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_loan_types_guide_mistake_1_title') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_loan_types_guide_mistake_1_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_loan_types_guide_mistake_2_title') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_loan_types_guide_mistake_2_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_loan_types_guide_mistake_3_title') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_loan_types_guide_mistake_3_desc') }}</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-red-400">{{ __('messages.articles_loan_types_guide_mistake_4_title') }}</strong>
                        <p class="ml-4 mt-1">{{ __('messages.articles_loan_types_guide_mistake_4_desc') }}</p>
                    </div>
                </div>

                <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-lg p-6 mt-12">
                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles_loan_types_guide_cta_title') }}</h3>
                    <p class="text-slate-300 mb-4">{{ __('messages.articles_loan_types_guide_cta_text') }}</p>
                    <a href="{{ url(app()->getLocale() . '/loan/simulation') }}" class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg transition duration-200">
                        {{ __('messages.articles_loan_types_guide_cta_button') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
