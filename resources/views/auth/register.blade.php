@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">

        <div class="relative flex items-center justify-center min-h-screen px-6 py-12">
            <div class="w-[500px]">

                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">

                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-white mb-2">
                            {{ __('messages.create_account') ?? 'Create Account' }}
                        </h2>
                        <p class="text-slate-400">
                            {{ __('messages.join_us_today') ?? 'Join us today and start your journey' }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">👤
                                {{ __('messages.name') }}</label>
                            <input id="name" type="text" name="name" required
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">📧
                                {{ __('messages.email') }}</label>
                            <input id="email" type="email" name="email" required
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100">
                            <p id="email-error" class="mt-1 text-sm text-red-500 hidden" style="color: red;"></p>
                            <!-- NEW -->
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">🔒
                                {{ __('messages.password') }}</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                novalidate
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100">
                            <p id="password-error" class="mt-1 text-sm text-red-500 hidden" style="color: red;"></p>
                            <!-- NEW -->
                        </div>

                        <!-- Confirm -->
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">🔒
                                {{ __('messages.confirm_password') }}</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-slate-100">
                            <p id="confirm-error" class="mt-1 text-sm text-red-500 hidden" style="color: red;"></p>
                            <!-- NEW -->
                        </div>
                        <!-- Submit -->
                        <button id="registerBtn" type="submit" disabled
                            class="w-full bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold py-4 px-6 rounded-xl opacity-50 cursor-not-allowed transition">
                            {{ __('messages.create_account_button') }}
                        </button>
                        <!-- Google Sign In -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <span class="w-full border-t border-slate-600"></span>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-slate-900/50 text-slate-400">{{ __('messages.or') ?? 'or' }}</span>
                            </div>
                        </div>

                        <a href="{{ route('google.login') }}"
                            class="w-full flex items-center justify-center bg-white text-gray-900 font-bold py-4 px-6 rounded-xl hover:bg-gray-100 transition">
                            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                <path fill="#4285F4"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05"
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335"
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            {{ __('messages.sign_in_with_google') ?? 'Sign in with Google' }}
                        </a>



                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= JS ================= -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const translations = {
                invalid_email_format: '{{ __('messages.invalid_email_format') }}',
                email_already_taken: '{{ __('messages.email_already_taken') }}',
                password_too_short: '{{ __('messages.password_too_short') }}',
                password_no_lowercase: '{{ __('messages.password_no_lowercase') }}',
                password_no_uppercase: '{{ __('messages.password_no_uppercase') }}',
                password_no_number: '{{ __('messages.password_no_number') }}',
                password_no_special: '{{ __('messages.password_no_special') }}',
                passwords_not_match: '{{ __('messages.passwords_not_match') }}',
                creating: '{{ __('messages.creating_account') }}'
            };

            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            const btn = document.getElementById('registerBtn');

            const emailError = document.getElementById('email-error');
            const passError = document.getElementById('password-error');
            const confirmError = document.getElementById('confirm-error');
            let lastPasswordValue = '';
            let emailOk = false,
                passOk = false,
                confirmOk = false;


            const toggleBtn = () => {
                const isValid = emailOk && passOk && confirmOk;

                btn.disabled = !isValid;

                btn.classList.toggle('opacity-50', !isValid);
                btn.classList.toggle('cursor-not-allowed', !isValid);
            };


            // ================= EMAIL =================
            email.addEventListener('input', async () => {
                email.classList.remove('border-red-500', 'ring-2', 'ring-red-500');

                emailError.classList.add('hidden');

                if (!email.value.includes('@')) {
                    emailError.textContent = translations.invalid_email_format;
                    emailError.classList.remove('hidden');
                    email.classList.add('border-red-500', 'ring-2', 'ring-red-500');

                    emailOk = false;
                    return toggleBtn();
                }

                const res = await fetch("{{ route('check.email') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email.value
                    })
                });

                const data = await res.json();

                if (data.exists) {
                    emailError.textContent = translations.email_already_taken;
                    emailError.classList.remove('hidden');
                    email.classList.add('border-red-500', 'ring-red-500');
                    emailOk = false;
                } else {
                    emailOk = true;
                }
                toggleBtn();
            });

            // ================= PASSWORD =================


            password.addEventListener('input', () => {
                passOk = false;

                passError.classList.add('hidden');
                password.classList.remove('border-red-500', 'ring-2', 'ring-red-500');

                const value = password.value;

                if (value.length < 8) {
                    passError.textContent = translations.password_too_short;
                } else if (!/[a-z]/.test(value)) {
                    passError.textContent = translations.password_no_lowercase;
                } else if (!/[A-Z]/.test(value)) {
                    passError.textContent = translations.password_no_uppercase;
                } else if (!/\d/.test(value)) {
                    passError.textContent = translations.password_no_number;
                } else if (!/[^A-Za-z0-9]/.test(value)) {
                    passError.textContent = translations.password_no_special;
                } else {
                    passOk = true;
                }

                if (!passOk) {
                    passError.classList.remove('hidden');
                    password.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                }

                // Reset confirm when password changes
                confirm.value = '';
                confirmOk = false;
                confirmError.classList.add('hidden');
                confirm.classList.remove('border-red-500', 'ring-2', 'ring-red-500');

                toggleBtn();
            });
            // ================= CONFIRM PASSWORD =================
            confirm.addEventListener('input', () => {
                confirmOk = false;

                confirmError.classList.add('hidden');
                confirm.classList.remove('border-red-500', 'ring-2', 'ring-red-500');

                if (confirm.value !== password.value || confirm.value === '') {
                    confirmError.textContent = translations.passwords_not_match;
                    confirmError.classList.remove('hidden');
                    confirm.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                } else {
                    confirmOk = true;
                }

                toggleBtn();
            });

            // ================= PREVENT SPAM =================
            document.getElementById('registerForm').addEventListener('submit', () => {
                btn.disabled = true;
                btn.innerText = translations.creating;
            });
        });
    </script>
@endsection
