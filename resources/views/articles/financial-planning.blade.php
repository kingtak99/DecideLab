@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>📊</span>
                {{ __('messages.articles.financial_planning_category') ?? 'Financial Planning' }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {{ __('messages.articles.financial_planning_title') ?? 'Financial Planning: Your Roadmap to Financial Freedom' }}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {{ __('messages.articles.financial_planning_subtitle') ?? 'Learn how to create a comprehensive financial plan that secures your future and helps you achieve your dreams.' }}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {{ __('messages.articles.read_time') ?? 'Reading time' }}: 8 {{ __('messages.articles.minutes') ?? 'minutes' }}
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <!-- Introduction -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.introduction') ?? 'Introduction' }}</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        {{ __('messages.articles.financial_planning_intro_1') ?? 'Financial planning is the process of managing your money to achieve your life goals. It involves assessing your current financial situation, setting realistic goals, and creating a strategy to reach them.' }}
                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed">
                        {{ __('messages.articles.financial_planning_intro_2') ?? 'Whether you want to buy a home, fund your children\'s education, or retire comfortably, a solid financial plan is your roadmap to success.' }}
                    </p>
                </div>

                <!-- Why Financial Planning Matters -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.why_financial_planning_title') ?? 'Why Financial Planning Matters' }}</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">🎯</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.goal_achievement') ?? 'Goal Achievement' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.goal_achievement_desc') ?? 'Helps you set and achieve specific financial goals with clear timelines.' }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">🛡️</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.risk_management') ?? 'Risk Management' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.risk_management_desc') ?? 'Protects you from unexpected financial emergencies and market volatility.' }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">📈</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.wealth_building') ?? 'Wealth Building' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.wealth_building_desc') ?? 'Creates a systematic approach to building and preserving wealth.' }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">✌️</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.peace_of_mind') ?? 'Peace of Mind' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.peace_of_mind_desc') ?? 'Reduces financial stress and gives you confidence in your future.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Steps to Create a Financial Plan -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.financial_plan_steps') ?? 'Steps to Create Your Financial Plan' }}</h2>

                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">1</div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.step_1_title') ?? 'Assess Your Current Situation' }}</h3>
                                <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.step_1_desc') ?? 'Calculate your net worth, analyze your income and expenses, and understand your current financial position.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">2</div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.step_2_title') ?? 'Set Financial Goals' }}</h3>
                                <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.step_2_desc') ?? 'Define short-term, medium-term, and long-term goals. Make them specific, measurable, achievable, relevant, and time-bound (SMART).' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">3</div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.step_3_title') ?? 'Create a Budget' }}</h3>
                                <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.step_3_desc') ?? 'Track your income and expenses to ensure you\'re living within your means and saving for your goals.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">4</div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.step_4_title') ?? 'Build an Emergency Fund' }}</h3>
                                <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.step_4_desc') ?? 'Save 3-6 months of living expenses to protect against unexpected financial setbacks.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">5</div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.step_5_title') ?? 'Invest Wisely' }}</h3>
                                <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.step_5_desc') ?? 'Learn about different investment options and create a diversified portfolio that matches your risk tolerance.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">6</div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.step_6_title') ?? 'Review and Adjust' }}</h3>
                                <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.step_6_desc') ?? 'Regularly review your plan and make adjustments as your life circumstances and goals change.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tools Section -->
                <div class="mb-12 bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-8">
                    <h2 class="text-3xl font-bold text-white mb-6 text-center">{{ __('messages.articles.use_our_tools') ?? 'Use Our Tools' }}</h2>
                    <p class="text-slate-300 text-center mb-8">{{ __('messages.articles.tools_description') ?? 'Try our financial calculators to help you create a better financial plan:' }}</p>

                    <div class="grid md:grid-cols-3 gap-6">
                        <a href="{{ url(app()->getLocale() . '/loan/simulation') }}" class="bg-slate-800/50 hover:bg-slate-800/70 rounded-xl p-6 text-center transition">
                            <div class="text-3xl mb-4">💰</div>
                            <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.loan_simulation_nav') }}</h3>
                            <p class="text-slate-400 text-sm">{{ __('messages.articles.loan_sim_desc') ?? 'Calculate loan payments and total interest' }}</p>
                        </a>

                        <a href="{{ url(app()->getLocale() . '/job-change/simulation') }}" class="bg-slate-800/50 hover:bg-slate-800/70 rounded-xl p-6 text-center transition">
                            <div class="text-3xl mb-4">💼</div>
                            <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.job_change_nav') }}</h3>
                            <p class="text-slate-400 text-sm">{{ __('messages.articles.job_change_desc') ?? 'Compare job offers and career changes' }}</p>
                        </a>

                        <a href="{{ url(app()->getLocale() . '/loan/housing') }}" class="bg-slate-800/50 hover:bg-slate-800/70 rounded-xl p-6 text-center transition">
                            <div class="text-3xl mb-4">🏠</div>
                            <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.loan_Housing_simulation_nav') }}</h3>
                            <p class="text-slate-400 text-sm">{{ __('messages.articles.housing_loan_desc') ?? 'Calculate housing loan costs and affordability' }}</p>
                        </a>
                    </div>
                </div>

                <!-- Conclusion -->
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.conclusion') ?? 'Start Your Financial Journey Today' }}</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-8">
                        {{ __('messages.articles.financial_planning_conclusion') ?? 'Financial planning is not just about numbers—it\'s about creating the life you want. Start small, be consistent, and watch your financial future transform.' }}
                    </p>
                    <a href="{{ url(app()->getLocale()) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold py-4 px-8 rounded-xl hover:from-emerald-500 hover:to-emerald-400 transition">
                        {{ __('messages.articles.start_planning') ?? 'Start Planning Now' }}
                        <span>🚀</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
