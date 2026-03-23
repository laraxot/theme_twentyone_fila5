<main id="main-content" class="bg-slate-950 text-slate-100">
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold">Prediction Markets</h1>
            <p class="mt-4 max-w-2xl mx-auto text-slate-300">
                Esplora i mercati, confronta probabilita e partecipa con le tue previsioni.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/' . app()->getLocale() . '/predicts') }}" class="px-8 py-3 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold transition">
                    Esplora i Mercati
                </a>
                <a href="{{ url('/' . app()->getLocale() . '/register') }}" class="px-8 py-3 rounded-full border border-slate-600 hover:border-slate-400 text-slate-100 font-semibold transition">
                    Registrati
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-16 bg-slate-950" aria-labelledby="predicts-heading">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 id="predicts-heading" class="text-3xl md:text-4xl font-bold">Featured Predicts</h2>
                <p class="text-slate-400 mt-2">Mercati in evidenza con multi-outcome</p>
            </div>
            
            {{-- Featured Predicts Widget --}}
            @livewire(
                \Modules\Predict\Filament\Widgets\PredictTableWidget::class,
                [
                    'homepageMode' => true,
                    'minimumOutcomes' => 2,
                    'showTableControls' => false,
                ],
                key('home-predict-table')
            )
        </div>
    </section>
</main>
</main>
