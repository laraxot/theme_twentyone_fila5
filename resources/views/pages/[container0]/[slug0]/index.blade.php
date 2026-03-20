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
    <div class="min-h-screen bg-gray-50 dark:bg-slate-900">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-6 px-4 py-8 lg:grid-cols-12 lg:px-6">
            <div class="lg:col-span-8">
                <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
            </div>
            <aside class="lg:col-span-4">
                <div class="lg:sticky lg:top-6">
                    <x-page side="sidebar" :slug="$this->pageSlug" :data="$this->data" />
                </div>
            </aside>
        </div>
    </div>
    @endvolt
</x-layouts.app>
