@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-8">{{ __('messages.how_it_works_title') }}</h1>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-6">{{ __('messages.how_it_works_intro') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.how_it_works_country_selection') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.how_it_works_country_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.how_it_works_data_input') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.how_it_works_data_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.how_it_works_calculation') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.how_it_works_calculation_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.how_it_works_notes') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.how_it_works_notes_text') }}</p>
    </div>
</div>
@endsection