@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
        <!-- Glow Effects -->
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-emerald-600/20 rounded-full blur-3xl"></div>

        <div class="relative flex items-center justify-center min-h-screen px-6 py-12">
            <div class="w-[500px]">
                <!-- Auth Card -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-white mb-2">
                            {{ __('messages.welcome_back') ?? 'Welcome Back' }}
                        </h2>
                        <p class="text-slate-400">
                            {{ __('messages.sign_in_to_account') ?? 'Sign in to your account' }}
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl">
                            <p class="text-emerald-400 text-sm">{{ session('status') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                📧 {{ __('messages.email') ?? 'Email' }}
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 hover:border-slate-600"
                                placeholder="{{ __('messages.enter_email') ?? 'Enter your email' }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                🔒 {{ __('messages.password') ?? 'Password' }}
                            </label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 hover:border-slate-600"
                                placeholder="{{ __('messages.enter_password') ?? 'Enter your password' }}">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-slate-700 text-emerald-500 focus:ring-emerald-500 bg-slate-800 mr-2">
                            <label for="remember_me" class="ml-2 text-sm text-slate-400">
                                {{ __('messages.remember_me') ?? 'Remember me' }}
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                            {{ __('messages.log_in') ?? 'Log In' }}
                        </button>
                    </form>

                    <!-- Links -->
                    <div class="mt-6 text-center space-y-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-slate-400 hover:text-emerald-400 transition">
                                {{ __('messages.forgot_password') ?? 'Forgot your password?' }}
                            </a>
                        @endif
                        <div class="text-slate-500">|</div>
                        <a href="{{ route('register') }}" class="text-sm text-slate-400 hover:text-emerald-400 transition">
                            {!! __('messages.dont_have_account') ?? "Don't have an account? <strong>Register</strong>" !!}
                        </a>
                    </div>
                    <br>
                    <!-- Social Login -->
                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span
                                    class="px-2 bg-slate-900 text-slate-400">{{ __('messages.or_continue_with') ?? 'Or continue with' }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('google.login') }}"
                                class="w-full inline-flex justify-center items-center py-3 px-4 border border-slate-700 rounded-xl shadow-sm bg-slate-800 text-slate-300 hover:bg-slate-700 transition">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="currentColor"
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="currentColor"
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="currentColor"
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                {{ __('messages.continue_with_google') ?? 'Continue with Google' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
