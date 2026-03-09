@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-white mb-2">{{ __('messages.contact_title') }}</h1>
    <p class="text-slate-400 mb-8">We'd love to hear from you. Get in touch with our team.</p>

    <div class="grid md:grid-cols-2 gap-12 mb-12">
        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-6">{{ __('messages.contact_methods') }}</h2>
            
            <div class="space-y-6">
                <div class="bg-slate-900/50 p-6 rounded-lg border border-indigo-500/30">
                    <h3 class="text-lg font-semibold text-indigo-400 mb-2">📧 {{ __('messages.contact_email') }}</h3>
                    <a href="mailto:info.zaynix@gmail.com" class="text-indigo-400 hover:text-indigo-300 underline break-all">
                        info.zaynix@gmail.com
                    </a>
                    <p class="text-slate-400 text-sm mt-2">For general inquiries and support</p>
                </div>

                <div class="bg-slate-900/50 p-6 rounded-lg border border-purple-500/30">
                    <h3 class="text-lg font-semibold text-purple-400 mb-2">⏱️ Response Time</h3>
                    <p class="text-slate-300">{{ __('messages.contact_response') }}</p>
                </div>

                <div class="bg-slate-900/50 p-6 rounded-lg border border-emerald-500/30">
                    <h3 class="text-lg font-semibold text-emerald-400 mb-2">💬 Feedback</h3>
                    <p class="text-slate-300">We value your suggestions for improving DecideLab. All feedback helps us serve you better.</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-semibold text-white mt-8 mb-6">Send us a Message</h2>
            
            <form class="space-y-4" action="#" method="POST" id="contactForm">
                @csrf
                <div>
                    <label class="block text-slate-300 text-sm font-medium mb-2">
                        {{ __('messages.contact_form_name') }}
                    </label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
                        placeholder="Your name">
                </div>

                <div>
                    <label class="block text-slate-300 text-sm font-medium mb-2">
                        {{ __('messages.contact_form_email') }}
                    </label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
                        placeholder="Your email">
                </div>

                <div>
                    <label class="block text-slate-300 text-sm font-medium mb-2">
                        {{ __('messages.contact_form_subject') }}
                    </label>
                    <input type="text" name="subject" required
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
                        placeholder="Message subject">
                </div>

                <div>
                    <label class="block text-slate-300 text-sm font-medium mb-2">
                        {{ __('messages.contact_form_message') }}
                    </label>
                    <textarea name="message" rows="5" required
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"
                        placeholder="Your message..."></textarea>
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg transition duration-200">
                    {{ __('messages.contact_form_submit') }}
                </button>
            </form>

            <p class="text-slate-400 text-sm mt-4">
                {{ __('messages.contact_form_required') }}
            </p>
        </div>
    </div>

    <div class="bg-slate-900/50 border border-slate-700 rounded-lg p-8 mt-12">
        <h2 class="text-2xl font-semibold text-white mb-6">Frequently Asked Questions</h2>
        
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-2">How accurate are the calculations?</h3>
                <p class="text-slate-300">Our calculations use real economic data for each country. However, they are estimates designed to show trends and long-term impact, not exact predictions. Actual results will vary based on market conditions and personal circumstances.</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-2">Is DecideLab a financial advisor?</h3>
                <p class="text-slate-300">No. DecideLab is an educational tool. All results are for informational purposes only and should not be considered professional financial advice. Always consult a qualified financial advisor for important decisions.</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-2">Can I use DecideLab for my country?</h3>
                <p class="text-slate-300">DecideLab supports multiple countries and adapts all calculations to your selected country's economic data. If your country isn't listed, contact us and we'll work on adding it.</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-indigo-400 mb-2">Is my data private and secure?</h3>
                <p class="text-slate-300">Yes. We take privacy seriously and implement strong security measures. Check our Privacy Policy for complete information on how we handle your data.</p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contactForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Thank you for your message! We will get back to you soon.');
    this.reset();
});
</script>
@endsection