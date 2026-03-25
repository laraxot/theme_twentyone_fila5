@props(['predict'])

{{-- Trading Form Component --}}
<div class="trading-form bg-slate-900/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-800">
    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
        <x-heroicon-o-chart-bar class="w-6 h-6 text-emerald-500" />
        Piazza Ordine
    </h3>
    
    <form wire:submit="placeOrder" class="space-y-4">
        {{-- Select Outcome --}}
        <div>
            <label for="outcome" class="block text-sm font-medium text-slate-300 mb-2">
                Esito
            </label>
            <select 
                id="outcome" 
                wire:model.live="selectedOutcomeId"
                class="w-full rounded-lg bg-slate-800 border-slate-700 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                aria-label="Seleziona esito"
            >
                @foreach($predict->outcomes ?? [] as $outcome)
                    <option value="{{ $outcome->id }}">
                        {{ $outcome->name }} - €{{ number_format($outcome->current_price ?? 0, 2) }}
                        ({{ number_format($outcome->probability ?? 0, 1) }}%)
                    </option>
                @endforeach
            </select>
        </div>
        
        {{-- Quantità --}}
        <div>
            <label for="quantity" class="block text-sm font-medium text-slate-300 mb-2">
                Quantità
            </label>
            <input 
                type="number" 
                id="quantity"
                wire:model.live="quantity"
                min="1"
                max="1000"
                placeholder="Inserisci quantità"
                class="w-full rounded-lg bg-slate-800 border-slate-700 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                aria-label="Quantità quote"
            />
        </div>
        
        {{-- Totale --}}
        <div class="p-4 bg-slate-800/50 rounded-xl border border-slate-700">
            <div class="flex justify-between items-center mb-2">
                <span class="text-slate-400 text-sm">Prezzo per quota:</span>
                <span class="text-white font-semibold">€{{ number_format($pricePerShare ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-slate-700">
                <span class="text-slate-400 text-sm">Totale:</span>
                <span class="text-emerald-400 font-bold text-xl">€{{ number_format($totalPrice ?? 0, 2) }}</span>
            </div>
        </div>
        
        {{-- Buttons --}}
        <div class="grid grid-cols-2 gap-3">
            <button 
                type="button"
                wire:click="buy"
                wire:loading.attr="disabled"
                class="btn-buy inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 min-h-[48px] focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 disabled:opacity-50 disabled:cursor-not-allowed"
                aria-label="Compra quote"
            >
                <x-heroicon-s-arrow-up class="w-5 h-5" />
                <span>Compra</span>
            </button>
            <button 
                type="button"
                wire:click="sell"
                wire:loading.attr="disabled"
                class="btn-sell inline-flex items-center justify-center gap-2 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 min-h-[48px] focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-slate-900 disabled:opacity-50 disabled:cursor-not-allowed"
                aria-label="Vendi quote"
            >
                <x-heroicon-s-arrow-down class="w-5 h-5" />
                <span>Vendi</span>
            </button>
        </div>
        
        {{-- Loading State --}}
        <div wire:loading wire:target="placeOrder" class="text-center py-2">
            <div class="inline-block animate-spin rounded-full h-5 w-5 border-b-2 border-emerald-500"></div>
            <span class="ml-2 text-slate-400 text-sm">Elaborazione...</span>
        </div>
        
        {{-- Error Message --}}
        @if($errors->has('quantity'))
            <div class="mt-3 p-3 bg-rose-500/10 border border-rose-500/20 rounded-lg text-rose-400 text-sm">
                {{ $errors->first('quantity') }}
            </div>
        @endif
        
        @if(session()->has('error'))
            <div class="mt-3 p-3 bg-rose-500/10 border border-rose-500/20 rounded-lg text-rose-400 text-sm">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session()->has('success'))
            <div class="mt-3 p-3 bg-emerald-500/10 border border-emerald-500/20 rounded-lg text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>
