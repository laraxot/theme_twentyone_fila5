<?php

use Modules\Blog\Models\Category;
use Illuminate\View\View;
use function Laravel\Folio\{withTrashed, name, render};

withTrashed();
name('categories.index');

render(function (View $view) {
    $categories = Category::tree()->get()->toTree();
    return $view->with('categories', $categories);
});

?>
<x-layouts.app>
    @foreach($categories as $category)
        <div class="container max-w-6xl p-6 mx-auto space-y-4">
            {{-- <p class="flex items-center gap-3 mb-4 text-sm text-gray-400">
                <span>All</span>
                @foreach($category->ancestors()->breadthFirst()->get() as $ancestor)
                    <span>
                        <x-heroicon-o-chevron-right width="15px"/>
                    </span>
                    <a class="text-blue-500" href="{{ url('categories/'.$ancestor->slug) }}">{{ $ancestor->title }}</a>
                @endforeach
            </p> --}}
            {{-- <h2 class="flex items-center space-x-2 text-2xl font-semibold">
                {{ $category->title }}
            </h2> --}}


            <a class="flex items-center space-x-2 text-2xl font-semibold"
                href="{{ url(app()->getLocale().'/categories/'.$category->slug) }}"
                >
                {{ $category->title }}
            </a>


            <ul class="flex flex-wrap gap-2">
                @foreach($category->descendants()->get() as $descendant)
                <li>
                    <a type="button" 
                        href="{{ url(app()->getLocale().'/categories/'.$descendant->slug) }}" 
                        class="px-3 py-1 transition-colors bg-gray-200 rounded hover:bg-gray-300">
                        <span>{{ $descendant->title }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 rounded-xl p-6 hover:shadow-lg hover:border-emerald-300 dark:hover:border-emerald-700 transition-all duration-300">
                    <a href="{{ url(app()->getLocale().'/categories/'.$category->slug) }}"
                       class="block mb-3">
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                            {{ $category->title }}
                        </h2>
                    </a>

                    @php $descendants = $category->descendants()->get(); @endphp
                    @if($descendants->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($descendants as $descendant)
                                <a href="{{ url(app()->getLocale().'/categories/'.$descendant->slug) }}"
                                   class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full
                                          bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300
                                          border border-slate-200 dark:border-slate-700
                                          hover:bg-emerald-50 dark:hover:bg-emerald-900/30
                                          hover:text-emerald-700 dark:hover:text-emerald-400
                                          hover:border-emerald-300 dark:hover:border-emerald-700
                                          transition-all duration-200">
                                    {{ $descendant->title }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>