<?php

declare(strict_types=1);

use function Laravel\Folio\name;
use function Laravel\Folio\middleware;
use Livewire\Volt\Component;
use Modules\Predict\Models\Predict;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('predicts.detail');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $slug = '';

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }
};
?>

<x-layouts.app
    title="Mercato"
    meta-description="Dettagli mercato di predizione"
>
    @volt('predicts.detail')
    <div class="min-h-screen bg-slate-950">
        {{--
            Predict Detail Page
            Usa ViewPredictWidget per mostrare tutti i dettagli
        --}}
        @livewire(\Modules\Predict\Filament\Widgets\ViewPredictWidget::class, [
            'slug' => $this->slug,
        ])
    </div>
    @endvolt
</x-layouts.app>
