@props([
	'title' => config('app.name'),
	'metaDescription' => 'Prevedi il Futuro, Guadagna Crediti',
	// Folio parameters (ignored but accepted to prevent errors)
	'fallbackPlaceholder' => null,
	'container0' => null,
	'slug0' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ $title }}</title>
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

		<!-- Theme Color -->
		<meta name="theme-color" content="#10b981">

		<!-- Favicon -->
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

		<!-- Content Security Policy -->
		<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://www.googletagmanager.com https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://fonts.googleapis.com; img-src 'self' data: https:; connect-src 'self' https://www.google-analytics.com; frame-ancestors 'none';">

		<!-- Structured Data -->
		<script type="application/ld+json">
		{
			"@@context": "https://schema.org",
			"@type": "WebSite",
			"name": "Predict",
			"url": "{{ url('/') }}",
			"description": "{{ $metaDescription }}",
			"publisher": {
				"@type": "Organization",
				"name": "Predict",
				"url": "{{ url('/') }}",
				"logo": {
					"@type": "ImageObject",
					"url": "{{ asset('images/logo.png') }}"
				}
			},
			"potentialAction": {
				"@type": "SearchAction",
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

		{{-- GSAP for Cinematic Animations --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

		@stack('head')
		{{--
		{{ $_theme->metatags() }}
		--}}
		{{-- <meta charset="utf-8">
		<meta name="application-name" content="{{ config('app.name') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name') }}</title>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet"> --}}

		<style>
			[x-cloak] {
				display: none !important;
			}
			@media (prefers-reduced-motion: reduce) {
				*, *::before, *::after {
					animation-duration: 0.01ms !important;
					animation-iteration-count: 1 !important;
					transition-duration: 0.01ms !important;
					scroll-behavior: auto !important;
				}
			}
			/* Focus Indicators - WCAG 2.2 AA Compliance */
			*:focus-visible {
				outline: 3px solid #059669 !important; /* emerald-600 */
				outline-offset: 2px !important;
				border-radius: 4px !important;
			}
			/* Enhanced focus for buttons and interactive elements */
			button:focus-visible,
			a:focus-visible,
			input:focus-visible,
			select:focus-visible,
			textarea:focus-visible,
			[tabindex]:focus-visible {
				outline: 3px solid #059669 !important;
				outline-offset: 3px !important;
				box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.3) !important;
			}
			/* Touch Targets - Minimum 44x44px (WCAG 2.2) */
			button,
			a.btn,
			[role="button"],
			input[type="button"],
			input[type="submit"],
			input[type="checkbox"],
			input[type="radio"] {
				min-width: 44px !important;
				min-height: 44px !important;
			}
			/* Exception for small inline elements */
			a:not(.btn):not([role="button"]) {
				min-height: auto !important;
			}
			/* Scroll Reveal Animations */
			@keyframes fadeInUp {
				from {
					opacity: 0;
					transform: translateY(20px);
				}
				to {
					opacity: 1;
					transform: translateY(0);
				}
			}
			@keyframes fadeIn {
				from { opacity: 0; }
				to { opacity: 1; }
			}
			@keyframes slideInRight {
				from {
					opacity: 0;
					transform: translateX(20px);
				}
				to {
					opacity: 1;
					transform: translateX(0);
				}
			}
			/* Kinetic Design - Blob Animations */
			@keyframes blob {
				0%, 100% { transform: translate(0, 0) scale(1); }
				33% { transform: translate(30px, -50px) scale(1.1); }
				66% { transform: translate(-20px, 20px) scale(0.9); }
			}
			@keyframes float {
				0%, 100% { transform: translateY(0px); }
				50% { transform: translateY(-20px); }
			}
			@keyframes shimmer {
				0% { background-position: 200% 0; }
				100% { background-position: -200% 0; }
			}
			/* Micro-interactions - Card Hover Effects */
			.predict-card {
				transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			}
			.predict-card:hover {
				transform: translateY(-4px) scale(1.02);
				box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
				border-color: rgba(52, 211, 153, 0.5);
			}
			.predict-card:active {
				transform: translateY(-2px) scale(0.98);
			}
			/* Button Active States */
			.btn:active {
				transform: scale(0.95);
			}
			/* Loading Skeleton */
			.skeleton-loader {
				background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
				background-size: 200% 100%;
				animation: shimmer 1.5s infinite;
			}
			@keyframes slideInLeft {
				from {
					opacity: 0;
					transform: translateX(-20px);
				}
				to {
					opacity: 1;
					transform: translateX(0);
				}
			}
			@keyframes scaleIn {
				from {
					opacity: 0;
					transform: scale(0.95);
				}
				to {
					opacity: 1;
					transform: scale(1);
				}
			}
			/* Utility classes for scroll reveal */
			.animate-fade-in-up {
				animation: fadeInUp 0.5s ease-out forwards;
			}
			.animate-fade-in {
				animation: fadeIn 0.4s ease-out forwards;
			}
			.animate-slide-in-right {
				animation: slideInRight 0.5s ease-out forwards;
			}
			.animate-slide-in-left {
				animation: slideInLeft 0.5s ease-out forwards;
			}
			.animate-scale-in {
				animation: scaleIn 0.4s ease-out forwards;
			}
			/* Staggered animation delays */
			.delay-100 { animation-delay: 100ms; }
			.delay-200 { animation-delay: 200ms; }
			.delay-300 { animation-delay: 300ms; }
			.delay-400 { animation-delay: 400ms; }
			.delay-500 { animation-delay: 500ms; }
			/* Page Transitions */
			.page-enter {
				opacity: 0;
			}
			.page-enter-active {
				opacity: 1;
				transition: opacity 0.3s ease-out;
			}
			.page-leave {
				opacity: 1;
			}
			.page-leave-active {
				opacity: 0;
				transition: opacity 0.2s ease-in;
			}
			/* Skeleton shimmer effect */
			@keyframes shimmer {
				0% { background-position: -200% 0; }
				100% { background-position: 200% 0; }
			}
			.skeleton-shimmer {
				background: linear-gradient(
					90deg,
					#e5e7eb 0%,
					#f3f4f6 50%,
					#e5e7eb 100%
				);
				background-size: 200% 100%;
				animation: shimmer 1.5s infinite;
			}
			@media (prefers-reduced-motion: reduce) {
				.skeleton-shimmer {
					animation: none;
					background: #e5e7eb;
				}
			}
		</style>
		@filamentStyles

		@vite(['resources/css/app.css'],'themes/TwentyOne')

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


	</head>
		@php
			$skipToContent = __('predict::predict.labels.navigation.skip_to_content.label');
			$skipToContent = is_string($skipToContent) && $skipToContent !== 'predict::predict.labels.navigation.skip_to_content.label'
				? $skipToContent
				: 'Vai al contenuto principale';
		@endphp
		<body class="antialiased text-base leading-relaxed">
		{{-- Skip navigation (WCAG 2.2) --}}
		<a href="#main-content" class="absolute -left-[9999px] focus:left-4 focus:top-4 focus:z-[9999] px-4 py-2 bg-white text-gray-900 rounded-lg ring-2 ring-emerald-500 ring-offset-2 font-medium">
			{{ $skipToContent }}
		</a>

		<x-section slug="header" />

        <main id="main-content" role="main" tabindex="-1">
            {{ $slot }}
        </main>

        <!-- Cookie Consent Banner - GDPR Compliant -->
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

		<x-section slug="footer" />


		<!-- mobile tabs -->
		@include('pub_theme::layouts.mobile_tabs')



        @livewire('notifications')

		@filamentScripts
    	@vite(['resources/js/app.js'],'themes/TwentyOne')


        @yield('scripts')

        <!-- Cookie Consent Management Script -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const consentBanner = document.getElementById('cookie-consent');
            const acceptButton = document.getElementById('accept-cookies');
            const declineButton = document.getElementById('decline-cookies');

            // Check if user has already made a choice
            const cookieConsent = localStorage.getItem('cookie-consent');
            if (!cookieConsent) {
                // Show banner after page load
                setTimeout(() => {
                    consentBanner.classList.remove('hidden');
                }, 1000);
            }

            // Handle accept button
            acceptButton.addEventListener('click', function() {
                localStorage.setItem('cookie-consent', 'accepted');
                consentBanner.classList.add('hidden');

                // Enable GA4
                gtag('consent', 'update', {
                    'analytics_storage': 'granted'
                });

                // You can add more tracking consent updates here
            });

            // Handle decline button
            declineButton.addEventListener('click', function() {
                localStorage.setItem('cookie-consent', 'declined');
                consentBanner.classList.add('hidden');

                // Disable GA4
                gtag('consent', 'update', {
                    'analytics_storage': 'denied',
                    'ad_storage': 'denied'
                });
            });
        });
        </script>

    </body>
</html>
