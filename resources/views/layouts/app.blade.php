<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Hreflang tags for SEO --}}
    @if (request()->is('/') || request()->is('*/'))
        <link rel="alternate" hreflang="en" href="{{ url('en') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar') }}" />
    @elseif(request()->is('*/about'))
        <link rel="alternate" hreflang="en" href="{{ url('en/about') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar/about') }}" />
    @elseif(request()->is('*/how-it-works'))
        <link rel="alternate" hreflang="en" href="{{ url('en/how-it-works') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar/how-it-works') }}" />
    @elseif(request()->is('*/privacy-policy'))
        <link rel="alternate" hreflang="en" href="{{ url('en/privacy-policy') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar/privacy-policy') }}" />
    @elseif(request()->is('*/terms-of-service'))
        <link rel="alternate" hreflang="en" href="{{ url('en/terms-of-service') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar/terms-of-service') }}" />
    @elseif(request()->is('*/contact-us'))
        <link rel="alternate" hreflang="en" href="{{ url('en/contact-us') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar/contact-us') }}" />
    @elseif(request()->is('*/countries-data-sources'))
        <link rel="alternate" hreflang="en" href="{{ url('en/countries-data-sources') }}" />
        <link rel="alternate" hreflang="ar" href="{{ url('ar/countries-data-sources') }}" />
    @endif

    <title>DecideLab |
        {{ app()->getLocale() === 'ar' ? 'جرّب القرار قبل ما تعيش عواقبه' : 'Try the Decision Before You Live Its Consequences' }}
    </title>

    {{-- Main app assets (always) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--
        During local development or when NAVBAR_USE_SOURCE=true we inline the
        navbar source CSS/JS so changes in resources/* are reflected immediately
        without rebuilding Vite. In production we keep using the built assets
        (via @vite) to avoid regressions.
    --}}
    @if (app()->environment('local') || env('NAVBAR_USE_SOURCE') == 'true')
        @php
            $navbarCss = resource_path('css/navbar.css');
            $navbarJs = resource_path('js/navbar.js');
        @endphp

        @if (file_exists($navbarCss))
            <style>
                {!! file_get_contents($navbarCss) !!}
            </style>
        @endif

        @if (file_exists($navbarJs))
            <script>
                {!! file_get_contents($navbarJs) !!}
            </script>
        @endif
    @else
        @vite(['resources/css/navbar.css', 'resources/js/navbar.js'])
    @endif

    <script>
        // Expose the current Laravel session_id for heartbeat usage
        window.APP = window.APP || {};
        window.APP.sessionId = "{{ session()->getId() }}";
    </script>
</head>

<body class="bg-slate-950 text-slate-100 antialiased pt-16">

    {{-- Navbar --}}

    @include('layouts.navbar')



    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Heartbeat script (fires lightweight pings to /analytics/heartbeat) --}}
    <script>
        (function(){
            const INTERVAL = 15; // seconds
            let lastSent = Date.now();
            let timer = null;
            const sessionId = window.APP && window.APP.sessionId ? window.APP.sessionId : null;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!sessionId) return; // nothing to do without a session

            function sendHeartbeat(opts = {}){
                const payload = {
                    session_id: sessionId,
                    page: opts.page || window.location.pathname + window.location.search,
                    delta: opts.delta || null,
                    has_scroll: opts.has_scroll || false,
                };

                // Use navigator.sendBeacon on unload for reliability
                if (opts.useBeacon && navigator.sendBeacon) {
                    const blob = new Blob([JSON.stringify(payload)], {type: 'application/json'});
                    navigator.sendBeacon('/analytics/heartbeat', blob);
                    return;
                }

                fetch('/analytics/heartbeat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload)
                }).catch(()=>{});
            }

            function tick(){
                if (document.hidden) return; // pause when tab not visible
                const now = Date.now();
                if ((now - lastSent) >= INTERVAL * 1000) {
                    sendHeartbeat();
                    lastSent = now;
                }
            }

            // Start interval
            timer = setInterval(tick, 5000);

            // Visibility change should trigger an immediate heartbeat when returning
            document.addEventListener('visibilitychange', function(){
                if (!document.hidden) {
                    sendHeartbeat({delta: Math.round((Date.now() - lastSent) / 1000)});
                    lastSent = Date.now();
                }
            });

            // On unload, send a final beacon
            window.addEventListener('beforeunload', function(){
                sendHeartbeat({useBeacon: true});
            });

            // Optional: small listener for scroll events to mark scroll soon
            let scrollDebounced = false;
            window.addEventListener('scroll', function(){
                if (scrollDebounced) return;
                scrollDebounced = true;
                // Send a heartbeat marking has_scroll true
                sendHeartbeat({has_scroll: true});
                setTimeout(()=> scrollDebounced = false, 10000);
            }, {passive: true});
        })();
    </script>

    {{-- Page Scripts --}}
    @yield('scripts')

</body>

</html>
