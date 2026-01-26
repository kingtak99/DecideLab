@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-8">{{ __('messages.privacy_policy_title') }}</h1>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-6">{{ __('messages.privacy_policy_intro') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.privacy_policy_data_collected') }}</h2>
        <ul class="text-slate-300 mb-6 list-disc list-inside">
            <li>{{ __('messages.privacy_policy_data_1') }}</li>
            <li>{{ __('messages.privacy_policy_data_2') }}</li>
            <li>{{ __('messages.privacy_policy_data_3') }}</li>
        </ul>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.privacy_policy_data_usage') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_usage_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.privacy_policy_cookies') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_cookies_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.privacy_policy_user_rights') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.privacy_policy_rights_text') }}</p>

        <p class="text-slate-300">{{ __('messages.privacy_policy_consent') }}</p>
    </div>
</div>
@endsection