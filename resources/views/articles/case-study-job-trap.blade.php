@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-orange-500/20 text-orange-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>💼</span>
                Case Study
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Case Study: The $80,000 Salary Jump That Actually Lost Money
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                Why a 45% salary increase didn't improve quality of life—and how to avoid the same trap
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4 text-sm text-slate-400">
                <span>📅 Published: March 2026</span>
                <span>✍️ By: Hasan Takrory, DecideLab</span>
                <span>⏱️ Reading time: 11 minutes</span>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <!-- Introduction -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">Sarah's Job Offer</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        Sarah works as a Senior Marketing Manager earning $110,000 annually with a stable company, good benefits, and a 15-minute commute. One morning, a recruiter calls with an exciting opportunity: a Director of Marketing role at a fast-growing tech startup offering $190,000 per year—a 72% increase.
                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        On the surface, it's a no-brainer. But after analyzing the real costs using DecideLab, Sarah discovered the truth: the new job wouldn't improve her life—it would actually make things worse. Here's what she found.
                    </p>
                </div>

                <!-- The Offers -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <h2 class="text-3xl font-bold text-white mb-6">The Two Offers Compared</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-slate-900/50 rounded-lg p-6 border border-emerald-500/30">
                            <h3 class="text-lg font-bold text-emerald-400 mb-6">Current Job</h3>
                            <div class="space-y-3 text-slate-300">
                                <p><strong>Base Salary:</strong> $110,000</p>
                                <p><strong>Annual Bonus:</strong> $10,000 (guaranteed)</p>
                                <p><strong>Work Location:</strong> Downtown (15 min commute)</p>
                                <p><strong>Hours/Week:</strong> 45 hours</p>
                                <p><strong>Job Stability:</strong> Very stable (12 years company tenure)</p>
                                <p><strong>Work Flexibility:</strong> 2 days remote/week allowed</p>
                            </div>
                        </div>
                        <div class="bg-slate-900/50 rounded-lg p-6 border border-orange-500/30">
                            <h3 class="text-lg font-bold text-orange-400 mb-6">New Job Offer</h3>
                            <div class="space-y-3 text-slate-300">
                                <p><strong>Base Salary:</strong> $190,000</p>
                                <p><strong>Annual Bonus:</strong> $30,000 (performance-based)</p>
                                <p><strong>Work Location:</strong> Suburban office (45 min commute)</p>
                                <p><strong>Hours/Week:</strong> 60+ hours (startup culture)</p>
                                <p><strong>Job Stability:</strong> Series B startup (higher risk)</p>
                                <p><strong>Work Flexibility:</strong> Limited remote options</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- The Income Reality -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">Income Reality Check</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        The $190,000 offer looks great, but let's look at what actually hits Sarah's bank account:
                    </p>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Item</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Current Job</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">New Job</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Gross Annual Income</td>
                                    <td class="text-right py-3 px-4">$120,000</td>
                                    <td class="text-right py-3 px-4">$220,000</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Federal Income Tax (22% avg)</td>
                                    <td class="text-right py-3 px-4">-$26,400</td>
                                    <td class="text-right py-3 px-4">-$48,400</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">State Tax (8%)</td>
                                    <td class="text-right py-3 px-4">-$9,600</td>
                                    <td class="text-right py-3 px-4">-$17,600</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Social Security + Medicare (7.65%)</td>
                                    <td class="text-right py-3 px-4">-$9,180</td>
                                    <td class="text-right py-3 px-4">-$16,830</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Net Annual Income</td>
                                    <td class="text-right py-3 px-4"><strong>$74,820</strong></td>
                                    <td class="text-right py-3 px-4"><strong>$137,170</strong></td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4 text-emerald-400 font-bold">Gross Increase</td>
                                    <td class="text-right py-3 px-4"></td>
                                    <td class="text-right py-3 px-4 font-bold text-emerald-400">+$62,350 (83%)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-slate-300 text-sm mt-4 italic">
                        Net income increase: $62,350/year (83% more). But wait—there are costs we haven't considered yet.
                    </p>
                </div>

                <!-- The True Costs -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">The Hidden Costs of the New Job</h2>
                    <div class="space-y-6">
                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">🚗 Commute Cost Increase</h3>
                            <div class="bg-slate-900/50 rounded-lg p-4 mb-4">
                                <p class="text-slate-300 mb-2"><strong>Current:</strong> Downtown, 15 min, 2 days/week = 30 miles/week</p>
                                <p class="text-slate-300 mb-2"><strong>New:</strong> Suburbs, 45 min, 5 days/week = 450 miles/week</p>
                                <p class="text-slate-300 text-sm">Extra cost: $0.67/mile × 420 extra miles = <strong>$281/week</strong></p>
                                <p class="text-emerald-400 font-bold text-lg">Annual increase: ~$14,600</p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">⏱️ Time Costs (Opportunity Cost)</h3>
                            <div class="bg-slate-900/50 rounded-lg p-4 mb-4">
                                <p class="text-slate-300 mb-2"><strong>Extra commute per week:</strong> 2.5 hours</p>
                                <p class="text-slate-300 mb-2"><strong>Extra working hours:</strong> 15 hours/week</p>
                                <p class="text-slate-300 mb-2"><strong>Total extra time per year:</strong> 1,040 hours</p>
                                <p class="text-slate-300 text-sm">That's 26 full-time work weeks per year you don't get back.</p>
                                <p class="text-orange-400 font-bold text-lg">Life impact: 43 extra work days/year</p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">💼 Stress & Burnout Risk</h3>
                            <div class="bg-slate-900/50 rounded-lg p-4 mb-4">
                                <p class="text-slate-300 mb-2">Startup culture often means:</p>
                                <ul class="text-slate-300 space-y-2 ml-4 mb-2">
                                    <li>• Longer hours with uncertain schedule</li>
                                    <li>• No work-life balance</li>
                                    <li>• Higher stress from job instability</li>
                                    <li>• Mental health impacts</li>
                                </ul>
                                <p class="text-orange-400 font-bold">Not easily quantified, but real cost to quality of life</p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">🍔 Lifestyle & Meal Costs</h3>
                            <div class="bg-slate-900/50 rounded-lg p-4 mb-4">
                                <p class="text-slate-300 mb-2"><strong>Current:</strong> Makes lunch at home 4 days/week (~$3/day)</p>
                                <p class="text-slate-300 mb-2"><strong>New:</strong> Eating out most days (~$15/day)</p>
                                <p class="text-orange-400 font-bold text-lg">Annual increase: ~$3,120</p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">👔 Work Clothes & Appearance</h3>
                            <div class="bg-slate-900/50 rounded-lg p-4 mb-4">
                                <p class="text-slate-300 mb-2">Startup job requires more executive presence/appearance</p>
                                <p class="text-orange-400 font-bold text-lg">Annual increase: ~$2,000</p>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-3">🔒 Health & Wellness (Hidden Cost)</h3>
                            <div class="bg-slate-900/50 rounded-lg p-4 mb-4">
                                <p class="text-slate-300 mb-2">Higher stress often leads to:</p>
                                <p class="text-slate-300 mb-2">• More doctor visits</p>
                                <p class="text-slate-300 mb-2">• Therapy/counseling costs</p>
                                <p class="text-slate-300 mb-2">• Gym membership (stress relief)</p>
                                <p class="text-orange-400 font-bold text-lg">Potential increase: $1,500-3,000/year</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- The Real Comparison -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">The Real Financial Picture</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-slate-300 border-collapse">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 font-bold text-white">Item</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Current Job</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">New Job</th>
                                    <th class="text-right py-3 px-4 font-bold text-white">Difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Net Annual Income</td>
                                    <td class="text-right py-3 px-4">$74,820</td>
                                    <td class="text-right py-3 px-4">$137,170</td>
                                    <td class="text-right py-3 px-4 text-emerald-400">+$62,350</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Commute & Transportation</td>
                                    <td class="text-right py-3 px-4">-$1,200</td>
                                    <td class="text-right py-3 px-4">-$15,800</td>
                                    <td class="text-right py-3 px-4">-$14,600</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Food & Meals</td>
                                    <td class="text-right py-3 px-4">-$4,800</td>
                                    <td class="text-right py-3 px-4">-$7,920</td>
                                    <td class="text-right py-3 px-4">-$3,120</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Work-Related Expenses</td>
                                    <td class="text-right py-3 px-4">-$500</td>
                                    <td class="text-right py-3 px-4">-$2,500</td>
                                    <td class="text-right py-3 px-4">-$2,000</td>
                                </tr>
                                <tr class="border-b border-slate-700">
                                    <td class="py-3 px-4">Health & Stress Recovery</td>
                                    <td class="text-right py-3 px-4">-$2,000</td>
                                    <td class="text-right py-3 px-4">-$4,500</td>
                                    <td class="text-right py-3 px-4">-$2,500</td>
                                </tr>
                                <tr class="bg-indigo-600/20 border-b border-slate-700">
                                    <td class="py-3 px-4 font-bold text-white">NET BENEFIT/YEAR</td>
                                    <td class="text-right py-3 px-4">$66,320</td>
                                    <td class="text-right py-3 px-4">$106,450</td>
                                    <td class="text-right py-3 px-4 text-emerald-400 font-bold">+$40,130</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- The Hourly Wage Reality -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-red-500/30">
                    <h2 class="text-3xl font-bold text-white mb-6">The Hourly Wage Reality</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        This is where things get really interesting. Let's calculate Sarah's true hourly rate:
                    </p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-slate-900/50 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-white mb-4">Current Job</h3>
                            <div class="space-y-3 text-slate-300">
                                <p>Net annual income: $74,820</p>
                                <p>Working hours/year: 2,250 (45/week × 50 weeks)</p>
                                <p><strong>Effective hourly rate: $33.25/hour</strong></p>
                            </div>
                        </div>
                        <div class="bg-slate-900/50 rounded-lg p-6 border border-blue-500/50">
                            <h3 class="text-lg font-bold text-white mb-4">New Job</h3>
                            <div class="space-y-3 text-slate-300">
                                <p>Net annual income: $106,450</p>
                                <p>Working hours/year: 3,410 (68/week × 50 weeks)</p>
                                <p class="text-red-400"><strong>Effective hourly rate: $31.20/hour</strong></p>
                                <p class="text-red-300 text-sm italic">You're making LESS per hour!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- The Risk Factor -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">The Risk Factor (Series B Startup)</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        Starting a new job at a Series B startup adds another layer of risk to consider:
                    </p>
                    <div class="bg-red-600/20 rounded-xl p-6 border border-red-500/30">
                        <ul class="space-y-3 text-slate-300">
                            <li><strong>• Risk of company failure:</strong> 70% of Series B startups don't reach Series C</li>
                            <li><strong>• Equity uncertainty:</strong> Stock options may never be worth anything</li>
                            <li><strong>• Severance is unlikely:</strong> Startups rarely offer severance packages</li>
                            <li><strong>• Performance-based bonus at risk:</strong> 30% of salary might not materialize</li>
                            <li><strong>• Impact on resume:</strong> Failed startup looks bad if company closes</li>
                        </ul>
                    </div>
                </div>

                <!-- Sarah's Decision -->
                <div class="mb-12 bg-emerald-600/20 rounded-xl p-6 border border-emerald-500/30">
                    <h2 class="text-3xl font-bold text-white mb-6">Sarah's Decision</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        After analyzing all the numbers using DecideLab, Sarah decided to stay in her current job. Here's why:
                    </p>
                    <ul class="space-y-4 text-slate-300">
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 text-emerald-400 font-bold">✓</span>
                            <span><strong>Better hourly wage:</strong> $33.25 vs $31.20 (despite lower salary)</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 text-emerald-400 font-bold">✓</span>
                            <span><strong>Better work-life balance:</strong> 15 fewer hours/week, 2 days remote</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 text-emerald-400 font-bold">✓</span>
                            <span><strong>Lower stress:</strong> Established company vs startup risk</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 text-emerald-400 font-bold">✓</span>
                            <span><strong>Job security:</strong> 12-year track record vs Series B uncertainty</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 text-emerald-400 font-bold">✓</span>
                            <span><strong>Quality of life:</strong> More time with family and hobbies</span>
                        </li>
                    </ul>
                </div>

                <!-- Key Takeaways -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-white mb-6">Key Takeaways</h2>
                    <ul class="space-y-4">
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">1</span>
                            <span class="text-slate-300"><strong>Gross salary ≠ real income.</strong> Hidden costs can eat 50%+ of a salary increase.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">2</span>
                            <span class="text-slate-300"><strong>Calculate your true hourly wage.</strong> A bigger salary with more hours can actually mean less per hour.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">3</span>
                            <span class="text-slate-300"><strong>Time is your most valuable asset.</strong> More money doesn't compensate for loss of time and stress.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">4</span>
                            <span class="text-slate-300"><strong>Evaluate job offers comprehensively.</strong> Look at commute, hours, stress, stability—not just salary.</span>
                        </li>
                    </ul>
                </div>

                <!-- Sources -->
                <div class="mb-12 bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <h2 class="text-2xl font-bold text-white mb-6">Sources & References</h2>
                    <ul class="space-y-3 text-slate-300 text-sm">
                        <li>• U.S. Bureau of Labor Statistics - Occupational Employment Data 2025</li>
                        <li>• CNBC/Statista - Startup survival rates and funding data</li>
                        <li>• Indeed/Glassdoor - Salary and work-life balance surveys</li>
                        <li>• Federal Reserve - Commute cost analysis 2025</li>
                        <li>• Society for Human Resource Management (SHRM) - Career Change Study</li>
                    </ul>
                </div>

                <!-- Call to Action -->
                <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">Analyze Your Own Job Offer</h2>
                    <p class="text-slate-300 mb-8">Use DecideLab's Job Change Calculator to see the real impact of a job change on your life and finances:</p>
                    <a href="{{ url(app()->getLocale() . '/job-change/simulation') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-bold py-4 px-8 rounded-xl hover:from-indigo-500 hover:to-indigo-400 transition">
                        Compare Job Offers
                        <span>💼</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
