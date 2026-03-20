{{-- Homepage - Direct rendering without CMS dependency --}}
@php
    $jsonPath = base_path('config/local/predict/database/content/pages/home.json');
    $homeData = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];
    $hero = $homeData['sections']['hero'] ?? [];
    $categories = $homeData['sections']['categories'] ?? [];
    $howItWorks = $homeData['sections']['how_it_works'] ?? [];
    $heroIconAliases = [
        'cpu' => 'cpu-chip',
        'command-line' => 'cpu-chip',
        'chart-bar-square' => 'presentation-chart-bar',
        'status-online' => 'signal',
        'collection' => 'squares-2x2',
    ];
@endphp

{{-- Hero Section --}}
@if (! empty($hero))
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900/20 to-slate-900">
    <!-- Background Gradient -->
    <div class="absolute inset-0">
        <div class="absolute -top-1/2 -right-1/2 w-[200%] h-[200%] opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/40 via-purple-600/30 to-pink-600/40 blur-3xl"></div>
        </div>
        <div class="absolute -bottom-1/2 -left-1/2 w-[200%] h-[200%] opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-600/30 via-teal-600/20 to-green-600/30 blur-3xl"></div>
        </div>
    </div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center max-w-5xl mx-auto">
            <!-- Eyebrow -->
            @if(isset($hero['eyebrow']))
            <p class="text-emerald-400 font-semibold text-sm uppercase tracking-wider mb-4">
                {{ $hero['eyebrow'] }}
            </p>
            @endif

            <!-- Title -->
            @if(isset($hero['title']))
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 bg-gradient-to-r from-white via-slate-100 to-slate-200 bg-clip-text text-transparent leading-tight">
                {!! nl2br(e($hero['title'])) !!}
            </h1>
            @endif

            <!-- Subtitle -->
            @if(isset($hero['subtitle']))
            <p class="text-xl sm:text-2xl text-slate-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                {{ $hero['subtitle'] }}
            </p>
            @endif

            <!-- Trust Note -->
            @if(isset($hero['trust_note']))
            <p class="text-sm text-slate-400 mb-12">
                {{ $hero['trust_note'] }}
            </p>
            @endif

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                @if(isset($hero['cta_explore']))
                <a href="{{ url('/' . app()->getLocale() . '/predicts') }}"
                   class="group px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-full hover:from-emerald-500 hover:to-teal-500 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/30 min-w-[200px] text-center">
                    {{ $hero['cta_explore'] }}
                    <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                @endif

                @if(isset($hero['cta_signup']))
                <a href="{{ url('/' . app()->getLocale() . '/register') }}"
                   class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-semibold rounded-full hover:bg-white/20 transition-all duration-300 hover:scale-105 min-w-[200px] text-center">
                    {{ $hero['cta_signup'] }}
                </a>
                @endif
            </div>

            <!-- Stats -->
            @if (! empty($hero['stats']))
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-4xl mx-auto">
                @foreach($hero['stats'] as $stat)
                <div class="text-center p-6 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10">
                    @php
                        $statIcon = isset($stat['icon'])
                            ? 'heroicon-o-' . ($heroIconAliases[$stat['icon']] ?? $stat['icon'])
                            : null;
                    @endphp
                    @if($statIcon)
                    <x-filament::icon :icon="$statIcon" class="w-8 h-8 mx-auto mb-3 text-{{ $stat['accent'] ?? 'emerald' }}-400"/>
                    @endif
                    <p class="text-3xl font-bold text-white mb-1">{{ $stat['value'] ?? '0' }}</p>
                    <p class="text-sm text-slate-400">{{ $stat['label'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- Categories Section --}}
@if (! empty($categories))
<section class="py-20 bg-slate-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            @if(isset($categories['title']))
            <h2 class="text-4xl font-bold text-white mb-4">{{ $categories['title'] }}</h2>
            @endif
            @if(isset($categories['subtitle']))
            <p class="text-slate-400">{{ $categories['subtitle'] }}</p>
            @endif
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 max-w-6xl mx-auto">
            @foreach($categories['items'] ?? [] as $category)
            <a href="{{ url('/' . app()->getLocale() . '/predicts?category=' . $category['slug']) }}"
               class="group p-6 bg-slate-800/50 hover:bg-slate-800 rounded-2xl border border-slate-700 hover:border-emerald-500/50 transition-all duration-300 hover:scale-105 text-center">
                @php
                    $categoryIcon = isset($category['icon'])
                        ? 'heroicon-o-' . ($heroIconAliases[$category['icon']] ?? $category['icon'])
                        : null;
                @endphp
                @if($categoryIcon)
                <x-filament::icon :icon="$categoryIcon" class="w-12 h-12 mx-auto mb-4 text-emerald-400 group-hover:text-emerald-300 transition-colors"/>
                @endif
                <h3 class="text-lg font-semibold text-white mb-2">{{ $category['name'] ?? '' }}</h3>
                <p class="text-sm text-slate-400">{{ $category['count'] ?? 0 }} mercati</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- How It Works Section --}}
@if (! empty($howItWorks))
<section class="py-20 bg-gradient-to-b from-slate-900 to-slate-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            @if(isset($howItWorks['title']))
            <h2 class="text-4xl font-bold text-white mb-4">{{ $howItWorks['title'] }}</h2>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
            @foreach($howItWorks['steps'] ?? [] as $index => $step)
            <div class="relative text-center p-6">
                <!-- Step Number -->
                <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full flex items-center justify-center text-2xl font-bold text-white shadow-lg shadow-emerald-500/30">
                    {{ $index + 1 }}
                </div>
                
                @if(isset($step['title']))
                <h3 class="text-xl font-semibold text-white mb-3">{{ $step['title'] }}</h3>
                @endif
                
                @if(isset($step['description']))
                <p class="text-slate-400 leading-relaxed">{{ $step['description'] }}</p>
                @endif

                @if(!$loop->last)
                <div class="hidden lg:block absolute top-12 left-1/2 w-full h-0.5 bg-gradient-to-r from-emerald-600/50 to-transparent"></div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
