@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>🏠</span>
                Housing Finance
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {!! __('messages.hidden_costs_housing_title') !!}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {!! __('messages.hidden_costs_housing_subtitle') !!}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {!! __('messages.hidden_costs_housing_reading_time') !!}
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <h2 class="text-3xl font-bold text-white mb-6">The Obvious vs. The Hidden</h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    When people think about the cost of buying a home, they usually focus on the mortgage payment, down payment, and closing costs. But these are just the tip of the iceberg. The true cost of homeownership includes many hidden expenses that can add thousands of dollars to your lifetime housing costs.
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">The Big Three: Maintenance, Repairs, and Insurance</h2>

                <div class="space-y-8">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-emerald-500/20">
                        <h3 class="text-2xl font-semibold text-emerald-400 mb-3">🔧 Maintenance and Repairs</h3>
                        <p class="text-slate-300 mb-3">Ongoing upkeep costs that most homeowners underestimate.</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>Annual Cost:</strong> 1-2% of home value per year</li>
                            <li><strong>Examples:</strong> Roof repairs, plumbing, electrical work, appliance replacement</li>
                            <li><strong>Reality:</strong> Most homes need major repairs every 10-15 years</li>
                            <li><strong>Hidden Factor:</strong> Emergency repairs can cost $5,000-$20,000 unexpectedly</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-blue-500/20">
                        <h3 class="text-2xl font-semibold text-blue-400 mb-3">🛡️ Homeowners Insurance</h3>
                        <p class="text-slate-300 mb-3">More than just fire and theft protection.</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>Annual Cost:</strong> 0.3-0.8% of home value</li>
                            <li><strong>What's Covered:</strong> Wind, hail, flood, liability, personal property</li>
                            <li><strong>Hidden Costs:</strong> Deductibles, special policies for flood/earthquake</li>
                            <li><strong>Rising Premiums:</strong> Insurance costs have increased 20-30% in recent years</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-orange-500/20">
                        <h3 class="text-2xl font-semibold text-orange-400 mb-3">🏡 Property Taxes</h3>
                        <p class="text-slate-300 mb-3">Local government fees that vary widely by location.</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>Annual Cost:</strong> 0.5-2% of home value (varies by state/city)</li>
                            <li><strong>Assessment:</strong> Properties are reassessed regularly, often increasing taxes</li>
                            <li><strong>Special Districts:</strong> Additional taxes for schools, utilities, community services</li>
                            <li><strong>Hidden Impact:</strong> Can increase 5-10% annually in high-growth areas</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">The Lifestyle Costs of Homeownership</h2>

                <p class="text-slate-300 leading-relaxed mb-6">
                    Beyond the direct financial costs, homeownership imposes lifestyle restrictions that have real economic value:
                </p>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Opportunity Cost of Capital</h3>
                        <p class="text-slate-300">Money tied up in your home could be invested elsewhere. If you could earn 7% annual returns in the stock market, $100,000 in home equity costs you $7,000 per year in lost investment returns.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Reduced Mobility</h3>
                        <p class="text-slate-300">Selling a home costs 5-8% of its value in real estate fees. Job opportunities in other cities become much more expensive to pursue.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Forced Savings</h3>
                        <p class="text-slate-300">While home equity builds over time, you're forced to save in a relatively illiquid asset. This can prevent you from accessing funds for emergencies or opportunities.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Inflation Protection Trade-off</h3>
                        <p class="text-slate-300">Real estate often appreciates with inflation, but so do rents. The "hedge against inflation" argument is less compelling when you consider all costs.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">The Time Value of Money</h2>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-purple-500/20 mb-8">
                    <h3 class="text-2xl font-semibold text-purple-400 mb-3">💰 Understanding Total Cost Over Time</h3>
                    <p class="text-slate-300 mb-4">A $300,000 mortgage at 4% interest over 30 years seems affordable with a $1,432 monthly payment. But consider:</p>
                    <ul class="text-slate-300 space-y-2">
                        <li>• Total interest paid: $215,609</li>
                        <li>• Property taxes (1% annually): $90,000+</li>
                        <li>• Maintenance (1% annually): $90,000+</li>
                        <li>• Insurance: $30,000+</li>
                        <li>• <strong>Total 30-year cost: $725,609</strong></li>
                    </ul>
                    <p class="text-slate-300 mt-4">That's 2.4 times the original loan amount!</p>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">When Homeownership Makes Financial Sense</h2>

                <p class="text-slate-300 leading-relaxed mb-6">
                    Despite the hidden costs, homeownership can still be a smart financial move under the right circumstances:
                </p>

                <ul class="text-slate-300 space-y-3 mb-8 ml-6">
                    <li>• <strong>Long-term commitment:</strong> Plan to stay in the home for at least 7-10 years</li>
                    <li>• <strong>Stable income:</strong> Your job and income are secure and growing</li>
                    <li>• <strong>Market conditions:</strong> Property values are appreciating in your area</li>
                    <li>• <strong>Down payment:</strong> At least 20% to avoid PMI and reduce monthly costs</li>
                    <li>• <strong>Emergency fund:</strong> 6-12 months of expenses saved for unexpected costs</li>
                </ul>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Alternatives to Consider</h2>

                <div class="space-y-4">
                    <div class="text-slate-300">
                        <strong class="text-cyan-400">🏢 Renting with Investment:</strong>
                        <p class="ml-4 mt-1">Rent a home and invest the down payment. Over 30 years, this can outperform homeownership in many markets.</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-cyan-400">🏘️ Shared Equity Models:</strong>
                        <p class="ml-4 mt-1">Options like rent-to-own or shared equity arrangements that reduce risk while building equity.</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-cyan-400">🏠 Starter Homes:</strong>
                        <p class="ml-4 mt-1">Buy a smaller, more affordable home first, then upgrade as your finances grow.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Making the Right Decision</h2>

                <p class="text-slate-300 leading-relaxed mb-6">
                    The decision to buy a home should be based on your complete financial picture, not just whether you can "afford" the monthly payment. Consider:
                </p>

                <ul class="text-slate-300 space-y-2 mb-8 ml-6">
                    <li>• Your long-term life goals and timeline</li>
                    <li>• Local market conditions and future prospects</li>
                    <li>• Your risk tolerance and need for flexibility</li>
                    <li>• Alternative uses for the capital required for homeownership</li>
                    <li>• The true cost of renting vs. buying in your specific situation</li>
                </ul>

                <p class="text-slate-300 leading-relaxed mb-8">
                    Use DecideLab's housing loan calculator to model different scenarios and understand the true lifetime cost of your housing decision. Remember: the most expensive home is the one you can't afford to maintain.
                </p>

                <!-- Use Our Calculator -->
                <div class="bg-emerald-900/20 border border-emerald-500/30 rounded-lg p-6 mt-12">
                    <h3 class="text-xl font-semibold text-white mb-3">Calculate Your True Housing Costs</h3>
                    <p class="text-slate-300 mb-4">Don't just look at the monthly payment. Use our housing calculator to understand all the hidden costs and opportunity costs of homeownership.</p>
                    <a href="{{ url(app()->getLocale() . '/loan/housing') }}" class="inline-block px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-lg transition duration-200">
                        Try Housing Calculator
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection