<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;
use Modules\Predict\Models\Predict;

name('container0.detail');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $slug0 = '';

    public function mount(string $container0, string $slug0): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;
    }
};
?>

@php
    $predict = \Modules\Predict\Models\Predict::query()
        ->where('slug', $slug0)
        ->first();

    $pageTitle = $predict?->title ?? 'Mercato non trovato';
    if (is_array($pageTitle)) {
        $pageTitle = $pageTitle[app()->getLocale()] ?? $pageTitle['it'] ?? $pageTitle['en'] ?? 'Mercato';
    }

    $pageMetaDescription = $predict?->description ?? 'Dettagli mercato di predizione';
    if (is_array($pageMetaDescription)) {
        $pageMetaDescription = $pageMetaDescription[app()->getLocale()] ?? $pageMetaDescription['it'] ?? $pageMetaDescription['en'] ?? '';
    }
@endphp

<x-layouts.app
    :title="$pageTitle"
    :meta-description="$pageMetaDescription"
>
    @volt('container0.detail')
    {{--
        CRITICAL: Zen Naked Page Philosophy
        - NO styling hardcoded in [container0]/[slug0]/index.blade.php
        - Layout app.blade.php già ha bg-slate-950 (dark theme)
        - Questo div è SOLO wrapper semantico (NO styling)
        - Styling va nei components CMS o widgets

        DOCS:
        - docs/ZEN_NAKED_PAGE_PHILOSOPHY.md
    --}}
    <div>
        @if($predict instanceof \Modules\Predict\Models\Predict)
            {{--
                Predict Detail Widget
                - Mostra tutti i dettagli del mercato
                - Form per piazzare scommesse
                - Grafici e statistiche
            --}}
            @livewire(\Modules\Predict\Filament\Widgets\ViewPredictWidget::class, [
                'predict' => $predict,
            ])
        @else
            {{-- Empty State: Predict non trovato --}}
            <div class="min-h-[60vh] flex items-center justify-center">
                <div class="text-center p-8 rounded-3xl bg-slate-900/50 border border-slate-800 backdrop-blur-sm">
                    <x-filament::icon
                        icon="heroicon-o-exclamation-circle"
                        class="h-16 w-16 text-red-400 mx-auto mb-4"
                    />
                    <h2 class="text-2xl font-bold text-white mb-2">
                        @lang('predict::messages.predict_not_found', 'Mercato non trovato')
                    </h2>
                    <p class="text-slate-400 mb-6">
                        @lang('predict::messages.predict_not_found_description', 'Il mercato che stai cercando non esiste o è stato rimosso.')
                    </p>
                    <a
                        href="{{ url('/' . app()->getLocale() . '/predicts') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-sky-500 to-cyan-500 text-white font-semibold hover:from-sky-400 hover:to-cyan-400 transition-all duration-300 hover:scale-105"
                    >
                        <x-filament::icon icon="heroicon-o-arrow-left" class="h-5 w-5" />
                        @lang('predict::common.back_to_list', 'Torna alla lista')
                    </a>
                </div>
            </div>
        @endif
    </div>
    @endvolt
</x-layouts.app>
