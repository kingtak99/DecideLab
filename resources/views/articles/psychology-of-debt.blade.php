@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

    <!-- Article Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center gap-2 bg-red-500/20 text-red-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <span>🧠</span>
                Financial Psychology
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                {!! __('messages.psychology_of_debt_title') !!}
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                {!! __('messages.psychology_of_debt_subtitle') !!}
            </p>
            <div class="mt-8 text-sm text-slate-400">
                {!! __('messages.psychology_of_debt_reading_time') !!}
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-20 bg-slate-950">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">

                <h2 class="text-3xl font-bold text-white mb-6">The Emotional Side of Debt</h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    Debt is more than just numbers on a spreadsheet—it's a psychological burden that affects our emotions, behavior, and decision-making. Understanding the psychology behind debt can help you make better financial choices and manage existing debt more effectively.
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Why We Take on Debt</h2>

                <div class="space-y-8">
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-red-500/20">
                        <h3 class="text-2xl font-semibold text-red-400 mb-3">🎯 Instant Gratification vs. Long-term Planning</h3>
                        <p class="text-slate-300 mb-3">Our brains are wired to prefer immediate rewards over future benefits. This is why credit cards and buy-now-pay-later options are so tempting.</p>
                        <p class="text-slate-300">The psychological principle at work: <strong>temporal discounting</strong>—we undervalue future costs and benefits compared to immediate ones.</p>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-orange-500/20">
                        <h3 class="text-2xl font-semibold text-orange-400 mb-3">📊 Social Pressure and Lifestyle Inflation</h3>
                        <p class="text-slate-300 mb-3">Keeping up with friends, family, or social media influencers often leads to spending beyond our means.</p>
                        <p class="text-slate-300">Studies show that people spend 10-20% more when shopping with others, even virtually through social media.</p>
                    </div>

                    <div class="bg-slate-800/50 rounded-xl p-6 border border-yellow-500/20">
                        <h3 class="text-2xl font-semibold text-yellow-400 mb-3">🛡️ The Security Blanket Effect</h3>
                        <p class="text-slate-300 mb-3">Debt can feel like a safety net—having access to credit makes us feel more secure, even when we don't need it.</p>
                        <p class="text-slate-300">This creates a false sense of financial security that often leads to overuse of credit.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">The Mental Burden of Debt</h2>

                <p class="text-slate-300 leading-relaxed mb-6">
                    Debt doesn't just affect your bank account—it affects your mental health and quality of life. Research from the American Psychological Association shows that:
                </p>

                <ul class="text-slate-300 space-y-3 mb-8 ml-6">
                    <li>• People with high debt levels report significantly higher stress levels</li>
                    <li>• Debt-related stress can lead to sleep problems, anxiety, and depression</li>
                    <li>• Financial worry affects concentration and job performance</li>
                    <li>• Debt stress can strain relationships and family dynamics</li>
                </ul>

                <h3 class="text-2xl font-bold text-white mb-4 mt-8">Debt and Self-Esteem</h3>
                <p class="text-slate-300 leading-relaxed mb-6">
                    Many people internalize debt as a personal failure. This can create a vicious cycle where shame leads to avoidance behaviors, which worsen the financial situation. Breaking this cycle requires reframing debt as a solvable problem rather than a character flaw.
                </p>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Behavioral Economics and Debt</h2>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-blue-500/20 mb-8">
                    <h3 class="text-2xl font-semibold text-blue-400 mb-3">🎭 Cognitive Biases That Lead to Debt</h3>
                    <ul class="text-slate-300 space-y-2">
                        <li><strong>Optimism Bias:</strong> We tend to overestimate our ability to repay debt</li>
                        <li><strong>Anchoring Effect:</strong> First loan terms become our reference point for all future borrowing</li>
                        <li><strong>Present Bias:</strong> We prioritize immediate needs over future financial health</li>
                        <li><strong>Status Quo Bias:</strong> We stick with existing debt arrangements even when refinancing could save money</li>
                    </ul>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Breaking Free from Debt Psychology</h2>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">1. Reframe Your Relationship with Money</h3>
                        <p class="text-slate-300">View debt as a tool, not a moral failing. Good debt (invested in appreciating assets) and bad debt (spent on depreciating items) are different.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">2. Practice Delayed Gratification</h3>
                        <p class="text-slate-300">Train yourself to wait before making purchases. The "24-hour rule" can prevent impulse debt accumulation.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">3. Use Mental Accounting Wisely</h3>
                        <p class="text-slate-300">Separate "fun money" from "need money" and avoid using credit for emotional spending.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">4. Build Emergency Savings First</h3>
                        <p class="text-slate-300">Having a safety net reduces the psychological need for credit card debt during emergencies.</p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">The Path to Debt-Free Living</h2>

                <p class="text-slate-300 leading-relaxed mb-6">
                    Becoming debt-free isn't just about money—it's about reclaiming your mental and emotional freedom. The psychological benefits of paying off debt include:
                </p>

                <ul class="text-slate-300 space-y-2 mb-8 ml-6">
                    <li>• Reduced stress and anxiety levels</li>
                    <li>• Improved sleep quality</li>
                    <li>• Greater sense of control over your life</li>
                    <li>• Increased confidence in financial decision-making</li>
                    <li>• More energy for pursuing life goals</li>
                </ul>

                <h2 class="text-3xl font-bold text-white mb-6 mt-12">Conclusion</h2>

                <p class="text-slate-300 leading-relaxed mb-8">
                    Understanding the psychology of debt is the first step toward financial freedom. By recognizing the emotional and behavioral factors that lead to debt, you can develop strategies to avoid unnecessary borrowing and manage existing debt more effectively.
                </p>

                <p class="text-slate-300 leading-relaxed mb-8">
                    Remember: debt is a tool that can either serve your goals or hinder them. Use DecideLab's debt simulation tools to understand the true cost of borrowing and make decisions that align with both your financial and emotional well-being.
                </p>

                <!-- Use Our Calculator -->
                <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-6 mt-12">
                    <h3 class="text-xl font-semibold text-white mb-3">Calculate Your Debt Freedom Plan</h3>
                    <p class="text-slate-300 mb-4">Ready to understand how long it will take to become debt-free? Use our loan simulation tool to create a personalized payoff plan.</p>
                    <a href="{{ url(app()->getLocale() . '/loan/simulation') }}" class="inline-block px-6 py-3 bg-red-600 hover:bg-red-500 text-white font-semibold rounded-lg transition duration-200">
                        Try Debt Calculator
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection