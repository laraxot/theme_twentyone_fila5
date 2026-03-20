@php
    $record = $getRecord();
    $card = app(\Modules\Predict\Actions\Frontoffice\ResolvePredictCardDataAction::class)->execute($record);
    $visibleOptions = collect($card['options'])->take(4)->values();
    $leadingOption = $visibleOptions->first();
    $statusClasses = $card['status_tone'] === 'active'
        ? 'border-emerald-400/30 bg-emerald-500/12 text-emerald-50'
        : 'border-white/10 bg-slate-500/18 text-slate-100';
    $tx = static function (string $key, string $fallback): string {
        $translated = __($key);
        if (is_string($translated) && $translated !== $key) {
            return $translated;
        }

        $translatedLabel = __($key.'.label');
        if (is_string($translatedLabel) && $translatedLabel !== ($key.'.label')) {
            return $translatedLabel;
        }

        return $fallback;
    };
@endphp

<article class="group relative overflow-hidden rounded-[2rem] border border-slate-800/80 bg-slate-950 shadow-[0_28px_90px_-42px_rgba(15,23,42,0.9)]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.18),_transparent_36%),radial-gradient(circle_at_bottom_right,_rgba(236,72,153,0.16),_transparent_34%)]"></div>
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/35 to-transparent"></div>

    <div class="relative p-5 md:p-6">
        <div class="mb-5 flex items-start justify-between gap-3">
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] {{ $statusClasses }}">
                        {{ $card['status_label'] }}
                    </span>

                    @if($card['category_title'])
                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/6 px-3 py-1 text-[11px] font-medium uppercase tracking-[0.18em] text-slate-200 backdrop-blur-sm">
                            {{ $card['category_title'] }}
                        </span>
                    @endif
                </div>

                <div class="space-y-2">
                    <h3 class="max-w-2xl text-xl font-semibold leading-tight text-white md:text-[1.4rem]">
                        <a href="{{ $card['detail_url'] }}" class="transition-colors group-hover:text-sky-200 focus:outline-none focus:underline">
                            {{ $card['title'] }}
                        </a>
                    </h3>

                    @if($leadingOption)
                        <p class="text-sm text-slate-300">
                            {{ $tx('predict::labels.leading_outcome', 'Opzione in testa') }}
                            <span class="font-semibold text-white">{{ $leadingOption['title'] }}</span>
                            <span class="text-sky-300">{{ number_format($leadingOption['percentage'], 1) }}%</span>
                        </p>
                    @endif
                </div>
            </div>

            <a
                href="{{ $card['detail_url'] }}"
                class="inline-flex shrink-0 items-center gap-2 rounded-full border border-sky-400/35 bg-sky-400/16 px-4 py-2 text-sm font-semibold text-sky-50 shadow-[0_0_0_1px_rgba(125,211,252,0.08)] backdrop-blur-md transition hover:border-sky-300/60 hover:bg-sky-400/24 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:ring-offset-2 focus:ring-offset-slate-950"
            >
                {{ $tx('predict::actions.trade_market', 'Apri il mercato') }}
                <span aria-hidden="true">→</span>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-3">
            @foreach($visibleOptions as $option)
                <a
                    href="{{ $card['detail_url'] }}"
                    class="group/option block overflow-hidden rounded-[1.4rem] border border-white/10 bg-white/6 shadow-[0_20px_45px_-34px_rgba(15,23,42,0.95)] backdrop-blur-sm transition hover:-translate-y-1 hover:border-white/22 hover:bg-white/10"
                    aria-label="{{ $option['title'] }} {{ number_format($option['percentage'], 1) }}%"
                >
                    <span class="relative block aspect-[5/4] overflow-hidden bg-slate-900">
                        @if($option['image_url'])
                            <img
                                src="{{ $option['image_url'] }}"
                                alt="{{ $option['title'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition duration-700 group-hover/option:scale-[1.04]"
                            >
                        @else
                            <span class="flex h-full items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950">
                                <x-filament::icon icon="heroicon-o-photo" class="h-10 w-10 text-slate-500" />
                            </span>
                        @endif

                        <span class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/28 to-transparent"></span>

                        <span class="absolute inset-x-0 top-0 flex items-center justify-between p-3">
                            <span class="rounded-full border border-white/15 bg-slate-950/72 px-2.5 py-1 text-xs font-semibold text-white shadow-sm backdrop-blur-md">
                                {{ number_format($option['percentage'], 1) }}%
                            </span>
                        </span>

                        <span class="absolute inset-x-3 bottom-3 block overflow-hidden rounded-2xl border border-white/10 bg-slate-950/72 p-2.5 backdrop-blur-md">
                            <span class="mb-2 flex items-center justify-between gap-2">
                                <span class="truncate text-sm font-semibold text-white">{{ $option['title'] }}</span>
                                <span class="shrink-0 text-[11px] font-medium uppercase tracking-[0.16em] text-slate-300">
                                    {{ $tx('predict::labels.credits_share', 'Quota') }}
                                </span>
                            </span>

                            <span class="block h-2.5 overflow-hidden rounded-full bg-white/10">
                                <span
                                    class="block h-full rounded-full"
                                    style="width: {{ max(2, min(100, $option['percentage'])) }}%; background: linear-gradient(90deg, {{ $option['color'] }}, color-mix(in srgb, {{ $option['color'] }} 58%, white));"
                                ></span>
                            </span>
                        </span>
                    </span>
                </a>
            @endforeach
        </div>

        <div class="mt-5 flex flex-wrap items-center justify-between gap-4 border-t border-white/10 pt-4 text-sm">
            <div class="flex flex-wrap items-center gap-4 text-slate-300">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5">
                    <span class="text-slate-400">{{ $tx('predict::labels.volume', 'Volume') }}</span>
                    <span class="font-semibold text-white">{{ number_format($card['volume'], 0) }}</span>
                </span>

                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5">
                    <span class="text-slate-400">{{ $tx('predict::labels.participants', 'Partecipanti') }}</span>
                    <span class="font-semibold text-white">{{ number_format($card['participants']) }}</span>
                </span>

                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3 py-1.5">
                    <span class="text-slate-400">{{ $tx('predict::labels.outcomes', 'Esiti') }}</span>
                    <span class="font-semibold text-white">{{ $visibleOptions->count() }}</span>
                </span>
            </div>

            <a href="{{ $card['detail_url'] }}" class="font-semibold text-sky-300 transition hover:text-sky-200">
                {{ $tx('predict::actions.view_details', 'Vedi dettagli') }}
            </a>
        </div>
    </div>
</article>
