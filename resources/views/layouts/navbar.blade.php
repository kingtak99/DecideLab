<nav class="navbar">
    <style>
        /* Temporary mobile overrides (force immediate effect without rebuilding assets) */
        @media (max-width: 900px) {
            .nav-links {
                gap: 6px !important;
                padding: 18px !important;
            }

            .nav-links li {
                padding: 14px 0 !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            }

            .nav-links a {
                padding: 12px 8px !important;
                font-size: 15px !important;
                line-height: 1.4 !important;
            }

            .mobile-actions {
                padding-top: 14px !important;
                width: 100% !important;
                border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
            }

            .mobile-actions .mobile-btn {
                display: block !important;
                width: 100% !important;
                margin: 8px 0 !important;
                padding: 10px 12px !important;
                font-size: 15px !important;
                border-radius: 8px !important;
            }

            /* Force logo switch on small viewports (high priority) */
            .logo .logo-full {
                display: none !important;
            }

            .logo .logo-short {
                display: inline-block !important;
            }
        }

        /* Desktop: ensure full logo visible (in case other CSS interferes) */
        @media (min-width: 901px) {
            .logo .logo-full {
                display: inline-block !important;
            }

            .logo .logo-short {
                display: none !important;
            }
        }
    </style>

    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo" title="DecideLab">
            <span class="logo-full">DecideLab</span>
            <span class="logo-short" aria-hidden="true">DL</span>
        </a>
        <noscript>
            <style>
                /* Fallback if JS disabled: use CSS-only rule */
                .logo .logo-full {
                    display: inline-block !important;
                }

                .logo .logo-short {
                    display: none !important;
                }
            </style>
        </noscript>

        <ul class="nav-links">
            <li>
                <a href="{{ route('loan.housing', ['locale' => session('locale', 'ar')]) }}">
                    {{ __('messages.loan_Housing_simulation_nav') }}
                </a>
            </li>
            <li><a
                    href="{{ route('loan.simulation', ['locale' => session('locale', 'ar')]) }}">{{ __('messages.loan_simulation_nav') }}</a>
            </li>

            <li><a
                    href="{{ route('job.change.simulation', ['locale' => session('locale', 'ar')]) }}">{{ __('messages.job_change_nav') }}</a>
            </li>

            <li><a
                    href="{{ route('life.shock.simulation', ['locale' => session('locale', 'ar')]) }}">{{ __('messages.life_shock_nav') }}</a>
            </li>

            <!-- Mobile-only actions (shown inside the mobile menu to avoid overlap) -->
            {{-- <li class="mobile-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-login mobile-btn">{{ __('messages.login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-register mobile-btn">{{ __('messages.register') }}</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="mobile-link">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}" style="margin-top:8px;">
                        @csrf
                        <button type="submit" class="btn btn-login mobile-btn">{{ __('messages.logout') }}</button>
                    </form>
                @endguest
            </li> --}}
        </ul>

    </div>


    <div class="nav-right">




        @guest
            <a href="{{ route('login') }}" style="font-size: 10px;" class="btn btn-login">{{ __('messages.login') }}</a>
            <a href="{{ route('register') }}" style="font-size: 10px;"
                class="btn btn-register">{{ __('messages.register') }}</a>
        @endguest

        @auth
            <div class="dropdown user-dropdown">
                <button class="user-btn" title="{{ Auth::user()->name }}">
                    {{ Auth::user()->name }}
                    <span class="arrow">▾</span>
                </button>
                <div class="dropdown-menu">
                    @php
                        $adminEmails = ['hasantak99@gmail.com', 'admin99@decidelab.com'];
                    @endphp
                    @if (in_array(auth()->user()->email, $adminEmails))
                        <a
                            href="{{ route('admin.dashboard') }}">{{ __('messages.admin_dashboard') ?? 'Admin Dashboard' }}</a>
                        <a href="{{ route('analytics.dashboard', ['locale' => session('locale', 'ar')]) }}">📊 Analytics
                            Dashboard</a>
                        <a href="{{ route('analytics.detected-bots', ['locale' => session('locale', 'ar')]) }}">🤖 Detected
                            Bots</a>
                        <hr style="margin: 5px 0; border: none; border-top: 1px solid #ddd;">
                    @endif
                    {{-- <a href="{{ route('profile.edit') }}">{{ __('messages.profile') }}</a> --}}

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            </div>
        @endauth
        <!-- Language -->
        <div class="dropdown">
            <button class="drop-btn" id="language-btn">
                @if (app()->getLocale() === 'ar')
                    {{-- <img src="https://flagcdn.com/sa.svg" class="flag" alt="Saudi Arabia"> --}}
                    {{ __('messages.arabic') }}
                    <span class="arrow">▾</span>
                @else
                    {{-- <img src="https://flagcdn.com/gb.svg" class="flag" alt="English"> --}}
                    {{ __('messages.english') }}
                    <span class="arrow">▾</span>
                @endif
            </button>
            <div class="dropdown-menu">
                <a href="/lang/en" class="language-link {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                    data-lang="en">
                    <img src="https://flagcdn.com/gb.svg" class="flag" alt="English"> {{ __('messages.english') }}
                </a>
                <a href="/lang/ar" class="language-link {{ app()->getLocale() === 'ar' ? 'active' : '' }}"
                    data-lang="ar">
                    <img src="https://flagcdn.com/sa.svg" class="flag" alt="Arabic"> {{ __('messages.arabic') }}
                </a>
            </div>
        </div>
        <!-- Country -->
        <div class="dropdown location-dropdown">
            <button class="drop-btn" id="location-btn" >
                <span class="flag-wrapper">
                    <img id="current-flag" src="" alt="" class="flag" style="display: none;">
                    <span id="flag-spinner" class="flag-spinner hidden"></span>
                </span>
                <span class="arrow">▾</span>
            </button>

            <div class="dropdown-menu location-menu">
                <div class="search-container">
                    <input type="text" id="country-search" placeholder="Search countries..." class="country-search">
                </div>
                <div id="countries-list" class="countries-list">
                    <!-- Countries will be loaded here -->
                </div>
            </div>
            
        </div>
    </div>

    <!-- Mobile toggle -->
    <div class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
