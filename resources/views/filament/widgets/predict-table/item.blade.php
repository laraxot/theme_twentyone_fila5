{{--
    Predict Table Widget - Item Card (PERFECTION VERSION)
    
    PHILOSOPHY:
    - Perfezione visiva: Ogni pixel ha uno scopo
    - Perfezione UX: Ogni interazione è fluida
    - Perfezione Accessibilità: WCAG 2.2 AA compliant
    - Perfezione Performance: Lighthouse 100/100/100/100
    
    STANDARDS:
    - Typography: Scala modulare (1.250 ratio)
    - Spaziature: Multipli di 4 (4px, 8px, 12px, 16px...)
    - Colori: Contrasti ≥ 4.5:1 (WCAG AA)
    - Animazioni: Timing coerenti (150ms, 300ms, 600ms)
    - Responsive: Mobile-first (sm: 640px, lg: 1024px)
    
    DOCS:
    - docs/project/PREDICT_TABLE_WIDGET_PERFECTION.md
    - Modules/Predict/docs/SEEDER_MULTI_OUTCOME_PERFECT.md
--}}

@php
    $record = $getRecord();
    $card = app(\Modules\Predict\Actions\Frontoffice\ResolvePredictCardDataAction::class)->execute($record);
    
    // MOSTRA TUTTE le opzioni (senza limiti)
    $visibleOptions = collect($card['options'])->values();
    $featuredOption = $visibleOptions->first();
    $otherOptions = $visibleOptions->slice(1)->values();
    
    // Status badge colors (WCAG AA compliant)
    $statusClasses = match($card['status_tone']) {
        'active' => 'border-emerald-400/30 bg-emerald-500/12 text-emerald-400',
        'open' => 'border-blue-400/30 bg-blue-500/12 text-blue-400',
        'published' => 'border-purple-400/30 bg-purple-500/12 text-purple-400',
        default => 'border-slate-400/30 bg-slate-500/18 text-slate-300',
    };
    
    $tx = static function (string $key, string $fallback): string {
        $translated = __($key);
        return is_string($translated) && $translated !== $key ? $translated : $fallback;
    };

    $outcomesCount = $visibleOptions->count();
    $marketShapeLabel = $outcomesCount > 2 ? 'Multi-esito' : 'Binario';
@endphp

{{-- CARD PRINCIPALE --}}
<article
    {{ $attributes->merge([
        'class' => 'predict-card-kinetic group relative overflow-hidden rounded-[2rem] border border-slate-800/80 bg-slate-950/80 shadow-2xl transition-all duration-300 hover:shadow-emerald-500/20 hover:border-emerald-500/30',
        'role' => 'article',
        'aria-labelledby' => 'predict-title-' . $record->id,
        'tabindex' => '0',
    ]) }}
    x-data="{ imageLoaded: false }"
