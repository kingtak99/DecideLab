@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-8">{{ __('messages.terms_title') }}</h1>

    <div class="prose prose-lg prose-invert max-w-none">
        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.terms_acceptance') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_acceptance_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.terms_limitations') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_limitations_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.terms_liability') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_liability_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.terms_ip') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_ip_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.terms_modifications') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_modifications_text') }}</p>
    </div>
</div>
@endsection