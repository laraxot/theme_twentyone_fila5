{{-- Componente riutilizzabile per le card dei rating --}}
@props([
    'rating',
    'predictId',
    'action' => 'bet',
    'imageUrl' => null,
    'percentage' => null,
    'theme' => 'emerald',
])

@php
    $data = [
        'predict_id' => $predictId,
        'rating_id' => $rating->id,
    ];
    $resolvedImageUrl = $imageUrl
        ?? app(\Modules\Predict\Actions\Rating\ResolveRatingImageUrlAction::class)->execute($rating);
    $resolvedPercentage = is_numeric($percentage)
        ? round((float) $percentage, 1)
        : round((float) ((float) ($rating->pivot->percentage ?? 0) * 100), 1);
    $title = is_scalar($rating->title ?? null) ? (string) $rating->title : 'Opzione';
    $initials = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($title, 0, 2));
    $probabilityLabel = __('predict::common.labels.probability.label');
    $probabilityLabel = is_string($probabilityLabel) && $probabilityLabel !== 'predict::labels.probability'
        ? $probabilityLabel
        : 'Probabilità';
    $themePalette = match ($theme) {
        'amber' => [
            'gradient' => 'from-amber-500 via-amber-400 to-orange-500',
            'text' => 'text-amber-700 dark:text-amber-300',
        ],
        'slate' => [
            'gradient' => 'from-slate-600 via-slate-500 to-slate-400',
            'text' => 'text-slate-700 dark:text-slate-300',
        ],
        'rose' => [
            'gradient' => 'from-rose-600 via-rose-500 to-pink-500',
            'text' => 'text-rose-700 dark:text-rose-300',
        ],
        default => [
            'gradient' => 'from-emerald-600 via-emerald-500 to-teal-500',
            'text' => 'text-emerald-700 dark:text-emerald-300',
        ],
    };
@endphp

<button
    wire:click="mountAction('{{ $action }}', @js($data))"
    class="predict-outcome-card card-kinetic block w-full text-left focus:outline-none"
    type="button"
>
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-gray-700 dark:bg-gray-900">
        <div class="predict-outcome-media relative aspect-[4/3] overflow-hidden bg-gray-100 dark:bg-gray-800">
            @if($resolvedImageUrl)
                <img
                    src="{{ $resolvedImageUrl }}"
                    alt="{{ $title }}"
                    class="h-full w-full object-cover transition-transform duration-500"
                    loading="lazy"
                >
            @else
                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br {{ $themePalette['gradient'] }}">
                    <span class="text-4xl font-black tracking-tight text-white">{{ $initials }}</span>
                </div>
            @endif

            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/80 via-black/25 to-transparent"></div>
            <div class="absolute inset-x-3 bottom-3">
                <div class="flex items-center justify-between gap-3 rounded-xl bg-black/50 px-3 py-2 backdrop-blur-sm">
                    <span class="truncate text-sm font-semibold text-white">{{ $title }}</span>
                    <span class="shrink-0 rounded-full bg-white/95 px-2 py-1 text-xs font-bold text-gray-900">{{ $resolvedPercentage }}%</span>
                </div>
            </div>
        </div>

        <div class="space-y-2 px-4 py-4">
            <p class="line-clamp-2 text-sm font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </p>
            <div class="space-y-1">
                <div class="flex items-center justify-between text-xs font-medium {{ $themePalette['text'] }}">
                    <span>{{ $probabilityLabel }}</span>
                    <span>{{ $resolvedPercentage }}%</span>
                </div>
                <div class="h-2 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                    <div
                        class="probability-bar-animated h-full rounded-full bg-gradient-to-r {{ $themePalette['gradient'] }}"
                        style="width: {{ min(100, $resolvedPercentage) }}%"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</button> 
