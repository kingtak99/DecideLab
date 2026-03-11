@extends('layouts.app')

@section('content')
    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <!-- Glow -->
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-32 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                🧠 {!! __('messages.hero_title') !!}
                <span class="text-indigo-400 block mt-2">
                    {!! __('messages.hero_subtitle') !!}
                </span>
            </h1>

            <p class="mt-6 text-lg text-slate-300 max-w-3xl mx-auto">
                {!! __('messages.hero_description') !!}
            </p>

            <div class="mt-10 flex justify-center gap-4 flex-wrap">
                <a href="#job-change"
                    class="px-8 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition font-bold text-lg">
                    {!! __('messages.start_simulation') !!}
                </a>

                {{-- <a href="#tools"
                    class="px-8 py-4 rounded-xl border border-white/20 hover:border-indigo-400 transition text-lg">
                    {!! __('messages.explore_tools') !!}
                </a> --}}
            </div>
        </div>
    </section>

    <!-- WHY FINANCIAL SIMULATIONS MATTER -->
    <section class="py-24 bg-slate-900">
        <div class="max-w-4xl mx-auto px-6">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold mb-6 text-white">
                    {!! __('messages.why_simulations_title') !!}
                </h2>
                <p class="text-slate-400 text-lg">
                    {!! __('messages.why_simulations_subtitle') !!}
                </p>
            </div>

            <div class="prose prose-lg prose-invert mx-auto">
                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.simulations_intro') !!}
                </p>

                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.simulations_power') !!}
                </p>

                <h3 class="text-2xl font-bold text-white mb-4 mt-8">{!! __('messages.hidden_costs_title') !!}</h3>
                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.hidden_costs_text') !!}
                </p>
                <ul class="text-slate-300 space-y-2 mb-6 ml-6">
                    <li>• {!! __('messages.opportunity_cost') !!}</li>
                    <li>• {!! __('messages.maintenance_costs') !!}</li>
                    <li>• {!! __('messages.lifestyle_restrictions') !!}</li>
                    <li>• {!! __('messages.rate_changes_impact') !!}</li>
                    <li>• {!! __('messages.savings_impact') !!}</li>
                </ul>

                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.simulation_advantage') !!}
                </p>

                <h3 class="text-2xl font-bold text-white mb-4 mt-8">{!! __('messages.decidelab_difference_title') !!}</h3>
                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.decidelab_difference_text') !!}
                </p>
                <ul class="text-slate-300 space-y-2 mb-6 ml-6">
                    <li>• {!! __('messages.life_cost_calculation') !!}</li>
                    <li>• {!! __('messages.job_change_real_cost') !!}</li>
                    <li>• {!! __('messages.home_decision_alignment') !!}</li>
                    <li>• {!! __('messages.stress_lifestyle_impact') !!}</li>
                </ul>

                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.decidelab_benefit') !!}
                </p>

                <p class="text-slate-300 leading-relaxed mb-6">
                    {!! __('messages.final_thought') !!}
                </p>
            </div>

        </div>
    </section>



    <!-- FEATURED INSIGHTS -->
    <section class="py-24 bg-slate-900/50 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4">{{ __('messages.home_financial_insights_title') }}</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                    {{ __('messages.home_financial_insights_desc') }}
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-10">
                <!-- Article Card 1 -->
                <a href="{{ url($locale . '/housing-loan-tips') }}"
                    class="group bg-slate-800 rounded-2xl p-6 border border-white/5 hover:border-indigo-500 transition">
                    <div class="text-4xl mb-4">🏠</div>
                    <h3 class="text-xl font-bold text-white group-hover:text-indigo-400 transition mb-2">
                        {{ __('messages.home_article_rent_vs_buy_title') }}
                    </h3>
                    <p class="text-slate-300 text-sm mb-4">
                        {{ __('messages.home_article_rent_vs_buy_desc') }}
                    </p>
                    <div class="text-indigo-400 font-semibold text-sm group-hover:translate-x-1 transition">
                        {{ __('messages.home_read_article') }}
                    </div>
                </a>

                <!-- Article Card 2 -->
                <a href="{{ url($locale . '/job-change-finance') }}"
                    class="group bg-slate-800 rounded-2xl p-6 border border-white/5 hover:border-purple-500 transition">
                    <div class="text-4xl mb-4">💼</div>
                    <h3 class="text-xl font-bold text-white group-hover:text-purple-400 transition mb-2">
                        {{ __('messages.home_article_career_changes_title') }}
                    </h3>
                    <p class="text-slate-300 text-sm mb-4">
                        {{ __('messages.home_article_career_changes_desc') }}
                    </p>
                    <div class="text-purple-400 font-semibold text-sm group-hover:translate-x-1 transition">
                        {{ __('messages.home_read_article') }}
                    </div>
                </a>

                <!-- Article Card 3 -->
                <a href="{{ url($locale . '/understanding-interest-rates') }}"
                    class="group bg-slate-800 rounded-2xl p-6 border border-white/5 hover:border-emerald-500 transition">
                    <div class="text-4xl mb-4">📈</div>
                    <h3 class="text-xl font-bold text-white group-hover:text-emerald-400 transition mb-2">
                        {{ __('messages.home_article_interest_rates_title') }}
                    </h3>
                    <p class="text-slate-300 text-sm mb-4">
                        {{ __('messages.home_article_interest_rates_desc') }}
                    </p>
                    <div class="text-emerald-400 font-semibold text-sm group-hover:translate-x-1 transition">
                        {{ __('messages.home_read_article') }}
                    </div>
                </a>
            </div>

            <div class="text-center">
                <a href="{{ url($locale . '/articles') }}"
                    class="inline-block px-8 py-3 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-lg transition">
                    {{ __('messages.home_view_all_articles') }}
                </a>
            </div>
        </div>
    </section>

    <!-- CASE STUDIES -->
    <section class="py-24 bg-slate-950 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4 text-white">{!! __('messages.home_case_studies_title') !!}</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                    {!! __('messages.home_case_studies_subtitle') !!}
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-10">
                <!-- Case Study 1: $250k Mortgage -->
                <a href="{{ url($locale . '/case-study-250k-mortgage') }}"
                    class="group bg-gradient-to-br from-blue-900/30 to-blue-800/10 rounded-2xl p-8 border border-blue-500/30 hover:border-blue-400 transition">
                    <div class="text-5xl mb-4">🏠</div>
                    <div class="inline-block px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-bold mb-4">
                        {!! __('messages.home_case_mortgage_name') !!}</div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-blue-400 transition mb-3">
                        {!! __('messages.case_study_mortgage_title') !!}

                    </h3>
                    <p class="text-slate-300 mb-4">
                        {!! __('messages.case_study_mortgage_desc') !!}
                    </p>
                    <div class="flex items-center text-blue-400 font-semibold text-sm group-hover:translate-x-1 transition">
                        {!! __('messages.case_study_mortgage_cta') !!}
                    </div>
                </a>

                <!-- Case Study 2: Job Trap -->
                <a href="{{ url($locale . '/case-study-job-trap') }}"
                    class="group bg-gradient-to-br from-orange-900/30 to-orange-800/10 rounded-2xl p-8 border border-orange-500/30 hover:border-orange-400 transition">
                    <div class="text-5xl mb-4">💼</div>
                    <div
                        class="inline-block px-3 py-1 rounded-full bg-orange-500/20 text-orange-300 text-xs font-bold mb-4">
                        {!! __('messages.home_case_job_trap_name') !!}</div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-orange-400 transition mb-3">
                        {!! __('messages.case_study_job_trap_title') !!}
                    </h3>
                    <p class="text-slate-300 mb-4">
                        {!! __('messages.case_study_job_trap_desc') !!}
                    </p>
                    <div
                        class="flex items-center text-orange-400 font-semibold text-sm group-hover:translate-x-1 transition">
                        {!! __('messages.case_study_job_trap_cta') !!}
                    </div>
                </a>

                <!-- Case Study 3: Interest Rate -->
                <a href="{{ url($locale . '/case-study-interest-rate') }}"
                    class="group bg-gradient-to-br from-red-900/30 to-red-800/10 rounded-2xl p-8 border border-red-500/30 hover:border-red-400 transition">
                    <div class="text-5xl mb-4">📈</div>
                    <div class="inline-block px-3 py-1 rounded-full bg-red-500/20 text-red-300 text-xs font-bold mb-4">
                        {!! __('messages.home_case_interest_rate_name') !!}</div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-red-400 transition mb-3">
                        {!! __('messages.case_study_interest_rate_title') !!}
                    </h3>
                    <p class="text-slate-300 mb-4">
                        {!! __('messages.case_study_interest_rate_desc') !!}
                    </p>
                    <div class="flex items-center text-red-400 font-semibold text-sm group-hover:translate-x-1 transition">
                        {!! __('messages.case_study_interest_rate_cta') !!}
                    </div>
                </a>
            </div>

            <div class="text-center">
                <a href="{{ url($locale . '/articles') }}"
                    class="inline-block px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg transition">
                    {!! __('messages.case_study_button') !!}
                </a>
            </div>
        </div>
    </section>
    <!-- TOOLS -->
    <section id="job-change" class="py-24 bg-slate-950" style="background-color: #090f20;">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4">
                    {!! __('messages.tools_title') !!}
                </h2>
                <p class="text-slate-400 text-lg">
                    {!! __('messages.tools_subtitle') !!}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Card: Loan Simulation -->
                <div
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-indigo-500 transition">
                    <div class="absolute inset-0 bg-indigo-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">🏦</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.loan_simulation_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.loan_simulation_description') !!}
                        </p>
                        <a href="{{ url($locale . '/loan/simulation') }}"
                            class="inline-flex items-center gap-2 text-indigo-400 font-semibold hover:text-indigo-300">
                            {!! __('messages.loan_simulation_button') !!}
                            <span>←</span>
                        </a>

                    </div>
                </div>

                <!-- Card: Job Change -->
                <div id="job-change"
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-purple-500 transition">
                    <div class="absolute inset-0 bg-purple-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">💼</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.job_change_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.job_change_description') !!}
                        </p>
                        <a href="{{ url($locale . '/job-change/simulation') }}"
                            class="inline-flex items-center gap-2 text-purple-400 font-semibold hover:text-purple-300">
                            {!! __('messages.job_change_button') !!}
                            <span>←</span>
                        </a>
                    </div>
                </div>


                <!-- Card: Housing -->
                <div
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-emerald-500 transition">
                    <div
                        class="absolute inset-0 bg-emerald-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">🏠</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.housing_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.housing_description') !!}
                        </p>

                        <a href="{{ url($locale . '/loan/housing') }}"
                            class="inline-flex items-center gap-2 text-emerald-400 font-semibold hover:text-emerald-300">
                            {!! __('messages.housing_button') !!}
                            <span>←</span>
                        </a>
                    </div>
                </div>

                <!-- Card: Life Shock -->
                <div
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-red-500 transition">
                    <div class="absolute inset-0 bg-red-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">⏳</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.life_shock_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.life_shock_description') !!}
                        </p>
                        <a href="{{ url($locale . '/life-shock/simulation') }}"
                            class="inline-flex items-center gap-2 text-red-400 font-semibold hover:text-red-300">
                            {!! __('messages.life_shock_button') !!}
                            <span>←</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- SHOCK -->
    <section class="bg-gradient-to-r from-indigo-700 to-purple-700 py-24 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
            {!! __('messages.shock_title') !!}
        </h2>

        <p class="text-lg text-indigo-100 max-w-2xl mx-auto mb-10">
            {!! __('messages.shock_description') !!}
        </p>

        <a href="{{ url($locale . '/life-shock/simulation') }}"
            class="inline-block px-10 py-4 bg-white text-indigo-700 font-bold rounded-xl text-lg hover:scale-105 transition">
            {!! __('messages.shock_button') !!}
        </a>
    </section>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetID = this.getAttribute('href');

                // Skip empty hashes
                if (targetID === "#") return;

                const targetElement = document.querySelector(targetID);
                if (targetElement) {
                    e.preventDefault();

                    // Get current scroll position and target position
                    const startY = window.scrollY;
                    const targetY = targetElement.getBoundingClientRect().top + startY -
                        20; // -20 for offset if needed

                    const distance = targetY - startY;
                    const duration = 800; // Duration in ms (800 = 0.8 second)
                    let startTime = null;

                    function scroll(currentTime) {
                        if (!startTime) startTime = currentTime;
                        const timeElapsed = currentTime - startTime;
                        const progress = Math.min(timeElapsed / duration, 1);
                        const ease = progress < 0.5 ?
                            2 * progress * progress :
                            -1 + (4 - 2 * progress) * progress; // easeInOutQuad

                        window.scrollTo(0, startY + distance * ease);

                        if (timeElapsed < duration) {
                            requestAnimationFrame(scroll);
                        }
                    }

                    requestAnimationFrame(scroll);
                }
            });
        });
    </script>
@endsection
