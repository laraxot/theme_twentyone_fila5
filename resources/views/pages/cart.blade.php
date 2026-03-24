<?php

use function Livewire\Volt\{state};

state('count', fn () => cache()->get('count', 0));

$remove = function () {
    if ($this->count > 0) {
        cache()->put('count', --$this->count);
    }
};

?>

<x-layouts.app>
    @volt
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="mb-6">
                <a href="/" class="text-emerald-600 dark:text-emerald-400 hover:underline text-sm">
                    &larr; Torna alla Home
                </a>
            </div>

            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-8">Carrello</h1>

            @if ($count)
                <div class="grid gap-6">
                    @foreach (range(1, cache()->get('count')) as $item)
                        <div class="flex items-center justify-between gap-4 p-4 bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 rounded-xl transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                                <div>
                                    <div class="text-slate-900 dark:text-white font-medium">{{ fake()->sentence(2) }}</div>
                                    <div class="font-bold text-xl text-emerald-600 dark:text-emerald-400">${{ rand(10, 100) }}</div>
                                </div>
                            </div>

                            <button
                                class="bg-red-500 hover:bg-red-600 text-white rounded-lg py-2 px-4 text-sm font-medium transition-colors"
                                wire:click="remove"
                            >
                                Rimuovi
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>
                    <p class="text-2xl font-light text-slate-500 dark:text-slate-400">
                        Il tuo carrello è vuoto.
                    </p>
                    <a href="/" class="mt-4 inline-block text-emerald-600 dark:text-emerald-400 hover:underline">
                        Esplora i mercati
                    </a>
                </div>
            @endif
        </div>
    @endvolt
</x-layouts.app>
