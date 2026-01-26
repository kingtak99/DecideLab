@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-8">{{ __('messages.contact_title') }}</h1>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-6">{{ __('messages.contact_intro') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.contact_methods') }}</h2>
        <ul class="text-slate-300 mb-6 list-disc list-inside">
            <li>{{ __('messages.contact_email') }}: <a href="mailto:info.zaynix@gmail.com" class="text-indigo-400 hover:text-indigo-300 underline">info.zaynix@gmail.com</a></li>
            <li>{{ __('messages.contact_form') }}</li>
            <li>{{ __('messages.contact_social') }}</li>
        </ul>

        <p class="text-slate-300">{{ __('messages.contact_response') }}</p>
    </div>
</div>
@endsection