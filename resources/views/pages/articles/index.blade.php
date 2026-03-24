<?php

use Modules\Blog\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use function Laravel\Folio\{withTrashed,middleware, name,render};

withTrashed();
name('articles.index');
//middleware(['auth', 'verified']);

// render(function (View $view) {
//     $categories = Category::tree()->get()->toTree();
//     return $view->with('categories', $categories);
// });


?>
<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <x-predict::blocks.article_list.play_money_markets.index
            :articles="collect()"
            :show-order-select="true"
            selected-order="recent"
            container-class="space-y-6"
        />
    </div>
</x-layouts.app>