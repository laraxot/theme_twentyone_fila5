@php
    use Filament\Support\Enums\Alignment;
    use Filament\Support\Enums\FontWeight;
    
    $title = $getRecord()->title;
    if (is_array($title)) {
        $locale = app()->getLocale();
        $title = $title[$locale] ?? $title['en'] ?? $title['it'] ?? '';
    }
    
    $sumYes = floatval($getRecord()->sum_credit_yes ?? 0);
    $sumNo = floatval($getRecord()->sum_credit_no ?? 0);
    $volume = number_format(($sumYes + $sumNo) / 100, 0);
    
    $countYes = intval($getRecord()->count_credit_yes ?? 0);
    $countNo = intval($getRecord()->count_credit_no ?? 0);
    $participants = $countYes + $countNo;
    
    $endsAt = $getRecord()->closed_at ? \Carbon\Carbon::parse($getRecord()->closed_at) : now()->addDays(7);
    $timeLeft = $endsAt->diffForHumans(short: true);
    
    $ratings = $getRecord()->ratings ?? collect();
    $isMultiOutcome = $ratings->count() > 2;

    $multiOutcomes = [];
    $totalOutcomeVolume = 0.0;

    foreach ($ratings as $rating) {
        $ratingVolume = 0.0;
        if (isset($rating->pivot)) {
            $pivotYes = $rating->pivot->sum_credit_yes ?? 0;
            $pivotNo = $rating->pivot->sum_credit_no ?? 0;
            $ratingVolume = (float) $pivotYes + (float) $pivotNo;
        }

        $multiOutcomes[] = [
            'title' => $rating->title ?? 'Option',
            'color' => $rating->color ?? '#6B7280',
            'probability' => 0.0,
            'volume' => $ratingVolume,
        ];
        $totalOutcomeVolume += $ratingVolume;
    }

    if ($isMultiOutcome && $totalOutcomeVolume > 0) {
        foreach ($multiOutcomes as &$outcomeRef) {
            $outcomeRef['probability'] = ($outcomeRef['volume'] / $totalOutcomeVolume) * 100;
        }
        unset($outcomeRef);
    } elseif ($isMultiOutcome) {
        $equalProbability = count($multiOutcomes) > 0 ? (100 / count($multiOutcomes)) : 0;
        foreach ($multiOutcomes as &$outcomeRef) {
            $outcomeRef['probability'] = $equalProbability;
        }
        unset($outcomeRef);
    }

    usort($multiOutcomes, static fn (array $a, array $b): int => $b['probability'] <=> $a['probability']);
    $multiOutcomes = array_slice($multiOutcomes, 0, 6);
@endphp

<div class="p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
    {{-- Header: Category + Time Left --}}
    <div class="flex items-center justify-between mb-3">
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 capitalize">
            {{ $getRecord()->getBloodlineCategories() ?: __('predict::predict_table.fields.general.label') }}
        </span>
        <span class="text-xs text-gray-500 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ $timeLeft }}
        </span>
    </div>

    {{-- Title --}}
    <h3 class="text-base font-semibold text-gray-900 mb-4 line-clamp-2">
        {{ $title }}
    </h3>

    @if($isMultiOutcome && count($multiOutcomes) > 0)
        {{-- MULTI-OUTCOME: Show all options --}}
        <div class="space-y-2 mb-4">
            @foreach($multiOutcomes as $outcome)
                @php
                    $outcomeTitle = is_array($outcome['title'])
                        ? ($outcome['title'][app()->getLocale()] ?? $outcome['title']['en'] ?? $outcome['title']['it'] ?? 'Option')
                        : (string) $outcome['title'];
                    $probability = (float) ($outcome['probability'] ?? 0);
                    $color = $outcome['color'] ?? '#6B7280';
                @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs font-medium text-gray-700">{{ $outcomeTitle }}</span>
                        <span class="text-sm font-bold" style="color: {{ $color }}">{{ number_format($probability, 1) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500" 
                             style="width: {{ $probability }}%; background-color: {{ $color }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- BINARY: Show YES/NO only --}}
        <div class="space-y-3 mb-4">
            @php
                $valueBuy = floatval($getRecord()->value_buy ?? 50);
                $valueSell = floatval($getRecord()->value_sell ?? 50);
            @endphp
            {{-- YES --}}
            <div>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-medium text-emerald-700">{{ __('predict::predict_table.fields.yes.label') }}</span>
                    <span class="text-lg font-bold text-emerald-600">{{ number_format($valueBuy, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full transition-all duration-500" 
                         style="width: {{ $valueBuy }}%"></div>
                </div>
            </div>

            {{-- NO --}}
            <div>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-medium text-rose-700">{{ __('predict::predict_table.fields.no.label') }}</span>
                    <span class="text-lg font-bold text-rose-600">{{ number_format($valueSell, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-rose-400 to-rose-500 rounded-full transition-all duration-500" 
                         style="width: {{ $valueSell }}%"></div>
                </div>
            </div>
        </div>
    @endif

    {{-- Footer: Volume + Participants + Trade Button --}}
    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-3 text-xs text-gray-600">
            {{-- Volume --}}
            <div class="flex items-center gap-1" title="{{ __('predict::predict_table.fields.volume.label') }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span class="font-medium">{{ $volume }}</span>
            </div>

            {{-- Participants --}}
            <div class="flex items-center gap-1" title="{{ __('predict::predict_table.fields.participants.label') }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="font-medium">{{ $participants }}</span>
            </div>
        </div>

        {{-- Trade Button --}}
        <a href="{{ url('/' . app()->getLocale() . '/predicts/' . $getRecord()->slug) }}"
           class="inline-flex items-center gap-1 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            {{ __('predict::predict_table.actions.trade.label') }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div>
