<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Hreflang tags for SEO --}}
    @if(request()->is('/') || request()->is('*/'))
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

    <title>DecideLab | {{ app()->getLocale() === 'ar' ? 'جرّب القرار قبل ما تعيش عواقبه' : 'Try the Decision Before You Live Its Consequences' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/navbar.css', 'resources/js/navbar.js'])
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

    {{-- Page Scripts --}}
    @yield('scripts')

</body>

</html>
