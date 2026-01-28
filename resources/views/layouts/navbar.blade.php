<nav class="navbar">
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">DecideLab</a>

        <ul class="nav-links">
            <li>
                <a href="{{ route('loan.housing', ['locale' => session('locale', 'ar')]) }}">
                    {{ __('messages.loan_Housing_simulation_nav') }}
                </a>
            </li>
            <li><a href="{{ route('loan.simulation', ['locale' => session('locale', 'ar')]) }}">{{ __('messages.loan_simulation_nav') }}</a></li>
           
            <li><a href="{{ route('job.change.simulation', ['locale' => session('locale', 'ar')]) }}">{{ __('messages.job_change_nav') }}</a></li>
           
            <li><a href="{{ route('life.shock.simulation', ['locale' => session('locale', 'ar')]) }}">{{ __('messages.life_shock_nav') }}</a></li>
        </ul>

    </div>


    <div class="nav-right">
        <!-- Language -->
        <div class="dropdown">
            <button class="drop-btn" id="language-btn">
                @if (app()->getLocale() === 'ar')
                    <img src="https://flagcdn.com/sa.svg" class="flag" alt="Saudi Arabia"> {{ __('messages.arabic') }}
                @else
                    <img src="https://flagcdn.com/gb.svg" class="flag" alt="English"> {{ __('messages.english') }}
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
            <button class="drop-btn" id="location-btn">
                <img id="current-flag" src="" alt="" class="flag" style="display: none;">
                <span id="current-country">{{ __('messages.jordan') }}</span>
                <span class="arrow">▾</span>
            </button>
            <div class="dropdown-menu location-menu">
                <div class="search-container">
                    <input type="text" id="country-search"
                        placeholder="Search countries..."
                        class="country-search">
                </div>
                <div id="countries-list" class="countries-list">
                    <!-- Countries will be loaded here -->
                </div>
            </div>
        </div>

        @guest
            <a href="{{ route('login') }}" class="btn btn-login">{{ __('messages.login') }}</a>
            <a href="{{ route('register') }}" class="btn btn-register">{{ __('messages.register') }}</a>
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
                    @if(in_array(auth()->user()->email, $adminEmails))
                        <a href="{{ route('admin.dashboard') }}">{{ __('messages.admin_dashboard') ?? 'Admin Dashboard' }}</a>
                        <a href="{{ route('analytics.dashboard', ['locale' => session('locale', 'ar')]) }}">📊 Analytics Dashboard</a>
                        <a href="{{ route('analytics.detected-bots', ['locale' => session('locale', 'ar')]) }}">🤖 Detected Bots</a>
                        <hr style="margin: 5px 0; border: none; border-top: 1px solid #ddd;">
                    @endif
                    <a href="{{ route('profile.edit') }}">{{ __('messages.profile') }}</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

    <!-- Mobile toggle -->
    <div class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
