<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.detail');
middleware(PageSlugMiddleware::class);

$container0 = request()->route('container0');
$slug0 = request()->route('slug0');

$predict = null;
$pageTitle = 'Mercato non trovato';
$pageMetaDescription = '';

if ($container0 === 'predicts' && $slug0) {
    $predict = \Modules\Predict\Models\Predict::query()
        ->where('slug', $slug0)
        ->first();

    if ($predict) {
        $title = $predict->title;
        $pageTitle = is_array($title)
            ? ($title[app()->getLocale()] ?? $title['it'] ?? $title['en'] ?? 'Mercato')
            : ($title ?? 'Mercato');

        $desc = $predict->description;
        $pageMetaDescription = is_array($desc)
            ? ($desc[app()->getLocale()] ?? $desc['it'] ?? $desc['en'] ?? '')
            : ($desc ?? '');
    }
}
?>

<x-layouts.app
    :title="$pageTitle"
    :meta-description="$pageMetaDescription"
>
    <div>
        @if($predict instanceof \Modules\Predict\Models\Predict)
            @livewire(\Modules\Predict\Filament\Widgets\ViewPredictWidget::class, [
                'predict' => $predict,
            ])
        @else
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
</x-layouts.app>
