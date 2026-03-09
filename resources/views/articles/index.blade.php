@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">

        <!-- Header Section -->
        <section class="relative overflow-hidden">
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

            <div class="relative max-w-6xl mx-auto px-6 py-20 text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
                    {!! __('messages.articles_index_title') !!}
                </h1>
                <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                    {!! __('messages.articles_index_subtitle') !!}
                </p>
            </div>
        </section>

        <!-- Articles Grid -->
        <section class="py-20 bg-slate-950">
            <div class="max-w-6xl mx-auto px-6">

                <!-- Featured Article -->
                <div class="mb-20">
                    <h2 class="text-3xl font-bold text-white mb-8">{!! __('messages.featured_article') !!}</h2>
                    <div
                        class="bg-gradient-to-br from-indigo-900/30 to-purple-900/30 rounded-2xl p-8 md:p-12 border border-indigo-500/30 hover:border-indigo-500/60 transition">
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="md:w-2/3">
                                <div
                                    class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-3 py-1 rounded-full text-sm font-medium mb-4">
                                    <span>📊</span>
                                    {!! __('messages.featured') !!}
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-4">
                                    {!! __('messages.rent_vs_buy_title') !!}
                                </h3>
                                <p class="text-slate-300 text-lg mb-6">
                                    {!! __('messages.rent_vs_buy_description') !!}
                                </p>
                                <div class="flex flex-wrap gap-4 items-center">
                                    <a href="{{ url(app()->getLocale() . '/housing-loan-tips') }}"
                                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg transition">
                                        {!! __('messages.read_article') !!}
                                    </a>
                                    <span class="text-slate-400 text-sm">10 min read</span>
                                </div>
                            </div>
                            <div class="md:w-1/3 bg-slate-800/50 rounded-xl p-6 flex flex-col justify-center">
                                <div class="text-5xl mb-4">🏠</div>
                                <p class="text-slate-300 text-sm">
                                    {!! __('messages.featured_includes') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Articles -->
                <div>
                    <h2 class="text-3xl font-bold text-white mb-8">{!! __('messages.all_articles') !!}</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Article Card: Rent vs Buy -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-indigo-500/50 transition group">
                            <div class="text-4xl mb-4">🏠</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-400 transition">
                                {!! __('messages.rent_vs_buy_short_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.rent_vs_buy_short_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">{{ __('messages.articles.read_time') }} 10
                                    {{ __('messages.articles.minutes') }}</span>
                                <a href="{{ url(app()->getLocale() . '/housing-loan-tips') }}"
                                    class="text-indigo-400 hover:text-indigo-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Loan Types -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-purple-500/50 transition group">
                            <div class="text-4xl mb-4">💰</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition">
                                {!! __('messages.loan_types_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.loan_types_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">9 min read</span>
                                <a href="{{ url(app()->getLocale() . '/loan-types-guide') }}"
                                    class="text-purple-400 hover:text-purple-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Job Change -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-emerald-500/50 transition group">
                            <div class="text-4xl mb-4">💼</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition">
                                {!! __('messages.job_change_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.job_change_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">11 min read</span>
                                <a href="{{ url(app()->getLocale() . '/job-change-finance') }}"
                                    class="text-emerald-400 hover:text-emerald-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Interest Rates -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-yellow-500/50 transition group">
                            <div class="text-4xl mb-4">📈</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-400 transition">
                                {!! __('messages.interest_rates_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.interest_rates_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">10 min read</span>
                                <a href="{{ url(app()->getLocale() . '/understanding-interest-rates') }}"
                                    class="text-yellow-400 hover:text-yellow-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Financial Planning -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-pink-500/50 transition group">
                            <div class="text-4xl mb-4">🎯</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-pink-400 transition">
                                {!! __('messages.financial_planning_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.financial_planning_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">8 min read</span>
                                <a href="{{ url(app()->getLocale() . '/financial-planning') }}"
                                    class="text-pink-400 hover:text-pink-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Psychology of Debt -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-red-500/50 transition group">
                            <div class="text-4xl mb-4">🧠</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-red-400 transition">
                                {!! __('messages.psychology_debt_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.psychology_debt_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">12 min read</span>
                                <a href="{{ url(app()->getLocale() . '/psychology-of-debt') }}"
                                    class="text-red-400 hover:text-red-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Hidden Costs of Housing -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-cyan-500/50 transition group">
                            <div class="text-4xl mb-4">🏠</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-cyan-400 transition">
                                {!! __('messages.hidden_costs_housing_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.hidden_costs_housing_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">11 min read</span>
                                <a href="{{ url(app()->getLocale() . '/hidden-costs-housing-loans') }}"
                                    class="text-cyan-400 hover:text-cyan-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                        <!-- Article Card: Life Insurance -->
                        <div
                            class="bg-slate-900/50 rounded-xl p-6 border border-white/10 hover:border-pink-500/50 transition group">
                            <div class="text-4xl mb-4">🛡️</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-pink-400 transition">
                                {!! __('messages.life_insurance_title') !!}
                            </h3>
                            <p class="text-slate-300 text-sm mb-4">
                                {!! __('messages.life_insurance_desc') !!}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-400">{!! __('messages.life_insurance_reading_time') !!}</span>
                                <a href="{{ url(app()->getLocale() . '/life-insurance-guide') }}"
                                    class="text-pink-400 hover:text-pink-300 font-semibold text-sm">
                                    {!! __('messages.read_more') !!}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <!-- CTA Section -->
                <div
                    class="mt-20 bg-gradient-to-r from-indigo-900/30 to-purple-900/30 rounded-2xl p-12 text-center border border-indigo-500/30" style="padding: 50px;">
                    <h2 class="text-3xl font-bold text-white mb-4">
                        {!! __('messages.ready_transform_financial') !!}
                    </h2>
                    <p class="text-slate-300 text-lg mb-8 max-w-2xl mx-auto">
                        {!! __('messages.read_articles_understand') !!}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url(app()->getLocale() . '/loan/simulation') }}"
                            class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition">
                            {!! __('messages.start_loan_simulation') !!}
                        </a>
                        <a href="{{ url(app()->getLocale() . '/job-change/simulation') }}"
                            class="px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl transition">
                            {!! __('messages.compare_job_offers') !!}
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
