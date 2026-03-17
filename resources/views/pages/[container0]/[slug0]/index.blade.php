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
    public string $container0 = '';
    public string $slug0 = '';
    public string $pageSlug = '';
    public array $data = [];

    public function mount(ResolvePageAction $resolvePageAction, string $container0, string $slug0): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;

        $resolved = $resolvePageAction->execute($this->container0, $this->slug0);
        $this->pageSlug = $resolved->pageSlug;

        $this->data = [
            'container0' => $container0,
            'slug0' => $slug0,
            'item' => $resolved->item, // Generic item data
        ];
    }
};
?>

<x-layouts.app>
    @push('head')
        @if($this->container0 === 'predicts' && $this->data['item'])
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Article",
                "headline": "{{ $this->data['item']->title ?: 'Previsione #' . $this->data['item']->id }}",
                "description": "{{ $this->data['item']->description ?: 'Mercato di previsione' }}",
                "datePublished": "{{ $this->data['item']->created_at?->format('Y-m-d\\TH:i:sP') }}",
                "dateModified": "{{ $this->data['item']->updated_at?->format('Y-m-d\\TH:i:sP') }}",
                "author": {
                    "@type": "Organization",
                    "name": "{{ config('app.name', 'Prediction Platform') }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ config('app.name', 'Prediction Platform') }}"
                },
                "url": "{{ url()->current() }}",
                "image": "{{ asset('images/predict-default.jpg') }}"
            }
            </script>
        @endif
    @endpush
    @volt('container0.view')
    <div class="min-h-screen bg-gray-50 dark:bg-slate-900">
        @if($this->data['item'])
            {{-- Dynamic Content Rendering --}}
            <div class="max-w-7xl mx-auto px-4 py-8">
                {{-- Breadcrumb Navigation --}}
                <div class="mb-4">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2A1 1 0 0 0 1 10h2v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0 1-1h2a1 1 0 0 0 1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-8h2a1 1 0 0 0 .707-1.707Z"/>
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <a href="{{ url('/' . app()->getLocale() . '/' . $this->container0) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ ucfirst($this->container0) }}</a>
                                </div>
                            </li>
        @if($this->container0 === 'predicts' && isset($this->data['item']) && $this->data['item'])
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $this->data['item']->title ?: 'Previsione #' . $this->data['item']->id }}</span>
                                </div>
                            </li>
                            @endif
                        </ol>
                    </nav>
                </div>

                {{-- Title --}}
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">
                    @if($this->container0 === 'predicts')
                        @if(is_array($this->data['item']->title))
                            {{ $this->data['item']->title[app()->getLocale()] ?? $this->data['item']->title['en'] ?? reset($this->data['item']->title) }}
                        @else
                            {{ $this->data['item']->title ?: 'Mercato #' . $this->data['item']->id }}
                        @endif
                    @else
                        {{ ucfirst($this->slug0) }}
                    @endif
                </h1>
                
                <p class="text-slate-600 dark:text-slate-400 mb-6">
                    @if($this->container0 === 'predicts' && is_array($this->data['item']->description))
                        {{ $this->data['item']->description[app()->getLocale()] ?? $this->data['item']->description['en'] ?? reset($this->data['item']->description) }}
                    @else
                        {{ ucfirst($this->container0) }} detail content
                    @endif
                </p>
                
                {{-- Container-specific content --}}
                @if($this->container0 === 'predicts')
                    {{-- Category, Tags, Stats, Share --}}
                    <x-predict::detail-header :predict="$this->data['item']" />
                    
                    {{-- Outcomes --}}
                    @if($this->data['item']->ratings->isNotEmpty())
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Risultati Possibili</h3>
                        <div class="space-y-4 mb-6">
                            @foreach($this->data['item']->ratings->sortByDesc('probability') as $rating)
                                @php
                                    $percentage = round($rating->probability * 100, 1);
                                    $colorClass = $percentage > 60 ? 'bg-emerald-500' : ($percentage < 40 ? 'bg-rose-500' : 'bg-amber-500');
                                @endphp
                                <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-4 border border-slate-200 dark:border-slate-700">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold text-slate-900 dark:text-white">
                                            {{ is_array($rating->title) ? ($rating->title[app()->getLocale()] ?? reset($rating->title)) : $rating->title }}
                                        </span>
                                        <span class="text-lg font-bold {{ $colorClass === 'bg-emerald-500' ? 'text-emerald-600' : ($colorClass === 'bg-amber-500' ? 'text-amber-600' : 'text-rose-600') }}">
                                            {{ $percentage }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                                        <div class="h-full {{ $colorClass }} rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    {{-- Bet Button --}}
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold mb-4">Place Your Bet</h2>
                        <p class="text-gray-600 mb-4">Select an outcome above to place your bet</p>
                        @auth
                            <a href="#" class="inline-block bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600">
                                Bet Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600">
                                Login to Bet
                            </a>
                        @endauth
                    </div>
                @endif
                
                {{-- Generic content for other containers --}}
                @if($this->container0 !== 'predicts')
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6">
                        <h2 class="text-xl font-bold mb-4">{{ ucfirst($this->container0) }} Details</h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            Content for {{ $this->container0 }}/{{ $this->slug0 }}
                        </p>
                    </div>
                @endif
            </div>
        @else
            {{-- Content Not Found --}}
            <div class="max-w-2xl mx-auto px-4 py-16 text-center">
                <h1 class="text-4xl font-bold mb-4">{{ ucfirst($this->container0) }} Not Found</h1>
                <p class="text-gray-600 mb-6">The {{ $this->container0 }} item you're looking for doesn't exist or has been removed.</p>
                <a href="{{ url('/' . app()->getLocale() . '/' . $this->container0) }}" class="inline-block bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600">
                    Back to {{ ucfirst($this->container0) }}
                </a>
            </div>
        @endif
    </div>
    @endvolt
</x-layouts.app>
