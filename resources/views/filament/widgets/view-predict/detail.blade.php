<?php

use Modules\Predict\Models\Predict;

$record = $getRecord();
if (!$record instanceof Predict) {
    return '';
}

$card = app(\Modules\Predict\Actions\Frontoffice\ResolvePredictCardDataAction::class)->execute($record);

$visibleOptions = collect($card['options'])->values();
$outcomesCount = $visibleOptions->count();
$marketShapeLabel = $outcomesCount > 2 ? 'Multi-esito' : 'Binario';

$statusClasses = match($card['status_tone']) {
    'active' => 'border-emerald-400/30 bg-emerald-500/12 text-emerald-400',
    'open' => 'border-blue-400/30 bg-blue-500/12 text-blue-400',
    'published' => 'border-purple-400/30 bg-purple-500/12 text-purple-400',
    default => 'border-slate-400/30 bg-slate-500/18 text-slate-300',
};
?>

{{-- Skip Link for Accessibility --}}
<a href="#predict-main-content" class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-slate-900 focus:text-white focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
    Salta al contenuto principale
</a>

<article class="predict-detail-kinetic" aria-labelledby="predict-title">
    <header class="mb-6">
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold uppercase tracking-wider {{ $statusClasses }}" role="status">
                {{ $card['status_label'] }}
            </span>
            @if($card['category_title'])
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/6 px-3 py-1 text-xs font-medium uppercase tracking-wider text-slate-200">
                    {{ $card['category_title'] }}
                </span>
            @endif
        </div>

        {{-- H1 for SEO & Accessibility --}}
        <h1 id="predict-title" class="text-3xl sm:text-4xl font-black text-white leading-tight">
            {{ $card['title'] ?: 'Mercato in aggiornamento' }}
        </h1>
        
        {{-- Meta info --}}
        <p class="mt-2 text-slate-400 text-sm">
            <time datetime="{{ $record->resolution_at?->format('Y-m-d') ?? '' }}">
                Risoluzione: {{ $record->resolution_at?->format('d/m/Y') ?? 'Da definire' }}
            </time>
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <main id="predict-main-content" class="lg:col-span-2 space-y-6">
            {{-- Outcomes Section --}}
            <section aria-labelledby="outcomes-heading">
                <h2 id="outcomes-heading" class="sr-only">Esiti Disponibili</h2>
                
                @foreach($visibleOptions as $index => $option)
                    @php
                        $optionTitle = is_string($option['title'] ?? null) ? $option['title'] : 'Opzione';
                        $optionImage = is_string($option['image_url'] ?? null) && $option['image_url'] !== ''
                            ? $option['image_url']
                            : 'https://source.unsplash.com/800x450/?'.urlencode($optionTitle);
                        $percentage = isset($option['percentage']) ? (float) $option['percentage'] : 0.0;
                    @endphp
                    <div class="mb-4">
                        <a href="{{ $card['detail_url'] }}?option={{ $index }}"
                           class="block overflow-hidden rounded-2xl border border-white/10 bg-white/5 transition-all duration-300 hover:border-white/20 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950"
                           aria-label="Vedi dettagli per {{ $optionTitle }} - Probabilità {{ number_format($percentage, 1) }}%"
                        >
                            <div class="relative aspect-video">
                                <img src="{{ $optionImage }}" alt="{{ $optionTitle }}" class="h-full w-full object-cover" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                                    <span class="text-xl font-bold text-white">{{ $optionTitle }}</span>
                                    <span class="rounded-full bg-slate-950/80 px-4 py-2 text-2xl font-bold text-white" aria-label="Probabilità {{ number_format($percentage, 1) }} percento">
                                        {{ number_format($percentage, 1) }}%
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </section>
            
            {{-- Trading Form Section --}}
            <section aria-labelledby="trading-heading">
                <h2 id="trading-heading" class="sr-only">Piazza Ordine</h2>
                <x-predict.trading-form :predict="$record" />
            </section>
        </main>

        {{-- Sidebar --}}
        <aside class="lg:col-span-1" aria-label="Statistiche del mercato">
            <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-6 sticky top-6">
                <h3 class="mb-4 text-lg font-bold text-white flex items-center gap-2">
                    <x-heroicon-o-chart-pie class="w-5 h-5 text-blue-500" />
                    Statistiche
                </h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-slate-400">Volume</dt>
                        <dd class="font-semibold text-white">{{ number_format($card['volume'], 0, ',', '.') }} Credits</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-400">Trader</dt>
                        <dd class="font-semibold text-white">{{ number_format($card['participants']) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-400">Tipologia</dt>
                        <dd class="font-semibold text-white">{{ $marketShapeLabel }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-400">Opzioni</dt>
                        <dd class="font-semibold text-white">{{ $outcomesCount }}</dd>
                    </div>
                </dl>
            </div>
        </aside>
    </div>
</article>
