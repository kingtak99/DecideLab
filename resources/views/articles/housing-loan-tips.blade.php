@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>🏠</span>
                {{ __('messages.articles.housing_category') ?? 'Housing Loans' }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {{ __('messages.articles.housing_tips_title') ?? 'Housing Loan Tips: Make Smart Home Buying Decisions' }}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {{ __('messages.articles.housing_tips_subtitle') ?? 'Essential tips for getting the best housing loan terms and avoiding common mistakes.' }}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {{ __('messages.articles.read_time') ?? 'Reading time' }}: 5 {{ __('messages.articles.minutes') ?? 'minutes' }}
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
                        {{ __('messages.articles.housing_intro_1') ?? 'Buying a home is one of the biggest financial decisions you\'ll make. A housing loan (mortgage) will likely be the largest debt you ever take on, so it\'s crucial to get it right.' }}
                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed">
                        {{ __('messages.articles.housing_intro_2') ?? 'Here are essential tips to help you navigate the housing loan process and make informed decisions.' }}
                    </p>
                </div>

                <!-- Key Tips -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.housing_key_tips') ?? 'Key Housing Loan Tips' }}</h2>

                    <div class="space-y-8">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">1</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.save_down_payment') ?? 'Save for a Substantial Down Payment' }}</h3>
                                    <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.save_down_payment_desc') ?? 'Aim for at least 20% down payment to avoid private mortgage insurance (PMI) and get better loan terms. The more you put down, the lower your monthly payments and total interest.' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">2</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.improve_credit_score') ?? 'Improve Your Credit Score' }}</h3>
                                    <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.improve_credit_score_desc') ?? 'Your credit score directly affects your interest rate. Pay bills on time, reduce debt, and check your credit report regularly. Even small improvements can save you thousands.' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">3</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.compare_lenders') ?? 'Compare Multiple Lenders' }}</h3>
                                    <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.compare_lenders_desc') ?? 'Don\'t just go with the first lender you find. Shop around and compare rates, fees, and terms from at least 3-4 different lenders or brokers.' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">4</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.understand_fees') ?? 'Understand All Fees and Costs' }}</h3>
                                    <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.understand_fees_desc') ?? 'Look beyond the interest rate. Consider closing costs, appraisal fees, title insurance, and other expenses. These can add 2-5% to your total loan cost.' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">5</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.consider_future') ?? 'Consider Your Long-Term Plans' }}</h3>
                                    <p class="text-slate-300 leading-relaxed">{{ __('messages.articles.consider_future_desc') ?? 'Think about how long you plan to stay in the home. If you might move in 3-5 years, a shorter loan term or adjustable rate might be better. For long-term ownership, fixed rates provide stability.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Common Mistakes -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.avoid_mistakes') ?? 'Common Mistakes to Avoid' }}</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-red-600/20 rounded-xl p-6 border border-red-500/30">
                            <h3 class="text-lg font-semibold text-red-300 mb-3">{{ __('messages.articles.overborrowing') ?? 'Overborrowing' }}</h3>
                            <p class="text-slate-300 text-sm">{{ __('messages.articles.overborrowing_desc') ?? 'Taking a loan for more than you can afford leads to financial stress and potential foreclosure.' }}</p>
                        </div>
                        <div class="bg-red-600/20 rounded-xl p-6 border border-red-500/30">
                            <h3 class="text-lg font-semibold text-red-300 mb-3">{{ __('messages.articles.ignoring_rates') ?? 'Ignoring Total Cost' }}</h3>
                            <p class="text-slate-300 text-sm">{{ __('messages.articles.ignoring_rates_desc') ?? 'Focusing only on monthly payments without considering total interest over the loan life.' }}</p>
                        </div>
                        <div class="bg-red-600/20 rounded-xl p-6 border border-red-500/30">
                            <h3 class="text-lg font-semibold text-red-300 mb-3">{{ __('messages.articles.not_shopping') ?? 'Not Shopping Around' }}</h3>
                            <p class="text-slate-300 text-sm">{{ __('messages.articles.not_shopping_desc') ?? 'Accepting the first offer without comparing options from multiple lenders.' }}</p>
                        </div>
                        <div class="bg-red-600/20 rounded-xl p-6 border border-red-500/30">
                            <h3 class="text-lg font-semibold text-red-300 mb-3">{{ __('messages.articles.forgetting_insurance') ?? 'Forgetting Insurance' }}</h3>
                            <p class="text-slate-300 text-sm">{{ __('messages.articles.forgetting_insurance_desc') ?? 'Not planning for property taxes, homeowners insurance, and maintenance costs.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Use Our Calculator -->
                <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.try_housing_calculator') ?? 'Try Our Housing Loan Calculator' }}</h2>
                    <p class="text-slate-300 mb-8">{{ __('messages.articles.housing_calculator_desc') ?? 'Calculate your housing loan payments, affordability, and long-term costs:' }}</p>
                    <a href="{{ url(app()->getLocale() . '/loan/housing') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold py-4 px-8 rounded-xl hover:from-emerald-500 hover:to-emerald-400 transition">
                        {{ __('messages.articles.calculate_housing') ?? 'Calculate Housing Loan' }}
                        <span>🏠</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
