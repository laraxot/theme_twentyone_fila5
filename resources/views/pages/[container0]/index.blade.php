<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.list');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        $this->pageSlug = $container0 . '.index';
        $this->data = [
            'container0' => $container0
        ];
    }
};
?>

@php
    $pageTitle = match ($container0) {
        'predicts' => 'Mercati di Predizione',
        default => ucfirst(str_replace('-', ' ', $container0)),
    };

    $pageMetaDescription = match ($container0) {
        'predicts' => 'Esplora i mercati di predizione attivi, con probabilita, volume e accesso diretto ai dettagli.',
        default => 'Pagina pubblica '.$pageTitle,
    };
@endphp

<x-layouts.app :title="$pageTitle" :meta-description="$pageMetaDescription">
    @volt('container0.list')
    {{--
        CRITICAL: Zen Naked Page Philosophy
        - NO styling hardcoded in [container0]/index.blade.php
        - Layout app.blade.php già ha bg-slate-950 (dark theme)
        - Questo div è SOLO wrapper semantico (NO styling)
        - Styling va nei components CMS (x-page, blocks)
        - Permette full-width cinematic sections e spacing personalizzato per blocco

        DOCS:
        - docs/ZEN_NAKED_PAGE_PHILOSOPHY.md
    --}}
    <div>
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-layouts.app>
