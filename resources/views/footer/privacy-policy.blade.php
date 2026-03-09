@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-2">{{ __('messages.privacy_policy_title') }}</h1>
    <p class="text-slate-400 mb-8 text-sm">Last Updated: March 2026</p>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-8">{{ __('messages.privacy_policy_intro') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_data_collected') }}</h2>
        <p class="text-slate-300 mb-4">We collect the following types of information:</p>
        <ul class="text-slate-300 mb-6 list-disc list-inside space-y-2">
            <li>{{ __('messages.privacy_policy_data_1') }}</li>
            <li>{{ __('messages.privacy_policy_data_2') }}</li>
            <li>{{ __('messages.privacy_policy_data_3') }}</li>
            <li>{{ __('messages.privacy_policy_data_4') }}</li>
            <li>{{ __('messages.privacy_policy_data_5') }}</li>
        </ul>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_data_usage') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_usage_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_security') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_security_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_cookies') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_cookies_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_third_party') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_third_party_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_user_rights') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_rights_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_gdpr') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_gdpr_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_children') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_children_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_retention') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_retention_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_international') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_international_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_changes') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_changes_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-12 mb-4">{{ __('messages.privacy_policy_contact') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_contact_text') }}</p>

        <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-lg p-6 mt-12">
            <p class="text-slate-300">{{ __('messages.privacy_policy_consent') }}</p>
        </div>
    </div>
</div>
@endsection