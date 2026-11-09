<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<x-cms::head />
	<body class="antialiased">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-gray-900 dark:focus:bg-gray-900 dark:focus:text-white">
            {{ __('pub_theme::ui.skip_to_content') }}
        </a>

		<x-section slug="header" />

        <main id="main-content" tabindex="-1">
        {{ $slot }}
        </main>
        
		<x-section slug="footer" />


		<!-- mobile tabs -->
		@include('pub_theme::layouts.mobile_tabs')


		
		<x-cms::foot />

    </body>
</html>
