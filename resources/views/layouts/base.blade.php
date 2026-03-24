<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')


            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        @filamentStyles
        {{--
        @vite(['resources/sass/app.scss'],'themes/TwentyOne/dist')
        --}}
        @vite(['resources/css/app.css'], 'themes/TwentyOne')
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        {{-- Skip Navigation Link for Accessibility (WCAG 2.2) --}}
        <a href="#main-content" 
           class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-emerald-600 focus:text-white focus:rounded-lg focus:font-semibold focus:outline-none focus:ring-2 focus:ring-white">
            {{ __('Skip to main content') }}
        </a>
        
        @yield('body')

        @livewire('notifications')

        @filamentScripts
        @vite(['resources/js/app.js'], 'themes/TwentyOne')
    </body>
</html>
