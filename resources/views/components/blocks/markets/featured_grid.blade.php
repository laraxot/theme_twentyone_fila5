@props([
    'title' => null,
    'subtitle' => null,
    'show_all_link' => null,
    'limit' => 20,
])

@php
    $section = app(\Themes\TwentyOne\Actions\Markets\ResolveFeaturedMarketsGridDataAction::class)
        ->execute($title, $subtitle, $show_all_link, (int) $limit);
    $particlesColor = 'rgba(125,211,252,0.28)';
@endphp

<section class="antigravity-field relative overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-sky-950 py-16 md:py-20">
    <x-ui.particles count="36" :color="$particlesColor" size="2px" zIndex="0" variant="antigravity" />
    <div class="antigravity-spotlight" aria-hidden="true"></div>
    <div class="antigravity-orb antigravity-orb-1" aria-hidden="true"></div>
    <div class="antigravity-orb antigravity-orb-2" aria-hidden="true"></div>
    <div class="antigravity-orb antigravity-orb-3" aria-hidden="true"></div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto mb-10 max-w-3xl text-center md:mb-12">
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-sky-400/20 bg-sky-500/10 px-4 py-2 text-sm font-semibold text-sky-200">
                <x-filament::icon icon="heroicon-o-presentation-chart-bar" class="h-4 w-4" />
                <span>{{ $section['cards']->count() }} {{ $section['activeMarketsLabel'] }}</span>
            </div>

            <h2 class="text-3xl font-black tracking-tight text-white md:text-5xl">
                {{ $section['title'] }}
            </h2>

            <p class="mt-4 text-base leading-7 text-slate-300 md:text-lg">
                {{ $section['subtitle'] }}
            </p>

            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-sm text-slate-300">
                <span class="inline-flex items-center gap-2 rounded-full border border-fuchsia-300/20 bg-fuchsia-400/10 px-3 py-1.5">
                    <x-filament::icon icon="heroicon-o-squares-2x2" class="h-4 w-4 text-fuchsia-200" />
                    <span>{{ $section['multiOutcomeLabel'] }}</span>
                </span>
                <span class="inline-flex items-center gap-2 rounded-full border border-sky-300/20 bg-sky-400/10 px-3 py-1.5">
                    <x-filament::icon icon="heroicon-o-photo" class="h-4 w-4 text-sky-100" />
                    <span>{{ $section['visualOptionsLabel'] }}</span>
                </span>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5">
                    <x-filament::icon icon="heroicon-o-bolt" class="h-4 w-4 text-amber-300" />
                    <span>{{ $section['freshnessLabel'] }}</span>
                </span>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5">
                    <x-filament::icon icon="heroicon-o-academic-cap" class="h-4 w-4 text-emerald-300" />
                    <span>{{ $section['educationLabel'] }}</span>
                </span>
            </div>
        </div>

        @if($section['cards']->isEmpty())
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-10 text-center text-slate-300 shadow-2xl shadow-slate-950/20 backdrop-blur-sm md:p-14">
                <h3 class="text-2xl font-bold text-white">{{ $section['emptyStateTitle'] }}</h3>
                <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-400 md:text-base">{{ $section['emptyStateBody'] }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5" role="list">
                @foreach($section['cards'] as $card)
                    @php
                        $detailUrl = $card['url'] ?? '#';
                        $leadColor = $card['outcomes'][0]['color'] ?? '#38bdf8';
                    @endphp

                    <article class="group relative overflow-hidden rounded-[2rem] border border-white/12 bg-white/6 shadow-[0_24px_80px_rgba(2,6,23,0.32)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:border-sky-300/30 hover:bg-white/10">
                        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(56,189,248,0.16),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(14,165,233,0.12),transparent_34%)]"></div>
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-sky-300/45 to-transparent"></div>

                        <div class="relative p-5">
                            <div class="mb-4 flex items-start justify-between gap-3">
                                <div class="space-y-3">
                                    @if($card['category'])
                                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/8 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-sky-100">
                                            {{ $card['category'] }}
                                        </span>
                                    @endif

                                    <h3 class="text-lg font-black leading-tight tracking-tight text-white">
                                        <a href="{{ $detailUrl }}" class="transition hover:text-sky-200 focus:outline-none focus:underline">
                                            {{ $card['title'] }}
                                        </a>
                                    </h3>
                                </div>

                                <a href="{{ $detailUrl }}" class="hidden shrink-0 rounded-full border border-sky-300/25 bg-sky-400/12 px-3 py-2 text-xs font-semibold text-white md:inline-flex md:items-center md:gap-2">
                                    <span>{{ $section['openMarketLabel'] }}</span>
                                    <x-filament::icon icon="heroicon-o-arrow-up-right" class="h-4 w-4" />
                                </a>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                @foreach(array_slice($card['outcomes'], 0, 4) as $outcome)
                                    <a href="{{ $detailUrl }}" class="group/option relative overflow-hidden rounded-[1.25rem] border border-white/10 bg-slate-950/45 transition duration-300 hover:border-white/20 hover:-translate-y-0.5">
                                        <span class="relative block aspect-[4/3] overflow-hidden bg-slate-900">
                                            @if(!empty($outcome['image_url']))
                                                <img src="{{ $outcome['image_url'] }}" alt="{{ $outcome['title'] }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover/option:scale-105">
                                            @else
                                                <span class="flex h-full items-center justify-center bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900">
                                                    <x-filament::icon icon="heroicon-o-photo" class="h-10 w-10 text-slate-400" />
                                                </span>
                                            @endif

                                            <span class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></span>
                                            <span class="absolute right-3 top-3 rounded-full border border-white/15 bg-slate-950/70 px-2.5 py-1 text-xs font-bold text-white backdrop-blur">
                                                {{ number_format((float) ($outcome['percentage'] ?? 0), 1) }}%
                                            </span>
                                            <span class="absolute inset-x-3 bottom-3 block h-2 overflow-hidden rounded-full bg-white/15">
                                                <span class="block h-full rounded-full" style="width: {{ max(3, min(100, (float) ($outcome['percentage'] ?? 0))) }}%; background: linear-gradient(90deg, {{ $leadColor }}, color-mix(in srgb, {{ $leadColor }} 55%, white));"></span>
                                            </span>
                                        </span>
                                        <span class="block px-3 pb-4 pt-3 text-sm font-semibold text-white">
                                            {{ $outcome['title'] }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>

                            @if(count($card['outcomes']) > 4)
                                <p class="mt-3 text-sm text-slate-300">
                                    +{{ count($card['outcomes']) - 4 }} altre opzioni disponibili
                                </p>
                            @endif

                            <div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-white/10 pt-4 text-sm text-slate-300">
                                <div class="flex flex-wrap items-center gap-4">
                                    <span>Volume <span class="font-semibold text-white">{{ number_format((float) ($card['volume'] ?? 0), 0, ',', '.') }}</span></span>
                                    <span>Partecipanti <span class="font-semibold text-white">{{ number_format((int) ($card['participants'] ?? 0), 0, ',', '.') }}</span></span>
                                </div>
                                @if(!empty($card['ends_at_human']))
                                    <span class="text-xs uppercase tracking-[0.18em] text-slate-400">{{ $card['ends_at_human'] }}</span>
                                @endif
                            </div>

                            <a href="{{ $detailUrl }}" class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-full border border-sky-300/25 bg-sky-400/12 px-4 py-3 text-sm font-semibold text-white md:hidden">
                                <span>{{ $section['openMarketLabel'] }}</span>
                                <x-filament::icon icon="heroicon-o-arrow-up-right" class="h-4 w-4" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <div class="mt-10 text-center md:mt-12">
            <a
                href="{{ $section['showAllLink'] }}"
                class="btn-kinetic inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/8 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/14 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:ring-offset-2 focus:ring-offset-slate-950"
            >
                <span>{{ $section['showAllLabel'] }}</span>
                <x-filament::icon icon="heroicon-o-arrow-up-right" class="h-4 w-4" />
            </a>
        </div>
    </div>
</section>
