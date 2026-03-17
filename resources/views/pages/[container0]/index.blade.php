<?php

declare(strict_types=1);

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.list');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0;
    public string $slug0 = '';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('container0.view')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Hero Section --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                @if($container0 === 'predicts')
                    {{ __('predict::predict_table.titles.prediction_markets.label') }}
                @else
                    {{ ucfirst($container0) }}
                @endif
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ __('predict::predict_table.descriptions.browse_markets.label') }}
            </p>
        </div>

        {{-- Filament Table Widget --}}
        @livewire(\Modules\Predict\Filament\Widgets\PredictTableWidget::class)
    </div>
    @endvolt
</x-layouts.app>
