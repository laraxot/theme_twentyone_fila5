<?php

declare(strict_types=1);

use Livewire\Volt\Component;
use Modules\Cms\Actions\ResolvePageAction;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('container0.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = "";
    public string $slug0 = "";
    public string $pageSlug = "";

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(ResolvePageAction $resolvePageAction, string $container0, string $slug0): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;

        $resolved = $resolvePageAction->execute($this->container0, $this->slug0);
        $this->pageSlug = $resolved->pageSlug;

        $this->data = [
            "container0" => $container0,
            "slug0" => $slug0,
            "slug" => $slug0,
            "item" => $resolved->item,
        ];
    }
};
?>

<x-layouts.app>
    @volt("container0.view")
    {{--
        CRITICAL: Zen Architecture Philosophy
        - NO styling hardcoded in [container0]/[slug0]/index.blade.php
        - Layout app.blade.php già ha bg-gradient-to-br (dark theme)
        - Questo div è SOLO wrapper semantico per grid layout
        - Styling va nei components CMS (x-page, blocks)

        WHY:
        - [container0]/[slug0] è AGNOSTICO (gestisce predicts, blog, events, etc.)
        - NON deve imporre styling (violerebbe separation of concerns)
        - Grid layout va bene (è struttura, non styling)

        DOCS:
        - docs/project/CONTAINER_ARCHITECTURE_ZEN.md
        - docs/project/NO_HARDCODED_STYLING_IN_CONTAINER.md
    --}}
    <div class="grid grid-cols-1 gap-6 px-4 py-8 lg:grid-cols-12 lg:px-6">
        <div class="lg:col-span-8">
            <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
        </div>
        <aside class="lg:col-span-4">
            <div class="lg:sticky lg:top-6">
                <x-page side="sidebar" :slug="$this->pageSlug" :data="$this->data" />
            </div>
        </aside>
    </div>
    @endvolt
</x-layouts.app>
