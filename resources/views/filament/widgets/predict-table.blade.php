@php
    $predicts = \Modules\Predict\Models\Predict::query()
        ->whereIn('status', ['active', 'open', 'published'])
        ->whereRaw('(sum_credit_yes + sum_credit_no) > 0')
        ->with(['ratings'])
        ->orderBy('created_at', 'desc')
        ->limit(24)
        ->get();
@endphp

<div class="fi-ta-content-grid" style="--content-grid-col-width: 1fr; --content-grid-gap: 1.5rem; --content-grid-md-col-count: 1; --content-grid-xl-col-count: 3; display: grid; grid-template-columns: repeat(var(--content-grid-md-col-count), var(--content-grid-col-width)); gap: var(--content-grid-gap);">
    @foreach($predicts as $predict)
        @php
            $title = $predict->title;
            if (is_array($title)) {
                $locale = app()->getLocale();
                $title = $title[$locale] ?? $title['en'] ?? (is_string(reset($title)) ? reset($title) : '');
            }
            
            $sumYes = (float) ($predict->sum_credit_yes ?? 0);
            $sumNo = (float) ($predict->sum_credit_no ?? 0);
            $total = $sumYes + $sumNo;
            $yesPrice = $total > 0 ? round(($sumYes / $total) * 100, 1) : 50.0;
            $noPrice = round(100 - $yesPrice, 1);
            $participants = (int) ($predict->count_credit_yes ?? 0) + (int) ($predict->count_credit_no ?? 0);
            $volume = round($total / 100, 0);
            $isHot = $volume > 200;
        @endphp
        
        <div class="fi-ta-record-item bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-indigo-200 transition-all duration-200 overflow-hidden">
            <div class="p-5">
                {{-- Hot Badge --}}
                @if($isHot)
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700 mb-3">
                        🔥 Hot
                    </span>
                @endif
                
                {{-- Title --}}
                <h3 class="text-base font-semibold text-gray-900 mb-3 line-clamp-3">
                    <a
                        href="{{ route('market.detail', ['slug' => $predict->slug]) }}"
                        class="hover:text-indigo-700 transition-colors"
                    >
                        {{ $title }}
                    </a>
                </h3>
                
                {{-- Probability Bar --}}
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1.5">
                        <span class="text-xs font-semibold text-emerald-600">SÌ</span>
                        <span class="text-lg font-bold text-emerald-600">{{ $yesPrice }}%</span>
                    </div>
                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div
                            class="h-full rounded-full transition-all duration-500 {{ $yesPrice > 60 ? 'bg-emerald-500' : ($yesPrice < 40 ? 'bg-rose-500' : 'bg-amber-400') }}"
                            style="width: {{ $yesPrice }}%"
                        ></div>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-xs text-gray-400">NO {{ $noPrice }}%</span>
                        <span class="text-xs text-gray-400">{{ number_format($participants) }} partecipanti</span>
                    </div>
                </div>
            </div>
            
            {{-- Footer --}}
            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3 text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>{{ number_format($volume) }} 🍺</span>
                    </span>
                </div>
                <a
                    href="{{ route('market.detail', ['slug' => $predict->slug]) }}"
                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition-colors"
                >
                    Scambia
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
</div>
