<?php

use Modules\Cms\Models\Page;
use Modules\Predict\Models\Article;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use function Laravel\Folio\{withTrashed,middleware, name,render};

withTrashed();
name('search');
//middleware(['auth', 'verified']);

render(function (View $view) {
    $_theme = app(\Modules\Blog\View\Composers\ThemeComposer::class);
    $articles = [];
    $query = request()->query('search');

    if (isset($query)) {
        $articles = Article::where('title', 'like', '%'.$query.'%')
            ->take(20)
            ->get()
            ->map(fn ($article) => $_theme->mapArticle($article));
    }

    return $view->with('articles', $articles);
});

?>

<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="space-y-2 text-center mb-8">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white">Cerca</h1>
            <p class="text-slate-500 dark:text-slate-400">Trova mercati, categorie e contenuti in un unico posto.</p>
        </div>

        <form action="{{ url(app()->getLocale().'/search') }}" method="get" class="flex items-center max-w-2xl mx-auto space-x-2 mb-10">
            <div class="grow">
                <input name="search"
                       class="w-full rounded-lg border border-slate-300 dark:border-slate-700
                              bg-white dark:bg-slate-800
                              text-slate-900 dark:text-white
                              placeholder-slate-400 dark:placeholder-slate-500
                              focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                              px-4 py-3 transition-colors"
                       type="text"
                       placeholder="Cerca mercati, categorie..."
                       value="{{ request()->query('search', '') }}">
            </div>
            <div>
                <button type="submit" class="flex items-center px-4 py-3 space-x-2 text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">
                    <x-heroicon-o-magnifying-glass class="size-5" />
                    <span class="hidden sm:block">Cerca</span>
                </button>
            </div>
        </form>

        @if(count($articles))
            <div class="max-w-3xl mx-auto p-4 bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 rounded-xl">
                <div class="space-y-4">
                    <h2 class="font-semibold text-slate-900 dark:text-white">Mercati</h2>
                    <ul class="space-y-2">
                        @foreach($articles as $article)
                            <li>
                                <a href="{{ url(app()->getLocale().'/predicts/'.$article->slug) }}">
                                    <div class="flex flex-row px-4 py-3 space-x-4 border border-slate-100 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                        <img class="flex rounded size-12 aspect-square object-cover" src="{{ $article->ratings[0]['image'] ?? 'https://placehold.co/128x128' }}" alt=""/>
                                        <div class="break-all grow">
                                            <h3 class="text-emerald-600 dark:text-emerald-400 font-medium">{{ $article->title }}</h3>
                                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                                {{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="self-center hidden text-slate-400 dark:text-slate-500 md:block">&rarr;</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @elseif(request()->query('search'))
            <div class="text-center py-12">
                <p class="text-slate-500 dark:text-slate-400">Nessun risultato per "{{ request()->query('search') }}"</p>
            </div>
        @endif
    </div>
</x-layouts.app>