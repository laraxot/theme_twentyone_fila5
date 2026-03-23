{{--
|--------------------------------------------------------------------------
| App Layout - Main Application Layout
|--------------------------------------------------------------------------
|
| Layout principale per l'applicazione Predict.
| Estende il layout base (main.blade.php) aggiungendo:
| - Meta tags SEO (Open Graph, Twitter Card)
| - Structured data (JSON-LD)
| - Analytics (Google Analytics, Matomo)
| - Navigation (header, footer)
|
| Architecture:
| - main.blade.php = HTML structure (head, body, main)
| - app.blade.php = main + SEO, analytics, navigation
| - Philosophy: composizione, DRY, separazione delle concern
|
| Usage:
|   <x-layouts.app title="Page Title" meta-description="Description">
|       <h1>Content</h1>
|   </x-layouts.app>
|
| Docs: docs/HOMEPAGE_LAYOUT_ARCHITECTURE.md
|
--}}

@props([
	'title' => config('app.name'),
	'metaDescription' => 'Prevedi il Futuro, Guadagna Crediti',
	// Folio parameters (ignored but accepted to prevent errors)
	'fallbackPlaceholder' => null,
	'container0' => null,
	'slug0' => null,
])

<x-layouts.main :title="$title" :meta-description="$metaDescription" body-class="bg-slate-950">

    {{-- SEO Meta Tags --}}
    @push('head')
        <meta name="description" content="{{ $metaDescription }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
        <meta property="og:site_name" content="Predict">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
        <meta name="twitter:image" content="{{ asset('images/twitter-image.jpg') }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Content Security Policy -->
        <!-- NOTE: HTTP header CSP in SecurityMiddleware overrides this meta tag -->
        <!-- Keeping meta tag as fallback for browsers that don't support header CSP -->
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://www.googletagmanager.com https://www.google-analytics.com https://cdn.jsdelivr.net https://unpkg.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net; img-src 'self' data: https: blob:; connect-src 'self' https: wss: https://www.google-analytics.com; object-src 'none';">

        <!-- Structured Data (JSON-LD) -->
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "WebSite",
            "name": "Predict",
            "url": "{{ url('/') }}",
            "description": "{{ $metaDescription }}",
            "publisher": {
                "@@type": "Organization",
                "name": "Predict",
                "url": "{{ url('/') }}",
                "logo": {
                    "@@type": "ImageObject",
                    "url": "{{ asset('images/logo.png') }}"
                }
            },
            "potentialAction": {
                "@@type": "SearchAction",
                "target": "{{ url('/search?q={search_term_string}') }}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>

        <!-- Google Analytics 4 - GDPR Compliant -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
        <script>
            window.dataLayer = window._dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'GA_MEASUREMENT_ID', {
                'anonymize_ip': true,
                'allow_google_signals': false,
                'allow_ad_features': false
            });
        </script>

        <!-- Matomo Analytics (if configured) -->
        @php
            $matomoHost = env('MATOMO_HOST');
            $matomoSiteId = (string) env('MATOMO_SITE_ID', '2');
        @endphp
        @if(is_string($matomoHost) && $matomoHost !== '')
            <script>
                var _paq = window._paq = window._paq || [];
                _paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function() {
                var u="{{ rtrim($matomoHost, '/') }}/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '{{ $matomoSiteId }}']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
                })();
            </script>
        @endif
    @endpush

    {{-- Header Navigation --}}
    <x-section slug="header" />

    {{-- Main Content (inherited from main.blade.php) --}}
    {{ $slot }}

    {{-- Footer --}}
    <x-section slug="footer" />

    {{-- Cookie Consent Banner - GDPR Compliant --}}
    <div id="cookie-consent" class="fixed bottom-0 left-0 right-0 bg-slate-900 border-t border-slate-700 p-4 z-50 hidden shadow-lg">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-slate-300 text-sm">
                Utilizziamo cookie per migliorare la tua esperienza e analizzare il traffico del sito.
                <a href="{{ url('/it/privacy') }}" class="text-emerald-400 hover:text-emerald-300 underline">Scopri di più</a>
            </p>
            <div class="flex gap-2 flex-shrink-0">
                <button id="accept-cookies" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                    Accetta Tutti
                </button>
                <button id="decline-cookies" class="border border-slate-600 hover:border-slate-500 text-slate-300 hover:text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                    Rifiuta
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Tabs --}}
    @include('pub_theme::layouts.mobile_tabs')

    {{-- Livewire Notifications --}}
    @livewire('notifications')

    {{-- Cookie Consent Management Script --}}
    @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const consentBanner = document.getElementById('cookie-consent');
            const acceptButton = document.getElementById('accept-cookies');
            const declineButton = document.getElementById('decline-cookies');

            const cookieConsent = localStorage.getItem('cookie-consent');
            if (!cookieConsent) {
                setTimeout(() => {
                    consentBanner.classList.remove('hidden');
                }, 1000);
            }

            acceptButton.addEventListener('click', function() {
                localStorage.setItem('cookie-consent', 'accepted');
                consentBanner.classList.add('hidden');
                if (typeof gtag !== 'undefined') {
                    gtag('consent', 'update', {
                        'analytics_storage': 'granted'
                    });
                }
            });

            declineButton.addEventListener('click', function() {
                localStorage.setItem('cookie-consent', 'declined');
                consentBanner.classList.add('hidden');
                if (typeof gtag !== 'undefined') {
                    gtag('consent', 'update', {
                        'analytics_storage': 'denied',
                        'ad_storage': 'denied'
                    });
                }
            });
        });
        </script>
    @endpush

</x-layouts.main>
