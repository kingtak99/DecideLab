@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-8">{{ __('messages.about_title') }}</h1>

    <div class="prose prose-lg prose-invert max-w-none">
        <p class="text-xl text-slate-300 mb-6">{{ __('messages.about_intro') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.about_problem') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_problem_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.about_solution') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_solution_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.about_difference') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_difference_text') }}</p>

        <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('messages.about_vision') }}</h2>
        <p class="text-slate-300 mb-6">{{ __('messages.about_vision_text') }}</p>

        <p class="text-slate-400 mt-8">{{ __('messages.about_developed_by') }}</p>
    </div>
</div>
@endsection