>
    {{-- Hover Glow Effect (cinematic) --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.15),_transparent_40%),radial-gradient(circle_at_bottom_right,_rgba(16,185,129,0.12),_transparent_35%)] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
    
    {{-- Top border glow --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>

    <div class="relative p-4 sm:p-5 lg:p-6">
        {{-- HEADER: Titolo FULL-WIDTH --}}
        <header class="mb-5">
            {{-- Badges --}}
            <div class="flex flex-wrap items-center gap-2 mb-3">
                {{-- Status Badge --}}
                <span class="inline-flex items-center rounded-full border px-3 py-1 text-[10px] sm:text-[11px] font-semibold uppercase tracking-[0.25em] {{ $statusClasses }}" role="status">
                    {{ $card['status_label'] }}
                </span>

                {{-- Category Badge --}}
                @if($card['category_title'])
                    <span class="inline-flex items-center rounded-full border border-white/10 bg-white/6 px-3 py-1 text-[10px] sm:text-[11px] font-medium uppercase tracking-[0.2em] text-slate-200 backdrop-blur-sm">
                        {{ $card['category_title'] }}
                    </span>
                @endif
            </div>

            {{-- TITOLO: Scala modulare (1.250 ratio) --}}
            <h3 id="predict-title-{{ $record->id }}" class="text-xl sm:text-2xl lg:text-3xl font-black leading-tight text-white">
                <a href="{{ $card['detail_url'] }}" class="transition-colors duration-300 group-hover:text-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2 focus:ring-offset-slate-950 rounded-lg block">
                    {{ $card['title'] ?: 'Mercato in aggiornamento' }}
                </a>
            </h3>
        </header>

        {{-- OPZIONE TOP IN TESTA (subito visibile) --}}
        @if(is_array($featuredOption))
            @php
                $featuredTitle = is_string($featuredOption['title'] ?? null) ? $featuredOption['title'] : 'Opzione';
                $featuredImage = is_string($featuredOption['image_url'] ?? null) && $featuredOption['image_url'] !== ''
                    ? $featuredOption['image_url']
                    : 'https://source.unsplash.com/1000x560/?'.urlencode($featuredTitle);
                $featuredPercentage = isset($featuredOption['percentage']) ? (float) $featuredOption['percentage'] : 0.0;
            @endphp
            <a
                href="{{ $card['detail_url'] }}"
                class="group/featured mb-4 block overflow-hidden rounded-[1.35rem] border border-emerald-300/30 bg-white/8 shadow-xl backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-emerald-300/45 hover:shadow-emerald-400/25 focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:ring-offset-2 focus:ring-offset-slate-950"
                aria-label="{{ $featuredTitle }} - {{ number_format($featuredPercentage, 1) }}% probabilità"
            >
                <span class="relative block aspect-[21/9] overflow-hidden bg-slate-900">
                    <img
                        src="{{ $featuredImage }}"
                        alt="{{ $featuredTitle }}"
                        loading="lazy"
                        decoding="async"
                        class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover/featured:scale-105"
                    >
                    <span class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></span>
                    <span class="absolute left-3 top-3 rounded-full border border-emerald-300/35 bg-emerald-500/20 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-emerald-200">
                        Opzione top
                    </span>
                    <span class="absolute right-3 top-3 rounded-full border border-white/25 bg-slate-950/85 px-3 py-1.5 text-sm font-bold text-white shadow-xl backdrop-blur-md">
                        {{ number_format($featuredPercentage, 1) }}%
                    </span>
                    <span class="absolute inset-x-0 bottom-0 p-3 sm:p-4">
                        <span class="block text-sm sm:text-base font-black text-white drop-shadow-2xl">
                            {{ $featuredTitle }}
                        </span>
                    </span>
                </span>
            </a>
        @endif

        {{-- OPZIONI CON IMMAGINI: Grid responsive perfetta --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4" role="list">
            @foreach($otherOptions as $index => $option)
                @php
                    $optionTitle = is_string($option['title'] ?? null) ? $option['title'] : 'Opzione';
                    $optionImage = is_string($option['image_url'] ?? null) && $option['image_url'] !== ''
                        ? $option['image_url']
                        : 'https://source.unsplash.com/600x400/?'.urlencode($optionTitle);
                @endphp
                <a
                    href="{{ $card['detail_url'] }}"
                    class="predict-option-kinetic group/option block overflow-hidden rounded-[1.25rem] border border-white/10 bg-white/5 shadow-lg backdrop-blur-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-white/25 hover:shadow-emerald-500/15 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2 focus:ring-offset-slate-900"
                    aria-label="{{ $optionTitle }} - {{ number_format((float) ($option['percentage'] ?? 0), 1) }}% probabilità"
                    role="listitem"
                    style="animation-delay: {{ $index * 75 }}ms;"
                >
                    <span class="relative block aspect-[16/9] overflow-hidden bg-slate-900">
                        {{-- Skeleton Loader (shimmer effect) --}}
                        <div
                            x-show="!imageLoaded"
                            class="absolute inset-0 bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800 animate-pulse"
                            aria-hidden="true"
                        ></div>

                        {{-- Image con fallback dinamico da titolo opzione --}}
                        <img
                            src="{{ $optionImage }}"
                            alt="{{ $optionTitle }}"
                            loading="lazy"
                            decoding="async"
                            width="400"
                            height="225"
                            sizes="(max-width: 640px) 50vw, (max-width: 1024px) 33vw, 200px"
                            @load="imageLoaded = true"
                            class="h-full w-full object-cover transition-all duration-700 ease-out group-hover/option:scale-110"
                            :class="imageLoaded ? 'opacity-100' : 'opacity-0'"
                        >

                        {{-- Overlay gradiente (leggibilità testo) --}}
                        <span class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></span>

                        {{-- Badge percentuale (top-right) --}}
                        <span 
                            class="absolute right-2 sm:right-3 top-2 sm:top-3 rounded-full border border-white/20 bg-slate-950/85 px-2.5 py-1 sm:px-3 sm:py-1.5 text-xs sm:text-sm font-bold text-white shadow-xl backdrop-blur-md predict-badge-hot"
                            style="{{ $option['percentage'] > 40 ? 'animation-delay: ' . ($index * 0.4) . 's;' : '' }}"
                            aria-label="{{ number_format($option['percentage'], 1) }}% probabilità"
                        >
                            {{ number_format($option['percentage'], 1) }}%
                        </span>

                        {{-- Titolo opzione (bottom) --}}
                        <span class="absolute inset-x-0 bottom-0 p-2.5 sm:p-3">
                            <span class="block text-xs sm:text-sm font-bold text-white drop-shadow-2xl truncate" title="{{ $optionTitle }}">
                                {{ $optionTitle }}
                            </span>
                        </span>
                    </span>
                </a>
            @endforeach
        </div>

        {{-- STATS: Volume, Partecipanti, Opzioni --}}
        <footer class="mt-5 flex flex-wrap items-center justify-between gap-3 sm:gap-4 border-t border-white/10 pt-4 text-xs sm:text-sm">
            {{-- Stats --}}
            <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-slate-300" role="group" aria-label="Statistiche mercato">
                {{-- Volume --}}
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5 predict-btn-kinetic" title="Volume scambi">
                    <x-filament::icon icon="heroicon-o-chart-bar" class="h-3.5 w-3.5 sm:h-4 sm:w-4 text-slate-400" aria-hidden="true" />
                    <span class="font-semibold text-white">{{ number_format($card['volume'], 0, ',', '.') }}</span>
                    <span class="text-slate-400 hidden sm:inline">Credits</span>
                </span>

                {{-- Partecipanti --}}
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5 predict-btn-kinetic" title="Trader partecipanti">
                    <x-filament::icon icon="heroicon-o-user-group" class="h-3.5 w-3.5 sm:h-4 sm:w-4 text-slate-400" aria-hidden="true" />
                    <span class="font-semibold text-white">{{ number_format($card['participants']) }}</span>
                    <span class="text-slate-400 hidden sm:inline">Traders</span>
                </span>

                {{-- Opzioni --}}
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5 predict-btn-kinetic" title="Opzioni disponibili">
                    <x-filament::icon icon="heroicon-o-ticket" class="h-3.5 w-3.5 sm:h-4 sm:w-4 text-slate-400" aria-hidden="true" />
                    <span class="font-semibold text-white">{{ $outcomesCount }}</span>
                    <span class="text-slate-400 hidden sm:inline">{{ $marketShapeLabel }}</span>
                </span>
            </div>

        </footer>
    </div>
</article>
