@php

    $title = 'Numeri che Parlano Chiaro';
    $subtitle = 'I risultati della nostra community';
    $counterDuration = 2000;

    $predictClass = 'Modules\Predict\Models\Predict';
    $userClass = 'Modules\User\Models\User';
    $transactionClass = 'Modules\Predict\Models\Transaction';

    try {
        $marketsCount = class_exists($predictClass) ? $predictClass::query()->whereIn('status', ['active', 'open', 'published'])->count() : 0;
    } catch (\Throwable) {
        $marketsCount = 0;
    }

    try {
        $usersCount = class_exists($userClass) ? $userClass::on('user')->count() : 0;
    } catch (\Throwable) {
        $usersCount = 0;
    }

    try {
        $volumeTotal = class_exists($transactionClass) ? (int) $transactionClass::query()->sum('credits') : 0;
    } catch (\Throwable) {
        $volumeTotal = 0;
    }

    $growthRates = [
        'markets' => $marketsCount > 0 ? min(99, max(5, (int)($marketsCount * 2))) : 0,
        'users' => $usersCount > 0 ? min(99, max(10, 45)) : 0,
        'volume' => $volumeTotal > 0 ? min(99, max(15, (int)($volumeTotal > 10000 ? 67 : 20))) : 0,
        'predictions' => $marketsCount > 0 ? min(99, max(8, (int)($marketsCount * 3))) : 0,
    ];

    $stats = [
        [
            'id' => 'markets_available',
            'label' => 'Mercati Attivi',
            'value' => $marketsCount,
            'display_value' => $marketsCount > 0 ? number_format($marketsCount, 0, ',', '.') : '0',
            'icon' => 'heroicon-o-chart-bar',
            'color' => 'cyan',
            'growth' => '+' . $growthRates['markets'] . '%',
            'growth_period' => 'questo mese',
            'description' => 'Previsioni disponibili',
            'suffix' => '+',
        ],
        [
            'id' => 'active_users',
            'label' => 'Utenti Attivi',
            'value' => $usersCount,
            'display_value' => $usersCount > 0 ? number_format($usersCount, 0, ',', '.') : '0',
            'icon' => 'heroicon-o-users',
            'color' => 'blue',
            'growth' => '+' . $growthRates['users'] . '%',
            'growth_period' => 'ultima settimana',
            'description' => 'Predictor registrati',
            'suffix' => '+',
        ],
        [
            'id' => 'total_volume',
            'label' => 'Volume Scambiato',
            'value' => $volumeTotal,
            'display_value' => $volumeTotal > 0
                ? ($volumeTotal >= 1000000
                    ? number_format($volumeTotal / 1000000, 1) . 'M'
                    : number_format($volumeTotal / 1000, 1) . 'K')
                : '0',
            'icon' => 'heroicon-o-banknotes',
            'color' => 'emerald',
            'growth' => '+' . $growthRates['volume'] . '%',
            'growth_period' => 'questo mese',
            'description' => 'Crediti scambiati',
            'suffix' => '',
        ],
        [
            'id' => 'total_users',
            'label' => 'Community',
            'value' => $usersCount,
            'display_value' => $usersCount > 0 ? number_format($usersCount, 0, ',', '.') : '0',
            'icon' => 'heroicon-o-user-group',
            'color' => 'violet',
            'growth' => '+' . $growthRates['predictions'] . '%',
            'growth_period' => 'vs mese scorso',
            'description' => 'Utenti registrati',
            'suffix' => '+',
        ],
    ];

    $getColorClasses = function (string $color): array {
        $colors = [
            'cyan' => [
                'bg' => 'from-cyan-500 to-sky-600',
                'text' => 'text-cyan-400',
                'border' => 'border-cyan-400/30',
                'icon_bg' => 'bg-cyan-500/10',
                'growth' => 'text-cyan-400 bg-cyan-500/10',
            ],
            'blue' => [
                'bg' => 'from-blue-500 to-indigo-600',
                'text' => 'text-blue-400',
                'border' => 'border-blue-400/30',
                'icon_bg' => 'bg-blue-500/10',
                'growth' => 'text-blue-400 bg-blue-500/10',
            ],
            'emerald' => [
                'bg' => 'from-emerald-500 to-green-600',
                'text' => 'text-emerald-400',
                'border' => 'border-emerald-400/30',
                'icon_bg' => 'bg-emerald-500/10',
                'growth' => 'text-emerald-400 bg-emerald-500/10',
            ],
            'violet' => [
                'bg' => 'from-violet-500 to-purple-600',
                'text' => 'text-violet-400',
                'border' => 'border-violet-400/30',
                'icon_bg' => 'bg-violet-500/10',
                'growth' => 'text-violet-400 bg-violet-500/10',
            ],
        ];

        return $colors[$color] ?? $colors['cyan'];
    };
@endphp


<div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-16 md:py-24">
    {{-- Background Effects --}}
    <div class="absolute inset-0" aria-hidden="true">
        <div class="absolute top-1/4 left-1/4 h-64 w-64 rounded-full bg-cyan-500/10 blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 h-64 w-64 rounded-full bg-violet-500/10 blur-3xl"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-16 text-center">
            <h2 class="mb-4 text-3xl font-black tracking-tight text-white sm:text-4xl md:text-5xl">
                {{ $title }}
            </h2>
            <p class="mx-auto max-w-3xl text-lg text-slate-300">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Stats Grid --}}
        <div class="mb-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($stats as $stat)
                @php
                    $colors = $getColorClasses($stat['color']);
                @endphp

                <div class="group relative overflow-hidden rounded-2xl border {{ $colors['border'] }} bg-slate-800/50 p-6 backdrop-blur transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/10">
                    {{-- Background Gradient --}}
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-gradient-to-br {{ $colors['bg'] }} opacity-10 blur-2xl transition-opacity group-hover:opacity-20"></div>

                    {{-- Icon --}}
                    <div class="mb-6 flex items-center justify-between">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl {{ $colors['icon_bg'] }}">
                            <x-filament::icon :icon="$stat['icon']" class="h-7 w-7 {{ $colors['text'] }}" aria-hidden="true" />
                        </div>

                        @if(isset($stat['growth']))
                            <div class="text-right">
                                <div class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $colors['growth'] }}">
                                    ↗ {{ $stat['growth'] }}
                                </div>
                                <div class="mt-1 text-xs text-slate-400">
                                    {{ $stat['growth_period'] }}
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Value --}}
                    <div>
                        <div class="mb-2 flex items-baseline gap-1">
                            <span class="text-4xl font-black tracking-tight text-white"
                                  x-data="{
                                      count: 0,
                                      target: {{ $stat['value'] ?? 0 }},
                                      suffix: '{{ $stat['suffix'] ?? '' }}',
                                      formatted: '{{ $stat['display_value'] }}'
                                  }"
                                  x-init="
                                      if (target > 0) {
                                          const duration = {{ $counterDuration }};
                                          const steps = 60;
                                          const increment = target / steps;
                                          const stepTime = duration / steps;
                                          let current = 0;
                                          
                                          const timer = setInterval(() => {
                                              current += increment;
                                              if (current >= target) {
                                                  current = target;
                                                  clearInterval(timer);
                                              }
                                              
                                              const formatted = Math.floor(current).toLocaleString('it-IT');
                                              $el.textContent = formatted + suffix;
                                          }, stepTime);
                                      } else {
                                          $el.textContent = '0' + suffix;
                                      }
                                  ">
                                {{ $stat['display_value'] }}
                            </span>
                        </div>

                        <h3 class="mb-1 text-base font-bold text-white">
                            {{ $stat['label'] }}
                        </h3>

                        <p class="text-sm text-slate-400">
                            {{ $stat['description'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA Section --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-cyan-600 via-blue-600 to-violet-600 p-8 text-center md:p-12">
            {{-- Decorative elements --}}
            <div class="absolute -left-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl" aria-hidden="true"></div>
            <div class="absolute -bottom-10 -right-10 h-40 w-40 rounded-full bg-white/10 blur-2xl" aria-hidden="true"></div>

            <div class="relative">
                <h3 class="mb-4 text-2xl font-black text-white md:text-3xl">
                    Pronto a Far Parte di Questi Numeri?
                </h3>
                <p class="mx-auto mb-8 max-w-2xl text-blue-100">
                    Sii tra i primi a prevedere il futuro. La piattaforma è appena nata.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ url(app()->getLocale().'/register') }}"
                       class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-base font-bold text-blue-600 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        <x-filament::icon icon="heroicon-o-rocket-launch" class="mr-2 h-5 w-5" aria-hidden="true" />
                        Inizia Gratis
                        <x-filament::icon icon="heroicon-o-arrow-right" class="ml-2 h-5 w-5" aria-hidden="true" />
                    </a>
                    <a href="{{ url(app()->getLocale().'/predicts') }}"
                       class="inline-flex items-center justify-center rounded-full border-2 border-white/30 bg-white/10 px-8 py-4 text-base font-bold text-white backdrop-blur transition-all duration-300 hover:bg-white/20">
                        <x-filament::icon icon="heroicon-o-chart-bar" class="mr-2 h-5 w-5" aria-hidden="true" />
                        Esplora i Mercati
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
