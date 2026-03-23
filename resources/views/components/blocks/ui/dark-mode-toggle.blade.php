@props([
    'position' => 'header-right'
])

{{--
/**
 * Dark Mode Toggle - Premium UI/UX
 * 
 * Features:
 * - Smooth transition con animazione custom
 * - Icone sole/luna con rotate effect
 * - Tooltip accessibile
 * - Respect prefers-color-scheme
 * - Storage locale (localStorage)
 * - Coerente con tema globale
 * 
 * Architecture:
 * - Blade component (tema)
 * - JavaScript: dark-mode.js (gestisce logica)
 * - CSS: app.css (classi animate-*)
 * - JSON: header.json (configurazione posizione)
 */
--}}

<div 
    class="dark-mode-toggle-block"
    data-position="{{ $position }}"
>
    <button
        id="dark-mode-toggle"
        type="button"
        role="switch"
        aria-checked="false"
        aria-label="Cambia tema scuro/chiaro"
        title="Cambia tema (D)"
        class="
            group
            relative
            overflow-hidden
            p-2 
            rounded-xl
            bg-gradient-to-br from-slate-100 to-slate-200 
            dark:from-slate-800 dark:to-slate-700
            hover:from-amber-100 hover:to-orange-100
            dark:hover:from-indigo-900 dark:hover:to-slate-800
            transition-all
            duration-500
            ease-out
            shadow-sm
            hover:shadow-md
            hover:scale-105
            active:scale-95
            focus:outline-none
            focus:ring-2
            focus:ring-amber-500
            focus:ring-offset-2
            dark:focus:ring-offset-slate-900
        "
    >
        {{-- Icon Container con animazione rotate --}}
        <span class="relative block w-5 h-5">
            {{-- Sun Icon (visible in dark mode) --}}
            <span 
                data-icon="sun" 
                class="
                    absolute
                    inset-0
                    flex
                    items-center
                    justify-center
                    opacity-0
                    dark:opacity-100
                    transition-all
                    duration-500
                    ease-out
                    transform
                    rotate-90
                    dark:rotate-0
                    scale-75
                    dark:scale-100
                "
            >
                <x-filament::icon 
                    icon="heroicon-o-sun" 
                    class="
                        w-5 h-5 
                        text-amber-500 
                        drop-shadow-[0_0_8px_rgba(245,158,11,0.5)]
                        animate-kinetic-glow
                    " 
                />
            </span>
            
            {{-- Moon Icon (visible in light mode) --}}
            <span 
                data-icon="moon" 
                class="
                    absolute
                    inset-0
                    flex
                    items-center
                    justify-center
                    opacity-100
                    dark:opacity-0
                    transition-all
                    duration-500
                    ease-out
                    transform
                    rotate-0
                    dark:-rotate-90
                    scale-100
                    dark:scale-75
                "
            >
                <x-filament::icon 
                    icon="heroicon-o-moon" 
                    class="
                        w-5 h-5 
                        text-slate-600 
                        dark:text-indigo-400
                    " 
                />
            </span>
        </span>
        
        {{-- Glow effect on hover --}}
        <span 
            class="
                pointer-events-none
                absolute
                inset-0
                rounded-xl
                bg-gradient-to-r
                from-amber-500/0
                via-amber-500/10
                to-amber-500/0
                opacity-0
                group-hover:opacity-100
                transition-opacity
                duration-500
            "
        ></span>
    </button>
    
    {{-- Tooltip (opzionale, per accessibility) --}}
    <span 
        class="
            pointer-events-none
            absolute
            -bottom-10
            left-1/2
            -translate-x-1/2
            px-2
            py-1
            text-xs
            font-medium
            text-slate-600
            dark:text-slate-400
            bg-slate-900/90
            dark:bg-slate-100/90
            rounded-md
            opacity-0
            group-hover:opacity-100
            transition-opacity
            duration-300
            whitespace-nowrap
            z-50
        "
    >
        Tema Scuro
    </span>
</div>

{{-- 
    Dark Mode Toggle - Script removed
    Logic is now in Themes/TwentyOne/resources/js/dark-mode.js
    Imported automatically via @vite(['resources/js/app.js'])
    
    Architecture:
    - Blade = UI markup only
    - JS = Logic (dark-mode.js)
    - CSS = Styles (app.css)
    
    DOCS: docs/project/DARK_MODE_ARCHITECTURE.md
--}}