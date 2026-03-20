@php
    $predicts = \Modules\Predict\Models\Predict::query()
        ->whereIn('status', ['active', 'open', 'published'])
        ->hasTitle()
        ->orderBy('created_at', 'desc')
        ->limit(12)
        ->get();
@endphp

<div class="fi-ta-content-grid" style="--content-grid-col-width: 1fr; --content-grid-gap: 1.5rem; --content-grid-md-col-count: 1; --content-grid-xl-col-count: 3; display: grid; grid-template-columns: repeat(var(--content-grid-md-col-count), var(--content-grid-col-width)); gap: var(--content-grid-gap);">
    @if($predicts->isEmpty())
        <div class="col-span-full rounded-2xl border border-gray-200 bg-white p-12 text-center shadow-sm">
            <p class="text-gray-600">{{ __('predict::messages.no_markets_available') }}</p>
            <p class="mt-2 text-sm text-gray-500">{{ __('predict::messages.no_markets_hint') }}</p>
        </div>
    @else
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
        
        <div class="fi-ta-record-item card-kinetic bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5">
                {{-- Hot Badge --}}
                @if($isHot)
                    <span class="badge-hot inline-flex items-center gap-1 bg-orange-100 text-orange-700">
                        <x-filament::icon icon="heroicon-o-fire" class="h-3.5 w-3.5" aria-hidden="true" />
                        Hot
                    </span>
                @endif
                
                {{-- Title --}}
                <h3 class="text-base font-semibold text-gray-900 mb-3 line-clamp-3">
                    <a
                        href="{{ url('/' . app()->getLocale() . '/predicts/' . $predict->slug) }}"
                        class="link-kinetic hover:text-indigo-700"
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
                            class="h-full rounded-full probability-bar-animated {{ $yesPrice > 60 ? 'bg-emerald-500' : ($yesPrice < 40 ? 'bg-rose-500' : 'bg-amber-400') }} {{ $isHot ? 'high-activity' : '' }}"
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
                        <span class="inline-flex items-center gap-1">{{ number_format($volume) }} <x-filament::icon icon="predict-currency" class="h-4 w-4" aria-hidden="true" /></span>
                    </span>
                </div>
                <a
                    href="{{ url('/' . app()->getLocale() . '/predicts/' . $predict->slug) }}"
                    class="btn-kinetic-enhanced inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700"
                >
                    Scambia
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
    @endif
</div>
