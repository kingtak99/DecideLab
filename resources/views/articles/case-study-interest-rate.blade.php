@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-rose-500/20 text-rose-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>📊</span>
                Case Study
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Case Study: How a 0.5% Interest Rate Difference Costs You $60,000
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                Shopping for the best rate isn't an option—it's a financial necessity
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4 text-sm text-slate-400">
                <span>📅 Published: March 2026</span>
                <span>✍️ By: Hasan Takrory, DecideLab</span>
                <span>⏱️ Reading time: 10 minutes</span>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <!-- Introduction -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">A Half Percent Difference</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        James needs $400,000 for a home purchase. He's been pre-approved by Bank A at 6.0% interest. It's a good rate, he thinks, so he moves forward with finalizing the loan. He doesn't bother shopping around at other banks because—how much different could it really be?
                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        His neighbor, Maria, received the same pre-approval amount but spent 2 hours comparing rates at 5 different lenders. She found a rate of 5.5%. "Almost the same," she thought. But when I ran both scenarios through DecideLab, the numbers told a shocking story.
                    </p>
                </div>

                <!-- The Comparison -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <h2 class="text-3xl font-bold text-white mb-6">The Numbers Side By Side</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Item</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">James (6.0%)</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Maria (5.5%)</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Loan Amount</td>
                                    <td class="text-right py-3 px-4">$400,000</td>
                                    <td class="text-right py-3 px-4">$400,000</td>
                                    <td class="text-right py-3 px-4">—</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Interest Rate</td>
                                    <td class="text-right py-3 px-4">6.0%</td>
                                    <td class="text-right py-3 px-4">5.5%</td>
                                    <td class="text-right py-3 px-4">-0.5%</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Loan Term</td>
                                    <td class="text-right py-3 px-4">30 years</td>
                                    <td class="text-right py-3 px-4">30 years</td>
                                    <td class="text-right py-3 px-4">—</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Monthly Payment</td>
                                    <td class="text-right py-3 px-4"><strong>$2,398</strong></td>
                                    <td class="text-right py-3 px-4"><strong>$2,272</strong></td>
                                    <td class="text-right py-3 px-4 text-emerald-400">-$126/month</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Total Amount Paid</td>
                                    <td class="text-right py-3 px-4"><strong>$863,360</strong></td>
                                    <td class="text-right py-3 px-4"><strong>$817,920</strong></td>
                                    <td class="text-right py-3 px-4">—</td>
                                </tr>
                                <tr class="bg-red-600/20 border-b border-slate-700">
                                    <td class="py-3 px-4 font-bold text-white">Total Interest Paid</td>
                                    <td class="text-right py-3 px-4">$463,360</td>
                                    <td class="text-right py-3 px-4">$417,920</td>
                                    <td class="text-right py-3 px-4 text-red-400 font-bold">-$45,440</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- The Shocking Reality -->
                <div class="mb-12 bg-red-600/20 rounded-xl p-6 border border-red-500/30">
                    <h2 class="text-3xl font-bold text-white mb-6">Wait, That's Not the Full Story</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        The direct interest savings are already significant: <strong>$45,440</strong>. But there's more. Over 30 years, the impact compounds in unexpected ways.
                    </p>
                    <div class="bg-slate-900/50 rounded-lg p-6 border border-red-500/50">
                        <h3 class="text-xl font-bold text-white mb-4">Over 30 Years</h3>
                        <p class="text-slate-300 mb-4"><strong>Maria's $126/month savings invested at 7% return annually:</strong></p>
                        <p class="text-white text-2xl font-bold mb-2">$126 × 360 months = $45,360</p>
                        <p class="text-slate-300 text-lg">But invested at 7% = <strong>$89,245</strong></p>
                        <p class="text-red-400 font-bold text-lg mt-4">Total advantage: $45,440 + $89,245 = <strong>$134,685</strong></p>
                    </div>
                </div>

                <!-- Why This Matters -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">Why This Matters So Much</h2>
                    <div class="space-y-6">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">💰 Direct Savings</h3>
                            <p class="text-slate-300">Half a percent doesn't sound like much. But on a $400,000 loan, it's $45,440 in interest being paid to the bank for no reason other than not shopping around.</p>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">⏱️ Time Value</h3>
                            <p class="text-slate-300">Starting with a lower payment means you have cash flow to invest elsewhere. Over decades, compound returns multiply this advantage.</p>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">🔄 Opportunity Cost</h3>
                            <p class="text-slate-300">Every dollar saved on mortgage payments couldgo toward retirement savings, education, emergency funds, or wealth building.</p>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">📈 The Effort vs Reward</h3>
                            <p class="text-slate-300">Maria spent 2 hours shopping for rates. That's earning $22,720/hour in direct savings. That's the highest ROI on time investment imaginable.</p>
                        </div>
                    </div>
                </div>

                <!-- Interest Rate Sensitivity -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">How Sensitive Are Mortgage Payments to Rate Changes?</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        This chart shows how every 0.1% change in interest rate affects your 30-year $400,000 mortgage:
                    </p>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Rate</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Monthly Payment</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Total Interest</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Change From 6.0%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">5.0%</td>
                                    <td class="text-right py-3 px-4">$2,147</td>
                                    <td class="text-right py-3 px-4">$372,920</td>
                                    <td class="text-right py-3 px-4 text-emerald-400">-$90,440</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">5.5%</td>
                                    <td class="text-right py-3 px-4">$2,272</td>
                                    <td class="text-right py-3 px-4">$417,920</td>
                                    <td class="text-right py-3 px-4 text-emerald-400">-$45,440</td>
                                </tr>
                                <tr class="border-b border-slate-700 bg-indigo-600/20">
                                    <td class="py-3 px-4 font-bold text-white">6.0% (James)</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$2,398</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">$463,360</td>
                                    <td class="text-right py-3 px-4 font-bold text-white">Baseline</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">6.5%</td>
                                    <td class="text-right py-3 px-4">$2,527</td>
                                    <td class="text-right py-3 px-4">$509,920</td>
                                    <td class="text-right py-3 px-4">+$46,560</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">7.0%</td>
                                    <td class="text-right py-3 px-4">$2,661</td>
                                    <td class="text-right py-3 px-4">$557,960</td>
                                    <td class="text-right py-3 px-4">+$94,600</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">7.5%</td>
                                    <td class="text-right py-3 px-4">$2,799</td>
                                    <td class="text-right py-3 px-4">$607,920</td>
                                    <td class="text-right py-3 px-4">+$144,560</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- The Real Cost -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <h2 class="text-3xl font-bold text-white mb-6">What $60,000 Really Means</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        In human terms, that extra $60,000 James pays versus Maria means:
                    </p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-slate-900/50 rounded-lg p-6">
                            <p class="text-slate-300">💼 <strong>Career years</strong></p>
                            <p class="text-2xl font-bold text-white">2 years of work</p>
                            <p class="text-slate-400 text-sm">If earning $30,000/year, this is your life earnings</p>
                        </div>
                        <div class="bg-slate-900/50 rounded-lg p-6">
                            <p class="text-slate-300">🎓 <strong>Tuition</strong></p>
                            <p class="text-2xl font-bold text-white">Full masters degree</p>
                            <p class="text-slate-400 text-sm">At most public universities</p>
                        </div>
                        <div class="bg-slate-900/50 rounded-lg p-6">
                            <p class="text-slate-300">🚗 <strong>New car</strong></p>
                            <p class="text-2xl font-bold text-white">One luxury vehicle</p>
                            <p class="text-slate-400 text-sm">Or two reliable mid-range cars</p>
                        </div>
                        <div class="bg-slate-900/50 rounded-lg p-6">
                            <p class="text-slate-300">🏖️ <strong>Vacations</strong></p>
                            <p class="text-2xl font-bold text-white">30 dream vacations</p>
                            <p class="text-slate-400 text-sm">$2,000 international trips</p>
                        </div>
                    </div>
                </div>

                <!-- How to Find Better Rates -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">How to Find Better Rates (5-Step Process)</h2>
                    <div class="space-y-6">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex gap-4 mb-4">
                                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">1</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Get pre-approved</h3>
                                    <p class="text-slate-300">Contact 3+ lenders (banks, credit unions, online)</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex gap-4 mb-4">
                                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">2</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Compare Loan Estimates</h3>
                                    <p class="text-slate-300">Use official Loan Estimate forms (required by law) to compare apples-to-apples</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex gap-4 mb-4">
                                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">3</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Negotiate points and fees</h3>
                                    <p class="text-slate-300">Lower rates often come with higher fees—balance both</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex gap-4 mb-4">
                                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">4</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Consider rate buying</h3>
                                    <p class="text-slate-300">Paying points upfront can lower your rate (good if staying long-term)</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <div class="flex gap-4 mb-4">
                                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">5</div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Make your decision</h3>
                                    <p class="text-slate-300">Calculate total cost over your expected ownership period</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sources -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <h2 class="text-2xl font-bold text-white mb-6">Sources & References</h2>
                    <ul class="space-y-3 text-slate-300 text-sm">
                        <li>• Federal Reserve Mortgage Rate Data 2025-2026</li>
                        <li>• Consumer Financial Protection Bureau (CFPB) - Mortgage guidance</li>
                        <li>• Fannie Mae Mortgage Rate Analysis</li>
                        <li>• National Association of Mortgage Brokers - Rate Comparison Study</li>
                        <li>• Federal Trade Commission - Consumer Guide to Mortgages</li>
                    </ul>
                </div>

                <!-- Call to Action -->
                <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">Calculate Your Mortgage Impact</h2>
                    <p class="text-slate-300 mb-8">See how interest rates and down payments affect your lifetime mortgage costs:</p>
                    <a href="{{ url(app()->getLocale() . '/loan/housing') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold py-4 px-8 rounded-xl hover:from-emerald-500 hover:to-emerald-400 transition">
                        Calculate Housing Loan
                        <span>🏠</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
