@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-2">{{ __('messages.terms_title') }}</h1>
    <p class="text-slate-400 mb-8 text-sm">Last Updated: March 2026</p>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-8">{{ __('messages.terms_intro') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_acceptance') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_acceptance_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_use_license') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_use_license_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_limitations') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_limitations_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_liability') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_liability_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_user_responsibility') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_user_responsibility_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_ip') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_ip_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_user_content') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_user_content_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_prohibited') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_prohibited_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_modifications') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_modifications_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_termination') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_termination_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_links') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_links_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_indemnification') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_indemnification_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_governing_law') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_governing_law_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.terms_contact') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.terms_contact_text') }}</p>

        <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-lg p-6 mt-12">
            <p class="text-slate-300">{{ __('messages.terms_acknowledgment') }}</p>
        </div>
    </div>
</div>
@endsection