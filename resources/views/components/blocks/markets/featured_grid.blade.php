@props([
    'title' => null,
    'subtitle' => null,
    'show_all_link' => null,
    'limit' => 12,
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

        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-4 shadow-2xl shadow-slate-950/20 backdrop-blur-sm md:p-6">
            <div class="filament-table-widget">
                @livewire(\Modules\Predict\Filament\Widgets\PredictTableWidget::class, ['minimumOutcomes' => 4, 'homepageMode' => true], key('homepage-featured-markets-table'))
            </div>
        </div>

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
