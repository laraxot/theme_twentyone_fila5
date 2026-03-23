{{--
|--------------------------------------------------------------------------
| Main Layout - Base Layout Component
|--------------------------------------------------------------------------
|
| Layout base per il tema TwentyOne.
| Questo componente fornisce la struttura HTML fondamentale
| e viene esteso da altri layout specifici (app.blade.php, auth.blade.php, etc.)
|
| Architecture:
| - Questo file = struttura HTML base (head, body, main)
| - app.blade.php = estende main + aggiunge meta, SEO, analytics, navigation
| - Philosophy: composizione > duplicazione
|
| Usage:
|   <x-layouts.main title="Page Title">
|       <h1>Content</h1>
|   </x-layouts.main>
|
| Docs: docs/HOMEPAGE_LAYOUT_ARCHITECTURE.md
|
--}}

@props([
    'title' => config('app.name'),
    'metaDescription' => '',
    'bodyClass' => '',
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        @if($metaDescription)
            <meta name="description" content="{{ $metaDescription }}">
        @endif

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Theme Color -->
        <meta name="theme-color" content="#10b981">

        <!-- Preconnect -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- GSAP for Cinematic Animations (loaded in head for performance) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

        @stack('head')

        <!-- Vite + Tailwind CSS v4 -->
        @vite(['resources/css/app.css'], 'themes/TwentyOne')

        <!-- Filament & Livewire -->
        @filamentStyles
        @livewireStyles
    </head>

    <body class="{{ $bodyClass }} antialiased text-base leading-relaxed bg-slate-950 text-slate-100">
        <!-- Skip to Content (WCAG 2.2 AA) -->
        @php
            $skipToContent = __('predict::predict.labels.navigation.skip_to_content.label');
            $skipToContent = is_string($skipToContent) && $skipToContent !== 'predict::predict.labels.navigation.skip_to_content.label'
                ? $skipToContent
                : 'Vai al contenuto principale';
        @endphp
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:text-slate-900 focus:rounded-lg focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950">
            {{ $skipToContent }}
        </a>

        <!-- Main Content -->
        <main id="main-content" role="main" tabindex="-1">
            {{ $slot }}
        </main>

        <!-- Scripts -->
        @vite(['resources/js/app.js'], 'themes/TwentyOne')

        @filamentScripts
        @livewireScripts

        @stack('scripts')

        {{-- Cookie Consent Banner - GDPR Compliant --}}
        {{-- Moved from inline to JS file (app.js) for separation of concerns --}}
        {{-- Philosophy: JavaScript inline → app.js, come CSS → app.css --}}
        {{-- Docs: docs/project/LAYOUT_ARCHITECTURE_PHILOSOPHY.md --}}
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
    </body>
</html>
