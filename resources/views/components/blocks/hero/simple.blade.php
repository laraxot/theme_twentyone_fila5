@props([
    'hero_title' => 'Prevedi il Futuro, Guadagna Crediti',
    'hero_subtitle' => 'La piattaforma di prediction market dove le tue previsioni contano',
    'cta_primary' => ['text' => 'INIZIA ORA', 'url' => null],
    'cta_secondary' => ['text' => 'Esplora i Mercati', 'url' => null]
])

@php
    $particlesColor = 'rgba(59,130,246,0.3)';
@endphp

{{-- HERO SECTION — Clean, Honest, Database-Driven --}}
<section class="relative min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
    
    {{-- Particles --}}
    <div class="absolute inset-0 z-0">
        <x-ui.particles count="50" :color="$particlesColor" size="2px" zIndex="0" variant="antigravity" />
    </div>
    
    {{-- Main Content --}}
    <div class="relative z-10 container mx-auto px-4 pt-20 pb-16">
        
        {{-- Hero Title --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white mb-6 leading-tight">
                {{ $hero_title }}
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-4xl mx-auto font-light">
                {{ $hero_subtitle }}
            </p>
            
            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="{{ $cta_primary['url'] }}" class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl text-lg transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-blue-500/50">
                    {{ $cta_primary['text'] }}
                </a>
                <a href="{{ $cta_secondary['url'] }}" class="inline-block px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl text-lg backdrop-blur-sm border border-white/20 transition-all duration-300">
                    {{ $cta_secondary['text'] }}
                </a>
            </div>
        </div>
        
        {{-- Real Database Stats --}}
        @php
            $activePredicts = \Modules\Predict\Models\Predict::where('status', 'active')->count();
            $userCount = \Modules\User\Models\User::count();
            $totalPredicts = \Modules\Predict\Models\Predict::count();
        @endphp
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-16">
            <div class="text-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl">
                <div class="text-4xl font-black text-blue-300 mb-2">{{ $activePredicts }}</div>
                <div class="text-blue-200 font-medium">Mercati Attivi</div>
            </div>
            <div class="text-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl">
                <div class="text-4xl font-black text-indigo-300 mb-2">{{ number_format($userCount / 1000, 1) }}K+</div>
                <div class="text-indigo-200 font-medium">Utenti Registrati</div>
            </div>
            <div class="text-center p-6 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl">
                <div class="text-4xl font-black text-purple-300 mb-2">{{ $totalPredicts }}</div>
                <div class="text-purple-200 font-medium">Previsioni Totali</div>
            </div>
        </div>
        
        {{-- Featured Markets with Images & Multi-Option --}}
        @php
            $featuredPredicts = \Modules\Predict\Models\Predict::with('ratings')
                ->where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->limit(6)
                ->get();
        @endphp
        
        @if($featuredPredicts->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-white text-center mb-8">Mercati in Evidenza</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredPredicts as $predict)
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden hover:scale-105 transition-transform duration-300">
                    {{-- Predict Image --}}
                    @if($predict->getFirstMediaUrl('main_image'))
                        <img src="{{ $predict->getFirstMediaUrl('main_image') }}" alt="{{ $predict->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
                            <x-filament::icon icon="heroicon-o-trophy" class="w-16 h-16 text-white/50" />
                        </div>
                    @endif
                    
                    <div class="p-4">
                        {{-- Title --}}
                        <h3 class="text-white font-bold mb-3 line-clamp-2">
                            {{ $predict->title }}
                        </h3>
                        
                        {{-- Multi-Option Outcomes with Progress Bars --}}
                        @if($predict->ratings->count() > 0)
                        <div class="space-y-2 mb-4">
                            @foreach($predict->ratings->take(3) as $rating)
                            <div class="relative">
                                <div class="flex justify-between text-xs text-white mb-1">
                                    <span>{{ $rating->title }}</span>
                                    <span>{{ number_format($rating->probability * 100, 1) }}%</span>
                                </div>
                                <div class="w-full bg-white/20 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full" style="width: {{ $rating->probability * 100 }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        {{-- CTA --}}
                        <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/predicts/'.$predict->slug) }}" class="block text-center py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                            {{ __('predict::actions.view_detail') ?? 'Vedi Dettagli' }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/predicts') }}" class="inline-block px-8 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl backdrop-blur-sm border border-white/20 transition-all duration-300">
                    {{ __('predict::actions.view_all_markets') ?? 'Vedi Tutti i Mercati' }}
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
