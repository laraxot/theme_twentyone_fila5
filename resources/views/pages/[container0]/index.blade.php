<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;
use Modules\Cms\Models\Page as PageModel;

name('container0.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        // Le lingue supportate sono prefissi URL della home CMS (slug 'home'),
        // non container CMS '{locale}.index'.
        $locales = LaravelLocalization::getSupportedLanguagesKeys();
        $this->pageSlug = in_array($container0, is_array($locales) ? $locales : [], true)
            ? 'home'
            : $container0.'.index';
        $this->data = ['container0' => $container0];

        if (! PageModel::where('slug', $this->pageSlug)->exists()) {
            abort(404);
        }
    }
};
?>

<x-layouts.app>
    @volt('container0.index')
    <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-layouts.app>
