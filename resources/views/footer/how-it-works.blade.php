@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-indigo-500/20 text-indigo-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>⚙️</span>
                How It Works
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Understanding Our Financial Tools
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                Learn how DecideLab's simulations work, what assumptions we make, and how to interpret your results.
            </p>
            <div class="mt-8 text-sm text-slate-400">
                Reading time: 8 minutes
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <h2 class="text-3xl font-bold text-white mb-6">Our Philosophy: Beyond Simple Calculations</h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    Unlike basic financial calculators that give you a single number, DecideLab creates comprehensive simulations that show you the long-term impact of your decisions. We believe that understanding the "why" behind financial choices is just as important as knowing the "what."
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">How Our Tools Work</h2>

                <div class="space-y-8">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-indigo-500/20">
                        <h3 class="text-2xl font-semibold text-indigo-400 mb-3">🎯 Step 1: Data Collection</h3>
                        <p class="text-slate-300 mb-3">We gather comprehensive information about your current situation and goals.</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>Personal Information:</strong> Age, location, income, expenses</li>
                            <li><strong>Financial Position:</strong> Current savings, debts, assets</li>
                            <li><strong>Goals:</strong> What you want to achieve and by when</li>
                            <li><strong>Risk Tolerance:</strong> Your comfort with financial uncertainty</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-purple-500/20">
                        <h3 class="text-2xl font-semibold text-purple-400 mb-3">🧮 Step 2: Scenario Modeling</h3>
                        <p class="text-slate-300 mb-3">We create multiple "what-if" scenarios to show different outcomes.</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>Base Case:</strong> What happens if you do nothing different</li>
                            <li><strong>Conservative:</strong> Pessimistic assumptions about markets and income</li>
                            <li><strong>Optimistic:</strong> Best-case scenarios</li>
                            <li><strong>Custom:</strong> Your specific situation and preferences</li>
                        </ul>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-emerald-500/20">
                        <h3 class="text-2xl font-semibold text-emerald-400 mb-3">📊 Step 3: Results Visualization</h3>
                        <p class="text-slate-300 mb-3">We present complex data in easy-to-understand formats.</p>
                        <ul class="text-slate-300 space-y-2 ml-4">
                            <li><strong>Charts & Graphs:</strong> Visual representation of your financial future</li>
                            <li><strong>Key Metrics:</strong> Important numbers explained in plain language</li>
                            <li><strong>Time Frames:</strong> Short-term (1-3 years) and long-term (10-30 years) views</li>
                            <li><strong>Risk Analysis:</strong> What could go wrong and how to prepare</li>
                        </ul>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Key Assumptions in Our Calculations</h2>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Inflation (2-3% annually)</h3>
                        <p class="text-slate-300">We assume moderate inflation that erodes purchasing power over time. This affects both your income growth and expense increases.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Investment Returns (4-8% annually)</h3>
                        <p class="text-slate-300">Based on historical market performance. We use conservative estimates and show ranges rather than single numbers.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Tax Implications</h3>
                        <p class="text-slate-300">We consider basic tax effects but recommend consulting a tax professional for personalized advice.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Life Changes</h3>
                        <p class="text-slate-300">Career progression, family changes, and lifestyle adjustments are factored into long-term projections.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Understanding the Loan Simulation Tool</h2>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-red-500/20 mb-8">
                    <h3 class="text-2xl font-semibold text-red-400 mb-3">💰 What It Calculates</h3>
                    <ul class="text-slate-300 space-y-2">
                        <li>• Total interest paid over the life of the loan</li>
                        <li>• Monthly payment breakdown (principal vs. interest)</li>
                        <li>• How long it takes to pay off the loan</li>
                        <li>• The "time cost" - years of your life spent paying debt</li>
                        <li>• Opportunity cost of money tied up in payments</li>
                        <li>• Impact of extra payments on total interest savings</li>
                    </ul>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Understanding the Job Change Tool</h2>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-blue-500/20 mb-8">
                    <h3 class="text-2xl font-semibold text-blue-400 mb-3">💼 What It Considers</h3>
                    <ul class="text-slate-300 space-y-2">
                        <li>• Salary differences (gross vs. net income)</li>
                        <li>• Benefits comparison (health insurance, retirement plans)</li>
                        <li>• Commute costs and time value</li>
                        <li>• Learning curve and productivity impact</li>
                        <li>• Career advancement potential</li>
                        <li>• Work-life balance factors</li>
                    </ul>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Understanding the Housing Calculator</h2>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-green-500/20 mb-8">
                    <h3 class="text-2xl font-semibold text-green-400 mb-3">🏠 What It Evaluates</h3>
                    <ul class="text-slate-300 space-y-2">
                        <li>• Mortgage payments and total interest</li>
                        <li>• Property taxes and homeowners insurance</li>
                        <li>• Maintenance and repair costs</li>
                        <li>• Opportunity cost of down payment</li>
                        <li>• Rent vs. buy comparison over time</li>
                        <li>• Affordability based on your income</li>
                    </ul>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Important Notes and Limitations</h2>

                <div class="space-y-4">
                    <div class="text-slate-300">
                        <strong class="text-yellow-400">⚠️ Not Financial Advice:</strong>
                        <p class="ml-4 mt-1">Our tools provide educational information only. We are not financial advisors, and our results should not be considered personalized financial advice.</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-yellow-400">📊 Assumptions Can Change:</strong>
                        <p class="ml-4 mt-1">Economic conditions, interest rates, and personal circumstances can change. Regular review of your financial plan is essential.</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-yellow-400">🎯 Your Input Quality Matters:</strong>
                        <p class="ml-4 mt-1">The accuracy of our results depends on the accuracy of the information you provide. Take time to gather complete and current data.</p>
                    </div>
                    <div class="text-slate-300">
                        <strong class="text-yellow-400">🌍 Local Factors:</strong>
                        <p class="ml-4 mt-1">Tax laws, economic conditions, and costs of living vary by location. Consider consulting local experts for region-specific advice.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">How to Use Our Results Effectively</h2>

                <ol class="text-slate-300 space-y-4 ml-6">
                    <li><strong>1. Start with Your Goals:</strong> Know what you want to achieve before running simulations</li>
                    <li><strong>2. Compare Multiple Scenarios:</strong> Don't rely on a single "best case" - understand the range of possibilities</li>
                    <li><strong>3. Consider the Non-Financial Factors:</strong> Job satisfaction, work-life balance, and personal happiness matter</li>
                    <li><strong>4. Plan for Uncertainty:</strong> Build flexibility into your plans for unexpected changes</li>
                    <li><strong>5. Review Regularly:</strong> Life changes, so should your financial plans</li>
                    <li><strong>6. Get Professional Input:</strong> Use our tools as a starting point, not the final answer</li>
                </ol>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Data Sources and Methodology</h2>

                <p class="text-slate-300 leading-relaxed mb-6">
                    Our calculations are based on established financial principles and historical data:
                </p>

                <ul class="text-slate-300 space-y-2 mb-8 ml-6">
                    <li>• Interest rate calculations using standard amortization formulas</li>
                    <li>• Investment return assumptions based on historical market performance</li>
                    <li>• Inflation data from government economic indicators</li>
                    <li>• Tax calculations using current tax brackets and deductions</li>
                    <li>• Cost of living data from reliable economic sources</li>
                </ul>

                <p class="text-slate-300 leading-relaxed mb-8">
                    We regularly update our data sources and calculation methods to ensure accuracy and relevance. If you have questions about our methodology or want to suggest improvements, please contact us.
                </p>

                <!-- CTA -->
                <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-lg p-6 mt-12">
                    <h3 class="text-xl font-semibold text-white mb-3">Ready to Explore Your Options?</h3>
                    <p class="text-slate-300 mb-4">Now that you understand how our tools work, try them out and see what insights they can provide for your financial decisions.</p>
                    <a href="{{ url(app()->getLocale()) }}" class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg transition duration-200">
                        Start Exploring Tools
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection