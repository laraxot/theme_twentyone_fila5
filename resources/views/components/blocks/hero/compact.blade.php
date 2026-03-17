{{--
  Hero compatta stile Polymarket/Kalshi: value proposition + CTA.
  Accessibile: role="banner", heading h1, link CTA con aria.
--}}
<section class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800" role="banner" aria-labelledby="hero-heading">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    <div class="relative px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-24">
        <div class="text-center">
            <p class="inline-flex items-center gap-2 px-4 py-2 mb-4 text-sm font-semibold tracking-wide text-emerald-100 rounded-full bg-white/10 backdrop-blur" id="hero-badge">
                {{ __('predict::home.hero.badge') }}
            </p>
            <h1 id="hero-heading" class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                {{ __('predict::home.hero.title') }}
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-emerald-100 sm:text-xl">
                {{ __('predict::home.hero.subtitle') }}
            </p>
            <div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row sm:gap-6">
                <a href="{{ route('articles.index') }}#playmarkets"
                   class="inline-flex items-center justify-center min-h-[44px] min-w-[44px] px-6 py-3 text-base font-semibold text-emerald-700 bg-white rounded-lg shadow-lg hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600 transition-colors"
                   aria-label="{{ __('predict::home.hero.cta_explore') }}">
                    {{ __('predict::home.hero.cta_explore') }}
                    <x-heroicon-o-arrow-right class="w-5 h-5 ml-2" aria-hidden="true" />
                </a>
                <a href="{{ route('learn') }}"
                   class="inline-flex items-center justify-center min-h-[44px] min-w-[44px] px-6 py-3 text-base font-semibold text-white border-2 border-white/60 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600 transition-colors"
                   aria-label="{{ __('predict::home.hero.cta_learn') }}">
                    {{ __('predict::home.hero.cta_learn') }}
                </a>
            </div>
        </div>
    </div>
</section>
