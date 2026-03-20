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

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        $this->data = [
            'container0' => $container0,
            'slug' => $container0,
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
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
            <x-page side="content" :slug="$this->container0" :data="$this->data" />
        </div>
    </div>
    @endvolt
</x-layouts.app>
