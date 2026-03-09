@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>📈</span>
                {{ __('messages.articles.interest_rates_category') ?? 'Interest Rates' }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {{ __('messages.articles.interest_rates_title') ?? 'Understanding Interest Rates: The Hidden Cost of Borrowing' }}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {{ __('messages.articles.interest_rates_subtitle') ?? 'Learn how interest rates work, how they affect your loans, and how to make them work in your favor.' }}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {{ __('messages.articles.read_time') ?? 'Reading time' }}: 6 {{ __('messages.articles.minutes') ?? 'minutes' }}
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
                        {{ __('messages.articles.interest_rates_intro_1') ?? 'Interest rates are the price you pay to borrow money. They represent the cost of borrowing and the reward for lending. Understanding how they work is crucial for making informed financial decisions.' }}
                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed">
                        {{ __('messages.articles.interest_rates_intro_2') ?? 'Whether you\'re taking a loan, saving money, or investing, interest rates play a significant role in your financial outcomes.' }}
                    </p>
                </div>

                <!-- What is Interest -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.what_is_interest') ?? 'What is Interest?' }}</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        {{ __('messages.articles.interest_definition') ?? 'Interest is the fee charged by lenders for the privilege of borrowing money. It\'s expressed as a percentage of the principal amount borrowed.' }}
                    </p>

                    <div class="bg-slate-800/50 rounded-xl p-6 mb-6">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('messages.articles.simple_vs_compound') ?? 'Simple vs Compound Interest' }}</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-lg font-medium text-indigo-300 mb-2">{{ __('messages.articles.simple_interest') ?? 'Simple Interest' }}</h4>
                                <p class="text-slate-300 text-sm">{{ __('messages.articles.simple_interest_desc') ?? 'Calculated only on the principal amount. Formula: Interest = Principal × Rate × Time' }}</p>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-indigo-300 mb-2">{{ __('messages.articles.compound_interest') ?? 'Compound Interest' }}</h4>
                                <p class="text-slate-300 text-sm">{{ __('messages.articles.compound_interest_desc') ?? 'Interest on interest. Much more expensive over time. Most loans use compound interest.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Types of Interest Rates -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.interest_rate_types') ?? 'Types of Interest Rates' }}</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">📊</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.fixed_rate') ?? 'Fixed Rate' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.fixed_rate_desc') ?? 'Stays the same throughout the loan term. Provides predictability and protection against rate increases.' }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">📈</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.variable_rate') ?? 'Variable Rate' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.variable_rate_desc') ?? 'Changes with market conditions. Can be lower initially but carries risk of increases.' }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">🎯</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.prime_rate') ?? 'Prime Rate' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.prime_rate_desc') ?? 'The rate banks charge their best customers. Other rates are often calculated as prime + margin.' }}</p>
                        </div>
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="text-2xl mb-4">🏦</div>
                            <h3 class="text-xl font-semibold text-white mb-3">{{ __('messages.articles.apr_vs_apr') ?? 'APR vs Interest Rate' }}</h3>
                            <p class="text-slate-300">{{ __('messages.articles.apr_vs_apr_desc') ?? 'APR includes fees and represents true cost. Interest rate is just the borrowing cost.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- How Interest Affects Loans -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.interest_impact') ?? 'How Interest Rates Affect Your Loans' }}</h2>

                    <div class="bg-gradient-to-r from-red-600/20 to-orange-600/20 rounded-2xl p-8 mb-8">
                        <h3 class="text-2xl font-bold text-white mb-4">{{ __('messages.articles.interest_cost_example') ?? 'The Real Cost of Interest' }}</h3>
                        <p class="text-slate-300 mb-6">{{ __('messages.articles.interest_cost_desc') ?? 'Let\'s see how interest rates affect the total cost of a loan:' }}</p>

                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="bg-slate-800/50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-indigo-300 mb-2">5%</div>
                                <div class="text-sm text-slate-400">{{ __('messages.articles.low_rate') ?? 'Low Rate' }}</div>
                                <div class="text-lg font-semibold text-white mt-2">$127,628</div>
                                <div class="text-xs text-slate-400">{{ __('messages.articles.total_cost') ?? 'Total Cost' }}</div>
                            </div>
                            <div class="bg-slate-800/50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-yellow-300 mb-2">8%</div>
                                <div class="text-sm text-slate-400">{{ __('messages.articles.medium_rate') ?? 'Medium Rate' }}</div>
                                <div class="text-lg font-semibold text-white mt-2">$146,762</div>
                                <div class="text-xs text-slate-400">{{ __('messages.articles.total_cost') ?? 'Total Cost' }}</div>
                            </div>
                            <div class="bg-slate-800/50 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-red-300 mb-2">12%</div>
                                <div class="text-sm text-slate-400">{{ __('messages.articles.high_rate') ?? 'High Rate' }}</div>
                                <div class="text-lg font-semibold text-white mt-2">$172,848</div>
                                <div class="text-xs text-slate-400">{{ __('messages.articles.total_cost') ?? 'Total Cost' }}</div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-4 text-center">{{ __('messages.articles.loan_example_note') ?? '*Example: $100,000 loan over 30 years' }}</p>
                    </div>
                </div>

                <!-- Tips for Better Rates -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.better_rates_tips') ?? 'Tips for Getting Better Interest Rates' }}</h2>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">1</div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles.improve_credit') ?? 'Improve Your Credit Score' }}</h3>
                                <p class="text-slate-300">{{ __('messages.articles.improve_credit_desc') ?? 'Pay bills on time, reduce debt, and maintain a good credit history.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">2</div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles.shop_around') ?? 'Shop Around' }}</h3>
                                <p class="text-slate-300">{{ __('messages.articles.shop_around_desc') ?? 'Compare rates from multiple lenders before choosing.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">3</div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles.consider_terms') ?? 'Consider Different Terms' }}</h3>
                                <p class="text-slate-300">{{ __('messages.articles.consider_terms_desc') ?? 'Shorter loan terms often have lower rates but higher payments.' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">4</div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">{{ __('messages.articles.negotiate') ?? 'Negotiate' }}</h3>
                                <p class="text-slate-300">{{ __('messages.articles.negotiate_desc') ?? 'Rates are often negotiable, especially for large loans or good customers.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Use Our Calculator -->
                <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">{{ __('messages.articles.try_calculator') ?? 'Try Our Loan Calculator' }}</h2>
                    <p class="text-slate-300 mb-8">{{ __('messages.articles.calculator_description') ?? 'See exactly how different interest rates affect your loan payments and total cost:' }}</p>
                    <a href="{{ url(app()->getLocale() . '/loan/simulation') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold py-4 px-8 rounded-xl hover:from-emerald-500 hover:to-emerald-400 transition">
                        {{ __('messages.articles.calculate_now') ?? 'Calculate Now' }}
                        <span>🧮</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
