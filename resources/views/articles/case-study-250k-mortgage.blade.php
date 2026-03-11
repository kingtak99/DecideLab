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
                Case Study
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Case Study: $250,000 Mortgage Over 30 Years
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                A real-world analysis of housing costs and how interest rate changes impact your lifetime financial picture
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4 text-sm text-slate-400">
                <span>📅 Published: March 2026</span>
                <span>✍️ By: Hasan Takrory, DecideLab</span>
                <span>⏱️ Reading time: 12 minutes</span>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <!-- Introduction -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">The Real Cost of Homeownership</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        You've saved $50,000 for a down payment. You found a home listed at $300,000 in a growing neighborhood. The monthly mortgage payment looks manageable at $1,520 for a 30-year loan at 6.5% interest. On paper, it seems like a solid financial decision.
                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        But what's the real lifetime cost? How much of your income will truly go toward housing? What happens if interest rates drop or rise? This case study breaks down the complete financial picture of a $250,000 mortgage (after down payment) and shows why the monthly payment is only half the story.
                    </p>
                </div>

                <!-- The Scenario -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-indigo-500/30">
                    <h2 class="text-3xl font-bold text-white mb-6">The Scenario</h2>
                    <div class="space-y-3 text-slate-300">
                        <p><strong>Home Price:</strong> $300,000</p>
                        <p><strong>Down Payment:</strong> $50,000 (16.7%)</p>
                        <p><strong>Loan Amount:</strong> $250,000</p>
                        <p><strong>Interest Rate:</strong> 6.5% (conventional 30-year mortgage)</p>
                        <p><strong>Borrower:</strong> 35-year-old professional, stable income</p>
                        <p><strong>Location:</strong> Mid-size US city, moderate cost of living</p>
                    </div>
                </div>

                <!-- The Numbers -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">Breaking Down the Monthly Payment</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Expense Category</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Monthly Amount</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Annual Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Principal + Interest</td>
                                    <td class="text-right py-3 px-4">$1,520</td>
                                    <td class="text-right py-3 px-4">$18,240</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Property Taxes</td>
                                    <td class="text-right py-3 px-4">$350</td>
                                    <td class="text-right py-3 px-4">$4,200</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Homeowners Insurance</td>
                                    <td class="text-right py-3 px-4">$220</td>
                                    <td class="text-right py-3 px-4">$2,640</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">HOA Fees</td>
                                    <td class="text-right py-3 px-4">$150</td>
                                    <td class="text-right py-3 px-4">$1,800</td>
                                </tr>
                                <tr class="bg-indigo-600/20 border-b border-slate-700">
                                    <td class="py-3 px-4 font-bold text-white">Total Monthly Obligation</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$2,240</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$26,880</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-slate-300 text-sm mt-4 italic">Note: Property taxes and insurance vary by location; these are regional averages.</p>
                </div>

                <!-- The Hidden Costs -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">The Hidden Costs Nobody Mentions</h2>
                    <div class="space-y-6">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">Maintenance & Repairs</h3>
                            <p class="text-slate-300 mb-3">A common rule: budget 1-2% of home value annually for maintenance and repairs.</p>
                            <div class="bg-slate-900/50 rounded-lg p-4">
                                <p class="text-slate-300"><strong>$300,000 × 1.5% = $4,500/year</strong> ($375/month)</p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">Utilities & Services</h3>
                            <p class="text-slate-300 mb-3">Electric, water, gas, internet, and phone services for a home typically run higher than apartments.</p>
                            <div class="bg-slate-900/50 rounded-lg p-4">
                                <p class="text-slate-300"><strong>Estimated $400-500/month total</strong></p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">Landscape & Yard Maintenance</h3>
                            <p class="text-slate-300 mb-3">If not doing it yourself, lawn service, snow removal, and seasonal maintenance add up.</p>
                            <div class="bg-slate-900/50 rounded-lg p-4">
                                <p class="text-slate-300"><strong>$150-300/month (seasonal variation)</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lifetime Cost Analysis -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">30-Year Lifetime Cost Analysis</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Cost Category</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">30-Year Total</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Monthly Average</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Principal + Interest</td>
                                    <td class="text-right py-3 px-4"><strong>$547,200</strong></td>
                                    <td class="text-right py-3 px-4">$1,520</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Property Taxes</td>
                                    <td class="text-right py-3 px-4"><strong>$126,000</strong></td>
                                    <td class="text-right py-3 px-4">$350</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Insurance & HOA</td>
                                    <td class="text-right py-3 px-4"><strong>$132,000</strong></td>
                                    <td class="text-right py-3 px-4">$366</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Maintenance</td>
                                    <td class="text-right py-3 px-4"><strong>$135,000</strong></td>
                                    <td class="text-right py-3 px-4">$375</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Utilities & Services</td>
                                    <td class="text-right py-3 px-4"><strong>$180,000</strong></td>
                                    <td class="text-right py-3 px-4">$500</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Landscaping (avg)</td>
                                    <td class="text-right py-3 px-4"><strong>$67,500</strong></td>
                                    <td class="text-right py-3 px-4">$188</td>
                                </tr>
                                <tr class="bg-red-600/20 border-b border-slate-700">
                                    <td class="py-3 px-4 font-bold text-white">TOTAL LIFETIME COST</td>
                                    <td class="text-right py-3 px-4 font-bold text-white text-lg">$1,187,700</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$3,299</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- The Interest Rate Impact -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">How Interest Rate Changes Impact Your Lifetime Cost</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        Interest rates fluctuate. What if you had financed at a different rate? Let's see how sensitive this loan is:
                    </p>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Interest Rate</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Monthly Payment</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Total Interest Paid</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Difference vs 6.5%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4 text-emerald-400">4.5%</td>
                                    <td class="text-right py-3 px-4">$1,266</td>
                                    <td class="text-right py-3 px-4">$205,680</td>
                                    <td class="text-right py-3 px-4 text-emerald-400">-$135,840</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">5.5%</td>
                                    <td class="text-right py-3 px-4">$1,419</td>
                                    <td class="text-right py-3 px-4">$261,020</td>
                                    <td class="text-right py-3 px-4">-$80,500</td>
                                </tr>
                                <tr class="border-b border-slate-700 bg-indigo-600/20">
                                    <td class="py-3 px-4 font-bold text-white">6.5% (Current)</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$1,520</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$297,200</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">Baseline</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">7.5%</td>
                                    <td class="text-right py-3 px-4">$1,748</td>
                                    <td class="text-right py-3 px-4">$378,480</td>
                                    <td class="text-right py-3 px-4">+$81,280</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4 text-red-400">8.5%</td>
                                    <td class="text-right py-3 px-4">$1,927</td>
                                    <td class="text-right py-3 px-4">$442,960</td>
                                    <td class="text-right py-3 px-4 text-red-400">+$145,760</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-slate-300 text-sm mt-4 italic">
                        A difference of 2% in interest rate means you pay $36,280 MORE over 30 years on the same loan. This is why getting the best rate matters.
                    </p>
                </div>

                <!-- Is It Worth It -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-emerald-500/30">
                    <h2 class="text-3xl font-bold text-white mb-6">Should You Buy This Home?</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        The answer depends on your income, life plans, and alternatives. Let's say your household income is $120,000/year ($10,000/month).
                    </p>
                    <div class="bg-slate-900/50 rounded-lg p-6 mb-6">
                        <p class="text-slate-300 mb-3"><strong>Debt-to-Income Calculation:</strong></p>
                        <p class="text-slate-300 mb-3">Housing payment ($2,240) ÷ Monthly income ($10,000) = <strong>22.4% DTI</strong></p>
                        <p class="text-slate-300 text-sm italic">
                            Lenders typically want housing costs below 28% DTI. You're in an acceptable range, but leaving little room for other debt or emergencies.
                        </p>
                    </div>
                    <div class="space-y-3 text-slate-300">
                        <p><strong>✅ Buy if:</strong> You plan to stay 7+ years, have stable income, and 6+ months emergency fund</p>
                        <p><strong>❌ Don't buy if:</strong> You might relocate in 3-5 years, have unstable income, or no emergency savings</p>
                    </div>
                </div>

                <!-- Key Takeaways -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">Key Takeaways</h2>
                    <ul class="space-y-4">
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">1</span>
                            <span class="text-slate-300"><strong>The monthly payment is just part of the cost.</strong> Total housing obligations are often 50% higher than the mortgage payment alone.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">2</span>
                            <span class="text-slate-300"><strong>A 1% difference in interest rates costs tens of thousands.</strong> Shopping for the best rate is time well spent.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">3</span>
                            <span class="text-slate-300"><strong>Homeownership ties up significant capital.</strong> Consider opportunity costs—what else could that $50k down payment earn?</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">4</span>
                            <span class="text-slate-300"><strong>Length of ownership matters.</strong> You need to stay long enough to recoup closing costs and build equity.</span>
                        </li>
                    </ul>
                </div>

                <!-- Sources -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <h2 class="text-2xl font-bold text-white mb-6">Sources & References</h2>
                    <ul class="space-y-3 text-slate-300 text-sm">
                        <li>• Federal Reserve Housing Finance Data 2025-2026</li>
                        <li>• U.S. Bureau of Labor Statistics - Home Ownership Costs</li>
                        <li>• National Association of Realtors - 2025 Housing Market Report</li>
                        <li>• Consumer Financial Protection Bureau (CFPB) - Mortgage Resources</li>
                        <li>• U.S. Census Bureau - Owner-Occupied Housing Cost Survey</li>
                    </ul>
                </div>

                <!-- Call to Action -->
                <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">Analyze Your Own Housing Scenario</h2>
                    <p class="text-slate-300 mb-8">Use DecideLab's Housing Calculator to see how different down payments, interest rates, and timelines affect your specific situation:</p>
                    <a href="{{ url(app()->getLocale() . '/loan/housing') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold py-4 px-8 rounded-xl hover:from-emerald-500 hover:to-emerald-400 transition">
                        Try Housing Calculator
                        <span>🏠</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
