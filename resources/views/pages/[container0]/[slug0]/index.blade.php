<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.detail');
middleware(PageSlugMiddleware::class);
?>
@php
    $container0 = (string) request()->route('container0', '');
    $slug0 = (string) request()->route('slug0', '');

    $resolved = app(\Modules\Cms\Actions\ResolvePageAction::class)->execute($container0, $slug0);
    $item = $resolved->item;
    $pageSlug = $resolved->pageSlug;
    $locale = app()->getLocale();

    // Per i modelli dinamici come Predict, usa il pageSlug corretto per i blocchi
    $blocksPageSlug = 'model' === $resolved->renderMode && $container0 === 'predicts'
        ? 'predict-view'
        : $pageSlug;

    $title = is_object($item) && isset($item->title) ? $item->title : null;
    $description = is_object($item) && isset($item->description) ? $item->description : null;

    $pageTitle = is_array($title)
        ? (string) ($title[$locale] ?? $title['it'] ?? $title['en'] ?? ucfirst($slug0))
        : (string) ($title ?: ucfirst(str_replace('-', ' ', $slug0)));

    $pageMetaDescription = is_array($description)
        ? (string) ($description[$locale] ?? $description['it'] ?? $description['en'] ?? '')
        : (string) ($description ?? '');

    // Get predict ID for widget
    $predictId = is_object($item) && isset($item->id) ? $item->id : null;
@endphp
<x-layouts.app :title="$pageTitle" :meta-description="$pageMetaDescription">
    <div>
        <x-page side="content" :slug="$blocksPageSlug" :data="['item' => $item, 'predictId' => $predictId]" />
    </div>
</x-layouts.app>
