@extends('layouts.app')

@section('content')
 
    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
        <!-- Glow -->
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-32 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                🧠 {!! __('messages.hero_title') !!}
                <span class="text-indigo-400 block mt-2">
                    {!! __('messages.hero_subtitle') !!}
                </span>
            </h1>

            <p class="mt-6 text-lg text-slate-300 max-w-3xl mx-auto">
                {!! __('messages.hero_description') !!}
            </p>

            <div class="mt-10 flex justify-center gap-4 flex-wrap">
                <a href="#job-change"
                    class="px-8 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition font-bold text-lg">
                    {!! __('messages.start_simulation') !!}
                </a>

                {{-- <a href="#tools"
                    class="px-8 py-4 rounded-xl border border-white/20 hover:border-indigo-400 transition text-lg">
                    {!! __('messages.explore_tools') !!}
                </a> --}}
            </div>
        </div>
    </section>

    <!-- TOOLS -->
    <section id="job-change" class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold mb-4">
                    {!! __('messages.tools_title') !!}
                </h2>
                <p class="text-slate-400 text-lg">
                    {!! __('messages.tools_subtitle') !!}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Card: Loan Simulation -->
                <div
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-indigo-500 transition">
                    <div class="absolute inset-0 bg-indigo-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">🏦</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.loan_simulation_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.loan_simulation_description') !!}
                        </p>
                        <a href="{{ route('loan.simulation', ['locale' => $locale]) }}"
                            class="inline-flex items-center gap-2 text-indigo-400 font-semibold hover:text-indigo-300">
                            {!! __('messages.loan_simulation_button') !!}
                            <span>←</span>
                        </a>

                    </div>
                </div>

                <!-- Card: Job Change -->
                <div id="job-change"
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-purple-500 transition">
                    <div class="absolute inset-0 bg-purple-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">💼</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.job_change_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.job_change_description') !!}
                        </p>
                        <a href="{{ route('job.change.simulation', ['locale' => $locale]) }}"
                            class="inline-flex items-center gap-2 text-purple-400 font-semibold hover:text-purple-300">
                            {!! __('messages.job_change_button') !!}
                            <span>←</span>
                        </a>
                    </div>
                </div>


                <!-- Card: Housing -->
                <div
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-emerald-500 transition">
                    <div class="absolute inset-0 bg-emerald-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">🏠</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.housing_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.housing_description') !!}
                        </p>

                        <a href="{{ route('loan.housing', ['locale' => $locale]) }}"
                            class="inline-flex items-center gap-2 text-emerald-400 font-semibold hover:text-emerald-300">
                            {!! __('messages.housing_button') !!}
                            <span>←</span>
                        </a>
                    </div>
                </div>

                <!-- Card: Life Shock -->
                <div
                    class="relative group bg-slate-900 rounded-3xl p-8 border border-white/10 hover:border-red-500 transition">
                    <div class="absolute inset-0 bg-red-500/5 opacity-0 group-hover:opacity-100 rounded-3xl transition">
                    </div>
                    <div class="relative">
                        <div class="text-5xl mb-6">⏳</div>
                        <h3 class="text-2xl font-bold mb-3">{!! __('messages.life_shock_title') !!}</h3>
                        <p class="text-slate-400 leading-relaxed mb-6">
                            {!! __('messages.life_shock_description') !!}
                        </p>
                        <a href="{{ route('life.shock.simulation', ['locale' => $locale]) }}"
                            class="inline-flex items-center gap-2 text-red-400 font-semibold hover:text-red-300">
                            {!! __('messages.life_shock_button') !!}
                            <span>←</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SHOCK -->
    <section class="bg-gradient-to-r from-indigo-700 to-purple-700 py-24 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
            {!! __('messages.shock_title') !!}
        </h2>

        <p class="text-lg text-indigo-100 max-w-2xl mx-auto mb-10">
            {!! __('messages.shock_description') !!}
        </p>

        <a href="{{ route('life.shock.simulation', ['locale' => $locale]) }}"
            class="inline-block px-10 py-4 bg-white text-indigo-700 font-bold rounded-xl text-lg hover:scale-105 transition">
            {!! __('messages.shock_button') !!}
        </a>
    </section>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetID = this.getAttribute('href');

                // Skip empty hashes
                if (targetID === "#") return;

                const targetElement = document.querySelector(targetID);
                if (targetElement) {
                    e.preventDefault();

                    // Get current scroll position and target position
                    const startY = window.scrollY;
                    const targetY = targetElement.getBoundingClientRect().top + startY -
                    20; // -20 for offset if needed

                    const distance = targetY - startY;
                    const duration = 800; // Duration in ms (800 = 0.8 second)
                    let startTime = null;

                    function scroll(currentTime) {
                        if (!startTime) startTime = currentTime;
                        const timeElapsed = currentTime - startTime;
                        const progress = Math.min(timeElapsed / duration, 1);
                        const ease = progress < 0.5 ?
                            2 * progress * progress :
                            -1 + (4 - 2 * progress) * progress; // easeInOutQuad

                        window.scrollTo(0, startY + distance * ease);

                        if (timeElapsed < duration) {
                            requestAnimationFrame(scroll);
                        }
                    }

                    requestAnimationFrame(scroll);
                }
            });
        });
    </script>
@endsection
