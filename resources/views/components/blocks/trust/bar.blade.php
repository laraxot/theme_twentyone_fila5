{{--
  Trust bar stile Kalshi: 3 link credibilità sotto hero.
  Accessibile: nav con aria-label, link con min 44x44px.
--}}
@php
    $tCredits     = __('predict::predict.home.trust.credits');
    $tTransparent = __('predict::predict.home.trust.transparent');
    $tGovernance  = __('predict::predict.home.trust.governance');
    $tAria        = __('predict::predict.home.trust.aria_label');
    // Fallback se la chiave non esiste
    $tCredits     = is_string($tCredits)     && $tCredits     !== 'predict::predict.home.trust.credits'     ? $tCredits     : 'Credits virtuali';
    $tTransparent = is_string($tTransparent) && $tTransparent !== 'predict::predict.home.trust.transparent' ? $tTransparent : 'Trasparenza';
    $tGovernance  = is_string($tGovernance)  && $tGovernance  !== 'predict::predict.home.trust.governance'  ? $tGovernance  : 'Governance';
    $tAria        = is_string($tAria)        && $tAria        !== 'predict::predict.home.trust.aria_label'  ? $tAria        : 'Fiducia e trasparenza';
    $locale = app()->getLocale();
@endphp
<nav class="border-b border-gray-200 bg-gray-50" aria-label="{{ $tAria }}">
    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10">
            <a href="{{ url('/' . $locale . '/pages/credits') }}"
               class="inline-flex items-center gap-2 min-h-[44px] min-w-[44px] text-sm font-medium text-gray-700 hover:text-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-lg px-2 py-2 transition-colors"
               aria-label="{{ $tCredits }}">
                <x-heroicon-o-gift class="w-5 h-5 text-emerald-600" aria-hidden="true" />
                <span>{{ $tCredits }}</span>
            </a>
            <a href="{{ url('/' . $locale . '/pages/trasparenza') }}"
               class="inline-flex items-center gap-2 min-h-[44px] min-w-[44px] text-sm font-medium text-gray-700 hover:text-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-lg px-2 py-2 transition-colors"
               aria-label="{{ $tTransparent }}">
                <x-heroicon-o-shield-check class="w-5 h-5 text-emerald-600" aria-hidden="true" />
                <span>{{ $tTransparent }}</span>
            </a>
            <a href="{{ url('/' . $locale . '/pages/governance') }}"
               class="inline-flex items-center gap-2 min-h-[44px] min-w-[44px] text-sm font-medium text-gray-700 hover:text-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 rounded-lg px-2 py-2 transition-colors"
               aria-label="{{ $tGovernance }}">
                <x-heroicon-o-user-group class="w-5 h-5 text-emerald-600" aria-hidden="true" />
                <span>{{ $tGovernance }}</span>
            </a>
        </div>
    </div>
</nav>
