@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-2">{{ __('messages.about_title') }}</h1>
    <p class="text-slate-400 mb-8 text-sm">Transforming Financial Decisions Through Data & Clarity</p>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-8">{{ __('messages.about_intro') }}</p>

        <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-white mb-4">Our Mission</h2>
            <p class="text-slate-300">We believe that every major life decision deserves clear, data-driven analysis. DecideLab was created to eliminate emotional decision-making and replace it with numbers that matter: cost over a lifetime, not just monthly payments.</p>
        </div>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.about_problem') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_problem_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.about_solution') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_solution_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.about_difference') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_difference_text') }}</p>

        <div class="grid md:grid-cols-2 gap-6 my-12">
            <div class="bg-slate-900/50 p-6 rounded-lg border border-white/10">
                <h3 class="text-xl font-semibold text-white mb-2">Why Choose DecideLab?</h3>
                <ul class="text-slate-300 space-y-2">
                    <li>✓ Data-driven analysis</li>
                    <li>✓ Country-specific calculations</li>
                    <li>✓ Long-term perspective</li>
                    <li>✓ No bias towards products</li>
                    <li>✓ Educational focus</li>
                    <li>✓ Free and accessible</li>
                </ul>
            </div>
            <div class="bg-slate-900/50 p-6 rounded-lg border border-white/10">
                <h3 class="text-xl font-semibold text-white mb-2">What DecideLab Does</h3>
                <ul class="text-slate-300 space-y-2">
                    <li>📊 Simulates financial decisions</li>
                    <li>⏳ Converts costs into time</li>
                    <li>🌍 Adapts to your country</li>
                    <li>🔬 Uses real economic data</li>
                    <li>📈 Shows long-term impact</li>
                    <li>🎓 Educational approach</li>
                </ul>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.about_vision') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_vision_text') }}</p>

        <div class="bg-purple-900/20 border border-purple-500/30 rounded-lg p-6 mt-12 mb-8">
            <h3 class="text-xl font-semibold text-white mb-2">Company Information</h3>
            <p class="text-slate-300 mb-4">{{ __('messages.about_developed_by') }}</p>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <strong class="text-slate-300">Website:</strong>
                    <p class="text-slate-400">www.decidelabtools.com</p>
                </div>
                <div>
                    <strong class="text-slate-300">Email:</strong>
                    <p class="text-slate-400">info.zaynix@gmail.com</p>
                </div>
                <div>
                    <strong class="text-slate-300">Organization:</strong>
                    <p class="text-slate-400">ZAYANIX TECHNOLOGY</p>
                </div>
                <div>
                    <strong class="text-slate-300">Type:</strong>
                    <p class="text-slate-400">Educational Technology</p>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">Our Tools</h2>
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-slate-900/50 p-6 rounded-lg border border-indigo-500/30">
                <h3 class="text-lg font-semibold text-indigo-400 mb-2">🏦 Loan Simulation</h3>
                <p class="text-slate-300 text-sm">Calculate real loan costs in years of your life, not just monthly payments.</p>
            </div>
            <div class="bg-slate-900/50 p-6 rounded-lg border border-purple-500/30">
                <h3 class="text-lg font-semibold text-purple-400 mb-2">💼 Job Change Analyzer</h3>
                <p class="text-slate-300 text-sm">Compare job offers beyond salary with stress, time, and risk analysis.</p>
            </div>
            <div class="bg-slate-900/50 p-6 rounded-lg border border-emerald-500/30">
                <h3 class="text-lg font-semibold text-emerald-400 mb-2">🏠 Housing Calculator</h3>
                <p class="text-slate-300 text-sm">Decide between renting and buying with true cost analysis.</p>
            </div>
            <div class="bg-slate-900/50 p-6 rounded-lg border border-red-500/30">
                <h3 class="text-lg font-semibold text-red-400 mb-2">⏳ Life Shock</h3>
                <p class="text-slate-300 text-sm">Discover how much of your life passes unnoticed and take it back.</p>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">Educational Commitment</h2>
        <p class="text-slate-300 mb-4">DecideLab is not a financial advisory service, nor do we recommend specific products. Instead, we provide tools and educational information to help you make your own informed decisions based on clear data and analysis.</p>

        <p class="text-slate-400 mt-8 text-sm italic">DecideLab is committed to maintaining the highest standards of transparency, accuracy, and user privacy. Our goal is to empower individuals with the tools and knowledge they need to make better life decisions.</p>
    </div>
</div>
@endsection