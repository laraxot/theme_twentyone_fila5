@props([
    'sources' => [
        ['name' => 'CNN', 'logo' => '📺'],
        ['name' => 'AP News', 'logo' => '📰'],
        ['name' => 'Reuters', 'logo' => '🌍'],
        ['name' => 'Bloomberg', 'logo' => '📊'],
        ['name' => 'WSJ', 'logo' => '📈'],
    ],
])

{{-- Trust Bar - News Sources (Polymarket Style) --}}
<section class="bg-slate-900/50 border-y border-slate-800 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-center md:text-left">
                <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">
                    As featured on
                </p>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8">
                @foreach($sources as $source)
                <div class="flex items-center gap-2 text-slate-500 hover:text-slate-300 transition-colors duration-200">
                    <span class="text-2xl">{{ $source['logo'] }}</span>
                    <span class="font-bold text-sm">{{ $source['name'] }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="text-center md:text-right">
                <p class="text-xs text-slate-500">
                    Trusted by 50K+ predictors worldwide
                </p>
            </div>
        </div>
    </div>
</section>
