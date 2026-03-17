<?php

declare(strict_types=1);

use Livewire\Volt\Component;
use Modules\Cms\Actions\ResolvePageAction;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('container0.slug.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $slug0 = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(ResolvePageAction $resolvePageAction, string $container0, string $slug): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug;

        $resolved = $resolvePageAction->execute($this->container0, $this->slug0);
        $this->pageSlug = $resolved->pageSlug;

        $this->data = [
            'container0' => $container0,
            'slug0' => $slug,
            'slug' => $slug,
            'record' => $resolved->item,
            'article' => $resolved->item,
        ];
    }
};
?>

<x-layouts.app>
    @volt('container0.slug.view')
    <div>
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-layouts.app>

