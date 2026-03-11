<footer class="border-t border-white/10 mt-24 bg-slate-950/50 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Brand Section -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-white mb-2">DecideLab</h2>
            <p class="text-slate-400 text-sm max-w-md mx-auto">
                {{ __('messages.footer_brand_description') }}
            </p>
        </div>
        <br>
        <!-- Navigation Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Main Pages -->
            <div>
                <h3 class="text-slate-300 font-medium text-sm mb-4">{{ __('messages.footer_company') ?? 'Company' }}</h3>
                <div class="space-y-3">
                    <a href="{{ url(app()->getLocale() . '/about') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_about') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/how-it-works') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_how_it_works') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/contact-us') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_contact') }}
                    </a>
                </div>
            </div>

            <!-- Legal Pages -->
            <div>
                <h3 class="text-slate-300 font-medium text-sm mb-4">{{ __('messages.footer_legal') ?? 'Legal' }}</h3>
                <div class="space-y-3">
                    <a href="{{ url(app()->getLocale() . '/privacy-policy') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_privacy') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/terms-of-service') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_terms') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/disclaimer') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_disclaimer') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/countries-data-sources') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_countries') }}
                    </a>
                </div>
            </div>

            <!-- Articles -->
            <div>
                <h3 class="text-slate-300 font-medium text-sm mb-4">{{ __('messages.footer_articles') ?? 'Articles' }}</h3>
                <div class="space-y-3">
                    <a href="{{ url(app()->getLocale() . '/articles') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_all_articles') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/case-study-250k-mortgage') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_case_study_mortgage') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/case-study-job-trap') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_case_study_job_trap') }}
                    </a>
                    <a href="{{ url(app()->getLocale() . '/understanding-interest-rates') }}"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm block">
                        {{ __('messages.footer_interest_rates') ?? 'Understanding Interest Rates' }}
                    </a>
                </div>
            </div>
        </div>
 <br>
        <!-- Bottom Section -->
        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-slate-400 text-sm mb-4">
                {{ __('messages.footer_text') }}
            </p>
            <div class="flex items-center justify-center space-x-4 text-xs text-slate-500">
                <span>{{ __('messages.footer_powered_by') }}</span>
                <div class="w-px h-4 bg-slate-600"></div>
                <span>ZAYANIX TECHNOLOGY</span>
            </div>
        </div>
    </div>
</footer>
