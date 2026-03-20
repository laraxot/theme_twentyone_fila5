<?php

declare(strict_types=1);

namespace Themes\TwentyOne\Actions\Markets;

use Illuminate\Support\Collection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Predict\Actions\Homepage\GetHomepageMarketCardsAction;

final class ResolveFeaturedMarketsGridDataAction
{
    /**
     * @return array{
     *     title:string,
     *     subtitle:string,
     *     showAllLink:string,
     *     showAllLabel:string,
     *     openMarketLabel:string,
     *     activeMarketsLabel:string,
     *     multiOutcomeLabel:string,
     *     visualOptionsLabel:string,
     *     freshnessLabel:string,
     *     educationLabel:string,
     *     emptyStateTitle:string,
     *     emptyStateBody:string,
     *     cards:Collection<int, array{
     *         title:string,
     *         slug:string,
     *         url:string,
     *         image_url:string|null,
     *         category:string|null,
     *         participants:int,
     *         volume:float,
     *         ends_at_human:string|null,
     *         outcomes:array<int, array{title:string, percentage:float, image_url:string|null}>
     *     }>
     * }
     */
    public function execute(?string $title = null, ?string $subtitle = null, ?string $showAllLink = null, int $limit = 12): array
    {
        $locale = app()->getLocale();

        return [
            'title' => $title ?: $this->tx('predict::home.featured_markets.title', 'Mercati in primo piano'),
            'subtitle' => $subtitle ?: $this->tx('predict::home.featured_markets.subtitle', 'Mercati reali, multi-opzione e dati calcolati dal database'),
            'showAllLink' => $showAllLink ?: (LaravelLocalization::getLocalizedURL($locale, '/predicts') ?? url('/'.$locale.'/predicts')),
            'showAllLabel' => $this->tx('predict::home.featured_markets.cta_all', 'Esplora tutti i mercati'),
            'openMarketLabel' => $this->tx('predict::actions.trade_market', 'Apri il mercato'),
            'activeMarketsLabel' => $this->tx('predict::home.featured_markets.active_markets', 'mercati attivi'),
            'multiOutcomeLabel' => $this->tx('predict::home.featured_markets.multi_outcome_focus', 'Solo mercati con 4+ esiti'),
            'visualOptionsLabel' => $this->tx('predict::home.featured_markets.visual_options', 'Opzioni visive con quota crediti'),
            'freshnessLabel' => $this->tx('predict::home.featured_markets.freshness', 'Quote e partecipazione dai mercati pubblici'),
            'educationLabel' => $this->tx('predict::home.featured_markets.education', 'Probabilità aggiornate su dati reali'),
            'emptyStateTitle' => $this->tx('predict::predict_table.empty_state.no_markets_available.message', 'Nessun mercato disponibile'),
            'emptyStateBody' => $this->tx('predict::home.featured_markets.empty_body', 'Pubblica o abilita mercati visibili per popolare questa sezione.'),
            'cards' => app(GetHomepageMarketCardsAction::class)->execute($limit, 'featured'),
        ];
    }

    private function tx(string $key, string $fallback): string
    {
        $translated = __($key);
        if (is_string($translated) && $translated !== $key) {
            return $translated;
        }

        $translatedLabel = __($key.'.label');
        if (is_string($translatedLabel) && $translatedLabel !== $key.'.label') {
            return $translatedLabel;
        }

        return $fallback;
    }
}
